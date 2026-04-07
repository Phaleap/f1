<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            ['role_name' => 'admin',    'description' => 'Administrator'],
            ['role_name' => 'customer', 'description' => 'Customer'],
        ]);
    }
}