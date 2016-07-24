<?php
namespace app\models;
use \app\libs as lib;

class News extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "news";
	}

	//получение нотиса статьи по линку
	public function getLastNews()
	{
		$idnt = new lib\Identity( null, array ( "*"));
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->order('id_news desc')->limit(2)->end();
		$stmt = $this->pdo->query($query_array[0]);
		return $stmt->fetchAll();
	}

	public function getAllNews()
	{
		$idnt = new lib\Identity( null, array ( "*"));
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->order('id_news desc')->end();
		$stmt = $this->pdo->query($query_array[0]);
		if ($stmt->rowCount()) {
			return $stmt->fetchAll();
		}
		return null;
	}

	public function newNews()
	{
		$uploader = new lib\File_Upload("photo", "img/news/");
		$filename = $uploader->go();

		if ($filename == true) {
			
			$request = new \Request();
			$this->fields['title'] =  $request->get('title');
			$this->fields['news_text'] =  $request->getMarkup('news_text');
			$this->fields['image_name'] = $filename;
			
			$update = new lib\Updating($this->table);
			$query_array = $update->buildStatement($this->fields);
			$stmt = $this->pdo->prepare($query_array[0]);
			$stmt->execute($query_array[1]);
		}
	}

	public function updateNews($id)
	{
		$request = new \Request();
		$uploader = new lib\File_Upload("photo", "img/news/");
		$filename = $uploader->go();
		
		if ($filename) {
			$this->fields['image_name'] = $filename;
		}

		$this->fields['title'] =  $request->get('title');
		$this->fields['news_text'] =  $request->getMarkup('news_text');
		$this->cond['id_news'] = $id;

		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields, $this->cond);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);

	}

	public function deleteNews($id)
	{
		$this->cond["id_news"] =  $id;

		$remove = new lib\Removing($this->table);
		$query_array = $remove->buildStatement($this->cond);
		$stmt = $this->pdo->exec($query_array[0]);
	}




}
