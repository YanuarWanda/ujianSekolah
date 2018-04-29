<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ujian;
use App\Mapel;
use App\Guru;
use App\Soal;
use App\BankSoal;
use App\DaftarBidangKeahlian;
use App\KelasUjian;
use App\Kelas;
use App\Nilai;
use App\NilaiRemedial;
use App\UjianRemedial;
use App\JawabanSiswa;
use App\JawabanSiswaRemed;
use App\SoalRemed;

use DB;

class UjianController extends Controller
{
    public function timetosec($time){
        $hours = substr($time, 0, -6);
        $minutes = substr($time, -5, 2);
        $seconds = substr($time, -2);

        return $hours * 3600 + $minutes * 60 + $seconds;
    }

    public function index()
    {
        $ujian = Ujian::leftJoin('guru', 'ujian.id_guru', '=', 'guru.id_guru')->orderBy('id_ujian', 'DESC')->simplePaginate(2);
        $kelas = Kelas::all();
        $sRemed = DB::select('SELECT * FROM ujian LEFT JOIN ujian_remedial USING(id_ujian) WHERE ujian.id_ujian IN (SELECT id_ujian FROM nilai WHERE status_pengerjaan = "Harus Remedial")');
        $ujianRemedial = UjianRemedial::all();
        
        return view('admin.ujian.index', compact('ujian', 'kelas', 'sRemed', 'ujianRemedial'));
    }

    public function create()
    {
        $mapel = Mapel::all();

        return view('admin.ujian.create', compact('mapel'));
    }

    public function store(Request $data)
    {
        $this->validate($data, [
            'judul'         => 'required',
            'kkm'           => 'required|integer',
            'lihat_nilai'   => 'required',
        ],
        [
            'judul.required' => 'Judul harus diisi',
            'kkm.required' => 'KKM harus diisi',
            'kkm.integer' => 'KKM harus angka',
            'lihat_nilai.required' => 'Siswa Lihat Nilai harus diisi'
        ]);

        $id = session()->get('id_guru');

        if($data['catatan'] == '') {
            $data['catatan'] = 'Tidak ada catatan.';
        }

        $ujian = Ujian::create([
           'id_mapel'           => $data['mapel'],
           'id_guru'            => Guru::where('id_guru', $id)->first()['id_guru'],
           'judul_ujian'        => $data['judul'],
           'kkm'                => $data['kkm'],
           'waktu_pengerjaan'   => gmdate("H:i:s", $data['waktu_pengerjaan']),
           'catatan'            => $data['catatan'],
           'lihat_nilai'        => $data['lihat_nilai'],
        ]);

        return redirect('/ujian')->with('success', 'Penambahan Data Ujian Berhasil');
    }

    public function edit($id)
    {
        $ujian = Ujian::find(base64_decode($id));
        $mapel = Mapel::all();
        $soal = Soal::where('id_ujian', base64_decode($id))->get();
        $wp = $this->timetosec($ujian->waktu_pengerjaan);

        if(count($soal) > 0){
            foreach($soal as $s => $sisi){
                $jawaban[] = explode(' ,  ', $sisi->bankSoal->jawaban);
            }
            foreach($jawaban as $j => $jajang){
                foreach($jajang as $sj => $ssj){
                    if($ssj == ''){
                        unset($jawaban[$j][$sj]);
                    }
                }
                $jawabanAsli[] = implode(' ,  ', $jawaban[$j]);
            }
        }

        return view('admin.ujian.edit', compact('ujian', 'mapel', 'wp', 'soal', 'jawabanAsli'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'mapel'                 => 'required',
            'judul'                 => 'required',
            'waktu_pengerjaan'      => 'required',
            'catatan'               => 'required',
            'kkm'                   => 'required|integer',
            'lihat_nilai'           => 'required',
        ],[
            'mapel.required' => 'Mapel harus diisi',
            'judul.required' => 'Judul harus diisi',
            'waktu_pengerjaan.required' => 'Waktu Pengerjaan harus diisi',
            'catatan.required' => 'Catatan harus diisi',
            'kkm.required' => 'KKM harus diisi',
            'kkm.integer' => 'KKM harus angka',
            'lihat_nilai.required' => 'Siswa Lihat Nilai harus diisi',
        ]);

        $ujian = Ujian::find(base64_decode($id));

        $ujian->id_mapel            = $request['mapel'];
        $ujian->judul_ujian         = $request['judul'];
        $ujian->kkm                 = $request['kkm'];
        $ujian->waktu_pengerjaan    = gmdate("H:i:s", $request['waktu_pengerjaan']);
        $ujian->catatan             = $request['catatan'];
        $ujian->lihat_nilai         = $request['lihat_nilai'];

        $ujian->save();

        return redirect('/ujian')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $ujian = Ujian::find(base64_decode($id));
        $soal = Soal::where('id_ujian', $ujian->id_ujian)->get();

        if($ujian) {
            foreach($soal as $s){
                $s->delete();
            }

            if($ujian->delete()){
                return redirect('/ujian')->with('success', 'Data berhasil dihapus!');
            }
        }else{
            return redirect('/ujian')->with('error', 'Data gagal dihapus!');
        }
    }

