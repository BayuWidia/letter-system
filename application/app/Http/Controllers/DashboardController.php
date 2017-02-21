<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\User;
use App\Models\SuratKeluaran;
use App\Models\SuratMasukan;
use App\Http\Requests;
use DB;

class DashboardController extends Controller
{

  public function index()
  {
    if (Auth::user()->level=="1") {

      $countsuratmasukan = SuratMasukan::all()->count();
      $countsuratkeluaran = SuratKeluaran::all()->count();

      $countapproved = SuratMasukan::where('flag_approved', 1)->count();
      $countbelumapproved = SuratKeluaran::where('flag_approved', 0)->count();

      $getsuratmasukan = DB::table('surat_masukan')->select('surat_masukan.*','pegawai.nama_pegawai')
                  ->leftJoin('pegawai', 'surat_masukan.id_pegawai', '=', 'pegawai.id')
                  ->whereRaw('Date(surat_masukan.created_at) = CURDATE()')
                  ->where('surat_masukan.flag_approved', '0')
                  ->limit(10)->get();

      $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.nama_pegawai')
                  ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
                  ->whereRaw('Date(surat_keluaran.created_at) = CURDATE()')
                  ->where('surat_keluaran.flag_approved', '0')
                  ->limit(10)->get();

      $recordsuratmasukan = DB::table('surat_masukan')->select(DB::raw('*'))
                  ->whereRaw('Date(created_at) = CURDATE()')
                  ->where('flag_approved', '0')->count('*');

      $recordsuratkeluaran = DB::table('surat_keluaran')->select(DB::raw('*'))
                  ->whereRaw('Date(created_at) = CURDATE()')
                  ->where('flag_approved', '0')->count('*');

    } else if (Auth::user()->level=="2") {
     
      $countsuratmasukan = SuratMasukan::where('id_user', Auth::user()->id)->count();
      $countsuratkeluaran = KategoriBerita::all()->count();

      $countsudahterdaftar = User::where('activated', 1)->count();
      $countpengaduanbelumpublish = Berita::where('flag_publish', 0)->where('id_user', Auth::user()->id)->count();
    } else if (Auth::user()->level=="3") {
    
      $countsuratmasukan = Berita::where('id_user', Auth::user()->id)->count();
      $countsuratkeluaran = KategoriBerita::all()->count();


      $countsudahterdaftar = User::where('activated', 1)->count();
      $countpengaduanbelumpublish = Berita::where('flag_publish', 0)->where('id_user', Auth::user()->id)->count();
    }
    // dd($getsuratmasukan);
    return view('backend/pages/dashboard')
      ->with('countsuratmasukan', $countsuratmasukan)
      ->with('countsuratkeluaran', $countsuratkeluaran)
      ->with('countapproved', $countapproved)
      ->with('countbelumapproved', $countbelumapproved)
      ->with('getsuratmasukan', $getsuratmasukan)
      ->with('getsuratkeluaran', $getsuratkeluaran)
      ->with('recordsuratmasukan', $recordsuratmasukan)
      ->with('recordsuratkeluaran', $recordsuratkeluaran);
  }
}
