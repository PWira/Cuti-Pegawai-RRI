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
        $pengajuan = DB::table("pengajuan")->insert([

            "nama_pekerja" => $req->nama_pekerja,
            "nip" => $req->nip,
            "jabatan" => $req->jabatan,
            "unit_kerja" => $req->unit_kerja,
            "masa_kerja" => $req->masa_kerja,
            "jenis_cuti" => $req->jenis_cuti,
            "mulai_cuti" => $req->mulai_cuti,
            "selesai_cuti" => $req->selesai_cuti,
            "alasan" => $req->alasan,
            "created_at" => now()
        ]);
        return redirect('form')->with('success', 'Pengajuan berhasil dikirim.');
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
