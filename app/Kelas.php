<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';

    public $timestamps = false;

    public function jurusan() {
        return $this->belongsTo('App\Jurusan', 'id_jurusan');
    }

    public function siswa() {
    	return $this->hasMany('App\Siswa', 'id_kelas');
    }
}
