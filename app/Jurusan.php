<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'id_jurusan';

    public $timestamps = false;

    public function kelas() {
    	return $this->hasMany('App\Kelas', 'id_jurusan');
    }
}
