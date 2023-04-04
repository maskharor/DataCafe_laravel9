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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id("id_transaksi");
            $table->foreignId("id_user");
            $table->foreignId("id_menu");
            $table->foreignId("id_meja");
            $table->string("nama_pelanggan");
            $table->integer("total_harga");
            $table->date("tgl_transaksi");
            $table->enum("status",['belum_bayar', 'lunas']);
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
        Schema::dropIfExists('transaksis');
    }
};
