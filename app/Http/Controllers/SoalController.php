<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ujian;
use App\Soal;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $ujian = Ujian::find(base64_decode($id));

        return view('admin.kelola-soal.create', compact('ujian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $ujian = Ujian::find(base64_decode($id));

        switch($request['jawaban']){
            case 'A':
                $jawaban = $request['pilihanA'];
            case 'B':
                $jawaban = $request['pilihanB'];
            case 'C':
                $jawaban = $request['pilihanC'];
            case 'D':
                $jawaban = $request['pilihanD'];
            case 'E':
                $jawaban = $request['pilihanE'];
        }

        $pilihan = $request['pilihanA']." ,  ".$request['pilihanB']." ,  ".$request['pilihanC']." ,  ".$request['pilihanD']." ,  ".$request['pilihanE'];

        $soal = Soal::create([
            'id_ujian'  => $ujian['id_ujian'],
            'tipe'      => $request['tipe'],
            'isi_soal'  => $request['soal'],
            'pilihan'   => $pilihan,
            'jawaban'   => $jawaban
        ]);

        if($soal){
            return redirect('/kelola-ujian')->with('success', 'Tambah Soal Berhasil!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $soal = Soal::find(base64_decode($id));
        $pilihan = explode(' ,  ', $soal['pilihan']);

        // dd($pilihan);
        return view('admin.kelola-soal.edit', compact('soal', 'pilihan'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
