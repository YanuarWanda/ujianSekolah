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

use App\Mapel;
use App\DaftarBidangKeahlian;

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
        $mapel = Mapel::all();
        $bidangKeahlian = DaftarBidangKeahlian::all();
        return view('admin.kelola-bank-soal.create', compact('mapel', 'bidangKeahlian'));
    }

	public function store(Request $request)
    {
        $this->validate($request, [
            'soal'     	=> 'required',
            'tipe'      	=> 'required',
            'jawaban'      		=> 'required'
        ]);

        if($request['tipe'] == 'PG'){
            $pilihan = $request['pilihanA']." ,  ".$request['pilihanB']." ,  ".$request['pilihanC']." ,  ".$request['pilihanD']." ,  ".$request['pilihanE'];

            if($request['jawaban'] == 'A'){
                $jawaban = $request['pilihanA'];
            }else if($request['jawaban'] == 'B'){
                $jawaban = $request['pilihanB'];
            }else if($request['jawaban'] == 'C'){
                $jawaban = $request['pilihanC'];
            }else if($request['jawaban'] == 'D'){
                $jawaban = $request['pilihanD'];
            }else if($request['jawaban'] == 'E'){
                $jawaban = $request['pilihanE'];
            }

        }else if($request['tipe'] == 'BS'){
            $pilihan = 'Benar ,  Salah';

            if($request['jawaban'] == 'Benar'){
                $jawaban = "Benar";
            }else if($request['jawaban'] == 'Salah'){
                $jawaban = "Salah";
            }
        }else if($request['tipe'] == 'MC'){
            $pilihan = $request['pilihanA']." ,  ".$request['pilihanB']." ,  ".$request['pilihanC']." ,  ".$request['pilihanD']." ,  ".$request['pilihanE'];

            $jawaban = '';
            foreach($request['jawabanMC'] as $j => $jajang){
                if($jajang == 'A'){
                    $jawabanA = $request['pilihanA']." ,  ";break;
                }else{
                    $jawabanA = ''.' ,  ';
                }
            }

            foreach($request['jawabanMC'] as $j => $jajang){
                if($jajang == 'B'){
                    $jawabanB = $request['pilihanB']." ,  ";break;
                }else{
                    $jawabanB = ''.' ,  ';
                }
            }

            foreach($request['jawabanMC'] as $j => $jajang){
                if($jajang == 'C'){
                    $jawabanC = $request['pilihanC']." ,  ";break;
                }else{
                    $jawabanC = ''.' ,  ';
                }
            }

            foreach($request['jawabanMC'] as $j => $jajang){
                if($jajang == 'D'){
                    $jawabanD = $request['pilihanD']." ,  ";break;
                }else{
                    $jawabanD = ''.' ,  ';
                }
            }

            foreach($request['jawabanMC'] as $j => $jajang){
                if($jajang == 'E'){
                    $jawabanE = $request['pilihanE'];break;
                }else{
                    $jawabanE = '';
                }
            }

            $jawaban = $jawabanA.$jawabanB.$jawabanC.$jawabanD.$jawabanE;
            // return explode(" ,  ", $jawaban);
        }

        $banksoal = Banksoal::create([
           	'tipe'              => $request['tipe'],
            'isi_soal'          => $request['soal'],
            'pilihan'           => $pilihan,
            'jawaban'           => $jawaban,
            'id_daftar_bidang'  => $request['bidangKeahlian']
        ]);

        return redirect('/kelola-bank-soal')->with('success', 'Penambahan Data Soal Berhasil');

    }

    public function edit($id)
    {
        $soal       = BankSoal::find($id);
        // return $soal;
        $pilihan    = explode(' ,  ', $soal['pilihan']);
        $jawaban    = $soal->jawaban;
        if($soal->tipe == 'MC'){
            $jawaban = explode(' ,  ', $jawaban);
            unset($jawaban[5]);
        }

        $mapel = Mapel::all();
        $bidangKeahlian = DaftarBidangKeahlian::all();

        // return $pilihan['0'];
        return view('admin.kelola-bank-soal.edit', compact('soal', 'pilihan', 'jawaban', 'bidangKeahlian', 'mapel'));
    }

    public function delete($id) {
        $soal = BankSoal::find($id);

        if($soal->soal){
            return redirect()->back()->with('error', 'Soal sedang digunakan dalam sebuah ujian!');
        }else {
            if($soal){
                $soal->delete();

                return redirect()->back()->with('success', 'Data berhasil dihapus!');
            }else{
                return redirect()->back()->with('error', 'Data gagal dihapus!');
            }
        }
    }

 }