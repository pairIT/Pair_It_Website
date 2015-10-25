<?php
session_start();
include 'connect.php';


/*if (isset($_SESSION['user_name'])) {
$username = $_SESSION['user_name'];
}

else {
echo "You have not signed in";
}*/

 


    


if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    
    echo '
        <form action="Update_ProfilePage.php" method="post" enctype="multipart/form-data">
    <img src = "photofile/default_profile.jpg" width="70"/><br/>
    <input type="file" name="file_img"/> <br/>
     Profile of '.$_SESSION['user_name'].'.<br/>
    <input type="submit" name="Update_photo" value="Upload photo">
    </form>';
}
    


else
{
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





            } else 
            {
                echo "File is not an image";
            }
    }

    
    
     
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
        $errors[] = 'The first field name must not be empty.';
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
        $errors[] = 'The last name field must not be empty.';
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
        $errors[] = 'The location field must not be empty.';
    }
    
    
    if(isset($_POST['user_email']))
    {
        if(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Invalid email format';
        }
        if(strlen($_POST['user_email']) > 30){
            $errors[] = 'The email cannot be longer than 30 characters.';
        }
        if(strlen($_POST['user_email']) < 5){
            $errors[] = 'The email cannot be shorter than 5 characters.';
        }
    }else
    {
        $errors[] = 'The email field must not be empty.';
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

        
        $first_name= sanitise($_POST['first_name']);
        $last_name= sanitise($_POST['last_name']);
        $location= sanitise($_POST['location']);
        $user_email= sanitise($_POST['user_email']);
        $user_name = $_SESSION['user_name'];
        
        echo 'Profile of ' . $_SESSION['user_name'].'.<br/>';
        
        
        $update ="UPDATE users SET first_name='$first_name' WHERE user_name= '$user_name'";
        $inserted=mysql_query($update);
        
        $update="UPDATE users SET last_name='$last_name' WHERE user_name= '$user_name' ";
         $inserted=mysql_query($update);
        
        
        $update="UPDATE users SET location='$location' WHERE user_name='$user_name'";
         $inserted=mysql_query($update);
        
         $update="UPDATE users SET user_email='$user_email' WHERE user_name= '$user_name'";
         $inserted=mysql_query($update);
        
        //session must change
        
        
        
        
        
        
        if(!$inserted)
        {
            echo 'Something went wrong. Please try again
            later.';
        }
        else
        {
            
            echo 'Successfully updated.';
            
            echo  '<a href="profilePage.php">Profile Page</a> and <br/>
            
            
              
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