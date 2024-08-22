<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    public function daftarPegawai(Request $req){
    
        $tahun_kerja = $req->tahun_kerja;
        $bulan_kerja = $req->bulan_kerja;
        $total_bulan_kerja = ($tahun_kerja * 12) + $bulan_kerja;
    
        $unitcase = Str::lower($req->unit_kerja);
    
        $daftar = DB::table("pegawai")->insert([
            "nama" => $req->nama_pekerja,
            "nip" => $req->nip,
            "jabatan" => $req->jabatan,
            "unit_kerja" => $unitcase,
            "masa_kerja" => $total_bulan_kerja,
            "created_at" => now()
        ]);
    
        return redirect('pegawai')->with('success', 'Pengajuan berhasil dikirim.');
    }
    
    public function pengajuanCuti()
    {
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'admin') {
            $blanko = DB::table('pengajuan')->paginate(15);
        } elseif ($role === 'user' || $role === 'superuser') {
            $blanko = DB::table('pengajuan')->where('unit_kerja', $user->asal)->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }
        $konfirmasi = DB::table('pengajuan')->where('konfirmasi','ditangguhkan')->get();

        return view('pages.pengajuan', compact('blanko', 'konfirmasi','role'));
    }

    public function cutiDitolak()
    {
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'admin') {
            $blanko = DB::table('pengajuan')->paginate(15);
        } elseif ($role === 'user' || $role === 'superuser') {
            $blanko = DB::table('pengajuan')->where('unit_kerja', $user->asal)->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }
        $konfirmasi = DB::table('pengajuan')->where('konfirmasi','ditolak')->get();

        return view('pages.pengajuan', compact('blanko', 'konfirmasi','role'));
    }

    public function cutiDiterima()
    {
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'admin') {
            $blanko = DB::table('pengajuan')->paginate(15);
        } elseif ($role === 'user' || $role === 'superuser') {
            $blanko = DB::table('pengajuan')->where('unit_kerja', $user->asal)->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }
        $konfirmasi = DB::table('pengajuan')->where('konfirmasi','diterima')->get();

        return view('pages.pengajuan', compact('blanko', 'konfirmasi','role'));
    }

    public function pegawai()
    {
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'admin') {
            $blanko = DB::table('pegawai')->paginate(15);
        } elseif ($role === 'user' || $role === 'superuser') {
            $blanko = DB::table('pegawai')->where('unit_kerja', $user->asal)->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }
        // $blanko = DB::table('pegawai')->where('unit_kerja', $user->asal)->paginate(15);

        return view('pages.tabel_pegawai', compact('blanko' ,'role'));
    }

    public function form()
    {
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'admin') {
            $blanko = DB::table('pegawai')->paginate(15);
        } elseif ($role === 'user' || $role === 'superuser') {
            $blanko = DB::table('pegawai')->where('unit_kerja', $user->asal)->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }
        // $blanko = DB::table('pegawai')->where('unit_kerja', $user->asal)->paginate(15);

        return view('pages.form', compact('blanko' ,'role'));
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
            $file->move($path, $fileName);
            $filePath = 'blanko_ditangguhkan/' . $fileName;
    
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

    public function responCuti(Request $req){

        // Log::info('Request data: ' . json_encode($req->all()));

        $req->validate([
            'file' => 'required|mimes:pdf|max:8192',
            'status' => 'required|in:diterima,ditolak',
            'id' => 'required|exists:pengajuan,id',
        ]);
    
        $file = $req->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        if ($req->input('status') === 'diterima') {
            $filePath = 'blanko_diterima/' . $fileName;
            $file->move(public_path('blanko_diterima'), $fileName);
        } else {
            $filePath = 'blanko_ditolak/' . $fileName;
            $file->move(public_path('blanko_ditolak'), $fileName);
        }
    
        // Update the appropriate column in the database
        DB::table('pengajuan')->where('id', $req->input('id'))->update(['konfirmasi' => $req->input('status'), 
        $req->input('status') === 'diterima' ? 'blanko_diterima' : 'blanko_ditolak' => $filePath],
        );    
    
        return response()->json(['message' => 'File uploaded successfully.']);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
    
        if ($role === 'admin') {
            $pegawai = DB::table('pegawai')
                ->select('unit_kerja', DB::raw('count(*) as total'))
                ->groupBy('unit_kerja')
                ->get();
    
            $surat = DB::table('pengajuan')
                ->select('konfirmasi', DB::raw('count(*) as total'))
                ->groupBy('konfirmasi')
                ->get();
        } elseif ($role === 'user' || $role === 'superuser') {
            $pegawai = DB::table('pegawai')
                ->select('unit_kerja', DB::raw('count(*) as total'))
                ->where('unit_kerja', $user->asal)
                ->groupBy('unit_kerja')
                ->get();
    
            $surat = DB::table('pengajuan')
                ->select('konfirmasi', DB::raw('count(*) as total'))
                ->where('unit_kerja', $user->asal)
                ->groupBy('konfirmasi')
                ->get();
        } else {
            $pegawai = collect(); // Return an empty collection if the role is not recognized
            $surat = collect(); // Return an empty collection if the role is not recognized
        }
    
    return view('home')
        ->with('pegawai', $pegawai)
        ->with('surat', $surat);
    }     

    public function hapusPengajuan($id){
        DB::table("pengajuan")->where('id','=',$id)->delete();

        return redirect('table-pengajuan');
    }

    public function hapusPegawai($id){
        DB::table("pegawai")->where('id','=',$id)->delete();

        return redirect('pegawai');
    }
}
