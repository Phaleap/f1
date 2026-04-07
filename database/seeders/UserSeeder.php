<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'role_id'    => 1,
            'full_name'  => 'Admin User',
            'email'      => 'admin@f1store.com',
            'password'   => Hash::make('password'),
            'status'     => 'active',
        ]);

        User::create([
            'role_id'    => 2,
            'full_name'  => 'John Doe',
            'email'      => 'john@example.com',
            'password'   => Hash::make('password'),
            'phone'      => '+1234567890',
            'gender'     => 'male',
            'status'     => 'active',
        ]);

        User::create([
            'role_id'    => 2,
            'full_name'  => 'Jane Smith',
            'email'      => 'jane@example.com',
            'password'   => Hash::make('password'),
            'phone'      => '+0987654321',
            'gender'     => 'female',
            'status'     => 'active',
        ]);
    }
}
