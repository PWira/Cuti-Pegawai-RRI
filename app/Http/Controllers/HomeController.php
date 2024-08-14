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

    // public function showUserInfo()
    // {
    //     $username = Auth::user()->name;
    //     $email = Auth::user()->email;
    //     $role = Auth::user()->role; // Assuming the role is stored in the 'role' column

    //     return view('user.info', compact('username', 'email', 'role'));
    // }

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

    // public function dashboard()
    // {
    //     if (condition) {
    //         # code...
    //     }
    //     elseif (Auth::user()->role == 'admin') {
    //         return view('admin.home');
    //     } else {
    //         Auth::logout();
    //         $request->session()->invalidate();
    //         $request->session()->regenerateToken();
    //         return redirect()->route('login')->with('error', 'Unauthorized access. Please log in with the correct credentials.');
    //     }
    // }

    public function index()
    {
        return view('home');
    }

}
