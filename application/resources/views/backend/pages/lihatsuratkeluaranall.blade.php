@extends('backend.layouts.master')

@section('title')
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Management Surat Keluaran
    <small>Seluruh Surat Keluaran</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Seluruh Surat Keluaran</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-danger">
        <div class="box-body">
          <table id="tabelinfo" class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Pengirim</th>
                <th>SKPD</th>
                <th>Sifat Surat</th>
                <th>Nomor Surat</th>
                <th>Tanggal Surat</th>
                <th>Approved</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @foreach($getsuratkeluaran as $key)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$key->nama_pegawai}}</td>
                  <td>{{$key->nama_skpd}}</td>
                  <td>{{$key->sifat_surat}}</td>
                  <td>{{$key->nomor_surat}}</td>
                  <td>
                    {{ \Carbon\Carbon::parse($key->tanggal_surat)->format('d-M-y')}}
                  </td>
                  <td>
                    <span class="badge bg-blue" data-toggle="tooltip" title="Surat Masukan sudah diapproved"><i class="fa fa-thumbs-up"></i></span>
                  </td>
                  <td>
                    <span data-toggle="tooltip" title="Lihat Konten">
                      <a href="{{route('surat.masukan.preview', $key->id)}}" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-eye"></i></a>
                    </span>
                  </td>
                </tr>
                <?php $i++; ?>
              @endforeach
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </div>

  <!-- jQuery 2.1.4 -->
  <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- DataTables -->
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>
@stop
