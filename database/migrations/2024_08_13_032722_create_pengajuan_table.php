<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pekerja');
            $table->string('nip');
            $table->string('jabatan');
            $table->string('unit_kerja');
            $table->integer('masa_kerja');
            $table->string('jenis_cuti');
            $table->date('mulai_cuti');
            $table->date('selesai_cuti');
            $table->text('alasan');
            $table->string('blanko_ditangguhkan');
            $table->text('sakit_ditangguhkan')->nullable();
            $table->text('blanko_diterima')->nullable();
            $table->text('blanko_ditolak')->nullable();
            $table->enum('konfirmasi',['ditangguhkan','sakit','diterima','ditolak']);
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
