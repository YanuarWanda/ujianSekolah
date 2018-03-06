<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'ujian';
    protected $primaryKey = 'id_ujian';

    public $timestamps = false;
    protected $fillable = [
        'id_ujian', 'id_mapel', 'id_guru', 'judul_ujian', 'kkm', 'waktu_pengerjaan', 'tanggal_post', 'tanggal_kadaluarsa', 'status', 
        'catatan',
    ];

    public function mapel() {
        return $this->belongsTo('App\Mapel', 'id_mapel');
    }

    public function guru() {
        return $this->belongsTo('App\Guru', 'id_guru');
    }

    public function soal() {
        return $this->hasMany('App\Soal', 'id_ujian');
    }

    public function nilai() {
        return $this->hasMany('App\Nilai', 'id_ujian');
    }
}
