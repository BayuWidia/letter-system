<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use App\Models\Skpd;
use App\Http\Requests;

class SkpdController extends Controller
{
  public function index()
  {
    $getskpd = Skpd::get();
    return view('backend/pages/kelolaskpd')->with('getskpd', $getskpd);
  }

  public function store(Request $request)
  {
    // dd($request);
      $set = new Skpd;
      $set->actor = Auth::user()->id;
      $set->nama_skpd = $request->nama_skpd;
      $set->singkatan_skpd = $request->singkatan_skpd;
      $set->keterangan_skpd = $request->keterangan_skpd;
      $set->flag_skpd = $request->flag_skpd;
      $set->save();

    return redirect()->route('skpd.index')->with('message', 'Berhasil memasukkan skpd baru.');
  }

  public function bind($id)
  {
    $get = Skpd::find($id);
    return $get;
  }

  public function edit(Request $request)
  {
      $set = Skpd::find($request->id);
      $set->nama_skpd = $request->nama_skpd;
      $set->singkatan_skpd = $request->singkatan_skpd;
      $set->keterangan_skpd = $request->keterangan_skpd;
      $set->flag_skpd = $request->flag_skpd;
      $set->save();

    return redirect()->route('skpd.index')->with('message', 'Berhasil mengubah konten skpd.');
  }
  public function delete($id)
  {
    $set = Skpd::find($id);
    $set->delete();

    return redirect()->route('skpd.index')->with('message', 'Berhasil menghapus skpd.');
  }
}
