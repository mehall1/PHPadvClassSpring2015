<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailModel
 *
 * @author 001148417
 */

namespace lab\model\dataobject;


class EmailModel extends BaseModel {
    
    private $emailid;
    private $email;
    private $emailtypeid;
    private $emailtype;
    private $emailtypeactive;
    private $logged;
    private $lastupdated;
    private $active;
    
    function getEmailid() {
        return $this->emailid;
    }

    function getEmail() {
        return $this->email;
    }

    function getEmailtypeid() {
        return $this->emailtypeid;
    }

    function getEmailtype() {
        return $this->emailtype;
    }

    function getEmailtypeactive() {
        return $this->emailtypeactive;
    }

    function getLogged() {
        return $this->logged;
    }

    function getLastupdated() {
        return $this->lastupdated;
    }

    function getActive() {
        return $this->active;
    }

    
    
    
    
    function setEmailid($emailid) {
        $this->emailid = $emailid;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setEmailtypeid($emailtypeid) {
        $this->emailtypeid = $emailtypeid;
    }

    function setEmailtype($emailtype) {
        $this->emailtype = $emailtype;
    }

    function setEmailtypeactive($emailtypeactive) {
        $this->emailtypeactive = $emailtypeactive;
    }

    function setLogged($logged) {
        $this->logged = $logged;
    }

    function setLastupdated($lastupdated) {
        $this->lastupdated = $lastupdated;
    }

    function setActive($active) {
        $this->active = $active;
    }

    
      
   /* 
    * private $emailID;
    private $email;
    private $emailtypeID;
    private $logged;
    private $lastupdated;
    private $active;
    * 
    * 
    * 
    * 
    */ 
   
    public function reset() 
    {
        $this->setEmailid('');
        $this->setActive('');
        $this->setEmail('');
        $this->setLastupdated('');
        $this->setLogged(''); 
        $this->setEmailtypeactive('');
        $this->setEmailtypeid('');
        $this->setEmailtype('');
        
        return $this;
    }
    
    public function map(array $values)
    {
        if(array_key_exists('email', $values)) {
            $this->setEmail($values['email']);
        }
        
        if(array_key_exists('active', $values)) {
            $this->setActive($values['active']);
        }
        
        if(array_key_exists('emailtypeid', $values)) {
            $this->setEmailtypeid($values['emailtypeid']);
        }
        
        if(array_key_exists('logged', $values)) {
            $this->setLogged($values['logged']);
        }
        
        if(array_key_exists('emailid', $values)) {
            $this->setEmailid($values['emailid']);
        }
        
        if(array_key_exists('lastupdated', $values)) {
            $this->setLastupdated($values['lastupdated']);
        }
        
        if(array_key_exists('emailtypeactive', $values)) {
            $this->setEmailtypeactive($values['emailtypeactive']);
        }
        
        if(array_key_exists('emailtype', $values)) {
            $this->setEmailtype($values['emailtype']);
        }
        
        return $this;
    }
    
    
}
