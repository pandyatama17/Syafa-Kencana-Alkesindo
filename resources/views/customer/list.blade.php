@extends('layouts.wrapper.list')

@section('list')
   <table class="table table-stripped table-bordered table-hover dataTable table-list">
      <thead>
         <tr>
            <th>ID Customer</th>
            <th>Nama</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
            {{-- <th>Transaksi Terakhir</th> --}}
         </tr>
      </thead>
      <tbody>
         @foreach($customers as $c)
            <tr>
               <td>{{$c->customer_id}}</td>
               <td>{{$c->name}}</td>
               <td>{{$c->phone}}</td>
               <td>{{$c->address}}</td>
               {{-- <td>{{DB::table('invoice_parents')->where('customer_id', $c->id)->orderBy('updated_at')->pluck('updated_at')}}</td> --}}
            </tr>
         @endforeach
      </tbody>
      <tfoot>
         <tr>
            <th>ID Customer</th>
            <th>Nama</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
            {{-- <th>Transaksi Terakhir</th> --}}
         </tr>
      </tfoot>
   </table>
@endsection
