<?php
//include autoload
require_once __DIR__.'/vendor/autoload.php';
require_once 'Factory/ProviderFactory.php';
require_once 'Factory/ProviderBase.php';
require_once './vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
require_once './Mail/Mail.php';

//symfony component: yml
use Symfony\Component\Yaml\Yaml;

//parse paramaters to array
$params = Yaml::parse(file_get_contents('config/parameters.yml'));

//validation of mandatory parameters
function validParameters($params){
    if(!isset($params['providers'])) throw new Exception('Parameter "providers" must be defined.');
}
validParameters($params);


//Instance factory to configurate provider
$factory = new ProviderFactory($params);
//Get provider class initialized
$provider = $factory->getProvider();   


//Variable $emails have all repositories to send email
$recipients = array('sebastian.sasturain@gmail.com', 'sj.ehlemann@gmail.com');
//Mail class have email content
$mail = new Mail();
$mail->setSubject('Here is the subject');
$mail->setBody('This is the HTML message body <b>in bold!</b>');
$mail->setTextBody('This is the body in plain text for non-HTML mail clients');

foreach ($recipients as $value) {
    //here we use PHPMailer to send email
    $provider->sendTo($value, $mail);
}
 
