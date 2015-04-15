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
        
        
        
        $emailtypeid = filter_input(INPUT_POST, 'emailtypeid');
        $email = filter_input(INPUT_POST, 'email');
        $active = filter_input(INPUT_POST, 'active');
        
        $errors = array();
        
        $dbConfig = array(
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $emailDAO = new EmailDAO($db);
        $emailtypeDAO = new EmailTypeDAO($db);
        
        $emailtypes = $emailtypeDAO->getAllRows();
        
        
        if ( $util->isPostRequest() ) 
        {
         // we validate only if a post has been made
        if ( !$validator->emailIsValid($email) ) {
            $errors[] = 'Email is not valid';
        }
        
        if ( empty($emailtypeid) ) {
            $errors[] = 'Email type is invalid';
        }
        
        if ( !$validator->activeIsValid($active) ) {
            $errors[] = 'Active is not valid';
        }  
     
         // if there are errors display them
        if ( count($errors) > 0 ){
            foreach ($errors as $value) 
            {
                echo '<p>',$value,'</p>';
            }
        } 
        else {
        
            $emailModel = new EmailModel();
                    
            $emailModel->map(filter_input_array(INPUT_POST));
                    
                   
            if ( $emailDAO->save($emailModel) ) 
            {
               echo 'Email Added';
            } 
            else 
            {
               echo 'Email not added';
            }
                   
        }
    
    
        }
        
        
        
        ?>
        
        <h3> Add Email </h3>
        
        <form action="#" method="post">
            <label> Email: </label>
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" /> <br />
            
            <label>Email Type:</label> 
            <select name="emailtypeid">
                <?php 
                    foreach($emailtypes as $value)
                    {
                        if($value->getEmailtypeid() == $emailtypeid)
                        {
                            echo '<option value="',$value->getEmailtypeid(),'" selected="selected">',$value->getEmailtype(),'</option>';
                        }
                        else
                        {
                            echo '<option value="',$value->getEmailtypeid(),'">',$value->getEmailtype(),'</option>';
                        }
                        
                    }
             ?>               
            </select> <br />
            
            <label> Active: </label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" /> <br />
          
       
            <input type="submit" value="Submit" />
        </form>
        
        <br />
        <br />
        
        <table border="1" cellpadding="5">
                <tr>
                    <th>Email</th>
                    <th>Email Type</th>
                    <th>Last updated</th>
                    <th>Logged</th>
                    <th>Active</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
         <?php 
            $emails = $emailDAO->getAllRows(); 
            foreach ($emails as $value) {
                echo '<tr><td>',$value->getEmail(),'</td><td>',$value->getEmailtype(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>' ;
                echo '<td> <a href=UpdateEmail.php?emailid=',$value->getEmailid(),'>Update</a></td>';
                echo '<td> <a href=DeleteEmail.php?emailid=',$value->getEmailid(),'>Delete</a></td></tr>';
            }

         ?>
            </table>
        
        
        
    </body>
</html>