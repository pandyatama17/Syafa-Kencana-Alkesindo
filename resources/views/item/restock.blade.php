
@extends('layouts.header')

@section('content')
	<link rel="stylesheet" href="/assets/css/plugins/chosen/chosen.css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="/css/chosen-bootstrap.css" media="screen" title="no title" charset="utf-8">
   <link rel="stylesheet" href="/swal/dist/sweetalert.css" media="screen" title="no title" charset="utf-8">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-sm-4">
			<h2>Home</h2>
				<ol class="breadcrumb">
					<li>
						<a href="{{url()}}">SKA</a>
					</li>
					<li class="active">
						<strong>Home</strong>
					</li>
				</ol>
		</div>
		{{-- <div class="col-sm-8">
			<div class="title-action">
				<a href="" class="btn btn-primary">This is action area</a>
			</div>
		</div> --}}
		<script src="/jquery.validate.min.js" charset="utf-8"></script>
		<script src="/jquery.form.js" charset="utf-8"></script>
	</div>
	  <div class="row">
			<div class="col-lg-12">
				 <div class="wrapper wrapper-content">
					  <div class="box animated fadeInRightBig">
							<h3 class="font-bold">This is page content</h3>
							<form class="form-horizontal" method="post" action="{{ action('ItemController@itemInSave') }}" id="restockForm">
								{{-- PO Input --}}
								<div class="form-group">
                           <label class="col-sm-2 control-label">PO SKA #</label>
                           <div class="col-sm-10">
                              <input id="PO" name="PO" type="text" class="form-control">
                           </div>
                        </div>
								{{-- Item Select --}}
								<div class="form-group">
	                     	<label class="col-sm-2 control-label">Barang</label>
	                        <div class="col-sm-10">
										<select name="item" class="form-control">
											@if (isset($item))
												<option selected value="{{$item->id}}">{{$item->id}} - {{$item->item_name}}</option>
											@endif
											@foreach ($items as $res)
												@if (isset($item) && $res->id == $item->id)
													<option selected value="{{$item->id}}">{{$item->id}} - {{$item->item_name}}</option>
												@else
													<option value="{{$res->id}}">{{$res->id}} - {{$res->item_name}}</option>
												@endif
											@endforeach
											</select>
	                           </div>
	                        </div>
									{{-- Qty Input --}}
									<div class="form-group">
	                           <label class="col-sm-2 control-label">Qty.</label>
	                           <div class="col-sm-10">
	                              <input id="qty" name="qty" type="number" class="form-control">
	                           </div>
	                        </div>
									{{-- Date Input --}}
	                        <div class="form-group" id="data_1">
	                           <label class="col-sm-2 control-label">Tanggal Transaksi</label>
	                            <div class="input-group date">
	                                 <span class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                 </span>
	                                 <input type="text" class="form-control" value="{{date('Y-m-d')}}" name="transaction_date">
	                            </div>
	                         </div>
	                        <input type="hidden" name="user" value="{{Session::get('user')->id}}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                        <input type="hidden" name="transaction_type" value="in">
	                         <div class="form-group">
	                           <button class="btn btn-primary pull-right m-t-n-xs" type="submit"><strong>Save</strong></button>
	                        </div>
	                     </form>
							</div>
						</div>
					</div>
				</div>
				<script src="/assets/js/jquery-2.1.1.js"></script>
				<script src="/assets/js/bootstrap.min.js"></script>
				<script src="/assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
				<script src="/assets/js/plugins/chosen/chosen.jquery.js"></script>
				<script src="/jquery.validate.min.js" charset="utf-8"></script>
				<script src="/swal/dist/sweetalert.min.js" charset="utf-8"></script>
				<script src="/jquery.form.js" charset="utf-8"></script>
				<script type="text/javascript">
				 $(document).ready(function()
				 {
					 $('select').chosen(
					 {
						 	placeholder_text_single: "Select Project/Initiative...",
 					 		no_results_text: "Oops, nothing found!"
					 });

					 $('#data_1 .input-group.date').datepicker(
					 {
						 	format:'yyyy-mm-dd',
				                todayBtn: "linked",
				                keyboardNavigation: false,
				                forceParse: false,
				                calendarWeeks: true,
				                autoclose: true
				   });
                     $('#restockForm').validate(
                        {
                             rules:
                             {
                                 item:
                                 {
                                         required: true
                                 },
                                 qty:
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
                                                     title: "Well Done!",
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
                  });
                  </script>
					  </div>
				 </div>
			</div>
	  </div>
@endsection
