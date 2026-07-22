<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Uploaded by
            $table->string('title');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_mime_type')->nullable();
            $table->integer('file_size')->nullable(); // in bytes
            $table->enum('type', ['contract', 'nda', 'proposal', 'invoice', 'other'])->default('other');
            $table->text('description')->nullable();
            $table->date('expiry_date')->nullable(); // For contracts/NDAs
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
