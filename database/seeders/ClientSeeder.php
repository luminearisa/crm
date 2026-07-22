<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'agent')->get();
        
        $clients = [
            [
                'company_name' => 'PT Teknologi Maju',
                'contact_person' => 'Budi Santoso',
                'email' => 'budi@tekmaju.com',
                'phone' => '+62 812-3456-7890',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            ],
            [
                'company_name' => 'CV Digital Solutions',
                'contact_person' => 'Siti Nurhaliza',
                'email' => 'siti@digitalsol.co.id',
                'phone' => '+62 813-4567-8901',
                'address' => 'Jl. Gatot Subroto No. 45, Bandung',
            ],
            [
                'company_name' => 'PT Mitra Sejahtera',
                'contact_person' => 'Ahmad Wijaya',
                'email' => 'ahmad@mitrasej.com',
                'phone' => '+62 814-5678-9012',
                'address' => 'Jl. Ahmad Yani No. 78, Surabaya',
            ],
            [
                'company_name' => 'UD Berkah Jaya',
                'contact_person' => 'Dewi Lestari',
                'email' => 'dewi@berkahjaya.com',
                'phone' => '+62 815-6789-0123',
                'address' => 'Jl. Diponegoro No. 56, Yogyakarta',
            ],
            [
                'company_name' => 'PT Global Investama',
                'contact_person' => 'Rudi Hartono',
                'email' => 'rudi@globalinvest.com',
                'phone' => '+62 816-7890-1234',
                'address' => 'Jl. HR Rasuna Said No. 90, Medan',
            ],
            [
                'company_name' => 'CV Sumber Rezeki',
                'contact_person' => 'Maya Kusuma',
                'email' => 'maya@sumberrezeki.com',
                'phone' => '+62 817-8901-2345',
                'address' => 'Jl. Pemuda No. 34, Semarang',
            ],
            [
                'company_name' => 'PT Innovate Indonesia',
                'contact_person' => 'Andi Pratama',
                'email' => 'andi@innovate.id',
                'phone' => '+62 818-9012-3456',
                'address' => 'Jl. Jend. Sudirman No. 67, Makassar',
            ],
            [
                'company_name' => 'UD Sentosa Abadi',
                'contact_person' => 'Linda Wulandari',
                'email' => 'linda@sentosaabadi.com',
                'phone' => '+62 819-0123-4567',
                'address' => 'Jl. Basuki Rahmat No. 89, Balikpapan',
            ],
        ];

        foreach ($clients as $index => $client) {
            Client::create([
                'user_id' => $users->random()->id,
                'company_name' => $client['company_name'],
                'contact_person' => $client['contact_person'],
                'email' => $client['email'],
                'phone' => $client['phone'],
                'address' => $client['address'],
            ]);
        }
    }
}
