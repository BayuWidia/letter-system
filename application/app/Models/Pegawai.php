<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
  protected $table = 'pegawai';

  protected $fillable = [
    'id_skpd', 'id_jabatan', 'nama_pegawai', 'nip', 'url_foto', 'flag_pegawai', 'actor'
  ];

  public function skpd()
  {
    return $this->belongs_to('App\Models\Skpd', 'id_skpd');
  }

  public function jabatan()
  {
    return $this->belongs_to('App\Models\Jabatan', 'id_jabatan');
  }

}
