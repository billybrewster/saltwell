<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'phpmailer/PHPMailerAutoload.php';

//echo json_encode("bru");

if (isset($_POST['inputName']) && isset($_POST['inputEmail']) && isset($_POST['inputPostCode']) && isset($_POST['inputAddress'])) {

    //check if any of the inputs are empty
    if (empty($_POST['inputName']) || empty($_POST['inputEmail']) || empty($_POST['inputPostCode']) || empty($_POST['inputAddress'])) {
        $data = array('success' => false, 'message' => 'Please fill out the form completely.');
        echo json_encode($data);
        exit;
    }
    
    if (empty($_POST['inputHomeTel'])) {
        $inputHomeTel="";
    } else {
	 $inputHomeTel = $_POST['inputHomeTel'];
    }
    
    if (empty($_POST['inputMobileTel'])) {
        $inputMobileTel="";
    } else {
	 $inputMobileTel = $_POST['inputMobileTel'];
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
    $mail->AddAddress('saltwellharriers1890@gmail.com'); //recipient 
    
    
    $mail->Subject = 'Membership Enquiry From Website';
    $mail->Body = "Name: " . $_POST['inputName'] 
			. "\r\n\r\nTitle: " . $_POST['inputTitle']
			. "\r\n\r\nHome Telephone: " . $inputHomeTel 
			. "\r\n\r\nMobile: " . $inputMobileTel 
			. "\r\n\r\nAddress: " . stripslashes($_POST['inputAddress']) 
			. "\r\n\r\nPostcode: " . $_POST['inputPostCode']
			. "\r\n\r\nDate of Birth: " . $_POST['inputDOB'];

    if (isset($_POST['ref'])) {
        $mail->Body .= "\r\n\r\nRef: " . $_POST['ref'];
    }

    if(!$mail->send()) {
        $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        echo json_encode($data);
        exit;
    }

    $data = array('success' => true, 'message' => 'Thanks! We have received your details and will be in touch soon.');
    echo json_encode($data);

} else {

    $data = array('success' => false, 'message' => 'Please fill out the form completely.');
    echo json_encode($data);

}