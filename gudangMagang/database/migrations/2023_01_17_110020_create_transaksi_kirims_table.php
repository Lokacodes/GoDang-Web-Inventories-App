<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiKirimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_kirims', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengiriman')->nullable();
            $table->date('tanggal_transaksi')->nullable();
            $table->string('nama_pelanggan')->nullable();
            $table->string('alamat_pelanggan')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('catatan')->nullable();
            $table->string('kode_ekspedisi')->nullable();
            $table->string('berat_total')->nullable();
            $table->string('beli_total')->nullable();
            $table->string('harga_total')->nullable();
            $table->string('ongkir')->nullable();
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
        Schema::dropIfExists('transaksi_kirims');
    }
}
