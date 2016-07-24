<?php
namespace app\models;
use \app\libs as lib;

class Articles extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "articles";
	}

	public function getNoticeArt($link)
	{
		$idnt = new lib\Identity( null, array ( 'notice_art', 'id_art','title'));
		$idnt->field("link")->eq($link);
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);

		if ($stmt->rowCount()) {
			return $stmt->fetch();
		}

		return null;
	}
	
	//получение текста статьи по id. это для статей родителям, тама по id они выводятся
	public function getDescriptionArtId($id)
	{
		
		$idnt = new lib\Identity( null, array ( 'description', 'id_art','title'));
		$idnt->field("id_art")->eq($id);
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);

		if ($stmt->rowCount()) {
			return $stmt->fetch();
		}

		return null;
	}

	public function getDescriptionArtLink($link)
	{
		
		$idnt = new lib\Identity( null, array ( 'description', 'id_art','title'));
		$idnt->field("link")->eq($link);
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		if ($stmt->rowCount()) {
			return $stmt->fetch();
		}
		return null;
	}

	public function updateNotice($id)
	{
		$request =  new \Request();
		$this->fields['notice_art'] = $request->getMarkup('data');
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

	public function updateArticle($id)
	{
		$request =  new \Request();
		$this->fields['description'] = $request->getMarkup('data');
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


}
