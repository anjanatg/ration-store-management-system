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
        $categories = $this->categoryService->allCategories();
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
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['message' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function cardCategory()
    {
        $categories = $this->categoryService->allCardCategories();
        return view('categories.card_category', compact('categories'));
    }

    public function storeCardCategory(CategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['is_active'] = true;
            $this->categoryService->createCardCategory($data);
            session()->flash('success','Ration card category added successfully.');
            return response()->json(['redirect' => route('card-categories.index')]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['message' => 'Something went wrong. Please try again.'], 500);
        }
    }
}
