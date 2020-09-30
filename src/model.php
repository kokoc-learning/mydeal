<?php
	if ($link == false){
		print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
	}
	else {
        $arr_projects = [];//массив проектов
        $arr_tasks = [];//массив задач
        
        //проверяем наличие get параметров
        $project_show = '';
        if(isset($_GET['show']) && $_GET['show'] != ''){
            $project_show = $_GET['show'];
        }

        //запрос на выборку проектов
        $sql_project = 'select * from projects where author=1';
        $res_project = mysqli_query($link, $sql_project);
        while ($row = mysqli_fetch_array($res_project)) {
            $arr_projects[$row['id']] = $row['title'];
        }

        //выборка задач для конкретного проекта
        if($project_show){
            $sql_task = 'select * from tasks where author=1 AND project='.$project_show;
        } else {
            $sql_task = 'select * from tasks where author=1';
        }
        $res_task = mysqli_query($link, $sql_task);
        while ($row = mysqli_fetch_array($res_task)) {
            $arr_tasks[$row['id']] = array('title' => $row['title'],'status' => $row['task_status'],'date_start' => $row['date_create'],'date_complete' => $row['date_ready']);
        }
    }
    mysqli_close($link);

	//получаем информацию для конкретной страницы
	function searchData(&$database, $url_key){
		foreach ($database['pages'] as $key => $value) {
			if($value['url_key'] == $url_key){
                return $value;
			}
		}
		return false;
    }
    
?>