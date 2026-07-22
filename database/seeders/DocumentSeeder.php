<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Document;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        
        $types = ['contract', 'nda', 'other'];
        
        $documents = [
            [
                'title' => 'Kontrak Kerjasama PT Teknologi Maju',
                'type' => 'contract',
            ],
            [
                'title' => 'NDA CV Digital Solutions',
                'type' => 'nda',
            ],
            [
                'title' => 'Addendum Kontrak PT Mitra Sejahtera',
                'type' => 'contract',
            ],
            [
                'title' => 'Dokumen Requirement UD Berkah Jaya',
                'type' => 'other',
            ],
            [
                'title' => 'Perjanjian Kerjasama PT Global Investama',
                'type' => 'contract',
            ],
            [
                'title' => 'NDA PT Innovate Indonesia',
                'type' => 'nda',
            ],
            [
                'title' => 'Technical Specification Document',
                'type' => 'other',
            ],
            [
                'title' => 'Service Level Agreement',
                'type' => 'other',
            ],
        ];

        foreach ($documents as $doc) {
            // Generate a fake file path (in real app, this would be actual uploaded file)
            $fileName = Str::slug($doc['title']) . '.pdf';
            $filePath = 'documents/' . date('Y/m') . '/' . $fileName;
            
            Document::create([
                'client_id' => $clients->random()->id,
                'title' => $doc['title'],
                'file_path' => $filePath,
                'type' => $doc['type'],
            ]);
        }
    }
}
