
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
               {{-- <li>
						<a href="{{url()}}/storage">Gudang</a>
					</li> --}}
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
                          <th style="background:#27ae60; color:white;">ID Supplier</th>
                          <th style="background:#27ae60; color:white;">Nama Supplier</th>
                          <th style="background:#27ae60; color:white;">Tanggal Restok Terakhir</th>
                          <th style="background:#27ae60; color:white;">Barang Restok Terakhir</th>
                          {{-- <th class="choices" style="background:#27ae60; color:white;">Pilihan</th> --}}
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
                                     @if(isset($res->last_supply_item_id) || $res->last_supply_item_id == '0')
                                        {!! $res->last_supply_item_id !!}
                                     @else
                                        -
                                     @endif
                                  </td>
                                </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th style="background:#27ae60; color:white;">ID Supplier</th>
                        <th style="background:#27ae60; color:white;">Nama Supplier</th>
                        <th style="background:#27ae60; color:white;">Tanggal Restok Terakhir</th>
                        <th style="background:#27ae60; color:white;">Barang Restok Terakhir</th>
                        {{-- <th class="choices" style="background:#27ae60; color:white;">Pilihan</th> --}}
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

      //   $("tr").click(function()
      //   {
      //      var url = $(this).data('href');
      //      var qty = $(this).data('qty');
      //      var item = $(this).data('item');
        //
      //      if (qty == "0")
      //      {
      //         swal(
      //         {
      //            title: "Warning",
      //            text: "Stok barang kosong! silahkan laukan pemesanan barang untuk "+item,
      //            type: "warning",
      //            showCancelButton: false,
      //            // confirmButtonColor: "#DD6B55",
      //            confirmButtonText: "Lanjut",
      //            closeOnConfirm: false
      //         }, function()
      //         {
      //            window.location.href = url;
      //         });
      //      }
      //      else
      //      {
      //         window.location.href = url;
      //      }
      //   });
     });
     </script>
@endsection
