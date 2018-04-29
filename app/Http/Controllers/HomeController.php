<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterSiswaRequest;
use App\Http\Requests\LoginRequest;

use App\Kelas;
use App\User;
use App\Siswa;
use Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::user()){
            return redirect('/beranda');
        }

        $kelas = Kelas::all();

        return view('/home', compact('kelas'));
    }

    public function registerSiswa(RegisterSiswaRequest $data){
        $user = User::create([
            'username' => $data['username'],
            'email'    => $data['email'],
            'hak_akses'=> 'siswa', 
            'password' => bcrypt($data['password']),
        ]);

        if($user){
            \Log::info('User berhasil dibuat dengan username : ', [$user->username]);
            $siswa = Siswa::create([
                'nis'           => $data['nis'],
                'id_users'      => $user->id_users,
                'id_kelas'      => Kelas::where('nama_kelas', $data['kelas'])->first()->id_kelas,
                'nama'          => $data['nama'],
                'jenis_kelamin' => $data['jenisKelamin'],
                'foto'          => 'nophoto.jpg',    
            ]);

            if($siswa){
                \Log::info('Siswa berhasil ditambahkan dengan nis : ', [$siswa->nis]);
                return response()->json(['success', true]);
            }
        }
    }

    public function login(LoginRequest $request){
        if(Auth::attempt(['username' => $request->usernameLogin, 'password' => $request->passwordLogin])) {
            $user = array(
                'username' => Auth::user()->username,
            );
            \Log::info('User ini telah login : ', $user);

            return redirect('/beranda');
        }else{
            return redirect('/')->with('error', 'Username dan Password tidak cocok');
        } 
    }

    public function logout(){
        $user = array(
            'hak_akses' => Auth::user()->hak_akses,
            'username' => Auth::user()->username,
        );
        // return $user;
        \Log::info('User ini telah logout : ', $user);
    
        Auth::logout();
        
        return redirect('/');
    }
}
