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
               <a href="{{url('/storage')}}">Gudang</a>
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
   <style media="screen">
      .tablehead
      {
         background-color: #3498db;
         color:white
      }
   </style>
</div>
  <div class="row">
      <div class="col-lg-12">
          <div class="wrapper wrapper-content">
              <div class="box animated fadeInRightBig">
                  {{-- <h3 class="font-bold">Invoices</h3> --}}

                      <table class="table table-striped table-bordered table-hover dataTables-example" >
                         <thead>
                         <tr>
                             <th style="background-color: #3498db;color:white;">Invoice ID</th>
                             <th style="background-color: #3498db;color:white;">Invoice Date</th>
                             <th style="background-color: #3498db;color:white;">Due Date</th>
                             <th style="background-color: #3498db;color:white;">Delivery Date</th>
                             <th style="background-color: #3498db;color:white;">Client Name</th>
                             <th style="background-color: #3498db;color:white;">Client Address</th>
                             {{-- <th style="background-color: #3498db;color:white;">Sales</th> --}}
                             {{-- <th style="background-color: #3498db;color:white;">Payment</th> --}}
                             <th style="background-color: #3498db;color:white;">PIC</th>
                             <th style="background-color: #3498db;color:white;">Pilihan</th>
                         </tr>
                         </thead>
                         <tbody>
                            @foreach($ivs as $iv)
                               <tr data-href="{{url('/deliveryorder/create/base/'.$iv->id)}}">
                                  <td><strong>{{$iv->id}}</strong></td>
                                  <td>{{$iv->invoice_date}}</td>
                                  <td>{{$iv->due_date}}</td>
                                  <td>{{$iv->delivery_date}}</td>
                                  <td>{{$iv->client_name}}</td>
                                  <td>{{$iv->client_address}}</td>
                                  {{-- <td>{{$iv->sales}}</td> --}}
                                  {{-- <td>{{$iv->payment}}</td> --}}
                                  <td>{{DB::table('user')->where('id', $iv->PIC)->pluck('name')}}</td>
                                  <td>
                                     <a href="{{url('/deliveryorder/create/base/'.$iv->id)}}"><i class="fa fa-sign-out"></i></a>
                                  </td>
                               </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                           <th class="tablehead">Invoice ID</th>
                           <th class="tablehead">Invoice Date</th>
                           <th class="tablehead">Due Date</th>
                           <th class="tablehead">Delivery Date</th>
                           <th class="tablehead">Client Name</th>
                           <th class="tablehead">Client Address</th>
                           {{-- <th class="tablehead">Sales</th> --}}
                           {{-- <th class="tablehead">Payment</th> --}}
                           <th class="tablehead">PIC</th>
                           <th class="tablehead">Pilihan</th>
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

$("tr").click(function()
{
   var url = $(this).data('href');

   window.location.href = url;
});

});
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
