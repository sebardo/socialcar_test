<?php

require_once 'Factory/AbstractProvider.php';
require_once 'Factory/ProviderInterface.php';

/**
 * This class provide the configuration need "sender" to send emails
 *
 * @author sebastian
 */
class ProviderBase  extends AbstractProvider implements ProviderInterface
{
    
    public function __construct($params) {
        parent::__construct($params);
    }
    
    public function setConfiguration($params){
         if(isset($params['host']) && isset($params['user']) && isset($params['password'])){
            $this->setHost($params['host']);
            $this->setUser($params['user']);
            $this->setPassword($params['password']);
        }else{
            //if algorithm not defined get an exception.
            throw new \Exception('Please check your configuration should have this keys by provider: host, user, password.');
        }
    }

    public function sendTo($email, Mail $mailContent) 
    {
        parent::sendTo($email, $mailContent);
        
        $mail = new PHPMailer;
        //$mail->SMTPDebug = 3;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $this->getHost();                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $this->getUser();                   // SMTP username
        $mail->Password = $this->getPassword();               // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom($this->getUser(), 'Mailer');            // Same user as provider configuration
        $mail->addAddress($email, 'User');                     // Add a recipient
        $mail->isHTML(true);                                   // Set email format to HTML

        $mail->Subject = $mailContent->getSubject();
        $mail->Body    = $mailContent->getBody();
        $mail->AltBody = $mailContent->getTextBody();

        if(!$mail->send()) {
            echo 'Message could not be sent.';echo '<br>';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent to: '.$email; echo '<br>';
        }

    }
    
}
