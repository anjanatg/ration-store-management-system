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
        try {
            $reports = $this->reportService->DistributionReport($request->validated());
            $customers = Customer::all();
            $products = Product::where('is_active', true)->get();
            $cardCategories = card_categories::where('is_active', true)->get();

            return view('reports.index', compact('reports', 'customers', 'products', 'cardCategories'));
        }
        catch (\Throwable $e) {
            report($e);
            return redirect()->route('dashboard')->with('error', 'Unable to load the report. Please try again.');
        }
    }

    public function export(ReportFilterRequest $request)
    {
        try {
            $reports = $this->reportService->DistributionReport($request->validated());

            $csv = "Date,Customer,Ration Card,Category,Product,Quantity,Operator\n";

            foreach ($reports as $report) {
                foreach ($report->items as $item) {
                    $csv .= implode(',', [
                        $report->distribution_date->format('d-m-Y'),
                        $report->customer->name,
                        $report->customer->ration_card_number,
                        $report->customer->cardCategory->name,
                        $item->product->name,
                        $item->quantity . ' ' . $item->product->unit,
                        $report->operator->name,
                    ]) . "\n";
                }
            }

            return response($csv)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename="distribution-report.csv"');
        }
        catch (\Throwable $e) {
            report($e);
            return redirect()->route('reports.index')->with('error', 'Unable to export the report. Please try again.');
        }
    }
}