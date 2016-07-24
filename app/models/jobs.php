<?php
namespace app\models;
use \app\libs as lib;

class Jobs extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "jobs";
	}

	public function getJobs()
	{
		$idnt = new lib\Identity( null, array ( "*"));
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->end();
		$stmt = $this->pdo->query($query_array[0]);
		if ($stmt->rowCount()) {
			return $stmt->fetchAll();
		}
	}

	public function getLastJob()
	{
		$idnt = new lib\Identity( null, array ( "title"));
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->limit(1)->end();
		$stmt = $this->pdo->query($query_array[0]);
		if ($stmt->rowCount()) {
			$job = $stmt->fetch();
			return $job['title'];
		}
	}

	public function newJob()
	{
		$request = new \Request();
		$this->fields['title'] = $request->get('title');
		$this->fields['text'] = $request->getMarkup('text');
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
	}

	public function updateJob($id)
	{
		$request = new \Request();
		$this->fields['title'] = $request->get('title');
		$this->fields['text'] = $request->getMarkup('text');
		$this->cond['id_job'] = $id;
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields, $this->cond);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
	}

	public function deleteJob($id)
	{
		$this->cond["id_job"] = $id;
		$remove = new lib\Removing($this->table);
		$query_array = $remove->buildStatement($this->cond);
		$stmt = $this->pdo->exec($query_array[0]);
	}


}
