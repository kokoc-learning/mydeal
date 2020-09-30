<?php
	//подключаемся к базе данных
	$link = mysqli_connect($host, $user, $pass, $dbname);
	mysqli_set_charset($link, "utf8");

	//база данных
	$database = array(
		'pages' => array( 					                                           
			array(
				'url_key' => '/index.php', 										
				'title' => 'Главная страница - mydeal', 											
				'tpl' => 'layout.php', 
				'content' => 'main.php',     											
				'h1' => '',                  					
				'text' => ''                 
			),
			array(
				'url_key' => '/error.php', 										
				'title' => 'Ошибка - mydeal', 											
				'tpl' => 'layout.php', 
				'content' => 'error.php',     											
				'h1' => '',                  					
				'text' => ''                 
			),																		
			array(
				'url_key' => '/bytovka.php',
				'title' => '',
				'tpl' => '',
				'content' => '',
				'h1' => '',
				'text' => ''
			),
			array(
				'url_key' => '/catalog.php',
				'title' => '',
				'tpl' => '',
				'content' => '',
				'h1' => '',
				'text' => ''
			),
			array(
				'url_key' => '/contacts.php',
				'title' => '',
				'tpl' => '',
				'content' => '',
				'h1' => '',
				'text' => ''
			)
		),
		'users' => array(
			array(
				'role' => 'admin', 										
				'name' => 'Алексей', 											
				'avatar' => '/img/my_photo.jpg',                  
			),																		
			array(
				'role' => 'guest', 										
				'name' => 'Аноним', 											
				'avatar' => '/img/no_photo.jpg',
			),	
		),

	);

	//категории проектов
	$projects_categories = array(
		'Входящие', 'Учеба', 'Работа', 'Домашние дела', 'Авто',
	);

	//задачи
	$tasks = array(
		'Собеседование в IT компании' => array(
			'date_complete'=>'28.06.2020',
			'category'=>'Работа',
			'complete'=>false,
		),
		'Выполнить тестовое задание' => array(
			'date_complete'=>'26.06.2020',
			'category'=>'Работа',
			'complete'=>false,
		),
		'Сделать задание первого раздела' => array(
			'date_complete'=>'24.06.2020',
			'category'=>'Учеба',
			'complete'=>true,
		),
		'Встреча с другом' => array(
			'date_complete'=>'22.06.2020',
			'category'=>'Входящие',
			'complete'=>false,
		),
		'Купить корм для кота' => array(
			'date_complete'=>null,
			'category'=>'Домашние дела',
			'complete'=>false,
		),
		'Заказать пиццу' => array(
			'date_complete'=>null,
			'category'=>'Домашние дела',
			'complete'=>false,
		),
	);

?>