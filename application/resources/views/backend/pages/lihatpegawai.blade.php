@extends('backend.layouts.master')

@section('title')
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Management Pegawai
    <small>Seluruh Pegawai</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('backend/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Seluruh Pegawai</li>
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

  <div class="modal fade" id="modaldelete" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Pegawai</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin untuk menghapus ini?</p>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Tidak</button>
          <a class="btn btn-danger btn-flat" id="sethapus">Ya, saya yakin</a>
        </div>
      </div>
    </div>
  </div>

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
      <div class="box box-success">
        <div class="box-header">
          <a href="{{route('pegawai.tambah')}}" class="btn bg-blue btn-flat margin">Tambah Pegawai</a>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tabelinfo" class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>SKPD</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @foreach($getpegawai as $key)
                <tr>
                  <td>{{$i}}</td>
                  <td>
                    @if($key->nip != "")
                      {{$key->nip}}
                    @else
                      <i style="color: red">Data belum diisikan</i>
                    @endif
                  </td>
                  <td>
                    @if($key->nama_pegawai != "")
                      {{$key->nama_pegawai}}
                    @else
                      <i style="color: red">Data belum diisikan</i>
                    @endif
                  </td>
                  <td>
                    @if($key->nama_skpd != "")
                      {{$key->nama_skpd}}
                    @else
                      <i style="color: red">Data belum diisikan</i>
                    @endif
                  </td>
                  <td>
                    @if($key->nama_jabatan != "")
                      {{$key->nama_jabatan}}
                    @else
                      <i style="color: red">Data belum diisikan</i>
                    @endif
                  </td>                  <td>
                    @if($key->flag_pegawai=="1")
                      <span class="badge bg-blue" data-toggle="tooltip" title="Pegawai Berstatuskan Aktif"><i class="fa fa-thumbs-up"></i></span>
                    @else
                      <span class="badge bg-green" data-toggle="tooltip" title="Pegawai Berstatuskan Tidak Aktif"><i class="fa fa-thumbs-down"></i></span>
                    @endif
                  </td>
                  <td>
                    <span data-toggle="tooltip" title="Edit">
                        <a href="{{route('pegawai.edit', $key->id)}}" class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></a>
                      </span>
                      <span data-toggle="tooltip" title="Hapus">
                        <a href="#" class="btn btn-xs btn-danger btn-flat hapus" data-toggle="modal" data-target="#modaldelete" data-value="{{$key->id}}"><i class="fa fa-remove"></i></a>
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

  <script>
    $(function () {
      $("#tabelinfo").DataTable();


      $("#tabelinfo").on("click", "a.hapus", function(){
        var a = $(this).data('value');
        $('#sethapus').attr('href', '{{url('admin/delete-pegawai/')}}/'+a);
      });
    });
  </script>

@stop
