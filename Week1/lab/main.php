<!DOCTYPE html>
<?php include './bootstrap.php'; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        // tests the local page ---- phpinfo();
        $util = new Util();
        $validator = new Validator();
        
        $emailType = filter_input(INPUT_POST, 'emailtype');
        
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
         // we validate only if a post has been made
        if ( !$validator->emailTypeIsValid($emailType) ) {
            $errors[] = 'Email type is not valid';
        }
    
     
         // if there are errors display them
        if ( count($errors) > 0 ){
            foreach ($errors as $value) 
            {
                echo '<p>',$value,'</p>';
            }
        } 
        else {
        //if no errors, save to to database.
            $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");  
            $values = array(":emailtype"=>$emailType);
            if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
                echo 'Email Added';
            }       
        }
    
    
        }
        
        
        
        ?>
        
        <h3> Input Email Type </h3>
        
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <input type="submit" value="Submit" />
        </form>
        
        
        <?php 
       
        // lets get the database values and display them
        $stmt = $db->prepare("SELECT * FROM emailtype where active = 1");
        if ($stmt->execute() && $stmt->rowCount() > 0) {
        /*
         * There is fetchAll which gets all the values and
         * fetch which gets one row.
         */
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // results returns as a assoc array
        // you can run the next line to see the variable
        // var_dump($results)
            foreach ($results as $value) {
                echo '<strong> <p>', $value['emailtype'], '</p> </strong>';
            }
        }   
        else {
        echo '<p>No Data</p>';
        }
    ?>
        
        
        
    </body>
</html>