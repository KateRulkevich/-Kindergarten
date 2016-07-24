<?php
namespace app\controllers;
use \app\models as model;

class Controller_Admin extends \Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->view->tpl = 'admin';
		$this->view->css = 'admin_page';
		$this->model = new model\Admin();
	}

	public function action_index()
	{
		$this->view->generate();
	}

	public function action_login()
	{
		$this->model->login();
		$this->view->generate();
	}

	public function action_logout()
	{
		$sess = \Session::init();
		$sess->destroy();
		header('Location: '. URL);
	}


}



