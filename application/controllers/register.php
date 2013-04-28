<?php
class Register_Controller extends Base_Controller
{
	public function action_index()
	{
		return View::make('register.index');
	}
}