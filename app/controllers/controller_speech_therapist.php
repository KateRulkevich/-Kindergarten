<?php
namespace app\controllers;
use \app\models as model;

class Controller_Speech_Therapist extends \Controller
{
	public function __construct ()
	{
		parent::__construct();
		//статья с боковым разделом о нас
		$this->view->template_2 = 'aside_template';
		$this->view->tpl = 'accordion_template';
		
		$this->view->css = 'second_page';
		$this->model = new model\Parents_Articles();
	}

	public function action_index()
	{
		$this->data = $this->model->getArt('speech_therapist');
		$this->view->generate($this->data);
	}

}