    public function tambahSoalUjian($id){
        $ujian = Ujian::find(base64_decode($id));

        return view('admin.ujian.tambahSoalUjian', compact('ujian'));
    }

    public function storeSoalUjian(Request $request, $id){
        $this->validate($request, [
            'point'     => 'required|integer',
            'soal'      => 'required',
            'tipe'      => 'required'
        ],[
            'point.required' => 'Point harus diisi',
            'point.integer' => 'Point harus angka',
            'soal.required' => 'Soal harus diisi',
            'tipe' => 'Tipe harus diisi'
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
                return redirect('/ujian/edit/'.base64_encode($ujian->id_ujian))->with('success', 'Data berhasil ditambahkan!');
            }
        }
        return redirect('/ujian/edit/'.base64_encode($ujian->id_ujian))->with('error', 'Data gagal ditambahkan!');
    }

    public function editSoalUjian($id){
        $soal       = Soal::find(base64_decode($id));
        $ujian      = Ujian::where('id_ujian', $soal->id_ujian)->get()->first();
        $pilihan    = explode(' ,  ', $soal->bankSoal['pilihan']);
        $jawaban    = $soal->bankSoal['jawaban'];
        if($soal->bankSoal['tipe'] == 'MC'){
            $jawaban = explode(' ,  ', $jawaban);
            unset($jawaban[5]);
        }
        // return $soal;
        return view('admin.ujian.editSoalUjian', compact('soal', 'pilihan', 'ujian', 'jawaban'));
    }

    public function updateSoalUjian(Request $request, $id){
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

        $bankSoal->tipe        = $request['tipe'];
        $bankSoal->isi_soal    = $request['soal'];
        $bankSoal->pilihan     = $pilihan;
        $bankSoal->jawaban     = $jawaban;
        
        $soal->point           = $request['point'];

        if($bankSoal->save() && $soal->save()){
            return redirect('/ujian/edit/'.base64_encode($soal['id_ujian']))->with('success', 'Update Soal Berhasil!');
        }
    }

    public function tambahDariBankSoal($id){
        $ujian = Ujian::find(base64_decode($id));
        $soalYangSudahAda = Soal::select('id_bank_soal')->where('id_ujian', base64_decode($id))->get();
        $soal = BankSoal::where('id_daftar_bidang', $ujian->mapel->id_daftar_bidang)
            ->whereNotIn('id_bank_soal', $soalYangSudahAda)
            ->get();
        $bidangKeahlian = DaftarBidangKeahlian::where('id_daftar_bidang', $ujian->mapel->id_daftar_bidang)
            ->first()['bidang_keahlian'];

        return view('admin.ujian.tambahDariBankSoal', compact('ujian', 'soal', 'bidangKeahlian'));
    }

