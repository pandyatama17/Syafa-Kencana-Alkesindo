@extends('item.main')

@section('menu')
<h2 class="header" style="color:teal">Suppliers</h2>
<div class="col s1">
  <a class="waves-effect waves-light btn" href="/supplier/add"><i class="material-icons left">add</i>Add Supplier</a>
</div>
<br/>
<div class="divider"></div>
<table>
  <thead>
    <tr>
        <td>ID</td>
        <td>Supplier Name</td>
        <td>Last Supply Date</td>
        <td>Last Supply Item</td>
    </tr>
  </thead>
  <tbody>
    @foreach ($suppliers as $res)
      <tr>
        <td>{!! $res->id !!}</td>
        <td>{!! $res->supplier_name !!}</td>
        <td>{!! $res->last_supply_date !!}</td>
        <td>{!! $res->last_supply_item_id !!}</td>
      </tr>
    @endforeach
  </tbody>
<table>
@endsection
