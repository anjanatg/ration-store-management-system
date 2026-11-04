<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Distribution;
use App\Models\DistributionItem;
use App\Models\MonthlyEntitlement;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DistributionService
{
    public function getAllDistributions()
    {
        return Distribution::with(['customer', 'operator', 'items.product'])
            ->latest('distribution_date')
            ->latest('id')
            ->get();
    }

    public function getCustomerEntitlements(Customer $customer)
{
    $entitlements = MonthlyEntitlement::with('product')
        ->where('card_category_id', $customer->card_category_id)
        ->get();

    $rows = [];

    foreach ($entitlements as $entitlement) {
        $given = $this->givenThisMonth(
            $customer->id,
            $entitlement->product_id
        );

        $rows[] = [
            'product'   => $entitlement->product,
            'monthly'   => $entitlement->quantity,
            'given'     => $given,
            'remaining' => max($entitlement->quantity - $given, 0),
        ];
    }

    return $rows;
}

    public function givenThisMonth($customerId, $productId)
    {
        return DistributionItem::where('product_id', $productId)
            ->whereHas('distribution', function ($query) use ($customerId) {
                $query->where('customer_id', $customerId)
                    ->whereMonth('distribution_date', now()->month)
                    ->whereYear('distribution_date', now()->year);
            })
            ->sum('quantity');
    }

    public function store(array $data, $operatorId)
    {
        $quantities = array_filter($data['quantities'], fn ($quantity) => $quantity > 0);

        if (empty($quantities)) {
            $this->fail('Enter a quantity for at least one product.');
        }

        DB::transaction(function () use ($data, $operatorId, $quantities) {
            $customer = Customer::findOrFail($data['customer_id']);

            $distribution = Distribution::create([
                'customer_id'       => $customer->id,
                'operator_id'       => $operatorId,
                'distribution_date' => $data['distribution_date'],
                'notes'             => $data['notes'] ?? null,
            ]);

            foreach ($quantities as $productId => $quantity) {
                $entitlement = MonthlyEntitlement::with('product')
                    ->where('card_category_id', $customer->card_category_id)
                    ->where('product_id', $productId)
                    ->first();

                if (!$entitlement) {
                    $this->fail('This product is not allowed for this ration card category.');
                }

                $product = $entitlement->product;
                $given = $this->givenThisMonth($customer->id, $productId);

                if ($given + $quantity > $entitlement->quantity) {
                    $this->fail($product->name . ' is more than the monthly limit.');
                }

                if ($quantity > $product->available_stock) {
                    $this->fail('Not enough stock for ' . $product->name . '.');
                }

                DistributionItem::create([
                    'distribution_id' => $distribution->id,
                    'product_id'      => $productId,
                    'quantity'        => $quantity,
                ]);

                Stock::create([
                    'product_id'       => $productId,
                    'quantity'         => $quantity,
                    'transaction_type' => 'deduction',
                    'notes'            => 'Ration distribution',
                    'transaction_date' => $data['distribution_date'],
                ]);

                $product->decrement('available_stock', $quantity);
            }
        });
    }

    private function fail($message)
    {
        throw ValidationException::withMessages(['quantities' => $message]);
    }
}