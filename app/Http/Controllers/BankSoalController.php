<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankSoal;
use App\Soal;
use App\JawabanSiswa;
use App\JawabanSiswaRemed;
use App\NilaiRemedial;
use App\SoalRemed;
use App\UjianRemedial;
use App\Nilai;


class BankSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$banksoal =Banksoal::all();
    	return view('admin.kelola-bank-soal.index', compact('banksoal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banksoal = Banksoal::all();

        return view('admin.kelola-bank-soal.create', compact('banksoal'));
    }

	public function store(Request $request)
    {
        $this->validate($request, [
            'isi_soal'     	=> 'required',
            'pilihan'      	=> 'required',
            'tipe'      	=> 'required',
            'pilihan'      	=> 'required',
            'jawaban'      		=> 'required',
            'id_daftar_bidang'  => 'required'
        ]);


        $banksoal = Banksoal::create([
           	'tipe'              => $request['tipe'],
            'isi_soal'          => $request['soal'],
            'pilihan'           => $pilihan,
            'jawaban'           => $jawaban,
            'id_daftar_bidang'  => $ujian->mapel->daftar_bidang_keahlian->id_daftar_bidang
        ]);

        // return $ujian->id_ujian;
        return redirect('/kelola-bank-soal')->with('success', 'Penambahan Data Soal Berhasil');

		$banksoal = Banksoal::all();

        }

    //  public function edit($id)
    // {
    //     $soal       = BankSoal::find($id);
    //     $pilihan    = explode(' ,  ', $soal->pilihan);
    //     $jawaban    = $soal->jawaban;
    //     // dd($pilihan['4']);
    //     if($soal->tipe == 'MC'){
    //         $jawaban = explode(' ,  ', $jawaban);
	   //  	// return $jawaban[];
    //         unset($jawaban[5]);
    //     }

    //     return view('admin.kelola-bank-soal.edit', compact('soal', 'pilihan', 'jawaban'));
    //  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



 }