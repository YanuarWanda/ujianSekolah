<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Siswa;
use App\User;
use App\Kelas;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::All();
        return view('admin.kelola-siswa.tableView', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::All();
        return view('admin.kelola-siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        $this->validate($request, [
            'nis' => 'required|string|max:10|unique:siswa',
            'username' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

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
                // 'email' => $data['email'], // Dipindah ke table users
                // 'jurusan' => $data['jurusan'], // Dipindah ke table jurusan, dengan relasi ke table kelas
                'foto' => "nophoto.jpg", // Untuk sementara dikosongkan
            ]);
        }

        return redirect('/kelola-siswa')->with('success', 'Pendaftaran Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Siswa::find(base64_decode($id));
        // return $data;
        return view('admin.kelola-siswa.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Siswa::find(base64_decode($id));
        $kelas = Kelas::All();
        // return $data;
        return view('admin.kelola-siswa.edit', compact('data', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $siswa = Siswa::find(base64_decode($id));
        $user = User::find($siswa->id);

        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->hak_akses = 'siswa';
        
        
        if($user->save()) {
            $siswa->nis = $request['nis'];
            $siswa->id = $user->id;
            $siswa->id_kelas = Kelas::where('nama_kelas', $request['kelas'])->first()->id_kelas;
            $siswa->nama = $request['nama'];
            $siswa->alamat = $request['alamat'];
            // $siswa->jurusan = $request['jurusan']; // Dipindah ke tablenya sendiri, dengan relasi melalui table kelas
            $siswa->jenis_kelamin = $request['jenisKelamin'];
            $siswa->foto = "nophoto.jpg";

            $siswa->save();
        }
        
        return redirect('/kelola-siswa')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find(base64_decode($id));
        $user = User::find($siswa->id);

        if($siswa && $user) {
            $siswa->delete();
            $user->delete();

            return redirect('/kelola-siswa')->with('success', 'Data Dihapus');
        }
        else return redirect('/kelola-siswa')->with('error', 'Penghapusan gagal');
    }
}
