@extends('layouts.wrapper.main')

@section('main')
  <style media="print">
    .dscash
    {
      display: none;
    }
  </style>
  <script src="{{asset('js/plugins/printarea/jquery.PrintArea.js')}}" type="text/JavaScript" language="javascript"></script>
   <div class="row white-bg" id="printarea">
      <div class="col-xs-12">&nbsp;</div>

      <div class="col-xs-2">
         <img src="{{asset('img/SKA.png')}}" alt="SKA Logo" />
      </div>

      <div class="col-xs-6">
         {{-- <h1>Syafa Kencana Alkesindo <small>Purchase invoice</small></h1> --}}
         <h1>Invoice</h1>
      </div>

      <div class="col-xs-4">
         <table>
            <tr>
               <td style="padding-right:15px; padding-top:5px; padding-bottom:3px">Invoice # </td>
               <td>&nbsp;:&nbsp;</td>
               <td style="padding-left:15px; padding-right:15px padding-top:3px; padding-bottom:3px">
                  {{$invoice->invoice_id}}
               </td>
            </tr>
            <tr>
               <td style="padding-right:15px; padding-top:5px; padding-bottom:3px">Tanggal Invoice </td>
               <td>&nbsp;:&nbsp;</td>
               <td style="padding-left:15px; padding-right:15px padding-top:3px; padding-bottom:3px">
                 {{$invoice->invoice_date}}
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
            Email : marketing@syafakencana.com<br>
            NPWP : 73.247.813.6-003.000<br>
            Account : Mandiri 0060007956018
         </p>
      </div>

      <div class="col-xs-4 col-xs-offset-4">
         <table>
            <tr>
               <td colspan="3">kepada yth,</td>
            </tr>
            <tr>
               <td style="padding-top:5px;">
                 {{DB::table('customers')->where('id', $invoice->customer_id)->pluck('name')[0]}}
               </td>
            </tr>
            <tr>
               <td style="padding-top:5px;">
                  {{DB::table('customers')->where('id', $invoice->customer_id)->pluck('address')[0]}}
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
                  <th style="padding-right:40px;">Sales</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>{{$invoice->delivery_date}}</td>
                  <td>{{$invoice->payment}}</td>
                  <td>{{$invoice->due_date}}</td>
                  <td>{{DB::table('sales')->where('id', $invoice->sales_id)->pluck('name')[0]}}</td>
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
                  <th class="menu-qty">Discount</th>
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
                     <td id="itemDiscountCol{{$i}}" style="padding-top:10px; padding-bottom:10px">{{$c->discount}} %</td>
                     <td id="itemSubtotalCol{{$i}}" class="content-subtotal" style="padding-top:10px; padding-bottom:10px">Rp. {{number_format($c->subtotal,2,',','.')}}</td>
                  </tr>
               @endforeach
            </tbody>
            <tfoot>
              <tr class="table-menu">
                <td colspan='5' style="border:none"></td>
                <td style="border-top:2px solid lightgrey;"><span class="pull-right">Subtotal : </span></td>
                <td style="border-top:2px solid lightgrey">
                  <span id="subtotalcost" class="pull-right">Rp. {{number_format($invoice->total,2,',','.')}}</span>
                </td>
              </tr>
              <tr class="table-menu">
                <td colspan='5' style="border:none"></td>
                <td style="padding-top:2px solid lightgrey;"><span class="pull-right">Discount Cash : </span></td>
                <td style="padding-top:2px solid lightgrey">
                  <input type="number" class="form-control pull-left dscash" style="width:50%" name="name" id="dscash">
                  <span id="discountCash" class="pull-right">
                  </span>
                </td>
              </tr>
              <tr class="table-menu">
                <td colspan='5' style="border:none"></td>
                <td style="padding-top:2px solid lightgrey;"><span class="pull-right">PPN : </span></td>
                <td style="padding-top:2px solid lightgrey">
                  <input type="number" class="form-control pull-left dscash" style="width:50%" name="name" id="ppn" value="10">
                  <span id="totalppn" class="pull-right">10%</span>
                </td>
              </tr>
              <tr class="table-menu">
                <td colspan='5' style="border:none"></td>
                <td style="padding-top:2px solid lightgrey;"><span class="pull-right">Total : </span></td>
                <td style="padding-top:2px solid lightgrey">
                  <span id="totalcost" class="pull-right">Rp. {{number_format((((1/10)*$invoice->total)+$invoice->total),2,',','.')}}</span>
                </td>
              </tr>
            </tfoot>
         </table>
      </div>
   </div>
   <input type="hidden" id="totalcost_inp" name="totalcost" value="{{$invoice->total}}">
   <input type="hidden" name="_token" value="{{csrf_token()}}">

   <script type="text/javascript">
      var cost = 0;
      $("#dscash").on('change',function()
      {
          var static = {{$invoice->total}};
          var ppn = $("#ppn").val();

          var control =  parseFloat($(this).val()/100);
          var discountcash = control * parseFloat(static);
          var total = parseFloat(static) - parseFloat(discountcash);

          $("#discountCash").html(rupiah(discountcash));
          $("#totalcost").html(rupiah(total));
          $("#totalcost_inp").val(total);
          $("#totalppn").html(ppn+"%");
      });

      $("#ppn").change(function()
      {
        var ppn = $(this).val();
        var static = {{$invoice->total}};

        var control =  parseFloat($("#dscash").val()/100);
        var discountcash = control * parseFloat(static);
        var total = parseFloat(static) - parseFloat(discountcash);

        total = (parseFloat(ppn/100) * parseFloat(total)) + parseFloat(total);

        $("#discountCash").html(rupiah(discountcash));
        $("#totalcost").html(rupiah(total));
        $("#totalcost_inp").val(total);
        $("#totalppn").html(ppn+"%");
      });
   </script>
@endsection
