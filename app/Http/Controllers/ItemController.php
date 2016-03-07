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
use Session;
use Redirect;

class ItemController extends Controller
{

	protected $sesspriv;
	public function __construct()
	{
		$this->sesspriv = Session::get('user')->user_level;
	  if($this->sesspriv == 'admin')
	  {
		  $this->sesspriv = 'finance';
	  }
	  elseif($this->sesspriv == 'gudang')
	  {
		  $this->sesspriv = 'storage';
	  }
	}

	public function index()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if ($this->sesspriv == 'owner' || $this->sesspriv == 'finance')
	  {
		  return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
	  }
		$items = Item::all();
		return view('item.home',array('items'=>$items,'page'=>''));
	}

	public function showlist()
 	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if ($this->sesspriv == 'finance')
		{
			return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
		}
 		$items = Item::all();
 		return view('item.list',array('items'=>$items,'page'=>'list'));
 	}

	public function restock()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if ($this->sesspriv == 'finance')
		{
			return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
		}
		$items = Item::all();
		return view('item.restock',array('items'=>$items,'page'=>'restock'));
	}

	public function itemInSave()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
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

		$qty = $item->qty + $input['qty'];
		$item->qty = $qty;
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
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if ($this->sesspriv == 'finance')
		{
			return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
		}
		$suppliers = Supplier::all();
		return view('item.add',array('page'=>'list','suppliers' => $suppliers));
	}

	public function storeItem()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
			$ip = Input::all();

			$it = new Item;
			if (Input::hasFile('image'))
			{
				$file     = Input::file('image');
				$file_name = $ip['id'].'.'.$file->getClientOriginalExtension();

				$destinationPath = public_path().'/img/item';
			    $file->move($destinationPath, $file_name);
				 $it->image = $file_name;
			}
			$it->id = $ip['id'];
			$it->item_name = $ip['name'];
			$it->qty = $ip['qty'];
			$it->supplier_id = $ip['supplier'];
			$it->supplier_price = $ip['supplier_price'];
			$it->resell_price = $ip['resell_price'];
			$it->last_restock_date = $ip['transaction_date'];

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
				$arr = array('err'=>false,'msg'=>'Barang terdaftar!');
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
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}

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

		$trans = new Transaction;
		$trans->PO_DO_id = $do_id;
		$trans->transaction_date = $input['transaction_date'];
		$trans->item_id = $input['item_id'];
		$trans->item_qty = $input['qty'];
		$trans->user = $input['user'];
		$trans->transaction_type = 'out';

		$item->qty = $realnewqty;

		try
		{
			$trans->save();
			$item->save();
			$arr = array('err'=>false,'msg'=>'Barang sukses diubah!');
			echo json_encode($arr);
		}
		catch (Exception $e)
		{
			$arr = array('err'=>true,'msg'=>'Invalid Proccess.');
			echo json_encode($arr);
		}
	}

	public function showOutPage()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		$item = Item::all();
		return view ('item.out',array('items'=>$item,'page'=>'out'));
	}

	public function restockItem($id)
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if ($this->sesspriv == 'finance')
		{
			return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
		}
		$item = Item::find($id);
		$items = Item::all();
		return view('item.restock',array('page'=>'restock','item'=>$item,'items'=>$items));
	}
	public function show($id)
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if ($this->sesspriv == 'finance')
		{
			return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
		}
		$it = Item::find($id);
		$sups = SUpplier::all();
		$selectedsup = Supplier::find($it->supplier_id);
		return view('item.show',array('item'=>$it,'suppliers'=>$sups,'supplier'=>$selectedsup));
	}
	public function update()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
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

					$arr = array('err'=>false,'msg'=>'detail barang sukses diubah!','itemid'=>$it->id);
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
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if ($this->sesspriv == 'finance')
		{
			return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
		}
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
