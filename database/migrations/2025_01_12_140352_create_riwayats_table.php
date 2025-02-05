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
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_user_id');
            $table->foreign('data_user_id')->references('id')->on('data_users');
            $table->unsignedBigInteger('mobil_id');
            $table->foreign('mobil_id')->references('id')->on('mobils');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->float('biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};
