<?php

namespace App\Services;
use App\Models\Customer;

class CustomerService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getAllCustomers(?string $search = null)
    {
        return Customer::with('cardCategory')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('ration_card_number', 'like', "%{$search}%");
            })->latest()->paginate(8);
    }

    public function getCustomerById(int $id): Customer
    {
        return Customer::with('cardCategory')->findOrFail($id);
    }

    public function createCustomer(array $data): Customer
    {
        return Customer::create($data);
    }

    public function updateCustomer(Customer $customer, array $data): bool
    {
        return $customer->update($data);
    }
    public function deleteCustomer(Customer $customer): void
    {
        $customer->delete();
    }
}
