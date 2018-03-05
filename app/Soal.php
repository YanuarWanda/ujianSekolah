<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';
    protected $primaryKey = 'id_soal';

    public $timestamps = false;

    protected $fillable = [
        'id_ujian', 'id_bank_soal'
    ];

    public function ujian() {
        return $this->belongsTo('App\Ujian', 'id_ujian');
    }

    public function bankSoal() {
        return $this->belongsTo('App\BankSoal', 'id_bank_soal');
    }
}
