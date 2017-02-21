@extends('backend.layouts.master')

@section('title')
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-lg-6 col-md-3 col-xs-12">
      <div class="info-box bg-yellow">
        <span class="info-box-icon"><i class="fa fa-envelope"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Jumlah Surat Masukan</span>
          <span class="info-box-number">{{$countsuratmasukan}}</span>

          <div class="progress">
            <div class="progress-bar" style="width:100%"></div>
          </div>
              <span class="progress-description">
                <i>Data yang telah terbuat</i>
              </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div><!-- ./col -->


    <div class="col-lg-6 col-md-3 col-xs-12">
      <!-- /.info-box -->
      <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Jumlah Surat Keluaran</span>
          <span class="info-box-number">{{$countsuratkeluaran}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
              <span class="progress-description">
                <i>Data yang telah terbuat</i>
              </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div><!-- ./col -->

    <div class="col-lg-6 col-md-3 col-xs-12">
      <div class="info-box bg-blue">
        <span class="info-box-icon"><i class="fa fa-smile-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Sudah Approved</span>
          <span class="info-box-number">{{$countapproved}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
              <span class="progress-description">
                <i>Data yang telah diverifikasi</i>
              </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div><!-- ./col -->

    <div class="col-lg-6 col-md-3 col-xs-12">
      <!-- small box -->
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-frown-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Belum Approved</span>
          <span class="info-box-number">{{$countbelumapproved}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
              <span class="progress-description">
                 <i>Data yang belum diverifikasi</i>
              </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div><!-- ./col -->

  </div>


  <div class="row">
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Surat Masukan</h3>

          <div class="box-tools pull-right">
            <span class="label label-warning">{{$recordsuratmasukan}} Surat Masukan Baru</span>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>Nama Pengirim</th>
                <th>Nomor Surat</th>
                <th>Perihal</th>
              </tr>
              </thead>
              <tbody>
              @foreach($getsuratmasukan as $key)
                <tr>
                  <td>{{$key->nama_pegawai}}</td>
                  <td>
                    {{ $key->nomor_surat }}
                  </td>
                  <td>
                    {{ $key->perihal }}
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="{{url('admin/lihat-client')}}" class="btn btn-sm btn-info btn-flat pull-right">Lihat Semua Surat Masukan</a>
        </div>
        <!-- /.box-footer -->
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Surat Keluaran</h3>
          <div class="box-tools pull-right">
            <span class="label label-warning">{{$recordsuratkeluaran}} Surat Keluaran Baru</span>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>Nama Pengirim</th>
                <th>Nomor Surat</th>
                <th>Perihal</th>
              </tr>
              </thead>
              <tbody>
                @foreach($getsuratkeluaran as $key)
                <tr>
                  <td>{{$key->nama_pegawai}}</td>
                  <td>
                    {{ $key->nomor_surat }}
                  </td>
                  <td>
                    {{ $key->perihal }}
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="{{url('admin/lihat-client')}}" class="btn btn-sm btn-info btn-flat pull-right">Lihat Semua Surat Keluaran</a>
        </div>
        <!-- /.box-footer -->
      </div>
    </div>
  </div>

  <div class="row">
    <section class="col-md-12">

    </section>
  </div><!-- /.row (main row) -->

<!-- jQuery 2.1.4 -->
<script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/app.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{asset('plugins/chartjs/Chart.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard2.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>


@stop
