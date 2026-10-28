<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrNew(['email' => 'admin@example.com']);
        $admin->name = 'Admin';
        $admin->password = Hash::make('Admin@123');
        $admin->role = User::ROLE_ADMIN;
        $admin->save();
    }
}
