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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengembalian');
            $table->integer('biaya_sewa');
            $table->unsignedBigInteger('pinjaman_id');
            $table->foreign('pinjaman_id')->references('id')->on('pinjamen');
            $table->unsignedBigInteger('data_user_id');
            $table->foreign('data_user_id')->references('id')->on('data_users');
            $table->unsignedBigInteger('mobil_id');
            $table->foreign('mobil_id')->references('id')->on('mobils');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
