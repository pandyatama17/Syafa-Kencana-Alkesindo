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
    <?php
    //data control
     ?>
</head>

<body>
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
                                Invoice #: <br>
                                Created: <br>
                                Due:
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
                             <br>
                             <br>
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
                <td>
                    <select name="sales">
                        <option selected disabled="true">Pilih Sales</option>
                        @@foreach($sales as $res)
                                <option value="{{$res->id}}">{{$res->name}}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="date" name="delivery_date"class="datepicker"></td>
                <td>
                    <select name="pembayaran">
                        <option selected="true" disabled="true">Pilih Jenis Pembayaran</option>
                        <option value="Transfer">Transfer</option>
                        <option value="Cash">Cash</option>
                    </select>
                </td>
                <td><input type="date" name="due" class="datepicker"></td>
            </tr>


            <tr class="heading">
                <td>No</td>
                <td>Kode Barang</td>
                <td>Nama Barang</td>
                <td>Qty</td>
                <td>Harga Satuan</td>
                <td>Discount</td>
                <td>Jumlah</td>
            </tr>

              <tr class="item">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>0</td>
                  <td></td>
              </tr>


            <tr class="item last">

            </tr>

            <tr class="total">

                <td></td><td></td><td></td><td></td><td></td><td>Total: </td>
                <td>Rp. ,-</td>
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
      $(document).ready(function(){

          $('select').material_select();

          $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
          });

          var $input = $('.datepicker').pickadate();
          // Use the picker object directly.
          var picker = $input.pickadate('picker');
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
