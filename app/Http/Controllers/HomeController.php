<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Guru;
use App\Siswa;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hak_akses == 'admin') {
            return view('admin.dashboard');
        } else if(Auth::user()->hak_akses == 'guru') {
            return view('home')->with('success', 'AKSES - GURU');
        } else if(Auth::user()->hak_akses == 'siswa') {
            return view('home')->with('success', 'AKSES - SISWA');
        } 
    }

    public function settings() {
        if(Auth::user()->hak_akses == 'admin') {
            return view('setting');
        } else if(Auth::user()->hak_akses == 'guru') {
            $guru = Guru::where('id', Auth::user()->id);
            return $guru;
        } else if(Auth::user()->hak_akses == 'siswa') {
            $siswa = Siswa::where('id', Auth::user()->id)->get();
            return view('setting', compact('siswa'));
        } 
    }

    // Function untuk mengubah password dari semua user
    public function ubahPassword(Request $request, $id) {
        $this->validate($request, [
            'password' =>'required|string|confirmed',
        ]);
    
        $user = User::find(base64_decode($id));

        $user->password = bcrypt($request['password']);
        $user->save();

        return redirect('/home')->with('success', 'Password berhasil diubah');
    }

}
