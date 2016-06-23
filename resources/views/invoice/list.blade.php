@extends('layouts.wrapper.list')

@section('list')
   <table class="table table-stripped table-bordered table-hover dataTable table-list">
      <thead>
         <tr>
           <th>No.</th>
            <th>ID Purchase Order</th>
            <th>Supplier</th>
            <th>Tanggal Order</th>
            <th>Jatuh Tempo</th>
            <th>Tanggal Pengiriman</th>
            <th>Total</th>
            <th>Admin</th>
            <th>Detail</th>
         </tr>
      </thead>
      <tbody>
        <?php $i = 1?>
         @foreach($invoices as $iv)
            <tr>
              <td>{{$i++}}</td>
               <td>{{$iv->invoice_id}}</td>
               <td>{{DB::table('customers')->where('id', $iv->customer_id)->pluck('name')[0]}}</td>
               <td>{{$iv->invoice_date}}</td>
               <td>{{$iv->due_date}}</td>
               <td>{{$iv->delivery_date}}</td>
               <td>Rp. {{number_format($iv->total,2,',','.')}}</td>
               <td>{{DB::table('users')->where('id', $iv->pic)->pluck('name')[0]}}</td>
               <td><a href="{{url('invoice/show/'.$iv->id)}}"><i class="fa fa-eye"></i> Detail Invoice</a></td>
            </tr>
         @endforeach
      </tbody>
      {{-- <tfoot>
         <tr>
            <th>ID Customer</th>
            <th>Nama</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
            <th>Transaksi Terakhir</th>
         </tr>
      </tfoot> --}}
   </table>
@endsection
