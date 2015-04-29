<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailTypeDAO
 *
 * @author 001148417
 */

/* Finish doing the rest of the select commands for delete and get by id */
namespace lab\model\dao;

use lab\model\interfaces\IDAO;
use lab\model\interfaces\IModel;
//use lab\model\interfaces\ILogging;
use pdo;

class EmailTypeDAO implements IDAO{
    
    private $DB = null;
    
    function getDB() {
        return $this->DB;
    }

    function setDB( PDO $DB) {
        $this->DB = $DB;
    }
    
    public function __construct ( PDO $db) {
        $this->setDB($db);
    }
    
    public function idExist($id) {
        
        $db = $this->getDB();
        $stmt = $db->prepare("Select emailtypeid from emailtype where emailtypeid = :emailtypeid");
        
        if ($stmt->execute(array('emailtypeid' => $id)) && $stmt->rowCount() > 0) {
            return true;
        }
        
        return false;
    }
    
    public function getByID($id) {
        
        $model = new EmailTypeModel();
        $db = $this->getDB();
        
        $stmt = $db->prepare("Select * from emailtype where emailtypeid = :emailtypeid");
        
        if ($stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $model ->map($results);
        }
        
        return $model;
        
    }
    
    public function save(IModel $model) {
        $db = $this->getDB();
        
        $values = array (":active" => $model->getActive(),
            ":emailtype" => $model->getEmailtype());
        
        if ( $this ->idExist($model->getEmailtypeid()) ) {
            $values[":emailtypeid"] = $model->getEmailtypeid();
            $stmt = $db->prepare("Update emailtype set active = :active, emailtype = :emailtype where emailtypeid = :emailtypeid");
            
        }
        
        else {
            $stmt = $db->prepare("Insert into emailtype set active = :active, emailtype = :emailtype");
        }
        
        if ($stmt->execute($values) && $stmt->rowCount() > 0) {
            return true;
        }
        
        return false;
    }
    
    public function delete($id) {
        $db = $this->getDB();
        $stmt = $db->prepare("Delete from emailtype where emailtypeid = :emailtypeid");
        
        if($stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0) {
            return true;
        }
        
        return false;
    }
    
    public function getAllRows() {
        $values = array();
        $db = $this->getDB();
        $stmt = $db->prepare("select * from emailtype");
        
        if($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($results as $value) {
                $model = new EmailTypeModel();
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
