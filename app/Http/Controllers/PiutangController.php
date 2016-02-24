<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Piutang;
use Session;
use Redirect;

class PiutangController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function showAll()
	 {
		 if(!Session::has('user'))
	   {
		   return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
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
		$ptg = Piutang::find($id);
		$ptg->status='ok';
		$ptg->save();
		// echo json_encode(array('wew'=>'wew'));
		// return 'wew';
	}
	public function index()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
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
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
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
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
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
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
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
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		//
	}

}
