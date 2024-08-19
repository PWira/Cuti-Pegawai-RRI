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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pengajuanCuti()
    {
        $user = Auth::user();

        $blanko = DB::table('pengajuan')->where('unit_kerja', $user->unit_kerja)->paginate(15);
        $admin_blanko = DB::table('pengajuan')->paginate(15);
        $konfirmasi = DB::table('pengajuan')->where('konfirmasi','ditangguhkan')->get();

        return view('pages.table', compact('blanko'))
        ->with('admin_blanko',$admin_blanko)
        ->with('konfirmasi',$konfirmasi)
        // ->with()
        ;
    }

    public function cutiDitolak()
    {
        $user = Auth::user();

        $blanko = DB::table('pengajuan')->where('unit_kerja', $user->unit_kerja)->paginate(15);
        $admin_blanko = DB::table('pengajuan')->paginate(15);
        $konfirmasi = DB::table('pengajuan')->where('konfirmasi','ditolak')->get();

        return view('pages.table', compact('blanko'))
        ->with('admin_blanko',$admin_blanko)
        ->with('konfirmasi',$konfirmasi)
        // ->with()
        ;
    }

    public function cutiDiterima()
    {
        $user = Auth::user();

        $blanko = DB::table('pengajuan')->where('unit_kerja', $user->unit_kerja)->paginate(15);
        $admin_blanko = DB::table('pengajuan')->paginate(15);
        $konfirmasi = DB::table('pengajuan')->where('konfirmasi','diterima')->get();

        return view('pages.table', compact('blanko'))
        ->with('admin_blanko',$admin_blanko)
        ->with('konfirmasi',$konfirmasi)
        // ->with()
        ;
    }

    public function pegawaiAktif()
    {
        $user = Auth::user();

        $blanko = DB::table('pegawai')->where('unit_kerja', $user->unit_kerja)->paginate(15);
        $admin_blanko = DB::table('pegawai')->paginate(15);
        $konfirmasi = DB::table('pegawai')->where('status','aktif')->get();

        return view('pages.table', compact('blanko'))
        ->with('admin_blanko',$admin_blanko)
        ->with('konfirmasi',$konfirmasi)
        // ->with()
        ;
    }

    public function pegawaiCuti()
    {
        $user = Auth::user();

        $blanko = DB::table('pegawai')->where('unit_kerja', $user->unit_kerja)->paginate(15);
        $admin_blanko = DB::table('pegawai')->paginate(15);
        $konfirmasi = DB::table('pegawai')->where('status','cuti')->get();

        return view('pages.table', compact('blanko'))
        ->with('admin_blanko',$admin_blanko)
        ->with('konfirmasi',$konfirmasi)
        // ->with()
        ;
    }

    public function kirimPengajuan(Request $req){

        if ($req->hasFile('blanko_ditangguhkan')) {
            $file = $req->file('blanko_ditangguhkan');
            $fileName = time() . '_' . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $path = public_path('blanko_ditangguhkan');
    
            // Pastikan direktori ada
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
    
            // Pindahkan file
            $file->move($path.'/ditangguhkan', $fileName);
            $filePath = 'blanko/ditangguhkan/' . $fileName;
    
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
                "blanko_ditangguhkan" => $filePath,
                "created_at" => now()
            ]);
    
            return redirect('table-pengajuan')->with('success', 'Pengajuan berhasil dikirim.');
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

    public function hapusPengajuan($id){
        DB::table("pengajuan")->where('id','=',$id)->delete();

        return redirect('table-pengajuan');
    }
}
