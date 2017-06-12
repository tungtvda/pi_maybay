<?php

/**
 * @author vdbkpro
 * @copyright 2013
 */

require_once('class.phpmailer.php');
require_once('class.smtp.php');
function SendMail($Sendto,$Body,$Subject)
{
    global $error;
    $mail = new PHPMailer();  // t?o m?t d?i tu?ng m?i t? class PHPMailer
    $mail->IsSMTP(); // b?t ch?c nang SMTP
    $mail->SMTPDebug = 0;  // ki?m tra l?i : 1 l�  hi?n th? l?i v� th�ng b�o cho ta bi?t, 2 = ch? th�ng b�o l?i
    $mail->Debugoutput = "html";
    $mail->SMTPAuth = true;  // b?t ch?c nang dang nh?p v�o SMTP n�y
    $mail->SMTPSecure = 'ssl'; // s? d?ng giao th?c SSL v� gmail b?t bu?c d�ng c�i n�y
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->CharSet = 'UTF-8';
    $mail->Username = "code.vifonic@gmail.com";
    $mail->Password = "tungtvda";
    $mail->SetFrom("code.vifonic@gmail.com", "Vifonic");
    $mail->Subject = $Subject;
    $mail->MsgHTML("" . $Body . "");
//    $mail->Body = $Body;
    $mail->AddAddress($Sendto);
    if(!$mail->Send()) {
        $error = 'Gui mail bi loi: '.$mail->ErrorInfo;
        return false;
    } else {
       echo "<script>alert('Yêu cầu đặt vé của quý khách đã được xử lý trên hệ thống của chúng tôi.')</script>";
        return true;
    }
}  
?>