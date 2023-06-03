<?php
include"config.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';

$arr = array();

if(isset($_POST['email']))
{

$email = $_POST['email'];

try{
    if($email == ''){
        throw new Exception('Email is required');
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        throw new Exception('Email is invalid');
    }

    $statement = $pdo->prepare("SELECT * FROM subscribers WHERE email=?");
    $statement->execute([$email]);
    $total = $statement->rowCount();
    if($total){
        throw new Exception('Email Exist already');
    }
    $token = md5(mt_rand());
    $status = 'Pending';

    $statement = $pdo->prepare("INSERT INTO subscribers(email,token,status) VALUE(?,?,?)");
    $statement->execute([$email,$token,$status]);

    $mail = PHPMailer(true);

     
    
    // $phpmailer = new PHPMailer();
    // $phpmailer->isSMTP();
    // $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
    // $phpmailer->SMTPAuth = true;
    // $phpmailer->Port = 2525;
    // $phpmailer->Username = '4a49fcf3096681';
    // $phpmailer->Password = '8e10120da94940';
    // $mail->SMTPSecure = 'tls'; 



   // Server settings
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '4a49fcf3096681';                     //SMTP username
    $mail->Password   = '8e10120da94940';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('contact@yourwebsite.com');
    $mail->addAddress($email);                  
    $mail->addReplyTo('contact@yourwebsite.com');
    


    //Content
    $verification_link = 'http://localhost/project-newsletter-signup/verify-subscriber.php?email='.$email.'
        &token='.$token;
    $verification = '<a href="'.$verification_link.'">'.$verification_link.'</a>';
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Subscriber Verification';
    $mail->Body    = 'Please click on the following link to confirm your subscription:<br>'.$verification;
    
    $mail->send();
    

    $arr['success_message'] = "Please check your email to confirm your subscription. Check your spam folder too 
    if you do not receive the email in the normal email inbox";

}

catch(Exception $e){
    $error_message = $e->getMessage();
    $arr['error_message'] = $error_message;
}

}
echo json_encode($arr);


?>