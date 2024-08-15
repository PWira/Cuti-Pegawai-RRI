<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function kirimPengajuan(Request $req){

        if ($req->hasFile('blanko')) {
            $file = $req->file('blanko');
    
            // Replace white spaces with underscores in the file name
            $filename = str_replace(' ', '_', $file->getClientOriginalName());

            // Store the file in the 'public/blanko_surat_cuti' directory with the original file name
            $path = $file->storeAs('public/blanko_surat_cuti', $filename);

            $tahun_kerja = $req->tahun_kerja;
            $bulan_kerja = $req->bulan_kerja;

            $total_bulan_kerja = ($tahun_kerja * 12) + $bulan_kerja;

            $pengajuan = DB::table("pengajuan")->insert([

                "nama_pekerja" => $req->nama_pekerja,
                "nip" => $req->nip,
                "jabatan" => $req->jabatan,
                "unit_kerja" => $req->unit_kerja,
                "masa_kerja" => $total_bulan_kerja,
                "jenis_cuti" => $req->jenis_cuti,
                "mulai_cuti" => $req->mulai_cuti,
                "selesai_cuti" => $req->selesai_cuti,
                "alasan" => $req->alasan,
                "blanko_surat_cuti" => $path,
                "created_at" => now()
            ]);
            return redirect('form')->with('success', 'Pengajuan berhasil dikirim.');
        }else {
            // Handle the case where no file was uploaded
            return redirect('form')->with('error', 'No file was uploaded.');
        } 
    }

    public function table(){
        return view ('table');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('home');
    }

}
