<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use DB;
use App\Http\Requests;
use App\Models\Pegawai;
use App\Models\SuratMasukan;

class SuratMasukanController extends Controller
{
  public function lihat()
  {
    if (Auth::user()->level=="1") {
      $getsuratmasukan = DB::table('surat_masukan')->select('surat_masukan.*','pegawai.id as id_pegawai','pegawai.nama_pegawai'
                          ,'skpd.id as id_skpd','skpd.nama_skpd','jabatan.id as id_jabatan','jabatan.nama_jabatan')
                  ->leftJoin('pegawai', 'surat_masukan.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->leftJoin('jabatan', 'pegawai.id_jabatan', '=', 'jabatan.id')
                  ->orderby('surat_masukan.created_at', 'desc')
                  ->groupby('surat_masukan.id_pegawai')
                  ->get();
                  // dd($getsuratmasukan);
    } else if (Auth::user()->level=="2") {

      $getsuratmasukan = DB::table('surat_masukan')->select('surat_masukan.*','pegawai.id as id_pegawai','pegawai.nama_pegawai'
                          ,'skpd.id as id_skpd','skpd.nama_skpd','jabatan.id as id_jabatan','jabatan.nama_jabatan')
                  ->leftJoin('pegawai', 'surat_masukan.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->leftJoin('jabatan', 'pegawai.id_jabatan', '=', 'jabatan.id')
                  ->where('surat_masukan.id_user', Auth::user()->id_pegawai)
                  ->orderby('surat_masukan.created_at', 'desc')
                  ->groupby('surat_masukan.id_pegawai')
                  ->get();
    } 

    return view('backend/pages/lihatsuratmasukan')->with('getsuratmasukan', $getsuratmasukan);
  }

  public function lihatall()
  {
    if (Auth::user()->disposisi=="1") {
          $getsuratmasukan = DB::table('surat_masukan')->select('surat_masukan.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_masukan.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  // ->where('surat_masukan.id_pegawai', '=', Auth::user()->id_pegawai)
                  ->where(function($query) {
                            $query->where('surat_masukan.disposisi_staff', '1')
                              ->Where('surat_masukan.flag_approved', '1');
                          })
                  ->orderby('surat_masukan.tanggal_terima', 'desc')
                  ->groupby('surat_masukan.id_pegawai')
                  ->get();
      } else if (Auth::user()->disposisi=="2") {
        $getsuratmasukan = DB::table('surat_masukan')->select('surat_masukan.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_masukan.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  // ->where('surat_masukan.id_pegawai', '=', Auth::user()->id_pegawai)
                  ->where(function($query) {
                            $query->where('surat_masukan.disposisi_bidang', '1')
                              ->Where('surat_masukan.flag_approved', '1');
                          })
                  ->orderby('surat_masukan.tanggal_terima', 'desc')
                  ->groupby('surat_masukan.id_pegawai')
                  ->get();
      } else if (Auth::user()->disposisi=="3") {
        $getsuratmasukan = DB::table('surat_masukan')->select('surat_masukan.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_masukan.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  // ->where('surat_masukan.id_pegawai', '=', Auth::user()->id_pegawai)
                  ->where(function($query) {
                            $query->where('surat_masukan.disposisi_sekdis', '1')
                              ->Where('surat_masukan.flag_approved', '1');
                          })
                  ->orderby('surat_masukan.tanggal_terima', 'desc')
                  ->groupby('surat_masukan.id_pegawai')
                  ->get();
      }

    return view('backend/pages/lihatsuratmasukanall')->with('getsuratmasukan', $getsuratmasukan);
  }

  public function tambah()
  {
     // $getpegawai = Pegawai::select('*')
     //            ->where('flag_pegawai', '1')
     //            ->whereNotIn('id', [Auth::user()->id_pegawai])->get();
      $getskpd  = DB::table('skpd')
                    ->select('nama_skpd')
                    ->where('skpd.flag_skpd', 1)
                    ->get();

      $getpegawai = DB::table('skpd')
                    ->join('pegawai', 'pegawai.id_skpd', '=', 'skpd.id')
                    ->select('pegawai.id','pegawai.nama_pegawai as nama_pegawai', 'skpd.nama_skpd as nama_skpd')
                    ->where('skpd.flag_skpd', 1)
                    ->get();
                // dd($getpegawai);
    return view('backend/pages/tambahsuratmasuk')->with('getskpd', $getskpd)->with('getpegawai', $getpegawai);
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

      $new = new SuratMasukan;
      $new->id_pegawai = $request->id_pegawai;
      $new->id_user = Auth::user()->id;
      $new->tanggal_surat = date('Y-m-d');
      $new->nomor_surat = trim($request->nomor_surat);
      $new->perihal = trim($request->perihal);

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
      $new->catatan = trim($request->catatan);
      $new->url_document = $photo_name;
      $new->flag_approved = 0;
      $new->save();


    return redirect()->route('surat.masukan.lihat')->with('message', 'Berhasil menambahkan Surat Masukan.');
  }

  public function edit($id)
  {
    $editsuratmasukan = SuratMasukan::find($id);

    // $getpegawai = Pegawai::select('*')
    //             ->where('flag_pegawai', '1')
    //             ->whereNotIn('id', [Auth::user()->id_pegawai])->get();

    $getskpd  = DB::table('skpd')
                    ->select('nama_skpd')
                    ->where('skpd.flag_skpd', 1)
                    ->get();

    $getpegawai = DB::table('skpd')
                  ->join('pegawai', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->select('pegawai.id','pegawai.nama_pegawai as nama_pegawai', 'skpd.nama_skpd as nama_skpd')
                  ->where('skpd.flag_skpd', 1)
                  ->get();

    return view('backend/pages/tambahsuratmasuk')
      ->with('getpegawai', $getpegawai)
      ->with('getskpd', $getskpd)
      ->with('editsuratmasukan', $editsuratmasukan);
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

        $set = SuratMasukan::find($request->id);
        $set->id_pegawai = $request->id_pegawai;
        $set->id_user = Auth::user()->id;
        $set->nomor_surat = trim($request->nomor_surat);
        $set->perihal = trim($request->perihal);

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
        $set->catatan = trim($request->catatan);
        $set->url_document = $photo_name;
        $set->save();
    

    return redirect()->route('surat.masukan.lihat')->with('message', 'Berhasil mengubah Surat Masukan.');
  }

  public function flagapproved($id)
  {
    $set = SuratMasukan::find($id);
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

    return redirect()->route('surat.masukan.lihat')->with('message', 'Berhasil mengubah status approved Surat Masukan.');
  }

  public function delete($id)
  {
    $set = SuratMasukan::find($id);
    $set->delete();

    return redirect()->route('surat.masukan.lihat')->with('message', 'Berhasil menghapus Surat Masukan.');
  }

  public function preview($id)
  {
     $getsurat = DB::table('surat_masukan')->leftJoin('pegawai','surat_masukan.id_pegawai','=','pegawai.id')
                ->leftJoin('skpd','pegawai.id_skpd','=','skpd.id')
                ->leftJoin('jabatan','pegawai.id_jabatan','=','jabatan.id')
                ->select('surat_masukan.*','pegawai.id as id_pegawai','pegawai.nama_pegawai as nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd as nama_skpd','jabatan.id as id_jabatan','jabatan.nama_jabatan as nama_jabatan')
                ->where('surat_masukan.id', $id)
                ->first();
    // dd($getsurat);
    return view('backend/pages/preview')->with('getsurat', $getsurat);
  }
  
}
