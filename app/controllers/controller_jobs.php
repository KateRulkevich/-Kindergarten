<?php
namespace app\controllers;
use \app\models as model;

class Controller_Jobs extends \Controller
{
	public function __construct ()
	{
		parent::__construct();
		//статья с боковым разделом
		$this->view->tpl = 'jobs';
		$this->view->template_2 = 'aside_template';
		$this->view->css = 'second_page';
		$this->model = new model\Jobs();
	}
	

	public function action_index()
	{
		// $this->model = new model\Jobs();
		$this->data['jobs'] = $this->model->getJobs();
		$this->model = new model\Bosses();
		$this->data['tel_number'] = $this->model->getTelBigBoss();
		$this->model = new model\Articles();
		$this->data['art_jobs'] = $this->model->getDescriptionArtLink('jobs');
		$this->view->generate($this->data);
	}

	public function action_new_job()
	{
		$this->model->newJob();
		header('Location: '. URL.'jobs');
	}

	public function action_update_job($id)
	{
		$this->model->updateJob($id);
		header('Location: '. URL.'jobs');
	}

	public function action_delete_job($id)
	{
		$this->model->deleteJob($id);
		header('Location: '. URL.'jobs');
	}

}
