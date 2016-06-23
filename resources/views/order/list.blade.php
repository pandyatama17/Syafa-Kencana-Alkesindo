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
         @foreach($orders as $o)
            <tr>
              <td>{{$i++}}</td>
               <td>{{$o->order_id}}</td>
               <td>{{DB::table('suppliers')->where('id', $o->supplier_id)->pluck('name')[0]}}</td>
               <td>{{$o->order_date}}</td>
               <td>{{$o->due_date}}</td>
               <td>{{$o->delivery_date}}</td>
               <td>Rp. {{number_format($o->total,2,',','.')}}</td>
               <td>{{$o->pic}}</td>
               <td><a href="{{url('order/show/'.$o->id)}}"><i class="fa fa-eye"></i> Detail Order</a></td>
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
