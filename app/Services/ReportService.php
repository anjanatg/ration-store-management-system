<?php

namespace App\Services;

use App\Models\Distribution;

class ReportService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function DistributionReport(array $filters = [])
    {
        $query = Distribution::with(['customer.cardCategory', 'operator', 'items.product']);

        if (!empty($filters['start_date'])) {
            $query->whereDate('distribution_date', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('distribution_date', '<=', $filters['end_date']);
        }

        if (!empty($filters['customer_id'])) {
            $query->where('customer_id', $filters['customer_id']);
        }

        if (!empty($filters['product_id'])) {
            $query->whereHas('items', function ($q) use ($filters) {
                $q->where('product_id', $filters['product_id']);
            });
        }

        if (!empty($filters['card_category_id'])) {
            $query->whereHas('customer', function ($q) use ($filters) {
                $q->where('card_category_id', $filters['card_category_id']);
            });
        }

        return $query->latest('distribution_date')->get();
    }
}