@extends('layouts.head')

@section('login')
   <body class="gray-bg">

       <div class="middle-box text-center loginscreen  animated fadeInDown">
           <div>
               <div>

                   <h1 class="logo-name"><img src="/img/SKA_Logo.png" alt="Syafa Kencana Alkesindo" /></h1>

               </div>
               <h3>Selamat Datang</h3>
               @if(Session::has('message'))
                  <div class="alert alert-danger alert-dismissable">
                     <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                     {{Session::get('message')}}.
                  </div>
                 <script type="text/javascript">
                 $(function() {
                    $('.sf-flash').sfFlash();
                   $('body').append('<div class="sf-flash">{{Session::get('message')}}.</div>');

                 });
                 </script>
               @endif
                   <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
               </p>
               <p>Silahkan login terlebih dahulu untuk mengakses fitur yang ada</p>
               <form class="m-t" role="form" action="{!! action('UserController@auth') !!}">
                   <div class="form-group">
                       <input type="text" name="username" class="form-control" placeholder="Username" required="">
                   </div>
                   <div class="form-group">
                       <input type="password" name="password" class="form-control" placeholder="Password" required="">
                   </div>
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">

                   <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

               </form>
               <p class="m-t"> <small>&copy; Syafa Kencana Alkesindo 2014</small> </p>
           </div>
       </div>


   </body>
@endsection
