<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Piutang;

class PiutangController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function showAll()
	 {
		 $ptgs = Piutang::all();

		 $pagin = "Piutang (semua data)";

 		return view('piutang.list')->with('ptgs', $ptgs)->with('pagin', $pagin);
	 }
	public function showLunas()
	{
		$ptgs = Piutang::where('status','ok')->get();

		$pagin = "Piutang Lunas";

	  return view('piutang.list')->with('ptgs', $ptgs)->with('pagin', $pagin);
	}

	public function showHutang()
	{
		$ptgs = Piutang::where('status','Pending')->get();

		$pagin = "Piutang Belum Lunas";

	  return view('piutang.list')->with('ptgs', $ptgs)->with('pagin', $pagin);
	}

	public function check($id)
	{
		$ptg = Piutang::find($id);
		$ptg->status='ok';
		$ptg->save();
		// echo json_encode(array('wew'=>'wew'));
		// return 'wew';
	}
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
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

}
