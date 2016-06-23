@extends('layouts.wrapper.list')

@section('list')
   <table class="table table-stripped table-bordered table-hover dataTable table-list">
      <thead>
         <tr>
            <th>ID Supplier</th>
            <th>Nama</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
            <th>Transaksi Terakhir</th>
         </tr>
      </thead>
      <tbody>
        <?php $i = 1?>
         @foreach($suppliers as $s)
            <tr>
               <td>{{$s->supplier_id}}</td>
               <td>{{$s->name}}</td>
               <td>{{$s->phone}}</td>
               <td>{{$s->address}}</td>
               <td>{{$s->last_supply_date}}</td>
            </tr>
         @endforeach
      </tbody>
      <tfoot>
         <tr>
            <th>ID Customer</th>
            <th>Nama</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
            <th>Transaksi Terakhir</th>
         </tr>
      </tfoot>
   </table>
@endsection
