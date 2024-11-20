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
use App\Models\Pegawai;

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
        $id = $user->id;
        $hak = $user->hak;
        $nip = $user->user_nip;
        $user_unit_id = $user->user_unit_id;
        $roles = $user->roles;

        return compact('id', 'hak', 'nip', 'roles','user_unit_id');
    }

    public function daftarPegawai(Request $req){

        $userData = $this->getUserData();
        $id = $userData['id'];
        $hak = $userData['hak'];
        $user_unit_id = $userData['user_unit_id'];
        $user_nip = $userData['nip'];
        $roles = $userData['roles'];


    
        $tahun_kerja = $req->tahun_kerja;
        $bulan_kerja = $req->bulan_kerja;
        $total_bulan_kerja = ($tahun_kerja * 12) + $bulan_kerja;
    
        $daftar = DB::table("pegawai")->insert([
            "nama" => $req->nama_pekerja,
            "by_id" => $id,
            "nip" => $req->nip,
            "jk" => $req->jk,
            "umur" => $req->umur,
            "jabatan" => $req->jabatan,
            "pegawai_unit_id" => $req->pegawai_unit_id,
            "masa_kerja" => $total_bulan_kerja,
            "created_at" => now()
        ]);
    
        return redirect('pegawai')->with('success', 'Data pegawai berhasil dimasukan.');
    }

    public function dataPegawai()
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $hak = $userData['hak'];
        $user_unit_id = $userData['user_unit_id'];
        $user_nip = $userData['nip'];
        $roles = $userData['roles'];

        // Mengambil unit kerja yang sesuai dengan user_unit_id
        $unit_kerja = DB::table('unit_kerja')
            ->where('unit_id', $user_unit_id)
            ->select('unit_id', 'unit_kerja')
            ->get();

        return view('pages.pegawai', compact('id', 'hak', 'roles', 'unit_kerja'));
    }

    public function pegawai()
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $hak = $userData['hak'];
        $user_unit_id = $userData['user_unit_id'];
        $user_nip = $userData['nip'];
        $roles = $userData['roles'];

        $query = DB::table('pegawai')
            ->join('users', 'pegawai.by_id', '=', 'users.id')
            ->join('unit_kerja', 'pegawai.pegawai_unit_id', '=', 'unit_kerja.unit_id')
            ->select(
                'pegawai.*', 
                'unit_kerja.*',
                'users.name as oleh_user',
                'users.user_jabatan as oleh_jabatan',
                'users.user_nip as oleh_nip',
            );

        if ($hak === 'admin') {
            $blanko = $query->paginate(15);
        } elseif ($hak === 'user' || $hak === 'super_user') {
            $blanko = $query->where('pegawai_unit_id', $user_unit_id)->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the hak is not recognized
        }

        return view('pages.tabel_pegawai', compact('id', 'blanko', 'hak', 'roles'));
    }

    public function editPegawai($pid)
    {
        $pegawai = Pegawai::findOrFail($pid);
        return view('pages.edit_pegawai', compact('pegawai'));
    }

    public function updatePegawai(Request $req, $pid)
    {
        $pegawai = Pegawai::findOrFail($pid);
        
        $validatedData = $req->validate([
            'nama_pekerja' => 'required|string|max:255',
            'umur' => 'required|integer',
            'nip' => 'required|string|max:255',
            'jk' => 'required|in:laki_laki,perempuan',
            'jabatan' => 'required|string',
            'pegawai_unit_id' => 'required|string',
            'tahun_kerja' => 'required|integer',
            'bulan_kerja' => 'required|integer',
        ]);

        $pegawai->nama = $validatedData['nama_pekerja'];
        $pegawai->umur = $validatedData['umur'];
        $pegawai->nip = $validatedData['nip'];
        $pegawai->jk = $validatedData['jk'];
        $pegawai->jabatan = $validatedData['jabatan'];
        $pegawai->pegawai_unit_id = $validatedData['pegawai_unit_id'];
        $pegawai->masa_kerja = ($validatedData['tahun_kerja'] * 12) + $validatedData['bulan_kerja'];

        $pegawai->save();

        return redirect('pegawai')->with('success', 'Data pegawai berhasil diperbarui');
    }
    
    public function pengajuanCuti()
    {
        $userData = $this->getUserData();
        $hak = $userData['hak'];
        $user_unit_id = $userData['user_unit_id'];
        $user_nip = $userData['nip'];
        $roles = $userData['roles'];

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

            switch (true) {
                case $hak === 'admin':
                    $blanko = $query->paginate(15);
                    break;
            
                case $hak === 'super_user' || ($hak === 'user' && $user_unit_id !== 1):
                    $blanko = $query->where('pegawai.pegawai_unit_id', $user_unit_id)->paginate(15);
                    break;
            
                case $hak === 'user' && $roles === 'direktur':
                    $blanko = $query->where('konfirmasi', 'sakit')->paginate(15);
                    break;
            
                default:
                    $blanko = collect(); // Return an empty collection if no case matches
                    break;
            }            


        return view('pages.pengajuan', compact('blanko', 'hak', 'roles'));
    }

    public function cutiDitolak()
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $hak = $userData['hak'];
        $user_unit_id = $userData['user_unit_id'];
        $user_nip = $userData['nip'];
        $roles = $userData['roles'];

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

        if ($hak === 'admin') {
            $blanko = $query->paginate(15);
        } elseif ($hak === 'super_user' || ($hak === 'user' && $user_unit_id !== 1)) {
            $blanko = $query->where('pegawai.pegawai_unit_id', $user_unit_id)->paginate(15);
        } elseif ($hak === 'user' && $roles === 'direktur') {
            $blanko = $query->where('jenis_cuti', 'cuti_sakit')->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the hak is not recognized
        }

        // $konfirmasi = DB::table('pengajuan')->where('konfirmasi', 'ditolak')->get();

        return view('pages.ditolak', compact('id', 'blanko', 'hak', 'roles'));
    }

    public function cutiDiterima()
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $hak = $userData['hak'];
        $user_unit_id = $userData['user_unit_id'];
        $user_nip = $userData['nip'];
        $roles = $userData['roles'];

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

            if ($hak === 'admin') {
                $blanko = $query->where('pengajuan.konfirmasi', 'diterima')->paginate(15);
            } elseif ($hak === 'super_user' || ($hak === 'user' && $user_unit_id !== 1)) {
                $blanko = $query->where('pegawai.pegawai_unit_id', $user_unit_id)
                ->where('pengajuan.konfirmasi', 'diterima')
                ->paginate(15);
            } elseif ($hak === 'user' && $roles === 'direktur') {
                $blanko = $query->where('pengajuan.konfirmasi', 'diterima')->paginate(15);
            } else {
                $blanko = collect(); // Return an empty collection if the hak is not recognized
            }

        // if ($hak === 'admin') {
        //     $blanko = $query->where('pengajuan.konfirmasi', 'diterima')->paginate(15);
        // } elseif ($hak === 'user' || ($hak === 'super_user' && $user_unit_id !== 1)) {
        //     $blanko = $query->where('pegawai.pegawai_unit_id', $user_unit_id)
        //         ->where('pengajuan.konfirmasi', 'diterima')
        //         ->paginate(15);
        // } elseif ($hak === 'super_user') {
        //     $blanko = $query->where('pengajuan.konfirmasi', 'diterima')
        //         ->where(function ($query) {
        //             $query->where('pengajuan.konfirmasi', 'diterima')
        //                 ->Where('pengajuan.jenis_cuti', 'cuti_sakit');
        //         })
        //         ->paginate(15);
        // } else {
        //     $blanko = collect(); // Return an empty collection if the hak is not recognized
        // }

        // $konfirmasi = DB::table('pengajuan')->where('konfirmasi', 'diterima')->get();

        return view('pages.diterima', compact('id', 'blanko', 'hak', 'roles'));
    }

    public function pengajuanSaya()
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $hak = $userData['hak'];
        $user_unit_id = $userData['user_unit_id'];
        $user_nip = $userData['nip'];
        $roles = $userData['roles'];

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

        $blanko = $query->paginate(15);

        $konfirmasi = DB::table('pengajuan')->get();

        return view('pages.pribadiPengajuan', compact('id', 'blanko', 'konfirmasi', 'hak', 'roles'));
    }

    public function form()
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $hak = $userData['hak'];
        $user_unit_id = $userData['user_unit_id'];
        $user_nip = $userData['nip'];
        $roles = $userData['roles'];

        if ($hak === 'admin') {
            $blanko = DB::table('pegawai')
                ->join('unit_kerja', 'pegawai.pegawai_unit_id', '=', 'unit_kerja.unit_id')
                ->select('pegawai.*', 'unit_kerja.unit_kerja')
                ->paginate(15);
        } elseif ($hak === 'user' || $hak === 'super_user') {
            $blanko = DB::table('pegawai')
                ->join('unit_kerja', 'pegawai.pegawai_unit_id', '=', 'unit_kerja.unit_id')
                ->select('pegawai.*', 'unit_kerja.unit_kerja')
                ->where('pegawai_unit_id', $user_unit_id)
                ->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the hak is not recognized
        }

        return view('pages.form', compact('id', 'blanko', 'hak', 'roles'));
    }

    public function rekapitulasi()
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $hak = $userData['hak'];
        $user_unit_id = $userData['user_unit_id'];
        $user_nip = $userData['nip'];
        $roles = $userData['roles'];

        $query = DB::table('pengajuan')
            ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
            ->join('users', 'pengajuan.user_id', '=', 'users.id')
            ->select(
                'pengajuan.*',
                'pegawai.nama as nama_pegawai',
                'pegawai.nip',
                'pegawai.jabatan',
                'pegawai.pegawai_unit_id as pegawai_unit_id',
                'pegawai.masa_kerja',
                'users.name as oleh_user',
                'users.user_jabatan as oleh_jabatan',
                'users.user_nip as oleh_nip',
            );

        $blanko = $query->where('pegawai_unit_id', $user_unit_id)->paginate(15);

        return view('download.rekapitulasi', compact('id', 'blanko' ,'hak','roles'));
    }

    public function kirimPengajuan(Request $req)
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $hak = $userData['hak'];
        $user_unit_id = $userData['user_unit_id'];
        $user_nip = $userData['nip'];
        $roles = $userData['roles'];

        // Validate the request
        $validatedData = $req->validate([
            'pegawai' => 'required|exists:pegawai,pid',
            'jenis_cuti' => 'required|string',
            'mulai_cuti' => 'required|date',
            'selesai_cuti' => 'required|date|after_or_equal:mulai_cuti',
            'blanko_ditangguhkan' => 'required|file|mimes:pdf',
        ]);

        if ($req->hasFile('blanko_ditangguhkan')) {
            $file = $req->file('blanko_ditangguhkan');
            $fileName = time() . '_' . Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $path = public_path('blanko_ditangguhkan');

            // Ensure directory exists
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Move file
            $file->move($path, $fileName);
            $filePath = 'blanko_ditangguhkan/' . $fileName;

            // Get pegawai data
            $pegawai = DB::table('pegawai')->where('pid', $validatedData['pegawai'])->first();

            if (!$pegawai) {
                return redirect('form')->with('error', 'Pegawai tidak ditemukan.');
            }

            $user_id = auth()->id();
            $pegawai_id = $pegawai->pid;
            $masa_kerja = $pegawai->masa_kerja;

            // Ubah jenis_cuti menjadi lowercase dan ganti spasi dengan underscore
            $jenis_cuti = Str::lower(str_replace(' ', '_', $validatedData['jenis_cuti']));

            $pengajuan = DB::table("pengajuan")->insert([
                "user_id" => $user_id,
                "pegawai_id" => $pegawai_id,
                "jenis_cuti" => $jenis_cuti,
                "mulai_cuti" => $validatedData['mulai_cuti'],
                "selesai_cuti" => $validatedData['selesai_cuti'],
                "alasan" => $req->alasan,
                "tujuan_cuti" => $req->tujuan_cuti,
                "blanko_ditangguhkan" => $filePath,
                "keterangan" => $req->keterangan,
                "konfirmasi" => "ditangguhkan",
                "created_at" => now()
            ]);

            return redirect('table-pengajuan')->with('success', 'Pengajuan berhasil dikirim.');
        } else {
            return redirect('form')->with('error', 'File blanko harus diunggah.');
        }
    }

    public function responSakit(Request $req){

        $userData = $this->getUserData();
        $hak = $userData['hak'];
        $user_unit_id = $userData['user_unit_id'];
        $user_nip = $userData['nip'];
        $roles = $userData['roles'];

        // Log::info('Request data: ' . json_encode($req->all()));

        $req->validate([
            'file' => 'required|mimes:pdf',
            'status' => 'required|in:sakit,ditolak',
            'bid' => 'required|exists:pengajuan,bid',
        ]);
    
        $file = $req->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        if ($req->input('status') === 'sakit') {
            $filePath = 'sakit_ditangguhkan/' . $fileName;
            $file->move(public_path('sakit_ditangguhkan'), $fileName);
        } else {
            $filePath = 'blanko_ditolak/' . $fileName;
            $file->move(public_path('blanko_ditolak'), $fileName);
        }
    
        // Update the appropriate column in the database
        DB::table('pengajuan')->where('bid', $req->input('bid'))->update(['konfirmasi' => $req->input('status'), 
        $req->input('status') === 'sakit' ? 'sakit_ditangguhkan' : 'blanko_ditolak' => $filePath, 'updated_at' => now(),
    ],);    
    
        return response()->json(['message' => 'File uploaded successfully.']);
    }

    public function responCuti(Request $req){

        $userData = $this->getUserData();
        $id = $userData['id'];
        $hak = $userData['hak'];
        $user_unit_id = $userData['user_unit_id'];
        $user_nip = $userData['nip'];
        $roles = $userData['roles'];

        // Log::info('Request data: ' . json_encode($req->all()));

        $req->validate([
            'file' => 'required|mimes:pdf',
            'status' => 'required|in:diterima,ditolak',
            'bid' => 'required|exists:pengajuan,bid',
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
        DB::table('pengajuan')->where('bid', $req->input('bid'))->update(['konfirmasi' => $req->input('status'), 
        $req->input('status') === 'diterima' ? 'blanko_diterima' : 'blanko_ditolak' => $filePath, 'updated_at' => now(),
        ],);    
    
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
    $id = $userData['id'];
    $hak = $userData['hak'];
    $user_unit_id = $userData['user_unit_id'];
    $user_nip = $userData['nip'];
    $roles = $userData['roles'];

    $jumlahPegawai = 0;
    $jumlahPengajuan = 0;
    $cutiDiterima = 0;
    $cutiDitolak = 0;
    $chartCuti = 0;

    switch ($roles) {
        case 'admin':
            $jumlahPegawai = DB::table('pegawai')->count();
            $jumlahPengajuan = DB::table('pengajuan')
                ->where('konfirmasi', 'ditangguhkan')
                ->count();
            $cutiDiterima = DB::table('pengajuan')
                ->where('konfirmasi', 'diterima')
                ->count();
            $cutiDitolak = DB::table('pengajuan')
                ->where('konfirmasi', 'ditolak')
                ->count();

            $chartCuti = DB::table('pengajuan')
                ->select(DB::raw('DATE_FORMAT(mulai_cuti, "%Y-%m") as month'), DB::raw('count(*) as count'))
                ->where('konfirmasi', 'diterima')
                ->groupBy('month')
                ->get()
                ->pluck('count', 'month')
                ->toArray();

            // Calculate the additional statistics
            $totalCutiTahunIni = DB::table('pengajuan')
                ->whereYear('mulai_cuti', '=', date('Y'))
                ->count();
            $totalCutiBulanIni = DB::table('pengajuan')
                ->whereYear('mulai_cuti', '=', date('Y'))
                ->whereMonth('mulai_cuti', '=', date('m'))
                ->count();
            $cutiDiterimaBulanIni = DB::table('pengajuan')
                ->whereYear('mulai_cuti', '=', date('Y'))
                ->whereMonth('mulai_cuti', '=', date('m'))
                ->where('konfirmasi', 'diterima')
                ->count();
            $cutiDitolakBulanIni = DB::table('pengajuan')
                ->whereYear('mulai_cuti', '=', date('Y'))
                ->whereMonth('mulai_cuti', '=', date('m'))
                ->where('konfirmasi', 'ditolak')
                ->count();
            break;

        case 'direktur':
            $jumlahPegawai = DB::table('pegawai')->count();
            $jumlahPengajuan = DB::table('pengajuan')
                ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
                ->where(function ($query) use ($user_unit_id) {
                    $query->where('konfirmasi', 'sakit')
                          ->orWhere('pegawai.pegawai_unit_id', $user_unit_id);
                })
                ->where('konfirmasi', 'ditangguhkan')
                ->count();
            $cutiDiterima = DB::table('pengajuan')
                ->where('konfirmasi', 'diterima')
                ->count();
            $cutiDitolak = DB::table('pengajuan')
                ->where('konfirmasi', 'ditolak')
                ->count();

            $chartCuti = DB::table('pengajuan')
                ->select(DB::raw('DATE_FORMAT(mulai_cuti, "%Y-%m") as month'), DB::raw('count(*) as count'))
                ->where('konfirmasi', 'diterima')
                ->groupBy('month')
                ->get()
                ->pluck('count', 'month')
                ->toArray();

            break;

        case 'kepala_rri':
            $jumlahPegawai = DB::table('pegawai')
                ->where('pegawai_unit_id', $user_unit_id)
                ->count();
            $jumlahPengajuan = DB::table('pengajuan')
                ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
                ->where('pegawai.pegawai_unit_id', $user_unit_id)
                ->where('konfirmasi', 'ditangguhkan')
                ->count();
            $cutiDiterima = DB::table('pengajuan')
                ->where('konfirmasi', 'diterima')
                ->whereExists(function ($query) use ($user_unit_id) {
                    $query->select(DB::raw(1))
                          ->from('pegawai')
                          ->whereColumn('pegawai.pid', 'pengajuan.pegawai_id')
                          ->where('pegawai.pegawai_unit_id', $user_unit_id);
                })
                ->count();
            $cutiDitolak = DB::table('pengajuan')
                ->where('konfirmasi', 'ditolak')
                ->whereExists(function ($query) use ($user_unit_id) {
                    $query->select(DB::raw(1))
                          ->from('pegawai')
                          ->whereColumn('pegawai.pid', 'pengajuan.pegawai_id')
                          ->where('pegawai.pegawai_unit_id', $user_unit_id);
                })
                ->count();
            break;

        case 'sdm': // Logika sama dengan kepala_rri
            $jumlahPegawai = DB::table('pegawai')
                ->where('pegawai_unit_id', $user_unit_id)
                ->count();
            $jumlahPengajuan = DB::table('pengajuan')
                ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
                ->where('pegawai.pegawai_unit_id', $user_unit_id)
                ->where('konfirmasi', 'ditangguhkan')
                ->count();
            $cutiDiterima = DB::table('pengajuan')
                ->where('konfirmasi', 'diterima')
                ->whereExists(function ($query) use ($user_unit_id) {
                    $query->select(DB::raw(1))
                          ->from('pegawai')
                          ->whereColumn('pegawai.pid', 'pengajuan.pegawai_id')
                          ->where('pegawai.pegawai_unit_id', $user_unit_id);
                })
                ->count();
            $cutiDitolak = DB::table('pengajuan')
                ->where('konfirmasi', 'ditolak')
                ->whereExists(function ($query) use ($user_unit_id) {
                    $query->select(DB::raw(1))
                          ->from('pegawai')
                          ->whereColumn('pegawai.pid', 'pengajuan.pegawai_id')
                          ->where('pegawai.pegawai_unit_id', $user_unit_id);
                })
                ->count();
            break;

        default:
            break;
    }

    return view('home')
        ->with('jumlahPegawai', $jumlahPegawai)
        ->with('jumlahPengajuan', $jumlahPengajuan)
        ->with('cutiDiterima', $cutiDiterima)
        ->with('dataCuti', $chartCuti)
        ->with('cutiDitolak', $cutiDitolak)
        ->with('totalCutiTahunIni', isset($totalCutiTahunIni) ? $totalCutiTahunIni : 0)
        ->with('totalCutiBulanIni', isset($totalCutiBulanIni) ? $totalCutiBulanIni : 0)
        ->with('cutiDiterimaBulanIni', isset($cutiDiterimaBulanIni) ? $cutiDiterimaBulanIni : 0)
        ->with('cutiDitolakBulanIni', isset($cutiDitolakBulanIni) ? $cutiDitolakBulanIni : 0);
}


    public function hapusPengajuanPersonal($bid){
        DB::table("pengajuan")->where('bid','=',$bid)->delete();

        return redirect('pengajuan-anda');
    }

    public function hapusPengajuan($bid){
        DB::table("pengajuan")->where('bid','=',$bid)->delete();

        return redirect('table-pengajuan');
    }

    public function hapusPegawai($pid){
        DB::table("pegawai")->where('pid','=',$pid)->delete();

        return redirect('pegawai');
    }
    
}
