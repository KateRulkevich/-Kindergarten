<?php
namespace app\controllers;

use \app\models as model;

class Controller_About_Us extends \Controller
{
	public function __construct()
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
		$this->data = $this->model->getDescriptionArtLink('about_us');
		$this->view->generate($this->data);
	}

}
