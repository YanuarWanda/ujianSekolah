<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jurusan;

class JurusanController extends Controller
{
    public function index(){
        $jurusan = Jurusan::all();

        return view('admin.jurusan.index', compact('jurusan'));
    }

    public function create(){
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_jurusan' => 'required',
        ],
        [
            'nama_jurusan.required' => 'Nama Jurusan harus diisi',
        ]);

        $jurusan = new Jurusan;
    	$jurusan->nama_jurusan = $request['nama_jurusan'];
    	$jurusan->save();

        return redirect('/kelas/add')->with('success', 'Pendaftaran berhasil');
    }

    public function edit($id)
    {
        $jurusan = Jurusan::find(base64_decode($id));

        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama_jurusan' => 'required',
        ],
        [
            'nama_jurusan.required' => 'Nama Jurusan harus diisi',
        ]);
        
        $jurusan = jurusan::find(base64_decode($id));
        $jurusan->nama_jurusan = $request['nama_jurusan'];

        $jurusan->save();

        return back()->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $jurusan = jurusan::find(base64_decode($id));
        
        if($jurusan->delete()) {
            return back()->with('success', 'Penghapusan berhasil');
        }else return redirect()->back();
    }
}
