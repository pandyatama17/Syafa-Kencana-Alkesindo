@extends('layouts.wrapper.main')

@section('main')
<form action="{{action('ItemController@inStore')}}" method="post">
   <div class="row white-bg">
      <div class="col-xs-12">&nbsp;</div>

      <div class="col-xs-12 ">
         <table class="table-menu">
            <thead>
               <tr>
                  <th colspan="2">Purchase Order</th>
                  <th colspan="2">Delivery Customer Supplier</th>
                  <th>Tanggal</th>
                  <th>Supplier</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td colspan="2">
                    <select class="form-control chosen-select" name="order_id">
                       @foreach ($orders as $o)
                         <option value="{{$o->id}}">{{$o->order_id}}</option>
                       @endforeach
                    </select>
                    {{-- <input type="text" name="order_id" class="form-control"> --}}
                  </td>
                  <td colspan="2">
                    <input type="text" name="supplier_do" class="form-control">
                  </td>
                  <td>
                     <input type="text" class="form-control datepicker" name="date" id="date">
                  </td>
                  <td>
                    <select class="form-control chosen-select" name="supplier_id" id="supplier_id">
                       @foreach ($suppliers as $s)
                         <option value="{{$s->id}}">{{$s->name}}</option>
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
                  <th class="menu-qty">Qty.</th>
               </tr>
            </thead>
            <tbody class="table-content">
               @for($i=1; $i <= 10 ; $i++)
                  <tr id="item{{$i}}">
                     <td class="content-row">{{$i}}</td>
                     <td class="select-container">
                        <select class="chosen-select form-control content-id" name="item_{{$i}}" onchange="getItem(this.value, {{$i}})" style="width: 300px">
                           <option selected disabled>Pilih Barang..</option>
                           @foreach($items as $it)
                              <option value="{{$it->id}}" class="option-{{$it->id}}">{{$it->name}}</option>
                           @endforeach
                        </select>
                     </td>
                     <td id="itemNameCol{{$i}}"></td>
                     <td id="itemQtyCol{{$i}}"></td>
                     <td class="hidden-col" id="hiddenrow{{$i}}">
                       <input type="hidden" name="price{{$i}}" id="itemPriceField{{$i}}">
                       <input type="hidden" name="subtotal{{$i}}" id="itemSubtotalField{{$i}}">
                     </td>
                  </tr>
               @endfor
            </tbody>
      </table>
   </div>
</div>
<input type="hidden" id="totalcostField" name="total">
<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
<script src="{{asset('js/pages/item/in.js')}}"></script>
@endsection
