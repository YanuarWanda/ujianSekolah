<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ujian;
use App\Soal;
use App\Nilai;

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
        $this->validate($request, [
            'jawaban'   => 'required',
            'soal'      => 'required',
            'tipe'      => 'required'
        ]);

        $ujian = Ujian::find(base64_decode($id));

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
        }

        $soal = Soal::create([
            'id_ujian'  => $ujian['id_ujian'],
            'tipe'      => $request['tipe'],
            'isi_soal'  => $request['soal'],
            'pilihan'   => $pilihan,
            'jawaban'   => $jawaban
        ]);

        if($soal){
            return redirect('/kelola-ujian/edit/'.base64_encode($ujian->id_ujian))->with('success', 'Data berhasil ditambahkan!');
        }else{
            return redirect('/kelola-ujian/edit/'.base64_encode($ujian->id_ujian))->with('error', 'Data gagal ditambahkan!');
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
        $ujian = Ujian::where('id_ujian', $soal->id_ujian)->get()->first();
        $pilihan = explode(' ,  ', $soal['pilihan']);

        // return $ujian;
        return view('admin.kelola-soal.edit', compact('soal', 'pilihan', 'ujian'));
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
        $soal = Soal::find(base64_decode($id));

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
        }

        $soal->tipe        = $request['tipe'];
        $soal->isi_soal    = $request['soal'];
        $soal->pilihan     = $pilihan;
        $soal->jawaban     = $jawaban;

        // dd($request['tipe']);

        if($soal->save()){
            return redirect('/kelola-ujian/edit/'.base64_encode($soal['id_ujian']))->with('success', 'Update Soal Berhasil!');
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
        $soal = Soal::find(base64_decode($id));

        if($soal){
            $soal->delete();

            return redirect('/kelola-ujian/edit/'.base64_encode($soal->id_ujian))->with('success', 'Data berhasil dihapus!');
        }else{
            return redirect('/kelola-ujian/edit/'.base64_encode($soal->id_ujian))->with('error', 'Data gagal dihapus!');
        }
    }

    public function daftarNilai($id){
        $nilai          = Nilai::join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->where('id_ujian', base64_decode($id))->orderBy('id_kelas', 'asc')->get();
        $jumlahNilai    = Nilai::join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->groupBy('kelas.id_kelas')->get();

        // return $jumlahNilai[1]['nama_kelas'];
        return view('admin.kelola-nilai.daftar_nilai', compact('nilai', 'jumlahNilai'));
    }
}
