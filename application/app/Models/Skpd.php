<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skpd extends Model
{
  protected $table = 'skpd';

  protected $fillable = [
    'nama_skpd', 'keterangan_skpd', 'flag_skpd'
  ];

}
