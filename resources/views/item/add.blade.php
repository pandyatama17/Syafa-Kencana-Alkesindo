@extends('item.main')

@section('menu')
<script src="/jquery.validate.min.js" charset="utf-8"></script>
<script src="/jquery.form.js" charset="utf-8"></script>

<div class="row">
   <form class="col s12" method="post" action="{{ action('ItemController@storeItem') }}" id="addItemForm">
     <div class="row">
          <h2 class="header" style="color:teal">Add Item</h2>
          <?php
              try
              {
                  $lastid = DB::table('item')->orderBy('id','ascending')->first();
                  $newid = $lastid->id + 1;
              }
              catch(Exception $e)
              {
                  $newid = 1;
              }
          ?>
          <div class="input-field col s1">
            <input id="id" name="id" type="text" value="{{ $newid }}">
            <label for="id" class="active">ID</label>
          </div>
          <div class="clear"></div>
          <div class="input-field col s6">
            <input id="name" name="name" type="text">
            <label for="name">Nama Barang</label>
          </div>
          <div class="clear"></div>
          <div class="input-field col s6">
            <select name="supplier">
              @foreach ($suppliers as $res)
                <option value="{{$res->id}}">{{$res->supplier_name}}</option>
              @endforeach
            </select>
            <label>Supplier</label>
          </div>
          <div class="clear"></div>
          <div class="input-field col s2">
            <input id="supplier_price" name="supplier_price" type="number">
            <label for="supplier_price">Harga Supplier Rp.</label>
          </div>
          <div class="input-field col s2">
            <input id="resell_price" name="resell_price" type="number">
            <label for="resell_price">Harga Jual Rp.</label>
          </div>
          <div class="clear"></div>

          <h5 class="header" style="color:teal">Barang Masuk</h5>
          <div class="clear"></div>
          <div class="input-field col s6">
            <input id="PO" name="PO" type="text">
            <label for="PO">Purchase Order</label>
          </div>
          <div class="clear"></div>
          <div class="input-field col s1">
            <input id="qty" name="qty" type="number" min="1">
            <label for="qty">qty</label>
          </div>
          <div class="input-field col s5">
            <input class="datepicker" type="date" id="date" name="transaction_date">
            <label for="date">Tanggal</label>
          </div>
          <div class="clear"></div>

          <input type="hidden" name="user" value="{{Session::get('user')->id}}">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <button class="btn waves-effect waves-light" type="submit" name="action">Submit
           <i class="material-icons right">send</i>
         </button>
      </div>
   </form>
 </div>

 <script type="text/javascript">
 $(document).ready(function()
 {
   $('select').material_select();
   $('.datepicker').pickadate({
     selectMonths: true, // Creates a dropdown to control month
     selectYears: 15 // Creates a dropdown of 15 years to control year
   });

   var $input = $('.datepicker').pickadate();
   // Use the picker object directly.
   var picker = $input.pickadate('picker');
    picker.set('select', new Date());

    $('#addItemForm').validate(
        {
            rules:
            {
                id:
                {
                        required: true
                },
                name:
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
                                    title: "Success!",
                                    text: obj.msg,
                                    type: "success",
                                    confirmButtonColor: "#0288d1",
                                    confirmButtonText: "Ok!",
                                    closeOnConfirm: false
                                },
                                function()
                                {
                                    location.replace('/storage/list');
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
 </script>
@endsection
