<?php

namespace App\Services;

use App\Models\RationCategory;
class CategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function AllCategories()
    {
        return RationCategory::where('is_active', true)->orderBy('name')->get();
    }
    public function createCategory(array $data): RationCategory
    {
        return RationCategory::create($data);
    }
}
