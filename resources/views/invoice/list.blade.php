@extends('layouts.header')

@section('content')
<script src="/assets/jquery.dataTables.min.js" charset="utf-8"></script>
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-sm-4">
      <h2>Data Invoice</h2>
         <ol class="breadcrumb">
            <li>
               <a href="{{url()}}">SKA</a>
            </li>
            <li>
               <a href="{{url('finance')}}">Finance</a>
            </li>
            <li class="active">
               <strong>Invoice</strong>
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
              <div class="box animated fadeInRightBig">
                  <h3 class="font-bold">Invoices</h3>

                      <table class="table table-striped table-bordered table-hover dataTables-example" >
                         <thead>
                         <tr>
                             <th>Invoice ID</th>
                             <th>Invoice Date</th>
                             <th>Due Date</th>
                             <th>Delivery Date</th>
                             <th>Client Name</th>
                             <th>Client Address</th>
                             <th>Sales</th>
                             <th>Payment</th>
                             <th>PIC</th>
                         </tr>
                         </thead>
                         <tbody>
                            @foreach($ivs as $iv)
                               <tr>
                                  <td><strong>{{$iv->id}}</strong></td>
                                  <td>{{$iv->invoice_date}}</td>
                                  <td>{{$iv->due_date}}</td>
                                  <td>{{$iv->delivery_date}}</td>
                                  <td>{{$iv->client_name}}</td>
                                  <td>{{$iv->client_address}}</td>
                                  <td>{{$iv->sales}}</td>
                                  <td>{{$iv->payment}}</td>
                                  <td>{{$iv->PIC}}</td>
                               </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                           <th>Invoice ID</th>
                           <th>Invoice Date</th>
                           <th>Due Date</th>
                           <th>Delivery Date</th>
                           <th>Client Name</th>
                           <th>Client Address</th>
                           <th>Sales</th>
                           <th>Payment</th>
                           <th>PIC</th>
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

<!-- Page-Level Scripts -->
<script>
$(document).ready(function() {
$('.dataTables-example').dataTable({
responsive: true,
// "dom": 'T<"clear">lfrtip',
"tableTools": {
    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
}
});

/* Init DataTables */
var oTable = $('#editable').dataTable();

/* Apply the jEditable handlers to the table */
oTable.$('td').editable( '../example_ajax.php', {
"callback": function( sValue, y ) {
    var aPos = oTable.fnGetPosition( this );
    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
},
"submitdata": function ( value, settings ) {
    return {
        "row_id": this.parentNode.getAttribute('id'),
        "column": oTable.fnGetPosition( this )[2]
    };
},

"width": "90%",
"height": "100%"
} );


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
</style> @endsection
