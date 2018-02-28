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

            $nilai = Nilai::join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->where('siswa.id_siswa', $siswa->id_siswa)->get();
            // return $nilai;
            $ujianArray = DB::select('
                select id_ujian, id_mapel, nama_mapel, id_guru, judul_ujian, waktu_pengerjaan, tanggal_post, tanggal_kadaluarsa, status, catatan from ujian u
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
            // return count($nilai);
            // return $ujianArray;
            return view('siswa.siswa', compact('siswa', 'ujian', 'ujianArray', 'nilai'));
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
}
