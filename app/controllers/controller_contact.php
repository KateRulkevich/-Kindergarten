<?php
namespace app\controllers;
use \app\models as model;
class Controller_Contact extends \Controller
{
	public function __construct ()
	{
		parent::__construct();
		//отдельный шаблон
		$this->view->tpl = 'contact';
		$this->view->template_2 = 'boss_template';
		$this->view->css = 'contact_page';

		$this->model = new model\Bosses();
		$big_boss = $this->model->getBigBoss();
		$register = \AppRegister::init();
		$register->set('big_boss', $big_boss);

		
	}

	public function action_index()
	{
		$this->view->generate();
	}

	public function action_update_contact()
	{
		$this->model = new model\Contacts();
		$this->model->updateContact();
		header('Location: '. URL.'contact');
	}

	

}
