<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'company_name',
                'value' => 'CRM Solutions Indonesia',
            ],
            [
                'key' => 'company_address',
                'value' => 'Jl. Sudirman No. 123, Jakarta Pusat 10220',
            ],
            [
                'key' => 'company_phone',
                'value' => '+62 21 5555 8888',
            ],
            [
                'key' => 'company_email',
                'value' => 'info@crmsolutions.co.id',
            ],
            [
                'key' => 'default_tax_rate',
                'value' => '11',
            ],
            [
                'key' => 'currency_symbol',
                'value' => 'Rp',
            ],
            [
                'key' => 'invoice_payment_terms',
                'value' => '14', // days
            ],
            [
                'key' => 'minimum_payment_percentage',
                'value' => '30', // percent
            ],
            [
                'key' => 'logo_path',
                'value' => 'logo/crm-logo.png',
            ],
            [
                'key' => 'timezone',
                'value' => 'Asia/Jakarta',
            ],
            [
                'key' => 'date_format',
                'value' => 'd/m/Y',
            ],
            [
                'key' => 'system_version',
                'value' => '1.0.0',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
