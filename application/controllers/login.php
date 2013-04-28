<?php
class Login_Controller extends Base_Controller
{
	public function action_index()
	{
		return View::make('login/index');
	}
}