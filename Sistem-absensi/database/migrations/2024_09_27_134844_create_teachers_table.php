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
        Schema::create('teachers', function (Blueprint $table) {
              Schema::create('teachers', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->string('name');  // Nama guru
            $table->string('email')->unique();  // Email guru, harus unik
            $table->string('subject');  // Mata pelajaran yang diajarkan
            $table->timestamps();  // Kolom created_at dan updated_at
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};