<?php

abstract class Register {
  abstract protected function get($key);
  abstract protected function set($key, $val);
}

//просто класс для того, чтобы не носить по всему коду меню и хидер. сохраняется
//в главной модели, выводится вjо вьюхах
class AppRegister extends Register
{
  private $properties = array();
  private static $instance = null;

  private function __construct() {}

  static function init()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  function  get($key)
  { 
    if  ( isset($this->properties[$key])) { 
      return  $this->properties[$key]; 
    }
    return null; 
  }

 function set($key, $val)
  {
    $this->properties[$key] = $val;
  }


}



class Session extends Register
{
  private static $instance = null;
 
  private function __construct()
  {
   session_start();
  }

  static function init()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function  get($key)
  { 
    if  ( isset($_SESSION[_CLASS_][$key])) { 
      return  $_SESSION[_CLASS_][$key];
    }
    return  null; 
  }

  public function set($key, $val)
  {
    $_SESSION[_CLASS_][$key] = $val;
  }

  public function destroy()
  {
    unset($_SESSION);
    session_destroy();
  }

}