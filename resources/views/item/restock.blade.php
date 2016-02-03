@extends('item.main')

@section('menu')
    <script src="/jquery.validate.min.js" charset="utf-8"></script>
    <script src="/jquery.form.js" charset="utf-8"></script>

<div class="row">
   <form class="col s12" method="post" action="{{ action('ItemController@itemInSave') }}" id="restockForm">
     <div class="row">
          <h2 class="header" style="color:teal">Item In</h2>
          <div class="input-field col s6">
            <input id="PO" name="PO" type="text" {{--value="{{date('Y-m-d-H:i')}}"--}}>
            <label for="PO">Purchase Order</label>
          </div>
          <div class="clear"></div>
          @if (isset($items))
          <div class="input-field col s6">
            <select name="item">
              @foreach ($items as $res)
                <option value="{{$res->id}}">{{$res->id}} - {{$res->item_name}}</option>
              @endforeach
            </select>
            <label>Nama Barang</label>
          </div>
            @else
                <div class="input-field col s1">
                  <input name="item" id="item" type="text" value="{{$item->id}}">
                  <label for="item">Item ID</label>
                </div>
                <div class="input-field col s5">
                  <input name="itemname" id="itemname" type="text" value="{{$item->item_name}}">
                  <label for="itemname">Item Name</label>
                </div>
            @endif
            <div class="clear"></div>
          <div class="input-field col s1">
            <input name="qty" id="qty" type="number" value="">
            <label for="qty">qty</label>
          </div>
          <div class="clear"></div>
          <div class="input-field col s6">
            <input class="datepicker" type="date" id="date" name="transaction_date">
            <label for="date">Tanggal</label>
          </div>
     </div>
     <input type="hidden" name="user" value="{{Session::get('user')->id}}">
     <input type="hidden" name="transaction_type" value="in">
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
     <button class="btn waves-effect waves-light" type="submit" name="action">Submit
       <i class="material-icons right">send</i>
     </button>
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

    $('#restockForm').validate(
        {
            rules:
            {
                item:
                {
                        required: true
                },
                qty:
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
