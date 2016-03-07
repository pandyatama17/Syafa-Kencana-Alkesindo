<!doctype html>
<html>
<head>
   <link rel="stylesheet" href="{{asset('chosen/chosen.css')}}" media="screen,print"charset="utf-8">
   <link rel="stylesheet" href="{{asset('swal/dist/sweetalert.css')}}" media="screen" title="no title" charset="utf-8">

   <script src="{{asset('jquery.min.js')}}" charset="utf-8"></script>
   <script src="{{asset('swal/dist/sweetalert.min.js')}}"></script>
   <script src="{{asset('chosen/chosen.jquery.min.js')}}"></script>
   <script src="{{asset('jquery.validate.min.js')}}" charset="utf-8"></script>
   <script src="{{asset('jquery.form.js')}}" charset="utf-8"></script>
   <script src="{{asset('jquery.PrintArea.js')}}" type="text/JavaScript" language="javascript"></script>

   <nav style="background:#2ecc71; margin:-8px; height:50px; padding:10px; padding-top:0px; padding-bottom:0px; font-family: Arial">
      {{-- <div class="nav-wrapper" > --}}
         <a href="/" style="float:left; margin-left:20px; font-family: Arial; text-decoration:none; color:white; font-size:20pt; padding-top:10px;">Invoice</a>
           <ul style="float:right; margin-top:7px">
             <li style="float:left">
                 <button type="button" name="printButton" class="button blue" id="printBtn">Print</button>&nbsp;&nbsp;&nbsp;
             </li>
             <li style="float:right">
                 <button type="button" name="backButton" class="button red" onclick="history.back(-2)">Back</button>
             </li>
           </ul>
        {{-- </div> --}}
   </nav>

    <meta charset="utf-8">
    <title>Invoice</title>
<link rel="stylesheet" href="/css/reports.css" media="screen" title="no title" charset="utf-8">

</head>

<body>
   <br> <br> <br>
    <div class="PrintArea area1 all" id="InvoiceArea">
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="7">
                    <table>
                        <tr>
                            <td class="title">
                                <!-- <img src="http://nextstepwebs.com/images/logo.png" style="width:100%; max-width:300px;"> -->
                                Syafa Kencana Alkesindo
                            </td>

                            <td>
                                Invoice #: {{$iv->id}}<br>
                                Created: {{$iv->invoice_date}}<br>
                                Due: {{$iv->due}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="7">
                    <table>
                        <tr>
                            <td style="width:548px;">
                            Perkantoran Pulomas 1, gedung 4 lt. 3 ruang 12A<br>
                            Jl. Jend A. Yani No. 2, Pulomas - Kayu Putih, Jaktim<br>
                            Telp/Fax: +62 21 2984 7910<br>
                            Email: marketing@syafakencana.com
                            </td>
                            <td style="width:188px;">
                              Kepada Yth,<br>
                              {{$iv->client_name}}<br>
                              {{$iv->client_address}}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Salesman</td>
                <td>Tanggal Pengiriman</td>
                <td>Pembayaran</td>
                <td>Jatuh Tempo</td>
            </tr>
            <tr class="details">
                <td>{{DB::table('user')->where('id',$iv->sales)->pluck('name')}}</td>
                <td>{{$iv->delivery_date}}</td>
                <td>{{$iv->payment}}</td>
                <td>{{$iv->due_date}}</td>
            </tr>


            <tr class="heading">
                <td>No</td>
                <td>Kode Barang</td>
                <td>Nama Barang</td>
                <td>Qty</td>
                <td>Harga Satuan</td>
                <td>Discount</td>
                <td>Subtotal</td>
            </tr>
            <?php $x = 0;?>
            @foreach($ivchilds as $child)
               <?php $x++ ?>
               <tr>
                  <td>{{$x}}</td>
                  <td>{{$child->item_id}}</td>
                  <td>{{DB::table('item')->where('id', $child->item_id)->pluck('item_name')}}</td>
                  <td>{{$child->qty}} item</td>
                  <td class="itemprice">{{DB::table('item')->where('id', $child->item_id)->pluck('resell_price')}}</td>
                  <td>{{$child->discount}}%</td>
                  <td class="subtotal">{{$child->subtotal}}</td>
               </tr>
            @endforeach

            <tr class="item last">

            </tr>

            <tr class="total">

                <td></td><td></td><td></td><td></td><td></td><td>Total: </td>
                <td id="invoicetotal">{{$total}}</td>
                {{-- <td>Rp. {{$ptg->total}},-</td> --}}
            </tr>
        </table>
        <div class="clear"></div>
        <br>
        <table>
            <tr>
              <td>Hormat Kami,</td>
              <td>Mengetahui,</td>
              <td>Penerima,</td>
          </tr>
          <tr><td></td></tr>
          <tr>
            <?php $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
            <td>({{$space}})</td>
            <td>({{$space}})</td>
            <td>({{$space}})</td>
          </tr>
        </table>
    </div>
</div>
    <script>
      function rupiah(nStr)
      {
         nStr += '';
         x = nStr.split('.');
         x1 = x[0];
         x2 = x.length > 1 ? '.' + x[1] : '';
         var rgx = /(\d+)(\d{3})/;
         while (rgx.test(x1))
         {
           x1 = x1.replace(rgx, '$1' + '.' + '$2');
         }
         return "Rp. " + x1 + x2 +",00";
      }
      $(document).ready(function(){

         $(".itemprice").text(function()
         {
            $(this).text(rupiah($(this).text()));
         });
         $(".subtotal").text(function()
         {
            $(this).text(rupiah($(this).text()));
         });
         $("#invoicetotal").text(function()
         {
            $(this).text(rupiah($(this).text()));
         });
          $("#printBtn").click(function functionName()
          {
              $("#InvoiceArea").printArea({
                    mode       : "popup",
                    standard   : "html5",
                    popTitle   : 'Print Invoice',
                    popClose   : false,
                    extraCss   : '/css/reports.css',
                    retainAttr : ["id","class","style"],
                    printDelay : 500, // tempo de atraso na impressao
                    printAlert : true,
                    printMsg   : 'Print laaa'
                });
          });
      });

    </script>
</body>
</html>
