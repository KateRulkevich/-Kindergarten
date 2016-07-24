<?php
namespace app\controllers;
use \app\models as model;

class Controller_Working_Time extends \Controller
{
	public function __construct ()
	{
		parent::__construct();
		//статья с боковым разделом о нас
		$this->view->tpl = 'article_template';
		$this->view->template_2 = 'aside_template';
		
		$this->view->css = 'second_page';
		$this->model = new model\Articles();
	}

	public function action_index()
	{
		$data = $this->model->getDescriptionArtLink('working_time');
		$this->view->generate($data);
	}


}
