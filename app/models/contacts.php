<?php
namespace app\models;
use \app\libs as lib;

class Contacts extends \Model
{

	public function __construct ()
	{ 
		parent::__construct();
		$this->table = "contacts";
	}

	//получение контактов
	public function getContacts()
	{
		$idnt = new lib\Identity( null, array ( '*'));
		$select = new lib\Selecting($idnt, $this->table);
		$query_array = $select->end();
		$stmt = $this->pdo->query($query_array[0]);
		return $stmt->fetch();
	}

	public function updateContact()
	{
		$request = new \Request();
		
		$this->fields['address'] = $request->get('address');
		$this->fields['tel_number'] = $request->get('tel_number');
		$this->fields['email'] = $request->get('email');

		$this->cond['id_cont'] = $request->get('id');

		$update = new lib\Updating($this->table);
		$query_array = $update->buildStatement($this->fields, $this->cond);
		$stmt = $this->pdo->prepare($query_array[0]);
		$stmt->execute($query_array[1]);
	}

	


}
