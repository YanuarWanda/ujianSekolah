<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ujian;
use App\UjianRemedial;
use App\BankSoal;
use App\SoalRemed;

class SoalRemedController extends Controller
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
        $ujianRemedial = UjianRemedial::where('id_ujian', '=', base64_decode($id))->get()->first();

        return view('admin.kelola-soal-remed.create', compact('ujian', 'ujianRemedial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'point'     => 'required|integer',
            'soal'      => 'required',
            'tipe'      => 'required'
        ]);

        $ujian = Ujian::find(base64_decode($id));
        $ujianRemedial = UjianRemedial::where('id_ujian', '=', base64_decode($id))->get()->first();

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

        $soal = BankSoal::create([
            'tipe'              => $request['tipe'],
            'isi_soal'          => $request['soal'],
            'pilihan'           => $pilihan,
            'jawaban'           => $jawaban,
            'id_daftar_bidang'  => $ujian->mapel->daftar_bidang_keahlian->id_daftar_bidang,
        ]);

        if($soal){
            $soalUjian = SoalRemed::create([
                'id_ujian_remedial' => $ujianRemedial['id_ujian_remedial'],
                'id_bank_soal'      => $soal['id_bank_soal'],
                'point'             => $request['point'],
            ]);

            if($soalUjian){
                return redirect('/kelola-remed/edit/'.base64_encode($ujian->id_ujian))->with('success', 'Data berhasil ditambahkan!');
            }
        }
        return redirect('/kelola-remed/edit/'.base64_encode($ujian->id_ujian))->with('error', 'Data gagal ditambahkan!');
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
        $soal       = SoalRemed::find(base64_decode($id));
        $ujian      = UjianRemedial::where('id_ujian_remedial', '=', $soal->id_ujian_remedial)->get()->first();
        $pilihan    = explode(' ,  ', $soal->bankSoal['pilihan']);
        $jawaban    = $soal->bankSoal['jawaban'];
        if($soal->bankSoal['tipe'] == 'MC'){
            $jawaban = explode(' ,  ', $jawaban);
            unset($jawaban[5]);
        }

        // return $soal;
        return view('admin.kelola-soal-remed.edit', compact('soal', 'pilihan', 'ujian', 'jawaban'));
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
        $soal = SoalRemed::find(base64_decode($id));
        $ujianRemedial = UjianRemedial::find($soal->id_ujian_remedial);
        $bankSoal = BankSoal::find($soal['id_bank_soal']);

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
        }

        // return explode(' ,  ', $jawaban);

        $bankSoal->tipe        = $request['tipe'];
        $bankSoal->isi_soal    = $request['soal'];
        $bankSoal->pilihan     = $pilihan;
        $bankSoal->jawaban     = $jawaban;
        // return $jawaban;
        $soal->point           = $request['point'];

        if($bankSoal->save() && $soal->save()){
            return redirect('/kelola-remed/edit/'.base64_encode($ujianRemedial['id_ujian']))->with('success', 'Update Soal Berhasil!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $soal = SoalRemed::find(base64_decode($id));
        $ujianRemedial = UjianRemedial::find($soal->id_ujian_remedial);

        if($soal){
            $soal->delete();

            return redirect('/kelola-remed/edit/'.base64_encode($ujianRemedial->id_ujian))->with('success', 'Data berhasil dihapus!');
        }else{
            return redirect('/kelola-remed/edit/'.base64_encode($ujianRemedial->id_ujian))->with('error', 'Data gagal dihapus!');
        }
    }
}
