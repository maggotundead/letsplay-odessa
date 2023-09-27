<?php
$to = 'maggotundead@gmail.com';
$selected_room   = substr( $_POST['selected_room'], 0, 32 );
$crowd_amount   = substr( $_POST['crowd_amount'], 0, 16 );
$user_phone   = substr( $_POST['user_phone'], 0, 64 );
$user_comment = substr( $_POST['user_comment'], 0, 250 );


$body .= "Выбранная комната: ".$selected_room."\r\n\r\n";
$body .= "Ориентировочное число посетителей: ".$crowd_amount."\r\n\r\n";
$body .= "Телефон клиента: ".$user_phone."\r\n\r\n";
$body .= "Комментарий клиента(опционально): ".$user_comment."\r\n\r\n";

// send_mail($to, $body, $user_email);
send_mail($to, $body);


// function send_mail($to, $body, $user_email)
function send_mail($to, $body)
{
  $subject = "Поступила новая заявка на бронь комнаты Let's Play";
  $boundary = "--".md5(uniqid(time()));
  // $headers = "From: ".$user_email."\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .="Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n";
  $multipart = "--".$boundary."\r\n";
  $multipart .= "Content-type: text/plain; charset=\"utf-8\"\r\n";
  $multipart .= "Content-Transfer-Encoding: quoted-printable\r\n\r\n";

  $body = $body."\r\n\r\n";

  $multipart .= $body;

  $multipart .= "--".$boundary."--\r\n";
  mail($to, $subject, $multipart, $headers);
}