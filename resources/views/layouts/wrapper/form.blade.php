@extends('layouts.sidebar')

@section('content')
<link rel="stylesheet" href="{{asset('plugins/swal/dist/sweetalert.min.js')}}" charset="utf-8">
<div class="row wrapper border-bottom white-bg page-heading">
   @include('layouts.crumbs')
</div>
<div class="row">
   <div class="col-lg-10 col-lg-offset-1">
      <div class="wrapper wrapper-content">
         <div class="box animated fadeInUp">
            <div class="ibox">
               <div class="ibox-title">
                  <h5>{{$crumbs['title']}}</h5>
               </div>
               <div class="ibox-content">
                  @yield('form')
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
{{-- <script type="text/javascript">
$(document).ready(function() {
   $("form").validate(
    {
       highlight: function(element)
       {
          $(element).closest('.form-group').addClass('has-error');
       },
       unhighlight: function(element)
       {
          $(element).closest('.form-group').removeClass('has-error');
       },
       errorElement: 'span',
       errorClass: 'help-block',
       errorPlacement: function(error, element)
       {
          if(element.parent('.input-group').length)
          {
             error.insertAfter(element.parent());
          }
          else
          {
             if ( element.is(":radio") )
             {
                error.prependTo( element.parents('.form-group') );
             }
             else
             { // This is the default behavior
                error.insertAfter( element );
             }
          }
       },
       submitHandler: function(form)
       {
          if ($(form).valid())
          {
            //  showPreloader();
             $(form).ajaxSubmit({
                url:$(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(data)
                {
                   console.log(data);
                   var obj = jQuery.parseJSON(data);
                   if(obj.err == false)
                   {
                      console.log(obj.items);
                      swal({
                        title: "Success!",
                        text: obj.msg,
                        type: "success",
                        confirmButtonColor: "#0288d1",
                        confirmButtonText: "Ok!",
                        closeOnConfirm: true
                     },function()
                     {
                        window.location.replace(obj.redirect);
                     });
                  }
                  else
                  {
                     swal("Opps!", obj.msg, "error");
                  }
               }
            });
           //  alert($(form).serialize());
            return false;
         }
      }
   });
});

</script> --}}
@endsection
