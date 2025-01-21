<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('name');  
            $table->decimal('nominal', 10, 2);  
            $table->date('date');  
            $table->string('description')->nullable(); // Menambahkan kolom description  
            $table->string('transfer_proof')->nullable(); 
            $table->string('status')->default('pending');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
