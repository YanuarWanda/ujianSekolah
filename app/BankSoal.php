<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankSoal extends Model
{
    protected $table = 'bank_soal';
    protected $primaryKey = 'id_bank_soal';

    public $timestamps = false;

    protected $fillable = [
        'tipe', 'isi_soal', 'pilihan', 'jawaban', 'point'
    ];
}
