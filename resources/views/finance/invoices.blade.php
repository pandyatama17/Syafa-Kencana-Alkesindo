
@extends('header')

@section('content')
<center>
	@if (!Session::has('user'))
		<h4 class="header">Welcome! Please login to access more features</h4>
</center>
@else
<br/>
<br/>
<br/>
<br/>
<h4 class="header">Invoice</h4>
<div class="divider"></div>
<br/>
<div class="col s6">
    <nav class="grey">
        <div class="nav-wrapper">
          <form method="get" action="{!! action('FinanceController@srcInvoice') !!}">
            <div class="input-field">
              <input id="search" type="search" name="id" placeholder="search invoice id" required>
              <label for="search"><i class="material-icons">search</i></label>
              <i class="material-icons">close</i>

            </div>
          </form>
        </div>
      </nav>
</div>
<br/>
<table class="highlight">
	<thead>
			<!-- <td>ID</td> -->
			<td>ID Invoice</td>
			<td>Tanggal Invoice</td>
            <td>Tanggal Pengiriman</td>
            <td>Jatuh Tempo</td>
			<td>Nama Client</td>
			<td>Alamat Client</td>
			<td>Salesman</td>
			<td>PIC</td>
            <td>Action</td>
	</thead>
	<tbody>
		@foreach ($iv as $res)
		<?php
			// $items = explode(',',$res['items_id_array']);
			// $qtys = explode(',',$res['items_qty_array']);
			// $rowcount = count($items);
			// $user = DB::table('user')->where("id",$res->user)->pluck('name');
            // $supplier = DB::table('supplier')->where("id",$res->supplier_id)->pluck('supplier_name');
		?>
		<tr>
			<td>{!! $res->id!!}</td>
			<td>{!! $res->invoice_date!!}</td>
            <td>{!! $res->delivery_date!!}</td>
            <td>{!! $res->due!!}</td>
            <td>{!! $res->client_name!!}</td>
            <td>{!! $res->client_address!!}</td>
            <td>{!! DB::table('user')->where('id','=',$res->sales)->pluck('name')!!}</td>
			<td>{!! DB::table('user')->where('id','=',$res->admin_oncharge)->pluck('name')!!}</td>
			<td>
				<!-- <ul>
				<?php
					// for ($row=0; $row < $rowcount; $row++)
					// {
					// 	echo "<li>";
					// 	$item = DB::table('item')->where('id', $items[$row])->pluck('item_name');
					// 	echo $item . " / " . $qtys[$row];
					// 	echo "</li>";
					// }
				?>
				</ul> -->
                <a href="/finance/invoice/{{$res->id}}" class="secondary-content">
                    {{--Barang Masuk--}}<i class="material-icons">pageview</i>
                </a>
			</td>
			{{-- <td>{!! $res->item_qty !!}</td>
			<td>{!! $supplier !!}</td>
			<td>{!! $res->transaction_type!!}</td>
			<td>{!! $user!!}</td> --}}
		</tr>
		@endforeach
	</tbody>
</table>
@endif
@endsection
