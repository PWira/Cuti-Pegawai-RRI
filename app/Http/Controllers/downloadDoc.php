<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Alignment;

use Carbon\Carbon;

class downloadDoc extends Controller
{

    public function pengajuanSemua(Request $req)
    {
        return $this->generatePengajuanDoc('Semua Pengajuan', null);
    }

    public function pengajuanDiterima(Request $req)
    {
        return $this->generatePengajuanDoc('Pengajuan Diterima', 'diterima');
    }

    public function pengajuanDitolak(Request $req)
    {
        return $this->generatePengajuanDoc('Pengajuan Ditolak', 'ditolak');
    }

    private function generatePengajuanDoc($title, $status = null)
    {
        $phpWord = new PhpWord();

        $section = $phpWord->addSection([
            'orientation' => 'landscape',
            'marginLeft' => 600,
            'marginRight' => 600,
            'marginTop' => 600,
            'marginBottom' => 600,
        ]);

        $section->addText($title, ['bold' => true, 'size' => 16], ['alignment' => 'center']);
        $section->addTextBreak(1);

        $styleTable = ['borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80];
        $styleCell = ['valign' => 'center'];
        $styleFirstRow = ['bgColor' => '6666FF'];

        $table = $section->addTable($styleTable);
        $table->addRow(900, $styleFirstRow);

        $cellWidths = [500, 2000, 2000, 1800, 1500, 1500, 1800, 1500, 1500];

        $headers = ['No', 'Nama Pekerja', 'NIP', 'Jabatan', 'Unit Kerja', 'Masa Kerja', 'Jenis Cuti', 'Tanggal Diajukan', 'Status'];
        foreach ($headers as $index => $header) {
            $table->addCell($cellWidths[$index], $styleCell)->addText($header, ['bold' => true]);
        }

        $query = DB::table('pengajuan');
        if ($status !== null) {
            $query->where('konfirmasi', $status);
        }
        $data = $query->get();

        $rowNumber = 1;
        foreach ($data as $row) {
            $table->addRow();
            $table->addCell($cellWidths[0], $styleCell)->addText($rowNumber++);
            $table->addCell($cellWidths[1], $styleCell)->addText($row->nama_pekerja);
            $table->addCell($cellWidths[2], $styleCell)->addText($row->nip);
            $table->addCell($cellWidths[3], $styleCell)->addText($row->jabatan);
            $table->addCell($cellWidths[4], $styleCell)->addText($row->unit_kerja);
            $table->addCell($cellWidths[5], $styleCell)->addText($this->formatMasaKerja($row->masa_kerja));
            $table->addCell($cellWidths[6], $styleCell)->addText($row->jenis_cuti);
            $table->addCell($cellWidths[7], $styleCell)->addText($this->formatTanggal($row->created_at));
            $table->addCell($cellWidths[8], $styleCell)->addText($row->konfirmasi);
        }

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $fileName = $title . '-' . date('F-Y') . '.docx';
        $objWriter->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }

    private function formatMasaKerja($bulan)
    {
        $tahun = floor($bulan / 12);
        $sisaBulan = $bulan % 12;
        
        if ($tahun > 0 && $sisaBulan > 0) {
            return "$tahun tahun $sisaBulan bulan";
        } elseif ($tahun > 0) {
            return "$tahun tahun";
        } else {
            return "$sisaBulan bulan";
        }
    }

    private function formatTanggal($tanggal)
    {
        return Carbon::parse($tanggal)->format('Y-m-d');
    }

    public function dataPegawai(Request $req)
    {
        $phpWord = new PhpWord();

        $section = $phpWord->addSection([
            'orientation' => 'landscape',
            'marginLeft' => 600,
            'marginRight' => 600,
            'marginTop' => 600,
            'marginBottom' => 600,
        ]);

        $section->addText('Data Pegawai', ['bold' => true, 'size' => 16], ['alignment' => 'center']);
        $section->addTextBreak(1);

        $styleTable = ['borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80];
        $styleCell = ['valign' => 'center'];
        $styleFirstRow = ['bgColor' => '6666FF'];

        $table = $section->addTable($styleTable);
        $table->addRow(900, $styleFirstRow);

        $cellWidths = [500, 2500, 1500, 2000, 2000, 2000];

        $headers = ['No', 'Nama Pekerja', 'NIP', 'Jabatan', 'Unit Kerja', 'Masa Kerja'];
        foreach ($headers as $index => $header) {
            $table->addCell($cellWidths[$index], $styleCell)->addText($header, ['bold' => true]);
        }

        $data = DB::table('pegawai')->get(); // Ganti 'pegawai' dengan nama tabel yang sesuai

        $rowNumber = 1;
        foreach ($data as $row) {
            $table->addRow();
            $table->addCell($cellWidths[0], $styleCell)->addText($rowNumber++);
            $table->addCell($cellWidths[1], $styleCell)->addText($row->nama);
            $table->addCell($cellWidths[2], $styleCell)->addText($row->nip);
            $table->addCell($cellWidths[3], $styleCell)->addText($row->jabatan);
            $table->addCell($cellWidths[4], $styleCell)->addText($row->unit_kerja);
            $table->addCell($cellWidths[5], $styleCell)->addText($this->formatMasaKerja($row->masa_kerja));
        }

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $fileName = 'Data-Pegawai-' . date('F-Y') . '.docx';
        $objWriter->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
