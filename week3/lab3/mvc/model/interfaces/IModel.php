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
namespace lab\model\interfaces;

interface IModel {
   
    public function reset();
    
    public function map(array $values);
}
