<?php
namespace app\controllers;
use \app\models as model;
class Controller_Collective extends \Controller
{
	public function __construct ()
	{
		parent::__construct();
		//нужна спец верстка
		$this->view->tpl = 'collective';
		$this->view->template_2 = 'aside_template';
		$this->view->css = 'second_page';
	}

	public function action_index()
	{
		$this->model = new model\Bosses();
		$this->data['bosses'] = $this->model->getBosses();
		$this->model = new model\Articles();
		$this->data['collective'] = $this->model->getDescriptionArtLink('collective');
		$this->view->generate($this->data);
				
	}

	public function action_update_boss($id)
	{
		$this->model = new model\Bosses();
		$this->model->updateBoss($id);
		$this->action_index();
	}

	public function action_delete_boss($id)
	{
		$this->model = new model\Bosses();
		$this->model->deleteBoss($id);
		$this->action_index();
	}

	public function action_new_boss()
	{
		$this->model = new model\Bosses();
		$this->model->newBoss();
		$this->action_index();
	}


}
