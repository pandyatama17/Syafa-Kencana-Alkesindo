<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\InvoiceParent;
use App\InvoiceChild;
use App\Customer;
use App\Item;
use App\Piutang;

use Input;
use Session;
use Redirect;

class InvoiceController extends Controller
{
    public function index()
    {
      $i = InvoiceParent::all();

  		$crumbs = [	'title'=>'Data Invoice',
  						['text'=>'Finance','link'=>url('invoice')],
  						['text'=>'Data Invoice','link'=>url('invoice')]];

      return view('invoice.list')
      ->with('invoices', $i)
      ->with('crumbs', $crumbs);
    }

    public function create()
    {
      $crumbs = [	'title'=>'Invoice',
  						['text'=>'Finance','link'=>url('invoice')],
  						['text'=>'Invoice','link'=>url('invoice/new')]];

  		$c = Customer::all();
  		$i = Item::all();
  		return view('invoice.create')
  		->with('crumbs', $crumbs)
  		->with('customers', $c)
  		->with('items', $i)
  		->with('actionsubmit', true);
  	}

    public function store(Request $r)
    {
      $total = $r->subtotal1+$r->subtotal2+$r->subtotal3+$r->subtotal4+$r->subtotal4+$r->subtotal5+$r->subtotal6+$r->subtotal7+$r->subtotal8+$r->subtotal9+$r->subtotal10;

  		$i = new InvoiceParent;
  		$i->invoice_id = $r->parent_id;
  		$i->invoice_date = $r->date;
  		$i->due_date = $r->due_date;
  		$i->delivery_date = $r->delivery_date;
      $i->customer_id = $r->customer_id;
      $i->sales_id = $r->sales_id;
  		$i->pic = \Auth::user()->id;
  		$i->total = $total;

      $p = new Piutang;
      $p->invoice_id = $r->parent_id;
      $p->total = $total;

      $i->save();
  		$p->save();
      try
      {
        $saveArr = array();
        for ($x=1; $x < 10 ; $x++)
        {
          $item = $r->{'item_'.$x};
          $qty = $r->{'qty'.$x};
          $subtotal = $r->{'subtotal'.$x};
          $discount = $r->{'discount'.$x};
          if(isset($item))
      		{
      				$c = new InvoiceChild;

      				$c->parent_id = $r->parent_id;
      				$c->item_id = $item;
      				$c->qty = $qty;
              $c->subtotal = $subtotal;
      				$c->discount = $r->discount1;

      				$c->save();

      				$saveArr += ['item_'.$item =>$c];
      		}
        }
        Session::flash('submitmsg', array('err'=>false,'title' => "Sukses!",'msg'=>'Invoice sukses dibuat'));
  			return Redirect::to(url('invoice/show/'.$i->id));
  		}
  		catch (\Illuminate\Database\QueryException $e)
  		{
  			Session::flash('submitmsg', array('err'=>true,'title' => "Gagal!",'msg'=>'Invoice gagal dibuat'));
  			return Redirect::to(url('invoice'));
  		}
  		// return 'items saved, items : <br><br>'.json_encode($saveArr);
  }

  public function show($id)
  {
    $iv = InvoiceParent::find($id);

		$c = InvoiceChild::where('parent_id',$iv->invoice_id)->get();
		$crumbs = [	'title'=>'Daftar Invoice',
						['text'=>'Finance','link'=>url('item/list')],
						['text'=>'Daftar Invoice','link'=>url('invoice/list')]];


		return view('invoice.show')
		->with('crumbs', $crumbs)
		->with('invoice', $iv)
		->with('childs', $c)
		->with('actionprint', true);
  }
}
