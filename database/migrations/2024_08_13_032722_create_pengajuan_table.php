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
            $table->enum('jenis_cuti', ['Cuti Tahunan', 'Cuti Sakit', 'Cuti Melahirkan','Cuti Karena Alasan Penting','Cuti Di Luar Tanggungan Negara']);
            $table->date('mulai_cuti');
            $table->date('selesai_cuti');
            $table->text('alasan');
            $table->text('blanko_surat_cuti');
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
