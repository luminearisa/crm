<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', '!=', 'admin')->get();
        
        $events = [
            [
                'title' => 'Meeting dengan PT Teknologi Maju',
                'location' => 'Kantor Klien - Jakarta Pusat',
                'duration_hours' => 2,
            ],
            [
                'title' => 'Presentasi Proposal ERP',
                'location' => 'Office Meeting Room A',
                'duration_hours' => 1.5,
            ],
            [
                'title' => 'Training Internal - Cloud Services',
                'location' => 'Online Zoom',
                'duration_hours' => 3,
            ],
            [
                'title' => 'Weekly Sales Review',
                'location' => 'Office Conference Room',
                'duration_hours' => 1,
            ],
            [
                'title' => 'Kunjungan Site CV Digital Solutions',
                'location' => 'Bandung',
                'duration_hours' => 4,
            ],
            [
                'title' => 'Negosiasi Kontrak PT Mitra Sejahtera',
                'location' => 'Kantor Klien - Surabaya',
                'duration_hours' => 2,
            ],
            [
                'title' => 'Product Launch Event',
                'location' => 'Hotel Grand Indonesia',
                'duration_hours' => 5,
            ],
            [
                'title' => 'Client Appreciation Dinner',
                'location' => 'Restaurant Plataran',
                'duration_hours' => 3,
            ],
        ];

        foreach ($events as $event) {
            $startTime = now()->addDays(rand(0, 14))->setHour(rand(9, 16))->setMinute(0);
            $endTime = $startTime->copy()->addHours($event['duration_hours']);
            
            Event::create([
                'user_id' => $users->random()->id,
                'title' => $event['title'],
                'start_time' => $startTime,
                'end_time' => $endTime,
                'location' => $event['location'],
            ]);
        }
    }
}
