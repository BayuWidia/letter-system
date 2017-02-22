<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use DB;
use App\Http\Requests;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\Skpd;

class PegawaiController extends Controller
{
  public function lihat()
  {
    $getpegawai = Pegawai::select('pegawai.*', 'jabatan.nama_jabatan', 'skpd.nama_skpd')
        ->leftjoin('jabatan', 'pegawai.id_jabatan', '=', 'jabatan.id')
        ->leftjoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
        ->orderby('pegawai.created_at', 'desc')
        ->get();
      // dd($getpegawai);
    return view('backend/pages/lihatpegawai')->with('getpegawai', $getpegawai);
  }

  public function tambah()
  {
     $getjabatan = Jabatan::where('flag_jabatan', 1)->get();
     $getskpd = Skpd::where('flag_skpd', 1)->get();

    return view('backend/pages/tambahpegawai')
        ->with('getjabatan', $getjabatan)
        ->with('getskpd', $getskpd);
  }

  public function store(Request $request)
  {
    $file = $request->file('url_foto');
    if ($file!=null) {
      $photo_name = time(). '.' . $file->getClientOriginalExtension();

      $photo1 = explode('.', $photo_name);

      Image::make($file)->fit(472,270)->save('images/'. $photo_name);

        $set = new Pegawai;
        $set->id_skpd = $request->id_skpd;
        $set->id_jabatan = $request->id_jabatan;

        $set->nama_pegawai = trim($request->nama_pegawai);
        $set->nip = trim($request->nip);
        $set->url_foto = $photo_name;
        $set->flag_pegawai = 1;
        $set->actor = Auth::user()->id;
        $set->save();
    } else {
        $set = new Pegawai;
        $set->id_skpd = $request->id_skpd;
        $set->id_jabatan = $request->id_jabatan;

        $set->nama_pegawai = trim($request->nama_pegawai);
        $set->nip = trim($request->nip);
        $set->flag_pegawai = 1;
        $set->actor = Auth::user()->id;
        $set->save();
    }


    return redirect()->route('pegawai.lihat')->with('message', 'Berhasil menambahkan pegawai baru.');
  }

  public function edit($id)
  {
    $editpegawai = Pegawai::find($id);

    $getjabatan = Jabatan::where('flag_jabatan', 1)->get();
    $getskpd = Skpd::where('flag_skpd', 1)->get();

    return view('backend/pages/tambahpegawai')
      ->with('editpegawai', $editpegawai)
      ->with('getjabatan', $getjabatan)
      ->with('getskpd', $getskpd);
  }

  public function update(Request $request)
  {
    $file = $request->file('url_foto');
    if ($file!=null) {
      $photo_name = time(). '.' . $file->getClientOriginalExtension();

      $photo1 = explode('.', $photo_name);

      Image::make($file)->fit(472,270)->save('images/'. $photo_name);

        $set = Pegawai::find($request->id);
        $set->id_skpd = $request->id_skpd;
        $set->id_jabatan = $request->id_jabatan;

        $set->nama_pegawai = trim($request->nama_pegawai);
        $set->nip = trim($request->nip);
        $set->url_foto = $photo_name;
        $set->flag_pegawai = 1;
        $set->save();
    } else {
        $set = Pegawai::find($request->id);
        $set->id_skpd = $request->id_skpd;
        $set->id_jabatan = $request->id_jabatan;

        $set->nama_pegawai = trim($request->nama_pegawai);
        $set->nip = trim($request->nip);
        $set->flag_pegawai = 1;
        $set->save();
    }

    return redirect()->route('pegawai.lihat')->with('message', 'Berhasil mengubah pegawai.');
  }



  public function delete($id)
  {
    $set = Pegawai::find($id);
    $set->flag_pegawai = 0;
    $set->save();

    return redirect()->route('pegawai.lihat')->with('message', 'Berhasil menghapus pegawai.');
  }

}
