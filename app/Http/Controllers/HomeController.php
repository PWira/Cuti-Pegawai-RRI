<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

    public function getUserData(){

        $user = Auth::user();
        $role = $user->role;
        $asal = $user->asal;
        $jabatan = $user->jabatan;

        return compact('role', 'asal', 'jabatan');
    }
    
    public function daftarPegawai(Request $req){

        $userData = $this->getUserData();
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];
    
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
            "oleh_user"=>$role,
            "oleh_asal"=>$asal,
            "oleh_jabatan"=>$jabatan,
            "created_at" => now()
        ]);
    
        return redirect('pegawai')->with('success', 'Pengajuan berhasil dikirim.');
    }
    
    public function pengajuanCuti(){

        $userData = $this->getUserData();
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

        if ($role === 'admin') {
            $blanko = DB::table('pengajuan')->paginate(15);
        } elseif ($role === 'user' || ($role === 'super_user' && $asal !== 'jakarta')) {
            $blanko = DB::table('pengajuan')->where('unit_kerja', $asal)->paginate(15);
        } elseif ($role === 'super_user' && $asal === 'jakarta') {
            $blanko = DB::table('pengajuan')
                ->where(function ($query) {
                    $query->where('unit_kerja', 'jakarta')
                        ->orWhere('jenis_cuti', 'cuti_sakit');
                })
                ->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }
        $konfirmasi = DB::table('pengajuan')->where('konfirmasi', 'ditangguhkan')->get();

        return view('pages.pengajuan', compact('blanko', 'konfirmasi', 'role', 'jabatan'));
    }

    public function cutiDitolak(){

        $userData = $this->getUserData();
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

        if ($role === 'admin') {
            $blanko = DB::table('pengajuan')->where('konfirmasi', 'ditolak')->paginate(15);
        } elseif ($role === 'user' || ($role === 'super_user' && $asal !== 'jakarta')) {
            $blanko = DB::table('pengajuan')
                ->where('unit_kerja', $asal)
                ->where('konfirmasi', 'ditolak')
                ->paginate(15);
        } elseif ($role === 'super_user' && $asal === 'jakarta') {
            $blanko = DB::table('pengajuan')
                ->where('konfirmasi', 'ditolak')
                ->where(function ($query) {
                    $query->where('unit_kerja', 'jakarta')
                        ->orWhere('jenis_cuti', 'cuti_sakit');
                })
                ->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }
        $konfirmasi = DB::table('pengajuan')->where('konfirmasi', 'ditolak')->get();

        return view('pages.ditolak', compact('blanko', 'konfirmasi', 'role','jabatan'));
    }

    public function cutiDiterima()
    {
        $userData = $this->getUserData();
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

        if ($role === 'admin') {
            $blanko = DB::table('pengajuan')->where('konfirmasi', 'diterima')->paginate(15);
        } elseif ($role === 'user' || ($role === 'super_user' && $asal !== 'jakarta')) {
            $blanko = DB::table('pengajuan')
                ->where('unit_kerja', $asal)
                ->where('konfirmasi', 'diterima')
                ->paginate(15);
        } elseif ($role === 'super_user' && $asal === 'jakarta') {
            $blanko = DB::table('pengajuan')
                ->where('konfirmasi', 'diterima')
                ->where(function ($query) {
                    $query->where('unit_kerja', 'jakarta')
                        ->orWhere('jenis_cuti', 'cuti_sakit');
                })
                ->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }
        $konfirmasi = DB::table('pengajuan')->where('konfirmasi', 'diterima')->get();

        return view('pages.diterima', compact('blanko', 'konfirmasi', 'role','jabatan'));
    }

    public function pegawai()
    {
        $userData = $this->getUserData();
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

        if ($role === 'admin') {
            $blanko = DB::table('pegawai')->paginate(15);
        } elseif ($role === 'user' || $role === 'super_user') {
            $blanko = DB::table('pegawai')->where('unit_kerja', $asal)->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }

        return view('pages.tabel_pegawai', compact('blanko', 'role', 'jabatan'));
}

    public function form()
    {
        $userData = $this->getUserData();
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

        if ($role === 'admin') {
            $blanko = DB::table('pegawai')->paginate(15);
        } elseif ($role === 'user' || $role === 'super_user') {
            $blanko = DB::table('pegawai')->where('unit_kerja', $asal)->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }
        // $blanko = DB::table('pegawai')->where('unit_kerja', $user->asal)->paginate(15);

        return view('pages.form', compact('blanko' ,'role','jabatan'));
    }

    public function sakitPengajuan(Request $req){

        $userData = $this->getUserData();
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

        if ($req->hasFile('sakit_ditangguhkan')) {
            $file = $req->file('sakit_ditangguhkan');
            $fileName = time() . '_' . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $path = public_path('sakit_ditangguhkan');
    
            // Pastikan direktori ada
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
    
            // Pindahkan file
            $file->move($path, $fileName);
            $filePath = 'sakit_ditangguhkan/' . $fileName;
            
            // Ubah jenis_cuti menjadi lowercase dan ganti spasi dengan underscore
            $jenis_cuti = Str::lower(str_replace(' ', '_', $req->jenis_cuti));

            $ubah_konfirmasi = 'sakit';
    
            $pengajuan = DB::table("pengajuan")->insert([
                "sakit_ditangguhkan" => $filePath,
                "konfirmasi" => $ubah_konfirmasi,
                "updated_at" => now()
            ]);
    
            return redirect('table-pengajuan')->with('success', 'Pengajuan berhasil dikirim.');
        } else {
            return redirect('form')->with('error', 'File blanko harus diunggah.');
        }
    }

    public function kirimPengajuan(Request $req){

        $userData = $this->getUserData();
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

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
            
            // Ubah jenis_cuti menjadi lowercase dan ganti spasi dengan underscore
            $jenis_cuti = Str::lower(str_replace(' ', '_', $req->jenis_cuti));
    
            $pengajuan = DB::table("pengajuan")->insert([
                "nama_pekerja" => $req->nama_pekerja,
                "nip" => $req->nip,
                "jabatan" => $req->jabatan,
                "unit_kerja" => $unitcase,
                "masa_kerja" => $total_bulan_kerja,
                "jenis_cuti" => $jenis_cuti,
                "mulai_cuti" => $req->mulai_cuti,
                "selesai_cuti" => $req->selesai_cuti,
                "alasan" => $req->alasan,
                "blanko_ditangguhkan" => $filePath,
                "oleh_user"=>$role,
                "oleh_asal"=>$asal,
                "oleh_jabatan"=>$jabatan,
                "created_at" => now()
            ]);
    
            return redirect('table-pengajuan')->with('success', 'Pengajuan berhasil dikirim.');
        } else {
            return redirect('form')->with('error', 'File blanko harus diunggah.');
        }
    }

    public function responCuti(Request $req){

        $userData = $this->getUserData();
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

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
        $userData = $this->getUserData();
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];
     
         if ($role === 'admin') {
             $pegawai = DB::table('pegawai')
                 ->select('unit_kerja', DB::raw('count(*) as total'))
                 ->groupBy('unit_kerja')
                 ->get();
     
             $surat = DB::table('pengajuan')
                 ->select('konfirmasi', DB::raw('count(*) as total'))
                 ->groupBy('konfirmasi')
                 ->get();
         } elseif ($role === 'user') {
             $pegawai = DB::table('pegawai')
                 ->select('unit_kerja', DB::raw('count(*) as total'))
                 ->where('unit_kerja', $asal)
                 ->groupBy('unit_kerja')
                 ->get();
     
             $surat = DB::table('pengajuan')
                 ->select('konfirmasi', DB::raw('count(*) as total'))
                 ->where('unit_kerja', $asal)
                 ->groupBy('konfirmasi')
                 ->get();
         } elseif ($role === 'super_user') {
             if ($asal === "jakarta") {
                 // Tampilkan semua pegawai
                 $pegawai = DB::table('pegawai')
                     ->select('unit_kerja', DB::raw('count(*) as total'))
                     ->groupBy('unit_kerja')
                     ->get();
     
                 // Tampilkan semua pengajuan dan tambahkan filter untuk cuti sakit
                 $surat = DB::table('pengajuan')
                     ->select('konfirmasi', DB::raw('count(*) as total'))
                     ->groupBy('konfirmasi')
                     ->get();
     
                 // Tambahkan query untuk menghitung cuti sakit
                 $cutiSakit = DB::table('pengajuan')
                     ->where('jenis_cuti', 'sakit')
                     ->count();
             } else {
                 // Untuk super_user selain Jakarta, gunakan logika yang sama seperti user biasa
                 $pegawai = DB::table('pegawai')
                     ->select('unit_kerja', DB::raw('count(*) as total'))
                     ->where('unit_kerja', $asal)
                     ->groupBy('unit_kerja')
                     ->get();
     
                 $surat = DB::table('pengajuan')
                     ->select('konfirmasi', DB::raw('count(*) as total'))
                     ->where('unit_kerja', $asal)
                     ->groupBy('konfirmasi')
                     ->get();
     
                 $cutiSakit = DB::table('pengajuan')
                     ->where('unit_kerja', $asal)
                     ->where('jenis_cuti', 'sakit')
                     ->count();
             }
         } else {
             $pegawai = collect(); // Return an empty collection if the role is not recognized
             $surat = collect(); // Return an empty collection if the role is not recognized
             $cutiSakit = 0;
         }
     
         return view('home')
             ->with('pegawai', $pegawai)
             ->with('surat', $surat)
             ->with('cutiSakit', $cutiSakit ?? 0);
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
