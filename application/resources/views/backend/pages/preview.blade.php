@extends('backend.layouts.master')

@section('title')
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Management Surat 
    <small>Preview Surat</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Lihat Surat</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">

      <div class="box box-widget">
        <div class="box-header with-border">
          <div class="user-block">
            <img class="img-circle" src="{{ asset('/images/userdefault.png') }}" alt="user image">
            <span class="username"><a>{{$getsurat->nama_pegawai}}</a></span>
            <span class="description">
              Nomor Surat : {{$getsurat->nomor_surat}}
            </span>
          </div><!-- /.user-block -->
          <div class="box-tools">
            <span class="label label-info">{{ \Carbon\Carbon::parse($getsurat->tanggal_surat)->format('d-M-y')}}</span>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
          <!-- post text -->
          SKPD : {{$getsurat->nama_skpd}}
          <hr/>
          Jabatan : {{$getsurat->nama_jabatan}}
          <hr/>
          Perihal : {{$getsurat->perihal}}
          <hr/>
          Catatan : <?php echo $getsurat->catatan ?>
        </div><!-- /.box-body -->

        <div class="box-footer">
          @if($getsurat->url_document != "-")
          <span data-toggle="tooltip">
            <a class="btn btn-warning btn-flat pull-left" href="{{ asset('\..\documents').'/'.$getsurat->url_document}}" download="{{$getsurat->url_document}}">Download Document</a>
          </span>
          @endif
           <span data-toggle="tooltip">
            <a class="btn btn-info btn-flat pull-right" href="{{ URL::previous() }}">Kembali Kehalaman Sebelumnya</a>
          </span>
        </div><!-- /.box-footer -->

      </div>
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

@stop
