<?php
namespace app\models;
use \app\libs as lib;

class Helpers extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "helpers";
	}

	
	public function getHelper($id_group)
	{
		$idnt = new lib\Identity( null, array ( 'id_helper', 'name', 'tel_number'));
		$idnt->field('id_group')->eq($id_group);
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		if ($stmt->rowCount()) {
			return $stmt->fetch();
		}
	}

	public function newHelper($id_group)
	{
		$this->fields['name'] = '';
		$this->fields['tel_number'] = '';
		$this->fields['id_group'] = $id_group;
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
	}

	public function updateHelper($id)
	{
		$request = new \Request();
		$this->fields['name'] = $request->get('name');
		$this->fields['tel_number'] = $request->get('tel_number');
		$this->cond['id_helper'] = $id;
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields, $this->cond);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
	}

	


}
