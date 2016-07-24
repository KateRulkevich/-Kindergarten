<?php
namespace app\models;
use \app\libs as lib;

class Parents_Articles extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "parents_articles";
	}


	//получение текста статьи по id. это для статей родителям, тама по id они выводятся
	public function getArt($link)
	{
		
		$idnt = new lib\Identity( null, array ('*'));
		$idnt->field("link")->eq($link);
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);

		if ($stmt->rowCount()) {
			return $stmt->fetchAll();
		}

		return null;
	}
	public function updateAdvise($id)
	{
		$request =  new \Request();
		$this->fields['text'] = $request->getMarkup('data');
		$this->cond['id_art'] = $id;

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

	public function newAdvise($link)
	{
		$request =  new \Request();
		$this->fields['text'] = "Совет";
		$this->fields['title'] = $request->get('title');
		$this->fields['link'] = $link;

		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
	}

	public function deleteAdvise($id)
	{
		$this->cond["id_art"] = $id;
		$remove = new lib\Removing($this->table);
		$query_array = $remove->buildStatement($this->cond);
		$stmt = $this->pdo->exec($query_array[0]);		
	}


}
