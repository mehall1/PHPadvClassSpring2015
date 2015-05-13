



 <?php
        
        $dbConfig = array(
                "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                "DB_USER"=>'root',
                "DB_PASSWORD"=>''
                );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
                              
        
        $emailid = filter_input(INPUT_GET, 'emailid');
            
            
        if ( NULL !== $emailid ) {
            $emailDAO = new EmailDAO($db);
               
        if ( $emailDAO->delete($emailid) ) {
            echo 'Email was deleted';                  
        }   
               
        else {
            echo 'Email was not deleted';
        }
        
        }
            
        echo '<p><a href="',filter_input(INPUT_SERVER, 'HTTP_REFERER'),'">Go back</a></p>';
        
?>
        
        
        
        
        
