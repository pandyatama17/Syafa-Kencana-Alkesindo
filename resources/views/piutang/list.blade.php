@extends('layouts.header')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-sm-4">
      <h2>Data Invoice</h2>
         <ol class="breadcrumb">
            <li>
               <a href="{{url()}}">SKA</a>
            </li>
            <li>
               @if(Session::get('user')->user_level == 'admin')
                  <a href="{{url('finance')}}">Finance</a>
               @elseif(Session::get('user')->user_level == 'owner')
                  <a href="{{url('owner')}}">Owner</a>
               @endif
            </li>
            <li class="active">
               <strong>{{$pagin}}</strong>
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
                  {{-- <h3 class="font-bold">Invoices</h3> --}}

                      <table class="table table-striped table-bordered table-hover dataTables-example" >
                         <thead>
                         <tr>
                             <th style="background-color:#2c3e50;color:white;width:20px">#</th>
                             <th style="background-color:#2c3e50;color:white">Invoice #</th>
                             <th style="background-color:#2c3e50;color:white">Tanggal Piutang</th>
                             <th style="background-color:#2c3e50;color:white">Jatuh Tempo</th>
                             <th style="background-color:#2c3e50;color:white">Total</th>
                             <th style="background-color:#2c3e50;color:white">Status</th>
                             <th style="background-color:#2c3e50;color:white">Pilihan</th>
                         </tr>
                         </thead>
                         <tbody>
                            @foreach($ptgs as $ptg)
                               <?php
                                  $datenowarr = explode("-",date('Y-m-d'));
                                  $datenow = $datenowarr[0].$datenowarr[1].$datenowarr[2];

                                  $duedatearr = explode("-",$ptg->due_date);
                                  $duedate = $duedatearr[0].$duedatearr[1].$duedatearr[2];

                                  $duedays = $datenow - $duedate;

                                  $cssclass = "";

                                  if($duedays >= 0 && $ptg->status == 'pending')
                                  {
                                     $ptg->status = 'Lewat Tempo';
                                     $cssclass = 'background-color:rgb(192, 57, 43);color:rgb(236, 240, 241)';
                                  }
                              //  print_r($ptg->status)
                               ?>
                               <tr>
                                  <td style="{{$cssclass}}"><strong>{{$ptg->id}}</strong></td>
                                  <td style="{{$cssclass}}">{{$ptg->invoice_parent_id}}</td>
                                  <td style="{{$cssclass}}">{{$ptg->date}}</td>
                                  <td style="{{$cssclass}}">{{$ptg->due_date}}</td>
                                  <td style="{{$cssclass}}">Rp. {{ number_format ($ptg->total, 2, ',', '.') }}</td>
                                  <td style="{{$cssclass}}">
                                     @if($ptg->status == 'pending')
                                       <span style="color:#d35400">{{$ptg->status}}</span>
                                    @elseif($ptg->status == 'Lewat Tempo')
                                        <span>{{$ptg->status}}</span>
                                     @else
                                        <span style="color:#2980b9">{{$ptg->status}}</span>
                                     @endif
                                  </td>
                                  <td style="{{$cssclass}}">
                                     <a href="{{url('invoice/show/'.$ptg->invoice_parent_id)}}">
                                        <i class="fa fa-file-text"></i>
                                     </a>
                                     @if($pagin != "Piutang Lunas")
                                        |<a class="check" id="{{$ptg->invoice_parent_id}}" data-href="@if($ptg->status != 'ok') {{url('piutang/check/'.$ptg->id)}}@endif">
                                           <i class="checkicon
                                             @if($ptg->status != 'ok')
                                                fa fa-square-o
                                             @else
                                                fa fa-check-square-o
                                             @endif
                                          "></i>
                                        </a>
                                    @endif
                                  </td>
                               </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                           <th style="background-color:#2c3e50;color:white">#</th>
                           <th style="background-color:#2c3e50;color:white">Invoice #</th>
                           <th style="background-color:#2c3e50;color:white">Tanggal Piutang</th>
                           <th style="background-color:#2c3e50;color:white">Jatuh Tempo</th>
                           <th style="background-color:#2c3e50;color:white">Total</th>
                           <th style="background-color:#2c3e50;color:white">Status</th>
                           <th style="background-color:#2c3e50;color:white">Pilihan</th>
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
$(document).ready(function()
{
   $('.dataTables-example').dataTable(
   {
      responsive: true,
      // "dom": 'T<"clear">lfrtip',
      "tableTools":
      {
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
   $(".check").click(function()
   {
      var url=$(this).data('href');
      var invoice_parent_id = this.id;
      if(url != "")
      {
         swal(
         {
            title: "Pelunasan Piutang",
            text: "Lakuan pelunasan piutang untuk "+invoice_parent_id+"?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Lanjut",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
         },function()
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
               swal(
               {
                  title: "Success",
                  text: "Piutang telah dilunasi!",
                  type: "success",
                  showCancelButton: false,
                  // confirmButtonColor: "#DD6B55",
                  confirmButtonText: "OK",
                  closeOnConfirm: false
               }, function()
               {
                  window.location.href = "{{url('piutang/all')}}";
               });
               $('#orders-history').load(document.URL +  ' #orders-history');
            }).error(function(data)
            {
               swal("Oops", "We couldn't connect to the server!", "error");
            });
         });
      }
   });

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
