<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use DB;
use App\Http\Requests;
use App\Models\Pegawai;
use App\Models\SuratKeluaran;

class SuratKeluaranController extends Controller
{
  public function lihat()
  {
    if (Auth::user()->level=="1") {
      $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd','jabatan.id as id_jabatan','jabatan.nama_jabatan')
                  ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->leftJoin('jabatan', 'pegawai.id_jabatan', '=', 'jabatan.id')
                  ->orderby('surat_keluaran.created_at', 'desc')
                  ->groupby('surat_keluaran.id_pegawai')
                  ->get();
                  // dd($getsuratmasukan);
    } else if (Auth::user()->level=="2") {

      $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd','jabatan.id as id_jabatan','jabatan.nama_jabatan')
                  ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->leftJoin('jabatan', 'pegawai.id_jabatan', '=', 'jabatan.id')
                  ->where('surat_keluaran.id_user', Auth::user()->id_pegawai)
                  ->orderby('surat_keluaran.created_at', 'desc')
                  ->groupby('surat_keluaran.id_pegawai')
                  ->get();
    } 

    return view('backend/pages/lihatsuratkeluaran')->with('getsuratkeluaran', $getsuratkeluaran);
  }

  public function lihatall()
  {
    if (Auth::user()->disposisi=="1") {
          $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where('surat_keluaran.id_pegawai', '=', Auth::user()->id_pegawai)
                  ->where(function($query) {
                            $query->where('surat_keluaran.disposisi_staff', '1')
                              ->orWhere('surat_keluaran.flag_approved', '1');
                          })
                  ->orderby('surat_keluaran.tanggal_terima', 'desc')
                  ->groupby('surat_keluaran.id_pegawai')
                  ->get();
      } else if (Auth::user()->disposisi=="2") {
        $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where('surat_keluaran.id_pegawai', '=', Auth::user()->id_pegawai)
                  ->where(function($query) {
                            $query->where('surat_keluaran.disposisi_bidang', '1')
                              ->orWhere('surat_keluaran.flag_approved', '1');
                          })
                  ->orderby('surat_keluaran.tanggal_terima', 'desc')
                  ->groupby('surat_keluaran.id_pegawai')
                  ->get();
      } else if (Auth::user()->disposisi=="3") {
        $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where('surat_keluaran.id_pegawai', '=', Auth::user()->id_pegawai)
                  ->where(function($query) {
                            $query->where('surat_keluaran.disposisi_sekdis', '1')
                              ->orWhere('surat_keluaran.flag_approved', '1');
                          })
                  ->orderby('surat_keluaran.tanggal_terima', 'desc')
                  ->groupby('surat_keluaran.id_pegawai')
                  ->get();
      }

    return view('backend/pages/lihatsuratkeluaranall')->with('getsuratkeluaran', $getsuratkeluaran);
  }

  public function tambah()
  {
     $getpegawai = Pegawai::select('*')
                ->where('flag_pegawai', '1')
                ->whereNotIn('id', [Auth::user()->id_pegawai])->get();

    return view('backend/pages/tambahsuratkeluar')->with('getpegawai', $getpegawai);
  }

  public function store(Request $request)
  {
     $file = $request->file('upload_document');
      if($file != null)
      {
        $photo_name = Auth::user()->id_pegawai.'-'.date('Y-m-d').'-'.$request->nomor_surat.'.' . $file->getClientOriginalExtension();
        $file->move('documents/', $photo_name);
      }else{
        $photo_name = "-";

      }

      $new = new SuratKeluaran;
      $new->id_pegawai = $request->id_pegawai;
      $new->id_user = Auth::user()->id;
      $new->sifat_surat = $request->sifat_surat;
      $new->tanggal_surat = date('Y-m-d');
      $new->nomor_surat = $request->nomor_surat;
      $new->perihal = $request->perihal;

      $valstaff="";
      if($request->disposisi_staff=="") {
        $valstaff=0;
      } else {
        $valstaff=1;
      }

      $valbidang="";
      if($request->disposisi_bidang=="") {
        $valbidang=0;
      } else {
        $valbidang=1;
      }

      $valsekdis="";
      if($request->disposisi_sekdis=="") {
        $valsekdis=0;
      } else {
        $valsekdis=1;
      }

      $new->disposisi_staff = $valstaff;
      $new->disposisi_bidang = $valbidang;
      $new->disposisi_sekdis = $valsekdis;
      $new->catatan = $request->catatan;
      $new->url_document = $photo_name;
      $new->flag_approved = 0;
      $new->save();


    return redirect()->route('surat.keluaran.lihat')->with('message', 'Berhasil menambahkan Surat Keluaran.');
  }

