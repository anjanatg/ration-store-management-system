<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function listUsers(?string $search): Collection
    {
        $query = User::where('role', 'user');
        if ($search) {
            $query->whereAny(['name', 'email'], 'like', '%' . $search . '%');
        }
        return $query->latest()->get();
    }

    public function userById(int $id): User
    {
        return User::where('role', 'user')->findOrFail($id);
    }

    public function createUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'is_active' => true,
            'age' => $data['age'] ?? null,
            'phone' => $data['phone'] ?? null,
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'gender'  => $data['gender'],
            'address' => $data['address'] ?? null,
        ]);
    }

    public function updateUser(User $user, array $data): void
    {
        if (empty($data['password'])) 
        {
            unset($data['password']);
        } 
        else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
    }

    public function deleteUser(User $user): void
    {
        $user->delete();
    }
}