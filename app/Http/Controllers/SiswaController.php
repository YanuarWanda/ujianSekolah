<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Requests\CreateSiswaRequest;
use App\Http\Requests\UpdateAkunGuruRequest;

use App\Siswa;
use App\Kelas;
use App\User;
use App\Ujian;
use App\Soal;
use App\JawabanSiswa;
use App\Nilai;
use App\UjianRemedial;
use App\SoalRemed;
use App\JawabanSiswaRemed;
use App\NilaiRemedial;

use Auth;
use Excel;
use DB;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ambil($file){
        $fileNameFull = $file->getClientOriginalName();
        $name = pathinfo($fileNameFull, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $nameFinal = $name.'_'.time().'.'.$extension;

        $file->storeAs('public/foto-profil', $nameFinal);

        return $nameFinal;
    }

    public function index()
    {
        $siswa = Siswa::all();

        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        $kelas = Kelas::all();

        return view('admin.siswa.create', compact('kelas'));
    }

    public function store(CreateSiswaRequest $data)
    {
        // Mengisi table user
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'hak_akses' => 'siswa',
            'password' => bcrypt($data['password']),
        ]);

        if($user) {
            // Mengisi table siswa jika table user di isi
            if($data->file('foto')){
                $nameFotoToStore = $this->ambil($data->file('foto'));
            }else{
                $nameFotoToStore = 'nophoto.jpg';
            }

            $siswa = Siswa::create([
                'nis' => $data['nis'],
                'id_users' => $user->id_users,
                'id_kelas' => $data['kelas'],
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'jenis_kelamin' => $data['jenisKelamin'],
                'foto' => $nameFotoToStore, 
            ]);

            $buatLog = array(
                'NIS' => $siswa->nis,
                'Nama' => $siswa->nama,
            );
            \Log::info(Auth::user()->username.' menambah siswa.', $buatLog);

            return redirect('/siswa')->with('success', 'Pendaftaran Berhasil');
        }
    }

    public function edit($id)
    {
        $siswa = Siswa::find(base64_decode($id));
        $user = User::find($siswa->id_users);
        $kelas = Kelas::all();

        return view('admin.siswa.edit', compact('siswa', 'user', 'kelas'));
    }

    public function updateDataDiri(Request $request, $id)
    {
        $siswa = Siswa::find(base64_decode($id));
        $user  = User::find($siswa->id_users);

        $this->validate($request, 
        [
            'nis'           => ['required', 'numeric', 'digits:10', Rule::unique('siswa')->ignore($siswa->nis, 'nis')],
            'nama'          => ['required'],
            'username'      => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->username, 'username'), ],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->email, 'email')],
            'jenisKelamin'  => ['required'],
        ],
        [
            'nis.required' => 'NIS harus diisi', 'nis.numeric' => 'NIS harus angka', 'nis.digits' => 'NIS harus 10 karakter', 'nis.unique' => 'NIS sudah terdaftar',
            'nama.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi', 'username.max' => 'Username maksimal 20 karakter', 'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email harus diisi', 'email.email' => 'Email tidak valid', 'email.max' => 'Email maksimal 255 karakter', 'email.unique' => 'Email sudah terdaftar',
            'jenisKelamin.required' => 'Jenis Kelamin harus diisi'
        ]);
        
        $user->username = $request['username'];
        $user->email    = $request['email'];
        
        if($user->save()){
            $siswa->nis = $request['nis'];
            $siswa->id_kelas = $request['kelas'];
            $siswa->nama = $request['nama'];
            $siswa->alamat = $request['alamat'];
            $siswa->jenis_kelamin = $request['jenisKelamin'];

            if($request->file('foto')){
                if($siswa->foto != 'nophoto.jpg'){
                    unlink('storage/foto-profil/'.$siswa->foto);
                }

                $nameFotoToStore = $this->ambil($request->file('foto'));
                $siswa->foto = $nameFotoToStore;
            }

            if($siswa->save()){
                $buatLog = array(
                    'NIS' => $siswa->nis,
                    'Nama' => $siswa->nama,
                );
                \Log::info(Auth::user()->username.' mengubah data diri siswa dengan id : '.$siswa->id_siswa, $buatLog);

                return redirect('/siswa')->with('success', 'Data berhasil diubah.');
            }
        }
        return redirect('/siswa/edit/'.$user->id_siswa)->with('error', 'Data gagal diubah!');
   
    }

    public function updateAkun(UpdateAkunGuruRequest $request, $id)
    {
        $user = User::find(base64_decode($id));
        $siswa = Siswa::where('id_users', base64_decode($id))->get()->first();

        $user->password     = bcrypt($request['password']);

        if($user->save()){
            $buatLog = array(
                'NIS' => $siswa->nis,
                'Nama' => $siswa->nama,
            );
            \Log::info(Auth::user()->username.' mengubah data akun siswa dengan id : '.$siswa->id_siswa, $buatLog);
            
            return redirect('/siswa')->with('success', 'Data berhasil diubah');
        }else{
            return redirect('/siswa/edit/'.$user->nis)->with('error', 'Data gagal diubah!');
        }
    }

    public function destroy($id)
    {
        $siswa = Siswa::find(base64_decode($id));
        $user = User::find($siswa['id_users']);

        if($siswa && $user) {
            if($siswa->delete() && $user->delete()){
                if($siswa->foto != 'nophoto.jpg'){
                    unlink('storage/foto-profil/'.$siswa->foto);
                }

                $buatLog = array(
                    'NIS' => $siswa->nis,
                    'Nama' => $siswa->nama,
                );
                \Log::info(Auth::user()->username.' menghapus siswa.', $buatLog);

                return redirect('/kelola-siswa')->with('success', 'Data Dihapus');
            }
        }
        else return redirect('/kelola-siswa')->with('error', 'Penghapusan gagal');
    }

    public function showImport()
    {
        return view('admin.siswa.import');        
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'fileExcel' => 'required',
        ],
        [
            'fileExcel.required' => 'File excel harus diisi',
        ]);

        if($request->hasFile('fileExcel')){
            $path = $request->file('fileExcel')->getRealPath();
            $data = \Excel::load($path)->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    $user[] = [
                        'username'      => strtolower(str_replace(' ', '', $value->nama)),
                        'password'      => bcrypt($value->nis),
                        'email'         => $value->email,
                        'hak_akses'     => 'siswa',
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ];

                    $siswa[] = [
                        'nis'           => $value->nis,
                        'nama'          => $value->nama,
                        'alamat'        => $value->alamat,
                        'jenis_kelamin' => $value->jenis_kelamin,
                        'id_kelas'      => Kelas::select('id_kelas')->where('nama_kelas', $value->kelas)->first()['id_kelas'],
                        'foto'          => 'nophoto.jpg',
                    ];
                }

                if(!empty($user) && !empty($siswa)){
                    \DB::table('users')->insert($user);
                    $dataUser = DB::select("SELECT * FROM users WHERE users.id_users NOT IN (SELECT id_users FROM siswa) AND hak_akses = 'siswa'");

                    foreach ($dataUser as $key => $value) {
                        $siswa[$key]['id_users'] = $value->id_users;
                    }

                    if(count($siswa) > $data->count()) {
                        $dataCount = $data->count(); // Jumlah data asli
                        $emptyCount = count($siswa); // Jumlah data keseluruhan (plus empty row)

                        // return $dataCount;
                        for($x = $dataCount; $x <= $emptyCount; $x++) {
                            unset($siswa[$x]); // Menghapus row kosong
                        }

                        // dd($siswa);
                    }

                    \DB::table('siswa')->insert($siswa);

                    \Log::info(Auth::user()->username.' meng-import data siswa.');
                    return redirect('/siswa')->with('success', 'Import data berhasil dilakukan');
                }
            }
        }
    }

    public function export()
    {
        Excel::create('Data Siswa per '.date("Y-m-d"), function($excel) {
            $excel->setCreator('U-LAH')->setCompany('U-LAH');
            $excel->setDescription('Data Siswa yang di export per tanggal '.date("Y-m-d").".");
            $excel->setSubject('Data Siswa');
            $excel->sheet('Data Siswa', function($sheet) {
                // Data yang akan di Export
                $dataSiswa = Siswa::join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->join('users', 'siswa.id_users', '=', 'users.id_users')
                    ->select('nis', 'nama', 'users.email', 'kelas.nama_kelas', 'alamat', 'jenis_kelamin', 'tahun_ajaran')
                    ->get();

                foreach($dataSiswa as $siswa) {
                    $data[] = array(
                        $siswa->nis,
                        $siswa->nama,
                        $siswa->email,
                        $siswa->nama_kelas,
                        $siswa->alamat,
                        $siswa->jenis_kelamin,
                        $siswa->tahun_ajaran,
                    );
                }

                // Mengisi Data ke Excel
                $sheet->fromArray($data, null, 'A1', false, false);

                // Menambahkan Judul ke Excel
                $headings = array('NIS', 'Nama', 'Email', 'Kelas', 'Alamat', 'Jenis Kelamin', 'Tahun Ajaran');
                $sheet->prependRow(1, $headings);
            });
        })->export('xlsx');

        \Log::info(Auth::user()->username.' meng-export data siswa');
        return redirect()->back()->with('success', 'Data Siswa berhasil di Export');
    }

    public function kerjakanSoal($id)
    {
        $ujian      = Ujian::find(base64_decode($id));
        
        $soalFull       = Soal::where('id_ujian', $ujian->id_ujian)->get()->shuffle();
        $soalPG     = Soal::join('bank_soal', 'soal.id_bank_soal', '=', 'bank_soal.id_bank_soal')->where('id_ujian', $ujian->id_ujian)->where('bank_soal.tipe', 'PG')->orWhere('bank_soal.tipe', 'BS')->get();
        $soalMC     = Soal::join('bank_soal', 'soal.id_bank_soal', '=', 'bank_soal.id_bank_soal')->where('id_ujian', $ujian->id_ujian)->where('bank_soal.tipe', 'MC')->get();
        
        foreach($soalFull as $s){
            $pilihan[]    = explode(' ,  ', $s->bankSoal['pilihan']);
            $soal[]       = explode(' ,  ', $s->bankSoal['isi_soal']);
        }

        $str_time = $ujian->waktu_pengerjaan;
        
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $sisa_waktu = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
        
        // return $soalFull;
        return view('siswa.kerjakan', compact('ujian', 'soalFull', 'soalPG', 'soalMC', 'pilihan', 'soal', 'sisa_waktu'));
    }

    public function kerjakanRemed($id){
        $ujian  = UjianRemedial::where('id_ujian_remedial', base64_decode($id))->where('status', 'posted')->get()->first();
        
        $soalFull       = SoalRemed::where('id_ujian_remedial', $ujian->id_ujian_remedial)->get()->shuffle();
        $soalPG         = SoalRemed::join('bank_soal', 'soal_remed.id_bank_soal', '=', 'bank_soal.id_bank_soal')->where('id_ujian_remedial', $ujian->id_ujian_remedial)->where('bank_soal.tipe', 'PG')->orWhere('bank_soal.tipe', 'BS')->get();
        $soalMC         = SoalRemed::join('bank_soal', 'soal_remed.id_bank_soal', '=', 'bank_soal.id_bank_soal')->where('id_ujian_remedial', $ujian->id_ujian_remedial)->where('bank_soal.tipe', 'MC')->get();       

        foreach($soalFull as $s){
            $pilihan[]  = explode(' ,  ', $s->bankSoal['pilihan']);
            $soal[]     = explode(' ,  ', $s->bankSoal['isi_soal']);
        }

        $str_time = $ujian->waktu_pengerjaan;

        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        $sisa_waktu = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
        // return $soalPG;
        return view('siswa.kerjakan-remed', compact('ujian', 'soalFull', 'pilihan', 'soal', 'sisa_waktu', 'soalPG', 'soalMC'));
    }

    public function submitSoal(Request $data, $id)
    {
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

        foreach($soal as $s => $isiS){
            $jawaban[] = $data['jawaban_'.$isiS->id_bank_soal];
            
            if(count($data['jawaban_'.$isiS->id_bank_soal]) == 1){
                if(is_array($jawaban[$s]) == true){
                    $jawaban[$s] = $jawaban[$s][0];
                }
                if($jawaban[$s] == $jawaban_benar[$s]){
                    $jumlahBenar = $jumlahBenar+1;
                    $jumlahPointBenar = $jumlahPointBenar+$isiS->point;
                }
            }else{
                $jawaban_benar[$s] = explode(' ,  ', $jawaban_benar[$s]);
                $mcBenar = 0;
                foreach($jawaban[$s] as $smc => $isiSMC){
                    foreach($jawaban_benar[$s] as $isi => $isiIsi){
                        if($isiSMC == $isiIsi){
                            $mcBenar = $mcBenar+1;
                            break;
                        }elseif($isi == count($jawaban_benar[$s])-1){
                            $mcBenar = $mcBenar-1;
                        }
                    }
                }
                $jawaban[$s] = implode(' ,  ', $jawaban[$s]);
                if($mcBenar == count($jawaban_benar[$s])){
                    $jumlahBenar = $jumlahBenar+1;
                    $jumlahPointBenar = $jumlahPointBenar+$isiS->point;
                    $jawaban[$s] = implode(' ,  ', $jawaban_benar[$s]);
                }
            }
        }

        // Yang ini buat tanpa diacak soal dan jawaban
        // -------------------------------------------
        // for($i=0;$i<=count($soal)-1;$i++){
        //     $jawaban[] = $data['jawaban_'.$i];
        //     if(count($data['jawaban_'.$i]) == 1){
        //         if(is_array($jawaban[$i]) == true){
        //             $jawaban[$i] = $jawaban[$i][0];
        //         }
        //         if($jawaban[$i] == $jawaban_benar[$i]){
        //             $jumlahBenar        = $jumlahBenar+1;
        //             $jumlahPointBenar   = $jumlahPointBenar+$soal[$i]->point;
        //         }
        //     }else{
        //         $jawaban[$i] = implode(' ,  ', $jawaban[$i]);
        //         if($jawaban [$i] == $jawaban_benar[$i]){
        //             $jumlahBenar = $jumlahBenar+1;
        //             $jumlahPointBenar   = $jumlahPointBenar+$soal[$i]->point;
        //         }
        //     }
        // }

        $jumlahSalah    = count($soal) - $jumlahBenar;
        $nilaiKetampanan= round(($jumlahPointBenar / $jumlahPoint)* 100);
       
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

        if($nilai->save()){
            return redirect('/beranda')->with('success', 'Selamat, anda telah selesai mengerjakan soal.');
        }else{
            return redirect('/beranda')->with('error', 'Maaf, terjadi kesalahan.');
        }
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

        foreach($soal as $s => $isiS){
            $jawaban[] = $data['jawaban_'.$isiS->id_bank_soal];
            
            if(count($data['jawaban_'.$isiS->id_bank_soal]) == 1){
                if(is_array($jawaban[$s]) == true){
                    $jawaban[$s] = $jawaban[$s][0];
                }
                if($jawaban[$s] == $jawaban_benar[$s]){
                    $jumlahBenar = $jumlahBenar+1;
                    $jumlahPointBenar = $jumlahPointBenar+$isiS->point;
                }
            }else{
                $jawaban_benar[$s] = explode(' ,  ', $jawaban_benar[$s]);
                $mcBenar = 0;
                foreach($jawaban[$s] as $smc => $isiSMC){
                    foreach($jawaban_benar[$s] as $isi => $isiIsi){
                        if($isiSMC == $isiIsi){
                            $mcBenar = $mcBenar+1;
                            break;
                        }elseif($isi == count($jawaban_benar[$s])-1){
                            $mcBenar = $mcBenar-1;
                        }
                    }
                }
                $jawaban[$s] = implode(' ,  ', $jawaban[$s]);
                if($mcBenar == count($jawaban_benar[$s])){
                    $jumlahBenar = $jumlahBenar+1;
                    $jumlahPointBenar = $jumlahPointBenar+$isiS->point;
                    $jawaban[$s] = implode(' ,  ', $jawaban_benar[$s]);
                }
            }
        }

        $jumlahSalah    = count($soal) - $jumlahBenar;
        $nilaiKetampanan= round(($jumlahPointBenar / $jumlahPoint)* 100);

        // return $jumlahBenar;

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
            return redirect('/beranda')->with('success', 'Selamat, anda telah selesai mengerjakan soal.');
        }else{
            return redirect('/beranda')->with('error', 'Maaf, terjadi kesalahan.');
        }
    }

    public function naikKelas()
    {
        if(isset($_GET['idk'])) {
            $idk = $_GET['idk'];
            $siswa = Siswa::where('id_kelas', $idk)->get();
        }else{
            $idk = 1;
            $siswa = Siswa::where('id_kelas', $idk)->get();
        }

        $kelas = Kelas::all();
        return view('admin.siswa.naikKelas', compact('siswa', 'kelas', 'idk'));
    }

    public function storeNaikKelas(Request $request){
        if(isset($_POST)) {
            foreach($request['id_siswa'] as $id_siswa) {
                $siswa = Siswa::find($id_siswa);
                
                $nama_kelas = $siswa->kelas->nama_kelas; // Contoh : XI RPL 2

                // Dipisah dulu jadi array
                $angka_kelas = explode(' ', trim($nama_kelas)); // Hasil harusnya jadi [0] = 'XI', [1] = 'RPL', [2] = 2

                // Logika kenaikan kelas
                switch($angka_kelas[0]) {
                    case 'X'  :
                        $angka_kelas[0] = 'XI';
                        break;
                    case 'XI' :
                        $angka_kelas[0] = 'XII';
                        break;
                    case 'XII' :
                        $angka_kelas[0] = 'ALUMNI';
                        break;
                    default   :
                        break;
                }

                // Sekarang tinggal disatukan lagi
                $kelas = implode(' ', $angka_kelas); // Berdasarkan contoh, hasil harusnya jadi XII RPL 2

                $daftarKelas = Kelas::select('nama_kelas')->get(); // Daftar nama kelas yang ada

                if(in_array($kelas, array_column($daftarKelas->toArray(), 'nama_kelas') ) ) { // Apakah nama kelas ada di daftar kelas
                // Untuk if diatas, dia meng-check apakah 'XII RPL 2' ada di array daftar_kelas, di kolom nama_kelas nya (multidimensional array)
                // if(XII RPL in $daftarKelas['nama_kelas']) <-- Logika nya seperti ini

                    $id_kelas_baru = Kelas::select('id_kelas')->where('nama_kelas', $kelas)->first()['id_kelas']; // Hasil harusnya id_kelas
                    
                    $siswa->id_kelas = $id_kelas_baru;
                    $siswa->save();

                }else { // Kalau ternyata kelasnya belum ada
                    $kelas_baru = new Kelas;
                    $kelas_baru->nama_kelas = $kelas;

                    // Untuk sementara, pilihan jurusannya manual dulu
                    switch($angka_kelas[1]) {
                        case 'RPL' :
                            $kelas_baru->id_jurusan = 1;
                            break;
                        case 'MM' :
                            $kelas_baru->id_jurusan = 2;
                            break;
                        case 'TKJ' :
                            $kelas_baru->id_jurusan = 3;
                            break;
                        case 'AP' :
                            $kelas_baru->id_jurusan = 4;
                            break;
                        case 'AK' :
                            $kelas_baru->id_jurusan = 5;
                            break;
                        case 'PM' :
                            $kelas_baru->id_jurusan = 6;
                            break;
                    }

                    $kelas_baru->save();

                    $siswa->id_kelas = $kelas_baru->id_kelas;
                    $siswa->save();
                }
            }
            // Nah, sampai sini, program cuma menaikan kelas saja, tapi untuk di tampilannya belum di refresh.
        }
    }

    public function profil()
    {
        $siswa          = Siswa::find(session()->get('id_siswa'));
        $daftarKelas    = Kelas::all();
        $ability        = Nilai::select('nilai.id_siswa', 'siswa.nama as nama', 'mapel.nama_mapel as mapel')->selectRaw('avg(nilai.nilai) as nilai')->join('ujian', 'nilai.id_ujian', '=', 'ujian.id_ujian')->join('mapel', 'ujian.id_mapel', '=', 'mapel.id_mapel')->join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->where('siswa.id_siswa', session()->get('id_siswa'))->groupBy('mapel.id_mapel')->get();
        $daftarNilai    = Nilai::select('mapel.nama_mapel', 'ujian.judul_ujian', 'nilai.nilai')->join('ujian', 'nilai.id_ujian', '=', 'ujian.id_ujian')->join('mapel', 'ujian.id_mapel', '=', 'mapel.id_mapel')->where('nilai.id_siswa', session()->get('id_siswa'))->get(); 

        return view('siswa.profil', compact('siswa', 'daftarKelas', 'ability', 'daftarNilai'));
    }

    public function simpanProfil(Request $request)
    {
        $siswa = Siswa::find(session()->get('id_siswa'));
        $user  = User::find($siswa->id_users);

        $this->validate($request, 
        [
            'nis'           => ['required', 'numeric', 'digits:10', Rule::unique('siswa')->ignore($siswa->nis, 'nis')],
            'nama'          => ['required'],
            'username'      => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->username, 'username'), ],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->email, 'email')],
            'jenisKelamin'  => ['required'],
        ],
        [
            'nis.required' => 'NIS harus diisi', 'nis.numeric' => 'NIS harus angka', 'nis.digits' => 'NIS harus 10 karakter', 'nis.unique' => 'NIS sudah terdaftar',
            'nama.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi', 'username.max' => 'Username maksimal 20 karakter', 'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email harus diisi', 'email.email' => 'Email tidak valid', 'email.max' => 'Email maksimal 255 karakter', 'email.unique' => 'Email sudah terdaftar',
            'jenisKelamin.required' => 'Jenis Kelamin harus diisi'
        ]);
        
        $user->username = $request['username'];
        $user->email    = $request['email'];
        
        if($user->save()){
            $siswa->nis = $request['nis'];
            $siswa->id_kelas = $request['kelas'];
            $siswa->nama = $request['nama'];
            $siswa->alamat = $request['alamat'];
            $siswa->jenis_kelamin = $request['jenisKelamin'];
            $siswa->tahun_ajaran = $request['tahunAjaran'];

            if($request->file('foto')){
                if($siswa->foto != 'nophoto.jpg'){
                    unlink('storage/foto-profil/'.$siswa->foto);
                }

                $nameFotoToStore = $this->ambil($request->file('foto'));
                $siswa->foto = $nameFotoToStore;
            }

            if($siswa->save()){
                $buatLog = array(
                    'NIS' => $siswa->nis,
                    'Nama' => $siswa->nama,
                );
                \Log::info(Auth::user()->username.' mengubah data diri siswa dengan id : '.$siswa->id_siswa, $buatLog);

                return redirect('/siswa/profil')->with('success', 'Data berhasil diubah.');
            }
        }
        return redirect('/siswa/profil')->with('error', 'Data gagal diubah!');
    }
}
