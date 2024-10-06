<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id("pid");
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama');
            $table->enum('jk',['laki_laki','perempuan']);
            $table->integer('umur');
            $table->enum('status',['belum_menikah','sudah_menikah','cerai_hidup','cerai_mati']);
            $table->string('nip')->unique();
            $table->string('jabatan');
            $table->string('unit_kerja');
            $table->integer('masa_kerja');
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
        Schema::dropIfExists('data_pegawai');
    }
};
