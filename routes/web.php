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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Custom - Registrasi Siswa
Route::get('daftar-siswa', 'CustomAuthController@studentRegisterForm')->name('register');
Route::post('daftar-siswa', 'CustomAuthController@registerStudent');

// Custom - Login
Route::get('login', 'CustomAuthController@loginForm')->name('login');
Route::post('login', 'CustomAuthController@login');


// CRUD Guru
Route::get('kelola-guru', 'GuruController@index');
Route::get('daftar-guru', 'GuruController@create')->name('daftar-guru');
Route::post('daftar-guru', 'GuruController@store');

Route::get('/kelola-guru/show/{id}', 'GuruController@show');
Route::get('/kelola-guru/edit/{id}', 'GuruController@edit');
Route::post('/kelola-guru/update/{id}', 'GuruController@update');
Route::get('/kelola-guru/delete/{id}', 'GuruController@destroy');

// CRUD Siswa
Route::get('kelola-siswa', 'SiswaController@index');

Route::get('/kelola-siswa/show/{id}', 'SiswaController@show');
Route::get('/kelola-siswa/edit/{id}', 'SiswaController@edit');
Route::post('/kelola-siswa/update/{id}', 'SiswaController@update');
Route::get('/kelola-siswa/delete/{id}', 'SiswaController@destroy');