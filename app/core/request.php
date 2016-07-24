<?php

//для работы с данными, которые получаеются из формы и по аяксу
class Request
{

  private $request = array();

  private $code;
  private $message;
  private $status = 'ok';
  
  function __construct()
  {
    $this->init();
  }

  private function init()
  {

    if (isset($_SERVER['REQUEST_METHOD'])) {
      $this->request = $_REQUEST;

    }
    foreach ($_SERVER['argv'] as $arg) {
      if (strpos($arg, '=')) {
        list($key, $val) = explode('=', $arg);
        $this->set($key, $val);
      }
    }
  }

  private function set($key, $val) 
  {
    $this->request[$key] = $val;
  }

//получение данных с экранированием символов
  public function  get($key)
  { 
    if  ( isset($this->request[$key])) { 
      if (gettype($this->request[$key]) == 'string') {
        return htmlspecialchars(trim($this->request[$key]));
      } else {
        return $this->request[$key];
      }
    }
    return  null; 
  }


//получение данных без экраниварония, чтоб сохранять верстку в бд
  public function  getMarkup($key)
  { 
    if  ( isset($this->request[$key])) { 

      return $this->request[$key];

    }
    return  null; 
  }

//если надо перевести русское имя, полученное от формы в латиницу
  public function getTranslit($key)
  {
    if  ( isset($this->request[$key])) { 
      $rus = array(' ', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
      $lat = array('-', 'A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
      $str = htmlspecialchars(trim($this->request[$key]));
      return str_replace($rus, $lat, $str);
    }
    return  null; 
    

  }

  public function setMessage($message)
  {
    $this->message = $message;
  }

  public function getMessage()
  {
    if  ( !empty($this->message)) { 
      return $this->message;
    }
  }

  public function setError($message = "", $code = '')
  {
    $this->status = "err";
    $this->code = $code;
    $this->message = $message;
  }

  public function setData($data)
  {
    $this->data = $data;
  }

//отправляет в формате джейсон ответ аяксу
  public function sendResponse()
  {
    $this->json = array(
      "status" => $this->status,
      "code" => $this->code,
      "message" => $this->message,
      "data" => $this->data,
      );
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($this->json, ENT_NOQUOTES);
  }



}







