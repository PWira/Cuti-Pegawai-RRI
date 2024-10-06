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
        $role = $user->role;
        $asal = $user->asal;
        $jabatan = $user->jabatan;

        return compact('role', 'asal', 'jabatan');
    }

    public function createUser(Request $req)
    {

        $name = strtolower(str_replace(' ', '_', $req->input('name')));
        $role = strtolower(str_replace(' ', '_', $req->input('role')));

        $validator = Validator::make($req->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'asal' => ['required', 'string'],
            'jabatan' => ['required', 'string'],
            'role' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'asal' => $req->asal,
            'jabatan' => $req->jabatan,
            'role' => $role,
        ]);

        return redirect('admin/user')->with('success', 'User created successfully.');
    }

    public function daftarUser(Request $req){
    
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'admin') {
            $userlist = DB::table('users')->paginate(15);
        } else {
            $userlist = collect(); // Return an empty collection if the role is not recognized
        }

        return view('auth.user', compact('userlist'));
    }

    public function hapusUser($pid){
        DB::table("users")->where('pid','=',$pid)->delete();

        return redirect('admin/user');
    }

}
