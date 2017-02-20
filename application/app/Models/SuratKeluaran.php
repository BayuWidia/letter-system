<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluaran extends Model
{
  protected $table = 'surat_keluaran';

  protected $fillable = [
    'id_pegawai', 'id_user', 'sifat_surat', 'tanggal_surat', 'nomor_surat', 'perihal', 'tanggal_terima', 'disposisi_staff', 'disposisi_bidang', 'disposisi_sekdis', 'catatan', 'url_document', 'flag_approved'
  ];

  public function pegawai()
  {
    return $this->belongs_to('App\Models\Pegawai', 'id_pegawai');
  }

  public function user()
  {
    return $this->belongs_to('App\Models\User', 'id_user');
  }

}
