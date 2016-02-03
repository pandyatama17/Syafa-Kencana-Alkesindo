@extends('finance.mainmenu')

@section('subcontent')
    <?php
      function generateRandomString($length = 8) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }
    ?>
    <style media="screen">
        .blur
        {
            -webkit-filter: blur(2px);
        }
    </style>
    <script src="/jquery.validate.min.js" charset="utf-8"></script>
    <script src="/jquery.form.js" charset="utf-8"></script>
    <script type="text/javascript" src="/swal/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="/swal/dist/sweetalert.css" media="screen" title="no title" charset="utf-8">
    <form class="col s12" method="post" action="{!! action('FinanceController@storeInvoice') !!}" id="createInvoiceForm">
        <div class="row">
            <h2 class="header" style="color:teal">Invoice Baru</h2>
            <div class="clear"></div>
            <div class="input-field col s6">
                <?php $done = array();?>
                <select class="" name="do_id" onchange="showItems(this.value);getUsers(this.value);">
                    <option value="" disabled selected>Pilih Delivery Order</option>
                    @foreach ($trs as $res)
                        @if(!in_array($res->DO_id, $done))
                            <option value="{{$res->DO_id}}">{{$res->DO_id}}</option>
                            <?php $done[] = $res->DO_id; ?>
                        @endif
                    @endforeach
                </select>
                <label for="DO_ID">Delivery Order ID</label>
            </div>
            <div class="clear"></div>
            <div class="input-field col s6" id="items_id_cont" style="display:none">
                {{-- ajax content --}}
            </div>
            <div class="clear"></div>
            <div class="input-field col s6" id="items_qty_cont" style="display:none">
                {{-- ajax content --}}
            </div>
            <div class="clear"></div>
            <div class="input-field col s6">
                <input type="date" class="datepicker" name="invoice_date"/>
                <label for="date">Tanggal Invoice</label>
            </div><div class="clear"></div>
            <div class="input-field col s6">
                <input type="date" class="datepicker" name="due_date"/>
                <label for="due_date">Jatuh Tempo</label>
            </div><div class="clear"></div>
            <div class="input-field col s6">
                <input type="date" class="datepicker" name="delivery_date"/>
                <label>Delivery Date</label>
            </div>
            <div class="clear"></div>
            <div class="input-field col s6">
                <input type="text" id="sender" name="sender"/>
                <label for="sender">Pengirim</label>
            </div>
            <div class="clear"></div>
            <div class="input-field col s6">
                <input type="text" id="recipient" name="recipient"/>
                <label for="recipient">Penerima</label>
            </div>
            <div class="clear"></div>
            <div class="input-field col s6">
                <input type="text" id="client_name" name="client_name"/>
                <label for="client_name">Nama Client</label>
            </div>
            <div class="clear"></div>
            <div class="input-field col s6">
                <textarea name="client_address" class="materialize-textarea"></textarea>
                <label>Alamat Client</textarea>
            </div>
            <div class="clear"></div>
            <div class="input-field col s6">
                <select class="" name="sales" onchange="showItems(this.value)">
                    <option value="" disabled selected>Pilih Sales</option>
                    @foreach ($sales as $res)
                        <option value="{{$res->id}}">{{$res->name}}</option>
                    @endforeach
                </select>
                <label>Sales</label>
            </div>
            <div class="clear"></div>
            <div class="input-field col s6">
                <select class="" name="payment">
                    <option value="" disabled selected>Pilih Jenis Pembayaran</option>
                    <option value="Transfer">Transfer</option>
                    <option value="Cash">Cash</option>
                </select>
                <label>Pembayaran</label>
            </div>
            <div class="clear"></div>
            <div class="input-field col s4"></div>
            <div id="hiddenInputs">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="clear"></div>
                <div id="hiddenInputStorage" class="input-field col s6">
                    <input type="text" name="storage_oncharge" id="storage_oncharge" value="" style="display:none">
                    <label> Storage</label>
                </div>
                <div class="clear"></div>
                <div id="hiddenInputAdmin" class="input-field col s6">
                    <input type="text" name="admin_oncharge" value="{{Session::get('user')->id}}" style="display:none">
                    <label>Admin</label>
                </div>
            </div>
            <div class="clear"></div>
            <div class="input-field col s2">
                <button type="submit" id="saveBtn" class="btn waves-effect waves-light" style="float:right">Save</button>
            </div>
        </div>
    </form>
    <script>
    $(document).ready(function()
    {
        var $input = $('.datepicker').pickadate();
        // Use the picker object directly.
        var picker = $input.pickadate('picker');
        picker.set('select', new Date());
        $('select').material_select();
        $('#saveBtn').click(function()
        {
            $('form').addClass('blur');
            $('.collection').addClass('blur');
        });
        $('.collection').click(function()
        {
            $('form').removeClass('blur');
            $('.collection').removeClass('blur');
        });
        $('#createInvoiceForm').validate(
            {
                rules:
                {
                    do_id:
                    {
                            required: true
                    },
                    delivery_date:
                    {
                        required: true
                    },
                    sender:
                    {
                        required: true
                    },
                    recipient:
                    {
                        required: true
                    },
                },
                highlight: function(label)
                {
                    $(label).closest().addClass('error');
                },
                success: function(label)
                {
                    label.closest().addClass('success');
                },
                submitHandler: function(form)
                {
                    if ($(form).valid())
                    {
                        $(form).ajaxSubmit(
                        {
                            url:$(this).attr('action'),
                            type: 'POST',
                            data: $(this).serialize(),
                            success: function(data)
                            {
                                var obj = jQuery.parseJSON(data);
                                if(obj.err == false)
                                {
                                    swal(
                                    {
                                        title: "Well Done!",
                                        text: obj.msg,
                                        type: "success",
                                        confirmButtonColor: "#0288d1",
                                        confirmButtonText: "Ok!",
                                        closeOnConfirm: false
                                    },
                                    function()
                                    {
                                        location.replace('/finance/invoice/'+obj.id);
                                    });
                                    }
                                    else
                                    {
                                        swal("Opps!", obj.msg, "error");
                                    }
                                }
                            })
                            return false;
                        }
                    }
                });
    });
    function showItems(str)
    {
        var xhttp;
        if (str == "")
        {
            document.getElementById("items_id_cont").innerHTML = "items_id_array";
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {
            if (xhttp.readyState == 4 && xhttp.status == 200)
            {
                var responseText = jQuery.parseJSON(xhttp.responseText);

                //items_id_array
                var str ='<input name="items_id_array" type="text" value="';
                console.log(responseText);
                for(data in responseText){
                    str += responseText[data].item_id+", ";
                }
                str += '"/><label for="" class="active">Items</label>';
                console.log(str);
                document.getElementById("items_id_cont").innerHTML = str;

                // items_qty_array
                var str ='<input name="items_qty_array" type="text" value="';
                console.log(responseText);
                for(data in responseText){
                    str += responseText[data].item_qty+", ";
                }
                str += '"/><label for="" class="active">Items qty.</label>';
                console.log(str);
                document.getElementById("items_qty_cont").innerHTML = str;

            }
        };
        xhttp.open("GET", "/storage/DO/"+str, true);
        xhttp.send();
    }</script><script>
    function getUsers(str)
    {
        var xhttp;
        if (str == "")
        {
            document.getElementById("storage_oncharge").value = "null";
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {
            if (xhttp.readyState == 4 && xhttp.status == 200)
            {
                var responseText = jQuery.parseJSON(xhttp.responseText);
                for(data in responseText){
                    document.getElementById("storage_oncharge").value = responseText[data].user;
                }

            }
        };
        xhttp.open("GET", "/finance/usersJSON/"+str, true);
        xhttp.send();
    }
    </script>
@endsection
