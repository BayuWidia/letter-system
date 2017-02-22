<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Hash;
use Auth;
use Image;
use App\Models\User;
use App\Models\Pegawai;
use App\Http\Requests;
use App\Models\MasterSKPD;

class AkunController extends Controller
{
  public function index()
  {
    $getuser = User::get();
    $getpegawai = Pegawai::select('*')
                ->where('flag_pegawai', '1')
                ->whereNotIn('id', [Auth::user()->id_pegawai])->get();
    return view('backend/pages/kelolaakun', compact('getuser','getpegawai'));
  }

  public function store(Request $request)
  {
       
    $file = $request->file('url_foto');
    if ($file != null) {
      $photo_name = time(). '.' . $file->getClientOriginalExtension();
      $photo1 = explode('.', $photo_name);
      Image::make($file)->fit(128,128)->save('images/'. $photo_name);
    } else {
      $photo_name = null;
    }

    $set = new User;
    $set->id_pegawai = $request->id_pegawai;
    $set->name = $request->name;
    $set->email = $request->email;
    $set->level = $request->level;
    $set->password = Hash::make($request->password);
    $set->url_foto = $photo_name;
    $set->activated = 1;
    $set->actor = Auth::user()->id;
    $set->disposisi = $request->disposisi;
    $set->save();

    return redirect()->route('akun.kelola')->with('message', 'Berhasil memasukkan akun baru.');
  }

  public function logoutProcess()
  {
    session()->flush();
    Auth::logout();
    return redirect()->route('login.pages');
  }

  public function loginProcess(Request $request)
  {
    if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password, 'activated'=>1])) {
        return redirect()->route('dashboard')->with('message', "Selamat Datang.");
      }
      else {
        return view('backend/pages/login')->with('message', "Silahkan lakukan login dengan benar.");
      }
    
    
  }

  public function update(Request $request)
  {

    $set = User::find($request->id);
    $set->name = $request->name;
    $set->level = $request->level;
    $set->activated = $request->activated;
    $set->actor = Auth::user()->id;
    $set->disposisi = $request->disposisi;
    $set->save();

    return redirect()->route('akun.kelola')->with('message', 'Berhasil mengubah data akun.');
  }

  public function delete($id)
  {
     $set = User::find($id);
     $set->activated = 0;
     $set->save();

      return redirect()->route('akun.kelola')->with('message', 'Berhasil menghapus data akun.');
  }

  public function bind($id)
  {
    $get = User::find($id);
    return $get;
  }
}
