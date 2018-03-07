<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mapel;
use App\DaftarBidangKeahlian;

class MapelController extends Controller
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
        $mapel = Mapel::all();
        return view('admin.kelola-mapel.tableView', compact('mapel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$daftar_bidang_keahlian = DaftarBidangKeahlian::all();
        return view('admin.kelola-mapel.create', compact('daftar_bidang_keahlian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$mapel = new Mapel;
    	$mapel->nama_mapel = $request['nama_mapel'];
    	$mapel->id_daftar_bidang = DaftarBidangKeahlian::select('id_daftar_bidang')->where('bidang_keahlian', $request['bidang_keahlian'])->first()['id_daftar_bidang'];
    	$mapel->save();

        return redirect('/kelola-mapel')->with('success', 'Data berhasil ditambahkan');
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
        $data = mapel::find(base64_decode($id));
        $daftar_bidang_keahlian = DaftarBidangKeahlian::all();
        return view('admin.kelola-mapel.edit', compact('data', 'daftar_bidang_keahlian'));
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
        $mapel = mapel::find(base64_decode($id));
        $mapel->nama_mapel = $request['nama_mapel'];
        $mapel->id_daftar_bidang = DaftarBidangKeahlian::select('id_daftar_bidang')->where('bidang_keahlian', $request['bidang_keahlian'])->first()['id_daftar_bidang'];

        $mapel->save();

        return redirect('/kelola-mapel')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mapel = mapel::find(base64_decode($id));
        
        
        if($mapel->delete()) {
            return redirect('/kelola-mapel')->with('success', 'Penghapusan berhasil');
        }else return redirect()->back();
    }
}
