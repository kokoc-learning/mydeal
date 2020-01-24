<?php

// echo '<br> include functions.php';

function projectsInTaskListCount($taskList, $projectName){
    $projectCount = 0;
    foreach ($taskList as $task) {
        if ($task['category'] === $projectName) {
            $projectCount++;
        }
    }
    return $projectCount;
}


function include_template($name, $data){
    $name = 'templates/' . $name;
    $result = '';

    if(!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;

}

function deadLineLeftHours($deadLine) {
    if ($deadLine === null) {
        return 0;
    }
    $deadLineDate = strtotime($deadLine);
    $nowDate = time();
    $diffTime = $deadLineDate - $nowDate;
    $secsInHour = 3600;

    return floor($diffTime / $secsInHour);
}

// функция проверяет есть ли такой id в базе с проектами
function projectIdCheck($projectId, $projectList){
    foreach ($projectList as $project) {
       if ($project['id'] === $projectId) {
           return TRUE;
       }
    }
    return FALSE;
}

?>

