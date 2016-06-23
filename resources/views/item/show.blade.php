@extends('layouts.wrapper.main')

@section('main')
   <div class="col-md-8 col-md-offset-2">
      <div class="widget-head-color-box navy-bg p-lg text-center">
         <div class="m-b-md">
            <h2 id="ItemID" class="font-bold no-margins">
               <span id="ItemEditText">Edit </span>{{$item->name}}
            </h2>
            <small>{{$item->item_id}}</small>
         </div>
         {{-- <center>
            <img src="{{asset('img/item/'.$item->image)}}" class="img-rounded rounded-border m-b-md img-responsive" alt="profile" id="ItemImage"style="width:50%">
   		</center> --}}
         <div class="text-right">
            <a class="btn btn-xs btn-primary" id="CardAction"><i class="fa fa-edit"></i> Edit</a>
         </div>
      </div>
      <div class="widget-text-box" id="ItemCard" style="box-shadow: inset 1px 4px 9px -6px;">
         <h4 class="media-heading">{{$item->name}}</h4>
         <table>
            <tr>
               <td style="padding:5px;">ID Barang</td>
               <td style="padding:5px;">:</td>
               <td style="padding:5px;">{{$item->item_id}}</td>
            </tr>
            <tr>
               <td style="padding:5px;">Nama Barang</td>
               <td style="padding:5px;">:</td>
               <td style="padding:5px;">{{$item->name}}</td>
            </tr>
            <tr>
               <td style="padding:5px;">Supplier</td>
               <td style="padding:5px;">:</td>
               <td style="padding:5px;">{{$currentSup}}</td>
            </tr>
            <tr>
               <td style="padding:5px;">Harga Supplier</td>
               <td style="padding:5px;">:</td>
               <td style="padding:5px;" id="supplier_price">{{$item->supplier_price}}</td>
            </tr>
            <tr>
               <td style="padding:5px;">Harga Jual</td>
               <td style="padding:5px;">:</td>
               <td style="padding:5px;" id="resell_price">{{$item->resell_price}}</td>
            </tr>
         </table>
         <div class="text-right">
            <a class="deleteBtn btn btn-xs btn-danger" data-href="{{url('storage/delete/'.$item->id)}}" id="{{$item->item_id}}"><i class="fa fa-trash"></i> Delete</a>
            <a class="btn btn-xs btn-primary" id="CardAction2"><i class="fa fa-edit"></i> Edit</a>
         </div>
      </div>
      <div class="widget-text-box" id="EditItemContainer" style="box-shadow: inset 1px 4px 9px -6px;">
         <form class="form-horizontal" method="post" action="{{ action('ItemController@update') }}" id="EditItemForm" enctype="multipart/form-data">
            {{-- ID Input --}}
            <div class="form-group">
               <label class="col-sm-3 control-label">ID Barang</label>
               <div class="col-sm-8">
                  <input id="item_id" name="item_id" type="text" class="form-control" value="{{$item->item_id}}">
               </div>
            </div>
            {{-- Name Input --}}
            <div class="form-group">
               <label class="col-sm-3 control-label">Nama Barang</label>
               <div class="col-sm-8">
                  <input id="name" name="name" type="text" class="form-control" value="{{$item->name}}">
               </div>
            </div>
            {{-- Supplier Input --}}
            <div class="form-group">
               <label class="col-sm-3 control-label">Supplier</label>
               <div class="col-sm-8">
                  <select name="supplier_id" class="form-control">
                     @foreach ($suppliers as $res)
                        @if($res->id == $item->supplier_id)
                           <option value="{{$res->id}}" selected>{{$res->name}}</option>
                        @else
                           <option value="{{$res->id}}">{{$res->name}}</option>
                        @endif
                     @endforeach
                  </select>
               </div>
            </div>
            {{-- Supplier Price Input --}}
            <div class="form-group">
               <label class="col-sm-3 control-label">Harga Supplier</label>
               <div class="col-sm-8">
                  <input id="supplier_price" name="supplier_price" type="number" class="form-control" value="{{$item->supplier_price}}">
               </div>
            </div>
            {{-- Resell Price Input --}}
            <div class="form-group">
               <label class="col-sm-3 control-label">Harga Jual</label>
               <div class="col-sm-8">
                  <input id="resell_price" name="resell_price" type="number" class="form-control" value="{{$item->resell_price}}">
               </div>
            </div>
            {{-- Image Input --}}
            {{-- <div class="form-group">
               <label class="col-sm-3 control-label">Gambar</label>
               <div class="col-sm-9 upload">
                  <input id="image" name="image" type="file" class="form-control file-control">
                  <label for="image"><i class="fa fa-upload"></i> Pilih File</label>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-3 control-label">Preview Gambar</label>
               <div class="col-sm-6">
                  <img id="prev" class="img-rounded img-responsive" src="/img/item/{{$item->image}}" name="image" alt="your image" />
               </div>
            </div> --}}
            {{-- Hidden Inputs --}}
            <input type="hidden" name="id" value="{{$item->id}}">
            <input type="hidden" name="user" value="{{\Auth::user()->id}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="text-right">
               <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
            </div>
         </form>
         </div>
   </div>
   <script src="{{asset('js/pages/item/show.js')}}" charset="utf-8"></script>
@endsection
