<?php


/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/

class Route
{

	static function start()
	{
		
		//контроллер и метод/экшен по умолчанию
		$controller_name = 'main';
		$action_name = 'index';
		
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		$register = \AppRegister::init();

		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		} 
		$register->set('ctr', $controller_name);

		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		} 
		$register->set('action', $action_name);

		// получаем имя аргумента
		if ( !empty($routes[3]) )
		{
			$arg = $routes[3];
			$register->set('arg', $arg);
		}

		
		

		// // префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		$controller = "\\app\\controllers\\" . $controller_name;
		if (class_exists($controller)) {
			$obj_controller = new $controller();
		} else {
			throw new \Exception("<br>$controller_name not exist<br>");
		}
		
		$action = $action_name;
		
		if(method_exists($obj_controller, $action))
		{
			$obj_controller->$action($arg);
		} else {
			throw new \Exception("<br>$action not exist in class ". $controller_name."<br>");
		}
	
	}


}
