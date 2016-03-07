<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use App\Transaction;
use App\Supplier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MainController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$transaction = Transaction::orderBy('id','desc')->take(10)->get();
		return view('home',array('transactions' => $transaction ));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function supplier()
	{
		$suppliers = Supplier::all();
 		return view('supplier.list',array('suppliers'=>$suppliers,'page'=>'supplier'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function addSupplier()
	{
		return view('supplier.add',array('page'=>'supplier'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
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
		// print_r($arr);

		if(!array_filter($arr))
		{
		   foreach ($items as $item)
		   {
		      // Item::destroy($item->id);
				$it = Item::find($item->id);
				$it->delete();
		      // echo $it->id;
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
	public function owner()
	{
		return view('owner.home');
	}
}
