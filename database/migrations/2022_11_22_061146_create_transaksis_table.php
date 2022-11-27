<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tamu_hotel');
            $table->string('email');
            $table->string('jumlah_orang');
            $table->string('jenis_fasilitas_kamar');
            $table->date('tanggal_reservasi');
            $table->date('tanggal_check_out');
            $table->string('jumlah_hari');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
