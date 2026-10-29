<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function AllProducts(?string $search = null)
    {
        $query = Product::with('category');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhereHas('category', function ($c) use ($search) {
                      $c->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        return $query->latest()->get();
    }

    
    public function ProductById(int $id): Product
    {
        return Product::with('category')->findOrFail($id);
    }

   
    public function createProduct(array $data): Product
    {
        return Product::create($data);
    }

   
    public function updateProduct(Product $product, array $data): bool
    {
        return $product->update($data);
    }

   
    public function deactivateProduct(Product $product): bool
    {
        return $product->update([
            'is_active' => false,
        ]);
    }
}
