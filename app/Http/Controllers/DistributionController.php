<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistributionRequest;
use App\Models\Customer;
use App\Services\DistributionService;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    public function __construct(private DistributionService $distributionService)
    {
    }

    public function index()
    {
        $distributions = $this->distributionService->getAllDistributions();
        return view('distribution.index', compact('distributions'));
    }

    public function create(Request $request)
    {
        $customers = Customer::orderBy('name')->get();
        $customer = null;
        $rows = [];

        if ($request->customer_id) {
            $customer = Customer::with('cardCategory')->find($request->customer_id);

            if ($customer) {
                $rows = $this->distributionService->getCustomerEntitlements($customer);
            }
        }

        return view('distribution.create', compact('customers', 'customer', 'rows'));
    }

    public function store(DistributionRequest $request)
    {
        try {
    
            $this->distributionService->store($request->validated(),auth()->id());
            return response()->json(['success' => true,'redirect' => route('distribution.index')]);
        } catch (\Throwable $e) {
            if ($e instanceof \Illuminate\Validation\ValidationException) {throw $e;
            }
            report($e);
            return response()->json([
                'message' => 'Unable to save distribution. Please try again.'
            ], 500);
        }
    }

}