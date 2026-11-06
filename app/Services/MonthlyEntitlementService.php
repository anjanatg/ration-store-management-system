<?php

namespace App\Services;

use App\Models\MonthlyEntitlement;
use App\Models\card_categories;
use App\Models\Product;
class MonthlyEntitlementService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function AllEntitlements()
    {
        return MonthlyEntitlement::with([
            'cardCategory',
            'product'
        ])->latest()->get();
    }

    public function createEntitlement(array $data): MonthlyEntitlement
    {
        return MonthlyEntitlement::create($data);
    }

    public function updateEntitlement(
        MonthlyEntitlement $entitlement,
        array $data
    ): void {
        $entitlement->update($data);
    }

    public function deleteEntitlement(
        MonthlyEntitlement $entitlement
    ): void {
        $entitlement->delete();
    }
    public function Categories()
    {
        return card_categories::where('is_active', true)->orderBy('name')->get();
    }

    public function Products()
    {
        return Product::where('is_active', true)->orderBy('name')->get();
    }
}