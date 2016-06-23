@extends('layouts.wrapper.main')

@section('main')
  <script src="{{asset('js/plugins/printarea/jquery.PrintArea.js')}}" type="text/JavaScript" language="javascript"></script>
   <div class="row white-bg" id="printarea">
      <div class="col-xs-12">&nbsp;</div>

      <div class="col-xs-2">
         <img src="{{asset('img/SKA.png')}}" alt="SKA Logo" />
      </div>

      <div class="col-xs-6">
         {{-- <h1>Syafa Kencana Alkesindo <small>Purchase do</small></h1> --}}
         <h1>Delivery Order</h1>
      </div>

      <div class="col-xs-4">
         <table>
            <tr>
               <td style="padding-right:15px; padding-top:5px; padding-bottom:3px">DO # </td>
               <td>&nbsp;:&nbsp;</td>
               <td style="padding-left:15px; padding-right:15px padding-top:3px; padding-bottom:3px">
                  {{$deliveryorder->do_id}}
               </td>
            </tr>
            <tr>
               <td style="padding-right:15px; padding-top:5px; padding-bottom:3px">Tanggal DO </td>
               <td>&nbsp;:&nbsp;</td>
               <td style="padding-left:15px; padding-right:15px padding-top:3px; padding-bottom:3px">
                 {{$deliveryorder->do_date}}
               </td>
            </tr>
         </table>
      </div>

      <div class="col-xs-12">&nbsp;</div>

      <div class="col-xs-4">
         <p>
            Perkantoran Pulomas 1, gedung 4 lt. 3 ruang 12A<br>
            sJl. Jend A. Yani No. 2, Pulomas - Kayu Putih, Jaktim<br>
            Telp/Fax: +62 21 2984 7910<br>
            Email: marketing@syafakencana.com
         </p>
      </div>

      <div class="col-xs-4 col-xs-offset-4">
         <table>
            <tr>
               <td colspan="3">kepada yth,</td>
            </tr>
            <tr>
               <td style="padding-top:5px;">
                 {{DB::table('customers')->where('id', $deliveryorder->customer_id)->pluck('name')[0]}}
               </td>
            </tr>
            <tr>
               <td style="padding-top:5px;">
                  {{DB::table('customers')->where('id', $deliveryorder->customer_id)->pluck('address')[0]}}
               </td>
            </tr>
         </table>
      </div>

      <div class="col-xs-12 ">
         <table class="table-menu">
            <thead>
               <tr>
                  <th style="padding-right:40px;">Tanggal Pengiriman</th>
                  <th style="padding-right:40px;">Pembayaran</th>
                  <th style="padding-right:40px;">Jatuh Tempo</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>
                    {{$deliveryorder->delivery_date}}
                  </td>
                  <td>
                    {{$deliveryorder->payment}}
                  </td>
                  <td>
                    {{$deliveryorder->due_date}}
                  </td>
               </tr>
            </tbody>
         </table>
      </div>

      <div class="col-xs-12">&nbsp;</div>

      <div class="col-xs-12">
         <table class="table table-menu">
            <thead>
               <tr>
                  <th class="menu-row">No</th>
                  <th>Kode Barang</th>
                  <th class="menu-name">Nama Barang</th>
                  <th class="menu-price">Harga Satuan</th>
                  <th class="menu-qty">Qty.</th>
                  <th class="menu-subtotal">Jumlah</th>
               </tr>
            </thead>
            <tbody class="table-content">
              <?php $i = 1;?>
               @foreach($childs as $c)
                  <tr>
                     <td class="content-row" style="padding-top:10px; padding-bottom:10px">{{$i++}}</td>
                     <td style="padding-top:10px; padding-bottom:10px">{{DB::table('items')->where('id', $c->item_id)->pluck('item_id')[0]}}</td>
                     <td id="itemNameCol{{$i}}" style="padding-top:10px; padding-bottom:10px">{{DB::table('items')->where('id', $c->item_id)->pluck('name')[0]}}</td>
                     <td id="itemPriceCol{{$i}}" style="padding-top:10px; padding-bottom:10px">Rp. {{number_format(DB::table('items')->where('id', $c->item_id)->pluck('supplier_price')[0],2,'.',',')}}</td>
                     <td id="itemQtyCol{{$i}}" style="padding-top:10px; padding-bottom:10px">{{$c->qty}}</td>
                     <td id="itemSubtotalCol{{$i}}" class="content-subtotal" style="padding-top:10px; padding-bottom:10px">Rp. {{number_format($c->subtotal,2,',','.')}}</td>
                  </tr>
               @endforeach
            </tbody>
            <tfoot>
              <th class="table-menu">
                <td colspan='3'></td>
                <td style="bdo-top:2px solid lightgrey"><span class="pull-right lead">Total : </span></td>
                <td style="bdo-top:2px solid lightgrey">
                  <span id="totalcost" class="pull-right lead">Rp. {{number_format($deliveryorder->total,2,',','.')}}</span>
                </td>
              </th>
            </tfoot>
         </table>
      </div>
   </div>
   <input type="hidden" id="totalcost_inp" name="totalcost">
   <input type="hidden" name="_token" value="{{csrf_token()}}">
@endsection
