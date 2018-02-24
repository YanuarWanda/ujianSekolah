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
}
