<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Piutang;
use Session;
use Redirect;

class PiutangController extends Controller
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

	public function showAll()
	 {
		 if(!Session::has('user'))
	   {
		   return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
	   }
		if ($this->sesspriv == 'storage')
		{
			return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
		}
		$ptgs = Piutang::all();

		$pagin = "Piutang (semua data)";

 		return view('piutang.list')->with('ptgs', $ptgs)->with('pagin', $pagin);
	 }
	public function showLunas()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if ($this->sesspriv == 'storage')
		{
			return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
		}
		$ptgs = Piutang::where('status','ok')->get();

		$pagin = "Piutang Lunas";

	  return view('piutang.list')->with('ptgs', $ptgs)->with('pagin', $pagin);
	}

	public function showHutang()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if ($this->sesspriv == 'storage')
		{
			return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
		}
		$ptgs = Piutang::where('status','Pending')->get();

		$pagin = "Piutang Belum Lunas";

	  return view('piutang.list')->with('ptgs', $ptgs)->with('pagin', $pagin);
	}

	public function check($id)
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if ($this->sesspriv == 'storage')
		{
			return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
		}
		$ptg = Piutang::find($id);
		$ptg->status='ok';
		$ptg->save();
	}

}
