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
            $table->string('nama', 50);
            $table->string('nip', 20)->unique();
            $table->enum('jk',['laki_laki','perempuan']);
            $table->integer('umur')->length(2);
            $table->string('jabatan', 50);
            $table->unsignedBigInteger('pegawai_unit_id');
            $table->foreign('pegawai_unit_id')->references('unit_id')->on('unit_kerja');
            $table->integer('masa_kerja')->length(5);
            $table->unsignedBigInteger('by_id')->nullable();
            $table->foreign('by_id')->references('id')->on('users');
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
