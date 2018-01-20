<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'ujian';
    protected $primaryKey = 'id_ujian';

    public $timestamps = false;

    public function mapel() {
        return $this->belongsTo('App\Mapel', 'id_mapel');
    }

    public function guru() {
        return $this->belongsTo('App\Guru', 'nip');
    }
}
