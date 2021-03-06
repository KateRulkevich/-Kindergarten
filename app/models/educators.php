<?php
namespace app\models;
use \app\libs as lib;

class Educators extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "educators";
	}

	
	public function getEducators($id_group)
	{
		$idnt = new lib\Identity( null, array ( 'id_educ', 'name', 'tel_number'));
		$idnt->field('id_group')->eq($id_group);
		$select = new lib\Selecting($idnt, $this->table);

		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		if ($stmt->rowCount()) {
			return $stmt->fetchAll();
		}
	}

	public function newEduc($id_group)
	{
		$request = new \Request();
		$this->fields['name'] = $request->get('name');
		$this->fields['tel_number'] = $request->get('tel_number');
		$this->fields['id_group'] = $id_group;
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
	}

	public function deleteEduc($id)
	{
		$this->cond["id_educ"] = $id;
		$remove = new lib\Removing($this->table);
		$query_array = $remove->buildStatement($this->cond);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array);
	}

	


}
