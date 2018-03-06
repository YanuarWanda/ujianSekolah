<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiRemedial extends Model
{
    protected $table = 'nilai_remedial';
    protected $primaryKey = 'id_nilai_remedial';

    protected $fillable = [
    	'id_ujian_remedial', 'jawaban_benar', 'jawaban_salah', 'nilai_remedial',
    ];

    public $timestamps = false;

    public function ujianRemedial() {
        return $this->belongsTo('App\UjianRemedial', 'id_ujian_remedial');
    }

    public function siswa() {
        return $this->belongsTo('App\Siswa', 'id_siswa');
    }
}
