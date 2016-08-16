<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index($name)
	{
		$this->response->body('hello, '.$name.'!');
	}
	public function action_index2()
	{
		$this->response->body('hello, world!');
	}

} // End Welcome
