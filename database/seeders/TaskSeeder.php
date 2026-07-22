<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', '!=', 'admin')->get();
        
        $tasks = [
            [
                'title' => 'Follow up proposal PT Teknologi Maju',
                'description' => 'Hubungi klien untuk konfirmasi penerimaan proposal dan jadwal presentasi',
                'status' => 'pending',
            ],
            [
                'title' => 'Siapkan dokumen kontrak',
                'description' => 'Draft kontrak kerjasama untuk project ERP Implementation',
                'status' => 'in_progress',
            ],
            [
                'title' => 'Review invoice bulan ini',
                'description' => 'Periksa semua invoice yang belum dibayar dan follow up klien',
                'status' => 'completed',
            ],
            [
                'title' => 'Update pipeline leads',
                'description' => 'Update status semua leads di sistem CRM',
                'status' => 'pending',
            ],
            [
                'title' => 'Meeting weekly sales report',
                'description' => 'Presentasikan laporan penjualan mingguan kepada manager',
                'status' => 'in_progress',
            ],
            [
                'title' => 'Kunjungi klien CV Digital Solutions',
                'description' => 'Meeting onsite untuk diskusi requirement aplikasi mobile',
                'status' => 'pending',
            ],
            [
                'title' => 'Training produk baru',
                'description' => 'Ikuti training untuk layanan Cloud Migration Services',
                'status' => 'completed',
            ],
            [
                'title' => 'Prepare presentation deck',
                'description' => 'Siapkan materi presentasi untuk pitch ke calon klien baru',
                'status' => 'in_progress',
            ],
        ];

        foreach ($tasks as $task) {
            Task::create([
                'user_id' => $users->random()->id,
                'title' => $task['title'],
                'description' => $task['description'],
                'due_date' => now()->addDays(rand(1, 14)),
                'status' => $task['status'],
            ]);
        }
    }
}
