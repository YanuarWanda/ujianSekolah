<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarBidangKeahlian extends Model
{
    protected $table = 'daftar_bidang_keahlian';
    protected $primaryKey = 'id_daftar_bidang';

    protected $fillable = [
        'id_daftar_bidang', 'bidang_keahlian',
    ];

    public $timestamps = false;

    public function bidangKeahlian() {
        return $this->hasMany('App\BidangKeahlian', 'id_daftar_bidang');
    }

    public function bankSoal() {
    	return $this->hasMany('App\BankSoal', 'id_daftar_bidang');
    }

    public function mapel() {
    	return $this->hasMany('App\Mapel', 'id_daftar_bidang');
    }
}
