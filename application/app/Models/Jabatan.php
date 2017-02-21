<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
  protected $table = 'jabatan';

  protected $fillable = [
    'nama_jabatan', 'keterangan_jabatan', 'flag_jabatan', 'actor'
  ];

 
}
