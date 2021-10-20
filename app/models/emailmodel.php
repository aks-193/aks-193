<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailModel extends DbModel {
  
  private $email;
  private $subject;
  
  public function __construct () {
    $this->email = "";
    $this->subject = "";
  }
    
  public function send_email($subject, $email, $emailbody, $temp) { 
    // Instantiation and passing `true` enables exceptions
    $this->email = $email;
    
    $mail = new PHPMailer(true);
    
    # GoDaddy server settings
    # https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting#godaddy

    try {
        //Server settings
        # $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable verbose debug output
        $mail->CharSet = "UTF-8";
        $mail->isSMTP();                      // Send using SMTP
        $mail->Host = MAIL_SERVER; // Set the SMTP server to send through
        $mail->SMTPAuth = true;              // Enable SMTP authentication
        $mail->SMTPAutoTLS = false;
        $mail->Username = USER_EMAIL;   // SMTP username
        $mail->Password = USER_PASS;          // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        # $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 465;       // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom(USER_EMAIL, 'Dev Test');
        # $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        $mail->addAddress($this->email);               // Name is optional
        $mail->addReplyTo(USER_EMAIL, 'Dev Test');
        # $mail->addCC('cc@example.com');
        # $mail->addBCC('bcc@example.com');

        // Attachments
        # $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        # $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $emailbody;
        # $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $send = true;
    } 
    catch (Exception $e) {
        # "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        error_log("Message could not be sent. Mailer Error: : " . $mail->ErrorInfo, 0);
        $send = false;        
    }
    
    return true;
  }
  
  public function get_emailtemp($temp = "default") {
    $html = "";
    if (file_exists(HTML . DS . "email" . DS . $temp . ".html")) {
      $html .= file_get_contents(HTML . DS . "email" . DS . $temp . ".html");
      $html .= "\n";
    }
    
    return $html;
  }
  
}

?>