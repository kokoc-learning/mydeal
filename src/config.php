<?php
	//конфигурационный файл
	define('PATH_ROOT', $_SERVER['DOCUMENT_ROOT']); //корень
	define('PATH_SRC', PATH_ROOT.'/src/'); //путь к папке с файлами ядра
	define('PATH_TPL', PATH_ROOT.'/templates/'); //путь к шаблонам

	$baseFiles = []; //массив с файлами ядра для подключения в цикле
	
	$baseFiles[] = PATH_SRC.'/database.php'; //база
	$baseFiles[] = PATH_SRC.'/model.php'; //функции для работы с базой
	$baseFiles[] = PATH_SRC.'/controller.php'; //логика вывода данных в шаблоне

	foreach ($baseFiles as $value) {
		include_once($value); //подключаем файлы
	}

?>