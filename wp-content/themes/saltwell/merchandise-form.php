<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'phpmailer/PHPMailerAutoload.php';

//echo json_encode("bru");

if (isset($_POST['inputName']) && isset($_POST['inputEmail']) ) {

    //check if any of the inputs are empty
    if (empty($_POST['inputName']) || empty($_POST['inputEmail']) ) {
        $data = array('success' => false, 'message' => 'Please fill out the form completely.');
        echo json_encode($data);
        exit;
    }
    
    if (empty($_POST['inputMobileTel'])) {
        $inputMobileTel="";
    } else {
	 $inputMobileTel = $_POST['inputMobileTel'];
    }
    
    if (empty($_POST['inputMessage'])) {
        $inputMessage="";
    } else {
	 $inputMessage = $_POST['inputMessage'];
    }
    

    //create an instance of PHPMailer
    $mail = new PHPMailer();
    //$mail->SMTPDebug = 1;

 /*
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'robertdavidbrooks@gmail.com';                 // SMTP username
    $mail->Password = 'Newcastle1892';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
 */

    $mail->From = $_POST['inputEmail'];
    $mail->FromName = $_POST['inputName'];
    $mail->AddAddress('robertbrooks334@gmail.com'); //recipient 
    $mail->AddAddress('daveycandlish@tiscali.co.uk');
    $mail->AddAddress('jcandlish@tiscali.co.uk');
    //$mail->AddAddress('saltwellharriers1890@gmail.com'); //recipient 
    
    
    $mail->Subject = 'Merchandise Enquiry From Website';
    $mail->Body = "Name: " . $_POST['inputName'] 
			. "\r\n\r\nMobile: " . $inputMobileTel 
			. "\r\n\r\nEmail: " . $_POST['inputEmail']
			. "\r\n\r\nMessage: " . $inputMessage;

    if (isset($_POST['ref'])) {
        $mail->Body .= "\r\n\r\nRef: " . $_POST['ref'];
    }


// send email to user
 //create an instance of PHPMailer
    $mail2 = new PHPMailer();
    //$mail->SMTPDebug = 1;

 /*
    $mail2->isSMTP();                                      // Set mailer to use SMTP
    $mail2->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail2->SMTPAuth = true;                               // Enable SMTP authentication
    $mail2->Username = 'robertdavidbrooks@gmail.com';                 // SMTP username
    $mail2->Password = 'Newcastle1892';                           // SMTP password
    $mail2->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
 */

    $mail2->From = 'saltwellharriers1890@gmail.com';
    $mail2->FromName = 'Saltwell Harriers';
    $mail2->AddAddress($_POST['inputEmail']); //recipient 
    
    
    
    $mail2->Subject = 'Thanks for your enquiry to Saltwell Harriers';
    $mail2->Body = "Thanks for submitting your merchandise enqiury via our website, we will be in touch soon with further information";

    if (isset($_POST['ref'])) {
        $mail2->Body .= "\r\n\r\nRef: " . $_POST['ref'];
    }
    $mail2->send();
    

    if(!$mail->send()) {
        $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        echo json_encode($data);
        exit;
    }

    $data = array('success' => true, 'message' => 'Thanks! We have received your query and will be in touch soon.');
    echo json_encode($data);

} else {

    $data = array('success' => false, 'message' => 'Please fill out the form completely.');
    echo json_encode($data);

}