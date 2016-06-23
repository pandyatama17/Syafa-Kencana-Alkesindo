@extends('layouts.wrapper.main')

@section('main')
<form action="{{action('DeliveryOrderController@store')}}" method="post">
   <div class="row white-bg">
      <div class="col-xs-12">&nbsp;</div>

      <div class="col-xs-2">
         <img src="{{asset('img/SKA.png')}}" alt="SKA Logo" />
      </div>

      <div class="col-xs-6">
         {{-- <h1>Syafa Kencana Alkesindo <small>Purchase Order</small></h1> --}}
         <h1>Delivery Order</h1>
      </div>

      <div class="col-xs-4">
         <table>
            <tr>
               <td>Delivery Order # </td>
               <td>&nbsp;:&nbsp;</td>
               <td>
                  <input type="text" class="form-control" name="parent_id"/>
               </td>
            </tr>
            <tr>
               <td>Tanggal DO </td>
               <td>&nbsp;:&nbsp;</td>
               <td>
                  <input type="text" class="form-control datepicker" name="date" id="date"/>
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
               <td>
                  <select class="chosen-select form-control" name="customer_id" onchange="getCustomerDetails(this.value)">
                     <option selected disabled>Pilih Customer</option>
                     @foreach($customers as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                     @endforeach
                  </select>
               </td>
            </tr>
            <tr>
               <td>
                  <textarea name="customer_address" id="customer_address" class="form-control" rows="3" cols="30"></textarea>
               </td>
            </tr>
         </table>
      </div>

      <div class="col-xs-12 ">
         <table class="table-menu">
            <thead>
               <tr>
                  <th>Tanggal Pengiriman</th>
                  <th>Pembayaran</th>
                  <th>Jatuh Tempo</th>
                  <th>Sales</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>
                     <input type="text" class="form-control datepicker" name="delivery_date" id="delivery_date">
                  </td>
                  <td>
                     <select class="form-control chosen-select-disabled" name="payment">
                        <option value="transfer">Transfer</option>
                        <option value="cheque">Cek</option>
                        <option value="cash">Cash</option>
                     </select>
                  </td>
                  <td>
                     <input type="text" class="form-control datepicker" name="due_date" id="due_date">
                  </td>
                  <td>
                     <select class="form-control chosen-select" name="sales_id">
                        @foreach (DB::table('sales')->get() as $sales)
                          <option value="{{$sales->id}}">{{$sales->name}}</option>
                        @endforeach
                     </select>
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
                  <th class="menu-discount">Discount</th>
                  <th class="menu-subtotal">Jumlah</th>
               </tr>
            </thead>
            <tbody class="table-content">
               @for($i=1; $i <= 10 ; $i++)
                  <tr id="item{{$i}}">
                     <td class="content-row">{{$i}}</td>
                     <td class="select-container">
                        <select class="chosen-select form-control content-id" name="item_{{$i}}" onchange="getItem(this.value, {{$i}})">
                           <option selected disabled>Pilih Barang..</option>
                           @foreach($items as $it)
                              <option value="{{$it->id}}" class="option-{{$it->id}}">{{$it->name}}</option>
                           @endforeach
                        </select>
                     </td>
                     <td id="itemNameCol{{$i}}" class="content-name"></td>
                     <td id="itemPriceCol{{$i}}"></td>
                     <td id="itemQtyCol{{$i}}"></td>
                     <td id="itemDiscountCol{{$i}}" class="content-discount"></td>
                     <td id="itemSubtotalCol{{$i}}" class="content-subtotal"></td>
                     <td class="hidden-col" id="hiddenrow{{$i}}">
                       <input type="hidden" name="price{{$i}}" id="itemPriceField{{$i}}">
                       <input type="hidden" name="subtotal{{$i}}" id="itemSubtotalField{{$i}}">
                     </td>
                  </tr>
               @endfor
            </tbody>
            <tfoot>
              <th class="table-menu">
                <td colspan='4'></td>
                <td style="border-top:2px solid lightgrey"><span class="pull-right lead">Total : </span></td>
                <td style="border-top:2px solid lightgrey">
                  <span id="totalcost" class="pull-right lead"></span>
                </td>
              </th>
            </tfoot>
      </table>
   </div>
</div>
<input type="hidden" id="totalcostField" name="totalcost">
<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
<script src="{{asset('js/pages/deliveryorder/create.js')}}"></script>
@endsection
