<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    // Mendefinisikan nama table
    protected $table = 'guru';

    // Mendefinisikan primary key
    protected $primaryKey = "nip";

    // Memberitahu laravel bahwa PK bukan auto-increment
    public $incrementing = false;

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'id');
    }
}
