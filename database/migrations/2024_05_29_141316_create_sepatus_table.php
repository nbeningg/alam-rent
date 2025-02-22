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
        Schema::create('sepatus', function (Blueprint $table) {
            $table->id();
            $table->text('gambar'); // untuk menyimpan gambar sepatu
            $table->string('merk'); // untuk menyimpan merk sepatu
            $table->string('slug'); // untuk menyimpan merk sepatu
            $table->decimal('harga', 8, 2); // untuk menyimpan harga sepatu dengan total 8 digit dan 2 digit desimal
            $table->decimal('denda', 8, 2); // untuk menyimpan denda dengan total 8 digit dan 2 digit desimal
            $table->text('deskripsi'); // untuk menyimpan deskripsi sepatu
            $table->boolean('status')->default(true); // untuk menyimpan status ketersediaan (true = tersedia, false = tidak tersedia)
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sepatus');
    }
};
