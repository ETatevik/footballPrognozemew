<?php
// decode HTML symbols and br-s
function decodeText($str, $htmlspecialchars = true, $strip_tags = true) {
    if ($htmlspecialchars) {
        $str = htmlspecialchars_decode($str);
        if ($strip_tags) {
            $str = strip_tags($str);    
        }
    } else {
        $str = htmlspecialchars_decode($str);
    }
    return nl2br($str);
}
// password generator
function passwordGenerator($count) {
    $mixer = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%*_-+=";
    $pwd = substr(str_shuffle($mixer), 0, $count);
    return $pwd;
}
// send email
function sendMailSmtp($email, $subject, $message, $reply_to_email = '', $reply_to_name = '', $file = '') {
    // Original PHPMailer - https://github.com/PHPMailer/PHPMailer
    require_once('lib/PHPMailer/class.phpmailer.php');
    require_once('lib/PHPMailer/class.smtp.php');
    // PHPMailer
    $mail = new PHPMailer();
    // Can use SMTP
    $mail->IsSMTP();
    $mail->isHTML();
    $mail->Host     = 'smtp.mail.ru';
    $mail->SMTPSecure = 'ssl';
    $mail->Port     = '465';
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply@galent.am';
    $mail->Password = '$L44SRUpodAa';
    // Params
    $mail->FromName = 'Galent.am';
    $mail->From     = 'noreply@galent.am';
    $mail->AddAddress($email);
    $mail->Subject  = $subject;
    $mail->Body     = $message;
    // Reply
    if ($reply_to_email != '' && $reply_to_name != '') {
        $mail->addReplyTo($reply_to_email, $reply_to_name);
    }
    // File attachment
    if(!empty($file)){
        if(isset($file['tmp_name'])){
            $mail->AddAttachment($file['tmp_name'], $file['name']);
        }else{
            $mail->AddStringAttachment($file["body"], $file["name"], 'base64', 'application/octet-stream');
        }
    }
    // Send
    $result = $mail->Send();
    // Result
    return $result;
}
// send sms via mobipace.com
function sendSms($phone, $message){	
    $phone = "374".substr(preg_replace('/[\/(\/)\- ]/', '', $phone), 1);
    $body = preg_replace('/ /', '+', $message);
    get_headers('https://www.mobipace.com/API_2_0/HTTP_API.aspx?function=send&username=[USERNAME]&password=[PASSWORD]&sender=[SENDER]&recipient='.$phone.'&body='.$body.'');
}
// secure post/get data
function checkVariable($value) {
    if(is_array($value)) {
        return array_map(function($item) {
            return checkVariable($item);
        }, $value);
    } else {
        $item = trim($value);
        if(isset($_POST) && !empty($_POST)){
            $item = htmlspecialchars($item, ENT_QUOTES, 'UTF-8');
        }
        return $item;
    }
}
?>