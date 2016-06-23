@extends('layouts.wrapper.form')

@section('form')
<form class="form-horizontal" action="{{action('CustomerController@'.$routing)}}" method="post">
   {{-- ID Input --}}
   <div class="form-group">
      <label class="col-sm-3">ID Customer</label>
      <div class="col-sm-9">
         <input type="text" name="id" class="form-control" required/>
      </div>
   </div>
   {{-- Name Input --}}
   <div class="form-group">
      <label class="col-sm-3">Nama Customer</label>
      <div class="col-sm-9">
         <input type="text" name="name" class="form-control" required/>
      </div>
   </div>
   {{-- No. Telepon Input --}}
   <div class="form-group">
      <label class="col-sm-3">No. Telepon Customer</label>
      <div class="col-sm-9">
         <div class="input-group m-b">
            <span class="input-group-addon">+62</span>
            <input type="number" name="contact_no" class="form-control number-control" min="0" maxlength="15" required/>
         </div>
      </div>
   </div>
   {{-- Address Input --}}
   <div class="form-group">
      <label class="col-sm-3">Alamat Customer</label>
      <div class="col-sm-9">
         <textarea name="address" class="form-control" required></textarea>
      </div>
   </div>
   {{-- Hidden Inputs --}}
   <input type="hidden" name="_token" value="{{csrf_token()}}">
   <hr>
   <span class="pull-right">
      <button type="submit" class="btn btn-success" name="button"><i class="fa fa-save"> Submit</i></button>
   </span>
   <div class="clearfix"></div>
</form>
@endsection
