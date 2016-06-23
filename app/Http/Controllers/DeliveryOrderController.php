<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DoParent;
use App\DoChild;
use App\Customer;
use App\Item;

use Input;
use Session;
use Redirect;

class DeliveryOrderController extends Controller
{
    public function __construct()
    {
      $this->middleware('web');
    }

    public function index()
    {
      $dop = DoParent::all();

      $crumbs = [	'title'=>'Data DO',
  						['text'=>'Finance','link'=>url('item/list')],
  						['text'=>'Data DO','link'=>url('deliveryorder')]];

      return view('deliveryorder.list')
      ->with('deliveryorders', $dop)
      ->with('crumbs', $crumbs);
    }

    public function create()
    {
      $crumbs = [	'title'=>'Deliery Order',
  						['text'=>'Gudang','link'=>url('item/list')],
  						['text'=>'Delivery Order','link'=>url('order/new')]];

  		$c = Customer::all();
  		$i = Item::all();
  		return view('deliveryorder.create')
  		->with('crumbs', $crumbs)
  		->with('customers', $c)
  		->with('items', $i)
  		->with('actionsubmit', true);
  	}

    public function store(Request $r)
    {
      // return Input::all();

      // $total = $r->subtotal1+$r->subtotal2+$r->subtotal3+$r->subtotal4+$r->subtotal4+$r->subtotal5+$r->subtotal6+$r->subtotal7+$r->subtotal8+$r->subtotal9+$r->subtotal10;

  		$i = new DoParent;
  		$i->do_id = $r->parent_id;
  		$i->do_date = $r->date;
  		$i->due_date = $r->due_date;
  		$i->delivery_date = $r->delivery_date;
      $i->customer_id = $r->customer_id;
      $i->sales_id = $r->sales_id;
  		$i->pic = \Auth::user()->id;
  		$i->total = $r->totalcost;
      try
      {
    		$i->save();

        $saveArr = array();
        for ($x=1; $x < 10 ; $x++)
        {
          $item = $r->{'item_'.$x};
          $qty = $r->{'qty'.$x};
          $subtotal = $r->{'subtotal'.$x};
          $discount = $r->{'discount'.$x};

          if(isset($item))
      		{
      				$c = new DoChild;

      				$c->parent_id = $r->parent_id;
      				$c->item_id = $item;
      				$c->qty = $qty;
              $c->subtotal = $subtotal;
      				$c->discount = $r->discount1;

              $it = Item::find($item);
              $it->qty = $it->qty - $qty;

              $c->save();
      				$it->save();

      				$saveArr += ['item_'.$item =>$c]."<br>";

      		}
        }
        Session::flash('submitmsg', array('err'=>false,'title' => "Sukses!",'msg'=>'Delivery order sukses dibuat'));
  			return Redirect::to(url('deliveryorder/show/'.$i->id));
  		}
  		catch (\Illuminate\Database\QueryException $e)
  		{
  			Session::flash('submitmsg', array('err'=>true,'title' => "Gagal!",'msg'=>'Delivery order gagal dibuat'));
  			return Redirect::to(url('deliveryorder/'));
  		}
      // return json_encode(["err" => false,"msg"=>"Purchase order sukses dibuat","redirect"=>url('order/show/'.$o->id)]);
  }

  public function show($id)
  {
    $do = DoParent::find($id);

		$c = DoChild::where('parent_id',$do->do_id)->get();
		$crumbs = [	'title'=>'Data Delivery Order',
            ['text'=>'Finance','link'=>url('item/list')],
						['text'=>'Data Delivery Order','link'=>url('deliveryorder/list')],
            ['text'=>$do->do_id,'link'=>url('deliveryorder/show/'.$id)]];


		return view('deliveryorder.show')
		->with('crumbs', $crumbs)
		->with('deliveryorder', $do)
		->with('childs', $c)
		->with('actionprint', true);
  }
}
