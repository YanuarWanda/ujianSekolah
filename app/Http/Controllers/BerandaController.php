<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Siswa;
use App\Guru;
use App\Nilai;
use App\NilaiRemedial;
use App\User;
use App\Ujian;
use App\UjianRemedial;
use App\BidangKeahlian;
use App\DaftarBidangKeahlian;

// Untuk Pagination
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests;

use DB;

class BerandaController extends Controller
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

    public function index(){
        if(Auth::user()->hak_akses == 'admin') {
            $user = array(
                'hak_akses' => Auth::user()->hak_akses,
                'username'  => Auth::user()->username,
            );
            \Log::info('Admin mengakses beranda dengan data : ', $user);
            
            $chart1 = BidangKeahlian::selectRaw('count(guru.id_guru) as jumlah, daftar_bidang_keahlian.bidang_keahlian')->join('daftar_bidang_keahlian', 'bidang_keahlian.id_daftar_bidang', '=', 'daftar_bidang_keahlian.id_daftar_bidang')->join('guru', 'bidang_keahlian.id_guru', '=', 'guru.id_guru')->groupBy('bidang_keahlian.id_daftar_bidang')->orderBy('jumlah', 'DESC')->get(); 
            
            return view('admin.beranda', compact('chart1'));
        }else if(Auth::user()->hak_akses == 'guru') {
            $guru = Guru::where('id_users', Auth::user()->id_users)->get()->first();
            $user = array(
                'hak_akses' => Auth::user()->hak_akses,
                'username'  => Auth::user()->username,
            );
            session(['id_guru' => $guru->id_guru]);
            \Log::info('Guru mengakses beranda dengan data : ', $user);

            $chart1  = Nilai::select('ujian.id_ujian', 'ujian.judul_ujian as judul', 'kelas.nama_kelas as kelas')->selectRaw('avg(nilai) as rataNilai')->join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->join('ujian', 'nilai.id_ujian', '=', 'ujian.id_ujian')->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->where('nilai.id_ujian', function($query){$query->select('id_ujian')->from('ujian')->where('id_guru', session()->get('id_guru'))->orderBy('tanggal_post', 'DESC')->limit('1');})->groupBy('kelas.id_kelas')->first();
            $tabel1  = Nilai::select('siswa.nama', 'kelas.nama_kelas', 'nilai.nilai')->join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->where('nilai.id_ujian', function($query){$query->select('id_ujian')->from('ujian')->orderBy('tanggal_post', 'DESC')->where('id_guru', session()->get('id_guru'))->limit('1');})->orderBy('nilai.nilai', 'DESC')->get();
            
            return view('guru.beranda', compact('chart1', 'tabel1'));
        }else if(Auth::user()->hak_akses == 'siswa'){
            $siswa = Siswa::where('id_users', Auth::user()->id_users)->get()->first();
            $user = array(
                'hak_akses' => Auth::user()->hak_akses,
                'username'  => Auth::user()->username,
            );
            session(['id_siswa' => $siswa->id_siswa]);
            \Log::info('Siswa mengakses beranda dengan data : ', $user);

            $nilai              = Nilai::join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->where('siswa.id_siswa', $siswa->id_siswa)->orderBy('siswa.id_siswa')->get();
            $nilaiR             = NilaiRemedial::join('siswa', 'nilai_remedial.id_siswa', '=', 'siswa.id_siswa')->where('siswa.id_siswa', $siswa->id_siswa)->orderBy('siswa.id_siswa')->get();
            $ujian              = Ujian::select('ujian.id_ujian', 'mapel.nama_mapel', 'guru.nama', 'judul_ujian', 'waktu_pengerjaan', 'tanggal_post', 'tanggal_kadaluarsa', 'status', 'catatan', 'lihat_nilai')->join('mapel', 'ujian.id_mapel', '=', 'mapel.id_mapel')->join('kelas_ujian', 'ujian.id_ujian', '=', 'kelas_ujian.id_ujian')->join('kelas', 'kelas_ujian.id_kelas', '=', 'kelas.id_kelas')->where('kelas_ujian.id_kelas', $siswa->id_kelas)->where('status', 'posted')->join('guru', 'ujian.id_guru', '=', 'guru.id_guru')->orderBy('tanggal_post', 'DESC')->simplePaginate(4);
            $ujianRemedArray    = UjianRemedial::select('ujian.judul_ujian', 'ujian_remedial.id_ujian_remedial', 'ujian_remedial.remed_ke', 'mapel.nama_mapel', 'ujian_remedial.tanggal_kadaluarsa', 'ujian_remedial.catatan')->join('ujian', 'ujian_remedial.id_ujian', '=', 'ujian.id_ujian')->join('mapel', 'ujian.id_mapel', '=', 'mapel.id_mapel')->join('nilai', 'ujian_remedial.id_ujian', '=', 'nilai.id_ujian')->join('siswa', 'nilai.id_siswa', '=', 'siswa.id_siswa')->where('ujian_remedial.status', 'posted')->where('siswa.id_siswa', $siswa->id_siswa)->where('nilai.status_pengerjaan', 'Harus Remedial')->orderBy('ujian_remedial.tanggal_pembuatan', 'DESC')->get();
            $curPageRemed       = LengthAwarePaginator::resolveCurrentPage();
            $itemColRemed       = collect($ujianRemedArray);
            $perPageRemed       = 2;
            $currentPageRemed   = $itemColRemed->slice(($curPageRemed * $perPageRemed) - $perPageRemed, $perPageRemed)->all();
            $paginatedItemsRemed= new LengthAwarePaginator($currentPageRemed, count($itemColRemed), $perPageRemed);
            $paginatedItemsRemed->setPath(url()->current());
            $ujianRemed = $paginatedItemsRemed;
            // return $ujianRemedArray;

            return view('siswa.beranda', compact('siswa', 'nilai', 'nilaiR', 'ability', 'ujian', 'ujianRemedArray', 'ujianRemed'));
        }
    }

    public function settings(){
        if(Auth::user()->hak_akses == 'admin'){
            return view('admin.settings');
        }elseif(Auth::user()->hak_akses == 'guru'){
            return view('guru.settings');
        }elseif(Auth::user()->hak_akses == 'siswa'){
            return view('siswa.settings');
        }
    }

    public function gantiPasswordAdmin(Request $request){
        $user = User::find(Auth::user()->id_users);
        $user->password = bcrypt($request['password']);
        
        if($user->save()){
            return back()->with('success', 'Password berhasil diubah!');
        }else{
            return back()->with('error', 'Password gagal diubah!');
        }
    }

}
