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

    public function getUserData(){

        $user = Auth::user();
        $id = $user->id;
        $hak = $user->hak;
        $roles = $user->roles;

        return compact('id', 'hak', 'roles');
    }

    public function createUser(Request $req)
    {
        $userData = $this->getUserData();
        $id = $userData['id'];
        $hak = $userData['hak'];
        $roles = $userData['roles'];

        $name = strtolower(str_replace(' ', '_', $req->input('name')));
        $userHak = strtolower(str_replace(' ', '_', $req->input('hak')));

        $tahun_kerja = $req->tahun_kerja;
        $bulan_kerja = $req->bulan_kerja;
        $total_bulan_kerja = ($tahun_kerja * 12) + $bulan_kerja;

        $validator = Validator::make($req->all(), [
            'name' => ['required', 'string', 'max:50'],
            'nip' => ['required', 'string', 'max:20', 'unique:pegawai,nip'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        User::create([
            'name' => $name,
            "user_nip" => $req->nip,
            "user_unit_id" => $req->user_unit_id,
            "user_jabatan" => $req->jabatan,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'roles' => $req->roles,
            'hak' => $userHak,
        ]);
        // dd($req->all());

        return redirect('admin/user')->with('success', 'User created successfully.');
    }

    public function inputUser()
    {
        $unit_kerja = DB::table('unit_kerja')->get();
        return view('auth.createUser', compact('unit_kerja'));
    }

    public function daftarUser(Request $req)
    {
        $user = Auth::user();
        $hak = $user->hak;

        if ($hak === 'admin') {
            $userlist = DB::table('users')
            ->join('unit_kerja', 'users.user_unit_id', '=', 'unit_kerja.unit_id')
            ->select(
                'users.*', 
                'unit_kerja.*',
                )
            ->paginate(15);
        } else {
            $userlist = collect(); // Return an empty collection if the hak is not recognized
        }

        return view('auth.user', compact('userlist'));
    }

    // public function daftarUser(Request $req){
    
    //     $user = Auth::user();
    //     $hak = $user->hak;

    //     if ($hak === 'admin') {
    //         $userlist = DB::table('users')->paginate(15);
    //     } else {
    //         $userlist = collect(); // Return an empty collection if the hak is not recognized
    //     }

    //     return view('auth.user', compact('userlist'));
    // }

    public function hapusUser($id){
        DB::table("users")->where('id','=',$id)->delete();

        return redirect('admin/user');
    }

}