    public function storeDariBankSoal(Request $request, $id){
        $this->validate($request ,[
            'point' => 'required',
        ],[
            'point.required' => 'Point harus diisi',
        ]);
        
        $soal = new Soal;
        $soal->id_ujian = base64_decode($id);
        $soal->id_bank_soal = $request['id_bank_soal'];
        $soal->point = $request['point'];

        $soal->save();

        return back()->with('success', 'Soal ditambahkan');
    }

    public function deleteSoalUjian($id){
        $soal = Soal::find(base64_decode($id));

        if($soal){
            $soal->delete();

            return redirect('/ujian/edit/'.base64_encode($soal->id_ujian))->with('success', 'Data berhasil dihapus!');
        }else{
            return redirect('/ujian/edit/'.base64_encode($soal->id_ujian))->with('error', 'Data gagal dihapus!');
        }
    }

    public function draft($id){
        $ujian = Ujian::find(base64_decode($id));

        $ujian->status = 'Draft';

        if($ujian->save()) {
            $deleteMany = KelasUjian::where('id_ujian', $ujian->id_ujian)->delete();

            return redirect()->back()->with('success', 'Data disimpan di Draft');
        }else {
            return redirect()->back()->with('error', 'Penyimpanan data di Draft gagal');
        }
    }

    public function post(Request $request, $id){
        $this->validate($request ,[
            'kelas' => 'required',
            'tanggalKadaluarsa' => 'required|after:yesterday',
        ],[
            'kelas.required' => 'Kelas harus diisi',
            'tanggalKadaluarsa.required' => 'Tanggal Kadaluarsa harus diisi',
            'tanggalKadaluarsa.after' => 'Tanggal kadaluarsa minimal hari ini',
        ]);

        $ujian = Ujian::find(base64_decode($id));
        
        if(count($ujian->soal) == 0) {
            return redirect()->back()->with('error', 'Silahkan tambah soal terlebih dahulu');
        }

        $ujian->status = 'posted';
        $ujian->tanggal_kadaluarsa = $request['tanggalKadaluarsa'];

        if(isset($request['kelas'])) {
            if($ujian->save()) {
                foreach($request['kelas'] as $kelas) {
                    $kelasUjian = new KelasUjian;
                    $kelasUjian->id_ujian = $ujian->id_ujian;
                    $kelasUjian->id_kelas = Kelas::select('id_kelas')->where('nama_kelas', $kelas)->get()->first()['id_kelas'];

                    $kelasUjian->save();
                }
                return redirect()->back()->with('success', 'Data berhasil di Post');
            }
        }else{
            return redirect()->back()->with('error', 'Data gagal di Post');
        }
    }

