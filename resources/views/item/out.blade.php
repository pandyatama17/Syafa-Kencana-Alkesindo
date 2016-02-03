@extends('item.main')

@section('menu')

<div class="row">
    <form class="" action="{{action('ItemController@getItemData')}}" method="get">
      <div class="input-field col s6">
        <select name="id" id="itemSelect">
          @foreach ($items as $res)
            <option value="{{$res->id}}">{{$res->id}} - {{$res->item_name}} | <span style="float:right">stock: {{$res->qty}}</span></option>
          @endforeach
        </select>
        <label>Barang</label>
      </div>
      <div class="clear"></div>
      <button type="submit" class="btn">Lanjut</button>
    </form>
    <div id="content">

    </div>
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

 });
 </script>
@endsection
