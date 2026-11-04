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
        $this->distributionService->store($request->validated(), auth()->id());

        return redirect()->route('distribution.index')->with('success', 'Ration distributed successfully.');
    }
}