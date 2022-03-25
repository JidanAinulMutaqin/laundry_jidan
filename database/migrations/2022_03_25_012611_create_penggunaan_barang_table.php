<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggunaan_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->double('qty');
            $table->double('harga');
            $table->dateTime('waktu_beli');
            $table->string('supplier');
            $table->enum('status', ['diajukan_beli', 'habis', 'tersedia']);
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
        Schema::dropIfExists('penggunaan_barang');
    }
}
