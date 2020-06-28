<?php
	
	$uri = $_SERVER['REQUEST_URI'];
	//инициализация
	if($database){																		
		foreach ($database['pages'] as $value) {										
			if($value['url_key'] == $uri){												
				include_templates($value['url_key'], $database, $projects_categories, $tasks);											
			}
		}
		//printPage('/error.php', $database);												
	} else {																			
		die('Невозможно подключиться к базе данных');									
	}

	//функция для вывода шаблона текущей страницы
	function include_templates($url_key, &$database, $projects_categories, $tasks){	
		$data = searchData($database, $url_key);
		if(!empty($data) && file_exists(PATH_TPL.$data['tpl'])){
			
			if($data['title'] && $data['title'] != ''){
				$title = $data['title'];
			}
			if($data['h1'] && $data['h1'] != ''){
				$h1 = $data['h1'];
			}
			if($data['content'] && $data['content'] != ''){
				$page_content = $data['content'];
			}
			if($data['text'] && $data['text'] != ''){
				$seo_text = $data['text'];
			}

			include_once(PATH_TPL.$data['tpl']);
			exit;
		} else {
			die('Для такой страницы нет данных');
		}
	}

	//считаем задачи в проекте
	function countProjects($tasks = array(),$projects_categories){
		$i=0;
		foreach ($tasks as $key => $value) {
			if($value['category'] == $projects_categories){
			$i++; 
			}
		}
		return $i;
	}

?>