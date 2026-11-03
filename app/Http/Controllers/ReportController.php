<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportFilterRequest;
use App\Models\card_categories;
use App\Models\Customer;
use App\Models\Product;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function __construct(private ReportService $reportService)
    {
    }

    public function index(ReportFilterRequest $request)
    {
        $reports = $this->reportService->getDistributionReport($request->validated());

        $customers = Customer::all();
        $products = Product::where('is_active', true)->get();
        $cardCategories = card_categories::where('is_active', true)->get();

        return view('reports.index', compact('reports', 'customers', 'products', 'cardCategories'));
    }

    public function export(ReportFilterRequest $request)
    {
        $reports = $this->reportService->getDistributionReport($request->validated());

        return response()->streamDownload(function () use ($reports) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Date', 'Customer', 'Ration Card', 'Category', 'Product', 'Quantity', 'Operator']);

            foreach ($reports as $report) {
                foreach ($report->items as $item) {
                    fputcsv($file, [
                        $report->distribution_date->format('d-m-Y'),
                        $report->customer->name,
                        $report->customer->ration_card_number,
                        $report->customer->cardCategory->name,
                        $item->product->name,
                        $item->quantity . ' ' . $item->product->unit,
                        $report->operator->name,
                    ]);
                }
            }

            fclose($file);
        }, 'distribution-report.csv', ['Content-Type' => 'text/csv']);
    }
}