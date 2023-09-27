<?php
$to = 'championnola@gmail.com, amir.ali.frontend@gmail.com';
$user_name   = substr( $_POST['user_name'], 0, 32 );
$user_phone   = substr( $_POST['user_phone'], 0, 16 );
$user_email   = substr( $_POST['user_email'], 0, 64 );
$user_message = substr( $_POST['user_message'], 0, 250 );


$body .= "User name: ".$user_name."\r\n\r\n";
$body .= "User phone: ".$user_phone."\r\n\r\n";
$body .= "User e-mail: ".$user_email."\r\n\r\n";
$body .= "User Message: ".$user_message."\r\n\r\n";

send_mail($to, $body, $user_email);


function send_mail($to, $body, $user_email)
{
  $subject = "New message from ChampionOdessa";
  $boundary = "--".md5(uniqid(time()));
  $headers = "From: ".$user_email."\r\n";
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