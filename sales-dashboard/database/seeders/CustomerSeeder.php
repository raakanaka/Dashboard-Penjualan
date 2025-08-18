<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@email.com',
                'phone' => '081234567890',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'customer_code' => 'CUST001',
                'is_active' => true,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@email.com',
                'phone' => '081234567891',
                'address' => 'Jl. Thamrin No. 456, Jakarta Pusat',
                'customer_code' => 'CUST002',
                'is_active' => true,
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@email.com',
                'phone' => '081234567892',
                'address' => 'Jl. Gatot Subroto No. 789, Jakarta Selatan',
                'customer_code' => 'CUST003',
                'is_active' => true,
            ],
            [
                'name' => 'Dewi Sartika',
                'email' => 'dewi.sartika@email.com',
                'phone' => '081234567893',
                'address' => 'Jl. Hayam Wuruk No. 321, Jakarta Barat',
                'customer_code' => 'CUST004',
                'is_active' => true,
            ],
            [
                'name' => 'Rudi Hermawan',
                'email' => 'rudi.hermawan@email.com',
                'phone' => '081234567894',
                'address' => 'Jl. Pangeran Antasari No. 654, Jakarta Selatan',
                'customer_code' => 'CUST005',
                'is_active' => true,
            ],
            [
                'name' => 'Maya Indah',
                'email' => 'maya.indah@email.com',
                'phone' => '081234567895',
                'address' => 'Jl. Senayan No. 987, Jakarta Pusat',
                'customer_code' => 'CUST006',
                'is_active' => true,
            ],
            [
                'name' => 'Agus Setiawan',
                'email' => 'agus.setiawan@email.com',
                'phone' => '081234567896',
                'address' => 'Jl. Rasuna Said No. 147, Jakarta Selatan',
                'customer_code' => 'CUST007',
                'is_active' => true,
            ],
            [
                'name' => 'Nina Safitri',
                'email' => 'nina.safitri@email.com',
                'phone' => '081234567897',
                'address' => 'Jl. Sudirman No. 258, Jakarta Pusat',
                'customer_code' => 'CUST008',
                'is_active' => true,
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
