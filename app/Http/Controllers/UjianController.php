<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ujian;
use App\Guru;
use App\Mapel;
use App\Soal;
use App\BankSoal;
use App\Kelas;
use App\KelasUjian;
use App\Nilai;
use App\JawabanSiswa;
use App\UjianRemedial;
use App\SoalRemed;
use App\BidangKeahlian;
use App\DaftarBidangKeahlian;
use App\JawabanSiswaRemed;
use App\NilaiRemedial;
use DB;

use Auth;

class UjianController extends Controller
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

    public function timetosec($time){
        $hours = substr($time, 0, -6);
        $minutes = substr($time, -5, 2);
        $seconds = substr($time, -2);

        return $hours * 3600 + $minutes * 60 + $seconds;
    }

    public function index()
    {
        $kelas = Kelas::all();
        if(Auth::user()->hak_akses == 'admin'){
            $ujian = Ujian::All();
        }else if(Auth::user()->hak_akses == 'guru'){
            $ujian = Ujian::where('id_guru', session()->get('id_guru'))->get();
        }

        $sRemed = DB::select('SELECT * FROM ujian WHERE ujian.id_ujian NOT IN (SELECT id_ujian FROM ujian_remedial) AND ujian.id_ujian IN (SELECT id_ujian FROM nilai WHERE status_pengerjaan = "Harus Remedial") AND curdate() > ujian.tanggal_kadaluarsa;');
        $ujianRemedial = UjianRemedial::all();
        // return $ujianRemedial;
        return view('admin.kelola-ujian.dataView', compact('ujian', 'kelas', 'sRemed', 'ujianRemedial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ujian = Ujian::All();
        if(Auth::user()->hak_akses == 'admin') {
            $mapel = Mapel::All();
        } else {
            $guru = Guru::find(session()->get('id_guru'));
            $mapel = BidangKeahlian::join('daftar_bidang_keahlian', 'bidang_keahlian.id_daftar_bidang', '=', 'daftar_bidang_keahlian.id_daftar_bidang')->join('guru', 'bidang_keahlian.id_guru', '=', 'guru.id_guru')->join('mapel', 'bidang_keahlian.id_daftar_bidang', '=', 'mapel.id_daftar_bidang')->where('bidang_keahlian.id_guru', '=', $guru['id_guru'])->get();
        }

        // return $mapel;
        return view('admin.kelola-ujian.create', compact('ujian', 'mapel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        $this->validate($data, [
            'kkm'   => 'required|integer',
        ]);

        $id = session()->get('id_guru');

        if($data['catatan'] == '') {
            $data['catatan'] = 'Tidak ada catatan.';
        }

        $ujian = Ujian::create([
           'id_mapel'           => Mapel::where('nama_mapel', $data['mapel'])->first()['id_mapel'],
           'id_guru'            => Guru::where('id_guru', $id)->first()['id_guru'],
           'judul_ujian'        => $data['judul'],
           'kkm'                => $data['kkm'],
           'waktu_pengerjaan'   => gmdate("H:i:s", $data['waktu_pengerjaan']),
           // 'tanggal_kadaluarsa' => $data['batas_pengerjaan'],
           'catatan' => $data['catatan'],
        ]);

        // return $ujian->id_ujian;
        return redirect('/kelola-ujian')->with('success', 'Penambahan Data Ujian Berhasil');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Siswa::find(base64_decode($id));

        return view('admin.kelola-siswa.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ujian = Ujian::find(base64_decode($id));
        // $waktu_pengerjaan = explode(':', $ujian->waktu_pengerjaan);
        $mapel = Mapel::All();
        $soal = Soal::where('id_ujian', '=', base64_decode($id))->get();

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

        return view('admin.kelola-ujian.edit', compact('ujian', 'mapel', 'wp', 'soal', 'jawabanAsli'));
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
        $this->validate($request, [
            'mapel'                 => 'required',
            'judul'                 => 'required',
            'waktu_pengerjaan'      => 'required',
            'catatan'               => 'required',
            'kkm'                   => 'required|integer',
        ]);

        $ujian = Ujian::find(base64_decode($id));

        $ujian->id_mapel            = $request['mapel'];
        $ujian->judul_ujian         = $request['judul'];
        $ujian->kkm                 = $request['kkm'];
        $ujian->waktu_pengerjaan    = gmdate("H:i:s", $request['waktu_pengerjaan']);
        $ujian->catatan             = $request['catatan'];

        $ujian->save();

        return redirect('/kelola-ujian')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ujian = Ujian::find(base64_decode($id));
        $soal = Soal::where('id_ujian', $ujian->id_ujian)->get();

        if($ujian) {
            foreach($soal as $s){
                $s->delete();
            }

            if($ujian->delete()){
                return redirect('/kelola-ujian')->with('success', 'Data berhasil dihapus!');
            }
        }else{
            return redirect('/kelola-ujian')->with('error', 'Data gagal dihapus!');
        }
    }

    // Mengupdate data user, dari menu settings
    public function storeDataSiswa(Request $request, $id) {
        $this->validate($request, [
            'nis' => 'required',
            'nama' => 'required',
            'username' => 'required',
        ]);

        $siswa = Siswa::find(base64_decode($id));
        $siswa->nis = $request['nis'];
        $siswa->nama = $request['nama'];
        $siswa->id_kelas = Kelas::where('nama_kelas', $request['kelas'])->first()->id_kelas;
        $siswa->alamat = $request['alamat'];
        $siswa->jenis_kelamin = $request['jenisKelamin'];

        if($request->file('foto')){
            $nameFotoToStore = $this->ambil($request->file('foto'));
            $siswa->foto = $nameFotoToStore;
        }

        $user = User::find($siswa->id);
        $user->username = $request['username'];

        if($user->save() && $siswa->save()) {
            return redirect('/home')->with('success', 'Data berhasil diubah');
        } else return redirect('/settings')->with('error', 'Data gagal diubah');
    }

    public function postRemed(Request $request, $id){
        $ujianRemedial = UjianRemedial::where('id_ujian', '=', base64_decode($id))->get()->first();

        if(count($ujianRemedial->soalRemed) == 0){
            return redirect()->back()->with('error', 'Silakan tambah soal remed terlebih dahulu.');
        }
        // return $request['tanggalKadaluarsaRemed'];
        $ujianRemedial->status = 'posted';
        $ujianRemedial->tanggal_kadaluarsa = $request['tanggalKadaluarsaRemed'];

        if($ujianRemedial->save()){
           return redirect('/kelola-ujian')->with('success', 'Data berhasil di post!');
        }
        return redirect('/kelola-ujian')->back()->with('error', 'Data gagal di post!');
    }

    public function postUjian(Request $request, $id) {
        $this->validate($request ,[
            'kelas' => 'required',
            'tanggalKadaluarsa' => 'required',
        ]);

        $ujian = Ujian::find(base64_decode($id));
        // return $ujian->soal;
        if(count($ujian->soal) == 0) {
            return redirect()->back()->with('error', 'Silahkan tambah soal terlebih dahulu');
        }

        $ujian->status = 'posted';
        $ujian->tanggal_kadaluarsa = $request['tanggalKadaluarsa'];

        // return base64_decode($id);
        if(isset($request['kelas'])) {
            if($ujian->save()) {
                foreach($request['kelas'] as $kelas) {
                    $kelasUjian = new KelasUjian;
                    $kelasUjian->id_ujian = $ujian->id_ujian;
                    $kelasUjian->id_kelas = Kelas::select('id_kelas')->where('nama_kelas', $kelas)->get()->first()['id_kelas'];

                    // return $kelasUjian->id_kelas->id_kelas;

                    $kelasUjian->save();
                }
                return redirect()->back()->with('success', 'Data berhasil di Post');
            }
        }else{
            return redirect()->back()->with('error', 'Data gagal di Post');
        }
    }

    public function unpostRemed($id){
        $ujianRemedial = UjianRemedial::where('id_ujian', '=', base64_decode($id))->get()->first();

        $ujianRemedial->status              = "Belum Selesai";
        $ujianRemedial->tanggal_kadaluarsa  = NULL;

        if($ujianRemedial->save()){
            return redirect('/kelola-ujian')->with('success', 'Data telah berhasil di Unpost!');
        }
        return redirect('/kelola-ujian')->with('error', 'Data gagal di Unpost!');
    }

    public function unpostUjian($id) {
        $ujian = Ujian::find(base64_decode($id));

        $ujian->status = 'Draft';

        if($ujian->save()) {
            $deleteMany = KelasUjian::where('id_ujian', $ujian->id_ujian)->delete();

            return redirect()->back()->with('success', 'Data disimpan di Draft');

        }else {
            return redirect()->back()->with('error', 'Penyimpanan data di Draft gagal');
        }
    }

    public function kerjakanSoal($id) {
        $ujian      = Ujian::find(base64_decode($id));
        
        $soalFull   = Soal::where('id_ujian', $ujian->id_ujian)->get();

        foreach($soalFull as $s){
            $pilihan[]    = explode(' ,  ', $s->bankSoal['pilihan']);
            $soal[]       = explode(' ,  ', $s->bankSoal['isi_soal']);
        }

        $str_time = $ujian->waktu_pengerjaan;
        
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $sisa_waktu = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;

        return view('siswa.kerjakan-soal', compact('ujian', 'soal', 'soalFull', 'sisa_waktu', 'pilihan'));
    }

    public function kerjakanRemed($id){
        $ujian  = UjianRemedial::where('id_ujian_remedial', base64_decode($id))->where('status', 'posted')->get()->first();
        // return base64_decode($id);
        $soalFull       = SoalRemed::where('id_ujian_remedial', $ujian->id_ujian_remedial)->get();

        foreach($soalFull as $s){
            $pilihan[]  = explode(' ,  ', $s->bankSoal['pilihan']);
            $soal[]     = explode(' ,  ', $s->bankSoal['isi_soal']);
        }

        $str_time = $ujian->waktu_pengerjaan;

        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $sisa_waktu = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;

        return view('siswa.kerjakan-soal', compact('ujian', 'soalFull', 'pilihan', 'soal', 'sisa_waktu'));
    }

    public function submitRemed(Request $data, $id){
        $ujianRemedial  = UjianRemedial::find(base64_decode($id));

        $jumlahBenar = 0;$jumlahPoint = 0;$jumlahPointBenar = 0;
        $soal = SoalRemed::where('id_ujian_remedial', '=', $ujianRemedial->id_ujian_remedial)->get();

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
            $jumlahPoint = $jumlahPoint+$isiS->point;
        }

        for($i=0;$i<=count($soal)-1;$i++){
            $jawaban[] = $data['jawaban_'.$i];

            if(count($data['jawaban_'.$i]) == 1){
                if($jawaban[$i] == $jawaban_benar[$i]){
                    $jumlahBenar        = $jumlahBenar+1;
                    $jumlahPointBenar   = $jumlahPointBenar+$soal[$i]->point;
                }
            }else{
                $jawaban[$i] = implode(' ,  ', $jawaban[$i]);
                if($jawaban [$i] == $jawaban_benar[$i]){
                    $jumlahBenar = $jumlahBenar+1;
                    $jumlahPointBenar   = $jumlahPointBenar+$soal[$i]->point;
                }
            }

        }

        $jumlahSalah    = count($soal) - $jumlahBenar;
        $nilaiKetampanan= round(($jumlahPointBenar / $jumlahPoint)* 100);

        foreach($soal as $s => $sia){
            $jawabanSiswa = new JawabanSiswaRemed;
            $jawabanSiswa->id_soal_remedial     = $sia->id_soal_remedial;
            $jawabanSiswa->id_siswa             = session()->get('id_siswa');
            $jawabanSiswa->jawaban_siswa  = $jawaban[$s];
            $jawabanSiswa->save();
        }

        if($nilaiKetampanan > $ujianRemedial->ujian->kkm){
            $nilaiKetampanan = $ujianRemedial->ujian->kkm;
        }

        $nilai = new NilaiRemedial;
        $nilai->id_ujian_remedial   = $ujianRemedial->id_ujian_remedial;
        $nilai->id_siswa            = session()->get('id_siswa');
        $nilai->jawaban_benar       = $jumlahBenar;
        $nilai->jawaban_salah       = $jumlahSalah;
        $nilai->nilai_remedial      = $nilaiKetampanan;
        
        // return $nilai;

        if($nilai->save()){
            return redirect('/home')->with('success', 'Selamat, anda telah selesai mengerjakan soal.');
        }else{
            return redirect('/home')->with('error', 'Maaf, terjadi kesalahan.');
        }
    }

    public function submitSoal(Request $data, $id){
        $ujian          = Ujian::find(base64_decode($id));
        
        $jumlahBenar = 0;$jumlahPoint = 0;$jumlahPointBenar = 0;

        $soal   = Soal::where('id_ujian', $ujian->id_ujian)->get();

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
            $jumlahPoint = $jumlahPoint+$isiS->point;
        }

        for($i=0;$i<=count($soal)-1;$i++){
            $jawaban[] = $data['jawaban_'.$i];

            if(count($data['jawaban_'.$i]) == 1){
                if(is_array($jawaban[$i]) == true){
                    $jawaban[$i] = $jawaban[$i][0];
                }
                if($jawaban[$i] == $jawaban_benar[$i]){
                    $jumlahBenar        = $jumlahBenar+1;
                    $jumlahPointBenar   = $jumlahPointBenar+$soal[$i]->point;
                }
            }else{
                $jawaban[$i] = implode(' ,  ', $jawaban[$i]);
                if($jawaban [$i] == $jawaban_benar[$i]){
                    $jumlahBenar = $jumlahBenar+1;
                    $jumlahPointBenar   = $jumlahPointBenar+$soal[$i]->point;
                }
            }

        }

        $jumlahSalah    = count($soal) - $jumlahBenar;
        $nilaiKetampanan= round(($jumlahPointBenar / $jumlahPoint)* 100);
        // return $jawaban;
        foreach($soal as $s => $sia){
            $jawabanSiswa = new JawabanSiswa;
            $jawabanSiswa->id_soal          = $sia->id_soal;
            $jawabanSiswa->id_siswa         = session()->get('id_siswa');
            $jawabanSiswa->jawaban_siswa    = $jawaban[$s];
            $jawabanSiswa->save();
        }

        if($nilaiKetampanan < $ujian->kkm){
            $statusPengerjaan = 'Harus Remedial';
        }else{
            $statusPengerjaan = 'Sudah Mengerjakan';
        }

        $nilai = new Nilai;
        $nilai->id_ujian            = $ujian->id_ujian;
        $nilai->id_siswa            = session()->get('id_siswa');
        $nilai->jawaban_benar       = $jumlahBenar;
        $nilai->jawaban_salah       = $jumlahSalah;
        $nilai->nilai               = $nilaiKetampanan;
        $nilai->status_pengerjaan   = $statusPengerjaan;

        // return $jawaban_benar;

        if($nilai->save()){
            return redirect('/home')->with('success', 'Selamat, anda telah selesai mengerjakan soal.');
        }else{
            return redirect('/home')->with('error', 'Maaf, terjadi kesalahan.');
        }
    }

    public function tambahSoalDariBankView($id)
    {
        $ujian = Ujian::find($id);
        $soalYangSudahAda = Soal::select('id_bank_soal')->get();
        $soal = BankSoal::where('id_daftar_bidang', $ujian->mapel->id_daftar_bidang)
            ->whereNotIn('id_bank_soal', $soalYangSudahAda)
            ->get();
        $bidangKeahlian = DaftarBidangKeahlian::where('id_daftar_bidang', $ujian->mapel->id_daftar_bidang)
            ->first()['bidang_keahlian'];

        return view('admin.kelola-ujian.tambah-soal-dari-bank', compact('ujian', 'soal', 'bidangKeahlian'));
    }


    public function tambahSoalDariBankViewRemed($id)
    {
        $ujian = UjianRemedial::find($id);
        $soalYangSudahAda = SoalRemed::select('id_bank_soal')->get();
        $soal = BankSoal::where('id_daftar_bidang', $ujian->ujian->mapel->id_daftar_bidang)
            ->whereNotIn('id_bank_soal', $soalYangSudahAda)
            ->get();
        $bidangKeahlian = DaftarBidangKeahlian::where('id_daftar_bidang', $ujian->ujian->mapel->id_daftar_bidang)
            ->first()['bidang_keahlian'];

        return view('admin.kelola-ujian.tambah-soal-dari-bank', compact('ujian', 'soal', 'bidangKeahlian'));
    }
}
