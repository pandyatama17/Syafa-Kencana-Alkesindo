<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use App\DeliveryOrder;
use App\ItemOut;
use App\Transaction;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;

class ItemController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Item::all();
		return view('item.home',array('items'=>$items,'page'=>''));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function showlist()
 	{
 		$items = Item::all();
 		return view('item.list',array('items'=>$items,'page'=>'list'));
 	}

	public function restock()
	{
		$items = Item::all();
		return view('item.restock',array('items'=>$items,'page'=>'restock'));
	}

	public function itemInSave()
	{
		$input = Input::all();

		$item = Item::find($input['item']);
		$sup = Supplier::find($item->supplier_id);

		$trans = new Transaction;
		$trans->PO_DO_id = $input['PO'];
		$trans->transaction_date = $input['transaction_date'];
		$trans->item_id = $input['item'];
		$trans->item_qty = $input['qty'];
		$trans->user = $input['user'];
		$trans->transaction_type = $input['transaction_type'];
		$trans->supplier_id = $item->supplier_id;

		$item->qty = $input['qty'];
		$item->last_restock_date = $input['transaction_date'];

		$sup->last_supply_date = $input['transaction_date'];
		$sup->last_supply_item_id = $input['item'];
		try
		{
			$trans->save();
			$sup->save();
			$item->save();
			$arr = array('err'=>false,'msg'=>'You has been sucessfully update item.');
			echo json_encode($arr);
		}
		catch (Exception $e)
		{
			$arr = array('err'=>true,'msg'=>'Invalid Proccess.');
			echo json_encode($arr);
		}
	}

	public function addItem()
	{
		$suppliers = Supplier::all();
		return view('item.add',array('page'=>'list','suppliers' => $suppliers));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function storeItem()
	{
			$ip = Input::all();

			if (Input::hasFile('image'))
			{
				$file     = Input::file('image');
				$filename = $ip['id'].'.'.$file->getClientOriginalExtension();

				$destinationPath = public_path().'/img/item';
			    $file->move($destinationPath, $filename);

			}
			$it = new Item;
			$it->id = $ip['id'];
			$it->item_name = $ip['name'];
			$it->qty = $ip['qty'];
			$it->supplier_id = $ip['supplier'];
			$it->supplier_price = $ip['supplier_price'];
			$it->resell_price = $ip['resell_price'];
			$it->last_restock_date = $ip['transaction_date'];
			$it->image = $filename;

			if ($it->qty != 0)
			{
				$trans = new Transaction;

				$trans->PO_DO_id = $ip['PO'];
				$trans->transaction_date = $ip['transaction_date'];
				$trans->item_id = $ip['id'];
				$trans->item_qty = $ip['qty'];
				$trans->user = $ip['user'];
				$trans->transaction_type = 'in';

				$sup = Supplier::find($ip['supplier']);

				$sup->last_supply_date = $ip['transaction_date'];
				$sup->last_supply_item_id = $ip['id'];
			}

			try
			{
					$it->save();
					if ($it->qty != 0)
					{
						$trans->save();
						$sup->save();
					}
				$arr = array('err'=>false,'msg'=>'Item registered to Database');
				echo json_encode($arr);
			}
			catch (Exception $e)
			{
				$arr = array('err'=>true,'msg'=>'Invalid Proccess.');
				echo json_encode($arr);
			}

	}

	public function itemOut()
	{
		$input = Input::all();

		if (!isset($input['chk']))
		{
			$do_id = $input['DO_inptxt'];
		}
		else
		{
			$do_id = $input['DO_inpsel'];
		}


		$item = Item::find($input['item_id']);


		$oldqty = $item->qty;
		$newqty = $input['qty'];

		$realnewqty = $oldqty - $newqty ;
		// $sup = Supplier::find($input['supplier']);

		$trans = new Transaction;
		$trans->PO_DO_id = $do_id;
		$trans->transaction_date = $input['transaction_date'];
		$trans->item_id = $input['item_id'];
		$trans->item_qty = $input['qty'];
		$trans->user = $input['user'];
		$trans->transaction_type = 'out';
		//
		// $out = new Itemout;
		// $out->DO = $input['DO'];
		// $out->DO = $input['DO'];

		$item->qty = $realnewqty;

		// $sup->last_supply_date = $input['transaction_date'];
		// $sup->last_supply_item_id = $input['item'];
		try
		{
			$trans->save();
			// $sup->save();
			$item->save();
			$arr = array('err'=>false,'msg'=>'You has been sucessfully update item.');
			echo json_encode($arr);
		}
		catch (Exception $e)
		{
			$arr = array('err'=>true,'msg'=>'Invalid Proccess.');
			echo json_encode($arr);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function showOutPage()
	{
		$item = Item::all();
		return view ('item.out',array('items'=>$item,'page'=>'out'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getItemData($id)
	{
		$id = Input::get('id');
		$item = Item::find($id);
		$trans = Transaction::where('transaction_type','out')->get();
		return view ('item.outcontent',array('trs'=>$trans,'item'=>$item,'page'=>'out'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function createDO()
	{
        $trs = Transaction::where('transaction_type','out')->get();
		return view ('item.createDO',array('trs'=>$trs,'page'=>'DO'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
     public function getItemsForDO($id)
     {
		 $items = Transaction::where('PO_DO_id', $id)->get();
         echo json_encode($items);
     }

	public function storeDO()
	{
        $input = Input::all();
        $activeuser = \Session::get('user')->id;

        $do = new DeliveryOrder;
        $do->DO_id = $input['do_id'];
        $do->items_id_array = $input['items_id_array'];
        $do->items_qty_array = $input['items_qty_array'];
		$do->date = $input['date'];
        $do->delivery_date = $input['delivery_date'];
        $do->sender = $input['sender'];
        $do->recipient = $input['recipient'];
        $do->user = $activeuser;

        try
        {
            $do->save();
            $arr = array('err'=>false,'msg'=>'You created the Delivery Order!');
			echo json_encode($arr);
		}
		catch (Exception $e)
		{
			$arr = array('err'=>true,'msg'=>'Invalid Proccess.');
			echo json_encode($arr);
		}

	}
    public function showDO($id)
    {
        $do = DeliveryOrder::where('DO_id',$id)->get();

        return view('reports.DO',array('deliveryorder'=>$do));
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function restockItem($id)
	{
		$item = Item::find($id);
		$items = Item::all();
		return view('item.restock',array('page'=>'restock','item'=>$item,'items'=>$items));
	}
	public function show($id)
	{
		$it = Item::find($id);
		$sups = SUpplier::all();
		$selectedsup = Supplier::find($it->supplier_id);
		return view('item.show',array('item'=>$it,'suppliers'=>$sups,'supplier'=>$selectedsup));
	}
	public function update()
	{
			$ip = Input::all();


			$it = Item::find($ip['oldid']);
			$it->id = $ip['newid'];
			$it->item_name = $ip['name'];
			// $it->qty = $ip['qty'];
			$it->supplier_id = $ip['supplier'];
			$it->supplier_price = $ip['supplier_price'];
			$it->resell_price = $ip['resell_price'];
			// $it->last_restock_date = $ip['transaction_date'];

			if (Input::hasFile('image'))
			{
				$file     = Input::file('image');
				$filename = $ip['newid'].'.'.$file->getClientOriginalExtension();
				$destinationPath = public_path().'/img/item';
				$file->move($destinationPath, $filename);

				$it->image = $filename;
			}
			try
			{
					$it->save();

					$arr = array('err'=>false,'msg'=>'Item details updated','itemid'=>$it->id);
					echo json_encode($arr);
			}
			catch (Exception $e)
			{
				$arr = array('err'=>true,'msg'=>'Invalid Proccess.');
				echo json_encode($arr);
			}

	}
	public function destroy($id)
	{
		$it = Item::find($id);
		try
		{
				$it->delete();

				$arr = array('err'=>false,'msg'=>'Item Deleted');
				echo json_encode($arr);
		}
		catch (Exception $e)
		{
			$arr = array('err'=>true,'msg'=>'Invalid Proccess.');
			echo json_encode($arr);
		}
	}
}
