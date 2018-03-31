<?php

use App\Guru;
use App\DaftarBidangKeahlian;
use App\Mapel;
use App\Siswa;
use App\Ujian;
use App\Kelas;
use App\Jurusan;

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
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
	$breadcrumbs->push($ujian->judul_ujian, route('ujian.edit', $ujian->id_ujian));
	$breadcrumbs->push('Tambah Soal dari Bank', route('tambah-soal-bank', $ujian));
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