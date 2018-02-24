<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidangKeahlian extends Model
{
    protected $table = 'bidang_keahlian';
    protected $primaryKey = 'id_bidang_keahlian';

    protected $fillable = [
        'id_bidang_keahlian', 'id_guru', 'id_daftar_bidang',
    ];

    public $timestamps = false;

    public function guru() {
        return $this->belongsTo('App\Guru', 'id_guru');
    }

    public function daftarBidangKeahlian() {
        return $this->belongsTo('App\DaftarBidangKeahlian', 'id_daftar_bidang');
    }
}
