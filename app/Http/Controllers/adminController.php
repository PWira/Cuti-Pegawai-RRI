<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
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
        $role = $user->role;

        // if ($role === 'admin') {
        //     $blanko = DB::table('pegawai')->paginate(15);
        // } elseif ($role === 'user' || $role === 'superuser') {
        //     $blanko = DB::table('pegawai')->where('unit_kerja', $user->unit_kerja)->paginate(15);
        // } else {
        //     $blanko = collect(); // Return an empty collection if the role is not recognized
        // }
        $blanko = DB::table('pegawai')->where('unit_kerja', $user->unit_kerja)->paginate(15);
        $konfirmasi = DB::table('pegawai')->where('status','aktif')->get();

        return view('pages.pegawai_aktif', compact('blanko', 'admin_blanko', 'konfirmasi', 'role'));
    }

    public function pegawaiCuti()
    {
        $user = Auth::user();

        $blanko = DB::table('pegawai')->where('unit_kerja', $user->unit_kerja)->paginate(15);
        $admin_blanko = DB::table('pegawai')->paginate(15);
        $konfirmasi = DB::table('pegawai')->where('status','cuti')->get();

        return view('pages.tabel_pegawai', compact('blanko'))
        ->with('admin_blanko',$admin_blanko)
        ->with('konfirmasi',$konfirmasi)
        // ->with()
        ;
    }

    public function daftarPegawai(Request $req)
    {

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
            "status" => $req->status,
            "created_at" => now()
        ]);

        return redirect('pegawai-aktif')->with('success', 'Pengajuan berhasil dikirim.');
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

        $pegawai = DB::table('pegawai')
        ->select('unit_kerja', DB::raw('SUM(CASE WHEN status = "aktif" THEN 1 ELSE 0 END) as aktif'), DB::raw('SUM(CASE WHEN status = "cuti" THEN 1 ELSE 0 END) as cuti'))
        ->groupBy('unit_kerja')
        ->get();

        $surat = DB::table('pengajuan')
        ->select('konfirmasi', DB::raw('count(*) as total'))
        ->groupBy('konfirmasi')
        ->get();

        return view('home')
        ->with('pegawai',$pegawai)
        ->with('surat',$surat)
        // ->with()
        ;
    }

    public function hapusPengajuan($id){
        DB::table("pengajuan")->where('id','=',$id)->delete();

        return redirect('table-pengajuan');
    }
}
