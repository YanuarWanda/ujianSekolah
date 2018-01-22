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

    // Menampilkan Form registrasi siswa
    public function studentRegisterForm() {
        $kelas = Kelas::All();
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
            // Mengisi table siswa jika table user di isi
            $siswa = Siswa::create([
                'nis' => $data['nis'],
                'id' => $user->id,
                'id_kelas' => Kelas::where('nama_kelas', $data['kelas'])->first()->id_kelas,
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'jenis_kelamin' => $data['jenisKelamin'],
                // 'email' => $data['email'],
                'jurusan' => $data['jurusan'],
                'foto' => "nophoto.jpg", // Untuk sementara dikosongkan
            ]);
        }

        return redirect('/')->with('success', 'Pendaftaran Berhasil');
    }

    // Validasi form siswa
    public function studentRegisterValidation($request) {
        return $this->validate($request, [
            'username' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
            return redirect('/home');
        } else return redirect('/login')->with('error', 'Login Gagal');
    }

}
