<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;

    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function kelas() {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }
}
