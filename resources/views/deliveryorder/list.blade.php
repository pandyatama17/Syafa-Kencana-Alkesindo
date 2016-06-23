@extends('layouts.wrapper.list')

@section('list')
   <table class="table table-stripped table-bordered table-hover dataTable table-list">
      <thead>
         <tr>
           <th>No.</th>
            <th>ID Delivery Order</th>
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
         @foreach($deliveryorders as $do)
            <tr>
              <td>{{$i++}}</td>
               <td>{{$do->do_id}}</td>
               <td>{{DB::table('customers')->where('id', $do->customer_id)->pluck('name')[0]}}</td>
               <td>{{$do->do_date}}</td>
               <td>{{$do->due_date}}</td>
               <td>{{$do->delivery_date}}</td>
               <td>Rp. {{number_format($do->total,2,',','.')}}</td>
               <td>{{DB::table('users')->where('id', $do->pic)->pluck('name')[0]}}</td>
               <td><a href="{{url('deliveryorder/show/'.$do->id)}}"><i class="fa fa-eye"></i> Detail DO</a></td>
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
