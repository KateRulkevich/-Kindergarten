<?php
namespace app\models;
use \app\libs as lib;

class  Eat extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "eat";
	}

	//получение нотиса статьи по линку
	public function getEat($id_group)
	{
		$idnt = new lib\Identity( null, array ( 'text_eat'));
		$idnt->field('id_group')->eq($id_group);
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		$eat = $stmt->fetch();
		if ($stmt->rowCount()) {
			return $eat['text_eat'];
		}
	}

	public function newEat($id_group)
	{
		$this->fields['text_eat'] = 'Меню';
		$this->fields['id_group'] = $id_group;
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
	}

	public function updateEat($id_group)
	{
		$request = new \Request();
		$this->fields['text_eat'] = $request->getMarkup('data');
		$this->cond['id_group'] = $id_group;
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields, $this->cond);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		if (!$stmt->rowCount()) {
			$request->setError('Не удалось сохранить изменения');
		}
		$request->setMessage('Изменения успешно сохранены');
		$request->sendResponse();
	}


}
