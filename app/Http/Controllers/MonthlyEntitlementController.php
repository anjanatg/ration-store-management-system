<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonthlyEntitlementRequest;
use App\Models\MonthlyEntitlement;
use App\Services\MonthlyEntitlementService;
use Exception;

class MonthlyEntitlementController extends Controller
{
    public function __construct(private MonthlyEntitlementService $entitlementService)
    {}

    public function index()
    {
        $entitlements = $this->entitlementService->AllEntitlements();

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
        try {
            $this->entitlementService->createEntitlement($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Monthly entitlement added successfully.',
                'redirect' => route('entitlements.index')
            ]);

        } catch (Exception $e) {
            report($e);

            return response()->json([
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function edit(MonthlyEntitlement $monthlyEntitlement)
    {
        $categories = $this->entitlementService->Categories();
        $products = $this->entitlementService->Products();

        return view('entitlements.edit', compact('monthlyEntitlement', 'categories', 'products'));
    }

    public function update(MonthlyEntitlementRequest $request, MonthlyEntitlement $monthlyEntitlement)
    {
        try {
            $this->entitlementService->updateEntitlement(
                $monthlyEntitlement,
                $request->validated()
            );

            return response()->json([
                'success' => true,
                'message' => 'Monthly entitlement updated successfully.',
                'redirect' => route('entitlements.index')
            ]);

        } catch (Exception $e) {
            report($e);

            return response()->json([
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function destroy(MonthlyEntitlement $monthlyEntitlement)
    {
        try {
            $this->entitlementService->deleteEntitlement($monthlyEntitlement);

            return redirect()->route('entitlements.index')
                ->with('success', 'Monthly entitlement deleted successfully.');

        } catch (Exception $e) {
            return back()->with('error', 'Could not delete. This entitlement may be in use.');
        }
    }
}
