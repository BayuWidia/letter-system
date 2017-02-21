@extends('backend.layouts.master')

@section('title')
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
@stop

@section('breadcrumb')
  <h1>
    Skpd
    <small>Kelola Skpd</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Kelola Skpd</li>
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

  <div class="modal fade" id="modalflagedit" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Status Skpd</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin untuk mengubah status skpd ini?</p>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Tidak</button>
          <a class="btn btn-danger btn-flat" id="setflagpublish">Ya, saya yakin</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modaldelete" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Skpd</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin untuk menghapus skpd ini?</p>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Tidak</button>
          <a class="btn btn-danger btn-flat" id="sethapus">Ya, saya yakin</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modaledit" role="dialog">
    <div class="modal-dialog">
      <form class="form-horizontal" action="{{route('skpd.edit')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Konten Skpd</h4>
          </div>
          <div class="modal-body">
            <div class="col-md-14">
              <label class="control-label">Nama Skpd</label>
              <input type="text" name="nama_skpd" class="form-control" id="edit_nama_skpd">
               <input type="hidden" name="id" id="id">
            </div>
            <div class="col-md-14">
              <label class="control-label">Singkatan Skpd</label>
              <input type="text" name="singkatan_skpd" class="form-control" id="edit_singkatan_skpd">
            </div>
            <div class="col-md-14">
              <label class="control-label">Keterangan</label>
              <textarea name="keterangan_skpd" rows="4" cols="40" class="form-control" id="edit_keterangan_skpd"></textarea>
            </div>
            <div class="col-md-14">
              <label class="control-label">Status</label>
              <select class="form-control" name="flag_skpd">
                <option value="1" id="flag_aktif">Aktif</option>
                <option value="0" id="flag_nonaktif">Tidak Aktif</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-primary pull-left btn-flat" data-dismiss="modal">Tidak</button>
            <button type="submit" class="btn btn-danger btn-flat">Simpan Perubahan</a>
          </div>
        </div>
    </form>
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
    <div class="col-md-4">
      <form class="form-horizontal" action="{{route('skpd.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Formulir Tambah Skpd Baru</h3>
          </div>
          <div class="box-body">
            <div class="col-md-14">
              <label class="control-label">Nama Skpd</label>
              <input type="text" name="nama_skpd" class="form-control">
            </div>
            <div class="col-md-14">
              <label class="control-label">Singkatan Skpd</label>
              <input type="text" name="singkatan_skpd" class="form-control">
            </div>
            <div class="col-md-14">
              <label class="control-label">Keterangan</label>
              <textarea name="keterangan_skpd" rows="4" cols="40" class="form-control"></textarea>
            </div>
            <div class="col-md-14">
              <label class="control-label">Status</label>
              <select class="form-control" name="flag_skpd">
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
              </select>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right btn-sm btn-flat">Simpan</button>
            <button type="reset" class="btn btn-danger btn-sm btn-flat pull-right" style="margin-right:5px;">Reset Formulir</button>
          </div>
        </div>
      </form>
    </div>

    <div class="col-md-8">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Seluruh Data Jabatan</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tabelinfo" class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Singkatan</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @foreach($getskpd as $key)
                <tr>
                  <td>{{$i}}</td>
                  <td>
                    @if($key->nama_skpd != "")
                      {{$key->nama_skpd}}
                    @else
                      <i style="color: red">Data belum diisikan</i>
                    @endif
                  </td>
                  <td>
                    @if($key->singkatan_skpd != "")
                      {{$key->singkatan_skpd}}
                    @else
                      <i style="color: red">Data belum diisikan</i>
                    @endif
                  </td>
                  <td>
                    @if($key->keterangan_skpd != "")
                      {{$key->keterangan_skpd}}
                    @else
                      <i style="color: red">Data belum diisikan</i>
                    @endif
                  </td>
                  <td>
                    @if($key->flag_skpd=="1")
                      <span class="badge bg-blue" data-toggle="tooltip" title="Aktif">
                        <i class="fa fa-thumbs-up"></i>
                      </span>
                    @else
                      <span class="badge bg-red" data-toggle="tooltip" title="Tidak Aktif">
                        <i class="fa fa-thumbs-down"></i>
                      </span>
                    @endif
                  </td>
                  <td>
                    <span data-toggle="tooltip" title="Edit">
                      <a href="#" class="btn btn-xs btn-warning btn-flat edit" data-toggle="modal" data-target="#modaledit" data-value="{{$key->id}}"><i class="fa fa-edit"></i></a>
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
        </div>
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
        $('#sethapus').attr('href', '{{url('admin/delete-skpd/')}}/'+a);
      });

      $("#tabelinfo").on("click", "a.edit", function(){
        var a = $(this).data('value');
        $.ajax({
          url: "{{url('/')}}/admin/bind-skpd/"+a,
          dataType: 'json',
          success: function(data){
            var id = data.id;
            var nama_skpd = data.nama_skpd;
            var singkatan_skpd = data.singkatan_skpd;
            var keterangan_skpd = data.keterangan_skpd;
            var flag_skpd = data.flag_skpd;

            $('#id').attr('value', id);
            $('#edit_nama_skpd').val(nama_skpd);
            $('#edit_singkatan_skpd').val(singkatan_skpd);
            $('#edit_keterangan_skpd').val(keterangan_skpd);
            if(flag_skpd=="1") {
              $('#flag_aktif').attr('selected', true);
            } else {
              $('#flag_nonaktif').attr('selected', true);
            }
          }
        })
      });
    });
  </script>

@stop
