@extends('layouts.wrapper.list')

@section('list')
<table class="table table-striped table-bordered table-hover dataTable" >
   <thead>
      <tr>
          <th style="background:#34495e; color:white;">ID Barang</th>
          <th style="background:#34495e; color:white;">Nama Barang</th>
          <th style="background:#34495e; color:white;">Stok</th>
          <th style="background:#34495e; color:white;">Supplier</th>
          <th style="background:#34495e; color:white;">Harga Supplier</th>
          <th style="background:#34495e; color:white;">Harga Jual</th>
          <th style="background:#34495e; color:white;">Barang Masuk</th>
          <th class="choices" style="background:#34495e; color:white;">Pilihan</th>
       </tr>
   </thead>
   <tbody>
      @foreach($items as $res)
      <tr class="clickableRow" data-href="/storage/show/{{$res->id}}" data-qty="{{$res->qty}}" data-item="{{$res->id}}">
         <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif><strong>{{$res->id}}</strong></td>
         <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif style="width:230px">{{$res->name}}</td>
         <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif>{{$res->qty}}</td>
         <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif>{{DB::table('suppliers')->where('id', $res->supplier_id)->pluck('name')[0]}}</td>
         <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif>Rp.{!! number_format ($res->supplier_price, 2, ',', '.') !!}</td>
         <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif>Rp.{!! number_format ($res->resell_price, 2, ',', '.') !!}</td>
         <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif>{{$res->updated_at}}</td>
         <td @if($res->qty == 0) style="background:#e74c3c; color:white" @endif>
            <a @if($res->qty == 0) style="background:#e74c3c; color:white" @endif href="/item/show/{{$res->id}}" class="secondary-content">
               <i class="fa fa-eye"></i> Details
            </a>
         </td>
      </tr>
      @endforeach
   </tbody>
   <tfoot>
      <tr>
         <th style="background:#7f8c8d; color:white;">ID Barang</th>
         <th style="background:#7f8c8d; color:white;">Nama Barang</th>
         <th style="background:#7f8c8d; color:white;">Stok</th>
         <th style="background:#7f8c8d; color:white;">Supplier</th>
         <th style="background:#7f8c8d; color:white;">Harga Supplier</th>
         <th style="background:#7f8c8d; color:white;">Harga Jual</th>
         <th style="background:#7f8c8d; color:white;">Barang Masuk</th>
         <th style="background:#7f8c8d; color:white;">Pilihan</th>
      </tr>
   </tfoot>
</table>
@endsection
