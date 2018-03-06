<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UjianRemedial extends Model
{
    protected $table = 'ujian_remedial';
    protected $primaryKey = 'id_ujian_remedial';

    public $timestamps = false;
    protected $fillable = [
        'id_ujian_remedial', 'id_ujian', 'waktu_pengerjaan', 'tanggal_pembuatan', 'catatan',
    ];

    public function soalRemed() {
        return $this->hasMany('App\Soal', 'id_ujian_remedial');
    }

    public function nilaiRemedial() {
        return $this->hasMany('App\Nilai', 'id_ujian_remedial');
    }
}
