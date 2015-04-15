<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailDAO
 *
 * @author 001148417
 */
class EmailDAO implements IDAO {
    
    private $DB = null;
    
    function getDB() {
        return $this->DB;
    }

    function setDB( PDO $DB) {
        $this->DB = $DB;
    }

    public function __construct (PDO $db) {
        $this->setDB($db);
    }
    
    public function idExist($id) {
        
        $db = $this->getDB();
        $stmt = $db->prepare("Select emailid from email where email=:emailid");
        
        if ( $stmt->execute(array(':emailid'=>$id)) && $stmt->rowCount() > 0) {
            return true;
        }
        
        return false;
    }
    
    public function getByID($id) {
        $model = new EmailModel();
        $db = $this->getDB();
        
        $stmt = $db->prepare("SELECT email.emailid, email.email, email.emailtypeid, emailtype.emailtype, emailtype.active as emailtypeactive, 
            email.logged, email.lastupdated, email.active
                   FROM email LEFT JOIN emailtype on email.emailtypeid = emailtype.emailtypeid WHERE emailid = :emailid");
        
        if ($stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $model->map($results);
        }
        
        return $model;
    }
    
    /* 
    * private $emailID;
    private $email;
    private $emailtypeID;
    private $logged;
    private $lastupdated;
    private $active;
    */ 
    
    /* There might be a mistake in this function */
    public function save(IModel $model) {
        
        $db = $this->getDB();
        
        $values = array(":email" => $model->getEmail(),
            ":active" =>$model->getActive(),
            ":emailtypeid" =>$model->getEmailtypeid()
            
            
            );
        
        var_dump($model);
        
        if ($this->idExist($model->getEmailid()) ) {
            $values[":emailid"] = $model->getEmailid();  
            $stmt = $db->prepare("UPDATE email set email = :email, emailtypeid = :emailtypeid, active = :active, lastupdated = now() WHERE emailid = :emailid");
        }
        
        else {
            $stmt = $db->prepare("Insert into email set email = :email, active = :active, emailtypeid = :emailtypeid, logged = now(), lastupdated = now()");
        }
        
        
        if( $stmt->execute($values) && $stmt->rowCount() > 0) {
            return true;
        }
        
        
        
        return false;
    }
    
    
    public function delete($id) {
        $db = $this->getDB();
        $stmt = $db->prepare("Delete from email where email = :emailid");
        
        if ($stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0) {
            return true;
        }
        
        return false;
    }
    
    public function getAllRows() {
        
        $values = array();
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT email.emailid, email.email, email.emailtypeid, emailtype.emailtype, emailtype.active as emailtypeactive, email.logged, email.lastupdated, email.active"
                 . " FROM email LEFT JOIN emailtype on email.emailtypeid = emailtype.emailtypeid");
        
        if($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($results as $value) {
                $model = new EmailModel();
                $model->reset()->map($value);
                $values[] = $model;
            }
        }
        
        else {
            //log($db->errorInfo() .$stmt->queryString ) ; 
        }
        
        $stmt->closeCursor();
        return $values;
        
    }    
    
}
