<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Web Development',
                'description' => 'Pengembangan website custom dengan teknologi terbaru',
                'base_price' => 50000000,
                'is_active' => true,
            ],
            [
                'name' => 'Mobile App Development',
                'description' => 'Pengembangan aplikasi mobile untuk Android dan iOS',
                'base_price' => 75000000,
                'is_active' => true,
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Desain antarmuka dan pengalaman pengguna yang optimal',
                'base_price' => 15000000,
                'is_active' => true,
            ],
            [
                'name' => 'Cloud Services',
                'description' => 'Layanan cloud hosting dan migration',
                'base_price' => 25000000,
                'is_active' => true,
            ],
            [
                'name' => 'Digital Marketing',
                'description' => 'Strategi dan implementasi pemasaran digital',
                'base_price' => 10000000,
                'is_active' => true,
            ],
            [
                'name' => 'IT Consulting',
                'description' => 'Konsultasi teknologi informasi dan transformasi digital',
                'base_price' => 5000000,
                'is_active' => true,
            ],
            [
                'name' => 'Security Audit',
                'description' => 'Audit keamanan sistem dan penetration testing',
                'base_price' => 30000000,
                'is_active' => true,
            ],
            [
                'name' => 'Data Analytics',
                'description' => 'Analisis data dan pembuatan dashboard bisnis intelligence',
                'base_price' => 40000000,
                'is_active' => true,
            ],
            [
                'name' => 'ERP Implementation',
                'description' => 'Implementasi sistem Enterprise Resource Planning',
                'base_price' => 100000000,
                'is_active' => true,
            ],
            [
                'name' => 'Training & Workshop',
                'description' => 'Pelatihan dan workshop teknologi untuk tim IT',
                'base_price' => 7500000,
                'is_active' => true,
            ],
            [
                'name' => 'Maintenance & Support',
                'description' => 'Layanan pemeliharaan dan dukungan teknis bulanan',
                'base_price' => 5000000,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
