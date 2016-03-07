@extends('layouts.header')

@section('content')
{{-- <script src="/assets/jquery.dataTables.min.js" charset="utf-8"></script> --}}
<link rel="stylesheet" href="/swal/dist/sweetalert.css" media="screen" title="no title" charset="utf-8">
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-sm-4">
      <h2>Daftar User</h2>
         <ol class="breadcrumb">
            <li>
               <a href="{{url()}}">SKA</a>
            </li>
            <li>
               <a href="{{url('owner')}}">Owner</a>
            </li>
            <li>
               <a href="{{url('user/list')}}">User</a>
            </li>
            <li class="active">
               <strong>Daftar User</strong>
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
         <a href="{{url('user/add')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah User</a>
      </div>
   </div>
</div>
  <div class="row">
      <div class="col-lg-12">
          <div class="wrapper wrapper-content">
              <div class="box animated bounceInUp">

                      <table class="table table-striped table-bordered table-hover dataTables-example" >
                         <thead>
                         <tr>
                            <th style="background:#16a085; color:white;">#</th>
                             <th style="background:#16a085; color:white;">Username</th>
                             <th style="background:#16a085; color:white;">Nama</th>
                             <th style="background:#16a085; color:white;">Alamat</th>
                             <th style="background:#16a085; color:white;">Tempat/Tgl. Lahir</th>
                             <th style="background:#16a085; color:white;">Level User</th>
                             {{-- <th class="choices" style="background:#16a085; color:white;">Pilihan</th> --}}
                         </tr>
                         </thead>
                         <tbody>
                            @foreach($users as $user)
                               <tr class="clickableRow" data-href="{{url('user/show/'.$user->id)}}">
                                  <td><strong>{{$user->id}}</strong></td>
                                  <td><strong>{{$user->username}}</strong></td>
                                  <td>{{$user->name}}</td>
                                  <td>{{$user->address}}</td>
                                  <td>{{$user->birthplace}}, {{$user->birthdate}}</td>
                                  <td>
                                     @if($user->user_level == 'owner')
                                        <span style="color:red">Owner</span>
                                     @elseif($user->user_level == 'admin')
                                        <span style="color:orange">Admin</span>
                                     @elseif($user->user_level == 'gudang')
                                        <span style="color:blue">Gudang</span>
                                     @else
                                        {{$user->user_level}}
                                     @endif
                                  </td>
                               </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                           <th style="background:#16a085; color:white;">#</th>
                           <th style="background:#16a085; color:white;">Username</th>
                           <th style="background:#16a085; color:white;">Nama</th>
                           <th style="background:#16a085; color:white;">Alamat</th>
                           <th style="background:#16a085; color:white;">Tempat/Tgl. Lahir</th>
                           <th style="background:#16a085; color:white;">Level User</th>
                           {{-- <th style="background:#16a085; color:white;">Pilihan</th> --}}
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
      // columnDefs:
      // [{
      //    orderable: false, targets: -1
      // }]
   });

   $(".clickableRow").click(function()
   {
      var url = $(this).data('href');

      window.location.href = url;
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
