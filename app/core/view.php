<?php

class View
{
	//устанавливаются в котроллерах
	public $js = null;
	public $css = null;
	public $tpl = null;   //подключаются tpl из вьюшек
	public $template_2 = null;
	//глобальный, тоже можно изменить из контоллера
	public $template = 'global';
	

	public function __construct ()
	{
		
	}

	public function generate($data = null)
	{
		$register = AppRegister::init();
		$header = $register->get('header');
		$contacts = $register->get('contacts');
		
		if (!is_null($this->tpl)) {
			$content_path = 'app/views/'.$this->tpl.'.tpl';

			if(!file_exists($content_path))
			{
				throw new Exception("Фаил: ".$content_path." не существует");
			} 

		}
		// дописать проверку для тпл2
		require_once 'app/views/'.$this->template.'.tpl';

	}



}
