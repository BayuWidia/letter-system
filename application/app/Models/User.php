<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table = 'users';
    protected $fillable = [
        'id_pegawai', 'name', 'email', 'password', 'level', 'url_foto', 'activated'
    ];


    public function pegawai()
    {
      return $this->belongs_to('App\Models\Pegawai');
    }
}
