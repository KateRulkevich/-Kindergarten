<?php
namespace app\controllers;
use \app\models as model;

class Controller_Main extends \Controller
{
	public function __construct ()
	{
		parent::__construct();
		$this->view->tpl = 'main';
		$this->view->css = 'main_page';
	}

	public function action_index()
	{
		$this->model = new model\Articles();
		$this->data['about'] = $this->model->getNoticeArt('about_us');
		$this->data['extra_course'] = $this->model->getNoticeArt('extra_course');
		$this->model = new model\Bosses();
		$this->data['big_boss'] = $this->model->getBigBoss();
		$this->model = new model\News();
		$this->data['last_news'] = $this->model->getLastNews();
		$this->model = new model\Jobs();
		$this->data['last_job'] = $this->model->getLastJob();
		
		$this->view->generate($this->data);
				
	}



}
