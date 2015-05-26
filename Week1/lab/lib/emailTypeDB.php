<?php

class emailTypeDB {
    


    public function Save($emailType)
    {
        
        $util = new Util();
        $validator = new Validator();   

       
        $errors = array();

        
        $dbConfig = array(
                "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                "DB_USER"=>'root',
                "DB_PASSWORD"=>''
                );

        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();

        
        if ( $util->isPostRequest() ) 
        {
       
            if ( !$validator->emailTypeIsValid($emailType) ) 
            {
                $errors[] = 'Email type is not valid';
            }


         
            if ( count($errors) > 0 ) 
            {
                foreach ($errors as $value) 
                {
                    echo '<p>',$value,'</p>';
                }
            } 
            else 
            {
               

                $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");  

                $values = array(":emailtype"=>$emailType);

                if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) 
                {
                    echo 'Email Added';
                }      
            }
        }
        
    }


    public function displayEmails() {        
       $dbConfig = array(
                "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                "DB_USER"=>'root',
                "DB_PASSWORD"=>''
                );

        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();

       $stmt = $db->prepare("SELECT * FROM emailtype where active = 1");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            foreach ($results as $value) {
                echo '<strong><p>', $value['emailtype'], '</p></strong>';
            }
        } else {
            echo '<p>No Data</p>';
        }
        
    }
   
}