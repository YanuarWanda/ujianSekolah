<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UjianRemedial extends Model
{
    protected $table = 'ujian_remedial';
    protected $primaryKey = 'id_ujian_remedial';

    public $timestamps = false;
    protected $fillable = [
        'id_ujian_remedial', 'id_ujian', 'waktu_pengerjaan', 'tanggal_pembuatan', 'catatan', 'tanggal_kadaluarsa', 'remed_ke',
    ];

    public function ujian(){
        return $this->belongsTo('App\Ujian', 'id_ujian');
    }

    public function soalRemed() {
        return $this->hasMany('App\SoalRemed', 'id_ujian_remedial');
    }

    public function nilaiRemedial() {
        return $this->hasMany('App\NilaiRemedial', 'id_ujian_remedial');
    }
}
