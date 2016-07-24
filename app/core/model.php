<?php
use \app\libs as lib;
class Model
{
	protected $pdo;
	//таблицы в бд
	protected $table;
	//поля, коорые буду затронуты, используются только для Updating и Removing
	protected $fields = array();
	//условия, используются только для Updating и Removing
	protected $cond = array();
	


	public function __construct()
	{
		//это объект пдо, с ним легче работать с бд
		$opt = array(
			\PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
			);
		$this->pdo = new \PDO(DSN, USER, PASSWORD, $opt);

	}
	
	public function getMenu()
	{
		
		//в массив пишутся строки, которые нужно выбрать
		$idnt = new lib\Identity( null, array ( 'link', 'name', 'R1'));
		//сюда условие, что поле R2 должно быть равно 0
		$idnt->field("R2")->eq(0);
		//сюда загодяется объект Identity, который хранит какие поля выбрать и какой where поставить
		$select = new lib\Selecting($idnt, 'menu');
		
		//в селекте прописывается какой запрос нужно собрать
		$query_array_main = $select->where()->end();
		//приготовленные запросы, методы pdo, мона в инете почитать, тут все просто
		$stmt = $this->pdo->prepare($query_array_main[0]);
		$stmt->execute($query_array_main[1]);
		
		//регистратор, чтоб не такскать меню и хидер по всему коду
		//он еще раз активируется во вьюхе
		$register = \AppRegister::init();
		$links_main = $stmt->fetchAll();

		$register->set('links_main', $links_main);
		

		//получаем дополнительное меню about
		$idnt_2 = new lib\Identity( null, array ( 'link', 'name', 'R1'));
		$idnt_2->field("R1")->eq(2)->field('R2')->noteq(0);
		$select_2 = new lib\Selecting($idnt_2, 'menu');
		$query_array_about = $select_2->where()->end();
		$stmt_2 = $this->pdo->prepare($query_array_about[0]);
		$stmt_2->execute($query_array_about[1]);
		$links_about = $stmt_2->fetchAll();
		$register->set('about', $links_about);
		
		//получаем дополнительное меню parents
		$idnt_3 = new lib\Identity( null,  array ( 'link', 'name', 'R1'));
		$idnt_3->field("R1")->eq(3)->field('R2')->noteq(0);
		$select_3 = new lib\Selecting($idnt_3, 'menu');
		$query_array_parents = $select_3->where()->end();
		$stmt_3 = $this->pdo->prepare($query_array_parents[0]);
		$stmt_3->execute($query_array_parents[1]);
		$links_parents = $stmt_3->fetchAll();
		$register->set('parents', $links_parents);



	}

	public function getHeader()
	{
		$register = \AppRegister::init();
		$current_link = $register->get('ctr');
		$idnt = new lib\Identity( null, array ( 'title', 'description', 'keywords', 'R1'));
		$idnt->field("link")->eq($current_link);
		$select = new lib\Selecting($idnt, 'menu');
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		$header = $stmt->fetch();
		$register->set('header', $header);
	}

	public function getFooter()
	{
		$register = \AppRegister::init();
		$model = new app\models\Contacts();
		$contacts = $model->getContacts();
		$register->set('contacts', $contacts);
	}

	public function feedback()
	{
		$request = new \Request();
		$email = $request->get('email');
		$name = $request->get('name');
		$to = EMAIL;
		$subject = "Сообщение от посетителя сайта $name ($email)";
		$message = $request->get('message');
		if (mail($to, $subject, $message)) {
			$request->setMessage('Спасибо за сообщение');
			$request->sendResponse();
		};
	}

}


