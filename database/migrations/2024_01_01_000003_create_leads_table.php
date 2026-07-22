<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Sales agent handling this lead
            $table->string('title');
            $table->enum('status', ['new', 'contacted', 'proposal', 'negotiation', 'won', 'lost'])->default('new');
            $table->decimal('expected_value', 15, 2)->nullable();
            $table->date('expected_close_date')->nullable();
            $table->text('description')->nullable();
            $table->text('source')->nullable(); // How the lead came in
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
