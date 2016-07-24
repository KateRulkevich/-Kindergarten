<?php
namespace app\models;

use \app\libs as lib;

class Courses extends \Model
{

	public function __construct()
	{ 
		parent::__construct();
		$this->table = "courses";
	}

	//получение нотиса статьи по линку
	public function getCourses()
	{
		$idnt = new lib\Identity( null, array ( '*'));
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->end();
		$stmt = $this->pdo->query($query_array[0]);
		
		return $stmt->fetchAll();
	}

	public function newCourse()
	{
		//этот объект вытаскивает отправленные поля из вормы
		//get метод обрабатывает и экранирует полученные данные. чтоб получить без обработки верстку, надо использовать getMarkup
		$request = new \Request();
		//в филдс записываем значения, которые вставятся
		$this->fields['title'] = $request->get('title');
		$this->fields['description'] = $request->get('description');
		$this->fields['educator'] = $request->get('educator');
		
		$update = new lib\Updating($this->table);
		// метод вызывается без условия, потому что вставляется новое значение
		$query_array = $update->buildStatement($this->fields);

		//подгатавливаем запрос
		$stmt = $this->pdo->prepare($query_array[0]);
		//выполняем
		$stmt->execute($query_array[1]);
	}

	public function deleteCourse($id)
	{
		
		$this->cond["id_course"] = $id;

		$remove = new lib\Removing($this->table);
		$query_array = $remove->buildStatement($this->cond);
		$stmt = $this->pdo->exec($query_array[0]);
	}

}
