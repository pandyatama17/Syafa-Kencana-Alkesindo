<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Customer;

use Illuminate\Support\Facades\Input;
use Session;
use Redirect;

class CustomerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$c = Customer::all();

		$crumbs = [	'title'=>'Daftar Customer',
						['text'=>'Customer','link'=>url('customer/list')],
						['text'=>'Daftar Customer','link'=>url('customer/list')]];
		$crumbbutton = ['priv'=>'admin','link'=>url('customer/add'),'type'=>'primary','icon'=>'fa fa-plus','text'=>'Tambah Customer'];

		return view('customer.list')
		->with('customers', $c)
		->with('crumbs', $crumbs)
		->with('crumbbutton', $crumbbutton);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$crumbs = [	'title'=>'Tambah Customer',
						['text'=>'Customer','link'=>url('customer/list')],
						['text'=>'Tambah Customer','link'=>url('customer/add')]];

		return view('customer.add')
		->with('crumbs', $crumbs)
		->with('routing', 'store');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $req)
	{
		$r = Input::all();

		$c = new Customer;
		$c->customer_id = $req->id;
		$c->name = $req->name;
		$c->phone = $req->contact_no;
		$c->address = $req->address;
		try
		{
			$c->save();
			Session::flash('submitmsg', array('err'=>false,'title' => "Sukses!",'msg'=>'Customer sukses terdaftar'));
			return Redirect::to(url('customer'));
		}
		catch (\Illuminate\Database\QueryException $e)
		{
			Session::flash('submitmsg', array('err'=>true,'title' => "Gagal!",'msg'=>'Customer gagal terdaftar'));
			return Redirect::to(url('customer'));
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

	public function getCustomerJSON($id)
	{
		$cust = Customer::find($id);
 		echo json_encode($cust);
	}

}
