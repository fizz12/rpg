<?php
class Dashboard_Controller extends Base_Controller
{
	/*** Display Actions -> Show Pages ***/
	public function action_index() // dashboard/[index]
	{
		return View::make('dashboard.index')->with('user', Auth::user());
	}

	public function action_profile($id) // dashboard/profile
	{
		if(!User::find($id))
			return Redirect::to('dashboard')->with('profile_error', 'That user doesn\'t exist!');
		else
		{
			$user = User::find($id);
			return View::make('dashboard/profile')->with('user', $user);
		}
	}

	public function action_account() // dashboard/account
	{
		return View::make('dashboard/account')->with('user', Auth::user());
	}

	/*** End Display Actions ***/

	/*** Dashboard Account Setting Change Functions ***/

	public function action_change_email() // Change user email -- from dashboard/account
	{
		if(!User::find(base64_decode(Input::get('uid')))) // if uid isn't found then exit, it's been messed with
			return Redirect::to('dashboard/account')->with('error', 'That user doesn\'t exist.');

		$rules = array(
			'email' => 'required|max:160|unique:users|email',
			'emailconf' => 'required|same:email',
			'password' => 'required',
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
			return Redirect::to('dashboard/account')->with_input()->with_errors($validation); // with_input saves the data to use in the view if form fails with errors
		else
		{
			$user = User::find(base64_decode(Input::get('uid')));

			if( ! Hash::check(Input::get('password'), $user->password)) // If entered password doesn't match user's password in DB -> error, redirect
				return Redirect::to('dashboard/account')->with('error', 'Incorrect password.');

			$user->email = Input::get('email');
			$user->save();

			if($user->email == Input::get('email'))
				return Redirect::to('dashboard/account')->with('status', 'Successfully changed email to "' . $user->email . '"');
			else // updating failed for some reason
				return Redirect::to('dashboard/account')->with('error', 'Failed to update email. Your email was not changed.');
		}
	}

	public function action_change_password() // Change user password -- from dashboard/account
	{
		if(!User::find(base64_decode(Input::get('uid')))) // if uid isn't found then exit
			return Redirect::to('dashboard/acacount')->with('error', 'That user doesn\'t exist.');

		$rules = array(
			'newpass'		=> 'required|max:64|min:6|different:password',
			'newpassconf'	=> 'required|same:newpass',
			'password'		=> 'required'
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation->fails())
			return Redirect::to('dashboard/account')->with_input()->with_errors($validation);
		else
		{
			$user = User::find(base64_decode(Input::get('uid')));

			if( ! Hash::check(Input::get('password'), $user->password))
				return Redirect::to('dashboard/account')->with('error', 'Incorrect Password.');

			$user->password = Hash::make(Input::get('newpass'));
			$user->save();

			if($user->password == Hash::make(Input::get('newpass')))
				return Redirect::to('dashboard/account')->with('status', 'Successfully changed password!');
			else
				return Redirect::to('dashboard/account')->with('error', 'Failed to update password. Your password was not changed.');
		}
	}

	public function action_upload_avatar($id)
	{
		if(!User::find($id))
			return Redirect::to('dashboard')->with('profile_error', 'An error occurred.');
		else
		{
			$user = User::find($id);
			// form logic and shit here to actually upl the avatar, do this later
		}
	}
}