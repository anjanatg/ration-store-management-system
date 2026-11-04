<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonthlyEntitlementRequest;
use App\Models\card_categories;
use App\Models\MonthlyEntitlement;
use App\Models\Product;
use App\Services\MonthlyEntitlementService;

class MonthlyEntitlementController extends Controller
{
    public function __construct(private MonthlyEntitlementService $entitlementService) 
    {}
    
    public function index()
    {
        $entitlements = $this->entitlementService->getAllEntitlements();
        return view('entitlements.index', compact('entitlements'));
    }

    public function create()
    {
        $categories = $this->entitlementService->Categories();
        $products = $this->entitlementService->Products();
        return view('entitlements.create', compact('categories', 'products'));
    }

    public function store(MonthlyEntitlementRequest $request)
    {
        $this->entitlementService->createEntitlement($request->validated());
        return redirect()->route('entitlements.index')->with('success', 'Monthly entitlement added successfully.');
    }

    public function edit(MonthlyEntitlement $monthlyEntitlement)
    {
        $categories = $this->entitlementService->Categories();
        $products = $this->entitlementService->Products();
        return view('entitlements.edit', compact('monthlyEntitlement','categories','products'
        ));
    }

    public function update(MonthlyEntitlementRequest $request, MonthlyEntitlement $monthlyEntitlement) 
    {
        $this->entitlementService->updateEntitlement($monthlyEntitlement,$request->validated());
        return redirect()->route('entitlements.index')->with('success', 'Monthly entitlement updated successfully.');
    }

    public function destroy(MonthlyEntitlement $monthlyEntitlement)
    {
        $this->entitlementService->deleteEntitlement($monthlyEntitlement);
        return redirect()->route('entitlements.index')->with('success', 'Monthly entitlement deleted successfully.');
    }
    
}
