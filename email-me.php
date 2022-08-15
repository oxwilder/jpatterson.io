<?
require('includes/apptop.php');
if($_POST['action']='email-link'){
    header("Location: mailto:john@jpatterson.io");
} else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $ref = $_POST['ref'];
    $message = "You have an email from $name at $email regarding ". $ref??'nothing at all.' . "\n" . "Message follows:";
    $message .= $_POST['message'];
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    ini_set('sendmail_path','usr/sbin/sendmail -t -i');
    ini_set("mail.force_extra_parameters","-f$email");
    $headers .= "From: <$email>" . "\r\n";
    mail(EMAIL,$subject,$message,$headers);
}



include('index.php');