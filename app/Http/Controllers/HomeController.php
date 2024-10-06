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
        $id = $user->id;
        $role = $user->role;
        $asal = $user->asal;
        $jabatan = $user->jabatan;

        return compact('id', 'role', 'asal', 'jabatan');
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
    
        return redirect('pegawai')->with('success', 'Data pegawai berhasil dimasukan.');
    }
    
    public function pengajuanCuti()
    {
        $userData = $this->getUserData();
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

        $query = DB::table('pengajuan')
            ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
            ->join('users', 'pengajuan.user_id', '=', 'users.id')
            ->select(
                'pengajuan.*',
                'pegawai.nama as nama_pekerja',
                'pegawai.nip',
                'pegawai.jabatan',
                'pegawai.unit_kerja',
                'pegawai.masa_kerja',
                'users.name as oleh_user',
                'users.jabatan as oleh_jabatan',
                'users.asal as oleh_asal'
            );

        if ($role === 'admin') {
            $blanko = $query->paginate(15);
            $konfirmasi = DB::table('pengajuan')->get();
        } elseif ($role === 'super_user' || ($role === 'user' && $asal !== 'jakarta')) {
            $blanko = $query->where('pegawai.unit_kerja', $asal)
                ->paginate(15);
            $konfirmasi = DB::table('pengajuan')->where('konfirmasi', 'ditangguhkan')->get();
        } elseif ($role === 'user' && $asal === 'jakarta' && $jabatan === 'direktur') {
            $blanko = $query
                ->where(function ($search) {
                    $search->where('unit_kerja', 'jakarta')
                        ->orWhere(function ($sq) {
                            $sq->where('jenis_cuti', 'cuti_sakit')
                                ->where('konfirmasi', 'sakit');
                        }
                    );
                })
                ->paginate(15);
            $konfirmasi = DB::table('pengajuan')->where('konfirmasi', 'sakit')->get();
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }

        return view('pages.pengajuan', compact('blanko', 'konfirmasi', 'role', 'jabatan'));
    }

    public function cutiDitolak()
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

        $query = DB::table('pengajuan')
            ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
            ->join('users', 'pengajuan.user_id', '=', 'users.id')
            ->select(
                'pengajuan.*',
                'pegawai.nama as nama_pekerja',
                'pegawai.nip',
                'pegawai.jabatan',
                'pegawai.unit_kerja',
                'pegawai.masa_kerja',
                'users.name as oleh_user',
                'users.jabatan as oleh_jabatan',
                'users.asal as oleh_asal'
            );

        if ($role === 'admin') {
            $blanko = $query->where('pengajuan.konfirmasi', 'ditolak')->paginate(15);
        } elseif ($role === 'user' || ($role === 'super_user' && $asal !== 'jakarta')) {
            $blanko = $query->where('pegawai.unit_kerja', $asal)
                ->where('pengajuan.konfirmasi', 'ditolak')
                ->paginate(15);
        } elseif ($role === 'super_user' && $asal === 'jakarta') {
            $blanko = $query->where('pengajuan.konfirmasi', 'ditolak')
                ->where(function ($query) {
                    $query->where('pegawai.unit_kerja', 'jakarta')
                        ->orWhere('pengajuan.jenis_cuti', 'cuti_sakit');
                })
                ->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }

        $konfirmasi = DB::table('pengajuan')->where('konfirmasi', 'ditolak')->get();

        return view('pages.ditolak', compact('id', 'blanko', 'konfirmasi', 'role', 'jabatan'));
    }

    public function cutiDiterima()
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

        $query = DB::table('pengajuan')
            ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
            ->join('users', 'pengajuan.user_id', '=', 'users.id')
            ->select(
                'pengajuan.*',
                'pegawai.nama as nama_pekerja',
                'pegawai.nip',
                'pegawai.jabatan',
                'pegawai.unit_kerja',
                'pegawai.masa_kerja',
                'users.name as oleh_user',
                'users.jabatan as oleh_jabatan',
                'users.asal as oleh_asal'
            );

        if ($role === 'admin') {
            $blanko = $query->where('pengajuan.konfirmasi', 'diterima')->paginate(15);
        } elseif ($role === 'user' || ($role === 'super_user' && $asal !== 'jakarta')) {
            $blanko = $query->where('pegawai.unit_kerja', $asal)
                ->where('pengajuan.konfirmasi', 'diterima')
                ->paginate(15);
        } elseif ($role === 'super_user' && $asal === 'jakarta') {
            $blanko = $query->where('pengajuan.konfirmasi', 'diterima')
                ->where(function ($query) {
                    $query->where('pegawai.unit_kerja', 'jakarta')
                        ->orWhere('pengajuan.jenis_cuti', 'cuti_sakit');
                })
                ->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }

        $konfirmasi = DB::table('pengajuan')->where('konfirmasi', 'diterima')->get();

        return view('pages.diterima', compact('id', 'blanko', 'konfirmasi', 'role', 'jabatan'));
    }

    public function pengajuanSaya()
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

        $query = DB::table('pengajuan')
            ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
            ->join('users', 'pengajuan.user_id', '=', 'users.id')
            ->select(
                'pengajuan.*',
                'pegawai.nama as nama_pekerja',
                'pegawai.nip',
                'pegawai.jabatan',
                'pegawai.unit_kerja',
                'pegawai.masa_kerja',
                'users.name as oleh_user',
                'users.jabatan as oleh_jabatan',
                'users.asal as oleh_asal'
            );

        $blanko = $query->paginate(15);

        $konfirmasi = DB::table('pengajuan')->get();

        return view('pages.pribadiPengajuan', compact('id', 'blanko', 'konfirmasi', 'role', 'jabatan'));
    }

    public function pegawai()
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

        $query = DB::table('pegawai')
            ->join('users', 'pegawai.admin_id', '=', 'users.id')
            ->select(
                'pegawai.*',
                'users.name as oleh_user',
                'users.jabatan as oleh_jabatan',
                'users.asal as oleh_asal'
            );

        if ($role === 'admin') {
            $blanko = $query->paginate(15);
        } elseif ($role === 'user' || $role === 'super_user') {
            $blanko = $query->where('unit_kerja', $asal)->paginate(15);
        } else {
            $blanko = collect(); // Return an empty collection if the role is not recognized
        }

        return view('pages.tabel_pegawai', compact('id', 'blanko', 'role', 'jabatan'));
    }

    public function form()
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
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

        return view('pages.form', compact('id', 'blanko' ,'role','jabatan'));
    }

    public function formBaru()
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
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

        return view('pages.test_form', compact('id', 'blanko' ,'role','jabatan'));
    }

    public function kirimPengajuan(Request $req)
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

        // Validate the request
        $validatedData = $req->validate([
            'pegawai' => 'required|exists:pegawai,pid',
            'jenis_cuti' => 'required|string',
            'mulai_cuti' => 'required|date',
            'selesai_cuti' => 'required|date|after_or_equal:mulai_cuti',
            'alasan' => 'required|string|max:255',
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
                "alasan" => $validatedData['alasan'],
                "blanko_ditangguhkan" => $filePath,
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
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

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
        $req->input('status') === 'sakit' ? 'sakit_ditangguhkan' : 'blanko_ditolak' => $filePath],
        );    
    
        return response()->json(['message' => 'File uploaded successfully.']);
    }

    public function responCuti(Request $req){

        $userData = $this->getUserData();
        $id = $userData['id'];
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

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
        $id = $userData['id'];
        $role = $userData['role'];
        $asal = $userData['asal'];
        $jabatan = $userData['jabatan'];

        if ($role === 'admin' && ($asal === "keymaster" || $asal ==="jakarta")) {
            $pegawai = DB::table('pegawai')
                ->select(DB::raw('count(*) as total'))
                ->get();

            $surat = DB::table('pengajuan')
            ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
            ->select('pengajuan.*', 'pegawai.nama as nama_pekerja')
            ->select('pengajuan.konfirmasi', DB::raw('count(*) as total'))
            ->groupBy('pengajuan.konfirmasi')
            ->get();
        }elseif ($role === 'admin' && $asal !=" ") {
            $pegawai = DB::table('pegawai')
                ->select('unit_kerja', DB::raw('count(*) as total'))
                ->groupBy('unit_kerja')
                ->get();

            $surat = DB::table('pengajuan')
                ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
                ->select('pengajuan.*', 'pegawai.nama as nama_pekerja')
                ->select('pengajuan.konfirmasi', DB::raw('count(*) as total'))
                ->groupBy('pengajuan.konfirmasi')
                ->get();

        }
         elseif ($role === 'user') {
            $pegawai = DB::table('pegawai')
                ->select('unit_kerja', DB::raw('count(*) as total'))
                ->where('unit_kerja', $asal)
                ->groupBy('unit_kerja')
                ->get();

            $surat = DB::table('pengajuan')
                ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
                ->select('pengajuan.*', 'pegawai.nama as nama_pekerja')
                ->select('pengajuan.konfirmasi', DB::raw('count(*) as total'))
                ->where('pegawai.unit_kerja', $asal)
                ->groupBy('pengajuan.konfirmasi')
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
                    ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
                    ->select('pengajuan.*', 'pegawai.nama as nama_pekerja')
                    ->select('pengajuan.konfirmasi', DB::raw('count(*) as total'))
                    ->groupBy('pengajuan.konfirmasi')
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
                    ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
                    ->select('pengajuan.*', 'pegawai.nama as nama_pekerja')
                    ->select('pengajuan.konfirmasi', DB::raw('count(*) as total'))
                    ->where('pegawai.unit_kerja', $asal)
                    ->groupBy('pengajuan.konfirmasi')
                    ->get();

                $cutiSakit = DB::table('pengajuan')
                    ->join('pegawai', 'pengajuan.pegawai_id', '=', 'pegawai.pid')
                    ->select('pengajuan.*', 'pegawai.nama as nama_pekerja')
                    ->where('pegawai.unit_kerja', $asal)
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
