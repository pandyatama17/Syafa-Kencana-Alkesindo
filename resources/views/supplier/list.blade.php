
@extends('layouts.header')

@section('content')
   <link rel="stylesheet" href="/swal/dist/sweetalert.css" media="screen" title="no title" charset="utf-8">
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-sm-4">
			<h2>Supplier</h2>
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
					<li class="active">
						<strong>Supplier</strong>
					</li>
				</ol>
		</div>
		<div class="col-sm-8">
			<div class="title-action">
				<a href="{{url()}}/supplier/add" class="btn btn-primary"><i class="fa fa-plus"></i> Daftar Supplier Baru</a>
			</div>
		</div>
	</div>
	  <div class="row">
			<div class="col-lg-12">
				 <div class="wrapper wrapper-content">
					  <div class="box animated fadeIn">
                    <table class="table table-striped table-bordered table-hover {{-- dataTables-example --}}" >
                       <thead>
                       <tr>
                          <th style="background:#263949; color:white;">ID Supplier</th>
                          <th style="background:#263949; color:white;">Nama Supplier</th>
                          <th style="background:#263949; color:white;">Tanggal Restok Terakhir</th>
                          <th style="background:#263949; color:white;">Barang Restok Terakhir</th>
                          <th class="choices" style="background:#263949; color:white;">Pilihan</th>
                       </tr>
                       </thead>
                       <tbody>
                          @foreach($suppliers as $res)
                             <tr data-href="{{url()}}/storage/show/{{$res->id}}" data-qty="{{$res->qty}}" data-item="{{$res->id}}">
                                <tr>
                                  <td>{!! $res->id !!}</td>
                                  <td>{!! $res->supplier_name !!}</td>
                                  <td>
                                     @if(isset($res->last_supply_date))
                                        {!! $res->last_supply_date !!}
                                     @else
                                        -
                                     @endif
                                 </td>
                                  <td>
                                     @if(isset($res->last_supply_item_id) && $res->last_supply_item_id != '0')
                                        {{$res->last_supply_item_id}}
                                     @else
                                        -
                                     @endif
                                  </td>
                                  <td>
                                     <a class="check" data-href="{{url('supplier/delete/'.$res->id)}}" id="{{$res->supplier_name}}"><i class="fa fa-trash"></i></a>
                                  </td>
                                </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th style="background:#263949; color:white;">ID Supplier</th>
                        <th style="background:#263949; color:white;">Nama Supplier</th>
                        <th style="background:#263949; color:white;">Tanggal Restok Terakhir</th>
                        <th style="background:#263949; color:white;">Barang Restok Terakhir</th>
                        <th class="choices" style="background:#263949; color:white;">Pilihan</th>
                      </tr>
                      </tfoot>
                   </table>
					  </div>
				 </div>
			</div>
	  </div>
     <!-- Mainly scripts -->
     <script src="/assets/js/jquery-2.1.1.js"></script>
     <script src="/assets/js/bootstrap.min.js"></script>
     <script src="/assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
     <script src="/assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
     <script src="/assets/js/plugins/jeditable/jquery.jeditable.js"></script>

     <!-- Data Tables -->
     <script src="/assets/js/plugins/dataTables/jquery.dataTables.js"></script>
     <script src="/assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>
     <script src="/assets/js/plugins/dataTables/dataTables.responsive.js"></script>
     <script src="/assets/js/plugins/dataTables/dataTables.tableTools.min.js"></script>

     <!-- Custom and plugin javascript -->
     <script src="/assets/js/inspinia.js"></script>
     <script src="/assets/js/plugins/pace/pace.min.js"></script>
     <script type="text/javascript" src="/swal/dist/sweetalert.min.js"></script>

     <!-- Page-Level Scripts -->
     <script>
     $(document).ready(function()
     {
        $('.dataTables-example').dataTable(
        {
           responsive: true,
     // "dom": 'T<"clear">lfrtip',
           "tableTools":
           {
               "sSwfPath": "/assets/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
           },
         //   columnDefs:
         //   [{
         //      orderable: false, targets: -1
         //   }]
        });

        $(".check").click(function()
       {
          var url=$(this).data('href');
          var supname = this.id;
          if(url != "")
          {
             swal(
             {
                title: "Hapus Supplier",
                text: "hapus "+supname+"? semua barang dengan supplier ini akan dihapus secara otomatis",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Lanjut",
                closeOnConfirm: false,
                showLoaderOnConfirm: false,
             },function()
             {
                swal(
   				{
   					title: "Konfirmasi Penghapusan "+supname,
   					text: "Silahkan Ketik 'HAPUS'",
   					type: "input",
   					showCancelButton: true,
   					closeOnConfirm: false,
   					animation: "slide-from-top",
   					inputPlaceholder: "Silahkan Ketik 'HAPUS'",
   					showLoaderOnConfirm: true,
   				},function(inputValue)
   				{
   					if (inputValue === false) return false;
   					if (inputValue != "HAPUS")
   					{
   						swal.showInputError("Silahkan Ketik 'HAPUS' ");
   						return false
   					}
   					else
   					{
   						$.ajax(
   		            {
   		               type: "get",
   		               url: url,
   		               // data: url,
   		               success: function(data)
   		               {
   		               }
   		            }).done(function(data)
   		            {
                        var obj = jQuery.parseJSON(data);
                        if(obj.err == false)
                        {
                           swal(
                              {
                                 title: "Success",
                                 text: obj.msg,
                                 type: "success",
                                 showCancelButton: false,
                                 // confirmButtonColor: "#DD6B55",
                                 confirmButtonText: "OK",
                                 closeOnConfirm: false
                              }, function()
                              {
                                 window.location.href = window.location.href;
                                 // location.reload();
                              });
                        }
                        else
                        {
                           swal(
                              {
                                 title: "Gagal",
                                 text: obj.msg,
                                 type: "warning",
                                 showCancelButton: false,
                                 // confirmButtonColor: "#DD6B55",
                                 confirmButtonText: "OK",
                                 closeOnConfirm: true
                              });
                        }
   		            }).error(function(data)
   		            {
   		               swal("Oops", "We couldn't connect to the server!", "error");
   		            });
   					}

   				});
             });
          }
       });
     });
     </script>
@endsection
