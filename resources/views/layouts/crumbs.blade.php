<div class="col-sm-8">
   <h2>{{$crumbs['title']}}</h2>
      <ol class="breadcrumb">
         {{-- <li>
            <a href="{{url()}}">SKA</a>
         </li> --}}
         {{-- <li>
            @if(Session::get('user')->user_level == 'gudang')
               <a href="{{url('storage')}}">Gudang</a>
            @elseif(Session::get('user')->user_level == 'admin')
               <a href="{{url('admin')}}">Admin</a>
            @elseif(Session::get('user')->user_level == 'owner')
               <a href="{{url('owner')}}">Owner</a>
            @endif
         </li> --}}
         @foreach(array_slice($crumbs,1) as $crumb)
            <li><a href="{{$crumb['link']}}">{{$crumb['text']}}</a></li>
         @endforeach
      </ol>
</div>
@if(isset($crumbbutton))
   <div class="col-sm-4">
      <div class="title-action">
         {{-- @if(Session::get('user')->user_level == $crumbbutton['priv']) --}}
            <a href="{{$crumbbutton['link']}}" class="btn btn-{{$crumbbutton['type']}}"@if(isset($crumbbutton['props'])){{$crumbbutton['props']}} @endif><i class="{{$crumbbutton['icon']}}"></i> {{$crumbbutton['text']}}</a>
         {{-- @endif --}}
      </div>
   </div>
@endif
@if(isset($actionsubmit))
   <div class="col-sm-4">
      <div class="title-action">
         <button type="submit" name="button" onclick="$('form').submit()" class="btn btn-primary">Submit</button>
      </div>
   </div>
@endif
@if(isset($actionprint))
   <div class="col-sm-4">
      <div class="title-action">
         <button type="button" id="printBtn" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
      </div>
   </div>
@endif
<script type="text/javascript">
   document.title = "SKA | {{$crumbs['title']}}";
   $("#printBtn").click(function functionName()
          {
              $("#printarea").printArea({
                    mode       : "popup",
                    standard   : "html5",
                    popTitle   : 'Print',
                    popClose   : false,
                    // extraCss   : '/css/reports.css',
                    retainAttr : ["id","class","style"],
                    printDelay : 500, // tempo de atraso na impressao
                    printAlert : true,
                    printMsg   : 'Print laaa'
                });
          });
</script>
