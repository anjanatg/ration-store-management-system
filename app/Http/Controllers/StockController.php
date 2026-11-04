<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Product;
use App\Services\StockService;
use Illuminate\Http\Request;
use Throwable;

class StockController extends Controller
{
    public function __construct(private StockService $stockService)
    {
    }

    public function index()
    {
        try {
            $stocks = $this->stockService->getAllStocks();
            return view('stock.index', compact('stocks'));

        } catch (Throwable $e) {
            report($e);
            return back()->with('error','Unable to load stock history. Please try again.');
        }
    }

    public function create()
    {
        try {
            $products = Product::where('is_active', true)->orderBy('name')->get();
            return view('stock.create', compact('products'));

        } catch (Throwable $e) {
            report($e);
            return back()->with('error','Unable to open the stock form. Please try again.');
        }
    }

    public function store(StockRequest $request)
    {
        try {
            $data = $request->validated();

            if ($data['transaction_type'] === 'addition') {
                $this->stockService->addStock($data);
            } else {
                $this->stockService->deductStock($data);
            }

            return redirect()->route('stock.index')->with('success', 'Stock transaction recorded successfully.');

        } catch (Throwable $e) {
            report($e);

            return back()->withInput()->with('error', 'Unable to record stock transaction. Please try again.');
        }
    }
}
