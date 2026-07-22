<?php

namespace Database\Seeders;

use App\Models\Proposal;
use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proposals = Proposal::where('status', 'accepted')->get();
        
        $invoiceStatuses = ['unpaid', 'partial', 'paid'];
        
        foreach ($proposals as $index => $proposal) {
            $status = $invoiceStatuses[$index % count($invoiceStatuses)];
            $minimumPayment = $proposal->total_amount * 0.3; // 30% minimum payment
            
            Invoice::create([
                'proposal_id' => $proposal->id,
                'invoice_number' => 'INV-' . date('Ymd') . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'total_amount' => $proposal->total_amount,
                'minimum_payment' => $minimumPayment,
                'status' => $status,
            ]);
        }
        
        // Add some additional invoices for variety
        $additionalProposals = Proposal::where('status', 'pending')->take(2)->get();
        
        foreach ($additionalProposals as $proposal) {
            Invoice::create([
                'proposal_id' => $proposal->id,
                'invoice_number' => 'INV-' . date('Ymd') . '-' . rand(100, 999),
                'total_amount' => $proposal->total_amount,
                'minimum_payment' => $proposal->total_amount * 0.3,
                'status' => 'unpaid',
            ]);
        }
    }
}
