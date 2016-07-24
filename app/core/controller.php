<?php

abstract class Controller
{
	
	protected $model;
	protected $view;
	protected $data = array();
	
	public function __construct()
	{
		$this->model = new \Model();
		$this->view = new \View();
		//в главной модели генерируется меню и хидер смотря какой контроллер. и еще контакты. потому что оно все глобальное
		$this->model->getMenu();
		$this->model->getHeader();
		$this->model->getFooter();
	}

	abstract function action_index();

	public function action_feedback()
	{
		$this->model->feedback();
	}
}
