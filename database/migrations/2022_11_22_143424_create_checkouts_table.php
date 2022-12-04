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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('produk_id');
            $table->string('user_id');
            $table->string('nama_merek');
            $table->string('warna');
            $table->string('size');
            $table->string('harga');
            $table->string('Desa');
            $table->string('Kecamatan');
            $table->string('Kabupaten');
            $table->string('Kode_pos');
            $table->string('hari');
            $table->string('bulan');
            $table->string('tahun');
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
        Schema::dropIfExists('checkouts');
    }
};
