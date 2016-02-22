<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use App\User;
use App\DeliveryOrder;
use App\ItemOut;
use App\Transaction;
use App\Supplier;
use App\Piutang;
use App\InvoiceParent;
use App\InvoiceChild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;

class InvoiceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$iv = InvoiceParent::all();
      return view('invoice.list',array('ivs'=>$iv));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createInvoice()
 	{
 		$sales = User::where('user_level','=','sales')->get();
		$items = Item::all();
		// print_r($items);
		// return $items;
		return view('invoice.add',array('sales'=>$sales))->with('items', $items);
 	}
	public function old()
	{
		$sales = User::where('user_level','=','sales')->get();
		$items = Item::all();
		return view('invoice.old',array('sales'=>$sales))->with('items', $items);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	 public function getItemData($id)
	 {
		$item = Item::find($id);
 		echo json_encode($item);
	 }

	public function storeInvoice(Request $request)
 	{
		$inp = Input::all();
		try
		{
			InvoiceParent::create([
				'id' => $request->parent_id,
				'invoice_date' => $request->invoice_date,
				'due_date' => $request->due_date,
				'delivery_date' => $request->delivery_date,
				'client_name' => $request->client_name,
				'client_address' => $request->client_address,
				'sales' => $request->sales,
				'payment' => $request->payment,
				'PIC' => $request->user
			]);

			Piutang::create([
				'invoice_parent_id' =>$request->parent_id,
				'date' =>$request->invoice_date,
				'due_date' =>$request->due_date,
				'total' =>$request->total
			]);

			if(isset($inp['item1']))
			{
				//---------------- save item 1 --------------------
				InvoiceChild::create([
					'parent_id'=>$request->parent_id,
					'item_id'=>$request->item1,
					'qty'=>$request->qty1,
					'subtotal'=>$request->subtotal1,
					'discount'=>$request->discount1
				]);
			}
			if(isset($inp['item2']))
			{
				InvoiceChild::create([
					'parent_id'=>$request->parent_id,
					'item_id'=>$request->item2,
					'qty'=>$request->qty2,
					'subtotal'=>$request->subtotal2,
					'discount'=>$request->discount2
				]);
			}
			if(isset($inp['item3']))
			{
				InvoiceChild::create([
					'parent_id'=>$request->parent_id,
					'item_id'=>$request->item3,
					'qty'=>$request->qty3,
					'subtotal'=>$request->subtotal3,
					'discount'=>$request->discount3
				]);
			}
			if(isset($inp['item4']))
			{
				echo "<br>data 4 exists!<br>";
				echo $inp['item4']."<br><br>";
			}
			if(isset($inp['item5']))
			{
				echo "<br>data 5 exists!<br>";
				echo $inp['item5']."<br><br>";
			}
			if(isset($inp['item6']))
			{
				echo "<br>data 6 exists!<br>";
				echo $inp['item6']."<br><br>";
			}
			if(isset($inp['item7']))
			{
				echo "<br>data 7 exists!<br>";
				echo $inp['item7']."<br><br>";
			}
			if(isset($inp['item7']))
			{
				echo "<br>data 7 exists!<br>";
				echo $inp['item7']."<br><br>";
			}
			if(isset($inp['item8']))
			{
				echo "<br>data 8 exists!<br>";
				echo $inp['item8']."<br><br>";
			}
			if(isset($inp['item9']))
			{
				echo "<br>data 9 exists!<br>";
				echo $inp['item9']."<br><br>";
			}
			if(isset($inp['item10']))
			{
				echo "<br>data 10 exists!<br>";
				echo $inp['item10']."<br><br>";
			}
			return Redirect::to('/invoice/show/'.$request->parent_id);
		}
		catch (Exception $e)
		{
			return "mati anjeng";
		}
 	}
	public function changedatavalue($id)
	{
		return $id;
	}

	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$iv = InvoiceParent::find($id);
		$ivchild = InvoiceChild::where('parent_id',$iv->id)->get();
		$piutang = Piutang::where('invoice_parent_id',$id)->pluck('total');

		return view('reports.invoice',array('iv'=>$iv, 'ivchilds'=> $ivchild,'total'=>$piutang));
		// return $piutang;

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
	public function listPending()
	{
		$iv = InvoiceParent::where('status','pending')->get();

		return view('invoice.storage.list')->with('ivs', $iv);
	}
}
