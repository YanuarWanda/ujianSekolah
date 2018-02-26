<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasUjian extends Model
{
    protected $table = 'kelas_ujian';
    protected $primaryKey = 'id_kelas_ujian';

    public $timestamps = false;

    protected $fillable = [
    	'id_kelas_ujian', 'id_ujian', 'id_kelas',
    ];

    public function ujian() {
        return $this->belongsTo('App\Ujian', 'id_ujian');
    }

    public function kelas() {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }
}
