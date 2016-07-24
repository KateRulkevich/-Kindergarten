<?php
namespace app\controllers;
use \app\models as model;

class Controller_Photo extends \Controller
{
	public function __construct ()
	{
		parent::__construct();
		//отдельный шаблон
		$this->view->tpl = 'photo';
		$this->view->template_2 = 'boss_template';
		$this->view->css = 'photo_page';
		$this->view->js = 'libs/flexSlider/jquery.flexslider-min';


		$this->model = new model\Bosses();
		$big_boss = $this->model->getBigBoss();
		$register = \AppRegister::init();
		$register->set('big_boss', $big_boss);

		
		$this->model = new model\Images();
	}

	public function action_index()
	{
		$this->data = $this->model->getPhotos();
		$this->view->generate($this->data);

	}

	public function action_new_group()
	{
		$this->model->newGroup();
		header('Location: '. URL.'photo');
	}

	public function action_delete_group($id)
	{
		$this->model->deleteGroup($id);
		$this->action_index();
	}

	public function action_new_photo($group)
	{
		$this->model->newPhoto($group);
		$this->action_index();
	}

	public function action_delete_photo($id)
	{
		$this->model->deletePhoto($id);
		$this->action_index();
	}

	public function action_get_photo_show($id_group)
	{
		$this->model->getPhotoGroup($id_group);
	}


}
