@extends('layouts.head')

@section('navbar')
{{-- {{\Auth::user()->avatar}} --}}
@if (!empty(\Auth::user()))

<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                      <span>
                        <img alt="image" class="img-circle" src="{{asset('/img/user/'.\Auth::user()->avatar)}}" style="width:75px; height:75px"/>
                     </span>
                     <a href="#" class="block m-t-xs">
                        <strong class="font-bold">{{\Auth::user()->name}}</strong>
                        <br>
                        <a href="{{url('profile')}}">
                           {{\Auth::user()->role}}
                           {{-- <i class="fa fa-gear"></i> --}}
                        </a>
                     </a>
                </div>
                <div class="logo-element">
                    SKA
                </div>
            </li>
              {{-- @if (Session::get('user')->user_level == 'admin') --}}
                 <li>
                     <a href="#" id="NavbarFinance"><i class="fa fa-archive"></i> <span class="nav-label">Invoice</span> <span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level">
                          <li><a href="{{url('/invoice')}}">Data Invoice</a></li>
                          <li><a href="{{url('/invoice/create')}}">Tambah Invoice Baru</a></li>
                          {{-- <li><a href="/assets/dashboard_4_1.html">Dashboard v.4</a></li> --}}
                     </ul>
                 </li>
                 <li>
                     <a href="#" id="NavbarFinance"><i class="fa fa-file-text"></i> <span class="nav-label">Delivery Order</span> <span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level">
                          <li><a href="{{url('/deliveryorder')}}">Data Delivery Order</a></li>
                          <li><a href="{{url('/deliveryorder/create')}}">Tambah DO Baru</a></li>
                          {{-- <li><a href="/assets/dashboard_4_1.html">Dashboard v.4</a></li> --}}
                     </ul>
                 </li>
                 <li>
                     <a href="#" id="NavbarPiutang"><i class="fa fa-usd"></i> <span class="nav-label">Hutang / Piutang</span> <span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level">
                       {{-- <li><a href="{{url('piutang/all')}}">Semua Piutang</a></li> --}}
                       <li>
                           <a href="#" id="NavbarPiutangSKA"><span class="nav-label">Hutang</span> <span class="fa arrow"></span></a>
                           <ul class="nav nav-third-level">
                                <li><a href="{{url('hutang/all')}}">Semua Hutang</a></li>
                                <li><a href="{{url('hutang/done')}}">Hutang Lunas</a></li>
                                <li><a href="{{url('hutang/pending')}}">Hutang Belum Lunas</a></li>
                                {{-- <li><a href="/assets/dashboard_4_1.html">Dashboard v.4</a></li> --}}
                           </ul>
                       </li>
                       <li>
                           <a href="#" id="NavbarPiutangCustomer"><span class="nav-label">Piutang</span> <span class="fa arrow"></span></a>
                           <ul class="nav nav-third-level">
                                <li><a href="{{url('piutang/all')}}">Semua Piutang</a></li>
                                <li><a href="{{url('piutang/done')}}">Piutang Lunas</a></li>
                                <li><a href="{{url('piutang/pending')}}">Piutang Belum Lunas</a></li>
                                {{-- <li><a href="/assets/dashboard_4_1.html">Dashboard v.4</a></li> --}}
                           </ul>
                       </li>
                     </ul>
                 </li>
                 <li>
                     <a href="#" id="NavbarOrder"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Purchase Order</span> <span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level">
                          <li><a href="{{url('order/list')}}">Data Purchase Order</a></li>
                          <li><a href="{{url('order/new')}}">Purchase Order Baru</a></li>
                     </ul>
                 </li>
                 <li>
                     <a href="#" id="NavbarStorage"><i class="fa fa-home"></i> <span class="nav-label">Gudang</span> <span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level">
                         <li>
                            <a href="{{url('/item/list')}}">
                               Daftar Barang
                               @if(DB::table('items')->where('qty', '0')->count() >= 1)
                                     <span class="pull-right label label-danger">{{DB::table('items')->where('qty', '0')->count()}}<small> kosong</small></span>
                               @endif
                            </a>
                         </li>
                         {{-- @if(Session::get('user')->user_level == 'gudang')
                            <li><a href="{{url('/item/add')}}">Tambah Barang Baru</a></li>
                            <li><a href="{{url('/item/restock')}}">Barang Masuk</a></li>
                         @endif --}}
                         <li><a href="{{url('/item/add')}}">Tambah Barang Baru</a></li>
                         <li><a href="{{url('/item/in')}}">Barang Masuk</a></li>
                     </ul>
                 </li>
                 <li>
                     <a href="{{url('/supplier')}}"><i class="fa fa-truck"></i> <span class="nav-label">Supplier</span></a>
                 </li>
                 <li>
                    <a href="{{url('/customer/list')}}"><i class="fa fa-user"></i> <span class="nav-label">Customer</span></a>
                 </li>
              {{-- @else
                 <li>
                     <a href="#" id="NavbarPiutang"><i class="fa fa-users"></i> <span class="nav-label">Manajemen User</span> <span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level">
                         <li><a href="{{url('user/list')}}">Daftar User</a></li>
                         <li><a href="{{url('user/create')}}">Tambah User</a></li>
                     </ul>
                 </li>
              @endif --}}
            {{-- @endif --}}
        </ul>

    </div>
</nav>
    <div id="page-wrapper" class="gray-bg">
      <div class="row border-bottom">
      <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
          <div class="navbar-header">
              <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
          </div>
      {{-- @endif --}}
           <ul class="nav navbar-top-links navbar-right">
               <li>
                  {{-- @if(Session::has('user')) --}}
                    <a href="/logout">
                       <i class="fa fa-sign-out"></i> Log out
                    </a>
                  {{-- @else
                    <a href="/login" style="color:white;">
                       <i class="fa fa-sign-in"></i> Log In
                    </a>
                  @endif --}}
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
@else
    <script type="text/javascript">
      window.location = "{{ url('/login') }}";//here double curly bracket
    </script>
@endif
@endsection
