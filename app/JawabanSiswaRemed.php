<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JawabanSiswaRemed extends Model
{
    protected $table = 'jawaban_siswa_remed';
    protected $primaryKey = 'id_jawaban_remedial';

    protected $fillable = [
        'id_soal_remedial', 'id_siswa', 'jawaban_siswa',
    ];

    public $timestamps = false;

    public function soalRemed() {
        return $this->belongsTo('App\SoalRemed', 'id_soal_remedial');
    }

    public function siswa() {
        return $this->belongsTo('App\Siswa', 'id_siswa');
    }
}
