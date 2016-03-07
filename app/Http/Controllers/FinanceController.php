<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use App\ItemOut;
use App\DeliveryOrder;
use Illuminate\Support\Facades\Input;
use Session;
use Redirect;


use Illuminate\Http\Request;

class FinanceCOntroller extends Controller
{
	 protected $sesspriv;
	 public function __construct()
	 {
		 $this->sesspriv = Session::get('user')->user_level;
	   if($this->sesspriv == 'admin')
	   {
		   $this->sesspriv = 'finance';
	   }
	 }
	public function index()
	{
		if ($this->sesspriv == 'owner' || $this->sesspriv == 'gudang')
	  {
		  return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
	  }
		return view('finance.home',array('page'=>'menu'));
	}
	}
