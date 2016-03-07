<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller
{

	protected $sesspriv;
	public function __construct()
	{
		if (Session::has('user'))
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
						}
						elseif ($user->user_level == 'admin')
						{
							return Redirect::to('/finance');
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

		$user = User::find($req->id);

		$user->name = $req->name;
		$user->birthdate = $req->birthdate;
		$user->birthplace = $req->birthplace;
		$user->address = $req->address;
		try {
			$user->save();
			Session::forget('user');
			Session::put('user', $user);
			return Redirect::to(url('profile'));

		} catch (Exception $e) {
			return "fail!";
		}

	}

	public function profileChangePassword(Request $req)
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		$inp = Input::all();
		if ($req->password_old == Session::get('user')->password)
		{
			if($req->password_new == $req->password_repeat)
			{
				$user = User::find(Session::get('user')->id);

				$user->password = $req->password_new;

				Session::forget('user');
				Session::put('user', $user);

				try
				{
					$user->save();
					echo json_encode(array('err'=>false,'msg'=>'Password Telah Diubah!'));
				}
				catch (Exception $e)
				{
					echo json_encode(array('err'=>true,'msg'=>'Terjadi Kesalahan!'));
				}
			}
			else
			{
				echo json_encode(array('err'=>true,'msg'=>'Password Tidak Sama!'));
			}
		}
		else
		{
			echo json_encode(array('err'=>true,'msg'=>'Password Lama Anda Salah!'));
		}

	}

	public function updateAvatar(Request $req)
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
			if (Input::hasFile('image'))
			{
				$user = User::find(Session::get('user')->id);

				$file     = Input::file('image');
				$filename = $user->id.'.'.$file->getClientOriginalExtension();

				$destinationPath = public_path().'/img/user';
				$file->move($destinationPath, $filename);
				$user->avatar = $filename;

				$user->save();
				Session::forget('user');
				Session::put('user', $user);

				$arr = array('err'=>false,'msg'=>'Avatar Profil telah diupdate!');
				echo json_encode($arr);
			}
			else
			{
				$arr = array('err'=>true,'msg'=>'Error');
				echo json_encode($arr);
			}

	}

	public function logout()
	{
		Session::forget('user');
		return Redirect::to('/login');
	}
	public function index()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if ($this->sesspriv == 'finance' || $this->sesspriv == 'storage')
		{
			return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
		}
		$users = User::all();

		return view('user.admin.list')->with('users', $users);
	}

	public function create()
	{
		if(!Session::has('user'))
		{
			return Redirect::to(url('login'))->with('message', 'Silahkan Login terlebih dahulu!');
		}
		if ($this->sesspriv == 'finance' || $this->sesspriv == 'storage')
		{
			return Redirect::to($this->sesspriv)->with('priverror', 'Insufficient Permission');
		}
		return view('user.admin.create');
	}

	public function store(Request $req)
	{
		$user = new User;
		$user->username = $req->username;
		$user->name = $req->name;
		$user->birthdate = $req->birthdate;
		$user->birthplace = $req->birthplace;
		$user->address = $req->address;
		$user->user_level = $req->user_level;

		try
		{
			$user->save();

			return Redirect::to(action('UserController@create'))
			->with('msg', 'User Terdaftar!')
			->with('mestype', 'success')
			->with('mestitle', 'Success!');
		}
		catch (Exception $e)
		{
			return Redirect::to(action('UserController@create'))
			->with('msg', 'User Tidak Dapat Didaftarkan!')
			->with('mestype', 'error')
			->with('mestitle', 'Error!');
		}

	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

}
