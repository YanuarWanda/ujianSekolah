<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DaftarBidangKeahlian;

class BidangKeahlianController extends Controller
{
    public function index()
    {
        $bidangKeahlian = DaftarBidangKeahlian::all();

        return view('admin.bidang_keahlian.index', compact('bidangKeahlian'));
    }

    public function create()
    {
        return view('admin.bidang_keahlian.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'bidang_keahlian' => 'required',
        ],
        [
            'bidang_keahlian.required' => 'Bidang Keahlian harus diisi',
        ]);

        $daftar_bidang_keahlian = new DaftarBidangKeahlian;
    	$daftar_bidang_keahlian->bidang_keahlian = $request['bidang_keahlian'];
    	$daftar_bidang_keahlian->save();

        return redirect('/bidang_keahlian')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $bidang_keahlian = DaftarBidangKeahlian::find(base64_decode($id));

        return view('admin.bidang_keahlian.edit', compact('bidang_keahlian'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'bidang_keahlian' => 'required',
        ],
        [
            'bidang_keahlian.required' => 'Bidang Keahlian harus diisi',
        ]);
        
        $daftar_bidang_keahlian = DaftarBidangKeahlian::find(base64_decode($id));
        $daftar_bidang_keahlian->bidang_keahlian = $request['bidang_keahlian'];

        $daftar_bidang_keahlian->save();

        return redirect('/bidang_keahlian')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $daftar_bidang_keahlian = DaftarBidangKeahlian::find(base64_decode($id));
        
        if($daftar_bidang_keahlian->delete()) {
            return redirect('/bidang_keahlian')->with('success', 'Penghapusan berhasil');
        }else return redirect()->back();
    }
}
