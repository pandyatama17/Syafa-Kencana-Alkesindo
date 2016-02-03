<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function showLogin()
	{
		return view('login');
	}

	public function doLogin()
	{
		$input = Input::all();
		//check user exist or not
		$user = User::where('username', '=', Input::get('username'))->first();
		if($user == '')
		{
			return Redirect::to(action('UserController@showLogin'))
			->with('message', 'User not found')
			->with('status', 'danger')
			->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		}

				// attempt to do the login
				// if (str_replace(' ','',$user->password) == sha1(Input::get('password'))) {
					if($user->password == Input::get('password')){
					Session::put('user',$user);


					if($user->user_level == 'gudang')
					{
						return Redirect::to('/storage');
					}
					elseif ($user->user_level == 'owner')
					{
						return Redirect::to('/');
						# code...
					}
					elseif ($user->user_level == 'admin')
					{
						return Redirect::to('/finance');
						# code...
					}
						}
	}
	public function logout()
	{
		# code...
		Session::forget('user');
		return Redirect::to('/');
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
