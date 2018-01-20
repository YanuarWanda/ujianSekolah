<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'id_nilai';

    public $timestamps = false;

    public function ujian() {
        return $this->belongsTo('App\Ujian', 'id_ujian');
    }

    public function siswa() {
        return $this->belongsTo('App\Siswa', 'nis');
    }
}
