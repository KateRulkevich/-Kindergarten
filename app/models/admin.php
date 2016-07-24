<?php
namespace app\models;
use \app\libs as lib;

class Admin extends \Model
{
	private $login;
	private $password;

	public function __construct ()
	{ 
		parent::__construct();

		$request = new \Request();
		$this->login = $request->get('login');
		$this->password = md5($request->get('password'));

		$this->table = 'admin';
		
	}


	public function login()
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$idnt = new lib\Identity( null, array ( 'id_admin'));
		$idnt->field("login")->eq($this->login)->field('password')->eq($this->password);
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->where()->end();
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
		$data = $stmt->fetch();

		$register = \AppRegister::init();
		if ($stmt->rowCount()) {
			$sess = \Session::init();
            $sess->set('id_admin', $data['id_admin']);
        	$sess->set('logged_admin', true);
            $sess->set('ip_admin', $ip);
          
            //это сообщение возвращается, если все правильно ввели
			$register->set('ok', "Авторизация прошла успешно. Для редактирования сайта перейдите в нужный вам раздел. <br>Для того, чтобы выйти из 
			административной панели, необходимо кликнуть на ссылку 'Выйти' в правом верхнем углу");
		}
		//это - если неправильно
		$register->set('err','Неправильный логин или пароль');
		return true;
	}





}
