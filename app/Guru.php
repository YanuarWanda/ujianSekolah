<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    // Mendefinisikan nama table
    protected $table = 'guru';

    // Mendefinisikan primary key
    protected $primaryKey = "nip";

    protected $fillable = [
        'id_guru', 'nip', 'id_users', 'nama', 'alamat', 'jenis_kelamin', 'foto',
    ];

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'id_users');
    }

    public function bidangKeahlian() {
        return $this->hasMany('App\BidangKeahlian', 'id_guru');
    }
}
