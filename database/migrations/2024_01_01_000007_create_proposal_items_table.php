<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposal_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->integer('qty')->default(1);
            $table->decimal('price', 15, 2)->default(0); // Price per unit at the time of proposal
            $table->decimal('subtotal', 15, 2)->default(0); // qty * price
            $table->text('description')->nullable(); // Custom description for this item
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposal_items');
    }
};
