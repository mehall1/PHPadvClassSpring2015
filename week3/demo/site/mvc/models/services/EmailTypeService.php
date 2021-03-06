<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailTypeService
 *
 * @author 001148417
 */
namespace App\models\services;

use App\model\interfaces\IDAO;
use App\model\interfaces\IService;
use App\model\interfaces\IModel;

class EmailTypeService implements IService {
    
    protected $DAO;
     protected $validator;
     
     function getValidator() {
         return $this->validator;
     }

     function setValidator($validator) {
         $this->validator = $validator;
     }

                  
     
     function getDAO() {
         return $this->DAO;
     }

     function setDAO(IDAO $DAO) {
         $this->DAO = $DAO;
     }

    public function __construct( IDAO $EmailTypeDAO, $validator  ) {
        $this->setDAO($EmailTypeDAO);
        $this->setValidator($validator);
    }
    
    
    public function getAllRows($limit = "", $offset = "") {
        return $this->getDAO()->getAllRows($limit, $offset);
    }
    
    public function read($id) {
        return $this->getDAO()->read($id);
    }
    
    public function delete($id) {
        return $this->getDAO()->delete($id);
    }
    
    public function create(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->create($model);
        }
        return false;
    }
    
    public function update(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->update($model);
        }
        return false;
    }
    
    public function validate( IModel $model ) {
        $errors = array();
        if ( !$this->getValidator()->emailTypeIsValid($model->getEmailtype()) ) {
            $errors[] = 'Email Type is invalid';
        }
               
        if ( !$this->getValidator()->activeIsValid($model->getActive()) ) {
            $errors[] = 'Email Type active is invalid';
        }
       
        
        return $errors;
    }
}
