<style type="text/css">
  #colortreemenulihref{
      color: #000000;
    }
</style>
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      @if(Auth::user()->url_foto=="")
        <img src="{{ asset('/images/userdefault.png') }}" class="img-circle" alt="User Image">
      @else
        <img src="{{ url('images') }}/{{Auth::user()->url_foto}}" class="img-circle" alt="User Image">
      @endif
    </div>
    <div class="pull-left info">
      <p style="color:black">
        @if(Auth::user()->name=="")
          {{Auth::user()->email}}
        @else
          {{Auth::user()->name}}
        @endif
      </p>
      <a href="#" style="color:black"><i class="fa fa-circle text-success"></i>
        {{Auth::user()->email}}
      </a>
    </div>
  </div>
  <!-- search form -->
  <!-- <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
      </span>
    </div>
  </form> -->
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li>
      <a href="{{url('backend/dashboard')}}" id="colortreemenulihref">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
     <li class="treeview">
      <a href="#" id="colortreemenulihref">
        <i class="fa fa-user-plus"></i>
        <span>Manajemen Pegawai</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{url('admin/lihat-pegawai')}}"><i class="fa fa-circle-o"></i> Kelola Pegawai</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#" id="colortreemenulihref">
        <i class="fa fa-mortar-board"></i>
        <span>Kelola Jabatan</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{url('admin/kelola-jabatan')}}"><i class="fa fa-circle-o"></i> Kelola Jabatan</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#" id="colortreemenulihref">
        <i class="fa fa-bank"></i>
        <span>Kelola Skpd</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{url('admin/kelola-skpd')}}"><i class="fa fa-circle-o"></i> Kelola Skpd</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#" id="colortreemenulihref">
        <i class="fa fa-users"></i>
        <span>Manajemen Akun</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{url('admin/kelola-akun')}}"><i class="fa fa-circle-o"></i> Kelola Akun</a></li>
      </ul>
    </li>
    
  </ul>
</section>
