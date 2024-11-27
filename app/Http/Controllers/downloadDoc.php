<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\UnitKerja;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Barryvdh\DomPDF\Facade\Pdf;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Alignment;

use Carbon\Carbon;

class downloadDoc extends Controller
{

    public function getUserData(){

        $user = Auth::user();
        $id = $user->id;
        $nip = $user->user_nip;
        $user_unit_id = $user->user_unit_id;
        $userUnitKerja = UnitKerja::find($user->user_unit_id);
        $roles = $user->roles;

        return compact('userUnitKerja', 'id', 'nip', 'roles','user_unit_id', 'userUnitKerja');
    }

    public function generatePDF(Request $req)
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $user_unit_id = $userData['user_unit_id'];
        $userUnitKerja = $userData['userUnitKerja'];
        $user_nip = $userData['nip'];
        $roles = $userData['roles'];

        $month = $req->query('month');
        $year = $req->query('year');
        Log::info('month: ' . $month . ', year: ' . $year);
        
        if (!$month || !is_numeric($month) || $month < 1 || $month > 12 ||
            !$year || !is_numeric($year) || $year < 2000 || $year > date('Y')) {
            return redirect()->back()->with('error', 'Silakan pilih bulan dan tahun yang valid.');
        }

        $query = DB::table('pengajuan')
            ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
            ->join('users', 'pengajuan.user_id', '=', 'users.id')
            ->join('unit_kerja', 'pegawai.pegawai_unit_id', '=', 'unit_kerja.unit_id')
            ->select(
                'pengajuan.*',
                'pegawai.nama as nama_pekerja',
                'pegawai.nip',
                'pegawai.by_id',
                'pegawai.jabatan',
                'pegawai.pegawai_unit_id',
                'pegawai.masa_kerja',
                'unit_kerja.unit_kerja as nama_unit_kerja',
                'users.name as oleh_user',
                'users.user_jabatan as oleh_jabatan',
                'users.user_nip as oleh_nip',
            )
            ->where('pegawai.pegawai_unit_id', $user_unit_id)
            // ->where('pegawai.by_id', $id)
            ->where('pengajuan.konfirmasi', 'diterima')
            ->whereRaw('MONTH(pengajuan.updated_at) = ?', [$month])
            ->whereRaw('YEAR(pengajuan.updated_at) = ?', [$year])
            ->orderBy('pengajuan.updated_at', 'asc');

        $blanko = $query->get();
        
        if ($blanko->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data untuk bulan dan tahun yang dipilih.');
        }        

        $firstRecord = $blanko->first();
        $reportDate = Carbon::parse($firstRecord->updated_at);
        $monthName = $reportDate->locale('id')->translatedFormat('F');
        $year = $reportDate->year;

        $pdf = PDF::loadView('download.rekapitulasi', compact('blanko', 'monthName', 'year'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'dpi' => 150,
            ]);

        return $pdf->download("rekapitulasi_{$monthName}_{$year}.pdf");
    }

    // public function generatePDF(Request $req)
    // {

    //     $userData = $this->getUserData();
    //     $asal = $userData['asal'];

    //     $query = DB::table('pengajuan')
    //         ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
    //         ->join('users', 'pengajuan.user_id', '=', 'users.id')
    //         ->select(
    //             'pengajuan.*',
    //             'pegawai.nama as nama_pekerja',
    //             'pegawai.nip',
    //             'pegawai.jabatan',
    //             'pegawai.unit_kerja as unit_kerja',
    //             'pegawai.masa_kerja',
    //             'users.name as oleh_user',
    //             'users.jabatan as oleh_jabatan',
    //             'users.asal as oleh_asal'
    //         );

    //     $blanko = $query->where('unit_kerja', $asal)->paginate(15);

    //     $html = view('download.rekapitulasi', compact('blanko'))->render();
        
    //     $pdf = PDF::loadHTML($html)
    //     ->setPaper('a4', 'landscape') // set ukuran khusus
    //     ->setOptions([
    //         'dpi' => 150, // Mengatur DPI sesuai ukuran 1 piksel = 1/96 inci
    //     ]);

    //     return $pdf->download('rekapitulasi.pdf');
    // }

    public function pengajuanSemua(Request $req)
    {
        return $this->generatePengajuanDoc('Semua Pengajuan', null);
    }

    public function pengajuanDitangguhkan(Request $req)
    {
        return $this->generatePengajuanDoc('Pengajuan Ditangguhkan', 'ditangguhkan');
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

        $query = DB::table('pengajuan')
            ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
            ->join('users', 'pengajuan.user_id', '=', 'users.id')
            ->join('unit_kerja', 'pegawai.pegawai_unit_id', '=', 'unit_kerja.unit_id')
            ->select(
                'pengajuan.*',
                'pegawai.nama as nama_pekerja',
                'pegawai.nip',
                'pegawai.jabatan',
                'pegawai.pegawai_unit_id',
                'pegawai.masa_kerja',
                'unit_kerja.unit_kerja as nama_unit_kerja',
                'users.name as oleh_user',
                'users.user_jabatan as oleh_jabatan',
                'users.user_nip as oleh_nip',
            );

        if ($status !== null) {
            $query->where('konfirmasi', $status);
        }

        $data = $query->get();

        $rowNumber = 1;
        foreach ($data as $row) {
            $table->addRow();
            $table->addCell($cellWidths[0], $styleCell)->addText($rowNumber++);
            $table->addCell($cellWidths[1], $styleCell)->addText($row->nama_pegawai);
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
