<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Template {
	
	// default template
	public $template = 'v_index';


	//http://myshop
	public function action_index()
	{
		$this->template->title = 'Интернет магазин';
		$this->template->content = 'Конетент!!!';
	}
	
	//http://myshop/
	public function action_catalog()
	{
		$this->template->title = 'Каталог интернет магазина';
		$this->template->content = 'Конетент!!!';
	}

} // End Welcome
