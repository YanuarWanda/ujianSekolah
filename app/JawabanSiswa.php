<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JawabanSiswa extends Model
{
    protected $table = 'jawaban_siswa';
    protected $primaryKey = 'id_jawaban';

    protected $fillable = [
        'id_soal', 'id_siswa', 'jawaban_siswa',
    ];

    public $timestamps = false;

    public function soal() {
        return $this->belongsTo('App\Soal', 'id_soal');
    }

    public function siswa() {
        return $this->belongsTo('App\Siswa', 'id_siswa');
    }
}
