<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Distribution;

class DashboardService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function DashboardData(): array
    {
        $totalCustomers = Customer::count();
        $totalProducts = Product::where('is_active', true)->count();
        $stockByUnit = Product::selectRaw('unit, SUM(available_stock) as total_stock')->where('is_active', true)->groupBy('unit')->get();
        $monthlyDistributions = Distribution::whereMonth('distribution_date',now()->month)->whereYear('distribution_date', now()->year)->count();
        $lowStockProducts = Product::where('is_active', true)->where('available_stock', '<=', 5)->orderBy('available_stock')->get();
        $monthlyChart = collect(range(6, 0))->map(function ($monthsAgo) {
            $date = now()->startOfMonth()->subMonths($monthsAgo);
            return [
                'label' => $date->format('M Y'),
                'total' => Distribution::whereYear('distribution_date', $date->year)
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
            'monthlyChart'
        );
    }
}
