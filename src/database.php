<?php
	//база данных
	$database = array(
		'pages' => array( 					                                           
			array(
				'url_key' => '/', 										
				'title' => 'Главная страница - mydeal', 											
				'tpl' => 'layout.php', 
				'content' => 'main.php',     											
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
			'date_complete'=>'01.12.2019',
			'category'=>'Работа',
			'complete'=>false,
		),
		'Выполнить тестовое задание' => array(
			'date_complete'=>'25.12.2019',
			'category'=>'Работа',
			'complete'=>false,
		),
		'Сделать задание первого раздела' => array(
			'date_complete'=>'21.12.2019',
			'category'=>'Учеба',
			'complete'=>true,
		),
		'Встреча с другом' => array(
			'date_complete'=>'22.12.2019',
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