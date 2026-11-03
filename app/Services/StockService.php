<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getAllStocks()
    {
        return Stock::with('product')->latest()->get();
    }
    public function addStock(array $data): Stock
    {
        return DB::transaction(function () use ($data) {

            $product = Product::where('id', $data['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $product->increment('available_stock', $data['quantity']);

            return Stock::create($data);
        });
    }

    public function deductStock(array $data): Stock
    {
        return DB::transaction(function () use ($data) {

            $product = Product::where('id', $data['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($product->available_stock < $data['quantity']) {
                throw ValidationException::withMessages([
                    'quantity' => 'Insufficient stock available.',
                ]);
            }

            $product->decrement('available_stock', $data['quantity']);

            return Stock::create($data);
        });
    }

}
