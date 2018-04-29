<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kelas;
use App\Jurusan;

use Auth;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kelas = Kelas::join('jurusan', 'kelas.id_jurusan', '=', 'jurusan.id_jurusan')->get();

        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();

        return view('admin.kelas.create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $kelas = new Kelas;
    	$kelas->nama_kelas = $request['nama_kelas'];
    	$kelas->id_jurusan = $request['jurusan'];
    	$kelas->save();

        $buatLog = array(
            'Nama Kelas' => $kelas->nama_kelas,
            'Jurusan' => $kelas->id_jurusan,
        );
        \Log::info(Auth::user()->username.' menambahkan data kelas.', $buatLog);
        return redirect('/kelas')->with('success', 'Data berhasil ditambahkan');      
    }

    public function edit($id)
    {
        $kelas = Kelas::find(base64_decode($id));
        $jurusan = Jurusan::all();

        return view('admin.kelas.edit', compact('kelas', 'jurusan'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::find(base64_decode($id));
        $kelas->nama_kelas = $request['nama_kelas'];
        $kelas->id_jurusan = $request['jurusan'];
        $kelas->save();

        $buatLog = array(
            'Nama Kelas' => $kelas->nama_kelas,
            'Jurusan' => $kelas->id_jurusan,
        );
        \Log::info(Auth::user()->username.' mengubah data kelas dengan id : '.$kelas->id_kelas, $buatLog);
        return redirect('/kelas')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $kelas = kelas::find(base64_decode($id));
        
        if($kelas->delete()) {
            $buatLog = array(
                'Nama Kelas' => $kelas->nama_kelas,
                'Jurusan' => $kelas->id_jurusan,
            );
            \Log::info(Auth::user()->username.' menghapus data kelas dengan id : '.$kelas->id_kelas, $buatLog);
            return redirect('/kelas')->with('success', 'Penghapusan berhasil');
        }else return redirect()->back();
    }
}
