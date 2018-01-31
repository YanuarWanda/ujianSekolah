<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ujian;
use App\Guru;
use App\Mapel;
use Auth;

class UjianController extends Controller
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
        $ujian = Ujian::All();
        return view('admin.kelola-ujian.dataView', compact('ujian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ujian = Ujian::All();
        $mapel = Mapel::All();
        return view('admin.kelola-ujian.create', compact('ujian', 'mapel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        $id = Auth::user()->id;

        if($data['catatan'] == '') {
            $data[catatan] == 'Tidak ada catatan.';
        }

        $ujian = Ujian::create([
           'id_mapel'           => Mapel::where('nama_mapel', $data['mapel'])->first()['id_mapel'],
           'nip'                => Guru::where('id', $id)->first()['nip'],
           'judul_ujian'        => $data['judul'],
           'waktu_pengerjaan'   => gmdate("H:i:s", $data['waktu_pengerjaan']),
           'tanggal_kadaluarsa' => $data['batas_pengerjaan'],
           'catatan' => $data['catatan'],
        ]);

        return redirect('/kelola-ujian')->with('success', 'Penambahan Data Ujian Berhasil');
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
        $data = Ujian::find(base64_decode($id));
        return view('admin.kelola-ujian.detail', compact('data'));
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

            if($request->file('foto')){
                $nameFotoToStore = $this->ambil($request->file('foto'));
                $siswa->foto = $nameFotoToStore;
            }


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

    // Mengupdate data user, dari menu settings
    public function storeDataSiswa(Request $request, $id) {
        $this->validate($request, [
            'nis' => 'required',
            'nama' => 'required',
            'username' => 'required',
        ]);

        $siswa = Siswa::find(base64_decode($id));
        $siswa->nis = $request['nis'];
        $siswa->nama = $request['nama'];
        $siswa->id_kelas = Kelas::where('nama_kelas', $request['kelas'])->first()->id_kelas;
        $siswa->alamat = $request['alamat'];
        $siswa->jenis_kelamin = $request['jenisKelamin'];

        if($request->file('foto')){
            $nameFotoToStore = $this->ambil($request->file('foto'));
            $siswa->foto = $nameFotoToStore;
        }

        $user = User::find($siswa->id);
        $user->username = $request['username'];

        if($user->save() && $siswa->save()) {
            return redirect('/home')->with('success', 'Data berhasil diubah');
        } else return redirect('/settings')->with('error', 'Data gagal diubah');
    }
}
