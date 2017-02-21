@extends('backend.layouts.master')

@section('title')
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap-tagsinput.css')}}">
  <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
  <script src="{{asset('plugins/ckfinder/ckfinder.js')}}"></script>
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Management Pegawai
    <small>Tambah Pegawai</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Tambah Pegawai</li>
  </ol>
@stop

@section('content')
  <script>
    window.setTimeout(function() {
      $(".alert-info").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
    }, 2000);

    window.setTimeout(function() {
      $(".alert-warning").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
    }, 5000);
  </script>
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
        <div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
          <p>{{ Session::get('message') }}</p>
        </div>
      @endif

      @if(Session::has('messagefail'))
        <div class="alert alert-warning">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Oops, terjadi kesalahan!</h4>
          <p>{{ Session::get('messagefail') }}</p>
        </div>
      @endif
    </div>
    <div class="col-md-12">
      <form class="form-horizontal"
        @if(isset($editpegawai))
          action="{{route('pegawai.update')}}"
        @else
          action="{{route('pegawai.store')}}"
        @endif
      method="post" style="margin-top:10px;" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="box box-danger">
          <div class="box-header">
            @if(isset($editpegawai))
              <h3 class="box-title">Form Edit Pegawai</h3>
            @else
              <h3 class="box-title">Form Tambah Pegawai</h3>
            @endif
          </div><!-- /.box-header -->
          <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Nomor Induk Pegawai</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nip"
                    @if(isset($editpegawai))
                      value="{{$editpegawai->nip}}"
                    @endif
                  >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Pegawai</label>
                <div class="col-sm-5">
                  @if(isset($editpegawai))
                    <input type="hidden" name="id" value="{{$editpegawai->id}}">
                  @endif
                  <input type="text" class="form-control" name="nama_pegawai"
                    @if(isset($editpegawai))
                      value="{{$editpegawai->nama_pegawai}}"
                    @endif
                  >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Jabatan</label>
                <div class="col-sm-5">
                  <select class="form-control select2" name="id_jabatan">
                    <option>-- Pilih --</option>
                      @if(!$getjabatan->isEmpty())
                        @if(isset($editpegawai))
                          @foreach($getjabatan as $key)
                            @if($editpegawai->id_jabatan==$key->id)
                              <option value="{{$key->id}}" selected="true">{{$key->nama_jabatan}}</option>
                            @else
                              <option value="{{$key->id}}">{{$key->nama_jabatan}}</option>
                            @endif
                          @endforeach
                        @else
                          @foreach($getjabatan as $key)
                            <option value="{{$key->id}}">{{$key->nama_jabatan}}</option>
                          @endforeach
                        @endif
                      @endif
                  </select>
                  @if($getjabatan->isEmpty())
                    <span style="color:red;">* Anda belum memiliki jabatan</span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">SKPD</label>
                <div class="col-sm-5">
                  <select class="form-control select2" name="id_skpd">
                    <option>-- Pilih --</option>
                      @if(!$getskpd->isEmpty())
                        @if(isset($editpegawai))
                          @foreach($getskpd as $key)
                            @if($editpegawai->id_skpd==$key->id)
                              <option value="{{$key->id}}" selected="true">{{$key->nama_skpd}}</option>
                            @else
                              <option value="{{$key->id}}">{{$key->nama_skpd}}</option>
                            @endif
                          @endforeach
                        @else
                          @foreach($getskpd as $key)
                            <option value="{{$key->id}}">{{$key->nama_skpd}}</option>
                          @endforeach
                        @endif
                      @endif
                  </select>
                  @if($getskpd->isEmpty())
                    <span style="color:red;">* Anda belum memiliki skpd</span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Foto Foto</label>
                <div class="col-sm-3">
                  <input type="file" class="form-control" name="url_foto">
                  @if(isset($editpegawai))
                    <span style="color:red;">* Biarkan kosong jika tidak ingin diganti.</span>
                  @endif
                </div>
              </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right btn-flat">Simpan</button>
            <button type="reset" class="btn btn-danger pull-right btn-flat" style="margin-right:5px;">Reset Form</button>
          </div>
        </div><!-- /.box -->
      </form>
    </div>
  </div>

  <!-- jQuery 2.1.4 -->
  <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- Tags Input -->
  <script src="{{asset('bootstrap/js/bootstrap-tagsinput.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>
  <script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"'></script>
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>

  <script type="text/javascript">
  $(".select2").select2();
  </script>
  <script>
    window.setTimeout(function() {
      $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
    }, 2000);
  </script>

  <script type="text/javascript">
    $(function(){
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        $('#tagsinput').tagsinput();
    })
  </script>

  <script language="javascript">
    CKEDITOR.replace('editor1');
    CKFinder.setupCKEditor( null, { basePath : '{{url('/')}}/plugins/ckfinder/'} );
    $(".textarea").wysihtml5();
  </script>

@stop
