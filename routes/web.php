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
Route::get('kelola-guru', 'GuruController@index');
Route::get('daftar-guru', 'GuruController@create')->name('daftar-guru');
Route::post('daftar-guru', 'GuruController@store');

Route::get('/kelola-guru/show/{id}', 'GuruController@show');
Route::get('/kelola-guru/edit/{id}', 'GuruController@edit');
Route::post('/kelola-guru/update/{id}', 'GuruController@update');
Route::post('/kelola-guru/updatePassword/{id}', 'GuruController@updatePassword');
Route::get('/kelola-guru/delete/{id}', 'GuruController@destroy');
Route::get('/kelola-guru/import', 'GuruController@importView');
Route::post('/kelola-guru/import', 'GuruController@importToDatabase');

// CRUD Siswa
Route::get('kelola-siswa', 'SiswaController@index');
Route::get('/kelola-siswa/create', 'SiswaController@create');
Route::post('/kelola-siswa/create', 'SiswaController@store');
Route::get('/kelola-siswa/show/{id}', 'SiswaController@show');
Route::get('/kelola-siswa/edit/{id}', 'SiswaController@edit');
Route::post('/kelola-siswa/update/{id}', 'SiswaController@update');
Route::post('/kelola-siswa/updateAkun/{id}', 'SiswaController@updateAkun');
Route::get('/kelola-siswa/delete/{id}', 'SiswaController@destroy');
Route::get('/kelola-siswa/import', 'SiswaController@importView');
Route::post('/kelola-siswa/import', 'SiswaController@importToDatabase');

// CRUD ujian
Route::get('kelola-ujian', 'UjianController@index');
Route::get('/kelola-ujian/create', 'UjianController@create');
Route::post('/kelola-ujian/create', 'UjianController@store');
Route::get('/kelola-ujian/edit/{id}', 'UjianController@edit');
Route::post('/kelola-ujian/update/{id}', 'UjianController@update');
Route::get('/kelola-ujian/delete/{id}', 'UjianController@destroy');

// Post Ujian
Route::post('/kelola-ujian/POST/{id}', 'UjianController@postUjian');
Route::get('/kelola-ujian/DRAFT/{id}', 'UjianController@unpostUjian');

// CRUD Soal
Route::get('/kelola-soal/create/{id}', 'SoalController@create');
Route::post('/kelola-soal/create/{id}', 'SoalController@store');
Route::get('/kelola-soal/edit/{id}', 'SoalController@edit');
Route::post('/kelola-soal/update/{id}', 'SoalController@update');
Route::get('/kelola-soal/delete/{id}', 'SoalController@delete');

// CRUD Jurusan
Route::get('/kelola-jurusan', 'JurusanController@index');
Route::get('/kelola-jurusan/create', 'JurusanController@create');
Route::post('/kelola-jurusan/create', 'JurusanController@store');
Route::get('/kelola-jurusan/edit/{id}', 'JurusanController@edit');
Route::post('/kelola-jurusan/update/{id}', 'JurusanController@update');
Route::get('/kelola-jurusan/delete/{id}', 'JurusanController@destroy');

// CRUD Kelas
Route::get('/kelola-kelas', 'KelasController@index');
Route::get('/kelola-kelas/create', 'KelasController@create');
Route::post('/kelola-kelas/create', 'KelasController@store');
Route::get('/kelola-kelas/edit/{id}', 'KelasController@edit');
Route::post('/kelola-kelas/update/{id}', 'KelasController@update');
Route::get('/kelola-kelas/delete/{id}', 'KelasController@destroy');

// Settings user
Route::get('/settings', 'HomeController@settings')->name('settings');
Route::post('/ubahPassword/{id}', 'HomeController@ubahPassword')->name('ubahPassword');

// Setting - Data User
Route::post('/edit/s/{id}', 'SiswaController@storeDataSiswa')->name('edit-siswa');
Route::post('/edit/g/{id}', 'GuruController@storeDataGuru')->name('edit-guru');

// Dashboard Siswa
Route::get('/soal/{id}', 'UjianController@kerjakanSoal');
Route::post('/soal/submit/{id}', 'UjianController@submitSoal');
