<?php
class User_Controller extends Base_Controller
{
	public function action_authenticate() // Login a user
	{
		if(Auth::user())
			return Redirect::to('dashboard/index')->with('status', 'You\'re already logged in as '. Auth::user()->username .'!');

		$username = Input::get('username');
		$password = Input::get('password');

		$credentials = array(
			'username' => $username,
			'password' => $password
			);
		if(Auth::attempt($credentials))
		{
			return Redirect::to('dashboard/index')->with('status', 'Successfully logged in as <b>'.$username.'</b>');
		}
		else
		{
			return Redirect::to('login')->with('loginerror', 'Login failed.');;
		}
	}

	public function action_register() // Register a user
	{
		$rules = array(
			'username' => 'required|max:16|min:3|alpha_dash|unique:users',
			'email' => 'required|max:160|unique:users|email',
			'emailconf' => 'required|same:email',
			'password' => 'required|max:64|min:6',
			'passconf' => 'required|max:64|same:password',
			'tos' => 'required|accepted'
			);
		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
			return Redirect::to('register/index')->with_input()->with_errors($validation); // with_input saves the data to use in the view if form fails with errors
		else
		{
			$user = new User();
			$user->username = Input::get('username');
			$user->email = Input::get('email');;
			$user->password = Hash::make(Input::get('password'));;
			$user->save();

			if(Auth::login($user))
				return Redirect::to('dashboard/index')->with('status', 'Welcome to FizzRPG, '.$user->username);
			else
				return Redirect::to('register')->with_errors('Failed to register with database.');
		}
	}

	public function action_logout() // Logout the current user
	{
		if(!Auth::user())
			return Redirect::to('home/index');
		else
		{
			$username = Auth::user()->username;
			Auth::logout();
			return Redirect::to('home/index')->with('status', 'Successfully logged out, ' . $username);
		}
	}
}