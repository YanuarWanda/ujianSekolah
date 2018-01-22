<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;

    protected $fillable = [
        'nis', 'id', 'id_kelas', 'nama', 'alamat', 'jenis_kelamin', 'foto',
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'id');
    }

    public function kelas() {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }
}
