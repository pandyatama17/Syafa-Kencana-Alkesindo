@extends('layouts.header')

@section('content')
   <link rel="stylesheet" href="{{asset('assets/css/plugins/chosen/chosen.css')}}" media="screen" title="no title">
   <link rel="stylesheet" href="{{asset('css/chosen-bootstrap.css')}}" media="screen" title="no title">
   <link rel="stylesheet" href="{{asset('swal/dist/sweetalert.css')}}" media="screen" title="no title">
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
	</div>
	  <div class="row">
			<div class="col-lg-12">
				 <div class="wrapper wrapper-content">
					  <div class="box animated fadeInRight">
							{{-- <h3 class="font-bold">This is page content</h3> --}}
                     <div class="ibox float-e-margins">
                        <div class="ibox-title">
                           <h5>Tambah Barang</h5>
                        </div>
                        <div class="ibox-content">

                     {{-- Start Form --}}
                     <form class="form-horizontal" method="post" action="{{ action('ItemController@storeItem') }}" id="addItemForm" enctype="multipart/form-data">
                        {{-- ID Input --}}
                        <div class="form-group">
                           <label class="col-sm-2 control-label">ID</label>
                           <div class="col-sm-10">
                              <input id="id" name="id" type="text" class="form-control">
                           </div>
                        </div>
                       {{-- Name Input --}}
                       <div class="form-group">
                          <label class="col-sm-2 control-label">Nama Barang</label>
                          <div class="col-sm-10">
                             <input id="name" name="name" type="text" class="form-control">
                          </div>
                       </div>
                       {{-- Supplier Input --}}
                       <div class="form-group">
                          <label class="col-sm-2 control-label">Supplier</label>
                          <div class="col-sm-10">
                             <select name="supplier" id="supplier" data-placeholder="Select Supplier" class="chosen-select form-control">
                               @foreach ($suppliers as $res)
                                 <option value="{{$res->id}}">{{$res->supplier_name}}</option>
                               @endforeach
                             </select>
                          </div>
                       </div>
                       {{-- Supplier Price Input --}}
                       <div class="form-group">
                          <label class="col-sm-2 control-label">Harga Supplier</label>
                          <div class="col-sm-10">
                             <input id="supplier_price" name="supplier_price" type="number" class="form-control">
                          </div>
                       </div>
                       {{-- Resell Price Input --}}
                       <div class="form-group">
                          <label class="col-sm-2 control-label">Harga Jual</label>
                          <div class="col-sm-10">
                             <input id="resell_price" name="resell_price" type="number" class="form-control">
                          </div>
                       </div>
                       {{-- Image Input --}}
                       <div class="form-group">
                          <label class="col-sm-2 control-label">Gambar</label>
                          <div class="col-sm-10">
                             <input id="image" name="image" type="file" class="form-control">
                          </div>
                       </div>
                       {{-- End New Item FOrm --}}
                       <div class="hr-line-dashed"></div>
                       {{-- Begin Item In Form --}}
                       <h5>Barang Masuk</h5>
                       {{-- PO Input --}}
                       <div class="form-group">
                          <label class="col-sm-2 control-label">Purchase Order</label>
                          <div class="col-sm-10">
                             <input id="PO" name="PO" type="text" class="form-control">
                          </div>
                       </div>
                       {{-- qty Input --}}
                       <div class="form-group">
                          <label class="col-sm-2 control-label">Jumlah Qty.</label>
                          <div class="col-sm-10">
                             <input id="qty" name="qty" type="number" min="1" class="form-control">
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
                        <div class="form-group">
                          <button class="btn btn-primary pull-right m-t-n-xs" type="submit"><strong>Save</strong></button>
                       </div>
                    </form>
                 </div>
              </div>
            </div>
         </div>

<script src="{{asset('/assets/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('/assets/js/plugins/chosen/chosen.jquery.js')}}"></script>
<script src="{{asset('/jquery.validate.min.js')}}"></script>
<script src="{{asset('/swal/dist/sweetalert.min.js')}}"></script>
<script src="{{asset('/jquery.form.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function()
 {
    $('select').chosen();
    $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
    $('#addItemForm').validate(
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
@endsection
