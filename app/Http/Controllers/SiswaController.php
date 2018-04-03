<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Siswa;
use App\User;
use App\Kelas;
use Storage;
use Excel;
use DB;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //copas hela nya.
    public function ambil($file){
        $fileNameFull = $file->getClientOriginalName();
        $name = pathinfo($fileNameFull, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $nameFinal = $name.'_'.time().'.'.$extension;

        $file->storeAs('public/foto-profil', $nameFinal);

        return $nameFinal;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::All();
        return view('admin.kelola-siswa.tableView', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::All();
        return view('admin.kelola-siswa.create', compact('kelas'));
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
            'nis' => 'required|numeric|digits:10|unique:siswa',
            'nama' => 'required',
            'kelas' => 'required',
            'username' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

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
                'id_kelas' => Kelas::where('nama_kelas', $data['kelas'])->first()->id_kelas,
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'jenis_kelamin' => $data['jenisKelamin'],
                'foto' => $nameFotoToStore, 
            ]);

            return redirect('/kelola-siswa')->with('success', 'Pendaftaran Berhasil');
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
        $data = Siswa::find(base64_decode($id));
        // return $data;
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
        $data = Siswa::find(base64_decode($id));
        $kelas = Kelas::All();
        
        return view('admin.kelola-siswa.edit', compact('data', 'kelas'));
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
        $siswa = Siswa::where('nis', base64_decode($id))->get()->first();
        $user  = User::find($siswa->id_users);

        $this->validate($request, [
            'nis'           => ['required', 'numeric', 'digits:10', Rule::unique('siswa')->ignore($siswa->nis, 'nis')],
            'nama'          => ['required'],
            'username'      => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->username, 'username'), ],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->email, 'email')],
            'jenisKelamin'  => ['required'],
        ]);
        
        $user->username = $request['username'];
        $user->email    = $request['email'];
        
        if($user->save()){
            $siswa->nis = $request['nis'];
            $siswa->id_kelas = Kelas::where('nama_kelas', $request['kelas'])->first()->id_kelas;
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
                return redirect('/kelola-siswa')->with('success', 'Data berhasil diubah.');
            }
        }
        return redirect('/kelola-siswa/edit/'.$user->nis)->with('error', 'Data gagal diubah!');
    }

    public function updateAkun(Request $data, $id){
        $this->validate($data, [
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::find(base64_decode($id));

        $user->password     = bcrypt($data['password']);

        if($user->save()){
            return redirect('/kelola-siswa')->with('success', 'Data berhasil diubah');
        }else{
            return redirect('/kelola-siswa/edit/'.$user->nis)->with('error', 'Data gagal diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find(base64_decode($id));
        $user = User::find($siswa['id_users']);

        if($siswa && $user) {
            if($siswa->delete() && $user->delete()){
                if($siswa->foto != 'nophoto.jpg'){
                    unlink('storage/foto-profil/'.$siswa->foto);
                }
                return redirect('/kelola-siswa')->with('success', 'Data Dihapus');
            }
        }
        else return redirect('/kelola-siswa')->with('error', 'Penghapusan gagal');
    }

    // Mengupdate data user, dari menu settings
    public function storeDataSiswa(Request $request, $id) {
        $siswa  = Siswa::where('nis', base64_decode($id))->get()->first();
        $user   = User::find($siswa->id_users);

        $this->validate($request, [
            'nis'           => ['required', 'numeric', 'digits:10', Rule::unique('siswa')->ignore($siswa->nis, 'nis')],
            'nama'          => ['required'],
            'username'      => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->username, 'username'), ],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->email, 'email')],
            'jenisKelamin'  => ['required'],
        ]);

        $siswa->nis = $request['nis'];
        $siswa->nama = $request['nama'];
        $siswa->id_kelas = Kelas::where('nama_kelas', $request['kelas'])->first()->id_kelas;
        $siswa->alamat = $request['alamat'];
        $siswa->jenis_kelamin = $request['jenisKelamin'];

        if($request->file('foto')){
            $nameFotoToStore = $this->ambil($request->file('foto'));
            $siswa->foto = $nameFotoToStore;
        }

        $user = User::find($siswa->id_users);
        $user->username = $request['username'];

        if($user->save() && $siswa->save()) {
            return redirect('/home')->with('success', 'Data berhasil diubah');
        } else return redirect('/settings')->with('error', 'Data gagal diubah');
    }

    public function importView() {
        return view('admin.kelola-siswa.import');
    }

    public function importToDatabase(Request $request) {
        $this->validate($request, [
            'fileExcel' => 'required',
        ]);

        if($request->hasFile('fileExcel')){
            $path = $request->file('fileExcel')->getRealPath();
            $data = \Excel::load($path)->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    $user[] = [
                        'username'      => $value->username,
                        'password'      => bcrypt($value->password),
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

                    return redirect('/home')->with('success', 'Import data berhasil dilakukan');
                }
            }
        }
    }

    public function exportToExcel() {
        Excel::create('Data Siswa', function($excel) {
            $excel->sheet('Sheet 1', function($sheet) {
                // Data yang akan di Export
                $dataSiswa = Siswa::join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
                    ->select('nis', 'nama', 'kelas.nama_kelas', 'alamat', 'jenis_kelamin')
                    ->get();

                foreach($dataSiswa as $siswa) {
                    $data[] = array(
                        $siswa->nis,
                        $siswa->nama,
                        $siswa->nama_kelas,
                        $siswa->alamat,
                        $siswa->jenis_kelamin,
                    );
                }

                // Mengisi Data ke Excel
                $sheet->fromArray($data, null, 'A1', false, false);

                // Menambahkan Judul ke Excel
                $headings = array('NIS', 'Nama', 'Kelas', 'Alamat', 'Jenis Kelamin');
                $sheet->prependRow(1, $headings);
            });
        })->export('xls');

        return redirect()->back()->with('success', 'Data Siswa berhasil di Export');
    }

    public function naikKelasView() {
        if(isset($_GET['idk'])) {
            $idk = $_GET['idk'];
            $siswa = Siswa::where('id_kelas', $idk)->get();
        }else{
            $idk = 1;
            $siswa = Siswa::where('id_kelas', $idk)->get();
        }

        $kelas = Kelas::where('nama_kelas', 'NOT LIKE', '%ALUMNI%')->get();
        return view('admin.kelola-siswa.naik-kelas', compact('siswa', 'kelas', 'idk'));
    }

    public function naikKelas(Request $request) {
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
}
