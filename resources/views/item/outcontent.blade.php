@extends('item.main')

@section('menu')
<script src="/jquery.validate.min.js" charset="utf-8"></script>
<script src="/jquery.form.js" charset="utf-8"></script>

<div class="row">
  <form class="col s12" method="post" action="{{ action('ItemController@itemOut') }}" id="outForm">
    <div class="row">
         <h2 class="header" style="color:teal">Barang Keluar</h2>
          <input name="item_id" type="hidden" value="{{ $item->id }}">
         <div class="input-field col s4">
           <input id="item" name="item" type="text" value="{{ $item->id }}" disabled>
           <label for="item">ID Barang</label>
         </div>
         <div class="clear"></div>
         <div class="input-field col s4">
           <input id="itemname" name="itemname" type="text" value="{{ $item->item_name }}" disabled>
           <label for="itemname">Nama Barang</label>
         </div>
         <div class="clear"></div>
         <div class="input-field col s4" id="inptxt">
           <input id="DO" name="DO_inptxt" type="text" value="{{date('Y-m-d-')}}">
           <label for="DO">Delivery Order</label>
         </div>
         <div class="input-field col s4" id="inpsel">
           <?php $done = array();?>
           <select name="DO_inpsel" id="itemSelect">
             @foreach ($trs as $res)
              @if(!in_array($res->PO_DO_id, $done))
               <option value="{{$res->PO_DO_id}}">{{$res->PO_DO_id}}</option>
               <?php $done[] = $res->PO_DO_id; ?>
               @endif
             @endforeach
           </select>
         </div>
         <div class="input-field col s3">
           <div class="switch">
            <label>
              New
              <input id="chk" name="chk" type="checkbox">
              <span class="lever"></span>
              Existing
            </label>
          </div>
         </div>
         <div class="clear"></div>

         <div class="input-field col s1">
           <input name="qty" id="qty" type="number" value="0" max="{{$item->qty}}" min="0">
           <label for="qty">qty<small>(max {{$item->qty}})</small></label>
         </div>
         <div class="clear"></div>
         <div class="clear"></div>
         <div class="input-field col s6">
           <input class="datepicker" type="date" id="date" name="transaction_date">
           <label for="date">Date</label>
         </div>
    </div>
    <input type="hidden" name="user" value="{{Session::get('user')->id}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
      <i class="material-icons right">send</i>
    </button>
  </form>

</div>

 <script type="text/javascript">
 $(document).ready(function()
 {
   $('#inpsel').hide();
  $("#chk").change(function()
  {
      $('#inptxt').toggle();
      $('#inpsel').toggle();
  });

   $('select').material_select();
   $(".datepicker").pickadate({
     selectMonths: true, // Creates a dropdown to control month
     selectYears: 15 // Creates a dropdown of 15 years to control year
   });

   var $input = $('.datepicker').pickadate();
   // Use the picker object directly.
   var picker = $input.pickadate('picker');
    picker.set('select', new Date());


    $('#outForm').validate(
        {
            rules:
            {
                date:
                {
                        required: true
                },
                item_id:
                {
                    required: true
                },
                inpsel:
                {
                    required: true
                },

                },
                highlight: function(label)
                {
                    $(label).closest('.control-group').addClass('error');
                },
                success: function(label)
                {
                    label
                    .closest('.control-group').addClass('success');
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
                                      location.replace('/storage/out');
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
