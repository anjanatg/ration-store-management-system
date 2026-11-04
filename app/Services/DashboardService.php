<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Distribution;

class DashboardService
{
    public function getDashboardData(): array
    {
        // Total customers
        $totalCustomers = Customer::count();

        // Total active products
        $totalProducts = Product::where('is_active', true)->count();

        // Available stock grouped by unit
        $stockByUnit = Product::selectRaw(
            'unit, SUM(available_stock) as total_stock'
        )
            ->where('is_active', true)
            ->groupBy('unit')
            ->get();

        // Current month's distributions
        $monthlyDistributions = Distribution::whereMonth(
            'distribution_date',
            now()->month
        )
            ->whereYear('distribution_date', now()->year)
            ->count();

        $lowStockProducts = Product::where('is_active', true)
            ->where('available_stock', '<=', 5)
            ->orderBy('available_stock')
            ->get();

        // Recent distributions
        $recentDistributions = Distribution::with([
            'customer',
            'operator',
            'items.product',
        ])
            ->latest('distribution_date')
            ->take(5)
            ->get();

        // Last seven months' distribution statistics
        $monthlyChart = collect(range(6, 0))->map(function ($monthsAgo) {
            $date = now()->startOfMonth()->subMonths($monthsAgo);

            return [
                'label' => $date->format('M Y'),

                'total' => Distribution::whereYear(
                    'distribution_date',
                    $date->year
                )
                    ->whereMonth('distribution_date', $date->month)
                    ->count(),
            ];
        });

        return compact(
            'totalCustomers',
            'totalProducts',
            'stockByUnit',
            'monthlyDistributions',
            'lowStockProducts',
            'recentDistributions',
            'monthlyChart'
        );
    }
}
