<?php
include_once('data.php');
$mail_user = $_SESSION['mail_user'];
$temp[] = $_SESSION['mail_tasks'];
foreach ($temp as $content){
    $mail_query = "SELECT email FROM users WHERE user_name = '$mail_user'";
    $mail_result = mysqli_query($connect, $mail_query);
    $mail = mysqli_fetch_all($mail_result, MYSQLI_ASSOC);
    $query = "SELECT deadline FROM tasks WHERE autor = '$mail_user' AND task_name = '$content'";
    $result = mysqli_query($connect, $query);
    $task_time = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $transport = new Swift_SmtpTransport($mail_user, 25);

    $message = new Swift_Message("Напоминание о задаче");
    $message::setTo($mail);
    $message::setBody("Уважаемый $mail_user, у вас запланирована задача $content на $task_time");
    $message::setFrom("KirillAlex@example.com", "Mydeal");

    $mailer = new Swift_Mailer($transport);
    $mailer::send($message);
}
unset($_SESSION['mail_user']);

?>