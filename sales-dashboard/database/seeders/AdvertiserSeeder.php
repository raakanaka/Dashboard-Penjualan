<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Advertiser;

class AdvertiserSeeder extends Seeder
{
    public function run(): void
    {
        $advertisers = [
            [
                'name' => 'PT Maju Bersama',
                'email' => 'info@majubersama.com',
                'phone' => '081234567890',
                'address' => 'Jl. Sudirman No. 123, Jakarta',
                'company_name' => 'PT Maju Bersama',
                'commission_rate' => 10.00,
                'is_active' => true,
            ],
            [
                'name' => 'CV Sukses Mandiri',
                'email' => 'contact@suksesmandiri.com',
                'phone' => '081234567891',
                'address' => 'Jl. Thamrin No. 456, Jakarta',
                'company_name' => 'CV Sukses Mandiri',
                'commission_rate' => 12.50,
                'is_active' => true,
            ],
            [
                'name' => 'UD Berkah Jaya',
                'email' => 'sales@berkahjaya.com',
                'phone' => '081234567892',
                'address' => 'Jl. Gatot Subroto No. 789, Jakarta',
                'company_name' => 'UD Berkah Jaya',
                'commission_rate' => 8.00,
                'is_active' => true,
            ],
        ];

        foreach ($advertisers as $advertiser) {
            Advertiser::create($advertiser);
        }
    }
}
