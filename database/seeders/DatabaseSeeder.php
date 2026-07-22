<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan seeder penting karena ada relasi foreign key
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            ServiceSeeder::class,
            ClientSeeder::class,
            LeadSeeder::class,
            ActivitySeeder::class,
            ProposalSeeder::class,
            InvoiceSeeder::class,
            TaskSeeder::class,
            EventSeeder::class,
            TicketSeeder::class,
            DocumentSeeder::class,
            ExpenseSeeder::class,
        ]);
    }
}
