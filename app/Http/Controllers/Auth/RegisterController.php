<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Siswa;
use App\Kelas;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:siswa',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // $siswa = new Siswa;
        // $siswa->nis = $data['nis'];
        // $siswa->id_user = 1;
        // $siswa->id_kelas = 1;
        // $siswa->nama = $data['nama'];
        // $siswa->alamat = $data['alamat'];
        // $siswa->jenis_kelamin = $data['jenisKelamin'];
        // $siswa->email = $data['email'];
        // $siswa->jurusan = 'rpl';
        // $siswa->foto = 'nope.png';

        // $siswa->save();
        
        // Mengisi table user
        $user = User::create([
            'username' => $data['username'],
            'hak_akses' => 'siswa',
            'password' => bcrypt($data['password']),
        ]);

        if($user) {
            // Mengisi table siswa jika table user di isi
            $siswa = Siswa::create([
                'nis' => $data['nis'],
                'id_user' => $user->id,
                'id_kelas' => Kelas::where('nama_kelas', $data['kelas'])->first()->id_kelas,
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'jenis_kelamin' => $data['jenisKelamin'],
                'email' => $data['email'],
                'jurusan' => $data['jurusan'],
                'foto' => "nophoto.jpg",
            ]);
        }

        return $user;
    }
}
