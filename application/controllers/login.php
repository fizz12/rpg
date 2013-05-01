<?php
class Login_Controller extends Base_Controller
{
	public function action_index()
	{
		if(Auth::check()) // if user already logged in
			return Redirect::to('dashboard/index')->with('status', 'Already logged in!');

		return View::make('login/index');
	}

	public function action_reset()
	{
		if(Auth::check()) // already logged in
			return Redirect::to('dashboard/index')->with('error', 'Already logged in, please log out to reset a password.');

		return View::make('login/reset/index');
	}

	public function action_doreset($token = 0)
	{
		if(Auth::check()) // already logged in
			return Redirect::to('dashboard/index')->with('error', 'Already logged in, please log out to reset a password.');

		return View::make('login/reset/do/index')->with('token', $token);;
	}
}