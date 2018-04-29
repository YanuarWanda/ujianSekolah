<?php

Route::get('/', 'HomeController@index')->name('login');
Route::post('/registerSiswa', 'HomeController@registerSiswa');
Route::post('/login', 'HomeController@login');
Route::post('/logout', 'HomeController@logout');

Route::get('/beranda', 'BerandaController@index');

//Siswa
Route::get('/siswa/kerjakan/{id}', 'SiswaController@kerjakanSoal');
Route::get('/siswa/kerjakan-remed/{id}', 'SiswaController@kerjakanRemed');
Route::post('/siswa/ujian/submit/{id}', 'SiswaController@submitSoal');
Route::post('/siswa/remed/submit/{id}', 'SiswaController@submitRemed');
Route::get('/siswa/profil', 'SiswaController@profil');
Route::post('/siswa/profil', 'SiswaController@simpanProfil');

//Guru
Route::get('/guru/profil', 'GuruController@profil');
Route::post('/guru/profil', 'GuruController@simpanProfil');

Route::get('/guru/siswa/', 'GuruController@siswaIndex');
Route::get('/guru/siswa/profil/{id}', 'GuruController@profilSiswa');

Route::get('/guru/ujian/', 'GuruController@ujianIndex');
Route::get('/guru/ujian/add', 'GuruController@ujianCreate');
Route::post('/guru/ujian/add', 'GuruController@ujianStore');
Route::get('/guru/ujian/edit/{id}', 'GuruController@ujianEdit');
Route::post('/guru/ujian/edit/{id}', 'GuruController@ujianUpdate');
Route::get('/guru/ujian/delete/{id}', 'GuruController@ujianDelete');

Route::get('/guru/ujian/tambahSoalUjian/{id}', 'GuruController@tambahSoalUjian');
Route::post('/guru/ujian/tambahSoalUjian/{id}', 'GuruController@storeSoalUjian');
Route::get('/guru/ujian/editSoalUjian/{id}', 'GuruController@editSoalUjian');
Route::post('/guru/ujian/editSoalUjian/{id}', 'GuruController@updateSoalUjian');
Route::get('/guru/ujian/deleteSoalUjian/{id}', 'GuruController@deleteSoalUjian');
Route::get('/guru/ujian/tambahDariBankSoal/{id}', 'GuruController@tambahDariBankSoal');
Route::post('/guru/ujian/tambahDariBankSoal/{id}', 'GuruController@storeDariBankSoal');
Route::get('/guru/ujian/draft/{id}', 'GuruController@draft');
Route::post('/guru/ujian/post/{id}', 'GuruController@post');

Route::get('/guru/ujian/remed/add/{id}', 'GuruController@remedCreate');
Route::post('/guru/ujian/remed/add/{id}', 'GuruController@remedStore');
Route::get('/guru/ujian/remed/detail/{id}', 'GuruController@remedEdit');
Route::post('/guru/ujian/remed/detail/{id}', 'GuruController@remedUpdate');
Route::get('/guru/ujian/remed/delete/{id}', 'GuruController@remedDelete');

Route::get('/guru/ujian/remed/tambahSoalRemed/{id}', 'GuruController@tambahSoalRemed');
Route::post('/guru/ujian/remed/tambahSoalRemed/{id}', 'GuruController@storeSoalRemed');
Route::get('/guru/ujian/remed/editSoalRemed/{id}', 'GuruController@editSoalRemed');
Route::post('/guru/ujian/remed/editSoalRemed/{id}', 'GuruController@updateSoalRemed');
Route::get('/guru/ujian/remed/deleteSoalRemed/{id}', 'GuruController@deleteSoalRemed');
Route::get('/guru/ujian/remed/tambahDariBankSoal/{id}', 'GuruController@tambahRemedDariBankSoal');
Route::post('/guru/ujian/remed/tambahDariBankSoal/{id}', 'GuruController@storeRemedDariBankSoal');
Route::get('/guru/ujian/remed/draft/{id}', 'GuruController@draftRemed');
Route::post('/guru/ujian/remed/post/{id}', 'GuruController@postRemed');

Route::get('/guru/ujian/nilai/{id}', 'GuruController@daftarNilai');
Route::get('/guru/ujian/nilai/export/{id}', 'GuruController@exportNilai');

//Admin
Route::get('/settings', 'BerandaController@settings');
Route::post('/settings', 'BerandaController@gantiPasswordAdmin');

Route::get('/guru', 'GuruController@index');
Route::get('/guru/add', 'GuruController@create');
Route::post('/guru/add', 'GuruController@store');
Route::get('/guru/edit/{id}', 'GuruController@edit');
Route::post('/guru/updateDataDiri/{id}', 'GuruController@updateDataDiri');
Route::post('/guru/updateAkun/{id}', 'GuruController@updateAkun');
Route::get('/guru/delete/{id}', 'GuruController@destroy');
Route::get('/guru/import', 'GuruController@showImport');
Route::post('/guru/import', 'GuruController@import');
Route::get('/guru/export', 'GuruController@export');

