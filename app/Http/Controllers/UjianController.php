<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ujian;
use App\Guru;
use App\Mapel;
use App\Soal;
use App\Kelas;
use App\KelasUjian;
use App\Nilai;

use App\BidangKeahlian;
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
        // return session()->get('id_guru');
        return view('admin.kelola-ujian.dataView', compact('ujian', 'kelas'));
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
           'tanggal_kadaluarsa' => $data['batas_pengerjaan'],
           'catatan'            => $data['catatan'],
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

        return view('admin.kelola-ujian.edit', compact('ujian', 'mapel', 'wp', 'soal'));
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
            'batas_pengerjaan'      => 'required',
            'catatan'               => 'required',
        ]);

        $ujian = Ujian::find(base64_decode($id));

        $ujian->id_mapel            = $request['mapel'];
        $ujian->judul_ujian         = $request['judul'];
        $ujian->waktu_pengerjaan    = gmdate("H:i:s", $request['waktu_pengerjaan']);
        $ujian->tanggal_kadaluarsa  = $request['batas_pengerjaan'];
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

    public function postUjian(Request $request, $id) {
        $ujian = Ujian::find(base64_decode($id));
        if(count($ujian->soal) == 0) {
            return redirect()->back()->with('error', 'Silahkan tambah soal terlebih dahulu');
        }

        $ujian->status = 'posted';
        // return $ujian->judul_ujian;
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
        $soalFull       = Soal::where('id_ujian', $ujian->id_ujian)->get();

        foreach($soalFull as $s){
            $pilihan[]    = explode(' ,  ', $s->bankSoal['pilihan']);
        }

        foreach($soalFull as $s){
            $soal[]       = explode(' ,  ', $s->bankSoal['isi_soal']);
        }

        $str_time = $ujian->waktu_pengerjaan;
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $sisa_waktu = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;

        // return $soalFull;
        return view('siswa.kerjakan-soal', compact('ujian', 'soal', 'soalFull', 'sisa_waktu', 'pilihan'));
    }

    public function submitSoal(Request $data, $id){
        $ujian  = Ujian::find(base64_decode($id));
        $soal   = Soal::where('id_ujian', $ujian->id_ujian)->get();
        $jumlahBenar = 0;

        foreach($soal as $s){
            $jawaban_benar[] = $s['jawaban'];
        }

        for($i=0;$i<=count($soal)-1;$i++){
            $jawaban[] = $data['jawaban_'.$i];

            if($jawaban[$i] == $jawaban_benar[$i]){
                $jumlahBenar = $jumlahBenar+1;
            }
        }

        $jumlahSalah    = count($soal) - $jumlahBenar;
        $nilaiKetampanan= ($jumlahBenar / count($soal)) * 100;

        $nilai = new Nilai;
        $nilai->id_ujian = $ujian->id_ujian;
        $nilai->id_siswa = session()->get('id_siswa');
        $nilai->jawaban_benar = $jumlahBenar;
        $nilai->jawaban_salah = $jumlahSalah;
        $nilai->nilai = $nilaiKetampanan;

        if($nilai->save()){
            return redirect('/home')->with('success', 'Selamat, anda telah selesai mengerjakan soal.');
        }else{
            return redirect('/home')->with('error', 'Maaf, terjadi kesalahan.');
        }
    }
}
