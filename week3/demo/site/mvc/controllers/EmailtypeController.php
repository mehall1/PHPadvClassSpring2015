<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailTypeController
 *
 * @author 001148417
 */
namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;

class EmailtypeController extends BaseController implements IController {
    
    protected $service;
    
   /* public function __construct( IService $TestService ) {                
        $this->service = $TestService;     
        
    }*/
    
      public function execute(IService $scope) {
          
        
          
          $this->data['test1'] = 'hello';
          $this->data['test2'] = 'world';
          
          $scope->view = $this->data;
          $page = 'emailtype';
          return $this->view($page, $scope);          
      }
    
}
