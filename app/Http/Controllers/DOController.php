<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
//--------------
use Redirect;
use DB;
use Session;
//--------------
use App\Item;
use App\User;
use App\DeliveryOrder;
use App\ItemOut;
use App\Transaction;
use App\Supplier;
use App\Piutang;
use App\InvoiceParent;
use App\InvoiceChild;
use App\DoChild;

class DOController extends Controller
{
	protected $sesspriv;

	public function __construct()
	{
		$this->sesspriv = Session::get('user')->user_level;
		if($this->sesspriv == 'admin')
		{
			$this->sesspriv = 'finance';
		}
	}
	public function index()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		$dos = DeliveryOrder::all();

		return view('DO.list')->with('dos', $dos);
	}

	public function create()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if(Session::get('user')->user_level == 'gudang' || Session::get('user')->user_level == 'owner' )
		{
			$sales = User::where('user_level','=','sales')->get();
			$items = Item::all();
			// print_r($items);
			// return $items;
			return view('DO.add',array('sales'=>$sales))->with('items', $items);
		}
		else
		{
			return Redirect::to(url($this->sesspriv))->with('priverror', 'Insufficient Privilege');
		}
	}
	public function createWithInvoice($id)
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if(Session::get('user')->user_level == 'gudang' || Session::get('user')->user_level == 'owner' )
		{
			$sales = User::where('user_level','=','sales')->get();
			$items = Item::all();
			$iv  = InvoiceParent::find($id);
			// print_r($items);
			// return $items;
			$childs = InvoiceChild::where('parent_id',$iv->id)->get();
			$countchild = DB::table('invoice_child')->where('parent_id',$iv->id)->count();
			$total = DB::table('piutang')->where('invoice_parent_id', $iv->id)->pluck('total');
			return view('DO.add',array('sales'=>$sales))->with('items', $items)->with('id', $id)->with('iv', $iv)->with('countchild', $countchild)->with('child', $childs)->with('invoicetotal', $total)->with('total', $total);
			// return $total	;
		}
		else
		{
			return Redirect::to(url($this->sesspriv))->with('priverror', 'Insufficient Privilege');
		}

	}
	public function createWithItem($id)
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if(Session::get('user')->user_level == 'gudang' || Session::get('user')->user_level == 'owner' )
		{
			$sales = User::where('user_level','=','sales')->get();
			$items = Item::all();
			$item = Item::find($id);
			$iv  = InvoiceParent::find($id);
			// print_r($items);
			// return $items;
			return view('DO.add',array('sales'=>$sales))->with('items', $items)->with('iv', $iv);
		}
		else
		{
			return Redirect::to(url($this->sesspriv))->with('priverror', 'Insufficient Privilege');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if ($this->sesspriv == 'finance')
		{
			return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
		}

		$inp = Input::all();
		try
		{
			DeliveryOrder::create([
				'id' => $request->parent_id,
				'do_date' => $request->invoice_date,
				'due_date' => $request->due_date,
				'delivery_date' => $request->delivery_date,
				'client_name' => $request->client_name,
				'client_address' => $request->client_address,
				'sales' => $request->sales,
				'payment' => $request->payment,
				'total' => $request->total,
				'PIC' => $request->user
			]);

			$iv = InvoiceParent::find($request->parent_id);
			$iv->status="ok";

			if(isset($inp['item1']))
			{
				//---------------- Edit Item qty 1 --------------------
				$item = Item::find($request->item1);

				$item->qty = $item->qty - $request->qty1;

				$item->save();
				//---------------- save item 1 --------------------
				DoChild::create([
					'parent_id'=>$request->parent_id,
					'item_id'=>$request->item1,
					'qty'=>$request->qty1,
					'subtotal'=>$request->subtotal1,
					'discount'=>$request->discount1
				]);
				// echo "<br>data 1 exists!<br>";
				// echo $inp['item1']."<br><br>";
			}
			if(isset($inp['item2']))
			{
				//---------------- Edit Item qty 2 --------------------
				$item = Item::find($request->item2);

				$item->qty = $item->qty - $request->qty2;

				$item->save();
				//---------------- save item 2 --------------------
				DoChild::create([
					'parent_id'=>$request->parent_id,
					'item_id'=>$request->item2,
					'qty'=>$request->qty2,
					'subtotal'=>$request->subtotal2,
					'discount'=>$request->discount2
				]);
				// echo "<br>data 2 exists!<br>";
				// echo $inp['item2']."<br><br>";
			}
			if(isset($inp['item3']))
			{
				//---------------- Edit Item qty 3 --------------------
				$item = Item::find($request->item3);

				$item->qty = $item->qty - $request->qty3;

				$item->save();
				//---------------- save item 3 --------------------
				DoChild::create([
					'parent_id'=>$request->parent_id,
					'item_id'=>$request->item3,
					'qty'=>$request->qty3,
					'subtotal'=>$request->discount3
				]);
				// echo "<br>data 3 exists!<br>";
				// echo $inp['item3']."<br><br>";
			}
			if(isset($inp['item4']))
			{
				//---------------- Edit Item qty 4 --------------------
				$item = Item::find($request->item4);

				$item->qty = $item->qty - $request->qty4;

				$item->save();
				//---------------- save item 4 --------------------
				DoChild::create([
					'parent_id'=>$request->parent_id,
					'item_id'=>$request->item4,
					'qty'=>$request->qty4,
					'subtotal'=>$request->discount4
				]);
				// echo "<br>data 4 exists!<br>";
				// echo $inp['item4']."<br><br>";
			}
			if(isset($inp['item5']))
			{
				//---------------- Edit Item qty 5 --------------------
				$item = Item::find($request->item5);

				$item->qty = $item->qty - $request->qty5;

				$item->save();
				//---------------- save item 5 --------------------
				DoChild::create([
					'parent_id'=>$request->parent_id,
					'item_id'=>$request->item5,
					'qty'=>$request->qty5,
					'subtotal'=>$request->discount5
				]);
				// echo "<br>data 5 exists!<br>";
				// echo $inp['item5']."<br><br>";
			}
			if(isset($inp['item6']))
			{
				//---------------- Edit Item qty 6 --------------------
				$item = Item::find($request->item6);

				$item->qty = $item->qty - $request->qty6;

				$item->save();
				//---------------- save item 6 --------------------
				DoChild::create([
					'parent_id'=>$request->parent_id,
					'item_id'=>$request->item6,
					'qty'=>$request->qty6,
					'subtotal'=>$request->discount6
				]);
				// echo "<br>data 6 exists!<br>";
				// echo $inp['item6']."<br><br>";
			}
			if(isset($inp['item7']))
			{
				//---------------- Edit Item qty 7 --------------------
				$item = Item::find($request->item7);

				$item->qty = $item->qty - $request->qty7;

				$item->save();
				//---------------- save item 7 --------------------
				DoChild::create([
					'parent_id'=>$request->parent_id,
					'item_id'=>$request->item7,
					'qty'=>$request->qty7,
					'subtotal'=>$request->discount7
				]);
				// echo "<br>data 7 exists!<br>";
				// echo $inp['item7']."<br><br>";
			}
			if(isset($inp['item8']))
			{
				//---------------- Edit Item qty 8 --------------------
				$item = Item::find($request->item8);

				$item->qty = $item->qty - $request->qty8;

				$item->save();
				//---------------- save item 8 --------------------
				DoChild::create([
					'parent_id'=>$request->parent_id,
					'item_id'=>$request->item8,
					'qty'=>$request->qty8,
					'subtotal'=>$request->discount8
				]);
				// echo "<br>data 8 exists!<br>";
				// echo $inp['item8']."<br><br>";
			}
			if(isset($inp['item9']))
			{
				//---------------- Edit Item qty 9 --------------------
				$item = Item::find($request->item9);

				$item->qty = $item->qty - $request->qty9;

				$item->save();
				//---------------- save item 9 --------------------
				DoChild::create([
					'parent_id'=>$request->parent_id,
					'item_id'=>$request->item9,
					'qty'=>$request->qty9,
					'subtotal'=>$request->discount9
				]);
				// echo "<br>data 9 exists!<br>";
				// echo $inp['item9']."<br><br>";
			}
			if(isset($inp['item10']))
			{
				//---------------- Edit Item qty 10 --------------------
				$item = Item::find($request->item10);

				$item->qty = $item->qty - $request->qty10;

				$item->save();
				//---------------- save item 10 --------------------
				DoChild::create([
					'parent_id'=>$request->parent_id,
					'item_id'=>$request->item10,
					'qty'=>$request->qty10,
					'subtotal'=>$request->discount10
				]);
				// echo "<br>data 10 exists!<br>";
				// echo $inp['item10']."<br><br>";
			}
			$iv->save();
			// echo "yahman!";
			return Redirect::to('/deliveryorder/show/'.$request->parent_id);
		}
		catch (Exception $e)
		{
			return "Error!";
		}
 	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		$do = DeliveryOrder::find($id);
		$dochild = DoChild::where('parent_id',$do->id)->get();
		// $piutang = Piutang::where('invoice_parent_id',$id)->pluck('total');

		return view('DO.show',array('do'=>$do, 'dochilds'=> $dochild));
		// return $do;
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
