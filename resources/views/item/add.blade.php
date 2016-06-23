@extends('layouts.wrapper.form')

@section('form')
   <form class="form-horizontal" action="store" method="post" id="addItemForm" enctype="multipart/form-data">
      {{-- ID Input --}}
      <div class="form-group">
         <label class="col-sm-2 control-label">ID Barang</label>
         <div class="col-sm-10">
            <input id="id" name="id" type="text" class="form-control">
         </div>
         </div>
         {{-- Name Input --}}
         <div class="form-group">
            <label class="col-sm-2 control-label">Nama Barang</label>
            <div class="col-sm-10">
               <input id="name" name="name" type="text" class="form-control">
            </div>
         </div>
         {{-- Supplier Input --}}
         <div class="form-group">
            <label class="col-sm-2 control-label">Supplier</label>
            <div class="col-sm-10">
               <select name="supplier" id="supplier" data-placeholder="Select Supplier" class="chosen-select form-control">
                  @foreach ($suppliers as $res)
                     <option value="{{$res->id}}">{{$res->name}}</option>
                  @endforeach
               </select>
            </div>
         </div>
         {{-- Supplier Price Input --}}
         <div class="form-group">
            <label class="col-sm-2 control-label">Harga Supplier</label>
            <div class="col-sm-10">
               <input id="supplier_price" name="supplier_price" type="text" class="form-control">
            </div>
         </div>
         {{-- Resell Price Input --}}
         <div class="form-group">
            <label class="col-sm-2 control-label">Harga Jual</label>
            <div class="col-sm-10">
               <input id="resell_price" name="resell_price" type="number" class="form-control">
            </div>
         </div>
         {{-- Image Input --}}
         {{-- <div class="form-group">
            <label class="col-sm-2 control-label">Gambar</label>
            <div class="col-sm-10 upload">
               <input id="image" name="image" type="file" class="form-control file-control">
               <label for="image"><i class="fa fa-upload"></i> Pilih File</label>
            </div>
         </div>
         <div class="form-group">
            <div class="col-sm-8 col-sm-offset-2">
               <img class="img-responsive upload-preview" src="" alt="" />
            </div>
         </div> --}}
         {{-- End New Item FOrm --}}
         <div class="form-group">
            <input type="hidden" name="user" value="{{\Auth::user()->id}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-sm-2 col-sm-offset-10">
               <button type="submit" class="btn btn-primary pull-right" name="submit"><i class="fa fa-check"></i> Submit</button>
            </div>
         </div>
   </form>
@endsection
