<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                // 'email' => $data['email'], // Dipindah ke table users
                // 'jurusan' => $data['jurusan'], // Dipindah ke table jurusan, dengan relasi ke table kelas
                'foto' => $nameFotoToStore, // Untuk sementara dikosongkan
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
        // return $data;
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
        $this->validate($request, [
            'username' => 'required',
            'email'    => 'required',
        ]);

        $siswa = Siswa::find(base64_decode($id));
        $user  = User::find($siswa->id_users);

        $user->username = $request['username'];
        $user->email    = $request['email'];

        if($user->save()){
            $siswa->nis = $request['nis'];
            $siswa->id_kelas = Kelas::where('nama_kelas', $request['kelas'])->first()->id_kelas;
            $siswa->nama = $request['nama'];
            $siswa->alamat = $request['alamat'];
            // $siswa->jurusan = $request['jurusan']; // Dipindah ke tablenya sendiri, dengan relasi melalui table kelas
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

        $kelas = Kelas::all();
        return view('admin.kelola-siswa.naik-kelas', compact('siswa', 'kelas', 'idk'));
    }
}
