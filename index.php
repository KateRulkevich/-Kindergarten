<?php

require_once 'app/config.php';
require_once 'app/core/controller.php';
// require_once 'app/core/model.php';
// require_once 'app/core/view.php';

require_once 'app/core/route.php';
require_once 'app/core/request.php';
require_once 'app/core/register.php';


try {
	spl_autoload_register();
	\Route::start(); // запуск маршрутизатора
} catch (\Exception $e) {
	// показывает ошибки
	// echo $e->__toString();

	// перенаправление на 404
	header("Location: ".URL."error");
}

//нельзя
//1. удалять класс ajax-edit
//2. удалять класс ajax
//3. изменять id в любых блоках
//4. выносить верстку за пределы if, такого типа
//
//<?php if ($sess->get('logged_admin') == true && $_SERVER['REMOTE_ADDR'] == $sess->get('ip_admin') ):
//вместе с if можно перемещать по верстке в простых статьях, остальное лучше уточнять
//
//5. ничего нельзя делать с CKEDITOR.inline('aboutNoticeEditor'); ни перемещать, ни оборачивать, ничего
//6. нельзя изменять атрибуты типа data-
//7. нельзя изменять имена форм, инпутов, textarea
//8. нельзя удалять следующие классы .photoContent, .gallery оформлять можно
//9. нельзя удалять <div class="field-message-user"></div> двигат, изменять можно
//анимировать это поле можно в ajaxSender ст 157 и 253. чуть-чуть дублирования получилось


// оформление слайд-шоу можно сделать в js/libs/flexSlider/flexslider.css
// там адаптивность по ходу less делает, но он не подключается.
// 
// еще не могу понять, что с отправкой mail(). все работает и во временно файле появляется, сообщение
// вот такое
// To: nata.sch.21@gmail.com
// Subject: Сообщение от посетителя сайта Нташа (m@j.ru)
// X-PHP-Originating-Script: 0:model.php
// текст
// 
// типа все отправлено, но само сообщение не приходит. наверное оно будет работать только если
// на хостинге лежит. я потом загуглю, если не забуду


// чтоб страница ошибки работала просто в error.tpl запихни свою верстку