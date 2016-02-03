<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Siswa;

use Illuminate\Support\Facades\Input;

class SiswaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//memanggil data di table SiswaController
		$datasiswa = Siswa::all();

		//menampilkan view  siswa/all dengan data diastas
		return view('siswa.all')->withData($datasiswa);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('siswa.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$siswa =  new Siswa;
		$siswa->nama = Input::get('nama');
		$siswa->kelas = Input::get('kelas');
		$siswa->jurusan = Input::get('jurusan');
		$siswa->tempat_lahir = Input::get('tempat_lahir');
		$siswa->tanggal_lahir = date_format(date_create(Input::get('tanggal_lahir')));
		$siswa->save();

		return redirect(url('siswa/all'));
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
		$data  = Siswa::find($id);

		return view('siswa.edit')->withData($data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$siswa =  Siswa::find(Input::get('id'));
		$siswa->nama = Input::get('nama');
		$siswa->kelas = Input::get('kelas');
		$siswa->jurusan = Input::get('jurusan');
		$siswa->tempat_lahir = Input::get('tempat_lahir');
		$siswa->tanggal_lahir = Input::get('tanggal_lahir');
		$siswa->save();

		return redirect(url('siswa/all'));
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
