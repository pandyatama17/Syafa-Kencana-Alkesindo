<link rel="stylesheet" href="/assets/css/plugins/chosen/chosen.css" media="screen" title="no title" charset="utf-8">

<link rel="stylesheet" href="/swal/dist/sweetalert.css" media="screen" title="no title" charset="utf-8">

<script src="/swal/dist/sweetalert.min.js" charset="utf-8"></script>

@extends('layouts.header')

@section('content')
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-sm-4">
			<h2>Detail {{$item->item_name}}</h2>
				<ol class="breadcrumb">
					<li>
						<a href="{{url()}}">SKA</a>
					</li>
               <li>
						<a href="{{url('/storage/list')}}">Gudang</a>
					</li>
               <li>
						<a href="{{url('/storage/show/').$item->id}}">Details</a>
					</li>
               <li>
						<a href="{{url('/storage/show/').$item->id}}"><strong>{{$item->item_name}}</strong></a>
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
                <div class="box-middle animated fadeInRightBig">
					   <div class="col-md-2">
                  </div>
                     <div class="col-md-8">

                       <div class="widget-head-color-box navy-bg p-lg text-center">
                           <div class="m-b-md">
                           <h2 id="ItemID" class="font-bold no-margins">
                              <span id="ItemEditText">Edit </span>{{$item->item_name}}
                           </h2>
                              <small>{{$item->id}}</small>
                           </div>
                           <img src="/img/item/{{$item->image}}" class="img-rounded rounded-border m-b-md" alt="profile" id="ItemImage">
                           <div class="text-right">
                              {{-- <a class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a> --}}
                              <a class="btn btn-xs btn-primary" id="CardAction"><i class="fa fa-edit"></i> Edit</a>
                           </div>
                       </div>
                       <div class="widget-text-box" id="ItemCard" style="box-shadow: inset 1px 4px 9px -6px;">
                           <h4 class="media-heading">{{$item->item_name}}</h4>
                           <table>
                              <tr>
                                 <td style="padding:5px;">ID Barang</td>
                                 <td style="padding:5px;">:</td>
                                 <td style="padding:5px;">{{$item->id}}</td>
                              </tr>
                              <tr>
                                 <td style="padding:5px;">Nama Barang</td>
                                 <td style="padding:5px;">:</td>
                                 <td style="padding:5px;">{{$item->item_name}}</td>
                              </tr>
                              <tr>
                                 <td style="padding:5px;">Supplier</td>
                                 <td style="padding:5px;">:</td>
                                 <td style="padding:5px;">{{$supplier->supplier_name}}</td>
                              </tr>
                              <tr>
                                 <td style="padding:5px;">Harga Supplier</td>
                                 <td style="padding:5px;">:</td>
                                 <td style="padding:5px;" id="supplier_price">{{$item->supplier_price}}</td>
                              </tr>
                              <tr>
                                 <td style="padding:5px;">Harga Jual</td>
                                 <td style="padding:5px;">:</td>
                                 <td style="padding:5px;" id="resell_price">{{$item->resell_price}}</td>
                              </tr>
                           </table>
                           <div class="text-right">
                              <form class="form-inline" action="{{action('ItemController@destroy')}}" method="get" id="DeleteItemForm">
                                 <input type="hidden" name="id" value="{{$item->id}}">
                                    <button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete </button>
                                    <a class="btn btn-xs btn-primary" id="CardAction2"><i class="fa fa-edit"></i> Edit</a>
                              </form>
                           </div>
                       </div>
                       <div class="widget-text-box" id="EditItemContainer" style="box-shadow: inset 1px 4px 9px -6px;">
                           {{-- <h4 class="media-heading">Edit</h4> --}}
                           <form class="form-horizontal" method="post" action="{{ action('ItemController@update') }}" id="EditItemForm" enctype="multipart/form-data">
                              {{-- ID Input --}}
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">ID Barang</label>
                                 <div class="col-sm-8">
                                    <input id="newid" name="newid" type="text" class="form-control" value="{{$item->id}}">
                                 </div>
                              </div>
                              {{-- Name Input --}}
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Nama Barang</label>
                                 <div class="col-sm-8">
                                    <input id="name" name="name" type="text" class="form-control" value="{{$item->item_name}}">
                                 </div>
                              </div>
                              {{-- Supplier Input --}}
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Supplier</label>
                                 <div class="col-sm-8">
                                   <select name="supplier" class="form-control">
                                     @foreach ($suppliers as $res)
                                        @if($res->id == $item->supplier_id)
                                           <option value="{{$res->id}}" selected>{{$res->supplier_name}}</option>
                                        @else
                                           <option value="{{$res->id}}">{{$res->supplier_name}}</option>
                                         @endif
                                     @endforeach
                                   </select>
                                </div>
                              </div>
                              {{-- Supplier Price Input --}}
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Harga Supplier</label>
                                 <div class="col-sm-8">
                                    <input id="supplier_price" name="supplier_price" type="text" class="form-control" value="{{$item->supplier_price}}">
                                 </div>
                              </div>
                              {{-- Resell Price Input --}}
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Harga Jual</label>
                                 <div class="col-sm-8">
                                    <input id="resell_price" name="resell_price" type="text" class="form-control" value="{{$item->resell_price}}">
                                 </div>
                              </div>
                              {{-- Image Input --}}
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Gambar</label>
                                 <div class="col-sm-8">
                                    <input id="image" name="image" type="File" class="form-control" value="{{$item->image}}">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Preview Gambar</label>
                                 <div class="col-sm-8">
                                    <img id="prev" class="img-rounded img-responsive" src="/img/item/{{$item->image}}" name="image" alt="your image" />
                                 </div>
                              </div>
                              {{-- Hidden Inputs --}}
                              <input type="hidden" name="oldid" value="{{$item->id}}">
                              <input type="hidden" name="user" value="{{Session::get('user')->id}}">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="text-right">
                                 <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
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
        $("#ItemEditText").toggle();
        $('#EditItemContainer').toggle();

        $('#CardAction').click(function()
        {

           if ($('#ItemCard').is(":visible"))
           {
                 $('#ItemCard').slideToggle(function()
              {
                 $('#EditItemContainer').slideToggle('slow');
                 $('#CardAction').html('<i class="fa fa-eye"></i> Preview');
                 $("#ItemEditText").toggle();
              });
              $('#ItemImage').slideToggle('slow');
           }
           else
           {
              $('#EditItemContainer').slideToggle(function()
              {
                 $('#ItemCard').slideToggle('slow');
                 $('#CardAction').html('<i class="fa fa-edit"></i> Edit');
                 $("#ItemEditText").toggle();
              });
              $('#ItemImage').slideToggle('slow');
           }
        });

        $('#CardAction2').click(function()
        {
           $('#CardAction').click();
        });

        function readURL(input) {

         if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#prev').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#image").change(function(){
          readURL(this);
      });
   });
   var resell_price = $("#resell_price").text();
   $("#resell_price").text(rupiah(resell_price));

   var supplier_price = $("#supplier_price").text();
   $("#supplier_price").text(rupiah(supplier_price));

    $('#EditItemForm').validate(
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
                                    location.replace('/storage/show/'+obj.itemid);
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
    function rupiah(nStr)
   {
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1))
      {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
      }
      return "Rp. " + x1 + x2 +",00";
   }
</script>
@endsection
