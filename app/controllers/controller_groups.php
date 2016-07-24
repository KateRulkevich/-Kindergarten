<?php
namespace app\controllers;
use \app\models as model;

class Controller_Groups extends \Controller
{
	public function __construct ()
	{
		parent::__construct();
		//статья с боковым разделом о нас
		$this->view->template_2 = 'aside_template';
		$this->view->tpl = 'accordion_group_template';
		$this->view->js = 'libs/flexSlider/jquery.flexslider-min';
		
		$this->view->css = 'second_page';
		$this->model = new model\Child_Groups();
	}

	public function action_index()
	{
		$this->model = new model\Child_Groups();
		$this->data = $this->model->getGroups();
		$this->view->generate($this->data);
	}

	public function action_new_group()
	{
		$last_id = $this->model->newGroup();
		$this->model = new model\Schedules();
		$this->model->newSchedule($last_id);
		$this->model = new model\Eat();
		$this->model->newEat($last_id);
		$this->model = new model\Helpers();
		$this->model->newHelper($last_id);
		header("Location: ".URL."groups");
	}

	public function action_delete_group($id)
	{
		$this->model->deleteGroup($id);
		header("Location: ".URL."groups");
	}

	public function action_new_photo($id_group)
	{
		$this->model = new model\Photo_Child_Group();
		$this->model->newPhoto($id_group);
		$this->action_index();
	}

	public function action_delete_photo($id)
	{
		$this->model = new model\Photo_Child_Group();
		$this->model->deletePhoto($id);
		header("Location: ".URL."groups");
	}

	public function action_new_educ($id_group)
	{
		$this->model = new model\Educators();
		$this->model->newEduc($id_group);
		header("Location: ".URL."groups");
	}

	public function action_delete_educ($id)
	{
		$this->model = new model\Educators();
		$this->model->deleteEduc($id);
		header("Location: ".URL."groups");
	}

	public function action_update_helper($id)
	{
		$this->model = new model\Helpers();
		$this->model->updateHelper($id);
		header("Location: ".URL."groups");
	}

	public function action_new_child($id_group)
	{
		$this->model = new model\Childs();
		$this->model->newChild($id_group);
		header("Location: ".URL."groups");
	}

	public function action_delete_child($id)
	{
		$this->model = new model\Childs();
		$this->model->deleteChild($id);
		header("Location: ".URL."groups");
	}

	public function action_get_child_photo($id_group)
	{
		$this->model = new model\Photo_Child_Group();
		$data = $this->model->getPhotos($id_group);
		$request = new \Request();
		$request->setData($data);
		$request->sendResponse();
	}

}
