<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use App\Models\Jabatan;
use App\Http\Requests;

class JabatanController extends Controller
{
  public function index()
  {
    $getjabatan = Jabatan::get();
    return view('backend/pages/kelolajabatan')->with('getjabatan', $getjabatan);
  }

  public function store(Request $request)
  {
    // dd($request);
      $set = new Jabatan;
      $set->actor = Auth::user()->id;
      $set->nama_jabatan = trim($request->nama_jabatan);
      $set->keterangan_jabatan = trim($request->keterangan_jabatan);
      $set->flag_jabatan = $request->flag_jabatan;
      $set->save();

    return redirect()->route('jabatan.index')->with('message', 'Berhasil memasukkan jabatan baru.');
  }

  public function bind($id)
  {
    $get = Jabatan::find($id);
    return $get;
  }

  public function edit(Request $request)
  {
      $set = Jabatan::find($request->id);
      $set->nama_jabatan = trim($request->nama_jabatan);
      $set->keterangan_jabatan = trim($request->keterangan_jabatan);
      $set->flag_jabatan = $request->flag_jabatan;
      $set->save();

    return redirect()->route('jabatan.index')->with('message', 'Berhasil mengubah konten jabatan.');
  }
  public function delete($id)
  {
    $set = Jabatan::find($id);
    $set->flag_jabatan = 0;
    $set->save();

    return redirect()->route('jabatan.index')->with('message', 'Berhasil menghapus jabatan.');
  }
}
