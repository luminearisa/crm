<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        $users = User::where('role', 'agent')->get();
        
        $statuses = ['new', 'contacted', 'proposal', 'negotiation', 'won', 'lost'];
        
        $leads = [
            [
                'title' => 'Implementasi Sistem ERP',
                'expected_value' => 150000000,
                'status' => 'proposal',
            ],
            [
                'title' => 'Pengembangan Website E-Commerce',
                'expected_value' => 75000000,
                'status' => 'negotiation',
            ],
            [
                'title' => 'Aplikasi Mobile Android & iOS',
                'expected_value' => 120000000,
                'status' => 'won',
            ],
            [
                'title' => 'Konsultasi Digital Marketing',
                'expected_value' => 25000000,
                'status' => 'contacted',
            ],
            [
                'title' => 'Sistem Manajemen Inventory',
                'expected_value' => 85000000,
                'status' => 'new',
            ],
            [
                'title' => 'Cloud Migration Services',
                'expected_value' => 95000000,
                'status' => 'proposal',
            ],
            [
                'title' => 'Training & Workshop IT',
                'expected_value' => 15000000,
                'status' => 'won',
            ],
            [
                'title' => 'Security Audit & Penetration Testing',
                'expected_value' => 45000000,
                'status' => 'lost',
            ],
            [
                'title' => 'Custom CRM Development',
                'expected_value' => 180000000,
                'status' => 'negotiation',
            ],
            [
                'title' => 'Data Analytics Dashboard',
                'expected_value' => 65000000,
                'status' => 'contacted',
            ],
        ];

        foreach ($leads as $lead) {
            Lead::create([
                'client_id' => $clients->random()->id,
                'user_id' => $users->random()->id,
                'title' => $lead['title'],
                'expected_value' => $lead['expected_value'],
                'status' => $lead['status'],
            ]);
        }
    }
}
