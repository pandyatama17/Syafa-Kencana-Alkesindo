<!doctype html>
<html>
<head>
    <script type="text/javascript" src="/materialize/dist/js/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="/materialize/dist/js/materialize.min.js"></script>
    <link type="text/css" rel="stylesheet" href="/materialize/dist/css/materialize.min.css"  media="screen,projection"/>
    <script src="/jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>

    {{-- <link type="text/css" rel="stylesheet" href="PrintArea.css" /> --}}
    <nav>
        <div class="nav-wrapper">
            <a href="/" class="brand-logo" style="margin-left:20px">Invoice</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <button type="button" id="printBtn" class="button b1 waves-effect waves-light btn-large " name="button">Print</button>
                </li>
                <li class="linav">
                  <a href="/finance/invoice/">back</a>
                </li>
            </ul>
        </div>
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
            @foreach($ivchilds as $child)
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
          $("#printBtn").on('click',function functionName()
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
