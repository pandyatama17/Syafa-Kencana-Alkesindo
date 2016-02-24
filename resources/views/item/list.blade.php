@extends('layouts.header')

@section('content')
{{-- <script src="/assets/jquery.dataTables.min.js" charset="utf-8"></script> --}}
<link rel="stylesheet" href="/swal/dist/sweetalert.css" media="screen" title="no title" charset="utf-8">
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-sm-4">
      <h2>Daftar Barang</h2>
         <ol class="breadcrumb">
            <li>
               <a href="{{url()}}">SKA</a>
            </li>
            <li>
               <a href="#" id="UserToggle">Gudang</a>
            </li>
            <li class="active">
               <strong>Daftar Barang</strong>
            </li>
         </ol>
   </div>
   <script type="text/javascript">
      $("#UserToggle").click(function()
      {
         $("#NavbarUser").click();
      });
   </script>
   <div class="col-sm-8">
      <div class="title-action">
         <a href="{{url('/storage/add')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Barang</a>
      </div>
   </div>
</div>
  <div class="row">
      <div class="col-lg-12">
          <div class="wrapper wrapper-content">
              <div class="box animated bounceInUp">
                  <h3 class="font-bold">Daftar Barang</h3>

                      <table class="table table-striped table-bordered table-hover dataTables-example" >
                         <thead>
                         <tr>
                             <th style="background:#16a085; color:white;">ID Barang</th>
                             <th style="background:#16a085; color:white;">Nama Barang</th>
                             <th style="background:#16a085; color:white;">Stok</th>
                             <th style="background:#16a085; color:white;">Supplier</th>
                             <th style="background:#16a085; color:white;">Harga Supplier</th>
                             <th style="background:#16a085; color:white;">Harga Jual</th>
                             <th style="background:#16a085; color:white;">Barang Masuk</th>
                             <th class="choices" style="background:#16a085; color:white;">Pilihan</th>
                         </tr>
                         </thead>
                         <tbody>
                            @foreach($items as $res)
                               <tr class="clickableRow" data-href="{{url()}}/storage/show/{{$res->id}}" data-qty="{{$res->qty}}" data-item="{{$res->id}}">
                                  <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif><strong>{{$res->id}}</strong></td>
                                  <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif style="width:230px">{{$res->item_name}}</td>
                                  <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif>{{$res->qty}}</td>
                                  <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif>{{DB::table('supplier')->where('id', $res->supplier_id)->pluck('supplier_name')}}</td>
                                  <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif>Rp.{!! number_format ($res->supplier_price, 2, ',', '.') !!}</td>
                                  <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif>Rp.{!! number_format ($res->resell_price, 2, ',', '.') !!}</td>
                                  <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif>{{$res->last_restock_date}}</td>
                                  <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif>
                                      <a @if($res->qty == 0) style="background:#e74c3c; color:white" @endif href="/storage/show/{{$res->id}}" class="secondary-content">
                                         {{--Barang Masuk--}}<i class="fa fa-eye"></i>
                                      </a>|
                                      <a @if($res->qty == 0) style="background:#e74c3c; color:white" @endif href="/storage/restock/{{$res->id}}" class="secondary-content">
                                      {{--Barang Masuk--}}<i class="fa fa-sign-in"></i>
                                    </a>
                                    {{-- |
                                      @if ($res->qty != 0)
                                         <a href="/deliveryorder/create" class="secondary-content">
                                            <i class="fa fa-sign-out"></i>
                                         </a>
                                      @else
                                         <a style="color:#f1c40f" class="secondary-content" href="#"><i class="fa fa-sign-out"></i></a>
                                      @endif --}}
                                   </td>
                               </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                           <th style="background:#16a085; color:white;">ID Barang</th>
                           <th style="background:#16a085; color:white;">Nama Barang</th>
                           <th style="background:#16a085; color:white;">Stok</th>
                           <th style="background:#16a085; color:white;">Supplier</th>
                           <th style="background:#16a085; color:white;">Harga Supplier</th>
                           <th style="background:#16a085; color:white;">Harga Jual</th>
                           <th style="background:#16a085; color:white;">Barang Masuk</th>
                           <th style="background:#16a085; color:white;">Pilihan</th>
                        </tr>
                        </tfoot>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      {{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}




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
      columnDefs:
      [{
         orderable: false, targets: -1
      }]
   });

   $(".clickableRow").click(function()
   {
      var url = $(this).data('href');
      var qty = $(this).data('qty');
      var item = $(this).data('item');

      if (qty == "0")
      {
         swal(
         {
            title: "Warning",
            text: "Stok barang kosong! silahkan laukan pemesanan barang untuk "+item,
            type: "warning",
            showCancelButton: false,
            // confirmButtonColor: "#DD6B55",
            confirmButtonText: "Lanjut",
            closeOnConfirm: false
         }, function()
         {
            window.location.href = url;
         });
      }
      else
      {
         window.location.href = url;
      }
   });

/* Init DataTables */
// var oTable = $('#editable').dataTable();
//
// /* Apply the jEditable handlers to the table */
// oTable.$('td').editable( '../example_ajax.php', {
// "callback": function( sValue, y ) {
//     var aPos = oTable.fnGetPosition( this );
//     oTable.fnUpdate( sValue, aPos[0], aPos[1] );
// },
// "submitdata": function ( value, settings ) {
//     return {
//         "row_id": this.parentNode.getAttribute('id'),
//         "column": oTable.fnGetPosition( this )[2]
//     };
// },
//
// "width": "90%",
// "height": "100%"
// } );


});

function fnClickAddRow() {
$('#editable').dataTable().fnAddData( [
"Custom row",
"New row",
"New row",
"New row",
"New row" ] );

}
</script>
<style>
body.DTTT_Print {
background: #fff;

}
.DTTT_Print #page-wrapper {
margin: 0;
background:#fff;
}

button.DTTT_button, div.DTTT_button, a.DTTT_button {
border: 1px solid #e7eaec;
background: #fff;
color: #676a6c;
box-shadow: none;
padding: 6px 8px;
}
button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
border: 1px solid #d2d2d2;
background: #fff;
color: #676a6c;
box-shadow: none;
padding: 6px 8px;
}

.dataTables_filter label {
margin-right: 5px;

}
tr
{
      cursor: pointer;
}
</style>
<script type="text/javascript">
$(document).ready(function()
{
   $(".supplier_price").text(function()
   {
      $(this).text(rupiah($(this).text()));
   });
   $(".resell_price").text(function()
   {
      $(this).text(rupiah($(this).text()));
   });

   $('.clickable').click(function(){ swal("Failed!", "Stok barang tidak tersedia!", "error")})
})
</script>
@endsection
