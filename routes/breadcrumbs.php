
<?php

use App\Guru;
use App\DaftarBidangKeahlian;
use App\Mapel;
use App\Siswa;
use App\Ujian;
use App\UjianRemedial;
use App\Kelas;
use App\Jurusan;
use App\Nilai;
use App\BankSoal;
use App\Soal;

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

// Settings
Breadcrumbs::register('settings', function ($breadcrumbs) {
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Setting', route('settings'));
});

// Login
Breadcrumbs::register('login', function ($breadcrumbs) {
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Login', route('login'));
});

// Home > Guru
Breadcrumbs::register('guru', function ($breadcrumbs) {
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Guru', route('guru'));
});

// Home > Guru > Create
Breadcrumbs::register('daftar-guru', function ($breadcrumbs) {
	$breadcrumbs->parent('guru');
    $breadcrumbs->push('Create', route('daftar-guru'));
});

// Home > Guru > Show
Breadcrumbs::register('guru.show', function ($breadcrumbs, $id) {
	$guru = Guru::findOrFail(base64_decode($id));
	$breadcrumbs->parent('guru');
    $breadcrumbs->push($guru->nama, route('guru.show', $guru));
});

// Home > Guru > Edit
Breadcrumbs::register('guru.edit', function ($breadcrumbs, $id) {
	$guru = Guru::findOrFail(base64_decode($id));

	// dd(base64_encode($guru->id_guru));
	$breadcrumbs->parent('guru');
	// $breadcrumbs->parent('guru.show', base64_encode($guru->id_guru));
    $breadcrumbs->push($guru->nama, route('guru.show', base64_encode($guru->id_guru)));
    $breadcrumbs->push('Edit', route('guru.edit', $guru));
});

// Home > Guru > Import
Breadcrumbs::register('guru.import', function ($breadcrumbs) {
	// $guru = Guru::findOrFail(base64_decode($id));
	$breadcrumbs->parent('guru');
    $breadcrumbs->push('Import', route('guru.import'));
});

// Home > Bidang
Breadcrumbs::register('bidang', function($breadcrumbs) {
	$breadcrumbs->parent('home');
	$breadcrumbs->push('Bidang Keahlian', route('bidang'));
});

// Home > Bidang > Create
Breadcrumbs::register('bidang.create', function($breadcrumbs) {
	$breadcrumbs->parent('bidang');
	$breadcrumbs->push('Create', route('bidang.create'));
});

// Home > Bidang > Edit
Breadcrumbs::register('bidang.edit', function($breadcrumbs, $id) {
	$bidang = DaftarBidangKeahlian::findOrFail(base64_decode($id));
	$breadcrumbs->parent('bidang');
	$breadcrumbs->push($bidang->bidang_keahlian);
	$breadcrumbs->push('Edit', route('bidang.edit', $bidang));
});

// Home > Mapel
Breadcrumbs::register('mapel', function($breadcrumbs) {
	$breadcrumbs->parent('home');
	$breadcrumbs->push('Mata Pelajaran', route('mapel'));
});

// Home > Mapel > Create
Breadcrumbs::register('mapel.create', function($breadcrumbs) {
	$breadcrumbs->parent('mapel');
	$breadcrumbs->push('Create', route('mapel.create'));
});

// Home > Mapel > Edit
Breadcrumbs::register('mapel.edit', function($breadcrumbs, $id) {
	$mapel = Mapel::findOrFail(base64_decode($id));
	$breadcrumbs->parent('mapel');
	$breadcrumbs->push($mapel->nama_mapel);
	$breadcrumbs->push('Edit', route('mapel.edit', $mapel));
});

// Home > Siswa
Breadcrumbs::register('siswa', function($breadcrumbs) {
	$breadcrumbs->parent('home');
	$breadcrumbs->push('Siswa', route('siswa'));
});

// Home > Siswa > Create
Breadcrumbs::register('siswa.create', function($breadcrumbs) {
	$breadcrumbs->parent('siswa');
	$breadcrumbs->push('Create', route('siswa.create'));
});

// Home > Siswa > Show
Breadcrumbs::register('siswa.show', function($breadcrumbs, $id) {
	$siswa = Siswa::findOrFail(base64_decode($id));
	$breadcrumbs->parent('siswa');
	$breadcrumbs->push($siswa->nama, route('siswa.show', $siswa));
});

