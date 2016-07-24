<?php
namespace app\models;
use \app\libs as lib;

class Child_Groups extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "child_groups";
	}

	//получение нотиса статьи по линку
	public function getGroups()
	{
		$idnt = new lib\Identity( null, array ( '*'));
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->end();
		$stmt = $this->pdo->query($query_array[0]);
		$groups = $stmt->fetchAll();

		foreach ($groups as $val) {
			$id_group = $val['id_group'];
			$model = new Schedules();
			$val["schedule"] = $model->getSchedule($id_group);
			$model = new Eat();
			$val["eat"] = $model->getEat($id_group);
			$model = new Photo_child_Group();
			$val["photos"] = $model->getPhotos($id_group);
			$model = new Educators();
			$val["educators"] = $model->getEducators($id_group);
			$model = new Helpers();
			$val["helper"] = $model->getHelper($id_group);
			$model = new Childs();
			$val["childs"] = $model->getChilds($id_group);
			$data[] = $val;
		}
		// print_r($data);
		return $data;


	}

	public function deleteGroup($id)
	{
		$this->cond["id_group"] = $id;
		$remove = new lib\Removing($this->table);
		$query_array = $remove->buildStatement($this->cond);
		$stmt = $this->pdo->exec($query_array[0]);		
	}

	public function newGroup()
	{
		$request = new \Request();
		$this->fields['title'] = $request->get('title');
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		return $this->pdo->lastInsertId();
	}


}
