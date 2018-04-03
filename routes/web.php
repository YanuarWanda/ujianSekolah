<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	// return session()->all();
	// return view('home');
	return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Custom - Registrasi Siswa
Route::get('daftar-siswa', 'CustomAuthController@studentRegisterForm')->name('register');
Route::post('daftar-siswa', 'CustomAuthController@registerStudent');

// Custom - Login, Logout
Route::get('login', 'CustomAuthController@loginForm')->name('login');
Route::post('login', 'CustomAuthController@login');

// Logout tidak disimpan di CustomAuthController, karena tidak berpengaruh
Route::post('logout', function (){
	// Log
    $user = array(
        'hak_akses' => Auth::user()->hak_akses,
        'username' => Auth::user()->username,
    );
    \Log::info('Logged Out', $user);

	Auth::logout();
	return redirect('/');
})->name('logout');


// CRUD Guru
Route::get('kelola-guru', 'GuruController@index')->name('guru');
Route::get('daftar-guru', 'GuruController@create')->name('daftar-guru');
Route::post('daftar-guru', 'GuruController@store');
Route::get('/kelola-guru/show/{id}', 'GuruController@show')->name('guru.show');
Route::get('/kelola-guru/edit/{id}', 'GuruController@edit')->name('guru.edit');
Route::post('/kelola-guru/update/{id}', 'GuruController@update');
Route::post('/kelola-guru/updatePassword/{id}', 'GuruController@updatePassword');
Route::get('/kelola-guru/delete/{id}', 'GuruController@destroy');
Route::get('/kelola-guru/import', 'GuruController@importView')->name('guru.import');
Route::post('/kelola-guru/import', 'GuruController@importToDatabase');
Route::get('/kelola-guru/export', 'GuruController@exportToExcel')->name('export-guru');



// CRUD Siswa
Route::get('kelola-siswa', 'SiswaController@index')->name('siswa');
Route::name('siswa.')->group(function() {
	Route::get('/kelola-siswa/create', 'SiswaController@create')->name('create');
	Route::post('/kelola-siswa/create', 'SiswaController@store');
	Route::get('/kelola-siswa/show/{id}', 'SiswaController@show')->name('show');
	Route::get('/kelola-siswa/edit/{id}', 'SiswaController@edit')->name('edit');
	Route::post('/kelola-siswa/update/{id}', 'SiswaController@update');
	Route::post('/kelola-siswa/updateAkun/{id}', 'SiswaController@updateAkun');
	Route::get('/kelola-siswa/delete/{id}', 'SiswaController@destroy');

	// Import Siswa
	Route::get('/kelola-siswa/import', 'SiswaController@importView')->name('import');
	Route::post('/kelola-siswa/import', 'SiswaController@importToDatabase');

	// Export Siswa
	// Route::get('/kelola-siswa/export', 'SiswaController@exportView');
	Route::get('/kelola-siswa/export', 'SiswaController@exportToExcel')->name('export');

	// Siswa naik kelas
	Route::get('/kelola-siswa/naik-kelas', 'SiswaController@naikKelasView')->name('naik-kelas');
	Route::post('/kelola-siswa/naik-kelas', 'SiswaController@naikKelas');
});

// CRUD ujian
Route::get('kelola-ujian', 'UjianController@index')->name('ujian');
Route::name('ujian.')->group(function() {
	Route::get('/kelola-ujian/create', 'UjianController@create')->name('create');
	Route::post('/kelola-ujian/create', 'UjianController@store');
	Route::get('/kelola-ujian/edit/{id}', 'UjianController@edit')->name('edit');
	Route::post('/kelola-ujian/update/{id}', 'UjianController@update');
	Route::get('/kelola-ujian/delete/{id}', 'UjianController@destroy');
});

// Tambah soal dari bank soal
Route::get('/kelola-ujian/edit/{id}/tambah-soal-bank', 'UjianController@tambahSoalDariBankView')->name('tambah-soal-bank');
Route::post('/kelola-ujian/edit/{id}/tambah-soal-bank', 'SoalController@tambahSoalDariBank')->name('tambah-soal-bank');




// CRUD Ujian Remedial
Route::get('/kelola-remed/create/{id}', 'RemedController@create');
Route::post('/kelola-remed/create/{id}', 'RemedController@store');
Route::get('/kelola-remed/edit/{id}', 'RemedController@edit');
Route::post('/kelola-remed/update/{id}', 'RemedController@update');
Route::get('/kelola-remed/delete/{id}', 'RemedController@destroy');

// Tambah soal dari bank soal - REMED
Route::get('/kelola-remed/edit/{id}/tambah-soal-bank', 'UjianController@tambahSoalDariBankViewRemed')->name('tambah-soal-bank-remed');
Route::post('/kelola-remed/edit/{id}/tambah-soal-bank', 'SoalRemedController@tambahSoalDariBank')->name('tambah-soal-bank-remed');

// Export Nilai per Ujian
Route::get('/daftar-nilai/export/{id}', 'SoalController@exportToExcel');

