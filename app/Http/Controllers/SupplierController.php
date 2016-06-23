<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Supplier;

use Input;
use Session;
use Redirect;
class SupplierController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$s = Supplier::all();

		$crumbs = [	'title'=>'Daftar Supplier',
						['text'=>'Supplier','link'=>url('Supplier/list')],
						['text'=>'Daftar Supplier','link'=>url('Supplier/list')]];
		$crumbbutton = ['priv'=>'admin','link'=>url('supplier/add'),'type'=>'primary','icon'=>'fa fa-plus','text'=>'Tambah Supplier'];



		return view('supplier.list')
		->with('suppliers', $s)
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
		$crumbs = [	'title'=>'Tambah Supplier',
						['text'=>'Supplier','link'=>url('Supplier/list')],
						['text'=>'Tambah Supplier','link'=>url('Supplier/add')]];

		return view('supplier.add')
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
		// $r = Input::all();

		$s = new Supplier;
		$s->supplier_id = $req->aydi;
		$s->name = $req->name;
		$s->phone = $req->contact_no;
		$s->address = $req->address;

		try
		{
			$s->save();
			Session::flash('submitmsg', array('err'=>false,'title' => "Sukses!",'msg'=>'Supplier sukses terdaftar'));
			return Redirect::to(url('supplier'));
		}
		catch (\Illuminate\Database\QueryException $e)
		{
			Session::flash('submitmsg', array('err'=>true,'title' => "Gagal!",'msg'=>'Supplier gagal terdaftar'));
			return Redirect::to(url('supplier'));
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

	public function getSupplierJSON($id)
	{
		$s = Supplier::find($id);
 		echo json_encode($s);
	}

}