    public function daftarNilai($id)
    {
        $ujian          = Ujian::find(base64_decode($id));
        $nilai          = Nilai::join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->where('id_ujian', base64_decode($id))->orderBy('id_kelas', 'asc')->get();
        $nilaiRemed     = NilaiRemedial::join('siswa', 'nilai_remedial.id_siswa', '=', 'siswa.id_siswa')->join('ujian_remedial', 'nilai_remedial.id_ujian_remedial', '=', 'ujian_remedial.id_ujian_remedial')->where('id_ujian', base64_decode($id))->orderBy('id_kelas', 'asc')->get();
        $jumlahNilai    = Nilai::join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->join('kelas_ujian', 'kelas.id_kelas', '=', 'kelas_ujian.id_kelas')->join('ujian', 'nilai.id_ujian', '=', 'ujian.id_ujian')->where('ujian.id_ujian', base64_decode($id))->groupBy('kelas.id_kelas')->get();
        $jumlahRemed    = NilaiRemedial::join('siswa', 'nilai_remedial.id_siswa', '=', 'siswa.id_siswa')->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->join('ujian_remedial', 'nilai_remedial.id_ujian_remedial', '=', 'ujian_remedial.id_ujian_remedial')->where('ujian_remedial.id_ujian', base64_decode($id))->get();
        $jawabanUjian   = JawabanSiswa::join('soal', 'jawaban_siswa.id_soal', '=', 'soal.id_soal')->where('id_ujian', base64_decode($id))->get();
        $jawabanRemed   = JawabanSiswaRemed::join('soal_remed', 'jawaban_siswa_remed.id_soal_remedial', '=', 'soal_remed.id_soal_remedial')->join('ujian_remedial', 'soal_remed.id_ujian_remedial', '=', 'ujian_remedial.id_ujian_remedial')->where('ujian_remedial.id_ujian', base64_decode($id))->get();
        $soal           = Soal::where('id_ujian', base64_decode($id))->get();
        $ujianRemed     = UjianRemedial::where('id_ujian', base64_decode($id))->get();
        $soalRemed      = SoalRemed::join('ujian_remedial', 'soal_remed.id_ujian_remedial', '=', 'ujian_remedial.id_ujian_remedial')->where('id_ujian', $ujian['id_ujian'])->get();
        $chartPerKelas  = Nilai::select('ujian.judul_ujian as judul', 'kelas.nama_kelas as kelas')->selectRaw('avg(nilai) as rataNilai')->join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->join('ujian', 'nilai.id_ujian', '=', 'ujian.id_ujian')->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->where('nilai.id_ujian', base64_decode($id))->groupBy('kelas.id_kelas')->get();
        $nilaiTertinggi = Nilai::select('siswa.nama', 'kelas.nama_kelas', 'nilai.nilai')->join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->where('nilai.id_ujian', base64_decode($id))->orderBy('nilai.nilai', 'DESC')->get();

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
        return view('admin.ujian.daftarNilai', compact('nilai', 'jumlahNilai', 'jawabanUjian', 'jawabanRemed', 'soal', 'jawaban_benar', 'nilaiRemed', 'soalRemed', 'jawaban_benar_remed', 'jumlahRemed', 'chartPerKelas', 'ujian', 'nilaiTertinggi'));
    }

