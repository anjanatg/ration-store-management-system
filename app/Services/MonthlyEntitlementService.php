<?php

namespace App\Services;

use App\Models\MonthlyEntitlement;

class MonthlyEntitlementService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getAllEntitlements()
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
}