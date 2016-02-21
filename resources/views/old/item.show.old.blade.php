@extends('item.main')

@section('menu')
   <link rel="stylesheet" href="/font-awesome/css/font-awesome.css" media="screen" title="no title" charset="utf-8">
<script src="/jquery.validate.min.js" charset="utf-8"></script>
<script src="/jquery.form.js" charset="utf-8"></script>

<div class="row">
   <div class="col s12">

   <div class="col s3">
      &nbsp;
   </div>
        <div class="col s6 m6" id="UserCard">
           <div class="card">
             <div class="card-image waves-effect waves-block waves-light">
               <img class="activator" src="/img/item/{{$item->id}}.jpg">
             </div>
             <div class="card-content">
               <span class="card-title activator grey-text text-darken-4">{{$item->item_name}}<i class="material-icons right">more_vert</i></span>
               <p><a href="#" id="CardAction"><i class="fa fa-pencil"></i> Edit</a></p>
             </div>
             <div class="card-reveal">
               <span class="card-title grey-text text-darken-4">{{$item->item_name}}<i class="material-icons right">close</i></span>
                 <p>
                    <div class="col s12">
                       <table style="">
                          <tr>
                             <td style="padding:5px;">Item ID</td>
                             <td style="padding:5px;">:</td>
                             <td style="padding:5px;">{{$item->id}}</td>
                          </tr>
                          <tr>
                             <td style="padding:5px;">Item Name</td>
                             <td style="padding:5px;">:</td>
                             <td style="padding:5px;">{{$item->item_name}}</td>
                          </tr>
                          <tr>
                             <td style="padding:5px;">Supplier</td>
                             <td style="padding:5px;">:</td>
                             <td style="padding:5px;">{{$supplier->supplier_name}}</td>
                          </tr>
                          <tr>
                             <td style="padding:5px;">Supplier Price</td>
                             <td style="padding:5px;">:</td>
                             <td style="padding:5px;" id="supplier_price">{{$item->supplier_price}}</td>
                          </tr>
                          <tr>
                             <td style="padding:5px;">Resell Price</td>
                             <td style="padding:5px;">:</td>
                             <td style="padding:5px;" id="resell_price">{{$item->resell_price}}</td>
                          </tr>
                       </table>
                    </div>
                    <div  class="clear"></div>
                 </p>
             </div>
          </div>
         </div>

   <form class="col s6 blue-grey lighten-5 z-depth-2 " method="post" action="{{ action('ItemController@update') }}" id="EditItemForm">
     <div class="row">
        <div class="col s12 green darken-4">
           <a href="#" id="CardAction2"><i class="material-icons right">close</i></a>
           <h4 class="header white-text">Edit Item <small style="font-size:10pt;">({{$item->item_name}})</small></h4>
        </div>
        <div class="clear"></div>
        <div class="col s12 green lighten-1">
           <p style="font-size:1pt;">&nbsp;</p>
        </div>
        <div class="clear"></div>
        <br>
        <div class="col s1">&nbsp;</div>
        <div class="col s10">

          <div class="input-field col s4">
            <input id="id" name="id" type="text" value="{{ $item->id }}">
            <label for="id" class="active">ID</label>
          </div>
          <div class="clear"></div>
          <div class="input-field col s12">
            <input id="name" name="name" type="text" value="{{$item->item_name}}">
            <label for="name">Nama Barang</label>
          </div>
          <div class="clear"></div>
          <div class="input-field col s12">
            <select name="supplier">
              @foreach ($suppliers as $res)
                 @if($res->id == $item->supplier_id)
                    <option value="{{$res->id}}" selected>{{$res->supplier_name}}</option>
                 @else
                    <option value="{{$res->id}}">{{$res->supplier_name}}</option>
                  @endif
              @endforeach
            </select>
            <label>Supplier</label>
          </div>
          <div class="clear"></div>
          <div class="input-field col s6">
            <input id="supplier_price" name="supplier_price" type="number" value="{{$item->supplier_price}}">
            <label for="supplier_price">Harga Supplier Rp.</label>
          </div>
          <div class="input-field col s6">
            <input id="resell_price" name="resell_price" type="number" value="{{$item->resell_price}}">
            <label for="resell_price">Harga Jual Rp.</label>
          </div>
          <div class="clear"></div>

          <input type="hidden" name="user" value="{{Session::get('user')->id}}">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <button class="btn waves-effect waves-light" type="submit" name="action">Submit
           <i class="material-icons right">send</i>
         </button>
      </div>
   </div>
   </form>
 </div>
</div>

 <script type="text/javascript">
 $(document).ready(function()
 {
    $('#CardAction').click(function(){
      $('#UserCard').slideToggle(function()
      {
         $('#EditItemForm').slideToggle();
      });
   });
   $('#CardAction2').click(function(){
     $('#EditItemForm').slideToggle(function()
     {
        $('#UserCard').slideToggle();
     });
  });

   var resell_price = $("#resell_price").text();
   $("#resell_price").text(rupiah(resell_price));

   var supplier_price = $("#supplier_price").text();
   $("#supplier_price").text(rupiah(supplier_price));

   $('#EditItemForm').hide();
   $('select').material_select();

    $('#EditItemForm').validate(
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

 </script>
@endsection
