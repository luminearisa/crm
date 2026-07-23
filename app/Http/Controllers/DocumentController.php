<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $query = Document::with('client');
        
        // Agent hanya lihat dokumen dari client mereka
        if (auth()->user()->role === 'agent') {
            $query->whereHas('client', function($q) {
                $q->where('user_id', auth()->id());
            });
        }
        
        $documents = $query->latest()->paginate(15);
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('documents.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:contract,nda,other',
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        // Upload file
        $filePath = $request->file('file')->store('documents', 'public');
        $validated['file_path'] = $filePath;

        Document::create($validated);

        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil diupload.');
    }

    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        $clients = Client::all();
        return view('documents.edit', compact('document', 'clients'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:contract,nda,other',
            'file' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('public')->delete($document->file_path);
            
            // Upload new file
            $validated['file_path'] = $request->file('file')->store('documents', 'public');
        }

        $document->update($validated);

        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(Document $document)
    {
        // Delete file
        Storage::disk('public')->delete($document->file_path);
        
        $document->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil dihapus.');
    }

    public function download(Document $document)
    {
        return Storage::disk('public')->download($document->file_path);
    }
}
