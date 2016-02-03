@extends('item.main')

@section('menu')
<h2 class="header" style="color:teal">Daftar Barang</h2>
<div class="col s1">
  <a class="waves-effect waves-light btn" href="/storage/add"><i class="material-icons left">add</i>Add Item</a>
</div>
<br/>
<div class="divider"></div>
<table>
  <thead>
    <tr>
        <td>ID</td>
        <td>Nama Barang</td>
        <td>qty.</td>
        <td>Supplier</td>
        <td>Harga Supplier</td>
        <td>Harga Jual</td>
        <td>Barang Keluar</td>
        <td colspan="2" style="text-align:center">Action</td>
    </tr>
  </thead>
  <tbody>
    @foreach ($items as $res)
      <tr>
        <td>{!! $res->id !!}</td>
        <td>{!! $res->item_name !!}</td>
        <td>{!! $res->qty !!}</td>
        <td>{!! DB::table('supplier')->where('id',$res->supplier_id)->pluck('supplier_name') !!}</td>
        <td>Rp. {!! number_format ($res->supplier_price, 2, ',', '.'); !!}</td>
        <td>Rp. {!! number_format ($res->resell_price, 2, ',', '.'); !!}</td>
        <td>{{DB::table('transaction')->where('transaction_type', 'out')->where('item_id', $res->id)->orderBy('transaction_date','desc')->take(1)->pluck('transaction_date')}}</td>
        <td>
            <a href="/storage/restock/{{$res->id}}" class="secondary-content">
                {{--Barang Masuk--}}<i class="material-icons">input</i>
            </a>
        </td>
        <td>
            @if ($res->qty != 0)
            <a href="/storage/out/item=%7Bid%7D?id={{$res->id}}" class="secondary-content">
                {{--Barang Keluar--}}<i class="material-icons">launch</i>
            </a>
            @else
                <a style="color:red" class="secondary-content" href="#"><i class="material-icons clickable">launch</i></a>
            @endif
        </td>
      </tr>
    @endforeach
  </tbody>
<table>
<script type="text/javascript">
    $('.clickable').click(function(){ swal("Failed!", "Stok barang tidak tersedia!", "error")})
</script>
@endsection
