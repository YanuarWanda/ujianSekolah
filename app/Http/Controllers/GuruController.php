<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Guru;
use App\User;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::All();
        return view('admin.kelola-guru.tableView', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kelola-guru.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->validate($request, [
            'nip' => 'required|integer|unique:users',
            'username' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $message = [
            'integer' => ':attribute harus angka',
        ];

        $validator = Validator::make($request, $rules, $message);

        $user = new User;
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->hak_akses = 'guru';


        if($user->save()) {
            $guru = new Guru;
            $guru->nip = $request['nip'];
            $guru->id = $user->id;
            $guru->bidang_keahlian = $request['bidangKeahlian'];
            $guru->nama = $request['nama'];
            $guru->alamat = $request['alamat'];
            $guru->jenis_kelamin = $request['jenisKelamin'];

            if($request->file('foto')){
                $nameFotoToStore = $this->ambil($request->file('foto'));
                $guru->foto = $nameFotoToStore;
            }

            $guru->save();
        }

        return redirect('/kelola-guru')->with('success', 'Pendaftaran berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Guru::find(base64_decode($id));
        // return $data;
        return view('admin.kelola-guru.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Guru::find(base64_decode($id));
        // return $data;
        return view('admin.kelola-guru.edit', compact('data'));
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

        $guru = Guru::find(base64_decode($id));
        $user = User::find($guru->id);

        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->hak_akses = 'guru';


        if($user->save()) {
            $guru->nip = $request['nip'];
            $guru->id = $user->id;
            $guru->bidang_keahlian = $request['bidangKeahlian'];
            $guru->nama = $request['nama'];
            $guru->alamat = $request['alamat'];
            $guru->jenis_kelamin = $request['jenisKelamin'];

            if($request->file('foto')){
                $nameFotoToStore = $this->ambil($request->file('foto'));
                $guru->foto = $nameFotoToStore;
            }

            $guru->save();
        }

        return redirect('/kelola-guru')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru = Guru::find(base64_decode($id));
        $user = User::find($guru->id);

        if($guru && $user) {
            $guru->delete();
            $user->delete();

            return redirect('/kelola-guru')->with('success', 'Data Dihapus');
        }
        else return redirect('/kelola-guru')->with('error', 'Penghapusan gagal');
    }

    public function storeDataGuru(Request $request, $id) {
        $this->validate($request, [
            'nip' => 'required',
            'nama' => 'required',
            'username' => 'required',
        ]);

        $guru = Guru::find(base64_decode($id));
        $guru->nip = $request['nip'];
        $guru->bidang_keahlian = $request['bidangKeahlian'];
        $guru->nama = $request['nama'];
        $guru->alamat = $request['alamat'];
        $guru->jenis_kelamin = $request['jenisKelamin'];

        if($request->file('foto')){
            $nameFotoToStore = $this->ambil($request->file('foto'));
            $guru->foto = $nameFotoToStore;
        }

        $user = User::find($guru->id);
        $user->username = $request['username'];

        if($user->save() && $guru->save()) {
            return redirect('/home')->with('success', 'Data berhasil diubah');    
        } else return redirect('/settings')->with('error', 'Data gagal diubah');
    }

}
