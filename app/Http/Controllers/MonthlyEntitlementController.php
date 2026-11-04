<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonthlyEntitlementRequest;
use App\Models\card_categories;
use App\Models\MonthlyEntitlement;
use App\Models\Product;
use App\Services\MonthlyEntitlementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class MonthlyEntitlementController extends Controller
{
    public function __construct(
        private MonthlyEntitlementService $entitlementService
    ) {}

    public function index(): View|RedirectResponse
    {
        try {
            $entitlements = $this->entitlementService->getAllEntitlements();

            return view('entitlements.index', compact('entitlements'));

        } catch (Throwable $e) {
            report($e);

            return back()->with(
                'error',
                'Unable to load monthly entitlements. Please try again.'
            );
        }
    }

    public function create(): View|RedirectResponse
    {
        try {
            $categories = card_categories::where('is_active', true)
                ->orderBy('name')
                ->get();

            $products = Product::where('is_active', true)
                ->orderBy('name')
                ->get();

            return view('entitlements.create', compact('categories', 'products'));

        } catch (Throwable $e) {
            report($e);

            return back()->with(
                'error',
                'Unable to open the entitlement form. Please try again.'
            );
        }
    }

    public function store(
        MonthlyEntitlementRequest $request
    ): RedirectResponse {
        try {
            $this->entitlementService->createEntitlement(
                $request->validated()
            );

            return redirect()->route('entitlements.index')
                ->with('success', 'Monthly entitlement added successfully.');

        } catch (Throwable $e) {
            report($e);

            return back()->withInput()
                ->with('error', 'Unable to add monthly entitlement. Please try again.');
        }
    }

    public function edit(
        MonthlyEntitlement $monthlyEntitlement
    ): View|RedirectResponse {
        try {
            $categories = card_categories::where('is_active', true)
                ->orderBy('name')
                ->get();

            $products = Product::where('is_active', true)
                ->orderBy('name')
                ->get();

            return view(
                'entitlements.edit',
                compact('monthlyEntitlement', 'categories', 'products')
            );

        } catch (Throwable $e) {
            report($e);

            return back()->with(
                'error',
                'Unable to open the entitlement details. Please try again.'
            );
        }
    }

    public function update(
        MonthlyEntitlementRequest $request,
        MonthlyEntitlement $monthlyEntitlement
    ): RedirectResponse {
        try {
            $this->entitlementService->updateEntitlement(
                $monthlyEntitlement,
                $request->validated()
            );

            return redirect()->route('entitlements.index')
                ->with('success', 'Monthly entitlement updated successfully.');

        } catch (Throwable $e) {
            report($e);

            return back()->withInput()
                ->with('error', 'Unable to update monthly entitlement. Please try again.');
        }
    }

    public function destroy(
        MonthlyEntitlement $monthlyEntitlement
    ): RedirectResponse {
        try {
            $this->entitlementService->deleteEntitlement($monthlyEntitlement);

            return redirect()->route('entitlements.index')
                ->with('success', 'Monthly entitlement deleted successfully.');

        } catch (Throwable $e) {
            report($e);

            return back()->with(
                'error',
                'Unable to delete monthly entitlement. Please try again.'
            );
        }
    }
}