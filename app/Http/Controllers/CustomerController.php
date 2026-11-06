<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\card_categories;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Throwable;

class CustomerController extends Controller
{
    public function __construct(private CustomerService $customerService)
    {
    }

    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            $customers = $this->customerService->AllCustomers($search);
            return view('customers.index', compact('customers', 'search'));

        } catch (Throwable $e) {
            report($e);
            return back()->with('error','Unable to load customers. Please try again.');
        }
    }

    public function create()
    {
        try {
            $categories = card_categories::where('is_active', true)->orderBy('name')->get();
            return view('customers.create', compact('categories'));

        } catch (Throwable $e) {
            report($e);
            return back()->with('error','Unable to open the customer registration page. Please try again.');
        }
    }

    public function store(CustomerRequest $request)
    {
        try {
            $this->customerService->createCustomer($request->validated());
            return redirect()->route('customers.index')->with('success', 'Customer added successfully.');

        } catch (Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Unable to add customer. Please try again.');
        }
    }

    public function edit(Customer $customer)
    {
        try {
            $categories = card_categories::where('is_active', true)->orderBy('name')->get();
            return view('customers.edit', compact('customer', 'categories'));

        } catch (Throwable $e) {
            report($e);
            return back()->with('error','Unable to open the customer details. Please try again.');
        }
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        try {
            $this->customerService->updateCustomer($customer,$request->validated());
            return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');

        } catch (Throwable $e) {
            report($e);
            return back()->withInput()->with('error', 'Unable to update customer. Please try again.');
        }
    }

    public function destroy(Customer $customer)
    {
        try {
            $this->customerService->deleteCustomer($customer);
            return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');

        } catch (Throwable $e) {
            report($e);
            return back()->with('error','Unable to delete customer. Please try again.');
        }
    }
}
