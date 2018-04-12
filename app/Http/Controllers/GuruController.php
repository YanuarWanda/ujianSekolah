<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Guru;
use App\User;
use App\DaftarBidangKeahlian;
use App\BidangKeahlian;
use DB;
use Auth;

use App\Jurusan;

use Excel;

class GuruController extends Controller
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
        $guru = Guru::All();
        return view('admin.kelola-guru.tableView', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftarBK = DaftarBidangKeahlian::all();
        // return $daftarBK;
        return view('admin.kelola-guru.create', compact('daftarBK'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->validate($request, [
            'nip' => 'required|numeric|digits_between:19,21|unique:guru',
            'nama' => 'required',
            'username' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'bidangKeahlian' => 'required',
            'jenisKelamin' => 'required',
        ]);

        $user = new User;
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->hak_akses = 'guru';

        if($user->save()) {
            $guru = new Guru;
            $guru->nip = $request['nip'];
            $guru->id_users = $user->id_users;

            $guru->nama = $request['nama'];
            $guru->alamat = $request['alamat'];
            $guru->jenis_kelamin = $request['jenisKelamin'];

            if($request->file('foto')){
                $nameFotoToStore = $this->ambil($request->file('foto'));
            }else{
                $nameFotoToStore = 'nophoto.jpg';
            }

            $guru->foto = $nameFotoToStore;

            if($guru->save()) {
                $bidangKeahlian = $request['bidangKeahlian'];

                foreach ($bidangKeahlian as $bidang) {
                    $bidang_keahlian = new BidangKeahlian;
                    $bidang_keahlian->id_guru = $guru->id_guru;
                    $daftar_bidang_keahlian =
                        DaftarBidangKeahlian::select('id_daftar_bidang')
                            ->where('bidang_keahlian', $bidang)
                            ->get();

                    foreach($daftar_bidang_keahlian as $daftar) {
                        $bidang_keahlian->id_daftar_bidang = $daftar->id_daftar_bidang;
                    }

                    $bidang_keahlian->save();
                }
            }
        }

        return redirect('/kelola-guru')->with('success', 'Pendaftaran berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Guru::find(base64_decode($id));
        return view('admin.kelola-guru.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Guru::find(base64_decode($id));
        $daftarBK = DaftarBidangKeahlian::all();
        $bidang = BidangKeahlian::join('guru', 'bidang_keahlian.id_guru', '=', 'guru.id_guru')->join('daftar_bidang_keahlian', 'bidang_keahlian.id_daftar_bidang', '=', 'daftar_bidang_keahlian.id_daftar_bidang')->where('bidang_keahlian.id_guru', $data->id_guru)->get();
        
        return view('admin.kelola-guru.edit', compact('data', 'daftarBK', 'bidang'));
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
        $guru = Guru::find(base64_decode($id));
        $user = User::find($guru->id_users);

        $this->validate($request, [
            'nip'               => ['required', 'numeric', 'digits_between:19,21', Rule::unique('guru')->ignore($guru->nip, 'nip')],
            'nama'              => ['required'],
            'username'          => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->username, 'username')],
            'email'             => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->email, 'email')],
            'bidangKeahlian'    => ['required'],
            'jenisKelamin'      => ['required'],
        ]);

        $user->username = $request['username'];
        $user->email = $request['email'];

        if($user->save()) {
            $guru->nip = $request['nip'];
            $guru->id_users = $user->id_users;
            $guru->nama = $request['nama'];
            $guru->alamat = $request['alamat'];
            $guru->jenis_kelamin = $request['jenisKelamin'];

            if($request->file('foto')){
                if($guru->foto != 'nophoto.jpg'){
                    unlink('storage/foto-profil/'.$guru->foto);
                }

                $nameFotoToStore = $this->ambil($request->file('foto'));
                $guru->foto = $nameFotoToStore;
            }

            $bkGuru = BidangKeahlian::where('id_guru', $guru->id_guru)->get();
            
            if($guru->save()) {
                if(count($bkGuru) > 0){
                    // Untuk sementara, cara update bidang keahlian adalah dengan menghapus yang sudah ada, lalu menambahkan kembali
                    $deleteMany = BidangKeahlian::where('id_guru', $guru->id_guru)->delete();

                    if($deleteMany) {
                        $bidangKeahlian = $request['bidangKeahlian'];

                        foreach ($bidangKeahlian as $bidang) {
                            $bidang_keahlian = new BidangKeahlian;
                            $bidang_keahlian->id_guru = $guru->id_guru;
                            $daftar_bidang_keahlian =
                                DaftarBidangKeahlian::select('id_daftar_bidang')
                                    ->where('bidang_keahlian', $bidang)
                                    ->get();

                            foreach($daftar_bidang_keahlian as $daftar) {
                                $bidang_keahlian->id_daftar_bidang = $daftar->id_daftar_bidang;
                            }

                            $bidang_keahlian->save();
                        }
                        return redirect('/kelola-guru')->with('success', 'Data berhasil diubah.');
                    }
                }else{
                    $bidangKeahlian = $request['bidangKeahlian'];

                    foreach ($bidangKeahlian as $bidang) {
                        $bidang_keahlian = new BidangKeahlian;
                        $bidang_keahlian->id_guru = $guru->id_guru;
                        $daftar_bidang_keahlian =
                            DaftarBidangKeahlian::select('id_daftar_bidang')
                                ->where('bidang_keahlian', $bidang)
                                ->get();

                        foreach($daftar_bidang_keahlian as $daftar) {
                            $bidang_keahlian->id_daftar_bidang = $daftar->id_daftar_bidang;
                        }

                        $bidang_keahlian->save();
                    }
                    return redirect('/kelola-guru')->with('success', 'Data berhasil diubah.');
                }
            }
        }
        return redirect('/kelola-guru/edit', $id)->with('error', 'Data gagal diubah.');
    }

    public function updatePassword(Request $data, $id){
        $this->validate($data, [
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::find(base64_decode($id));

        $user->password = bcrypt($data['password']);

        if($user->save()){
           return redirect('/kelola-guru')->with('success', 'Data berhasil diubah!');
        }else{
           return redirect('/kelola-guru/edit/'.$user->id_users)->with('error', 'Data gagal diubah!');
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
        $guru = Guru::find(base64_decode($id));
        $user = User::find($guru->id_users);
        if(BidangKeahlian::where('id_guru', base64_decode($id))->get()) {
            $bidangKeahlian = BidangKeahlian::where('id_guru', base64_decode($id))->get();
        }else {
            $bidangKeahlian = null;
        }

        // return $guru->ujian;

        // if($guru->ujian) {
        //     return redirect()->back()->with('error', 'Guru tidak dapat dihapus');
        // }

        if($guru && $user) {
            if($bidangKeahlian != null) {
                foreach($bidangKeahlian as $bidang){
                    $bidang->delete();
                }    
            }
            
            if($guru->delete() && $user->delete()){
                if($guru->foto != 'nophoto.jpg'){
                    unlink('storage/foto-profil/'.$guru->foto);
                }
                return redirect('/kelola-guru')->with('success', 'Data Dihapus');
            }
        }
        return redirect('/kelola-guru')->with('error', 'Penghapusan gagal');
    }

    public function storeDataGuru(Request $request, $id) {
        $guru = Guru::where('nip', base64_decode($id))->get()->first();
        $user = Users::find($guru->id_users);

        $this->validate($request, [
            'nip'               => ['required', 'numeric', 'digits_between:19,21', Rule::unique('guru')->ignore($guru->nip, 'nip')],
            'nama'              => ['required'],
            'username'          => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->username, 'username')],
            'email'             => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->email, 'email')],
            'bidangKeahlian'    => ['required'],
            'jenisKelamin'      => ['required'],
        ]);

        $guru->nip = $request['nip'];
        $guru->nama = $request['nama'];
        $guru->alamat = $request['alamat'];
        $guru->jenis_kelamin = $request['jenisKelamin'];

        if($request->file('foto')){
            $nameFotoToStore = $this->ambil($request->file('foto'));
            $guru->foto = $nameFotoToStore;
        }

        $user = User::find($guru->id_users);
        $user->username = $request['username'];

        $bkGuru = BidangKeahlian::where('id_guru', $guru->id_guru);

        if($user->save() && $guru->save()) {
            if(count($bkGuru) > 0){
                // Untuk sementara, cara update bidang keahlian adalah dengan menghapus yang sudah ada, lalu menambahkan kembali
                $deleteMany = BidangKeahlian::where('id_guru', $guru->id_guru)->delete();

                if($deleteMany) {
                    $bidangKeahlian = $request['bidangKeahlian'];

                    foreach ($bidangKeahlian as $bidang) {
                        $bidang_keahlian = new BidangKeahlian;
                        $bidang_keahlian->id_guru = $guru->id_guru;
                        $daftar_bidang_keahlian =
                            DaftarBidangKeahlian::select('id_daftar_bidang')
                                ->where('bidang_keahlian', $bidang)
                                ->get();

                        foreach($daftar_bidang_keahlian as $daftar) {
                            $bidang_keahlian->id_daftar_bidang = $daftar->id_daftar_bidang;
                        }

                        $bidang_keahlian->save();
                    }
                    return redirect('/home')->with('success', 'Data berhasil diubah');
                }
            }else{
                $bidangKeahlian = $request['bidangKeahlian'];

                foreach ($bidangKeahlian as $bidang) {
                    $bidang_keahlian = new BidangKeahlian;
                    $bidang_keahlian->id_guru = $guru->id_guru;
                    $daftar_bidang_keahlian =
                        DaftarBidangKeahlian::select('id_daftar_bidang')
                            ->where('bidang_keahlian', $bidang)
                            ->get();

                    foreach($daftar_bidang_keahlian as $daftar) {
                        $bidang_keahlian->id_daftar_bidang = $daftar->id_daftar_bidang;
                    }

                    $bidang_keahlian->save();
                }
                    return redirect('/home')->with('success', 'Data berhasil diubah');
            }
        } else {
            return redirect('/settings')->with('error', 'Data gagal diubah');
        }
    }

    public function importView() {
        return view('admin.kelola-guru.import');
    }

    // public function importToDatabase(Request $request){

    //     $this->validate($request,
    //     [
    //         'fileExcel' => 'required',
    //     ],
    //     [
    //         'fileExcel.required' => 'File harus diisi',
    //     ]);

    //     if($request->hasFile('fileExcel')){
    //         $path = $request->file('fileExcel')->getRealPath();
    //         $data = \Excel::load($path)->get();
    //         if($data->count()){
    //             foreach ($data as $key => $value) {
    //                 $user[] = [
    //                     'username'      => strtolower(str_replace(' ', '', $value->nama)),
    //                     'password'      => bcrypt($value->nip),
    //                     'email'         => $value->email,
    //                     'hak_akses'     => 'guru',
    //                     'created_at'    => now(),
    //                     'updated_at'    => now(),
    //                 ];

    //                 $guru[] = [
    //                     'nip'           => $value->nip,
    //                     'nama'          => $value->nama,
    //                     'alamat'        => $value->alamat,
    //                     'jenis_kelamin' => $value->jenis_kelamin,
    //                     'foto'          => 'nophoto.jpg',
    //                 ];

    //                 $bk = explode(', ', $value->bidang_keahlian);
    //             }

    //             // return $bk;

    //             // Mengambil semua nip yang ada
    //             $daftar_nip = Guru::get(['nip']);
                
    //             foreach($daftar_nip as $key => $daftar) {
    //                 $nip[$key] = $daftar->nip;
    //             }

    //             // Handle NIP yang sudah ada
    //             // return $guru[0]['nip'];

    //             foreach($guru as $g) {
    //                 if(in_array($g['nip'], $nip) ) {
    //                     return redirect()->back()->with('error', "NIP ".$g['nip']." sudah terdaftar!");
    //                 }
    //             }

    //             if(!empty($user) && !empty($guru)){
    //                 \DB::table('users')->insert($user);
    //                 $dataUser = DB::select("SELECT * FROM users WHERE users.id_users NOT IN (SELECT id_users FROM guru) AND hak_akses = 'guru'");
                    
    //                 foreach ($dataUser as $key => $value) {
    //                     $guru[$key]['id_users'] = $value->id_users;
    //                 }

    //                 if(count($guru) > $data->count()) {
    //                     $dataCount = $data->count(); // Jumlah data asli
    //                     $emptyCount = count($guru); // Jumlah data keseluruhan (plus empty row)

    //                     for($x = $dataCount; $x <= $emptyCount; $x++) {
    //                         unset($guru[$x]); // Menghapus row kosong
    //                     }
    //                 }

    //                 \DB::table('guru')->insert($guru);

    //                 $lastGuru = Guru::orderBy('id_guru', 'desc')->limit(1)->get()->first();

    //                 foreach($bk as $bks => $bksv){
    //                     $buatDB = DaftarBidangKeahlian::where('bidang_keahlian', $bksv)->get()->first() ?? null;



    //                     $buatBK[] = [
    //                         'id_guru' => $lastGuru->id_guru,
    //                         'id_daftar_bidang' => $buatDB->id_daftar_bidang,
    //                     ];
    //                 }

    //                 // \DB::table('bidang_keahlian')->insert($buatBK);

    //                 // \Log::info(Auth::user()->username.' meng-import data guru');
    //                 // return redirect()->back()->with('success', 'Import data berhasil dilakukan');

    //                 dd($buatBK);
    //             }
    //         }
    //     }   
    // }
    public function importToDatabase(Request $request){

        $this->validate($request,
        [
            'fileExcel' => 'required',
        ],
        [
            'fileExcel.required' => 'File harus diisi',
        ]);

        if($request->hasFile('fileExcel')){
            $path = $request->file('fileExcel')->getRealPath();
            $data = \Excel::load($path)->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    $user[] = [
                        'username'      => strtolower(str_replace(' ', '', $value->nama)),
                        'password'      => bcrypt($value->nip),
                        'email'         => $value->email,
                        'hak_akses'     => 'guru',
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ];

                    $guru[] = [
                        'nip'           => $value->nip,
                        'nama'          => $value->nama,
                        'alamat'        => $value->alamat,
                        'jenis_kelamin' => $value->jenis_kelamin,
                        'foto'          => 'nophoto.jpg',
                    ];

                    $bk = explode(', ', $value->bidang_keahlian);
                }

                // return $bk;

                // Mengambil semua nip yang ada
                $daftar_nip = Guru::get(['nip']);
                
                foreach($daftar_nip as $key => $daftar) {
                    $nip[$key] = $daftar->nip;
                }

                // Handle NIP yang sudah ada
                // return $guru[0]['nip'];

                foreach($guru as $g) {
                    if(in_array($g['nip'], $nip) ) {
                        return redirect()->back()->with('error', "NIP ".$g['nip']." sudah terdaftar!");
                    }
                }

                if(!empty($user) && !empty($guru)){
                    \DB::table('users')->insert($user);
                    $dataUser = DB::select("SELECT * FROM users WHERE users.id_users NOT IN (SELECT id_users FROM guru) AND hak_akses = 'guru'");
                    
                    foreach ($dataUser as $key => $value) {
                        $guru[$key]['id_users'] = $value->id_users;
                    }

                    if(count($guru) > $data->count()) {
                        $dataCount = $data->count(); // Jumlah data asli
                        $emptyCount = count($guru); // Jumlah data keseluruhan (plus empty row)

                        for($x = $dataCount; $x <= $emptyCount; $x++) {
                            unset($guru[$x]); // Menghapus row kosong
                        }
                    }

                    \DB::table('guru')->insert($guru);

                    $lastGuru = Guru::orderBy('id_guru', 'desc')->limit(1)->get()->first();

                    foreach($bk as $bks => $bksv){
                        $buatDB = DaftarBidangKeahlian::where('bidang_keahlian', $bksv)->get()->first() ?? null;



                        $buatBK[] = [
                            'id_guru' => $lastGuru->id_guru,
                            'id_daftar_bidang' => $buatDB->id_daftar_bidang,
                        ];
                    }

                    // \DB::table('bidang_keahlian')->insert($buatBK);

                    // \Log::info(Auth::user()->username.' meng-import data guru');
                    // return redirect()->back()->with('success', 'Import data berhasil dilakukan');

                    dd($buatBK);
                }
            }
        }   
    }

    public function exportToExcel(){
        Excel::create('Data Guru per '.date("Y-m-d"), function($excel) {
            $excel->setCreator('U-LAH')->setCompany('U-LAH');
            $excel->setDescription('Data Guru yang di export per tanggal '.date("Y-m-d").".");
            $excel->setSubject('Data Guru');
            $excel->sheet('Data Guru', function($sheet) {
                $bidangKeahlian = BidangKeahlian::join('daftar_bidang_keahlian', 'bidang_keahlian.id_daftar_bidang', '=', 'daftar_bidang_keahlian.id_daftar_bidang')->join('guru', 'bidang_keahlian.id_guru', '=', 'guru.id_guru')->join('users', 'guru.id_users', '=', 'users.id_users')->get();
                foreach($bidangKeahlian as $bk => $bkValue){
                    $data[$bk]['id_guru'] = $bkValue->id_guru;
                    $data[$bk]['nip'] = $bkValue->nip;
                    $data[$bk]['nama'] = $bkValue->nama;
                    $data[$bk]['email'] = $bkValue->email;
                    $data[$bk]['alamat'] = $bkValue->alamat;
                    $data[$bk]['jenis_kelamin'] = $bkValue->jenis_kelamin;
                    $data[$bk]['bidang_keahlian'] = $bkValue->bidang_keahlian;
        
                    foreach($data as $d => $dValue){
                        if($bkValue->id_guru == $dValue['id_guru'] && $bkValue->bidang_keahlian != $dValue['bidang_keahlian']){
                            unset($data[$d]);
                            $data[$bk]['bidang_keahlian'] = $dValue['bidang_keahlian'].', '.$bkValue->bidang_keahlian;
                        }
                    }
                }
         
                // Data yang akan di Export
                foreach($data as $d) {
                    $dataFix[] = array(
                        $d['nip'],
                        $d['nama'],
                        $d['email'],
                        $d['alamat'],
                        $d['jenis_kelamin'],
                        $d['bidang_keahlian'],
                    );
                }
         
                // Mengisi Data ke Excel
                $sheet->fromArray($dataFix, null, 'A1', false, false);

                // Menambahkan Judul ke Excel
                $headings = array('NIP', 'Nama', 'Email', 'Alamat', 'Jenis Kelamin', 'Bidang Keahlian');
                $sheet->prependRow(1, $headings);
            });
        })->export('xlsx');

        \Log::info(Auth::user()->username.' meng-export data guru');
        return redirect()->back()->with('success', 'Data Guru berhasil di Export');
    }
}
