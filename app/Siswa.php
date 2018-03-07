<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $incrementing = false;

    protected $fillable = [
        'id_siswa', 'nis', 'id_users', 'id_kelas', 'nama', 'alamat', 'jenis_kelamin', 'foto', 'tahun_ajaran'
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'id_users');
    }

    public function kelas() {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }
}
