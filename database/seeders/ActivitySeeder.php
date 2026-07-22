<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leads = Lead::all();
        $users = User::where('role', 'agent')->get();
        
        $types = ['call', 'email', 'meeting'];
        
        $activities = [
            [
                'type' => 'call',
                'notes' => 'Diskusi awal mengenai kebutuhan sistem ERP klien',
            ],
            [
                'type' => 'email',
                'notes' => 'Mengirimkan proposal awal untuk review',
            ],
            [
                'type' => 'meeting',
                'notes' => 'Presentasi solusi teknis kepada tim IT klien',
            ],
            [
                'type' => 'call',
                'notes' => 'Follow up setelah pengiriman proposal',
            ],
            [
                'type' => 'meeting',
                'notes' => 'Negosiasi harga dan termin pembayaran',
            ],
            [
                'type' => 'email',
                'notes' => 'Mengirimkan revisi proposal sesuai permintaan klien',
            ],
            [
                'type' => 'call',
                'notes' => 'Konfirmasi kesepakatan dan下一步 action plan',
            ],
            [
                'type' => 'meeting',
                'notes' => 'Kick-off meeting untuk project yang sudah won',
            ],
            [
                'type' => 'email',
                'notes' => 'Mengirimkan dokumentasi teknis tambahan',
            ],
        ];

        foreach ($activities as $activity) {
            Activity::create([
                'lead_id' => $leads->random()->id,
                'user_id' => $users->random()->id,
                'type' => $activity['type'],
                'activity_date' => now()->subDays(rand(0, 30)),
                'notes' => $activity['notes'],
            ]);
        }
    }
}
