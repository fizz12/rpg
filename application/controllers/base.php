<?php

class Base_Controller extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

	public function __construct()
	{
		Asset::add('jquery', 'js/jquery-1.9.1.min.js');
		Asset::add('bootstrap-js', 'js/bootstrap.min.js');
		Asset::add('bootstrap-css', 'css/bootstrap.min.css');
		Asset::add('bootstrap-css-responsive', 'bootstrap-responsive.min.css');
		Asset::add('style', 'css/style.css');
		parent::__construct();
	}

}