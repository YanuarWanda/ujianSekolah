<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'ujian';
    protected $primaryKey = 'id_ujian';

    public $timestamps = false;
    protected $fillable = [
        'id_ujian', 'id_mapel', 'nip', 'judul_ujian', 'waktu_pengerjaan', 'tanggal_post', 'tanggal_kadaluarsa', 'status'
    ];

    public function mapel() {
        return $this->belongsTo('App\Mapel', 'id_mapel');
    }

    public function guru() {
        return $this->belongsTo('App\Guru', 'nip');
    }
}
