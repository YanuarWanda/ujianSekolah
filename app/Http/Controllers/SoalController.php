<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ujian;
use App\Soal;
use App\Nilai;
use App\BankSoal;
use App\JawabanSiswa;
use App\JawabanSiswaRemed;
use App\NilaiRemedial;
use App\SoalRemed;
use App\UjianRemedial;

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
            'point'     => 'required|integer',
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
            $soalUjian = Soal::create([
                'id_ujian'      => $ujian['id_ujian'],
                'id_bank_soal'  => $soal['id_bank_soal'],
                'point'         => $request['point'],
            ]);

            if($soalUjian){
                return redirect('/kelola-ujian/edit/'.base64_encode($ujian->id_ujian))->with('success', 'Data berhasil ditambahkan!');
            }
        }
        return redirect('/kelola-ujian/edit/'.base64_encode($ujian->id_ujian))->with('error', 'Data gagal ditambahkan!');
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
        $soal       = Soal::find(base64_decode($id));
        $ujian      = Ujian::where('id_ujian', $soal->id_ujian)->get()->first();
        $pilihan    = explode(' ,  ', $soal->bankSoal['pilihan']);
        $jawaban    = $soal->bankSoal['jawaban'];
        if($soal->bankSoal['tipe'] == 'MC'){
            $jawaban = explode(' ,  ', $jawaban);
            unset($jawaban[5]);
        }

        // return $pilihan['0'];
        return view('admin.kelola-soal.edit', compact('soal', 'pilihan', 'ujian', 'jawaban'));
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
        $nilaiRemed     = NilaiRemedial::join('siswa', 'nilai_remedial.id_siswa', '=', 'siswa.id_siswa')->join('ujian_remedial', 'nilai_remedial.id_ujian_remedial', '=', 'ujian_remedial.id_ujian_remedial')->where('id_ujian', base64_decode($id))->orderBy('id_kelas', 'asc')->get();
        $jumlahNilai    = Nilai::join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->join('kelas_ujian', 'kelas.id_kelas', '=', 'kelas_ujian.id_kelas')->join('ujian', 'nilai.id_ujian', '=', 'ujian.id_ujian')->where('ujian.id_ujian', base64_decode($id))->groupBy('kelas.id_kelas')->get();
        // $jumlahRemed1    = NilaiRemedial::join('siswa', 'nilai_remedial.id_siswa', '=', 'siswa.id_siswa')->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->join('ujian_remedial', 'nilai_remedial.id_ujian_remedial', '=', 'ujian_remedial.id_ujian_remedial')->where('ujian_remedial.id_ujian', base64_decode($id))->where('ujian_remedial.remed_ke', '1')->get();
        // $jumlahRemed2    = NilaiRemedial::join('siswa', 'nilai_remedial.id_siswa', '=', 'siswa.id_siswa')->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->join('ujian_remedial', 'nilai_remedial.id_ujian_remedial', '=', 'ujian_remedial.id_ujian_remedial')->where('ujian_remedial.id_ujian', base64_decode($id))->where('ujian_remedial.remed_ke', '2')->get();
        // $jumlahRemed3    = NilaiRemedial::join('siswa', 'nilai_remedial.id_siswa', '=', 'siswa.id_siswa')->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->join('ujian_remedial', 'nilai_remedial.id_ujian_remedial', '=', 'ujian_remedial.id_ujian_remedial')->where('ujian_remedial.id_ujian', base64_decode($id))->where('ujian_remedial.remed_ke', '3')->get();

        $jumlahRemed    = NilaiRemedial::join('siswa', 'nilai_remedial.id_siswa', '=', 'siswa.id_siswa')->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->join('ujian_remedial', 'nilai_remedial.id_ujian_remedial', '=', 'ujian_remedial.id_ujian_remedial')->where('ujian_remedial.id_ujian', base64_decode($id))->get();
      
        $jawabanUjian   = JawabanSiswa::join('soal', 'jawaban_siswa.id_soal', '=', 'soal.id_soal')->where('id_ujian', base64_decode($id))->get();
        // $jawabanRemed1   = JawabanSiswaRemed::join('soal_remed', 'jawaban_siswa_remed.id_soal_remedial', '=', 'soal_remed.id_soal_remedial')->join('ujian_remedial', 'soal_remed.id_ujian_remedial', '=', 'ujian_remedial.id_ujian_remedial')->where('ujian_remedial.id_ujian', base64_decode($id))->where('ujian_remedial.remed_ke', '1')->get();
        // $jawabanRemed2   = JawabanSiswaRemed::join('soal_remed', 'jawaban_siswa_remed.id_soal_remedial', '=', 'soal_remed.id_soal_remedial')->join('ujian_remedial', 'soal_remed.id_ujian_remedial', '=', 'ujian_remedial.id_ujian_remedial')->where('ujian_remedial.id_ujian', base64_decode($id))->where('ujian_remedial.remed_ke', '2')->get();
        // $jawabanRemed3   = JawabanSiswaRemed::join('soal_remed', 'jawaban_siswa_remed.id_soal_remedial', '=', 'soal_remed.id_soal_remedial')->join('ujian_remedial', 'soal_remed.id_ujian_remedial', '=', 'ujian_remedial.id_ujian_remedial')->where('ujian_remedial.id_ujian', base64_decode($id))->where('ujian_remedial.remed_ke', '3')->get();

        $jawabanRemed   = JawabanSiswaRemed::join('soal_remed', 'jawaban_siswa_remed.id_soal_remedial', '=', 'soal_remed.id_soal_remedial')->join('ujian_remedial', 'soal_remed.id_ujian_remedial', '=', 'ujian_remedial.id_ujian_remedial')->where('ujian_remedial.id_ujian', base64_decode($id))->get();

        $soal           = Soal::where('id_ujian', base64_decode($id))->get();
        $ujianRemed     = UjianRemedial::where('id_ujian', base64_decode($id))->get()->first();
        $soalRemed      = SoalRemed::where('id_ujian_remedial', $ujianRemed['id_ujian_remedial'])->get();

        foreach($soal as $s => $isiS){
            $jawaban_benar[] = $isiS->bankSoal->jawaban;
            $jawaban_benar[$s] = explode(' ,  ', $jawaban_benar[$s]);
            if(count($jawaban_benar[$s]) == 1){
                $jawaban_benar[$s] = $isiS->bankSoal->jawaban;
            }else{
                foreach($jawaban_benar[$s] as $x => $isiX){
                    if($isiX == ''){
                        unset($jawaban_benar[$s][$x]);
                    }
                }
                $jawaban_benar[$s] = implode(' ,  ', $jawaban_benar[$s]);
            }
        }

        foreach($soalRemed as $sr => $isiSR){
            $jawaban_benar_remed[]       = $isiSR->bankSoal->jawaban;
            $jawaban_benar_remed[$sr]    = explode(' ,  ', $jawaban_benar_remed[$sr]);
            if(count($jawaban_benar_remed[$sr]) == 1){
                $jawaban_benar_remed[$sr] = $isiSR->bankSoal->jawaban;
            }else{
                foreach($jawaban_benar_remed[$sr] as $x => $isiX){
                    if($isiX == ''){
                        unset($jawaban_benar_remed[$sr][$x]);
                    }
                }
                $jawaban_benar_remed[$sr] = implode(' ,  ', $jawaban_benar_remed[$sr]);
            }
        }

        // return $jawabanUjian;
        return view('admin.kelola-nilai.daftar_nilai', compact('nilai', 'jumlahNilai', 'jawabanUjian', 'jawabanRemed', 'soal', 'jawaban_benar', 'nilaiRemed', 'soalRemed', 'jawaban_benar_remed', 'jumlahRemed'));
    }

    public function exportToExcel($id) {
        // if(empty($ujian->soal)) {
        //     return redirect()->back()->with('error', 'Nilai Kosong');
        // }

        $ujian = Ujian::select('id_ujian', 'judul_ujian')->where('id_ujian', base64_decode($id))->first();

        \Excel::create(strtoupper('nilai_ujian '.$ujian->judul_ujian), function($excel) use($ujian) {
            $excel->sheet('Sheet 1', function($sheet) use($ujian) {
                // Data yang akan di Export
                $dataNilai = Nilai::join('ujian', 'nilai.id_ujian', '=', 'ujian.id_ujian')
                    ->join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')
                    ->select('siswa.nis', 'siswa.nama', 'nilai.nilai')
                    ->where('ujian.id_ujian', $ujian->id_ujian)
                    ->get();

                foreach($dataNilai as $nilai) {
                    $data[] = array(
                        $nilai->nis,
                        $nilai->nama,
                        $nilai->nilai,
                    );
                }

                // Mengisi Data ke Excel
                $sheet->fromArray($data, null, 'A1', false, false);

                // Menambahkan Judul ke Excel
                $judul = array(strtoupper($ujian->judul_ujian), '', '');
                $sheet->prependRow(1, $judul);
                $headings = array('NIS', 'Nama', 'Nilai');
                $sheet->prependRow(2, $headings);

                // Merge & Align Center Judul
                $sheet->mergeCells('A1:C1');
                $sheet->getStyle('A1')->getAlignment()->applyFromArray(
                    array('horizontal' => 'center')
                );
            });
        })->export('xlsx');

        return redirect()->back()->with('success', 'Daftar Nilai berhasil di Export');
    }

    // Menambahkan soal ujian dari bank
    public function tambahSoalDariBank(Request $request, $id_ujian) { 
        $this->validate($request ,[
            'point' => 'required',
        ]);
        
        $soal = new Soal;
        $soal->id_ujian = $id_ujian;
        $soal->id_bank_soal = $request['id_bank_soal'];
        $soal->point = $request['point'];

        $soal->save();

        return back()->with('success', 'Soal ditambahkan');
    }
}
