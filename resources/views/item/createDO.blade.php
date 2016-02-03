@extends('item.main')

@section('menu')
    <style media="screen">
        .blur
        {
            -webkit-filter: blur(2px);
        }
    </style>
    <script src="/jquery.validate.min.js" charset="utf-8"></script>
    <script src="/jquery.form.js" charset="utf-8"></script>
    <form class="col s12" method="post" action="{!! action('ItemController@storeDO') !!}" id="createDOForm">
        <div class="row">
            <h2 class="header" style="color:teal">Create Delivery Order</h2>
            <div class="clear"></div>
            <div class="input-field col s6">
                <?php $done = array();?>
                <select class="" name="do_id" onchange="showItems(this.value)">
                    <option value="" disabled selected>Choose Delivery Order</option>
                    @foreach ($trs as $res)
                        @if(!in_array($res->PO_DO_id, $done))
                            <option value="{{$res->PO_DO_id}}">{{$res->PO_DO_id}}</option>
                            <?php $done[] = $res->PO_DO_id; ?>
                        @endif
                    @endforeach
                </select>
                <label for="DO_ID">Delivery Order ID</label>
            </div>
            <div class="clear"></div>
            <div class="input-field col s6" id="items_id_array">
                {{-- ajax content --}}
            </div>
            <div class="clear"></div>
            <div class="input-field col s6" id="items_qty_array">
                {{-- ajax content --}}
            </div>
            <div class="clear"></div>
            <div class="input-field col s6">
                <input type="date" class="datepicker" name="date"/>
                <label for="date">DO Date</label>
            </div><div class="clear"></div>
            <div class="input-field col s6">
                <input type="date" class="datepicker" name="delivery_date"/>
                <label>Delivery Date</label>
            </div>
            <div class="clear"></div>
            <div class="input-field col s6">
                <input type="text" id="sender" name="sender"/>
                <label for="sender">Sender</label>
            </div>
            <div class="clear"></div>
            <div class="input-field col s6">
                <input type="text" id="recipient" name="recipient"/>
                <label for="recipient">Recipient</label>
            </div>
            <div class="clear"></div>
            <div class="input-field col s4"></div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
        $('#createDOForm').validate(
            {
                rules:
                {
                    do_id:
                    {
                            required: true
                    },
                    items_id_array:
                    {
                        required: true
                    },
                    items_qty_array:
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
                                        location.replace('/storage/DO');
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
                var str ='<input name="items_id_array" type="text" value="';
                console.log(responseText);
                for(data in responseText){
                    str += responseText[data].item_id+", ";
                }
                str += '"/><label for="" class="active">Items</label>';
                console.log(str);
                document.getElementById("items_id_array").innerHTML = str;

                // items_qty_array
                var str ='<input name="items_qty_array" type="text" value="';
                console.log(responseText);
                for(data in responseText){
                    str += responseText[data].item_qty+", ";
                }
                str += '"/><label for="" class="active">Items qty.</label>';
                console.log(str);
                document.getElementById("items_qty_array").innerHTML = str;

            }
        };
        xhttp.open("GET", "/storage/DO/"+str, true);
        xhttp.send();
    }
    </script>
@endsection
