<?php
namespace app\models;
use \app\libs as lib;

class Images extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "images";
	}

	//получение всех фоток
	public function getPhotos()
	{
		//сначала нужно получить уникальные названия групп фоток. 
		$idnt = new lib\Identity( null, array ( "id_group", "title"));
		$select = new lib\Selecting($idnt, "group_image");
		$query_array = $select->end();
		$stmt = $this->pdo->query($query_array[0]);
		$groups = $stmt->fetchAll();
		$stmt->closeCursor();

		//теперь надо получить все данные о картинках и растусовать их по группам
		$idnt_all = new lib\Identity( null, array ( "*"));
		//пока поле равно пустой строке
		$idnt_all->field('id_group')->eq('');
		$select_all = new lib\Selecting($idnt_all, $this->table);
		$query_array_all = $select_all->where()->end();
		//приготавливается запрос
		$stmt_all = $this->pdo->prepare($query_array_all[0]);
		$data = array();
		foreach ($groups as $val) {
			$key_group = $val['id_group'];
			//выполняется запрос. получаются все картинки с одинаковым именем группы в одну ячейку
			$stmt_all->execute(array($key_group));
			$val["photos"] = $stmt_all->fetchAll();
			$data[] = $val;
		}
		
		return $data;
	}

	public function newGroup()
	{
		$request = new \Request();
		$this->fields['title'] = $request->get('title');
		$this->fields['name_group'] = $request->getTranslit('title');
		$update = new lib\Updating("group_image");
		$query_array = $update->buildStatement($this->fields);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
	}

	public function deleteGroup($id)
	{
		$this->cond["id_group"] =  $id;

		$remove = new lib\Removing("group_image");
		$query_array = $remove->buildStatement($this->cond);
		$stmt = $this->pdo->exec($query_array[0]);
	}

	public function newPhoto($id_group)
	{
		$uploader = new lib\File_Upload("photo", "img/foto_gallery/");
		$filename = $uploader->go();

		if ($filename == true) {
			$register = \AppRegister::init();
			$request = new \Request();
			$this->fields['id_group'] =  $id_group;
			$this->fields['name'] = $filename;
			$update = new lib\Updating($this->table);
			$query_array = $update->buildStatement($this->fields);
			$stmt = $this->pdo->prepare($query_array[0]);
			$stmt->execute($query_array[1]);
			$register->set("ok",  "Изображение успешно загружено");

		} 
	}

	public function deletePhoto($id)
	{
		$this->cond["id_img"] =  $id;

		$remove = new lib\Removing($this->table);
		$query_array = $remove->buildStatement($this->cond);
		$stmt = $this->pdo->exec($query_array[0]);
		
	}

	public function getPhotoGroup($id_group)
	{
		$request = new \Request();
		$idnt = new lib\Identity( null, array ( "name"));
		$idnt->field('id_group')->eq($id_group);
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		if ($stmt->rowCount()) {
			$imgs = $stmt->fetchAll();
			$request->setData($imgs);
			$request->sendResponse();
		}


	}


}
