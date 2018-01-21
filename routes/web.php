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
    // $user = new User;
    // $user->username = 'a';
    // $user->password = '123';
    // $user->remember_token = 'kipffpipo';
    // $user->hak_akses = 'siswa';
    
    // $siswa = new Siswa;
    // $siswa->nis = '98789797';
    
    // $siswa->id_kelas = 1;
    // $siswa->nama = 'fkldajkljasdlkfj';
    // $siswa->alamat = 'kal;sdfk;ldskf';
    // $siswa->jenis_kelamin = 'f';
    // $siswa->email = 'dfalsfm';
    // $siswa->jurusan = 'rpl';
    // $siswa->foto = 'nope.png';


    // if($user->save()) {
    //     $siswa->id_user = $user->id;
    //     $siswa->save();
    // }

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