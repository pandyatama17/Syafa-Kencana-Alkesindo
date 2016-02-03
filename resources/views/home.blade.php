
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
<h4 class="header">Transaksi Terakhir</h4>
<table class="highlight">
	<thead>
			<!-- <td>ID</td> -->
			<td>Purchase/Delivery Order</td>
			<td>Tanggal</td>
			<td>Barang</td>
			<td>qty</td>
			<td>Supplier</td>
			<td>Jenis Transaksi</td>
			<td>PIC</td>
	</thead>
	<tbody>
		@foreach ($transactions as $res)
		<?php
			// $items = explode(',',$res['items_id_array']);
			// $qtys = explode(',',$res['items_qty_array']);
			// $rowcount = count($items);
			$supplier = DB::table('supplier')->where("id",$res->supplier_id)->pluck('supplier_name');
			$user = DB::table('user')->where("id",$res->user)->pluck('name');
		?>
		<tr>
			<!-- <td>{!! $res->id!!}</td> -->
			<td>{!! $res->PO_DO_id!!}</td>
			<td>{!! $res->transaction_date!!}</td>
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
				{{DB::table('item')->where('id',$res->item_id)->pluck('item_name') }}
			</td>
			<td>{!! $res->item_qty !!}</td>
			<td>{!! $supplier !!}</td>
			<td>{!! $res->transaction_type!!}</td>
			<td>{!! $user!!}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endif
@endsection
