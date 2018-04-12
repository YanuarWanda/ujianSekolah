<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kelas;
use App\User;
use App\Siswa;

use Auth;

class CustomAuthController extends Controller
{
    protected $redirectTo = '/home'; // Redirect website jika user sudah login

    public function __construct()
    {
        $this->middleware('guest');
    }

    //copas hela nya.
    public function ambil($file){
        $fileNameFull = $file->getClientOriginalName();
        $name = pathinfo($fileNameFull, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $nameFinal = $name.'_'.time().'.'.$extension;

        $file->storeAs('public/foto-profil', $nameFinal);

        return $nameFinal;
    }

    // Menampilkan Form registrasi siswa
    public function studentRegisterForm() {
        $kelas = Kelas::where('nama_kelas', 'NOT LIKE', '%ALUMNI%')->get(['id_kelas', 'nama_kelas']);
        return view('custom-auth.register', compact('kelas')); // Menampilkan form + data kelas dari DB
    }

    // Melakukan registrasi siswa
    public function registerStudent(Request $data) {

        $this->studentRegisterValidation($data);

        // Mengisi table user
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'hak_akses' => 'siswa',
            'password' => bcrypt($data['password']),
        ]);

        if($user) {
            
            $siswa = Siswa::create([
                'nis' => $data['nis'],
                'id_users' => $user->id_users,
                'id_kelas' => Kelas::where('id_kelas', $data['kelas'])->first()->id_kelas,
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'jenis_kelamin' => $data['jenisKelamin'],
                // 'email' => $data['email'], // Dipindah ke table users
                // 'jurusan' => $data['jurusan'], // Dipindah ke table jurusan, dengan relasi ke siswa melalui table kelas
                'foto' => "nophoto.jpg", // Untuk sementara dikosongkan
            ]);

            \Log::info('Pendaftaran berhasil', [$siswa->nama]);
        }
        return redirect('/login')->with('success', 'Pendaftaran Berhasil');
    }

    // Validasi form siswa
    public function studentRegisterValidation($request) {
        return $this->validate($request, [
            'nis' => 'required|numeric|digits:10|unique:siswa',
            'nama' => 'required',
            'username' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'jenisKelamin' => 'required',    
        ]);
    }

    public function loginForm() {
        return view('custom-auth.login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = array(
                'hak_akses' => Auth::user()->hak_akses,
                'username' => Auth::user()->username,
            );
            \Log::info('Logged In', $user);

            return redirect('/home');
        } else return redirect('/login')->with('error', 'Login Gagal');
    }
}
