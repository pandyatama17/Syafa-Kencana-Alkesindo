<!DOCTYPE html>
<html @if(!Session::has('user'))style="background:#F3F3F4"@endif>

<head>
   <link rel="icon" href="/ska.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Syafa Kencana Alkesindo</title>

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('swal/dist/sweetalert.css')}}" media="screen" title="no title" charset="utf-8">

    <script src="{{asset('assets/js/jquery-2.1.1.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
</head>

<body>

    <div id="wrapper">

   @if(Session::has('user'))
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                       @if(Session::has('user'))
                          <span>
                            <img alt="image" class="img-circle" src="{{url()}}/img/user/{{Session::get('user')->avatar}}" style="width:75px; height:75px"/>
                         </span>
                         <a href="#" class="block m-t-xs">
                            <strong class="font-bold">{{Session::get('user')->name}}</strong>
                            <br>
                            <a href="{{url('profile')}}">
                               {{Session::get('user')->user_level}} <i class="fa fa-gear"></i>
                            </a>
                         </a>
                        @endif
                    </div>
                    <div class="logo-element">
                        SKA
                    </div>
                </li>
                @if(Session::has('user'))

                  @if(Session::get('user')->user_level == 'admin' || Session::get('user')->user_level == 'owner')
                   <li>
                       <a href="#" id="NavbarFinance"><i class="fa fa-archive"></i> <span class="nav-label">Invoice</span> <span class="fa arrow"></span></a>
                       <ul class="nav nav-second-level">
                           <li><a href="{{url('/invoice')}}">Data Invoice</a></li>
                           <li><a href="{{url('/invoice/create')}}">Tambah Invoice Baru</a></li>
                           {{-- <li><a href="/assets/dashboard_4_1.html">Dashboard v.4</a></li> --}}
                       </ul>
                   </li>
                   <li>
                       <a href="#" id="NavbarPiutang"><i class="fa fa-usd"></i> <span class="nav-label">Piutang</span> <span class="fa arrow"></span></a>
                       <ul class="nav nav-second-level">
                           <li><a href="{{url('piutang/all')}}">Semua Piutang</a></li>
                           <li><a href="{{url('piutang/clear')}}">Piutang Lunas</a></li>
                           <li><a href="{{url('piutang/pending')}}">Piutang Belum Lunas</a></li>
                           {{-- <li><a href="/assets/dashboard_4_1.html">Dashboard v.4</a></li> --}}
                       </ul>
                   </li>
                   <li>
                      <a href="{{url('/deliveryorder')}}"><i class="fa fa-file-text"></i> <span class="nav-label">Delivery Order</span></a>
                   </li>
                  @endif
                  @if(Session::get('user')->user_level == 'gudang' || Session::get('user')->user_level == 'owner')
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
                              <li><a href="{{url('/storage/add')}}">Tambah Barang Baru</a></li>
                              <li><a href="{{url('/storage/restock')}}">Barang Masuk</a></li>
                              <li><a href="{{url('/storage/restock_report')}}">Data Barang Masuk</a></li>
                          </ul>
                      </li>
                  @endif
                  @if(Session::get('user')->user_level == 'gudang')
                     <li>
                       <a href="{{url('/storage/invoice/list')}}"><i class="fa fa-files-o"></i> <span class="nav-label">Data Invoice </span></a>
                     </li>
                     <li>
                       <a href="{{url('/deliveryorder')}}"><i class="fa fa-file-text"></i> <span class="nav-label">Delivery Order</span></a>
                     </li>
                  @endif
                   <li>
                       <a href="{{url('/supplier')}}"><i class="fa fa-truck"></i> <span class="nav-label">Supplier</span></a>
                   </li>
                   @if(Session::get('user')->user_level == 'owner')
                      <li>
                          <a href="#" id="NavbarPiutang"><i class="fa fa-users"></i> <span class="nav-label">Manajemen User</span> <span class="fa arrow"></span></a>
                          <ul class="nav nav-second-level">
                              <li><a href="{{url('user/list')}}">Daftar User</a></li>
                              <li><a href="{{url('user/create')}}">Tambah User</a></li>
                          </ul>
                      </li>
                   @endif
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
           @endif
               <ul class="nav navbar-top-links navbar-right">
                   <li>
                      @if(Session::has('user'))
                        <a href="/logout">
                           <i class="fa fa-sign-out"></i> Log out
                        </a>
                      @else
                        <a href="/login" style="color:white;">
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
   <link rel="stylesheet" href="{{asset('plugins/sf-flash/jquery.sf-flash.min.css')}}" media="screen" title="no title" charset="utf-8">

    <!-- Mainly scripts -->
    <script src="{{asset('assets/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jeditable/jquery.jeditable.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('assets/js/inspinia.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pace/pace.min.js')}}"></script>
    <script src="{{asset('plugins/sf-flash/jquery.sf-flash.min.js')}}"></script>
    <script src="{{asset('swal/dist/sweetalert.min.js')}}"></script>
@if(Session::has('priverror'))
   <script type="text/javascript">
      swal('Error!','{{Session::get('priverror')}}','error');
   </script>
@endif
</body>

</html>
