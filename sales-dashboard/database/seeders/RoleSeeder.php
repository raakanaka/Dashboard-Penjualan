<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Full access to all features and can manage users'
            ],
            [
                'name' => 'crm',
                'display_name' => 'CRM Manager',
                'description' => 'Can access customers, sales, and purchases'
            ],
            [
                'name' => 'advertiser',
                'display_name' => 'Advertiser',
                'description' => 'Can access budgets and sales data'
            ],
            [
                'name' => 'warehouse',
                'display_name' => 'Warehouse Manager',
                'description' => 'Can access inventory management only'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