// Home > Siswa > Edit
Breadcrumbs::register('siswa.edit', function($breadcrumbs, $id) {
	$siswa = Siswa::findOrFail(base64_decode($id));
	$breadcrumbs->parent('siswa');
	$breadcrumbs->push($siswa->nama, route('siswa.show', base64_encode($siswa->id_siswa)));
	$breadcrumbs->push('Edit', route('siswa.edit', $siswa));
});

// Home > Siswa > Import
Breadcrumbs::register('siswa.import', function($breadcrumbs) {
	$breadcrumbs->parent('siswa');
	$breadcrumbs->push('Import', route('siswa.import'));
});

// Home > Siswa > Kenaikan
Breadcrumbs::register('siswa.naik-kelas', function($breadcrumbs) {
	$breadcrumbs->parent('siswa');
	$breadcrumbs->push('Kenaikan Kelas', route('siswa.naik-kelas'));
});

// Home > Ujian
Breadcrumbs::register('ujian', function($breadcrumbs) {
	$breadcrumbs->parent('home');
	$breadcrumbs->push('Ujian', route('ujian'));
});

// Home > Ujian > Search
Breadcrumbs::register('ujian.search', function($breadcrumbs) {
	$breadcrumbs->parent('ujian');
	$breadcrumbs->push('Search', route('ujian.search'));
});

// Home > Ujian > Create
Breadcrumbs::register('ujian.create', function($breadcrumbs) {
	$breadcrumbs->parent('ujian');
	$breadcrumbs->push('Create', route('ujian.create'));
});

// Home > Ujian > Edit
Breadcrumbs::register('ujian.edit', function($breadcrumbs, $id) {
	$ujian = Ujian::findOrFail(base64_decode($id));
	$breadcrumbs->parent('ujian');
	$breadcrumbs->push($ujian->judul_ujian);
	$breadcrumbs->push('Edit', route('ujian.edit', $ujian));
});

// Home > Ujian > Tambah Soal dari Bank
Breadcrumbs::register('tambah-soal-bank', function($breadcrumbs, $id) {
	$ujian = Ujian::findOrFail($id);
	$breadcrumbs->parent('ujian');
	$breadcrumbs->push($ujian->judul_ujian, route('ujian.edit', base64_encode($ujian->id_ujian)));
	$breadcrumbs->push('Tambah Soal dari Bank', route('tambah-soal-bank', $ujian));
});

// Home > Ujian > Tambah Soal
Breadcrumbs::register('soal.create', function($breadcrumbs, $id) {
	$ujian = Ujian::findOrFail(base64_decode($id));
	$breadcrumbs->parent('ujian');
	$breadcrumbs->push($ujian->judul_ujian, route('ujian.edit', base64_encode($ujian->id_ujian)));
	$breadcrumbs->push('Tambah Soal', route('soal.create', $ujian));
});

Breadcrumbs::register('soal.edit', function($breadcrumbs, $id) {
	$soal = Soal::findOrFail(base64_decode($id));
	// $ujian = Ujian::findOrFail(base64_decode($id));
	$breadcrumbs->parent('ujian');
	$breadcrumbs->push($soal->ujian->judul_ujian, route('ujian.edit', base64_encode($soal->id_ujian)));
	$breadcrumbs->push('Edit Soal', route('soal.edit', $soal));
});

// Home > Kelas
Breadcrumbs::register('kelas', function($breadcrumbs) {
	$breadcrumbs->parent('home');
	$breadcrumbs->push('Kelas', route('kelas'));
});

// Home > Kelas > Create
Breadcrumbs::register('kelas.create', function($breadcrumbs) {
	$breadcrumbs->parent('kelas');
	$breadcrumbs->push('Create', route('kelas.create'));
});

// Home > Kelas > Edit
Breadcrumbs::register('kelas.edit', function($breadcrumbs, $id) {
	$kelas = Kelas::findOrFail(base64_decode($id));
	$breadcrumbs->parent('kelas');
	$breadcrumbs->push($kelas->nama_kelas);
	$breadcrumbs->push('Edit', route('kelas.edit', $kelas));
});

// Home > Jurusan
Breadcrumbs::register('jurusan', function($breadcrumbs) {
	$breadcrumbs->parent('home');
	$breadcrumbs->push('Jurusan', route('jurusan'));
});

// Home > Jurusan > Create
Breadcrumbs::register('jurusan.create', function($breadcrumbs) {
	$breadcrumbs->parent('jurusan');
	$breadcrumbs->push('Create', route('jurusan.create'));
});

