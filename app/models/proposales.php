<?php
namespace app\models;

use \app\libs as lib;

class Proposales extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "proposales";
	}

	public function getProposales()
	{
		$idnt = new lib\Identity( null, array ( "*"));
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->order('id_proposal DESC')->end();
		$stmt = $this->pdo->query($query_array[0]);
		if ($stmt->rowCount()) {
			return $stmt->fetchAll();
		}
	}

	public function newProposal()
	{
		$request = new \Request();
		$this->fields['name'] = $request->get('name');
		$this->fields['text_proposal'] = $request->get('message');
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		if ($this->pdo->lastInsertId()) {
			$register = \AppRegister::init();
			$register->set('ok', 'Спасибо за ваше предложение. Мы его обязательно рассмотрим.');
		}
	}

	public function showProposal($id)
	{
		$request = new \Request();
		$this->fields['status'] = 1;
		$this->cond['id_proposal'] = $id;
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields, $this->cond);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
	}

	public function deleteProposal($id)
	{
		$this->cond["id_proposal"] = $id;

		$remove = new lib\Removing($this->table);
		$query_array = $remove->buildStatement($this->cond);
		$stmt = $this->pdo->exec($query_array[0]);
	}

	public function like($id)
	{
		$request = new \Request();
		$good = (int) $request->get('data');
		$this->fields['good'] = $good + 1;
		$this->cond['id_proposal'] = $id;
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields, $this->cond);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		if ($stmt->rowCount()) {
			$request->setData($this->fields['good']);
			$request->sendResponse();
		}
	}

	public function dislike($id)
	{
		$request = new \Request();
		$bad = (int) $request->get('data');
		$this->fields['bad'] = $bad + 1;
		$this->cond['id_proposal'] = $id;
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields, $this->cond);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		if ($stmt->rowCount()) {
			$request->setData($this->fields['bad']);
			$request->sendResponse();
		}
	}


}
