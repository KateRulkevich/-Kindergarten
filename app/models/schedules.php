<?php
namespace app\models;
use \app\libs as lib;

class Schedules extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "schedules";
	}

	//получение нотиса статьи по линку
	public function getSchedule($id_group)
	{
		$idnt = new lib\Identity( null, array ( 'text_schedule'));
		$idnt->field('id_group')->eq($id_group);
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		$sched = $stmt->fetch();
		if ($stmt->rowCount()) {
			return $sched['text_schedule'];
		}
	}

	public function newSchedule($id_group)
	{
		$this->fields['text_schedule'] = 'Распорядок дня';
		$this->fields['id_group'] = $id_group;
		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
	}

	public function updateSchedule($id_group)
	{
		$request = new \Request();
		$this->fields['text_schedule'] = $request->getMarkup('data');
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
