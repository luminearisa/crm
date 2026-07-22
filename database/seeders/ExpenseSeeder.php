<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'agent')->get();
        
        $categories = ['transportation', 'accommodation', 'meals', 'entertainment', 'office_supplies', 'others'];
        
        $expenses = [
            [
                'amount' => 150000,
                'category' => 'transportation',
                'description' => 'Transportasi meeting ke kantor klien PT Teknologi Maju',
            ],
            [
                'amount' => 750000,
                'category' => 'accommodation',
                'description' => 'Hotel untuk kunjungan klien di Surabaya',
            ],
            [
                'amount' => 250000,
                'category' => 'meals',
                'description' => 'Makan siang dengan klien CV Digital Solutions',
            ],
            [
                'amount' => 500000,
                'category' => 'entertainment',
                'description' => 'Client dinner dengan PT Mitra Sejahtera',
            ],
            [
                'amount' => 125000,
                'category' => 'transportation',
                'description' => 'Bensin dan toll untuk site visit ke Bandung',
            ],
            [
                'amount' => 350000,
                'category' => 'office_supplies',
                'description' => 'Print proposal dan dokumen presentasi',
            ],
            [
                'amount' => 180000,
                'category' => 'meals',
                'description' => 'Makan tim selama meeting marathon',
            ],
            [
                'amount' => 450000,
                'category' => 'transportation',
                'description' => 'Taksi online untuk multiple client visits',
            ],
            [
                'amount' => 200000,
                'category' => 'others',
                'description' => 'Printing merchandise untuk client gift',
            ],
        ];

        foreach ($expenses as $expense) {
            Expense::create([
                'user_id' => $users->random()->id,
                'amount' => $expense['amount'],
                'category' => $expense['category'],
                'date' => now()->subDays(rand(0, 30)),
                'description' => $expense['description'],
            ]);
        }
    }
}
