@extends('layouts.wrapper.list')

@section('list')
   <table class="table table-stripped table-bordered table-hover dataTable table-list">
      <thead>
         <tr>
            <th>No.</th>
            <th>ID Invoice</th>
            <th>Total</th>
            <th>Status</th>
            <th>Tanggal Piutang</th>
            <th>Tanggal Pelunasan</th>
            <th colspan="2">Detail</th>
         </tr>
      </thead>
      <tbody>
        <?php $i = 1?>
         @foreach($piutangs as $ptg)
           <?php
              if ($ptg->created_at == $ptg->updated_at)
              {
                $pelunasan = '-';
              }
              else
              {
                $pelunasan = $ptg->updated_at;
              }
           ?>
            @if ($ptg->status == 0)
              <?php
                $ptg->status = "Belum Lunas";
                $check = true;
                ?>
              <tr class="danger">
            @else
              <?php
                $ptg->status = "Lunas";
                $check = false;
                ?>
              <tr class="success">
            @endif
               <td>{{$i++}}</td>
               <td>{{$ptg->invoice_id}}</td>
               <td>{{$ptg->status}}</td>
               <td>Rp. {{number_format($ptg->total,2,',','.')}}</td>
               <td>{{$ptg->created_at}}</td>
               <td>{{$pelunasan}}</td>
               <td><a href="{{url('invoice/show/'.DB::table('invoice_parents')->where('invoice_id',$ptg->invoice_id)->pluck('id')[0])}}"><i class="fa fa-eye"></i> Detail Invoice</a></td>
               <td>
                 @if ($check == true)
                   <a href="{{url('piutang/check/'.$ptg->id)}}"><i class="fa fa-square-o"></i> Pelunasan</a>
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