// Post Ujian
Route::post('/kelola-ujian/POST/{id}', 'UjianController@postUjian');
Route::get('/kelola-ujian/DRAFT/{id}', 'UjianController@unpostUjian');

// Post Remed
Route::post('/kelola-remed/POST/{id}', 'UjianController@postRemed');
Route::get('/kelola-remed/DRAFT/{id}', 'UjianController@unpostRemed');

// CRUD Soal
Route::get('/kelola-soal/create/{id}', 'SoalController@create');
Route::post('/kelola-soal/create/{id}', 'SoalController@store');
Route::get('/kelola-soal/edit/{id}', 'SoalController@edit');
Route::post('/kelola-soal/update/{id}', 'SoalController@update');
Route::get('/kelola-soal/delete/{id}', 'SoalController@delete');

// CRUD Soal Remed
Route::get('/kelola-soal-remed/create/{id}', 'SoalRemedController@create');
Route::post('/kelola-soal-remed/create/{id}', 'SoalRemedController@store');
Route::get('/kelola-soal-remed/edit/{id}', 'SoalRemedController@edit');
Route::post('/kelola-soal-remed/update/{id}', 'SoalRemedController@update');
Route::get('/kelola-soal-remed/delete/{id}', 'SoalRemedController@delete');

// CRUD Jurusan
Route::get('/kelola-jurusan', 'JurusanController@index')->name('jurusan');
Route::name('jurusan.')->group(function() {
	Route::get('/kelola-jurusan/create', 'JurusanController@create')->name('create');
	Route::post('/kelola-jurusan/create', 'JurusanController@store');
	Route::get('/kelola-jurusan/edit/{id}', 'JurusanController@edit')->name('edit');
	Route::post('/kelola-jurusan/update/{id}', 'JurusanController@update');
	Route::get('/kelola-jurusan/delete/{id}', 'JurusanController@destroy');
});

// CRUD Kelas
Route::get('/kelola-kelas', 'KelasController@index')->name('kelas');
Route::name('kelas.')->group(function() {
	Route::get('/kelola-kelas/create', 'KelasController@create')->name('create');
	Route::post('/kelola-kelas/create', 'KelasController@store');
	Route::get('/kelola-kelas/edit/{id}', 'KelasController@edit')->name('edit');
	Route::post('/kelola-kelas/update/{id}', 'KelasController@update');
	Route::get('/kelola-kelas/delete/{id}', 'KelasController@destroy');
});

// CRUD Bidang Keahlian
Route::get('/kelola-bidang', 'DaftarBidangKeahlianController@index')->name('bidang');
Route::name('bidang.')->group(function () {
	Route::get('/kelola-bidang/create', 'DaftarBidangKeahlianController@create')->name('create');
	Route::post('/kelola-bidang/create', 'DaftarBidangKeahlianController@store');
	Route::get('/kelola-bidang/edit/{id}', 'DaftarBidangKeahlianController@edit')->name('edit');
	Route::post('/kelola-bidang/update/{id}', 'DaftarBidangKeahlianController@update');
	Route::get('/kelola-bidang/delete/{id}', 'DaftarBidangKeahlianController@destroy');
});

// CRUD Mapel
Route::get('/kelola-mapel', 'MapelController@index')->name('mapel');
Route::name('mapel.')->group(function() {
	Route::get('/kelola-mapel/create', 'MapelController@create')->name('create');
	Route::post('/kelola-mapel/create', 'MapelController@store');
	Route::get('/kelola-mapel/edit/{id}', 'MapelController@edit')->name('edit');
	Route::post('/kelola-mapel/update/{id}', 'MapelController@update');
	Route::get('/kelola-mapel/delete/{id}', 'MapelController@destroy');
});

// Settings user
Route::get('/settings', 'HomeController@settings')->name('settings');
Route::post('/ubahPassword/{id}', 'HomeController@ubahPassword')->name('ubahPassword');

// Setting - Data User
Route::post('/edit/s/{id}', 'SiswaController@storeDataSiswa')->name('edit-siswa');
Route::post('/edit/g/{id}', 'GuruController@storeDataGuru')->name('edit-guru');

// Dashboard Siswa
Route::get('/soal/{id}', 'UjianController@kerjakanSoal')->name('soal.kerjakan');
Route::get('/remed/{id}', 'UjianController@kerjakanRemed')->name('remed.kerjakan');
Route::post('/soal/submit/{id}', 'UjianController@submitSoal');
Route::post('/remed/submit/{id}', 'UjianController@submitRemed');
Route::get('/daftar-nilai/{id}', 'SoalController@daftarNilai')->name('nilai');

// Chart di dashboard admin
Route::get('/data-nilai', 'HomeController@chartData')->name('data-nilai');
Route::get('/pie-chart', 'HomeController@pieChart')->name('pie-chart');
Route::get('/chart-guru', 'HomeController@chartGuru')->name('chart-guru');
