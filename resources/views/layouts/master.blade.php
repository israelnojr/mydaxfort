<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{csrf_token()}}" >
  <script> window.laravel = { csrfToken: '{{ csrf_token() }}' } </script>
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <!-- Google Font -->
  <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper" id="app">
  <header class="main-header">
    <!-- Logo -->
    <a href="{{('/')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Ad</b>min</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" data-toggle="push-menu" role="button" style="color: #fff;">
        <i class="fa fa-bars"></i>
      </a>

      <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">           
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('images/adminlte.jpg')}}" class="user-image" alt="User Image">
                <span class="hidden-xs">{{Auth::user()->name}}</span>
              </a>
              <ul class="dropdown-menu" style="top: 34px;">
                <!-- User image -->
                <li class="user-header" style="margin-top: -1px;">
                  <img src="{{asset('images/adminlte.jpg')}}" class="rounded-circle" alt="User Image">
                  <p>
                    {{Auth::user()->name}} -  {{Auth::user()->type}}
                    <small>Member since {{Auth::user()->created_at->toFormattedDateString()}}</small>
                  </p>
                </li>         
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="float-left">
                    <router-link to="/profile" class="btn btn-default btn-flat">Profile</router-link>
                  </div>
                  <div class="float-right">
                  <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">Sign out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
@if(Auth::user()->type == 'admin' or Auth::user()->type == 'developer')
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image" style="float: left!important;">
          <img src="{{asset('images/adminlte.jpg')}}" class="rounded-circle" alt="User Image">
        </div>
        <div class="pull-left info" style="float: left!important;">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        @csrf
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
      @can('isAdmin')
        <li class="">
          <router-link to="/dashboard">
            <i class="fa fa-th"></i> <span>Dashboard</span>
              <span class="pull-right-container">
              
              </span>
          </router-link>
        </li>  
        
        <li class="treeview">
          <a href="#">
          <i class="fas fa-tasks"></i></i> <span>Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <router-link to="/users"><i class="fas fa-user-cog"></i> User </router-link>
            </li>
            
          </ul>
        </li>  
        
        <li class="">
          <router-link to="/product">
            <i class="fa fa-th"></i> <span>Products</span>
              <span class="pull-right-container">
              
              </span>
          </router-link>
        </li>  

        <li class="">
          <router-link to="/category">
            <i class="fa fa-th"></i> <span>Categories</span>
              <span class="pull-right-container">
              
              </span>
          </router-link>
        </li>  
        <li class="">
          <router-link to="/hero">
            <i class="fa fa-th"></i> <span>HeroHeader</span>
              <span class="pull-right-container">
              
              </span>
          </router-link>
        </li>

        <li class="">
          <router-link to="/order">
            <i class="fa fa-th"></i> <span>Orders</span>
              <span class="pull-right-container">
              
              </span>
          </router-link>
        </li>
  
  @endcan
  @can('isDeveloper')
        <li class="">
          <router-link to="/developer">
            <i class="fab fa-connectdevelop"></i> <span>Developer</span>
              <span class="pull-right-container">
              
              </span>
          </router-link>
        </li> 
  @endcan
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- =============================================== -->
  @endif
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- main content -->
    <div class="content">
      <div class="content-fluid">            
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>      
      </div>
    </div>
    <!-- end main content -->
    
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
     
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://twitter.com/juisdev">JuisDev</a>.</strong> All rights
    reserved.
  </footer>

 
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
@auth
  <script>
    window.user = @jason(auth()->user())
  </script>
@endauth
<script src="{{asset('js/app.js')}}"></script>

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

</body>
</html>
