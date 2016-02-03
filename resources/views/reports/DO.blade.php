<?php
function array2json($arr) {
if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
$parts = array();
$is_list = false;

//Find out if the given array is a numerical array
$keys = array_keys($arr);
$max_length = count($arr)-1;
if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
    $is_list = true;
    for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position
        if($i != $keys[$i]) { //A key fails at position check.
            $is_list = false; //It is an associative array.
            break;
        }
    }
}

foreach($arr as $key=>$value) {
    if(is_array($value)) { //Custom handling for arrays
        if($is_list) $parts[] = array2json($value); /* :RECURSION: */
        else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */
    } else {
        $str = '';
        if(!$is_list) $str = '"' . $key . '":';

        //Custom handling for multiple data types
        if(is_numeric($value)) $str .= $value; //Numbers
        elseif($value === false) $str .= 'false'; //The booleans
        elseif($value === true) $str .= 'true';
        else $str .= '"' . addslashes($value) . '"'; //All other things
        // :TODO: Is there any more datatype we should be in the lookout for? (Object?)

        $parts[] = $str;
    }
}
$json = implode(',',$parts);

if($is_list) return '[' . $json . ']';//Return numerical JSON
return '{' . $json . '}';//Return associative JSON
}
?>

@foreach($deliveryorder as $do)
<?php
    $user = DB::table('user')->where('id',$do->user)->pluck('name');

    $items =explode(",", $do->items_id_array);
    $ct = count($items);
    // for ($i=0; $i < $ct; $i++)
    // {
    //     echo "item id '".$items[$i]."',";
    // }

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:20px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:8pt ;
        line-height:15px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }

    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }

    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }

    .invoice-box table tr td:nth-child(7){
        text-align:right;
    }

    .invoice-box table tr.top table td{
      padding-bottom:0px;
        margin-bottom:0px;
    }

    .invoice-box table tr.top table td.title{
        font-size:24pt;
        line-height:45px;
        color:#333;
        margin-bottom: 10px;
    }

    .invoice-box table tr.information table td{
        padding-bottom:10px;
    }

    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }

    .invoice-box table tr.details td{
        padding-bottom:20px;
    }

    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }

    .invoice-box table tr.item.last td{
        border-bottom:none;
    }

    .invoice-box table tr.total td:nth-child(7){
        border-top:2px solid #eee;
        font-weight:bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }

        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }

    .invoice table tr td
    {
      /*border: 1px solid silver;*/
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="7">
                    <table>
                        <tr>
                            <td class="title">
                                <!-- <img src="http://nextstepwebs.com/images/logo.png" style="width:100%; max-width:300px;"> -->
                                Syafa Kencana Alkesindo <br><small style="font-size:12pt">Delivery Order</small>
                            </td>

                            <td>
                                Delivery Order #: {!! $do->DO_id !!}<br>
                                Created: {!! $do->date !!}<br>
                                Delivery: {!! $do->delivery_date !!}
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
                            {{-- <td style="">
                              Kepada Yth,<br>
                              {$do->recipient!!}<br>
                              Jl. Poncol No. 666 RT/RW 01/99, Jaktim<br>
                            </td> --}}
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Sender</td>
                <td>Recipient</td>
                <td>Delivery Date</td>
                <td>Storage User</td>
            </tr>
            <tr class="details">
                <td>{!!$do->sender!!}</td>
                <td>{!!$do->recipient!!}</td>
                <td>{!!$do->delivery_date!!}</td>
                <td>{!!$user!!}</td>
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
            <?php $grandtotal = "0"; ?>
                @for ($i = 0; $i < $ct; $i++)
                    <?php
                            $item = DB::table('item')->where('id',$items[$i])->get();
                            // $item = (array) $item;
                            $itemarr = json_decode(json_encode($item),true);
                            // print_r($item);
                            // //echo $item->item_id;
                            // echo "<br>";
                            // print_r($itemarr);
                            // echo "<br>";
                     ?>
                    @foreach ($item as $res)
                        <?php
                            $subtotal = $res->qty * $res->resell_price;
                            $grandtotal = $grandtotal + $subtotal;
                        ?>
                        <tr class="item">
                            <td>{{$i+1}}</td>
                            <td>{{$res->id}}</td>
                            <td>{{$res->item_name}}</td>
                            <td id="qty">{{$res->qty}}</td>
                            <td id="price">Rp. {{number_format ($res->resell_price, 2, ',', '.')}}</td>
                            <td>0%</td>
                            <td>Rp. {{number_format ($subtotal, 2, ',', '.')}}</td>
                        </tr>
                    @endforeach
                @endfor

            <tr class="item last">

            </tr>

            <tr class="total">
                <td></td><td></td><td></td><td></td><td></td><td>Total: </td>
                <td>Rp. {{number_format ($grandtotal, 2, ',', '.')}}</td>
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
</body>
<script type="text/javascript">
    var
</script>
</html>
@endforeach
