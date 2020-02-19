<?php
require_once(ROOT_PATH . '/vendor/autoload.php');


$deadlineOneDay = time() + 186400;
$deadlineOneDay = date("Y-m-d", $deadlineOneDay);
$deadlineWasted = time();
$deadlineWasted = date("Y-m-d", $deadlineWasted);
echo '<br>'. $deadlineWasted.'<br>';
$con = mysqli_connect($bdConnectData['bd_path'], $bdConnectData['bd_user'], $bdConnectData['bd_pass'], $bdConnectData['bd_name']);
if(!$con) {
    echo 'Ошибка подключения к MySQL '. mysqli_connect_error();
}
mysqli_set_charset($con, 'utf8');

$sqlQuery = "SELECT task.id AS id, task.name AS taskName, task.deadline, user.name AS username, user.email AS email
FROM task
JOIN user ON task.user_id = user.id
WHERE (TO_DAYS(task.deadline) - TO_DAYS(NOW())) >= 0 AND (TO_DAYS(task.deadline) - TO_DAYS(NOW())) <= 1 ";

$sqlRes = mysqli_query($con, $sqlQuery);

$emailData = mysqli_fetch_all($sqlRes, MYSQLI_ASSOC);
mysqli_close($con);

print_r($emailData);

if(isset($emailData[1]['deadline']) && $emailData[1]['deadline'] > $deadlineWasted) {
    echo '<br>'. $emailData[1]['deadline'];
}
echo "<br>";
try {


    $transport = (new Swift_SmtpTransport('smtp.yandex.ru', 465, 'ssl'))
        ->setUsername('creator051@yandex.ru')
        ->setPassword('Extended051J')
        ;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom(['creator051@yandex.ru' => 'MyDeals'])
  ->setTo(['creator051@yandex.ru' => 'A name'])
  ->setBody('Here is the message itself')
  ;

// Send the message
$numSent = $mailer->send($message);

printf("Sent %d messages\n", $numSent);
    
} catch (Exception $e) {
    echo $e->getMessage();
  }

?>