@extends('layouts.wrapper.list')

@section('list')
   <table class="table table-stripped table-bordered table-hover dataTable table-list">
      <thead>
         <tr>
            <th>No.</th>
            <th>ID PO</th>
            <th>Total</th>
            <th>Status</th>
            <th>Tanggal Piutang</th>
            <th>Tanggal Pelunasan</th>
            <th colspan="2">Detail</th>
         </tr>
      </thead>
      <tbody>
        <?php $i = 1?>
         @foreach($hutangs as $htg)
           <?php
              if ($htg->created_at == $htg->updated_at)
              {
                $pelunasan = '-';
              }
              else
              {
                $pelunasan = $htg->updated_at;
              }
           ?>
            @if ($htg->status == 0)
              <?php
                $htg->status = "Belum Lunas";
                $check = true;
                ?>
              <tr class="danger">
            @else
              <?php
                $htg->status = "Lunas";
                $check = false;
                ?>
              <tr class="success">
            @endif
               <td>{{$i++}}</td>
               <td>{{$htg->order_id}}</td>
               <td>{{$htg->status}}</td>
               <td>Rp. {{number_format($htg->total,2,',','.')}}</td>
               <td>{{$htg->created_at}}</td>
               <td>{{$pelunasan}}</td>
               <td><a href="{{url('po/show/'.$htg->po_id)}}"><i class="fa fa-eye"></i> Detail Invoice</a></td>
               <td>
                 @if ($check == true)
                   <a href="{{url('hutang/check/'.$htg->id)}}"><i class="fa fa-square-o"></i> Pelunasan</a>
                 @else
                   <a><i class="fa fa-check-square-o"></i> Pelunasan</a>
                 @endif
               </td>
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
