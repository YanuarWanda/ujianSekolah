<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Guru;
use App\Siswa;
use App\Kelas;

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
        $user = array(
            'hak_akses' => Auth::user()->hak_akses,
            'username' => Auth::user()->username,
        );
        \Log::info('Mengakses home', $user);

        if(Auth::user()->hak_akses == 'admin') {
            return view('admin.dashboard');
        } else if(Auth::user()->hak_akses == 'guru') {
            return view('home');
        } else if(Auth::user()->hak_akses == 'siswa') {
            return view('home');
        } 
    }

    public function settings() {
        if(Auth::user()->hak_akses == 'admin') {
            return view('settings.setting');
        } else if(Auth::user()->hak_akses == 'guru') {
            $data = Guru::where('id', Auth::user()->id)->first();
            return view('settings.setting', compact('data'));
        } else if(Auth::user()->hak_akses == 'siswa') {
            $data = Siswa::where('id', Auth::user()->id)->first();
            $kelas = Kelas::All();
            // return $data->nis;
            return view('settings.setting', compact('data', 'kelas'));
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