  public function edit($id)
  {
    $editsuratkeluaran = SuratKeluaran::find($id);

    $getpegawai = Pegawai::select('*')
                ->where('flag_pegawai', '1')
                ->whereNotIn('id', [Auth::user()->id_pegawai])->get();

    return view('backend/pages/tambahsuratkeluaran')
      ->with('getpegawai', $getpegawai)
      ->with('editsuratkeluaran', $editsuratkeluaran);
  }

  public function update(Request $request)
  {
     $file = $request->file('upload_document');
      if($file != null)
      {
        $photo_name = Auth::user()->id_pegawai.'-'.date('Y-m-d').'-'.$request->nomor_surat.'.' . $file->getClientOriginalExtension();
        $file->move('documents/', $photo_name);
      }else{
        $photo_name = "-";

      }

        $set = SuratKeluaran::find($request->id);
        $set->id_pegawai = $request->id_pegawai;
        $set->id_user = Auth::user()->id;
        $set->sifat_surat = $request->sifat_surat;
        $set->tanggal_surat = date('Y-m-d');
        $set->nomor_surat = $request->nomor_surat;
        $set->perihal = $request->perihal;

        $valstaff="";
        if($request->disposisi_staff=="") {
          $valstaff=0;
        } else {
          $valstaff=1;
        }

        $valbidang="";
        if($request->disposisi_bidang=="") {
          $valbidang=0;
        } else {
          $valbidang=1;
        }

        $valsekdis="";
        if($request->disposisi_sekdis=="") {
          $valsekdis=0;
        } else {
          $valsekdis=1;
        }

        $set->disposisi_staff = $valstaff;
        $set->disposisi_bidang = $valbidang;
        $set->disposisi_sekdis = $valsekdis;
        $set->catatan = $request->catatan;
        $set->url_document = $photo_name;
        $set->save();
    

    return redirect()->route('surat.keluaran.lihat')->with('message', 'Berhasil mengubah Surat Keluaran.');
  }

  public function flagapproved($id)
  {
    $set = SuratKeluaran::find($id);
    if($set->flag_approved=="1") {
      $set->tanggal_terima = date('Y-m-d');
      $set->flag_approved = 0;
      $set->id_approved = Auth::user()->id;
      $set->save();
    } elseif ($set->flag_approved=="0") {
      $set->tanggal_terima = date('Y-m-d');
      $set->flag_approved = 1;
      $set->id_approved = Auth::user()->id;
      $set->save();
    }

    return redirect()->route('surat.keluaran.lihat')->with('message', 'Berhasil mengubah status approved Surat Keluaran.');
  }

  public function delete($id)
  {
    $set = SuratKeluaran::find($id);
    $set->delete();

    return redirect()->route('surat.keluaran.lihat')->with('message', 'Berhasil menghapus Surat Keluaran.');
  }

  public function preview($id)
  {
     $getsurat = DB::table('surat_keluaran')->leftJoin('pegawai','surat_keluaran.id_pegawai','=','pegawai.id')
                ->leftJoin('skpd','pegawai.id_skpd','=','skpd.id')
                ->leftJoin('jabatan','pegawai.jabatan','=','jabatan.id')
                ->select('surat_keluaran.*','pegawai.id as id_pegawai','pegawai.nama_pegawai as nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd as nama_skpd','jabatan.id as id_jabatan','jabatan.nama_jabatan as nama_jabatan')
                ->where('surat_keluaran.id', $id)
                ->first();
    return view('backend/pages/preview')->with('getsurat', $getsurat);
  }
  
}
