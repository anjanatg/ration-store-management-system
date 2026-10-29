<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\RationCategory;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    public function index(Request $request)
    {
        $products = $this->productService->AllProducts($request->search);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = RationCategory::where('is_active', true)->orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        try {
            $this->productService->createProduct($request->validated());
            session()->flash('success', 'Product added successfully.');
            return response()->json(['redirect' => route('products.index')]);
        }
        catch (\Throwable $e) {
            report($e);
            return response()->json(['message' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function edit(int $id)
    {
        $product = $this->productService->ProductById($id);
        $categories = RationCategory::where('is_active', true)
            ->orWhere('id', $product->category_id)
            ->orderBy('name')
            ->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, int $id)
    {
        try {
            $product = $this->productService->ProductById($id);
            $this->productService->updateProduct($product, $request->validated());
            session()->flash('success', 'Product updated successfully.');
            return response()->json(['redirect' => route('products.index')]);
        }
        catch (\Throwable $e) {
            report($e);
            return response()->json(['message' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function deactivate(int $id)
    {
        try {
            $product = $this->productService->ProductById($id);
            $this->productService->deactivateProduct($product);
            return redirect()->route('products.index')->with('success', 'Product deactivated successfully.');
        }
        catch (\Throwable $e) {
            report($e);
            return redirect()->route('products.index')->with('error', 'Something went wrong. Please try again.');
        }
    }
}