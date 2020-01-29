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



function db_get_prepare_stmt($con, $sql, $data = []) {
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($con);
        die($errorMsg);
    }

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);

        if (mysqli_errno($con) > 0) {
            $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($con);
            die($errorMsg);
        }
    }

    return $stmt;
}

function getPostVal($name){
    return $_POST[$name] ?? "";
}

function deadlineFieldValidation($date){
    $todayDate = date("Y-m-d");
    if(isset($date) && $date < $todayDate) {
       return 'Ошибка даты. Дедлайн уже прошел';
      }
}

?>