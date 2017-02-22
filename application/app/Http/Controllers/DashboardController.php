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
                  ->whereRaw('Date(surat_masukan.tanggal_terima) = CURDATE()')
                  ->where('surat_masukan.flag_approved', '1')
                  ->orderby('surat_masukan.tanggal_terima', 'desc')
                  ->limit(10)->get();

      $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.nama_pegawai')
                  ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
                  ->whereRaw('Date(surat_keluaran.tanggal_terima) = CURDATE()')
                  ->where('surat_keluaran.flag_approved', '1')
                  ->orderby('surat_keluaran.tanggal_terima', 'desc')
                  ->limit(10)->get();

    } else if (Auth::user()->level=="2") {
     
      
      $countsuratmasukan = SuratMasukan::where('surat_masukan.id_user', Auth::user()->id_pegawai)->count();
      $countsuratkeluaran = SuratKeluaran::where('surat_keluaran.id_user', Auth::user()->id_pegawai)->count();

      $countapproved = SuratMasukan::where('flag_approved', 1)
                      ->where('surat_masukan.id_user', Auth::user()->id_pegawai)
                      ->count();
      $countbelumapproved = SuratKeluaran::where('flag_approved', 0)
                      ->where('surat_keluaran.id_user', Auth::user()->id_pegawai)
                      ->count();

      // $getsuratmasukan = DB::table('surat_masukan')->select('surat_masukan.*','pegawai.nama_pegawai')
      //             ->leftJoin('pegawai', 'surat_masukan.id_pegawai', '=', 'pegawai.id')
      //             ->whereRaw('Date(surat_masukan.tanggal_terima) = CURDATE()')
      //             ->where('surat_masukan.flag_approved', '1')
      //             ->orderby('surat_masukan.tanggal_terima', 'desc')
      //             ->limit(10)->get();

      // $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.nama_pegawai')
      //             ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
      //             ->whereRaw('Date(surat_keluaran.tanggal_terima) = CURDATE()')
      //             ->where('surat_keluaran.flag_approved', '1')
      //             ->orderby('surat_keluaran.tanggal_terima', 'desc')
      //             ->limit(10)->get();

        if (Auth::user()->disposisi=="1") {
          $getsuratmasukan = DB::table('surat_masukan')->select('surat_masukan.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_masukan.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where([
                            ['surat_masukan.disposisi_staff', '1'],
                            ['surat_masukan.flag_approved', '1']
                          ])
                  ->orderby('surat_masukan.tanggal_terima', 'desc')
                  ->groupby('surat_masukan.id_pegawai')
                  ->get();

          $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where([
                            ['surat_keluaran.disposisi_staff', '1'],
                            ['surat_keluaran.flag_approved', '1']
                          ])
                  ->orderby('surat_keluaran.tanggal_terima', 'desc')
                  ->groupby('surat_keluaran.id_pegawai')
                  ->get();

      } else if (Auth::user()->disposisi=="2") {
        $getsuratmasukan = DB::table('surat_masukan')->select('surat_masukan.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_masukan.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where([
                            ['surat_masukan.disposisi_bidang', '1'],
                            ['surat_masukan.flag_approved', '1']
                          ])
                  ->orderby('surat_masukan.tanggal_terima', 'desc')
                  ->groupby('surat_masukan.id_pegawai')
                  ->get();

        $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
                ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                ->where([
                          ['surat_keluaran.disposisi_bidang', '1'],
                          ['surat_keluaran.flag_approved', '1']
                        ])
                ->orderby('surat_keluaran.tanggal_terima', 'desc')
                ->groupby('surat_keluaran.id_pegawai')
                ->get();

      } else if (Auth::user()->disposisi=="3") {
        $getsuratmasukan = DB::table('surat_masukan')->select('surat_masukan.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_masukan.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where([
                            ['surat_masukan.disposisi_sekdis', '1'],
                            ['surat_masukan.flag_approved', '1']
                          ])
                  ->orderby('surat_masukan.tanggal_terima', 'desc')
                  ->groupby('surat_masukan.id_pegawai')
                  ->get();

          $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where([
                            ['surat_keluaran.disposisi_sekdis', '1'],
                            ['surat_keluaran.flag_approved', '1']
                          ])
                  ->orderby('surat_keluaran.tanggal_terima', 'desc')
                  ->groupby('surat_keluaran.id_pegawai')
                  ->get();
      }


    } else if (Auth::user()->level=="3") {
      if (Auth::user()->disposisi=="1") {

          $countsuratmasukan = SuratMasukan::where([
                            ['surat_masukan.disposisi_staff', '1'],
                            ['surat_masukan.flag_approved', '1']
                          ])->count();
          $countsuratkeluaran = SuratKeluaran::where([
                            ['surat_keluaran.disposisi_staff', '1'],
                            ['surat_keluaran.flag_approved', '1']
                          ])->count();

          $getsuratmasukan = DB::table('surat_masukan')->select('surat_masukan.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_masukan.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where([
                            ['surat_masukan.disposisi_staff', '1'],
                            ['surat_masukan.flag_approved', '1']
                          ])
                  ->orderby('surat_masukan.tanggal_terima', 'desc')
                  ->get();

          $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where([
                            ['surat_keluaran.disposisi_staff', '1'],
                            ['surat_keluaran.flag_approved', '1']
                          ])
                  ->orderby('surat_keluaran.tanggal_terima', 'desc')
                  ->get();
      } else if (Auth::user()->disposisi=="2") {
          $countsuratmasukan = SuratMasukan::where([
                            ['surat_masukan.disposisi_bidang', '1'],
                            ['surat_masukan.flag_approved', '1']
                          ])->count();
          $countsuratkeluaran = SuratKeluaran::where([
                            ['surat_keluaran.disposisi_bidang', '1'],
                            ['surat_keluaran.flag_approved', '1']
                          ])->count();

        $getsuratmasukan = DB::table('surat_masukan')->select('surat_masukan.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_masukan.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where([
                            ['surat_masukan.disposisi_bidang', '1'],
                            ['surat_masukan.flag_approved', '1']
                          ])
                  ->orderby('surat_masukan.tanggal_terima', 'desc')
                  ->get();

          $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where([
                            ['surat_keluaran.disposisi_bidang', '1'],
                            ['surat_keluaran.flag_approved', '1']
                          ])
                  ->orderby('surat_keluaran.tanggal_terima', 'desc')
                  ->get();
      } else if (Auth::user()->disposisi=="3") {
         $countsuratmasukan = SuratMasukan::where([
                            ['surat_masukan.disposisi_sekdis', '1'],
                            ['surat_masukan.flag_approved', '1']
                          ])->count();
          $countsuratkeluaran = SuratKeluaran::where([
                            ['surat_keluaran.disposisi_sekdis', '1'],
                            ['surat_keluaran.flag_approved', '1']
                          ])->count();

          $getsuratmasukan = DB::table('surat_masukan')->select('surat_masukan.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_masukan.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where([
                            ['surat_masukan.disposisi_sekdis', '1'],
                            ['surat_masukan.flag_approved', '1']
                          ])
                  ->orderby('surat_masukan.tanggal_terima', 'desc')
                  ->get();

          $getsuratkeluaran = DB::table('surat_keluaran')->select('surat_keluaran.*','pegawai.id as id_pegawai','pegawai.nama_pegawai','skpd.id as id_skpd','skpd.nama_skpd')
                  ->leftJoin('pegawai', 'surat_keluaran.id_pegawai', '=', 'pegawai.id')
                  ->leftJoin('skpd', 'pegawai.id_skpd', '=', 'skpd.id')
                  ->where([
                            ['surat_keluaran.disposisi_sekdis', '1'],
                            ['surat_keluaran.flag_approved', '1']
                          ])
                  ->orderby('surat_keluaran.tanggal_terima', 'desc')
                  ->get();
      }
      
      $countapproved = [];
      $countbelumapproved = [];
    }
    // dd($getsuratmasukan);
    return view('backend/pages/dashboard')
      ->with('countsuratmasukan', $countsuratmasukan)
      ->with('countsuratkeluaran', $countsuratkeluaran)
      ->with('countapproved', $countapproved)
      ->with('countbelumapproved', $countbelumapproved)
      ->with('getsuratmasukan', $getsuratmasukan)
      ->with('getsuratkeluaran', $getsuratkeluaran);
  }
}
