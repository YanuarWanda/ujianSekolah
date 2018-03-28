<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

use Excel;

use App\User;
use App\Guru;
use App\Siswa;
use App\Kelas;
use App\Ujian;
use App\DaftarBidangKeahlian;
use App\BidangKeahlian;
use App\Nilai;
use App\NilaiRemedial;
use App\SoalRemed;
use App\UjianRemedial;

// Untuk Pagination
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hak_akses == 'admin') {
            $user = array(
                'hak_akses' => Auth::user()->hak_akses,
                'username' => Auth::user()->username,
            );
            \Log::info('Mengakses home', $user);
            return view('admin.dashboard');
        } else if(Auth::user()->hak_akses == 'guru') {
            $guru = Guru::where('id_users', Auth::user()->id_users)->get()->first();
            $user = array(
                'hak_akses' => Auth::user()->hak_akses,
                'username'  => Auth::user()->username,
            );
            session(['id_guru' => $guru->id_guru]);
            \Log::info('Mengakses home', $user);
            // return $guru->id_guru;
            return view('guru.home');
        } else if(Auth::user()->hak_akses == 'siswa') {
            $siswa = Siswa::where('id_users', Auth::user()->id_users)->first();
            $user = array(
                'hak_akses' => Auth::user()->hak_akses,
                'username'  => Auth::user()->username,
            );
            session(['id_siswa' => $siswa->id_siswa]);

            $nilai  = Nilai::join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->where('siswa.id_siswa', $siswa->id_siswa)->orderBy('siswa.id_siswa')->get();
            $nilaiR = NilaiRemedial::join('siswa', 'nilai_remedial.id_siswa', '=', 'siswa.id_siswa')->where('siswa.id_siswa', $siswa->id_siswa)->orderBy('siswa.id_siswa')->get();

            $ujianArray = DB::select('
                select id_ujian, id_mapel, nama_mapel, id_guru, judul_ujian, waktu_pengerjaan, tanggal_post, tanggal_kadaluarsa, status, catatan, lihat_nilai from ujian u
                join mapel m using (id_mapel)
                join kelas_ujian ku using (id_ujian)
                join kelas k using (id_kelas)
                where ku.id_kelas = :id_kelas
                and status = :status
                order by tanggal_post asc
                ', ['id_kelas' => $siswa->id_kelas, 'status' => 'posted']);
            // Get current page form url e.x. &page=1
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            // Create a new Laravel collection from the array data
            $itemCollection = collect($ujianArray);
            // Define how many items we want to be visible in each page
            $perPage = 2;
            // Slice the collection to get the items to display in current page
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            // Create our paginator and pass it to the view
            $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
            // set url path for generted links
            $paginatedItems->setPath(url()->current());
            $ujian = $paginatedItems;

            $ujianRemedArray    = DB::select('SELECT ujian.judul_ujian, ujian_remedial.remed_ke, mapel.nama_mapel, ujian_remedial.tanggal_pembuatan, ujian_remedial.tanggal_kadaluarsa, ujian_remedial.catatan, ujian_remedial.id_ujian_remedial, ujian_remedial.id_ujian FROM ujian_remedial JOIN ujian USING(id_ujian) JOIN mapel USING(id_mapel) JOIN kelas_ujian USING(id_ujian) JOIN kelas USING(id_kelas) JOIN siswa USING(id_kelas) WHERE kelas_ujian.id_kelas = '.$siswa->kelas->id_kelas.' AND ujian_remedial.status = "posted" AND siswa.id_siswa = '.$siswa->id_siswa.' AND siswa.id_siswa IN (SELECT id_siswa FROM nilai WHERE status_pengerjaan="Harus Remedial" AND nilai.id_ujian = ujian.id_ujian) ORDER BY tanggal_post ASC');
            $curPageRemed       = LengthAwarePaginator::resolveCurrentPage();
            $itemColRemed       = collect($ujianRemedArray);
            $perPageRemed       = 2;
            $currentPageRemed   = $itemColRemed->slice(($curPageRemed * $perPageRemed) - $perPageRemed, $perPageRemed)->all();
            $paginatedItemsRemed= new LengthAwarePaginator($currentPageRemed, count($itemColRemed), $perPageRemed);
            $paginatedItemsRemed->setPath(url()->current());
            $ujianRemed = $paginatedItemsRemed;

            // return $ujian;

            return view('siswa.siswa', compact('siswa', 'ujian', 'ujianArray', 'nilai', 'ujianRemed', 'ujianRemedArray', 'nilaiR'));
        }
    }

    public function settings() {
        if(Auth::user()->hak_akses == 'admin') {
            return view('settings.setting');
        } else if(Auth::user()->hak_akses == 'guru') {
            $data       = Guru::where('id_users', Auth::user()->id_users)->first();
            $bidang     = BidangKeahlian::join('guru', 'bidang_keahlian.id_guru', '=', 'guru.id_guru')->join('daftar_bidang_keahlian', 'bidang_keahlian.id_daftar_bidang', '=', 'daftar_bidang_keahlian.id_daftar_bidang')->where('bidang_keahlian.id_guru', $data->id_guru)->pluck('daftar_bidang_keahlian.bidang_keahlian', 'daftar_bidang_keahlian.bidang_keahlian');
            $daftarBK   = DaftarBidangKeahlian::pluck('bidang_keahlian', 'bidang_keahlian');
            // return $bidang;
            // dd($bidang);
            // dd($daftarBK);
            return view('settings.setting', compact('data', 'daftarBK', 'bidang'));
        } else if(Auth::user()->hak_akses == 'siswa') {
            $data = Siswa::where('id_users', Auth::user()->id_users)->first();
            $kelas = Kelas::All();
            // return $data->nis;
            return view('settings.setting', compact('data', 'kelas'));
        }
    }

    // Function untuk mengubah password dari semua user
    public function ubahPassword(Request $request, $id) {
        $this->validate($request, [
            'password' =>'required|string|confirmed',
        ]);

        $user = User::find(base64_decode($id));

        $user->password = bcrypt($request['password']);
        $user->save();

        return redirect('/home')->with('success', 'Password berhasil diubah');
    }


    // data untuk Chart di dashboard admin
    public function chartData() {
        // $result = Nilai::select('judul_ujian', 'nama', 'nilai', 'jawaban_benar', 'jawaban_salah')
        //             ->join('ujian', 'ujian.id_ujian', '=', 'nilai.id_ujian')
        //             ->join('siswa', 'siswa.id_siswa', '=', 'nilai.id_siswa')
        //             ->where('nilai.id_ujian', '=', '1')->get();
        
        // Mengambil nilai satu ujian, dari semua kelas yang ujian.
        // $result = Nilai::select('nama_kelas', 'nilai')
        //             ->join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')
        //             ->join('kelas', 'siswa.id_kelas', 'kelas.id_kelas')
        //             ->where('nilai.id_ujian', '=', '1')
        //             ->whereIn('siswa.id_kelas', function($query) {
        //                 $query->select('id_kelas')
        //                 ->from('kelas_ujian')
        //                 ->where('id_ujian', '1');
        //             })
        //             ->get();


        // Array untuk menampung collections


        // Mengambil 3 ujian terbaru
        $idUjian = Ujian::orderBy('tanggal_kadaluarsa', 'desc')->limit(3)->get(['id_ujian']);

        foreach ($idUjian as $key => $value) {
            $ujian = Nilai::select('judul_ujian', 'nama_kelas')
                    ->selectRaw('avg(nilai) as nilai_rata_rata') // query seperti avg dll harus menggunakan DB::raw() atau selectRaw()
                    ->join('ujian', 'nilai.id_ujian', '=', 'ujian.id_ujian')
                    ->join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')
                    ->join('kelas', 'siswa.id_kelas', 'kelas.id_kelas')
                    ->where('nilai.id_ujian', $value['id_ujian'])
                    ->whereIn('siswa.id_kelas', function($query) use ($value) {
                        $query->select('id_kelas')
                        ->from('kelas_ujian')
                        ->where('id_ujian', '=', $value['id_ujian']);
                    })
                    ->groupBy('kelas.id_kelas')
                    ->get();
            // return $ujian;
            $arrayCollection[$key] = $ujian;
        }

        // dd($arrayCollection);
        return response()->json($arrayCollection);
    }

    public function pieChart() {
        $data = User::select('hak_akses')->selectRaw('count(id_users) as jumlah_data')
                    ->groupBy('hak_akses')
                    ->get();

        return response()->json($data);
    }

    public function chartGuru() {
        $id = Guru::where('id_users', Auth::user()->id_users)->first(['id_guru']);
        // return $id_guru;
        $id_guru = $id['id_guru'];
        $query = DB::select("SELECT
                  u.judul_ujian, AVG(n.nilai) AS 'rata_rata'
                FROM
                  nilai n
                  JOIN ujian u USING (id_ujian)
                WHERE id_mapel IN
                  (SELECT
                    id_mapel
                  FROM
                    mapel
                  WHERE id_daftar_bidang =
                    (SELECT
                      id_daftar_bidang
                    FROM
                      bidang_keahlian
                    WHERE id_guru = $id_guru))
                GROUP BY id_ujian");
        return response()->json($query);
    }
}