    public function exportNilai($id){
        $ujian = Ujian::find(base64_decode($id));
        
        \Excel::create('Nilai Ujian '.$ujian->judul_ujian.' per tanggal '.date("Y-m-d"), function($excel) use($ujian) {
            $excel->setCreator('U-LAH')->setCompany('U-LAH');
            $excel->setDescription('Data Nilai '.$ujian->judul_ujian.' yang di export per tanggal '.date("Y-m-d").".");
            $excel->setSubject('Data Nilai');
            $excel->sheet('Data Nilai', function($sheet) use($ujian) {
                // Data yang akan di Export
                $dataNilai = Nilai::join('ujian', 'nilai.id_ujian', '=', 'ujian.id_ujian')
                    ->join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')
                    ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
                    ->select('siswa.nis', 'kelas.nama_kelas', 'siswa.nama', 'nilai.nilai')
                    ->where('ujian.id_ujian', $ujian->id_ujian)
                    ->get();

                $dataRemed = \DB::select("SELECT
                      s.nis,
                      nr.nilai_remedial
                    FROM
                      nilai_remedial nr
                      JOIN siswa s USING (id_siswa)
                      JOIN ujian_remedial ur USING (id_ujian_remedial)
                      JOIN ujian u USING (id_ujian)
                      WHERE id_ujian = $ujian->id_ujian");

                // dd($dataRemed[0]->nis);

                foreach($dataNilai as $key => $nilai) {
                    $data[] = array(
                        $nilai->nis,
                        $nilai->nama_kelas,
                        $nilai->nama,
                        ''.$nilai->nilai.''
                    );
                    $jRemed = 4;
                    foreach($dataRemed as $remed) {
                        if($remed->nis == $nilai->nis) {
                            $data[$key][$jRemed] = $remed->nilai_remedial;    
                            $jRemed++;
                        }
                    }
                }

                // Mengisi Data ke Excel
                $sheet->fromArray($data, null, 'A1', false, false);

                // Menambahkan Judul ke Excel
                $judul = array(strtoupper($ujian->judul_ujian), '', '');
                $sheet->prependRow(1, $judul);
                $headings = array('NIS', 'Kelas', 'Nama', 'Nilai', 'Remed 1', 'Remed 2', 'Remed 3');
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

    public function remedCreate($id)
    {
        $ujian = Ujian::find(base64_decode($id));

        return view('admin.ujian.remed.create', compact('ujian'));
    }

    public function remedStore(Request $request, $id)
    {
        $ujian = Ujian::find(base64_decode($id));
        $ujianRemedial = UjianRemedial::where('id_ujian', base64_decode($id))->get();
        $remedKe = 200;$xx = 0;
        
        if(count($ujianRemedial) > 0){
            foreach($ujianRemedial as $ur => $isiUR){
                if($isiUR->id_ujian == base64_decode($id)){
                    $xx++;
                }
                $remedKe = $xx+1;
            }
        }else{
            $remedKe = 1;
        }
        
        if($request['catatan'] == ''){
            $request['catatan'] = 'Tidak ada catatan.';
        }

        $remed = UjianRemedial::create([
            'id_ujian'          => $ujian->id_ujian,
            'waktu_pengerjaan'  => gmdate("H:i:s", $request['waktu_pengerjaan']),
            'catatan'           => $request['catatan'],
            'remed_ke'          => $remedKe,
        ]);


        if($remed){
            return redirect('/ujian')->with('success', 'Data telah berhasil ditambahkan!');
        }        
    }

    public function remedEdit($id)
    {
        $ujianRemedial = UjianRemedial::find(base64_decode($id));
        $wp            = $this->timetosec($ujianRemedial->waktu_pengerjaan);
        $soal          = SoalRemed::where('id_ujian_remedial', '=', $ujianRemedial->id_ujian_remedial)->get();

        return view('admin.ujian.remed.edit', compact('ujianRemedial', 'wp', 'soal'));
    }

    public function remedUpdate(Request $request, $id)
    {
        $ujianRemedial  = UjianRemedial::find(base64_decode($id));

        $ujianRemedial->waktu_pengerjaan    = gmdate("H:i:s", $request['waktu_pengerjaan']);
        $ujianRemedial->catatan             = $request['catatan'];

        if($ujianRemedial->save()){
            return redirect('/ujian')->with('success', 'Data berhasil diubah!');
        }
        return redirect('/ujian')->with('error', 'Data gagal diubah!');
    }

    public function tambahRemedDariBankSoal($id)
    {
        $ujianRemedial      = UjianRemedial::find(base64_decode($id));
        $soalYangSudahAda   = SoalRemed::select('id_bank_soal')->where('id_ujian_remedial', base64_decode($id))->get();
        $soal = BankSoal::where('id_daftar_bidang', $ujianRemedial->ujian->mapel->id_daftar_bidang)
            ->whereNotIn('id_bank_soal', $soalYangSudahAda)
            ->get();
        $bidangKeahlian = DaftarBidangKeahlian::where('id_daftar_bidang', $ujianRemedial->ujian->mapel->id_daftar_bidang)
            ->first()['bidang_keahlian'];

        return view('admin.ujian.remed.tambahDariBankSoal', compact('ujianRemedial', 'soal', 'bidangKeahlian'));   
    }

    public function storeRemedDariBankSoal(Request $request, $id)
    {
        $this->validate($request ,[
            'point' => 'required',
        ],[
            'point.required' => 'Point harus diisi',
        ]);
        
        $soal = new SoalRemed;
        $soal->id_ujian_remedial = base64_decode($id);
        $soal->id_bank_soal = $request['id_bank_soal'];
        $soal->point = $request['point'];

        $soal->save();

        return back()->with('success', 'Soal ditambahkan');
    }

    public function tambahSoalRemed($id)
    {
        $ujianRemedial = UjianRemedial::find(base64_decode($id));

        return view('admin.ujian.remed.tambahSoalRemed', compact('ujianRemedial'));
    }

    public function storeSoalRemed(Request $request, $id)
    {
        $this->validate($request, [
            'point'     => 'required|integer',
            'soal'      => 'required',
            'tipe'      => 'required'
        ],[
            'point.required' => 'Point harus diisi',
            'point.integer' => 'Point harus angka',
            'soal.required' => 'Soal harus diisi',
            'tipe' => 'Tipe harus diisi'
        ]);

        $ujian = UjianRemedial::find(base64_decode($id));

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

        $soal = BankSoal::create([
            'tipe'              => $request['tipe'],
            'isi_soal'          => $request['soal'],
            'pilihan'           => $pilihan,
            'jawaban'           => $jawaban,
            'id_daftar_bidang'  => $ujian->ujian->mapel->daftar_bidang_keahlian->id_daftar_bidang,
        ]);

        if($soal){
            $soalUjian = SoalRemed::create([
                'id_ujian_remedial'         => $ujian['id_ujian_remedial'],
                'id_bank_soal'              => $soal['id_bank_soal'],
                'point'                     => $request['point'],
            ]);

            if($soalUjian){
                return redirect('ujian/remed/detail/'.base64_encode($ujian->id_ujian_remedial))->with('success', 'Data berhasil ditambahkan!');
            }
        }
        return redirect('ujian/remed/detail/'.base64_encode($ujian->id_ujian_remedial))->with('error', 'Data gagal ditambahkan!');
    }

    public function deleteSoalRemed($id)
    {
        $soalRemed = SoalRemed::find(base64_decode($id));

        if($soalRemed){
            $soalRemed->delete();

            return redirect('ujian/remed/detail/'.base64_encode($soalRemed->id_ujian_remedial))->with('success', 'Data berhasil dihapus!');
        }else{
            return redirect('ujian/remed/detail/'.base64_encode($soalRemed->id_ujian_remedial))->with('error', 'Data gagal dihapus!');
        }
    }

    public function editSoalRemed($id)
    {
        $soalRemed  = SoalRemed::find(base64_decode($id));
        $ujianRemed = UjianRemedial::find($soalRemed->id_ujian_remedial);
        $pilihan    = explode(' ,  ', $soalRemed->bankSoal['pilihan']);
        $jawaban    = $soalRemed->bankSoal['jawaban'];
        if($soalRemed->bankSoal['tipe'] == 'MC'){
            $jawaban = explode(' ,  ', $jawaban);
            unset($jawaban[5]);
        }

        return view('admin.ujian.remed.editSoalRemed', compact('soalRemed', 'pilihan', 'ujianRemed', 'jawaban'));
    }

    public function updateSoalRemed(Request $request, $id)
    {
        $soal = SoalRemed::find(base64_decode($id));
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

        $bankSoal->tipe        = $request['tipe'];
        $bankSoal->isi_soal    = $request['soal'];
        $bankSoal->pilihan     = $pilihan;
        $bankSoal->jawaban     = $jawaban;
        
        $soal->point           = $request['point'];

        if($bankSoal->save() && $soal->save()){
            return redirect('ujian/remed/detail/'.base64_encode($soal['id_ujian_remedial']))->with('success', 'Update Soal Berhasil!');
        }
    }

    public function draftRemed($id)
    {
        $ujian = UjianRemedial::find(base64_decode($id));

        $ujian->status = 'Belum Selesai';

        if($ujian->save()) {
            return redirect()->back()->with('success', 'Data disimpan di Draft');
        }else {
            return redirect()->back()->with('error', 'Penyimpanan data di Draft gagal');
        }
    }

    public function postRemed(Request $request, $id)
    {
        $this->validate($request ,[
            'tanggalKadaluarsaRemed' => 'required|after:yesterday',
        ],[
            'tanggalKadaluarsaRemed.required' => 'Tanggal Kadaluarsa harus diisi',
            'tanggalKadaluarsaRemed.after' => 'Tanggal kadaluarsa minimal hari ini',
        ]);

        $ujian = UjianRemedial::find(base64_decode($id));
        
        if(count($ujian->soalRemed) == 0) {
            return redirect()->back()->with('error', 'Silahkan tambah soal terlebih dahulu');
        }

        $ujian->status = 'posted';
        $ujian->tanggal_kadaluarsa = $request['tanggalKadaluarsaRemed'];

        if($ujian->save()) {
            return redirect()->back()->with('success', 'Data berhasil di Post');
        }else{
            return redirect()->back()->with('error', 'Data gagal di Post');
        }
    }
}
