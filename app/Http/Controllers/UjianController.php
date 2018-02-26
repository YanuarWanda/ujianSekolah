<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ujian;
use App\Guru;
use App\Mapel;
use App\Soal;
use App\Kelas;
use App\KelasUjian;
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
        $ujian = Ujian::All();
        $kelas = Kelas::all();
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
            $guru = Guru::find(Auth::user()->id_users)->get();
            $mapel = DB::select('
                SELECT
                  d.`bidang_keahlian`
                FROM
                  `bidang_keahlian`
                  JOIN `daftar_bidang_keahlian` d USING (id_daftar_bidang)
                  JOIN guru USING (`id_guru`)
            ')->get();
        }

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
        $id = Auth::user()->id_users;

        if($data['catatan'] == '') {
            $data[catatan] == 'Tidak ada catatan.';
        }

        $ujian = Ujian::create([
           'id_mapel'           => Mapel::where('nama_mapel', $data['mapel'])->first()['id_mapel'],
           'id_guru'            => Guru::where('id_guru', $id)->first()['id_guru'],
           'judul_ujian'        => $data['judul'],
           'waktu_pengerjaan'   => gmdate("H:i:s", $data['waktu_pengerjaan']),
           'tanggal_kadaluarsa' => $data['batas_pengerjaan'],
           'catatan' => $data['catatan'],
        ]);

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
        // return base64_decode($id);
        $ujian = Ujian::find(base64_decode($id));
        $ujian->status = 'posted';

        // return $ujian->judul_ujian;

        if(isset($request['kelas']) && $ujian->save()) {
            foreach($request['kelas'] as $kelas) {
                $kelasUjian = new KelasUjian;
                $kelasUjian->id_ujian = $ujian->id_ujian;
                $kelasUjian->id_kelas = Kelas::select('id_kelas')->where('nama_kelas', $kelas)->first()['id_kelas'];

                $kelasUjian->save();
            }

            return redirect()->back()->with('success', 'Data berhasil di Post');
        }else{
            return redirect()->back()->with('error', 'Data gagal di Post');
        }
    }

    public function unpostUjian($id) {
        $ujian = Ujian::find(base64_decode($id));

        $ujian->status = 'Draft';

        if($ujian->save()) {
            return redirect()->back()->with('success', 'Data disimpan di Draft');
        }else {
            return redirect()->back()->with('error', 'Penyimpanan data di Draft gagal');
        }
    }
}
