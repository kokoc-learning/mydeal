<?php

$dataToTemplate = $thisPage['vars'];

$passwordHash = password_hash('пароль при регистрации', PASSWORD_DEFAULT);
// или берем из базы

if(password_verify('Пароль из формы', $passwordHash)){
  // верный

} else {
  // не верный

}


$required_fields = ['email', 'password'];
$errors = [];

foreach ($required_fields as $field) {
    
    // проверка на пустое поле
    if(empty($_POST[$field])){
        $errors[$field] = 'Поле не заполнено';
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

if (empty($errors)){
  // $con = mysqli_connect($bd_path, $bd_user, $bd_pass, $bd_name);
  $con = mysqli_connect('localhost', 'u0857553_root', 'U0l7D5q1','u0857553_mydealsdb');

  if(!$con) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $email = mysqli_real_escape_string($con, $_POST['email']);

  $sql = "SELECT `id`, `name`, `email`, `password`, `registration_date` AS reg_date 
          FROM user WHERE email = '$email'";
  $res = mysqli_query($con, $sql);
  
  // если в ответе что-то есть, то
  if(mysqli_num_rows($res) > 0){
    // получаем ассоциативный массив
    $userFromDB = mysqli_fetch_all($res, MYSQLI_ASSOC);
    // берем певрый элемент массива - будет данные юзера с текущей почтой
    $userFromDB = $userFromDB[0];

    // проверка пароля
    if(password_verify(($_POST['password']), $userFromDB['password'])){
      // верный - переадресация + создаем сессию
      header("Location: index.php");
      $_SESSION['currentUser'] = $userFromDB;
    } else {
      // не верный - ошибка
      $errors['password'] = 'Неверный пароль';
    }
  } else {
      $errors['email'] = 'Не верный E-mail';
  }

}

if(!empty($errors)) {
  $dataToTemplate['formErrors'] = $errors;
}
$pageContent = include_template($thisPage['tpl'], $dataToTemplate);

?>