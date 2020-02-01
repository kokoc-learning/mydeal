<?php


    $dataToTemplate = $thisPage['vars'];
    // Валидация формы
    // -------------------------------------------------------
    
    $isValidate = FALSE;
    $required_fields = ['email', 'password', 'name'];
    $errors = [];

    foreach ($required_fields as $field) {
        
        // проверка на пустое поле
        if(empty($_POST[$field])){
            $errors[$field] = 'Поле пустое';
            continue;
        }

        // если поле заполнено, то...
        // если это поле почты, то проверяем корректность адреса
        if ($field === 'email'){
           if(!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
               $errors[$field] = 'Введите корректный Email';
               continue;
           }
        }
        // если это поле с паролем, то проверяем длинну пароля
        if ($field === 'password'){
            if(strlen($_POST[$field]) < 6) {
                $errors[$field] = 'Пароль слишком короткий. От 6 символов.';
                continue;
            }
         }
    }

    // если ошибок после валидации нет, то выполняем действия с БД 
    // 1. последний этап валидации, и, если удачен, то
    // 2. запись в БД
    if (empty($errors)){
        $con = mysqli_connect('localhost', 'root', '','mydealsDB');

        if(!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $email = mysqli_real_escape_string($con, $_POST['email']);

        $sql = "SELECT id FROM user WHERE email = '$email'";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) > 0){
            $errors['email'] = 'Пользователь с таким email уже зарегистрирован';
        } else {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $name = htmlspecialchars($_POST['name']);
            $dataArray = [$name, $email, $password];
            $sql = "INSERT INTO `user` (`name`, `email`, `password`) VALUES (?, ?, ?)";
            $stmt = db_get_prepare_stmt($con, $sql, $dataArray);
            $res = mysqli_stmt_execute($stmt);
        }

        if($res) {
            // ошибки нет, показываем главную страницу
            header("Location: index.php");
          } else {
            // ошибка есть
            echo '<br>Ошибка сохранения данных';
          }
    }
    
    
    if(!empty($errors)) {
        $dataToTemplate['formErrors'] = $errors;
    }

    $pageContent = include_template($thisPage['tpl'], $dataToTemplate);

?>