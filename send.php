<?php

require ($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
require ($_SERVER['DOCUMENT_ROOT'].'/wp-includes/class-phpmailer.php');

$sait_name       = get_option('blogname');
$sait_url        = get_option('home');
$adminEmail      = get_option('admin_email');
$mailServerLogin = get_option('mailserver_login');
$mailServerPass  = get_option('mailserver_pass');
$mailServerPort  = get_option('mailserver_port');
$mailServerUrl   = get_option('mailserver_url');
$page    = '';
$name_product = '';


// ==== Принудительный захват массива переменных ==========================
// ==== раскомментировать, если письма отправляются без значений полей ====
$text          = '';
$phone         = $_POST['phone'];          if($phone){$text          = $text.'Телефон пользователя: '.$phone.'<br>';}
$name          = $_POST['name'];           if($name){$text           = $text.'Имя пользователя: '.$name.'<br>';}
$page          = $_POST['page'];           if($page){$text           = $text.'Страница: '.$page.'<br>';}
$form          = $_POST['form'];

$text = $text.'<br><br>Сообщение с сайта <a href="' . $sait_url . '">' . $sait_name . '</a>';
$text = $text.'<br>Отвечать на это сообщение не надо.';

$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = $mailServerUrl;                         // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $mailServerLogin;                   // SMTP username
$mail->Password = $mailServerPass;                    // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = $mailServerPort;                        // TCP port to connect to

$mail->setFrom($mailServerLogin, $sait_name);
$mail->addAddress($adminEmail, $adminEmail);          // Add a recipient            

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $form . $name_product;
$mail->Body    = $text;


if(!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    //echo 'Message has been sent';
}