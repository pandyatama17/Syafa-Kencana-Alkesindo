@extends('layouts.header')

@section('content')
{{-- <link rel="stylesheet" href="{{asset('assets/css/plugins/datapicker/datepicker3.css')}}"> --}}
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-sm-4">
      <h2>Tambah User Baru</h2>
      <ol class="breadcrumb">
         <li>
            <a href="{{url()}}">SKA</a>
         </li>
         <li>
            <a href="{{url('owner')}}">Owner</a>
         </li>
         <li>
            <a href="{{url('user/list')}}">User</a>
         </li>
         <li class="active">
            <strong>Tambah User Baru</strong>
         </li>
      </ol>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="wrapper wrapper-content">
         <div class="box animated fadeIn">
            <div class="col-lg-12">
               <div class="ibox float-e-margins">
                  <div class="ibox-title">
                     <h5>Tambah User</h5>
                  </div>
                  <div class="ibox-content">
                     <form class="form-horizontal" id="aaaddUserForm" action="{{action('UserController@store')}}">
                        {{-- Username Input Start--}}
                        <div class="form-group">
                           <label class="col-lg-2 control-label">Username</label>
                           <div class="col-lg-10">
                              <input type="text" name="username" placeholder="Username" class="form-control">
                           </div>
                        </div>
                        {{-- Username Input End--}}
                        {{-- Nama Input Start--}}
                        <div class="form-group">
                           <label class="col-lg-2 control-label">Nama</label>
                           <div class="col-lg-10">
                              <input type="text" name="name" placeholder="Nama" class="form-control">
                           </div>
                        </div>
                        {{-- Nama Input End--}}
                        {{-- Tanggal Lahir Input Start--}}
                        <div class="form-group datepicker">
                           <label class="col-lg-2 control-label">Tanggal Lahir</label>
                            <div class="col-lg-10 input-group m-b date">
                               <span class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="form-control" name="birthdate" value="{{date('Y-m-d')}}">
                            </div>
                         </div>
                        {{-- Tanggal Lahir Input End--}}
                        {{-- Tempat Lahir Input Start--}}
                        <div class="form-group">
                           <label class="col-lg-2 control-label">Tempat Lahir</label>
                           <div class="col-lg-10">
                              <input type="text" name="birthplace" placeholder="Tempat Lahir" class="form-control">
                           </div>
                        </div>
                        {{-- Tempat Lahir Input End--}}
                        {{-- Alamat Input Start--}}
                        <div class="form-group">
                           <label class="col-lg-2 control-label">Alamat</label>
                           <div class="col-lg-10">
                              <textarea name="address" placeholder="Alamat" class="form-control"></textarea>
                           </div>
                        </div>
                        {{-- Alamat Input End--}}
                        {{-- User Level Input Start--}}
                        <div class="form-group">
                           <label class="col-lg-2 control-label">User Level</label>
                           <div class="col-lg-10">
                              <select name="user_level" class="form-control">
                                 <option value="" selected disabled>Pilih Level User</option>
                                 <option value="admin">admin</option>
                                 <option value="gudang">gudang</option>
                                 <option value="sales">sales</option>
                              </select>
                           </div>
                        </div>
                        {{-- User Level Input End--}}
                        <div class="form-group">
                           <div class="col-lg-offset-10 col-lg-2">
                              <button class="btn btn-primary" style="float:right" type="submit">Sign in</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="{{asset('assets/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('jquery.validate.min.js')}}"></script>
<script src="{{asset('swal/dist/sweetalert.min.js')}}"></script>
<script src="{{asset('jquery.form.js')}}"></script>
@if(Session::has('msg'))
<script type="text/javascript">
swal('success','{{Session::get('msg')}}','success');
</script>
@endif
<script type="text/javascript">
$(document).ready(function()
{
   $('.datepicker .input-group.date').datepicker({
      todayBtn: "linked",
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true,
      format: 'yyyy-mm-dd'
   });
   $('#addUserForm').validate(
   {
      submitHandler: function(form)
      {
         if ($(form).valid())
         {
            $(form).ajaxSubmit(
            {
               url:$(this).attr('action'),
               type: 'POST',
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
                        closeOnConfirm: true
                     },function()
                     {
                        location.replace("{{url('user/list')}}");
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
})

</script>
@endsection
