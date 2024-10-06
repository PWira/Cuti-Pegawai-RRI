<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id("bid");
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pegawai_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pegawai_id')->references('pid')->on('pegawai')->onDelete('cascade');
            $table->string('jenis_cuti');
            $table->date('mulai_cuti');
            $table->date('selesai_cuti');
            $table->text('alasan');
            $table->string('blanko_ditangguhkan');
            $table->text('sakit_ditangguhkan')->nullable();
            $table->text('blanko_diterima')->nullable();
            $table->text('blanko_ditolak')->nullable();
            $table->enum('konfirmasi', ['ditangguhkan', 'sakit', 'diterima', 'ditolak']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
