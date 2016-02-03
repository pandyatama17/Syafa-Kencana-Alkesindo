<!doctype html>
<html>
<script type="text/javascript" src="/materialize/dist/js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="/materialize/dist/js/materialize.min.js"></script>
<link type="text/css" rel="stylesheet" href="/materialize/dist/css/materialize.min.css"  media="screen,projection"/>
<script src="jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>

{{-- <link type="text/css" rel="stylesheet" href="PrintArea.css" /> --}}
<nav>
    <div class="nav-wrapper">
        <a href="/" class="brand-logo" style="margin-left:20px">Invoice</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li>
                <button type="button" id="printBtn" class="button b1 waves-effect waves-light btn-large " name="button">Print</button>
            </li>
            <li class="linav">
              <a href="/supplier/">Supplier</a>
            </li>
        </ul>
    </div>
</nav>
<br>
<br>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <link rel="stylesheet" href="/css/reports.css" media="screen" title="no title" charset="utf-8">
</head>

<body>
    <div class="PrintArea area1 all" id="Retain">
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
                                    Invoice #: 92834<br>
                                    Created: 26 January 2016<br>
                                    Due: Jakarta,26 January 2016
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
                                <td style="">
                                  Kepada Yth,<br>
                                  Wagiman Suparno<br>
                                  Jl. Poncol No. 666 RT/RW 01/99, Jaktim<br>
                                </td>
                            </tr>
                        </td>
                        </table>
                </tr>
                <tr class="heading">
                    <td>Salesman</td>
                    <td>Tanggal Pengiriman</td>
                    <td>Pembayaran</td>
                    <td>Jatuh Tempo</td>
                </tr>
                <tr class="details">
                    <td>Parjo</td>
                    <td>Besok</td>
                    <td>Sabeb bos</td>
                    <td>28 January 2016</td>
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
                @for ($i = 0; $i < 10; $i++)
                <tr class="item">
                    <td>{{$i}}</td>
                    <td>996</td>
                    <td>sabu</td>
                    <td>2</td>
                    <td>Rp. 2500,-</td>
                    <td>0</td>
                    <td>Rp. 5000,-</td>
                </tr>
                @endfor

                <tr class="item last">

                </tr>

                <tr class="total">
                    <td></td><td></td><td></td><td></td><td></td><td>Total: </td>
                    <td>Rp.10000,-</td>
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

          $("#printBtn").on('click',function functionName()
          {
              $("#Retain").printArea({
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
