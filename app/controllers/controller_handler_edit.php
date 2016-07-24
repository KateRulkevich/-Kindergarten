<?php
namespace app\controllers;
use \app\models as model;

class Controller_Handler_Edit extends \Controller
{
	public function __construct ()
	{
		parent::__construct();
	}

	public function action_index()
	{
	}

	public function action_update_notice($id)
	{
		$this->model = new model\Articles();
		$this->model->updateNotice($id);
	}

	public function action_update_article($id)
	{
		$this->model = new model\Articles();
		$this->model->updateArticle($id);
	}


	public function action_update_schedule($id_group)
	{
		$this->model = new model\Schedules();
		$this->model->updateSchedule($id_group);
	}

	public function action_update_eat($id_group)
	{
		$this->model = new model\Eat();
		$this->model->updateEat($id_group);
	}

	public function action_new_advise($link)
	{
		$this->model = new model\Parents_Articles();
		$this->model->newAdvise($link);
		header("Location: ".URL."$link");
	}

	public function action_update_advise($id)
	{
		$this->model = new model\Parents_Articles();
		$this->model->updateAdvise($id);
	}

	public function action_delete_advise($link_id)
	{
		$str = explode("-", $link_id);
		$this->model = new model\Parents_Articles();
		$this->model->deleteAdvise($str[1]);
		header("Location: ".URL."$str[0]");
		
	}

}
