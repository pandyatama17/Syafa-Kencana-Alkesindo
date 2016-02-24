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
	 public function __construct()
	 {
	 	if(!Session::has('user'))
		{
			redirect(url("login"));
		}
	 }
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
			->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		}

				// attempt to do the login
				// if (str_replace(' ','',$user->password) == sha1(Input::get('password'))) {
					if($user->password == Input::get('password'))
					{
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
					else {
						return Redirect::to(action('UserController@showLogin'))
						->with('message', 'Wrong Password')
						->withInput(Input::except('password'));
					}
	}

	public function profile()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		$user = User::find(Session::get('user')->id);
		return view('user.profile')->with('user', $user);
	}

	public function profileUpdateInfo(Request $req)
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		return $req->username." ".$req->birthdate." ".$req->birthplace." ".$req->address;
	}

	public function profileChangePassword(Request $req)
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		return $req;
	}

	public function updateAvatar(Request $req)
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
			try
			{
				$user = User::find(Session::get('user')->id);

				if (Input::hasFile('image'))
				{
					$file     = Input::file('image');
					$filename = $req->image.'.'.$file->getClientOriginalExtension();

					$destinationPath = public_path().'/img/user';
					$file->move($destinationPath, $filename);
					$user->avatar = $filename;
				}
				$user->save();
				// Session::push('user','avatar') = $filename;

				$arr = array('err'=>false,'msg'=>'Avatar Profil telah diupdate!');
				echo json_encode($arr);
			}
			catch(Exception $e)
			{
				$arr = array('err'=>true,'msg'=>'Error');
				echo json_encode($arr);
			}

	}

	public function logout()
	{
		# code...
		Session::forget('user');
		return Redirect::to('/login');
	}
	public function index()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		$users = User::all();

		return view('user.admin.list')->with('users', $users);
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
