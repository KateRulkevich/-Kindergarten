<?php
namespace app\controllers;

use \app\models as model;

class Controller_Error extends \Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->view->tpl = 'error';
	}

	public function action_index()
	{
		$this->view->generate();
	}

}
