<?php
session_start();
include 'connect.php';


 class User
    {
        public $user_name; 
        public $first_name;
        public $last_name; 
        public $location;
        public $user_email;
    }

      function sanitise($data)
    {
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
    }




if($_SERVER['REQUEST_METHOD'] != 'POST')
{
   
    echo '
        <form action="Update_ProfilePage.php" method="post" enctype="multipart/form-data">
    <img src = "photofile/default_profile.jpg" width="70"/><br/>
    <input type="file" name="file_img"/> 
    <input type="submit" name="Update_photo" value="Upload photo">
    </form>';
    
    
if(isset($_POST['Update_photo']))
    {
        $check = getimagesize($_FILES['file_img']['tmp_name']);

            if($check !== false)
            {
                $filetmp = $_FILES['file_img']['tmp_name'];//file control name
                $filename = $_FILES['file_img']['name'];
                $filetype = $_FILES['file_img']['type'];
                $filepath = "photofile/".$filename; //photofile = name of folder 



                move_uploaded_file($filetmp,$filepath);

                $_SESSION['file_img'] = $filepath;





            } else {
                echo "File is not an image";
            }
    }
    
    
}
    
 else {   
    $errors = array();
    if(isset($_POST['first_name']))
    {
        if(!preg_match('/^[a-z0-9 .\-]+$/i', $_POST['first_name'])){
            $errors[] = 'The first name can only contain letters and digits.';
        }
        if(strlen($_POST['first_name']) > 30){
            $errors[] = 'The first name cannot be longer than 30 characters.';
        }
        if(strlen($_POST['first_name']) < 5){
            $errors[] = 'The first name cannot be shorter than 5 characters.';
        }
    }else
    {
        $errors[] = 'The first name must not be empty.';
    }
    
     
      if(isset($_POST['last_name']))
    {
        if(!preg_match('/^[a-z0-9 .\-]+$/i', $_POST['last_name'])){
            $errors[] = 'The last name can only contain letters and digits.';
        }
        if(strlen($_POST['last_name']) > 30){
            $errors[] = 'The last name cannot be longer than 30 characters.';
        }
        if(strlen($_POST['last_name']) < 5){
            $errors[] = 'The last name cannot be shorter than 5 characters.';
        }
    }else
    {
        $errors[] = 'The last name must not be empty.';
    }
    
    if(isset($_POST['location']))
    {
        if(!preg_match('/^[a-z0-9 .\-]+$/i', $_POST['location'])){
            $errors[] = 'The location can only contain letters and digits.';
        }
        if(strlen($_POST['location']) > 30){
            $errors[] = 'The location cannot be longer than 30 characters.';
        }
        if(strlen($_POST['location']) < 5){
            $errors[] = 'The location cannot be shorter than 5 characters.';
        }
    }else
    {
        $errors[] = 'The location must not be empty.';
    }
    
    if(!empty($errors))
    {
        echo 'Some of the fields are filled in incorrectly';
        echo '<ul>';
        foreach($errors as $key => $value)
        {
            echo '<li>' . $value . '</li>';
        }
        echo '</ul>';
    }
    
    
    else
    {
        $first_name= sanitise($_POST['first_name']);
        $last_name= sanitise($_POST['last_name']);
        $location= sanitise($_POST['location']);
        $user_email= sanitise($_POST['user_email']);
        
        /*$update="update users SET first_name='$first_name' where user_name=$_SESSION['user_name']";
        mysql_query($update);
        
        $update="update users SET last_name='$last_name' where user_name=$_SESSION['user_name']";
        mysql_query($update);
        
        
        $update="update users SET location='$location' where user_name=$_SESSION['user_name']";
        mysql_query($update);
        
         $update="update users SET user_email='$user_email' where user_name=$_SESSION['user_name']";
        mysql_query($update);*/
        
        
        //session must change
        
        
        
        
        
        
        if(!$update)
        {
            echo 'Something went wrong. Please try again
            later.';
        }
        else
        {
            
            echo 'Successfully updated.';
            
            echo  'Welcome '.$_SESSION['user_name'].'. You are now sucessfully registered. You can now <a
            href="profilePage.php">Profile Page</a> and start posting!<br/>
            
            <img src = "http://localhost:8888/PairIt/Pair_It_Website/'.$_SESSION['file_img'].'"/><br/>
              
            ';
              
               
        }
    }
    
}







?>

<!DOCTYPE html>
<html> 
<body>
    <head>
      <title>Update details</title>
    </head>
    
    <body>
        <table>
            <form action="Update_ProfilePage.php" method="POST">
                
            <label>First Name</label>
            <input name="first_name"><br/>
            <label>Last Name</label>
            <input name="last_name"><br/>
            <label>Location</label>
            <input name="location"><br/>
            <label>Email</label>
            <input name="user_email"><br/>
            <input type="submit" name="Update_info" value="Update">
                
            </form>
        </table>
         </body>
</html>

<?php
    mysql_close();
?>