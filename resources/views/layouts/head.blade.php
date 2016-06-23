<!DOCTYPE html>
<html @if(!\Auth::user())style="background:#F3F3F4"@endif>

<head>
   <link rel="icon" href="/ska.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Syafa Kencana Alkesindo</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/chosen/chosen.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/chosen/chosen-bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/jquery-ui/jquery-ui.theme.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/jquery-ui/jquery-ui.structure.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/sf-flash/jquery.sf-flash.min.css')}}" rel="stylesheet">

    <script src="{{asset('js/jquery-2.1.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/plugins/toastr/toastr.min.js')}}"></script>
    <style media="screen">
       .dataTables_filter > label
       {
          float: right;
       }
       .pagination
       {
          margin-top: 0px;
          float: right;
       }
    </style>
</head>
@yield('login')
@yield('sidebar')

<body>

   @yield('navbar')

    <!-- Mainly scripts -->
    <script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('js/plugins/jeditable/jquery.jeditable.js')}}"></script>
    <script src="{{asset('js/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('js/inspinia.js')}}"></script>
    <script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>
    <script src="{{asset('js/plugins/sf-flash/jquery.sf-flash.min.js')}}"></script>
    <script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/plugins/chosen/chosen.jquery.js')}}"></script>

    <script src="{{asset('js/plugins/dataTables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('js/plugins/dataTables/dataTables.responsive.js')}}"></script>
    <script src="{{asset('js/plugins/dataTables/dataTables.tableTools.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    @if (Session::has('submitmsg'))
      @if (Session::get('submitmsg')['err'] == false)
        <script type="text/javascript">
        toastr.success('{{Session::get("submitmsg")["msg"]}}', '{{Session::get("submitmsg")["title"]}}')
        </script>
      @else
        <script type="text/javascript">
        toastr.error('{{Session::get("submitmsg")["msg"]}}', '{{Session::get("submitmsg")["title"]}}')
        </script>
      @endif
    @endif
</body>

</html>
