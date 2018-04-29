<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mapel;
use App\DaftarBidangKeahlian;

use Auth;

class MapelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mapel = Mapel::join('daftar_bidang_keahlian', 'mapel.id_daftar_bidang', '=', 'daftar_bidang_keahlian.id_daftar_bidang')->get();
        
        return view('admin.mapel.index', compact('mapel'));
    }

    public function create()
    {
        $bidangKeahlian = DaftarBidangKeahlian::all();

        return view('admin.mapel.create', compact('bidangKeahlian'));
    }

    public function store(Request $request)
    {
        $mapel = new Mapel;
    	$mapel->nama_mapel = $request['nama_mapel'];
    	$mapel->id_daftar_bidang = $request['bidang_keahlian'];
    	$mapel->save();

        $buatLog = array(
            'Nama Mapel' => $mapel->nama_mapel,
            'Bidang Keahlian' => $mapel->id_daftar_bidang,
        );
        \Log::info(Auth::user()->username.' menambah data mapel.', $buatLog);
        return redirect('/mapel')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mapel = Mapel::find(base64_decode($id));
        $bidangKeahlian = DaftarBidangKeahlian::all();

        return view('admin.mapel.edit', compact('mapel', 'bidangKeahlian'));
    }

    public function update(Request $request, $id)
    {
        $mapel = mapel::find(base64_decode($id));
        $mapel->nama_mapel = $request['nama_mapel'];
        $mapel->id_daftar_bidang = $request['bidang_keahlian'];
        $mapel->save();

        $buatLog = array(
            'Nama Mapel' => $mapel->nama_mapel,
            'Bidang Keahlian' => $mapel->id_daftar_bidang,
        );
        \Log::info(Auth::user()->username.' mengubah data mapel dengan id : '.$mapel->id_mapel, $buatLog);
        return redirect('mapel')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $mapel = mapel::find(base64_decode($id));
        
        if($mapel->delete()) {
            $buatLog = array(
                'Nama Mapel' => $mapel->nama_mapel,
                'Bidang Keahlian' => $mapel->id_daftar_bidang,
            );
            \Log::info(Auth::user()->username.' menghapus data mapel dengan id : '.$mapel->id_mapel, $buatLog);
            return redirect('/mapel')->with('success', 'Penghapusan berhasil');
        }else return redirect()->back();
    }
}
