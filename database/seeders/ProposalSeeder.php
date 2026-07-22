<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Proposal;
use App\Models\ProposalItem;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leads = Lead::where('status', '!=', 'lost')->get();
        $services = Service::where('is_active', true)->get();
        
        $proposalsData = [
            ['status' => 'draft'],
            ['status' => 'sent'],
            ['status' => 'accepted'],
            ['status' => 'pending'],
            ['status' => 'rejected'],
        ];

        foreach ($proposalsData as $index => $data) {
            if ($leads->isEmpty()) {
                break;
            }
            
            $lead = $leads->random();
            
            $proposal = Proposal::create([
                'lead_id' => $lead->id,
                'status' => $data['status'],
                'total_amount' => 0,
            ]);
            
            // Add 2-4 items to each proposal
            $itemsCount = rand(2, 4);
            $selectedServices = $services->random(min($itemsCount, $services->count()));
            
            $totalAmount = 0;
            
            foreach ($selectedServices as $service) {
                $qty = rand(1, 3);
                $price = $service->base_price;
                $subtotal = $qty * $price;
                $totalAmount += $subtotal;
                
                ProposalItem::create([
                    'proposal_id' => $proposal->id,
                    'service_id' => $service->id,
                    'qty' => $qty,
                    'price' => $price,
                ]);
            }
            
            // Update total amount
            $proposal->update(['total_amount' => $totalAmount]);
        }
    }
}
