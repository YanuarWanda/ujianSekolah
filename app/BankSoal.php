<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class BankSoal extends Model
{
    protected $table = 'bank_soal';
    protected $primaryKey = 'id_bank_soal';

    public $timestamps = false;

    protected $fillable = [
        'id_bank_soal', 'id_daftar_bidang', 'tipe', 'isi_soal', 'pilihan', 'jawaban',
    ];

    public function daftarBidangKeahlian() {
    	return $this->belongsTo('App\DaftarBidangKeahlian', 'id_daftar_bidang');
    }

    public function soal() {
    	return $this->hasMany('App\Soal', 'id_bank_soal');
    }
}