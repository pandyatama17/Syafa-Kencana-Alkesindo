<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use App\ItemOut;
use App\DeliveryOrder;
use Illuminate\Support\Facades\Input;


use Illuminate\Http\Request;

class FinanceCOntroller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('finance.home',array('page'=>'menu'));
	}
	public function showInvoices()
	{
		$iv = ItemOut::all();
        return view('finance.invoices',array('iv'=>$iv));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createInvoice()
	{
        $trs = DeliveryOrder::where('status','pending')->get();
        $sales = User::where('user_level','sales')->get();
        return view('finance.createInvoice',array('trs'=>$trs,'sales'=>$sales,'page'=>'invoice'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeInvoice()
	{
        $input = Input::all();
        $activeuser = \Session::get('user')->id;

        $DOdata = DeliveryOrder::where('DO_id','=',$input['do_id'])->get();

        $itemout = new ItemOut;
        $itemout->DO = $input['do_id'];
        $itemout->invoice_date = $input['invoice_date'];
        $itemout->delivery_date = $input['delivery_date'];
        $itemout->payment = $input['payment'];
        $itemout->due = $input['due_date'];
        $itemout->items_id_array = DeliveryOrder::where('DO_id','=',$input['do_id'])->pluck('items_id_array');
        $itemout->items_qty_array = DeliveryOrder::where('DO_id','=',$input['do_id'])->pluck('items_qty_array');
        $itemout->client_name = $input['client_name'];
        $itemout->client_address = $input['client_address'];
        $itemout->sender = $input['sender'];
        $itemout->recipient = $input['recipient'];
        $itemout->sales = $input['sales'];
        $itemout->storage_oncharge = DeliveryOrder::where('DO_id','=',$input['do_id'])->pluck('user');
        $itemout->admin_oncharge = $activeuser;

        try
        {
            $do = DeliveryOrder::where('DO_id','=',$input['do_id'])->update(['status'=>'ok','admin_id'=>$activeuser]);
            $itemout->save();
            $arr = array('err'=>false,'msg'=>'You created the Invoice!','id' => $itemout->id);
			echo json_encode($arr);
		}
		catch (Exception $e)
		{
			$arr = array('err'=>true,'msg'=>'Invalid Proccess.');
			echo json_encode($arr);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showInvoice($id)
	{
		$iv = ItemOut::find($id);
       return view('reports.invoice',array('iv'=>$iv));
	}
	public function srcInvoice()
	{
		$id = Input::get('id');
		$iv = ItemOut::find($id);
        return view('reports.invoice',array('iv'=>$iv));
	}
	public function getUsersForIv($id)
	{
		$do = DeliveryOrder::where('DO_id', $id)->get();
		echo json_encode($do);
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