// Home > Jurusan > Edit
Breadcrumbs::register('jurusan.edit', function($breadcrumbs, $id) {
	$jurusan = Jurusan::findOrFail(base64_decode($id));
	$breadcrumbs->parent('jurusan');
	$breadcrumbs->push($jurusan->nama_jurusan);
	$breadcrumbs->push('Edit', route('jurusan.edit', $jurusan));
});

// Home > [Ujian] > Kerjakan
Breadcrumbs::register('soal.kerjakan', function($breadcrumbs, $id) {
	$ujian = Ujian::findOrFail(base64_decode($id));
	$breadcrumbs->parent('home');
	$breadcrumbs->push($ujian->judul_ujian);
	$breadcrumbs->push('Kerjakan', route('soal.kerjakan', $ujian));
});

// Home > Nilai > Show
Breadcrumbs::register('nilai', function($breadcrumbs, $id) {
	$ujian = Ujian::findOrFail(base64_decode($id));
	// $breadcrumbs->parent('home');
	$breadcrumbs->parent('ujian', $ujian);
	$breadcrumbs->push($ujian->judul_ujian);
	$breadcrumbs->push('Daftar Nilai', route('nilai', $ujian));
});

// Home > Bank Soal
Breadcrumbs::register('bank', function($breadcrumbs) {
	$breadcrumbs->parent('home');
	$breadcrumbs->push('Bank Soal', route('bank'));
});

// Home > Bank Soal > Create
Breadcrumbs::register('bank.create', function($breadcrumbs) {
	$breadcrumbs->parent('bank');
	$breadcrumbs->push('Create', route('bank.create'));
});

// Home > Bank Soal > Edit
Breadcrumbs::register('bank.edit', function($breadcrumbs, $id) {
	$bank = BankSoal::findOrFail(base64_decode($id));
	$breadcrumbs->parent('bank');
	$breadcrumbs->push('Edit', route('bank.edit', $bank));
});

// Home > Ujian > Search
Breadcrumbs::register('siswa.search', function($breadcrumbs) {
	$breadcrumbs->parent('home');
	$breadcrumbs->push('Search', route('siswa.search'));
});

// Home > Remed > Create
Breadcrumbs::register('remed.create', function($breadcrumbs, $id) {
	$ujian = Ujian::findOrFail(base64_decode($id));
	$breadcrumbs->parent('ujian', $ujian->judul_ujian);
	$breadcrumbs->push('Remedial');
	$breadcrumbs->push('Create', route('remed.create', $ujian));
});

// Home > Remed > Edit
Breadcrumbs::register('remed.edit', function($breadcrumbs, $id) {
	$ujian = UjianRemedial::findOrFail(base64_decode($id));
	$breadcrumbs->parent('ujian');
	$breadcrumbs->push($ujian->ujian->judul_ujian);
	$breadcrumbs->push('Remedial ke '.$ujian->remed_ke);
	$breadcrumbs->push('Edit', route('remed.edit', (base64_encode($ujian->id_ujian))));
});

// Home > Remed > Edit > tambah bank soal
Breadcrumbs::register('tambah-soal-bank-remed', function($breadcrumbs, $id) {
	$remed = UjianRemedial::findOrFail($id);
	$breadcrumbs->parent('ujian');
	$breadcrumbs->push($remed->ujian->judul_ujian, route('remed.edit', base64_encode($remed->id_ujian_remedial)));
	$breadcrumbs->push('Remedial ke '.$remed->remed_ke);
	$breadcrumbs->push('Tambah Soal dari Bank', route('tambah-soal-bank-remed', $remed));
});

// Home > Remed > Edit > Tambah Soal
Breadcrumbs::register('soal-remed.create', function($breadcrumbs, $id) {
	$ujian = UjianRemedial::findOrFail(base64_decode($id));
	$breadcrumbs->parent('ujian');
	$breadcrumbs->push($ujian->ujian->judul_ujian, route('remed.edit', base64_encode($ujian->id_ujian_remedial)));
	$breadcrumbs->push('Remedial ke '.$ujian->remed_ke);
	$breadcrumbs->push('Tambah Soal', route('soal-remed.create', $ujian));
});

// Home > [Remed] > Kerjakan
Breadcrumbs::register('remed.kerjakan', function($breadcrumbs, $id) {
	$ujian = UjianRemedial::findOrFail(base64_decode($id));
	$breadcrumbs->parent('home');
	$breadcrumbs->push($ujian->ujian->judul_ujian);
	$breadcrumbs->push('Remedial ke '.$ujian->remed_ke);
	$breadcrumbs->push('Kerjakan', route('remed.kerjakan', $ujian));
});