<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        
        $statuses = ['open', 'progress', 'closed'];
        $priorities = ['low', 'medium', 'high'];
        
        $tickets = [
            [
                'subject' => 'Error pada sistem login',
                'description' => 'Klien melaporkan tidak bisa login ke aplikasi sejak pagi ini',
            ],
            [
                'subject' => 'Request fitur export data',
                'description' => 'Klien meminta tambahan fitur untuk export laporan ke Excel',
            ],
            [
                'subject' => 'Performance issue dashboard',
                'description' => 'Dashboard loading sangat lambat ketika data banyak',
            ],
            [
                'subject' => 'Bug pada modul inventory',
                'description' => 'Stok tidak terupdate otomatis setelah transaksi penjualan',
            ],
            [
                'subject' => 'Integrasi payment gateway',
                'description' => 'Perlu integrasi dengan payment gateway baru (OVO/Dana)',
            ],
            [
                'subject' => 'Training user baru',
                'description' => 'Klien meminta training untuk 5 user baru yang akan menggunakan sistem',
            ],
            [
                'subject' => 'Data migration dari sistem lama',
                'description' => 'Bantuan migrasi data dari sistem legacy ke sistem baru',
            ],
            [
                'subject' => 'Custom report development',
                'description' => 'Pembuatan laporan custom sesuai kebutuhan manajemen klien',
            ],
        ];

        foreach ($tickets as $index => $ticket) {
            Ticket::create([
                'client_id' => $clients->random()->id,
                'subject' => $ticket['subject'],
                'description' => $ticket['description'],
                'status' => $statuses[$index % count($statuses)],
                'priority' => $priorities[$index % count($priorities)],
            ]);
        }
    }
}
