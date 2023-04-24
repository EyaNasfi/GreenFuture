<?php 
include '../admin_page/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMAILER\Exception;

require 'mail/src/Exception.php';
require 'mail/src/PHPMailer.php';
require 'mail/src/SMTP.php';


if(isset($_POST['reset']))
{
    $email=$_POST['rmail'];
    $mail=new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->Username='hmidahmed049@gmail.com';
    $mail->Password='qbftfebwotmksyir';
    $mail->SMTPSecure="ssl";
    $mail->Port=465;
    $mail->setFrom('hmidahmed049@gmail.com');
    $mail->AddAddress($email);
    $mail->isHTML(true);
    $mail->Subject='Password Reset';
    $code = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'),0,10);
    $mail->Body='To reset your password click <a href="http://localhost/website/login_page/change_password.php?code='.$code.'">here </a>. </br>Reset your password in a day.';
    $db = config::getConnexion();
    $verifyQuery = $db->query("SELECT * FROM users WHERE email = '$email'");
    $verifyQuery->execute();
    if ($verifyQuery->rowCount() > 0) {

        $codeQuery = $db->query("UPDATE users SET code = '$code' WHERE email = '$email'");
        $codeQuery->execute();
        $mail->send();
    echo 
    "<script> alert('A Recovery Email Has Been Sent To you  Please Check your Email!');
    ducument.location.href = 'index.php';
    </script>";
    
    }
}
else{

    exit();
    
}



