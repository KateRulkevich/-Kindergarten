<?php
namespace app\models;
use \app\libs as lib;

class Bosses extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "bosses";
	}

	//получение нотиса статьи по линку
	public function getBosses()
	{
		$idnt = new lib\Identity( null, array ( '*'));
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->end();
		$stmt = $this->pdo->query($query_array[0]);
		if ($stmt->rowCount()) {
			return $stmt->fetchAll();
		}
	}

	public function getBigBoss()
	{
		$idnt = new lib\Identity( null, array ( '*'));
		$idnt->field('status')->eq('big_boss');
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		if ($stmt->rowCount()) {
			return $stmt->fetch();
		}
	}


	public function updateBoss($id)
	{
		$uploader = new lib\File_Upload("photo", "img/bosses/");
		$filename = $uploader->go();
		if ($filename == true) {
			$this->fields['image_name'] = $filename;
		}
		$request = new \Request();
		$this->fields['name'] = $request->get('name');
		$this->fields['position'] = $request->get('position');
		$this->fields['quote'] = $request->get('quote');
		$this->fields['personal_info'] = $request->getMarkup('personal_info');
		$this->fields['tel_number'] = $request->get('tel_number');
		$this->fields['email'] = $request->get('email');
		$this->cond['id'] = $id;
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields, $this->cond);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
	}

	public function newBoss()
	{
		$uploader = new lib\File_Upload("photo", "img/bosses/");
		$filename = $uploader->go();
		if ($filename == true) {
			$this->fields['image_name'] = $filename;
			$request = new \Request();
			$this->fields['name'] = $request->get('name');
			$this->fields['position'] = $request->get('position');
			$this->fields['quote'] = $request->get('quote');
			$this->fields['personal_info'] = $request->getMarkup('personal_info');
			$this->fields['tel_number'] = $request->get('tel_number');
			$this->fields['email'] = $request->get('email');
			$update = new lib\Updating($this->table);
			$query_array = $update->buildStatement($this->fields);
			$stmt = $this->pdo->prepare($query_array[0]);
			$stmt->execute($query_array[1]);
		}

		
	}

	public function deleteBoss($id)
	{
		$this->cond["id"] = $id;
		$remove = new lib\Removing($this->table);
		$query_array = $remove->buildStatement($this->cond);
		$stmt = $this->pdo->exec($query_array[0]);

	}

	public function getTelBigBoss()
	{
		$idnt = new lib\Identity( null, array ( 'tel_number'));
		$idnt->field('status')->eq('big_boss');
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		if ($stmt->rowCount()) {
			$tel = $stmt->fetch();
			return $tel['tel_number'];
		}
	}


}
