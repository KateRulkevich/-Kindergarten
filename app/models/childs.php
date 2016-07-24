<?php
namespace app\models;

use \app\libs as lib;

class Childs extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "childs";
	}

	
	public function getChilds($id_group)
	{
		$idnt = new lib\Identity( null, array ( 'id_child', 'name'));
		$idnt->field('id_group')->eq($id_group);
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		if ($stmt->rowCount()) {
			return $stmt->fetchAll();
		}
	}

	public function newChild($id_group)
	{
		$request = new \Request();
		$this->fields['name'] = $request->get('name');
		$this->fields['id_group'] = $id_group;
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
	}

	public function deleteChild($id)
	{
		$this->cond["id_child"] = $id;
		$remove = new lib\Removing($this->table);
		$query_array = $remove->buildStatement($this->cond);
		$stmt = $this->pdo->exec($query_array[0]);
	}

}
