<?php
namespace app\controllers;
use \app\models as model;

class Controller_Proposal extends \Controller
{
	public function __construct ()
	{
		parent::__construct();
		$this->view->template_2 = 'aside_template';
		$this->view->tpl = 'proposal';
		
		$this->view->css = 'second_page';
		$this->model = new model\Proposales();
	}

	public function action_index()
	{
		$this->data = $this->model->getProposales();
		$this->view->generate($this->data);
	}

	public function action_new_proposal()
	{
		$this->model->newProposal();
		$this->action_index();
	}

	public function action_show_proposal($id)
	{
		$this->model->showProposal($id);
		header('Location: '. URL.'proposal');
	}

	public function action_delete_proposal($id)
	{
		$this->model->deleteProposal($id);
		header('Location: '. URL.'proposal');
	}

	public function action_like($id)
	{
		$this->model->like($id);
	}

	public function action_dislike($id)
	{
		$this->model->dislike($id);
	}

}
