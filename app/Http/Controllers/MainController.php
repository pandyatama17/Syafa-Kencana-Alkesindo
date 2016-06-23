<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use App\Transaction;
use App\Supplier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Redirect;

class MainController extends Controller {

	protected $sesspriv;
	public function __construct()
	{
		// if(Session::has('user'))
		// {
		// 	$this->sesspriv = Session::get('user')->user_level;
	  // 		if($this->sesspriv == 'admin')
	  // 		{
		//   		$this->sesspriv = 'admin';
	  // 		}
	  // 		elseif($this->sesspriv == 'gudang')
	  // 		{
		//   		$this->sesspriv = 'storage';
	  // 		}
		// }
		// else {
		// 	$this->sesspriv = "not auth";
		// }
		$this->middleware('web');
	}

	public function index()
	{
		return view('home.main');
	}
	public function owner()
	{
		return view('owner.home');
	}

	public function admin()
	{
		$crumbs = [	'title'=>'Menu Admin',
						['text'=>'Home','link'=>url('admin')]];

		return view('admin.home')
		->with('crumbs', $crumbs);
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
