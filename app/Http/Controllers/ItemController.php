<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use Redirect;
use File;
use Input;
use DB;

use App\Item;
use App\Supplier;
use App\OrderParent;
use App\TransactionInParent;
use App\TransactionInChild;
use App\Hutang;

class ItemController extends Controller {

	function __construct()
	{
		 $this->middleware('web');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index()
	{
		$items = Item::all();

		$crumbs = [	'title'=>'Daftar Barang',
						['text'=>'Gudang','link'=>url('item/list')],
						['text'=>'Daftar Barang','link'=>url('item/list')]];
		$crumbbutton = ['priv'=>'admin','link'=>'add','type'=>'primary','icon'=>'fa fa-plus','text'=>'Tambah barang'];

		return view('item.list')
		->with('items', $items)
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
		$sups = Supplier::all();
		$crumbs = [	'title'=>'Tambah Barang',
						['text'=>'Gudang','link'=>url('item/list')],
						['text'=>'Tambah Barang','link'=>url('storage/add')]];


		return view('item.add')
		->with('suppliers', $sups)
		->with('crumbs', $crumbs);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $r)
	{
		$it= new Item;

		// if (Input::hasFile('image'))
		// {
		// 	$file     = Input::file('image');
		// 	$file_name = $r->id.'.'.$file->getClientOriginalExtension();
		//
		// 	$destinationPath = public_path().'/img/item';
		//    $file->move($destinationPath, $file_name);
		// 	$it->image = $file_name;
		// }

		$it->item_id = $r->id;
		$it->name = $r->name;
		$it->supplier_id = $r->supplier;
		$it->supplier_price = $r->supplier_price;
		$it->resell_price = $r->resell_price;
		$it->qty = 0;
		$it->image = "default.png";

		try
		{
				$it->save();
				Session::flash('submitmsg', array('err'=>false,'title' => "Sukses!",'msg'=>'Barang berhasil disimpan'));
  			return Redirect::to(url('item/show/'.$it->id));
		}
		catch (\Illuminate\Database\QueryException $e)
		{
			Session::flash('submitmsg', array('err'=>true,'title' => "Gagal!",'msg'=>'Barang gagal disimpan'));
			return Redirect::to(url('item/list/'));
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
		$it = Item::find($id);

		$sups = Supplier::all();
		$currentSup = DB::table('suppliers')->where('id', $it->supplier_id)->pluck('name')[0];

		$crumbs = [	'title'=>'Detail Barang',
						['text'=>'Gudang','link'=>url('item/list')],
						['text'=>'Detail Barang','link'=>url('storage/add')]];

		return view('item.show')
		->with('item', $it)
		->with('suppliers', $sups)
		->with('currentSup', $currentSup)
		->with('crumbs', $crumbs);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$it = Item::find($id);

		$it->qty = $it->qty + $qty;

		$it->save();

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $r)
	{
		$it = Item::find($r->id);

		$it->item_id = $r->item_id;
		$it->name = $r->name;
		$it->supplier_id = $r->supplier_id;
		$it->supplier_price = $r->supplier_price;
		$it->resell_price = $r->resell_price;
		// $it->image = $r->image;

		$it->save();

		$arr = ['err'=>false, 'msg'=> 'Barang Terupdate'];
		echo json_encode($arr);
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

	public function getItemJSON($id)
	{
		$item = Item::find($id);
 		echo json_encode($item);
	}

	public function in()
	{
		$sups = Supplier::all();
		$its = Item::all();
		$pos = OrderParent::all();
		$crumbs = [	'title'=>'Barang Masuk',
						['text'=>'Gudang','link'=>url('item/list')],
						['text'=>'Barang Masuk','link'=>url('item/in')]];

		Session::flash('items',Item::where('supplier_id',3)->get());

		return view('item.in')
		->with('suppliers', $sups)
		->with('items', $its)
		->with('orders', $pos)
		->with('actionsubmit', true)
		->with('crumbs', $crumbs);
	}

	public function inStore(Request $r)
	{
		  $tip = new TransactionInParent;
			$htg = new Hutang;

			$tip->order_id =$r->order_id;
			$tip->supplier_do = $r->supplier_do;
			$tip->date =$r->date;
			$tip->supplier_id =$r->supplier_id;

			$htg->order_id = $r->order_id;
			$htg->total = $r->total;

      try
			{
      $tip->save();
			$htg->save();

			$saveArr = array();
			for ($x=1; $x < 10 ; $x++)
			{
					$item = $r->{'item_'.$x};
					$qty = $r->{'qty'.$x};

					if(isset($item))
					{
							$c = new TransactionInChild;
							$it = Item::find($item);

							$c->parent_id = $tip->id;
							$c->item_id = $item;
							$c->qty = $qty;

							$it->qty = $it->qty + $qty;

							$c->save();
							$it->save();

							$saveArr += ['item_'.$item =>$c];
					}
			}
			Session::flash('submitmsg', array('err'=>false,'title' => "Sukses!",'msg'=>'Barang masuk sukses'));
			return Redirect::to(url('item/list'));
		}
		catch (\Illuminate\Database\QueryException $e)
		{
			Session::flash('submitmsg', array('err'=>true,'title' => "Gagal!",'msg'=>'Barang masuk gagal'));
			return Redirect::to(url('item/list/'));
		}
	}

	public function changeSupplier($id)
	{
		Session::flash('items',Item::where('supplier_id',$id)->get());
		echo "success";
	}
}
