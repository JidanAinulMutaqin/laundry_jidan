<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
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
            $table->foreignId('id_outlet')->constrained('outlet')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_member')->constrained('member')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->char('kode_invoice', 100);
            $table->date('tgl');
            $table->date('deadline');
            $table->date('tgl_bayar')->nullable();
            $table->double('biaya_tambahan');
            $table->double('diskon');
            $table->enum('jenis_diskon', ['nominal', 'persen'])->nullable();
            $table->integer('pajak');
            $table->integer('total');
            $table->integer('subtotal');
            $table->enum('status', ['baru', 'proses', 'selesai', 'diambil']);
            $table->enum('status_pembayaran', ['dibayar', 'belum_dibayar']);
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
}
