<?php namespace App\Http\Controllers;

use App\Http\Requests;

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

class DOController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$sales = User::where('user_level','=','sales')->get();
		$items = Item::all();
		// print_r($items);
		// return $items;
		return view('DO.add',array('sales'=>$sales))->with('items', $items);
	}
	public function createWithInvoice($id)
	{
		$sales = User::where('user_level','=','sales')->get();
		$items = Item::all();
		$iv  = InvoiceParent::find($id);
		// print_r($items);
		// return $items;
		return view('DO.add',array('sales'=>$sales))->with('items', $items)->with('iv', $iv);
	}
	public function createWithItem($id)
	{
		$sales = User::where('user_level','=','sales')->get();
		$items = Item::all();
		$item = Item::find($id);
		$iv  = InvoiceParent::find($id);
		// print_r($items);
		// return $items;
		return view('DO.add',array('sales'=>$sales))->with('items', $items)->with('id', $id)->with('iv', $iv);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
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
		//
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
