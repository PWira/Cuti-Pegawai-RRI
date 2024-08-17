<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function lihatFile()
    {
        $user = Auth::user();

        $blanko = DB::table('pengajuan')->where('unit_kerja', $user->unit_kerja)->get();
        $admin_blanko = DB::table('pengajuan')->get();

        return view('pages.table', compact('blanko'))
        ->with('admin_blanko',$admin_blanko)
        // ->with()
        ;
    }

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
            $fileName = time() . '_' . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $path = public_path('blanko');
    
            // Pastikan direktori ada
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
    
            // Pindahkan file
            $file->move($path, $fileName);
            $filePath = 'blanko/' . $fileName;
    
            $tahun_kerja = $req->tahun_kerja;
            $bulan_kerja = $req->bulan_kerja;
            $total_bulan_kerja = ($tahun_kerja * 12) + $bulan_kerja;
    
            $unitcase = Str::lower($req->unit_kerja);
    
            $pengajuan = DB::table("pengajuan")->insert([
                "nama_pekerja" => $req->nama_pekerja,
                "nip" => $req->nip,
                "jabatan" => $req->jabatan,
                "unit_kerja" => $unitcase,
                "masa_kerja" => $total_bulan_kerja,
                "jenis_cuti" => $req->jenis_cuti,
                "mulai_cuti" => $req->mulai_cuti,
                "selesai_cuti" => $req->selesai_cuti,
                "alasan" => $req->alasan,
                "blanko" => $filePath,
                "created_at" => now()
            ]);
    
            return redirect('form')->with('success', 'Pengajuan berhasil dikirim.');
        } else {
            return redirect('form')->with('error', 'File blanko harus diunggah.');
        }
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $user = Auth::user();
        return view('home');
    }

}
