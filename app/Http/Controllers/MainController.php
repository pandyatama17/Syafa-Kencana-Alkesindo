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
				$arr = array('err'=>false,'msg'=>'You has been sucessfully added new Supplier.');
				echo json_encode($arr);
			}
			catch (Exception $e)
			{
				$arr = array('err'=>true,'msg'=>'Invalid Proccess.');
				echo json_encode($arr);
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
