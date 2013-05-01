<?php
class User_Controller extends Base_Controller
{
	public function action_authenticate() // Login a user
	{
		#if(Auth::user()) // trying Auth::check() instead as that's official documented method for checking
		if(Auth::check())
			return Redirect::to('dashboard/index')->with('status', 'You\'re already logged in as '. Auth::user()->username .'!');

		$username = Input::get('username');
		$password = Input::get('password');

		$credentials = array(
			'username' => $username,
			'password' => $password
			);
		if(Auth::attempt($credentials))
		{
			return Redirect::to('dashboard/index')->with('status', 'Successfully logged in as <b>'.$username.'</b>!');
		}
		else
		{
			return Redirect::to('login')->with('error', 'Login failed.');;
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
				return Redirect::to('register/index')->with('error', 'Failed to register with database.');
		}
	}

	public function action_logout() // Logout the current user
	{
		#if(!Auth::user()) // using Auth::check() instead
		if( ! Auth::check())
			return Redirect::to('home/index');
		else
		{
			$username = Auth::user()->username;
			Auth::logout();
			return Redirect::to('home/index')->with('status', 'Successfully logged out, ' . $username);
		}
	}

	public function action_sendreset() // Send user email with token to reset password
	{
		$user = DB::table('users')->where('username', '=', Input::get('username'))->first();
		if(is_null($user) || empty($user)) // failed to find user by that name, so error
			return Redirect::to('login/reset')->with('error', 'Invalid username.');
		
		// Send remember email
		Message::send(function($message)
		{
			// Mailer doesn't work properly without these vars defined here
			$user = DB::table('users')->where('username', '=', Input::get('username'))->first();
			$token = md5(Str::random(20).$user->username);
			// Update user's token field in db with generated value
			DB::table('users')->where('id', '=', $user->id)->update(array('token' => $token));
			// End function defines

			$message->to($user->email)
		    ->from('noreply@fizzrpg.com', 'FizzRPG')
		    ->subject('Password Reset')
		    ->body('view: emails.pwreset');

		    $message->body->token = $token;
		    $message->body->username = $user->username;
		    $message->html(true);
		});

		if(Message::was_sent())
			return Redirect::to('login/reset')->with('status', 'Message was successfully sent to the email account associated with that username.');
		else
			return Redirect::to('login/reset')->with('error', 'Email error, message was not sent.');
	}

	public function action_doreset() // Reset user's password
	{
		// Do stuff
		$rules = array(
			'password'	=> 'required|max:64|min:6',
			'passconf'	=> 'required|max:64|same:password'
			);
		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
			return Redirect::to('login/doreset')->with_errors($validation);
		else
		{
			$token = Input::get('token');
			$user = DB::table('users')->where('token', '=', $token)->first();
			$password = Hash::make(Input::get('password'));
			if(is_null($user))
				return Redirect::to('login/doreset')->with('error', 'Invalid token.');
			else // Token is valid
			{
				$user = User::find($user->id);
				$user->password = $password;
				$user->save();

				if($user->password === $password) // Successfully updated password, delete token now.
				{
					$user->token = NULL;
					$user->save();
					return Redirect::to('login/doreset')->with('status', 'Successfully changed your password! <a href="' . URL::to('login/') .'">Login now.</a>');
				}
				else
					return Redirect::to('login/doreset')->with('error', 'Failed to reset password. Try again.');
			}

			return Redirect::to('login/doreset');
		}
	}
}