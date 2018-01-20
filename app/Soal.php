<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';
    protected $primaryKey = 'id_soal';

    public $timestamps = false;

    public function ujian() {
        return $this->belongsTo('App\Ujian', 'id_ujian');
    }
}
