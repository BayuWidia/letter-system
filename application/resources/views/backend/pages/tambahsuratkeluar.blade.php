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
    Management Surat Keluaran
    <small>Tambah Surat Keluaran Baru</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Tambah Surat Keluaran Baru</li>
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
        @if(isset($editsuratkeluaran))
          action="{{route('surat.keluaran.update')}}"
        @else
          action="{{route('surat.keluaran.store')}}"
        @endif
      method="post" style="margin-top:10px;" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="box box-danger">
          <div class="box-header">
            @if(isset($editsuratkeluaran))
              <h3 class="box-title">Form Edit Berita</h3>
            @else
              <h3 class="box-title">Form Tambah Berita Baru</h3>
            @endif
          </div><!-- /.box-header -->
          <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Pengirim</label>
                <div class="col-sm-5">
                  <select class="form-control select2" name="id_pegawai">
                    <option>-- Pilih --</option>
                      @if(!$getpegawai->isEmpty())
                        @if(isset($editsuratkeluaran))
                          @foreach($getpegawai as $key)
                            @if($editsuratkeluaran->id_pegawai==$key->id)
                              <option value="{{$key->id}}" selected="true">{{$key->nama_pegawai}}</option>
                            @else
                              <option value="{{$key->id}}">{{$key->nama_pegawai}}</option>
                            @endif
                          @endforeach
                        @else
                          @foreach($getpegawai as $key)
                            <option value="{{$key->id}}">{{$key->nama_pegawai}}</option>
                          @endforeach
                        @endif
                      @endif
                  </select>
                  @if($getpegawai->isEmpty())
                    <span style="color:red;">* Anda belum memiliki pegawai</span>
                  @endif
                  @if(isset($editsuratkeluaran))
                    <input type="hidden" name="id" value="{{$editsuratkeluaran->id}}">
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sifat Surat</label>
                <div class="col-sm-5">
                  <select class="form-control" name="sifat_surat">
                    <option>-- Pilih --</option>
                        @if(isset($editproject))
                            @if($editproject->sifat_surat=='Rahasia')
                              <option value="Rahasia" selected="true">Rahasia</option>
                              <option value="Segera">Segera</option>
                              <option value="Dinas">Dinas</option>
                            @elseif($editproject->sifat_surat=='Segera')
                              <option value="Rahasia">Rahasia</option>
                              <option value="Segera" selected="true">Segera</option>
                              <option value="Dinas">Dinas</option>
                            @elseif($editproject->sifat_surat=='Dinas')
                              <option value="Rahasia">Rahasia</option>
                              <option value="Segera">Segera</option>
                              <option value="Dinas" selected="true">Dinas</option>
                            @endif
                        @else
                            <option value="Rahasia">Rahasia</option>
                            <option value="Segera">Segera</option>
                            <option value="Dinas">Dinas</option>
                        @endif
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal Surat</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="tanggal_surat"
                    @if(isset($editsuratkeluaran))
                      value="{{ \Carbon\Carbon::parse($editsuratkeluaran->tanggal_surat)->format('d-M-y')}}" readonly>
                    @else
                      value="<?php echo date('d-M-y'); ?>" readonly>
                    @endif
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nomor Surat</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nomor_surat"
                    @if(isset($editsuratkeluaran))
                      value="{{$editsuratkeluaran->nomor_surat}}"
                    @endif>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Perihal</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="perihal"
                    @if(isset($editsuratkeluaran))
                      value="{{$editsuratkeluaran->perihal}}"
                    @endif>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Staff</label>
                <div class="col-sm-4">
                  <input type="checkbox" class="flat-red"
                    @if(isset($editsuratkeluaran))
                      @if($editsuratkeluaran->disposisi_staff=="1")
                        checked
                      @endif
                    @endif
                   name="disposisi_staff" value="1">
                  <span class="text-muted"><i style="color: red">* Ya, akan dikirimkan ke Disposisi Staff</i></span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Bidang</label>
                <div class="col-sm-4">
                  <input type="checkbox" class="flat-red"
                    @if(isset($editsuratkeluaran))
                      @if($editsuratkeluaran->disposisi_bidang=="1")
                        checked
                      @endif
                    @endif
                   name="disposisi_bidang" value="1">
                  <span class="text-muted"><i style="color: red">* Ya, akan dikirimkan ke Disposisi Bidang</i></span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sekdis</label>
                <div class="col-sm-4">
                  <input type="checkbox" class="flat-red"
                    @if(isset($editsuratkeluaran))
                      @if($editsuratkeluaran->disposisi_sekdis=="1")
                        checked
                      @endif
                    @endif
                   name="disposisi_sekdis" value="1">
                  <span class="text-muted"><i style="color: red">* Ya, akan dikirimkan ke Disposisi Sekdis</i></span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Catatan</label>
                <div class="col-sm-9">
                  <textarea required="true" class="textarea" name="catatan" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                    @if(isset($editsuratkeluaran))
                      {{$editsuratkeluaran->catatan}}
                    @endif
                  </textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">File Upload</label>
                <div class="col-sm-3">
                  <input type="file" class="form-control" name="upload_document">
                  @if(isset($editsuratkeluaran))
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
  <script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"'></script>  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>

  <script type="text/javascript">
  $(".select2").select2();
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
