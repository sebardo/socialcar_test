<?php

/**
 * Actract provider class
 */
abstract class AbstractProvider
{
    /**
     * @var Provider name
     */
    protected $name;
    
    /**
     * @var Host 
     */
    protected $host;
    
    /**
     * @var username credential
     */
    protected $user;
    
    /**
     * @var passowrd credential
     */
    protected $password;
    
    /**
     * @var sleep  = wait between email and email
     */
    protected $sleep;
    
    
    
    public function __construct($params) {
        $this->setConfiguration($params);
    }
    
    function getName() {
        return $this->name;
    }
    
    function setName($name) {
        $this->name = $name;
    }

    function getHost() {
        return $this->host;
    }

    function setHost($host) {
        $this->host = $host;
    }
    
    function getUser() {
        return $this->user;
    }
    
    function setUser($user) {
        $this->user = $user;
    }

    function getPassword() {
        return $this->password;
    }

    function setPassword($password) {
        $this->password = $password;
    }
    
    function getSleep() {
        return $this->sleep;
    }

    function setSleep($sleep) {
        $this->sleep = $sleep;
    }

    public function setConfiguration($params){}

    public function sendTo($email, Mail $mailContent) 
    {
        //If we set sleep more than 0 
        //wait between sending email and email
        if($this->getSleep() > 0){
            sleep($this->getSleep());
        }
 
    }
    
}
