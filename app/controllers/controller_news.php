<?php
namespace app\controllers;
use \app\models as model;
class Controller_News extends \Controller
{
	public function __construct ()
	{
		parent::__construct();
		$this->view->tpl = 'news';
		$this->view->template_2 = 'boss_template';
		$this->view->css = 'news_page';

		$this->model = new model\Bosses();
		$big_boss = $this->model->getBigBoss();
		$register = \AppRegister::init();
		$register->set('big_boss', $big_boss);

		$this->model = new model\News();
		
	}

	public function action_index()
	{
		$this->data = $this->model->getAllNews();
		$this->view->generate($this->data);
	}

	public function action_new_news()
	{
		$this->model->newNews();
		$this->action_index();
	}

	public function action_update_news($id)
	{
		$this->model->updateNews($id);
		$this->action_index();
	}

	public function action_delete_news($id)
	{
		$this->model->deleteNews($id);
		$this->action_index();
	}

}
