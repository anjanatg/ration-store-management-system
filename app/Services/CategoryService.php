<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;
use App\Models\card_categories;
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
    public function allCategories()
    {
        return RationCategory::where('is_active', true)->orderBy('name')->get();
    }
    public function createCategory(array $data): RationCategory
    {
        return RationCategory::create($data);
    }
    public function allCardCategories(): Collection
    {
        return card_categories::latest()->get();
    }

    public function createCardCategory(array $data): card_categories
    {
        return card_categories::create($data);
    }
}
