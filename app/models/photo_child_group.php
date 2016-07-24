<?php
namespace app\models;
use \app\libs as lib;

class  Photo_Child_Group extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "photo_child_group";
	}

	public function getPhotos($id_group)
	{
		$idnt = new lib\Identity( null, array ( 'id_photo', 'photo_name'));
		$idnt->field('id_group')->eq($id_group);
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		if ($stmt->rowCount()) {
			return $stmt->fetchAll();
		}
	}

	public function newPhoto($id_group)
	{
		$uploader = new lib\File_Upload("photo", "img/photo_child_group/");
		$filename = $uploader->go();

		if ($filename == true) {
			$register = \AppRegister::init();
			$request = new \Request();
			$this->fields['id_group'] =  $id_group;
			$this->fields['photo_name'] = $filename;
			$update = new lib\Updating($this->table);
			$query_array = $update->buildStatement($this->fields);
			$stmt = $this->pdo->prepare($query_array[0]);
			$stmt->execute($query_array[1]);
			$register->set("ok",  "Изображение успешно загружено");
		} 
	}

	public function deletePhoto($id)
	{
		$this->cond["id_photo"] = $id;
		$remove = new lib\Removing($this->table);
		$query_array = $remove->buildStatement($this->cond);
		$stmt = $this->pdo->exec($query_array[0]);
	}


}
