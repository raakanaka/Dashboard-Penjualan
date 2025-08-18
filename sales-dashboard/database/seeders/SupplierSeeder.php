<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT Maju Bersama',
                'email' => 'info@majubersama.com',
                'phone' => '021-12345678',
                'address' => 'Jl. Industri No. 1, Tangerang',
                'contact_person' => 'Bapak Suharto',
                'is_active' => true,
            ],
            [
                'name' => 'CV Sukses Mandiri',
                'email' => 'contact@suksesmandiri.co.id',
                'phone' => '021-87654321',
                'address' => 'Jl. Raya Bekasi No. 45, Bekasi',
                'contact_person' => 'Ibu Siti Aminah',
                'is_active' => true,
            ],
            [
                'name' => 'UD Makmur Jaya',
                'email' => 'sales@makmurjaya.com',
                'phone' => '021-11223344',
                'address' => 'Jl. Pasar Baru No. 12, Jakarta Pusat',
                'contact_person' => 'Bapak Ahmad Hidayat',
                'is_active' => true,
            ],
            [
                'name' => 'PT Global Supplier',
                'email' => 'info@globalsupplier.com',
                'phone' => '021-55667788',
                'address' => 'Jl. Sudirman No. 100, Jakarta Pusat',
                'contact_person' => 'Bapak Robert Chen',
                'is_active' => true,
            ],
            [
                'name' => 'CV Mitra Sejati',
                'email' => 'contact@mitrasejati.com',
                'phone' => '021-99887766',
                'address' => 'Jl. Gatot Subroto No. 200, Jakarta Selatan',
                'contact_person' => 'Ibu Ratna Sari',
                'is_active' => true,
            ],
            [
                'name' => 'PT Distributor Utama',
                'email' => 'sales@distributorutama.com',
                'phone' => '021-44332211',
                'address' => 'Jl. Thamrin No. 50, Jakarta Pusat',
                'contact_person' => 'Bapak Hendra Wijaya',
                'is_active' => true,
            ],
            [
                'name' => 'UD Sumber Rejeki',
                'email' => 'info@sumberrejeki.com',
                'phone' => '021-66778899',
                'address' => 'Jl. Hayam Wuruk No. 75, Jakarta Barat',
                'contact_person' => 'Bapak Slamet Riyadi',
                'is_active' => true,
            ],
            [
                'name' => 'PT Mitra Abadi',
                'email' => 'contact@mitraabadi.com',
                'phone' => '021-22334455',
                'address' => 'Jl. Rasuna Said No. 150, Jakarta Selatan',
                'contact_person' => 'Ibu Diana Putri',
                'is_active' => true,
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
