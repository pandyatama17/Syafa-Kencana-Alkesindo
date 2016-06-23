<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use App\Customer;
use App\Supplier;
use App\OrderParent;
use App\OrderChild;
use App\Hutang;

use Input;
use Session;
use Redirect;
use Illuminate\Http\Request;

class OrderController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$crumbs = [	'title'=>'Daftar PO',
						['text'=>'Gudang','link'=>url('item/list')],
						['text'=>'Daftar PO','link'=>url('order/list')]];

		$o = OrderParent::all();

		return view('order.list')
		->with('crumbs', $crumbs)
		->with('orders', $o);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$crumbs = [	'title'=>'Order Barang',
						['text'=>'Gudang','link'=>url('item/list')],
						['text'=>'Order Barang','link'=>url('order/new')]];

		$s = Supplier::all();
		$i = Item::all();
		return view('order.create')
		->with('crumbs', $crumbs)
		->with('suppliers', $s)
		->with('items', $i)
		->with('actionsubmit', true);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $r)
	{
		// return \Auth::user();
		// return Input::all();
		$total = $r->subtotal1+$r->subtotal2+$r->subtotal3+$r->subtotal4+$r->subtotal4+$r->subtotal5+$r->subtotal6+$r->subtotal7+$r->subtotal8+$r->subtotal9+$r->subtotal10;

		$o = new OrderParent;
		$o->order_id = $r->parent_id;
		$o->order_date = $r->date;
		$o->due_date = $r->due_date;
		$o->delivery_date = $r->delivery_date;
		$o->supplier_id = $r->supplier_id;
		$o->payment = $r->payment;
		$o->pic = \Auth::user()->id;
		$o->total = $total;

		try
		{
			$o->save();

			$saveArr = $o->toArray();
			for ($x=1; $x < 10 ; $x++)
			{
				$item = $r->{'item_'.$x};
				$qty = $r->{'qty'.$x};
				$subtotal = $r->{'subtotal'.$x};
				$discount = $r->{'discount'.$x};

				if(isset($item))
				{
						$c = new OrderChild;

						$c->parent_id = $r->parent_id;
						$c->item_id = $item;
						$c->qty = $qty;
						$c->subtotal = $subtotal;

						$it = Item::find($item);
						$it->qty = $it->qty + $qty;

						$c->save();
						$it->save();

						$saveArr += ['item_'.$item =>$c];
				}
			}
			Session::flash('submitmsg', array('err'=>false,'title' => "Sukses!",'msg'=>'Purchase order sukses dibuat'));
			return Redirect::to(url('order/show/'.$o->id));
		}
		catch (\Illuminate\Database\QueryException $e)
		{
			Session::flash('submitmsg', array('err'=>true,'title' => "Gagal!",'msg'=>'Purchase order gagal dibuat'));
			return Redirect::to(url('order/list/'));
		}
		// return 'items saved, items : <br><br>'.json_encode($saveArr);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$o = OrderParent::find($id);

		$c = OrderChild::where('parent_id',$o->order_id)->get();
		$crumbs = [	'title'=>'Daftar PO',
						['text'=>'Gudang','link'=>url('item/list')],
						['text'=>'Daftar PO','link'=>url('order/list')]];


		return view('order.show')
		->with('crumbs', $crumbs)
		->with('order', $o)
		->with('childs', $c)
		->with('actionprint', true);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
