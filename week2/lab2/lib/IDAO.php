<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author 001148417
 */
interface IDAO {
    
   public function getByID($id);
   
   public function delete($id);
   
   public function save(IModel $model);
   
   public function getAllRows();
}