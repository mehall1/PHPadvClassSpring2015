<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        if($scope->util->isPostRequest()) {
            if ( isset($scope->view['errors'])) {
                print_r($scope->view['errors']);
            }
            
            if ( isset($scope->view['saved']) && $scope->view['saved'] ) {
                  echo 'Email Added';
             }
             
             if ( isset($scope->view['deleted']) && $scope->view['deleted'] ) {
                  echo 'Email deleted';
             }
        }
        
        $email = $scope->view['model']->getEmail();
        $active = $scope->view['model']->getActive();
        
        ?>
        
        <br />
        <a href="AddEmail.php"> Add Email </a> &nbsp &nbsp
        <a href="AddEmailType.php"> Add Email Type </a>
        
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