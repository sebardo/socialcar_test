<?php
/**
 * Mail class have content email like subject and body
 *
 * @author sebastian
 */
class Mail 
{
    
    protected $subject;
    
    protected $body;
    
    protected $textBody;
    
    function getSubject() {
        return $this->subject;
    }

    function getBody() {
        return $this->body;
    }

    function getTextBody() {
        return $this->textBody;
    }

    function setSubject($subject) {
        $this->subject = $subject;
    }

    function setBody($body) {
        $this->body = $body;
    }

    function setTextBody($textBody) {
        $this->textBody = $textBody;
    }


}
