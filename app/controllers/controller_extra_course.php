<?php
namespace app\controllers;
use \app\models as model;

class Controller_Extra_Course extends \Controller
{
	public function __construct ()
	{
		parent::__construct();
		//нужна спец верстка
		$this->view->tpl = 'extra_course';
		$this->view->template_2 = 'aside_template';
		$this->view->css = 'second_page';

		$this->model = new model\Courses();
	}

	public function action_index()
	{
		$this->data = $this->model->getCourses();
		$this->view->generate($this->data);
				
	}

	public function action_new_course()
	{
		$this->model->newCourse();
		header('Location: '. URL.'extra_course');
	}

	public function action_delete($id)
	{
		$this->model->deleteCourse($id);
		$this->action_index();
	}

}
