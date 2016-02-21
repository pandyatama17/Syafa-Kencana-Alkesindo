<!DOCTYPE html>
<html>

<head>
   <link rel="icon" href="/ska.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Syafa Kencana Alkesindo</title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/assets/css/animate.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

    <script src="/assets/js/jquery-2.1.1.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="/assets/img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="/assets/profile.html">Profile</a></li>
                            <li><a href="/assets/contacts.html">Contacts</a></li>
                            <li><a href="/assets/mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="/assets/login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        SKA
                    </div>
                </li>
                @if(Session::has('user'))

                  @if(Session::get('user')->user_level == 'admin' || Session::get('user')->user_level == 'owner')
                   <li>
                       <a href="#" id="NavbarFinance"><i class="fa fa-archive"></i> <span class="nav-label">Finance</span> <span class="fa arrow"></span></a>
                       <ul class="nav nav-second-level">
                           <li><a href="{{url('/invoice')}}">Data Invoice</a></li>
                           <li><a href="{{url('/invoice/create')}}">Tambah Invoice</a></li>
                           <li><a href="{{url('/storage')}}">Data Piutang</a></li>
                           {{-- <li><a href="/assets/dashboard_4_1.html">Dashboard v.4</a></li> --}}
                       </ul>
                   </li>
                  @elseif(Session::get('user')->user_level == 'gudang' || Session::get('user')->user_level == 'owner')
                      <li>
                          <a href="#" id="NavbarStorage"><i class="fa fa-home"></i> <span class="nav-label">Gudang</span> <span class="fa arrow"></span></a>
                          <ul class="nav nav-second-level">
                              <li>
                                 <a href="{{url('/storage/list')}}">
                                    Daftar Barang
                                    @if(DB::table('item')->where('qty', '0')->count() >= 1)
                                          <span class="pull-right label label-danger">{{DB::table('item')->where('qty', '0')->count()}}<small> kosong</small></span>
                                    @endif
                                 </a>
                              </li>
                              <li><a href="{{url('/storage/add')}}">Tambah Barang</a></li>
                              <li><a href="{{url('/storage/restock')}}">Barang Masuk</a></li>
                              {{-- <li><a href="/assets/dashboard_4_1.html">Dashboard v.4</a></li> --}}
                          </ul>
                      </li>
                  @endif
                   <li>
                       <a href="{{url('/supplier')}}"><i class="fa fa-truck"></i> <span class="nav-label">Supplier</span></a>
                   </li>
                @endif
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
           <div class="row border-bottom">
           <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
              <div class="navbar-header">
                  <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                  {{-- <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                      <div class="form-group">
                          <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                      </div>
                  </form> --}}
              </div>
               <ul class="nav navbar-top-links navbar-right">
                   <li>
                      @if(Session::has('user'))
                        <a href="/logout">
                           <i class="fa fa-sign-out"></i> Log out
                        </a>
                      @else
                        <a href="/login">
                           <i class="fa fa-sign-in"></i> Log In
                        </a>
                      @endif
                   </li>
               </ul>

           </nav>
        </div>
       @yield('content')
       <div class="footer">
          <div>
            <strong>Copyright</strong> Syafa Kencana Alkesindo &copy; 2014-2015
         </div>
      </div>
   </div>
</div>

    <!-- Mainly scripts -->
    <script src="/assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/assets/js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/assets/js/inspinia.js"></script>
    <script src="/assets/js/plugins/pace/pace.min.js"></script>


</body>

</html>
