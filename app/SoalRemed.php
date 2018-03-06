<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoalRemed extends Model
{
    protected $table = 'soal_remed';
    protected $primaryKey = 'id_soal_remedial';

    public $timestamps = false;

    protected $fillable = [
        'id_soal_remedial', 'id_ujian_remedial', 'id_bank_soal', 'point',
    ];

    public function ujianRemedial() {
        return $this->belongsTo('App\Ujian', 'id_ujian_remedial');
    }

    public function bankSoal() {
        return $this->belongsTo('App\BankSoal', 'id_bank_soal');
    }
}
