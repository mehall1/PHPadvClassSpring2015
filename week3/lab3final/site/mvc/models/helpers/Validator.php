<?php

/**
 * Description of Validator
 *
 * @author GForti
 */

namespace App\models\services;

use App\models\interfaces\IService;

class Validator implements IService {
    
    
    
    /**
     * A method to check if an email is valid.
     *
     * @param {String} [$email] - must be a valid email
     *
     * @return boolean
     */
    public function emailIsValid($email) {
        return ( is_string($email) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false );
    }
    
   
    public function emailTypeIsValid($email) {
        return ( is_string($email) && !empty($email) );
    }
    
    /**
     * A method to check if a phone type is valid.
     *
     * @param {String} [$type] - must be a valid string
     *
     * @return boolean
     */
    public function activeIsValid($type) {
        return ( is_string($type) && preg_match("/^[0-1]$/", $type) );
    }
}
