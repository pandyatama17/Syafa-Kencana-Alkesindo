<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/assets/css/animate.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="/plugins/sf-flash/jquery.sf-flash.min.css" media="screen" title="no title" charset="utf-8">
    <!-- Mainly scripts -->
    <script src="/assets/js/jquery-2.1.1.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/plugins/sf-flash/jquery.sf-flash.min.js" charset="utf-8"></script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"><img src="/SKA_Logo.png" alt="Syafa Kencana Alkesindo" /></h1>

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
            <form class="m-t" role="form" action="{!! action('UserController@doLogin') !!}">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                {{-- <a href="/assets/assets/#"><small>Forgot password?</small></a> --}}
                {{-- <p class="text-muted text-center"><small>Do not have an account?</small></p> --}}
                {{-- <a class="btn btn-sm btn-white btn-block" href="/assets/assets/register.html">Create an account</a> --}}
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>


</body>
<script type="text/javascript">
$('#DeleteItemForm').validate(
   {
        rules:
        {
            id:
            {
                    required: true
            },

        },
        highlight: function(label)
        {
            $(label).closest().addClass('error');
        },
        success: function(label)
        {
            label.closest().addClass('success');
        },
        submitHandler: function(form)
        {
            if ($(form).valid())
            {
               $(form).ajaxSubmit(
               {
                    url:$(this).attr('action'),
                    type: 'GET',
                    data: $(this).serialize(),
                    success: function(data)
                    {
                        var obj = jQuery.parseJSON(data);
                        if(obj.err == false)
                        {
                            swal(
                            {
                                title: "Success!",
                                text: obj.msg,
                                type: "success",
                                confirmButtonColor: "#0288d1",
                                confirmButtonText: "Ok!",
                                closeOnConfirm: false
                            },
                            function()
                            {
                                location.replace('/storage/list');
                            });
                            }
                            else
                            {
                                swal("Opps!", obj.msg, "error");
                            }
                        }
                    })
                    return false;
               }
            }
        });
</script>
</html>
