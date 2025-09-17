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
        Schema::create('jadwal_sholat_harian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_masjid', 36);
            $table->string('alamat', 75);
            $table->string('img');
            $table->string('adzan');
            $table->string('pesan1', 150);
            $table->string('pesan2', 150);
            $table->integer('id_kota');
            $table->string('url')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_sholat_harian');
    }
};