Route::get('/siswa', 'SiswaController@index');
Route::get('/siswa/add', 'SiswaController@create');
Route::post('/siswa/add', 'SiswaController@store');
Route::get('/siswa/edit/{id}', 'SiswaController@edit');
Route::post('/siswa/updateDataDiri/{id}', 'SiswaController@updateDataDiri');
Route::post('/siswa/updateAkun/{id}', 'SiswaController@updateAkun');
Route::get('/siswa/delete/{id}', 'SiswaController@destroy');
Route::get('/siswa/import', 'SiswaController@showImport');
Route::post('/siswa/import', 'SiswaController@import');
Route::get('/siswa/export', 'SiswaController@export');

Route::get('/siswa/upgrade', 'SiswaController@naikKelas');
Route::post('/siswa/upgrade', 'SiswaController@storeNaikKelas');

Route::get('/ujian', 'UjianController@index');
Route::get('/ujian/add', 'UjianController@create');
Route::post('/ujian/add', 'UjianController@store');
Route::get('/ujian/edit/{id}', 'UjianController@edit');
Route::post('/ujian/edit/{id}', 'UjianController@update');
Route::get('/ujian/delete/{id}', 'UjianController@destroy');

Route::get('/ujian/tambahSoalUjian/{id}', 'UjianController@tambahSoalUjian');
Route::post('/ujian/tambahSoalUjian/{id}', 'UjianController@storeSoalUjian');
Route::get('/ujian/editSoalUjian/{id}', 'UjianController@editSoalUjian');
Route::post('/ujian/editSoalUjian/{id}', 'UjianController@updateSoalUjian');
Route::get('/ujian/deleteSoalUjian/{id}', 'UjianController@deleteSoalUjian');
Route::get('/ujian/tambahDariBankSoal/{id}', 'UjianController@tambahDariBankSoal');
Route::post('/ujian/tambahDariBankSoal/{id}', 'UjianController@storeDariBankSoal');
Route::get('/ujian/draft/{id}', 'UjianController@draft');
Route::post('/ujian/post/{id}', 'UjianController@post');

Route::get('ujian/remed/add/{id}', 'UjianController@remedCreate');
Route::post('ujian/remed/add/{id}', 'UjianController@remedStore');
Route::get('ujian/remed/detail/{id}', 'UjianController@remedEdit');
Route::post('ujian/remed/detail/{id}', 'UjianController@remedUpdate');
Route::get('ujian/remed/delete/{id}', 'UjianController@remedDelete');

Route::get('ujian/remed/tambahSoalRemed/{id}', 'UjianController@tambahSoalRemed');
Route::post('ujian/remed/tambahSoalRemed/{id}', 'UjianController@storeSoalRemed');
Route::get('ujian/remed/editSoalRemed/{id}', 'UjianController@editSoalRemed');
Route::post('ujian/remed/editSoalRemed/{id}', 'UjianController@updateSoalRemed');
Route::get('ujian/remed/deleteSoalRemed/{id}', 'UjianController@deleteSoalRemed');
Route::get('ujian/remed/tambahDariBankSoal/{id}', 'UjianController@tambahRemedDariBankSoal');
Route::post('ujian/remed/tambahDariBankSoal/{id}', 'UjianController@storeRemedDariBankSoal');
Route::get('ujian/remed/draft/{id}', 'UjianController@draftRemed');
Route::post('ujian/remed/post/{id}', 'UjianController@postRemed');

Route::get('/ujian/nilai/{id}', 'UjianController@daftarNilai');
Route::get('/ujian/nilai/export/{id}', 'UjianController@exportNilai');

Route::get('/bank_soal', 'BankSoalController@index');
Route::get('/bank_soal/add', 'BankSoalController@create');
Route::post('/bank_soal/add', 'BankSoalController@store');
Route::get('/bank_soal/edit/{id}', 'BankSoalController@edit');
Route::post('/bank_soal/edit/{id}', 'BankSoalController@update');
Route::get('/bank_soal/delete/{id}', 'BankSoalController@destroy');

Route::get('/kelas', 'KelasController@index');
Route::get('/kelas/add', 'KelasController@create');
Route::post('/kelas/add', 'KelasController@store');
Route::get('/kelas/edit/{id}', 'KelasController@edit');
Route::post('/kelas/edit/{id}', 'KelasController@update');
Route::get('/kelas/delete/{id}', 'KelasController@destroy');

Route::get('/mapel', 'MapelController@index');
Route::get('/mapel/add', 'MapelController@create');
Route::post('/mapel/add', 'MapelController@store');
Route::get('/mapel/edit/{id}', 'MapelController@edit');
Route::post('/mapel/edit/{id}', 'MapelController@update');
Route::get('/mapel/delete/{id}', 'MapelController@destroy');

Route::get('/jurusan', 'JurusanController@index');
Route::get('/jurusan/add', 'JurusanController@create');
Route::post('/jurusan/add', 'JurusanController@store');
Route::get('/jurusan/edit/{id}', 'JurusanController@edit');
Route::post('/jurusan/edit/{id}', 'JurusanController@update');
Route::get('/jurusan/delete/{id}', 'JurusanController@destroy');

Route::get('/bidang_keahlian', 'BidangKeahlianController@index');
Route::get('/bidang_keahlian/add', 'BidangKeahlianController@create');
Route::post('/bidang_keahlian/add', 'BidangKeahlianController@store');
Route::get('/bidang_keahlian/edit/{id}', 'BidangKeahlianController@edit');
Route::post('/bidang_keahlian/edit/{id}', 'BidangKeahlianController@update');
Route::get('/bidang_keahlian/delete/{id}', 'BidangKeahlianController@destroy');

