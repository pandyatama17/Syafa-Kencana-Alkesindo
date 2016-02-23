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

    <nav style="background:#2ecc71; margin:-8px; height:50px; padding:10px; padding-bottom:0px; font-family: Arial">
        <div class="nav-wrapper" >
            <a href="/" style="margin-left:20px; font-family: Arial; text-decoration:none; color:white; font-size:20pt">Invoice</a>
            <button type="button" name="button" class="button" style="float:right" id="SaveBtn">Save</button>
         </div>
    </nav>
    {{-- <link type="text/css" rel="stylesheet" href="PrintArea.css" /> --}}
    <br/><br/><br/>

    <meta charset="utf-8">
    <title>Invoice</title>
<link rel="stylesheet" href="/css/reports.css" media="screen,print" title="no title" charset="utf-8">
    <?php
    //data control
     ?>
    <style media="screen">
       /*td{border:1px solid black;}*/
    </style>
</head>
<body>
    <form id="InvoiceForm" action="{{action('InvoiceController@storeInvoice')}}" method="post">
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

                            <td style="line-height:31x`px;">
                               <table>
                                <tr>
                                   <td>Invoice #</td>
                                  <td>:</td>
                                  <td><input type="text"  class="simplized" style=" width:75%;" name="parent_id" id="parent_id" required="true"> <br></td>
                               </tr>
                               <tr>
                                  <td>Created</td>
                                  <td>:</td>
                                  <td>
                                     <input type="date" id="invoice_date" {{-- onchange="countdate(this.value)" --}} class="simplized" style=" width:75%;" name="invoice_date" value="" required> <br>
                                  </td>
                               </tr>
                            </table>
                                {{-- Due &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                <input type="date"  class="simplized" style=" width:50%;" name="due_date" id="due1" value=""> --}}
                            </td>
                        </tr>
                    </table>
                    <script type="text/javascript">
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
                        $("#invoice_date").change(function()
                        {
                            var currentdate  = $(this).val();
                            console.log(currentdate);
                            var datearr = currentdate.split('-');

                            if (datearr['1']=="12")
                            {
                                var NewMonth = "01";
                                var NewYear = (datearr['0']*1+1);
                                var NewDay = datearr['2'];
                            }
                            else
                            {
                                if (datearr['1'] == "01")
                                {
                                    console.log(datearr[2]);
                                    if(datearr['2']=='30')
                                    {
                                        var NewMonth = "0"+(datearr['1']*1+1);
                                        var NewDay = '01';
                                    }
                                    else if(datearr['2']=='31')
                                    {
                                        var NewMonth = "0"+(datearr['1']*1+1);
                                        var NewDay = '02';
                                    }
                                    else
                                    {
                                        var NewMonth = "0"+(datearr['1']*1+1);
                                        var NewDay = datearr[2];
                                    }
                                }
                                else if (datearr['1'] == "03" || datearr['1'] == "05" && datearr['2']=='31')
                                {
                                    var NewMonth = "0"+(datearr['1']*1+2);
                                    var NewDay = '01';
                                }
                                else if (datearr['1'] == "08" || datearr['1'] == "10" && datearr['2']=='31') {
                                    var NewMonth = (datearr['1']*1+2);
                                    var NewDay = '01';
                                }
                                else
                                {
                                    var NewMonth = "0"+(datearr['1']*1+1);
                                    var NewDay = datearr['2'];
                                }
                                var NewYear = datearr['0'];
                            }

                            console.log(NewMonth);
                            var NewDate = NewYear+"-"+NewMonth+"-"+NewDay;
                            console.log(NewDate);
                           //  $("#due1").val(NewDate);
                            $("#due2").val(NewDate);
                        })
                    </script>
                </td>
            </tr>

            <tr class="information">
                <td colspan="7">
                    <table>
                        <tr>
                            <td style="width:470px;">
                            Perkantoran Pulomas 1, gedung 4 lt. 3 ruang 12A<br>
                            Jl. Jend A. Yani No. 2, Pulomas - Kayu Putih, Jaktim<br>
                            Telp/Fax: +62 21 2984 7910<br>
                            Email: marketing@syafakencana.com
                            </td>
                            <td>
                              Kepada Yth,<br>

                             <input type="text" class="simplized" name="client_name" value="" placeholder="Client Name">
                             <br>
                             <br>
                             <textarea class="simplized" name="client_address" rows="2" cols="10" placeholder="Client Address"></textarea>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td style="width:120px" colspan="2">Salesman</td>
                <td style="width:100px">Tanggal Pengiriman</td>
                <td style="width:100px" colspan="2">Pembayaran</td>
                <td style="width:100px">Jatuh Tempo</td>
                <td style="border:none;"></td>

            </tr>
            <tr class="details">
                <td colspan="2">
                    <select class="simplized chosen" name="sales" required="true">
                        <option value="" selected disabled>Pilih Sales</option>
                            @foreach($sales as $res)
                                    <option value="{{$res->id}}">{{$res->name}}</option>
                            @endforeach
                    </select class="simplized">
                </td>
                <td><input class="simplized" type="date" name="delivery_date" class="datepicker" style="width:90%" required></td>
                <td colspan="2" style="width:100px">
                    <select class="simplized normal" required name="payment">
                        <option value="" selected disabled>Pilih Jenis Pembayaran</option>
                        <option value="Transfer">Transfer</option>
                        <option value="Cash">Cash</option>
                    </select class="simplized">
                </td>
                <td><input class="simplized" type="date" name="due_date" id="due2" class="datepicker" style="width:90%" required></td>

            </tr>
            <tr class="heading">
                <td>No</td>
                <td>Kode Barang</td>
                <td>Nama Barang</td>
                <td>Qty</td>
                <td>Harga Satuan</td>
                <td>Discount</td>
                <td style="width:100px">Jumlah</td>
            </tr>
            <?php $countitems = 10 +1; ?>
            @for($i=1; $i < $countitems; $i++)

                <tr class="item" id="item{{$i}}">
                    <td>{{$i}}</td>
                    <td>
                        <select class="simplized chosen" name="item{{$i}}" onchange="getItem{{$i}}(this.value)" style="width:180px">
                            <option value="" selected disabled>Pilih Barang</option>
                            @foreach($items as $res)
                                <option value="{!!$res->id!!}">{!!$res->id!!}</option>
                            @endforeach
                        </select>
                    </td>
                    <td id="namecolumn{{$i}}" style="line-height:20px;text-align:center"></td>
                    <td id="qtycolumn{{$i}}"></td>
                    <td id="pricecolumn{{$i}}" style="width:100px"></td>
                    <td id="discountcolumn{{$i}}"></td>
                    <td id="subtotalcolumn{{$i}}"></td>
                    <td id="HiddenCont{{$i}}" style="display:none"></td>
                </tr>
                <script type="text/javascript">
                function getItem{{$i}}(str)
                {
                    var xhttp;
                    if (str == "")
                    {
                        document.getElementById("items_id_array").innerHTML = "items_id_array";
                        return;
                    }
                    xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function()
                    {
                        if (xhttp.readyState == 4 && xhttp.status == 200)
                        {
                            var responseText = jQuery.parseJSON(xhttp.responseText);

                            //items_id_array
                            console.log("--------------start--------------");
                            console.log(responseText);
                            console.log("----------------------------");
                            document.getElementById("namecolumn{{$i}}").innerHTML = responseText.item_name;
                            document.getElementById("pricecolumn{{$i}}").innerHTML = rupiah(responseText.resell_price);
                            document.getElementById("discountcolumn{{$i}}").innerHTML = '<input class="simplized" type="number" name="discount{{$i}}" min="0" max="99" style="width:60%" value="0" id="discount{{$i}}" onchange="ctsub{{$i}}(this.value)">%';
                            document.getElementById("qtycolumn{{$i}}").innerHTML = '<input class="simplized" type="number" name="qty{{$i}}" min="1" max="'+responseText.qty+'" style="width:70%" id="qty{{$i}}" value="1" onchange="ctsub{{$i}}(this.value)">';
                            document.getElementById("HiddenCont{{$i}}").innerHTML = '<input type="text" style="display:none" id="price{{$i}}" name="price{{$i}}" value="'+responseText.resell_price+'"><input type="text" style="display:none" name="subtotal{{$i}}" id="subtotal{{$i}}">';
                            document.getElementById("subtotalcolumn{{$i}}").innerHTML = rupiah(responseText.resell_price);
                            ctsub{{$i}}("1");
                        }
                    };
                    xhttp.open("GET", "/storage/itemAsJSON/"+str, true);
                    xhttp.send();
                }
                function ctsub{{$i}}(qty)
                {
                   var price = document.getElementById("price{{$i}}").value;
                   var discount = document.getElementById("discount{{$i}}").value;
                   var name = document.getElementById("namecolumn{{$i}}").innerHTML;
                   var subtotal = (qty*price)-((discount/100)*(qty*price));

                   var arraylog = {'item':name, 'price': rupiah(price), 'qty':qty, 'discount': discount, 'subtotal': rupiah(subtotal)};
                   console.log(arraylog);

                   document.getElementById("subtotalcolumn{{$i}}").innerHTML = rupiah(subtotal);
                   document.getElementById("subtotal{{$i}}").value = subtotal;

                   var sub1 = document.getElementById("subtotal1");
                   var sub2 = document.getElementById("subtotal2");
                   var sub3 = document.getElementById("subtotal3");
                   var sub4 = document.getElementById("subtotal4");
                   var sub5 = document.getElementById("subtotal5");
                   var sub6 = document.getElementById("subtotal6");
                   var sub7 = document.getElementById("subtotal7");
                   var sub8 = document.getElementById("subtotal8");
                   var sub9 = document.getElementById("subtotal9");
                   var sub10 = document.getElementById("subtotal10");

                   var total;
                   var datalength;

                   if (sub2)
                   {
                      if (sub3)
                      {
                        if(sub4)
                        {
                              if(sub5)
                              {
                                    if (sub6)
                                    {
                                       if (sub7)
                                       {
                                          if (sub8)
                                          {
                                             if (sub9)
                                             {
                                                if (sub10)
                                                {
                                                   datalength = 10;
                                                   total =  (parseInt(sub1.value)+parseInt(sub2.value)+parseInt(sub3.value)+parseInt(sub4.value)+parseInt(sub5.value)+parseInt(sub6.value)+parseInt(sub7.value)+parseInt(sub8.value)+parseInt(sub9.value)+parseInt(sub10.value));
                                                }
                                                else
                                                {
                                                   datalength = 9;
                                                   total =  (parseInt(sub1.value)+parseInt(sub2.value)+parseInt(sub3.value)+parseInt(sub4.value)+parseInt(sub5.value)+parseInt(sub6.value)+parseInt(sub7.value)+parseInt(sub8.value)+parseInt(sub9.value));
                                                }
                                             }
                                             else
                                             {
                                                   datalength = 8;
                                                   total =  (parseInt(sub1.value)+parseInt(sub2.value)+parseInt(sub3.value)+parseInt(sub4.value)+parseInt(sub5.value)+parseInt(sub6.value)+parseInt(sub7.value)+parseInt(sub8.value));
                                             }
                                          }
                                          else
                                          {
                                                datalength = 7;
                                                total =  (parseInt(sub1.value)+parseInt(sub2.value)+parseInt(sub3.value)+parseInt(sub4.value)+parseInt(sub5.value)+parseInt(sub6.value)+parseInt(sub7.value));
                                          }
                                       }
                                       else
                                       {
                                          datalength = 6;
                                          total =  (parseInt(sub1.value)+parseInt(sub2.value)+parseInt(sub3.value)+parseInt(sub4.value)+parseInt(sub5.value)+parseInt(sub6.value));

                                       }
                                    }
                                    else
                                    {
                                       datalength = 5;
                                       total =  (parseInt(sub1.value)+parseInt(sub2.value)+parseInt(sub3.value)+parseInt(sub4.value)+parseInt(sub5.value));
                                    }
                              }
                              else
                              {
                                    datalength = 4;
                                    total =  (parseInt(sub1.value)+parseInt(sub2.value)+parseInt(sub3.value)+parseInt(sub4.value));
                              }
                        }
                        else
                        {
                           datalength = 3;
                           total =  (parseInt(sub1.value)+parseInt(sub2.value)+parseInt(sub3.value));
                        }
                      }
                      else
                      {
                           datalength = 2;
                           total =  (parseInt(sub1.value)+parseInt(sub2.value));
                      }
                   }
                   else
                   {
                        datalength = 1;
                        total = subtotal;
                   }
                   console.log("Data Length: "+datalength);
                   console.log("Total: "+rupiah(total));
                   console.log("-------------end---------------");
                   document.getElementById("datalength").value = datalength;
                   document.getElementById("counttotal").innerHTML = rupiah(total)+'<input type="hidden" name="total" value="'+total+'">';
                }


                </script>
            @endfor


            <tr class="item last">

            </tr>

            <tr class="total">

                <td colspan="5"></td><td>Total: </td>
                <td id="counttotal">Rp. ,-</td>
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
    <input type="hidden" name="user" value="{{Session::get('user')->id}}">
    <input type="hidden" name="datalength" id="datalength">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" value="" id="FormSubmit" class="">
    </form>
    <script>
    $(document).ready(function()
    {
         $('.chosen').chosen();
         $(".normal").chosen(
         {
            disable_search_threshold:10,
            no_results_text:"data tidak ditemukan!"
         });
         $('#SaveBtn').click(function()
         {
            $("#FormSubmit").click();
         });
   })

    </script>
</body>
</html>
