<html>
  <head>
    <link href="/materialize/css/prism.css" rel="stylesheet">
    <link href="/materialize/css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="/materialize/dist/font/material-design-icons/Material-Design-Icons.eot" rel="stylesheet">
    <link href="/materialize/dist/font/material-design-icons/Material-Design-Icons.svg" rel="stylesheet">
    <link href="/materialize/dist/font/material-design-icons/Material-Design-Icons.ttf" rel="stylesheet">
    <link href="/materialize/dist/font/material-design-icons/Material-Design-Icons.woff" rel="stylesheet">
    <link href="/materialize/dist/font/material-design-icons/Material-Design-Icons.woff2" rel="stylesheet">

      <!--Import materialize.css-->

      <link type="text/css" rel="stylesheet" href="/materialize/dist/css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <link type="text/css" rel="stylesheet" href="/swal/dist/sweetalert.css"  media="screen,projection"/>
      <style>
        .linav
        {
          padding-left: 5px;
          padding-right: 5px;
        }
      </style>
  </head>
    <body>
        <script type="text/javascript" src="/materialize/dist/js/jquery-2.2.0.min.js"></script>
        <script type="text/javascript" src="/materialize/dist/js/materialize.min.js"></script>
        <script type="text/javascript" src="/swal/dist/sweetalert.min.js"></script>
        <script>
            $(document).ready(function(
            {
                $(".dropdown-button").dropdown();
                $('select').material_select();
            }));
            </script>
    <!-- Dropdown Structure -->
        <ul id="dropdown1" class="dropdown-content">
          <li><a href="#!">account</a></li>
          <li class="divider"></li>
          <li><a href="/logout">Logout</a></li>
        </ul>
        <ul id="dropdown2" class="dropdown-content">
          <li><a href="/storage/list">Daftar Barang</a></li>
          <li class="divider"></li>
          <li><a href="/storage/restock">Barang Masuk</a></li>
          <li class="divider"></li>
          <li><a href="/storage/out">Barang Keluar</a></li>
          <li class="divider"></li>
          <li><a href="/storage/DO">DO baru</a></li>
        </ul>
        <ul id="dropdown3" class="dropdown-content">
            <li><a href="/finance/invoice">Invoice Baru</a></li>
            <li><a href="/finance/invoices">Data Invoice</a></li>
          <li class="divider"></li>
        </ul>
        <nav>
          <div class="nav-wrapper">
            <a href="/" class="brand-logo" style="margin-left:20px"><img src="/SKA.png"></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li class="linav">

              </li>
              <?php
                if(Session::has('user'))
                {
                  $level = Session::get('user')->user_level;
                }
              ?>
              @if(Session::has('user'))
                @if($level == 'owner' || $level == 'admin' || $level == 'gudang')
                  <li class="linav">
                     <a class="dropdown-button" href="#!" data-activates="dropdown2">Gudang<i class="material-icons right">arrow_drop_down</i></a>
                  </li>
                 @endif
                @if($level == 'owner' || $level == 'admin')
                  <li class="linav">
                    <a class="dropdown-button" href="#!" data-activates="dropdown3">Finance<i class="material-icons right">arrow_drop_down</i></a>
                  </li>
                @endif
                @if($level == 'owner' || $level == 'gudang')
                  <li class="linav">
                    <a href="/supplier/">Supplier</a>
                  </li>
                @endif
              @endif
              <li class="linav">
                @if(Session::has('user'))
                <div class="alert alert-<?php echo Session::get('status');?> alert-dismissable">
                  <a class="dropdown-button" href="#!" data-activates="dropdown1">{{ Session::get('user')->name }}<i class="material-icons right">arrow_drop_down</i></a>
                </div>
                @else
                  <a href="/login">Login</a>
                @endif
              </li>
            </ul>
          </div>
        </nav>
        <div class="content">

        </div>

        <div class="container" style="margin-top:40px;">
          @yield('content')
        </div>
    </body>
</html>
