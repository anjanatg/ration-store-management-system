<?php

namespace App\Services;
use App\Models\Customer;
use App\Models\Distribution;
use App\Models\DistributionItem;
use App\Models\MonthlyEntitlement;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\Product;
class DistributionService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function AllDistributions()
    {
        return Distribution::with('customer', 'operator', 'items.product')->latest()->get();
    }

    public function CustomerEntitlements(Customer $customer)
    {
        $entitlements = MonthlyEntitlement::with('product')->where('card_category_id', $customer->card_category_id)->get();
        $result = [];
        foreach ($entitlements as $entitlement) {
            $given = DistributionItem::where('product_id', $entitlement->product_id)
                ->whereHas('distribution', function ($query) use ($customer) {
                    $query->where('customer_id', $customer->id)->whereMonth('distribution_date', now()->month)->whereYear('distribution_date', now()->year);
                })->sum('quantity');
            $result[] = [
                'product' => $entitlement->product,
                'monthly' => $entitlement->quantity,
                'given' => $given,
                'remaining' => $entitlement->quantity - $given,
            ];
        }
        return $result;
    }

    public function store(array $data, $operatorId)
    {
        DB::transaction(function () use ($data, $operatorId) {
            $customer = Customer::findOrFail($data['customer_id']);
            $distribution = Distribution::create([
                'customer_id' => $customer->id,
                'operator_id' => $operatorId,
                'distribution_date' => $data['distribution_date'],
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($data['quantities'] as $productId => $quantity) {
                if ($quantity <= 0) {
                    continue;
                }

                $entitlement = MonthlyEntitlement::where('card_category_id', $customer->card_category_id)->where('product_id', $productId)->first();
                if (!$entitlement) {
                    throw ValidationException::withMessages([
                        'quantities' => 'This product is not allowed for this ration card category.'
                    ]);
                }

                $product = Product::where('id', $productId)->lockForUpdate()->firstOrFail();
                $given = DistributionItem::where('product_id', $productId)
                    ->whereHas('distribution', function ($query) use ($customer) {
                        $query->where('customer_id', $customer->id)->whereMonth('distribution_date', now()->month)->whereYear('distribution_date', now()->year);
                    })
                    ->sum('quantity');

                if (($given + $quantity) > $entitlement->quantity) {
                    throw ValidationException::withMessages([
                        'quantities' => $product->name . ' exceeds the monthly entitlement.'
                    ]);
                }

                if ($quantity > $product->available_stock) {
                    throw ValidationException::withMessages([
                        'quantities' => 'Not enough stock for ' . $product->name . '.'
                    ]);
                }

                DistributionItem::create([
                    'distribution_id' => $distribution->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
                Stock::create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'transaction_type' => 'deduction',
                    'notes' => 'Ration distribution',
                    'transaction_date' => $data['distribution_date'],
                ]);

                $product->decrement('available_stock', $quantity);
            }
        });
    }
}
