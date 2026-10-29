<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService)
    {
    }

    public function index()
    {
        $categories = $this->categoryService->AllCategories();
        return view('categories.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['is_active'] = true;

            $this->categoryService->createCategory($data);
            session()->flash('success', 'Category added successfully.');
            return response()->json(['redirect' => route('categories.index')]);
        }
        catch (\Throwable $e) {
            report($e);
            return response()->json(['message' => 'Something went wrong. Please try again.'], 500);
        }
    }
}