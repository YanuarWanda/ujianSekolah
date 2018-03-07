<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $primaryKey = 'id_mapel';

    public $timestamps = false;

    public function daftar_bidang_keahlian() {
    	return $this->belongsTo('App\DaftarBidangKeahlian', 'id_daftar_bidang');
    }

    public function ujian() {
    	return $this->hasMany('App\Ujian', 'id_mapel');
    }
}
