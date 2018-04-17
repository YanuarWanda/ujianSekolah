<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Jurusan;

class KelasController extends Controller
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
        $kelas = Kelas::all();
        return view('admin.kelola-kelas.tableView', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$jurusan = Jurusan::all();

        if($jurusan->count() < 1) {
            return redirect(route('jurusan.create'))->with('warning', 'Silahkan tambah jurusan terlebih dahulu');
        }

        return view('admin.kelola-kelas.create', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$kelas = new Kelas;
    	$kelas->nama_kelas = $request['nama_kelas'];
    	$kelas->id_jurusan = Jurusan::select('id_jurusan')->where('nama_jurusan', $request['jurusan'])->first()['id_jurusan'];

    	// return $kelas->id_jurusan;
    	$kelas->save();

        return redirect('/kelola-kelas')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Tampilkan detail, tapi kosong
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = kelas::find(base64_decode($id));
        $jurusan = Jurusan::all();
        return view('admin.kelola-kelas.edit', compact('data', 'jurusan'));
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
        $kelas = kelas::find(base64_decode($id));
        $kelas->nama_kelas = $request['nama_kelas'];
        $kelas->id_jurusan = Jurusan::select('id_jurusan')->where('nama_jurusan', $request['jurusan'])->first()['id_jurusan'];

        $kelas->save();

        return redirect('/kelola-kelas')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = kelas::find(base64_decode($id));
        
        
        if($kelas->delete()) {
            return redirect('/kelola-kelas')->with('success', 'Penghapusan berhasil');
        }else return redirect()->back();
    }
}
