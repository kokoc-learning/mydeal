<?php
	
	$uri = $_SERVER['SCRIPT_NAME'];
	//инициализация
	if($database){																		
		foreach ($database['pages'] as $value) {										
			if($value['url_key'] == $uri){
				//если не существует гет параметр, равный id проекта, то выдаем 404
				if($project_show != '' && !$arr_projects[$project_show]){
					header("HTTP/1.0 404 Not Found");
					echo include_templates('/error.php', $database, $projects_categories, $tasks, $arr_projects, $arr_tasks, $var_compact, $project_show);
				}										
				echo include_templates($value['url_key'], $database, $projects_categories, $tasks, $arr_projects, $arr_tasks, $var_compact, $project_show);											
			}
		}												
	} else {																			
		die('Невозможно подключиться к базе данных');									
	}

	//функция для вывода шаблона текущей страницы
	function include_templates($url_key, &$database, $projects_categories, $tasks, $arr_projects, $arr_tasks, $var_compact, $project_show){	
		$data = searchData($database, $url_key);
		if(!empty($data) && file_exists(PATH_TPL.$data['tpl'])){
			
			ob_start();
			
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

			$var_extract = extract($var_compact);

			require(PATH_TPL.$data['tpl']);

			$result = ob_get_clean();
			
			return $result;
			
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