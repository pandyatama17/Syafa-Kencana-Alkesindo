<!doctype html>
<html>
<head>
    <script type="text/javascript" src="/materialize/dist/js/jquery-2.2.0.min.js"></script>
    {{-- <script type="text/javascript" src="/materialize/dist/js/materialize.min.js"></script> --}}
    {{-- <link type="text/css" rel="stylesheet" href="/materialize/dist/css/materialize.min.css"  media="screen,projection"/> --}}

    {{-- <link type="text/css" rel="stylesheet" href="PrintArea.css" /> --}}
    <nav style="background:#2c3e50; margin:-8px; height:50px; padding:10px; padding-bottom:0px; font-family: Roboto">
        <div class="nav-wrapper" >
            <a href="/" style="margin-left:20px; font-family: Arial; text-decoration:none; color:white; font-size:20pt">Delivery Order</a>
            <button type="button" name="button" class="button green" style="float:right" id="printBtn">Print</button>
         </div>
    </nav>
    {{-- <link type="text/css" rel="stylesheet" href="PrintArea.css" /> --}}
    <br/><br/><br/>

    <meta charset="utf-8">
    <title>Delivery Order</title>
<link rel="stylesheet" href="/css/reports.css" media="screen" title="no title" charset="utf-8">

</head>

<body>
   <br> <br> <br>
    <div class="PrintArea area1 all" id="DOArea">
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
                                DO #: {{$do->id}}<br>
                                Created: {{$do->do_date}}<br>
                                Due: {{$do->due}}
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
                              {{$do->client_name}}<br>
                              {{$do->client_address}}<br>
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
                <td>{{DB::table('user')->where('id',$do->sales)->pluck('name')}}</td>
                <td>{{$do->delivery_date}}</td>
                <td>{{$do->payment}}</td>
                <td>{{$do->due_date}}</td>
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
            @foreach($dochilds as $child)
               <tr>
                  <td>{{$child->id}}</td>
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
                <td id="DOTotal">{{$do->total}}</td>
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
<script src="/jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>
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
         $("#DOTotal").text(function()
         {
            $(this).text(rupiah($(this).text()));
         });
          $("#printBtn").on('click',function functionName()
          {
              $("#DOArea").printArea({
                    mode       : "popup",
                    standard   : "html5",
                    popTitle   : 'Print Delivery Order',
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
