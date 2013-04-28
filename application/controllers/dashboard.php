<?php
class Dashboard_Controller extends Base_Controller
{
	public function action_index()
	{
		return View::make('dashboard.index');
	}

	public function action_profile($id)
	{
		#$id = Input::get('id');
		return View::make('dashboard/profile')->with('id', $id);
	}
}