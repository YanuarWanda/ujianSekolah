<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DaftarBidangKeahlian;

class DaftarBidangKeahlianController extends Controller
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
        $daftar_bidang_keahlian = DaftarBidangKeahlian::all();
        return view('admin.kelola-bidang.tableView', compact('daftar_bidang_keahlian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kelola-bidang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$daftar_bidang_keahlian = new DaftarBidangKeahlian;
    	$daftar_bidang_keahlian->bidang_keahlian = $request['bidang_keahlian'];
    	$daftar_bidang_keahlian->save();

        return redirect('/kelola-bidang')->with('success', 'Pendaftaran berhasil');
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
        $data = DaftarBidangKeahlian::find(base64_decode($id));

        return view('admin.kelola-bidang.edit', compact('data'));
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
        $daftar_bidang_keahlian = DaftarBidangKeahlian::find(base64_decode($id));
        $daftar_bidang_keahlian->bidang_keahlian = $request['bidang_keahlian'];

        $daftar_bidang_keahlian->save();

        return redirect('/kelola-bidang')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $daftar_bidang_keahlian = DaftarBidangKeahlian::find(base64_decode($id));
        
        
        if($daftar_bidang_keahlian->delete()) {
            return redirect('/kelola-bidang')->with('success', 'Penghapusan berhasil');
        }else return redirect()->back();
    }
}
