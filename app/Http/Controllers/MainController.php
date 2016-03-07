<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use App\Transaction;
use App\Supplier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;

class MainController extends Controller {

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
		return view('home');
	}

	public function supplier()
	{
		$suppliers = Supplier::all();
 		return view('supplier.list',array('suppliers'=>$suppliers,'page'=>'supplier'));
	}

	public function addSupplier()
	{
		return view('supplier.add',array('page'=>'supplier'));
	}


	public function storeSupplier()
	{
			$ip = Input::all();

			$sup = new Supplier;
			$sup->id = $ip['id'];
			$sup->supplier_name = $ip['name'];

			try
			{
				$sup->save();
				$arr = array('err'=>false,'msg'=>'Supplier terdaftar!');
				echo json_encode($arr);
			}
			catch (Exception $e)
			{
				$arr = array('err'=>true,'msg'=>'Invalid Proccess.');
				echo json_encode($arr);
			}

	}

	public function destroySuppplier($id)
	{
		$sup = Supplier::find($id);

		$items = Item::where('supplier_id',$sup->id)->get();

		$arr = array();
		foreach ($items as $res)
		{
		   array_push($arr, $res['qty']);
		}

		if(!array_filter($arr))
		{
		   foreach ($items as $item)
		   {
				$it = Item::find($item->id);
				$it->delete();
		   }
			$sup->delete();
		   $foo = array('msg'=>'Supplier telah dihapus!', 'err'=>false);
		   echo json_encode($foo);
		}
		else {
			$foo = array('msg'=>'Masih ada barang tersisa dari '.$sup->supplier_name.' !', 'err'=>true);
		   echo json_encode($foo);
		}
	}

	public function sampInvoice()
	{
		return view('reports.invoiceDummy');
	}
    public function sampDO()
	{
		return view('reports.DO');
	}
	public function itemInReport()
	{
		$trs = Transaction::all();

		return view('reports.itemin')->with('trs', $trs);
	}
}
