
@extends('layouts.header')

@section('content')
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-sm-4">
         <h2>Tambah Supplier Baru</h2>
				<ol class="breadcrumb">
               <li>
						<a href="{{url()}}">SKA</a>
					</li>
					<li>
	               @if(Session::get('user')->user_level == 'gudang')
	                  <a href="{{url('storage')}}">Gudang</a>
	               @elseif(Session::get('user')->user_level == 'admin')
	                  <a href="{{url('finance')}}">Finance</a>
	               @elseif(Session::get('user')->user_level == 'owner')
	                  <a href="{{url('owner')}}">Owner</a>
	               @endif
	            </li>
               <li>
						<a href="{{url()}}/supplier">Supplier</a>
					</li>
					<li class="active">
						<strong>Tambah Supplier Baru</strong>
					</li>
				</ol>
		</div>
		{{-- <div class="col-sm-8">
			<div class="title-action">
				<a href="" class="btn btn-primary">This is action area</a>
			</div>
		</div> --}}
	</div>
	  <div class="row">
			<div class="col-lg-12">
				 <div class="wrapper wrapper-content">
					  <div class="box animated fadeIn">
							{{-- <h3 class="font-bold">This is page content</h3> --}}
                     <div class="ibox float-e-margins">
                        <div class="ibox-title">
                           <h5>Daftar Supplier Baru</h5>
                        </div>
                        <div class="ibox-content">
      							<form class="form-horizontal" method="post" action="{{ action('MainController@storeSupplier') }}" id="addSupplierForm">
                              <?php
                               try
                               {
                                   $lastid = DB::table('supplier')->orderBy('id','ascending')->first();
                                   $newid = $lastid->id + 1;
                               }
                               catch(Exception $e)
                               {
                                   $newid = 1;
                               }
                             ?>
                             {{-- ID Input --}}
                             <div class="form-group">
                                <label class="col-sm-2 control-label">ID</label>
                                <div class="col-sm-10">
                                   <input id="id" name="id" type="text" class="form-control" value="{{$newid}}">
                                </div>
                             </div>
                            {{-- Name Input --}}
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Nama Supplier</label>
                              <div class="col-sm-10">
                                 <input id="name" name="name" type="text" class="form-control">
                              </div>
                            </div>
                            <input type="hidden" name="user" value="{{Session::get('user')->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                             <div class="form-group">
                              <button class="btn btn-primary pull-right m-t-n-xs" type="submit"><strong>Save</strong></button>
                            </div>
                         </form>
                      </div>
                   </div>
					  </div>
				 </div>
			</div>
	  </div>
 <script src="/jquery.validate.min.js" charset="utf-8"></script>
 <script src="/jquery.form.js" charset="utf-8"></script>

 <script type="text/javascript">
 $(document).ready(function()
 {
    $('#addSupplierForm').validate(
        {
            rules:
            {
                id:
                {
                        required: true
                },
                name:
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
                                    closeOnConfirm: false
                                },
                                function()
                                {
                                    location.replace('/supplier');
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
 });
 </script>
@endsection
