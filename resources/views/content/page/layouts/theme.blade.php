<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config("app.myapp") }} | @yield("page_title")</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('public/layout') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/layout') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('public/layout') }}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('public/layout') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/layout') }}/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('public/layout') }}/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="{{ url('/page/dashboard') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">ABS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{{ config("app.myapp") }}</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ url('/public/image') }}/default.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="{{ url('/public/image') }}/default.jpg" class="img-circle" alt="User Image">

                  <p>
                    {{ Auth::user()->name }} <br> 

                    @if(Auth::user()->role == 1)
                    Admin
                    @elseif(Auth::user()->role == 2)
                    Wali Kelas
                    @elseif(Auth::user()->role == 3)
                    Guru Piket
                    @else
                    Tidak Jelas
                    @endif
                  </p>
                </li>
                <li class="user-footer">
                  <a href="{{ url('/page/logout') }}" class="btn btn-default btn-flat btn-block"><i class="fa fa-sign-out"></i> Log out</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{ url('/public/image') }}/default.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> 
              Online
            </a>
          </div>
        </div>
        <!-- Sidebar user panel -->
        <!-- search form -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Menu</li>
          <li>
            <a href="{{ url('/page/dashboard') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          @if(Auth::user()->role == 1)
          <li>
            <a href="{{ url('/page/guru') }}">
              <i class="fa fa-users"></i> <span>Guru</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/page/kelas') }}">
              <i class="fa fa-bars"></i> <span>Kelas</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/page/siswa') }}">
              <i class="fa fa-user"></i> <span>Siswa</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/page/guru_piket') }}">
              <i class="fa fa-pencil"></i> <span>Guru Piket</span>
            </a>
          </li>
          <li class="header">Report</li>
          <li>
            <a href="{{ url('/page/laporan') }}">
              <i class="fa fa-folder"></i> Laporan
            </a>
          </li>
          <li class="header">Users</li>
          <li>
            <a href="{{ url('/page/users') }}">
              <i class="fa fa-users"></i> <span>Users</span>
            </a>
          </li>
          @elseif(Auth::user()->role == 2)
          <li class="treeview">
            <a href="#">
              <i class="fa fa-pencil"></i> <span>Absensi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="{{ url('/page/tambah_absen') }}">
                  <i class="fa fa-plus"></i> <span>Tambah Absen</span>
                </a>
              </li>
              <li>
                <a href="{{ url('/page/data_absen') }}">
                  <i class="fa fa-folder-open"></i> <span>Data</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="header">Report</li>
          <li>
            <a href="{{ url('/page/laporan') }}">
              <i class="fa fa-folder"></i> Laporan
            </a>
          </li>
          @elseif(Auth::user()->role == 3)
          <li>
            <a href="{{ url('/page/tambah_absen_terlambat') }}">
              <i class="fa fa-plus"></i> <span>Tambah Absen</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/page/data_siswa_terlambat') }}">
              <i class="fa fa-folder-open"></i> <span>Data Siswa Terlambat</span>
            </a>
          </li>
          @else
          
          @endif
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          @yield("page_header")
        </h1>
        @yield("page_breadcrumb")
      </section>
      <!-- Main content -->
      <section class="content">
        @yield("page_content")
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; {{ config("app.myapp") }} 2020 .</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->
    <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('public/layout') }}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('public/layout') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="{{ asset('public/layout') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('public/layout') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="{{ asset('public/layout') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('public/layout') }}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/layout') }}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/layout') }}/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
function printDiv(elementId) {
 var a = document.getElementById('printing-css').value;
 var b = document.getElementById(elementId).innerHTML;
 window.frames["print_frame"].document.title = document.title;
 window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
 window.frames["print_frame"].window.focus();
 window.frames["print_frame"].window.print();
}
</script>

@yield("page_scripts")
</body>
</html>

