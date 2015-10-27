<?php
session_start();
include 'connect.php';

echo '<h3>Register</h3>';






 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
   
    echo '
    
    <form action="Signup_photo.php" method="post" enctype="multipart/form-data">
    <img src = "photofile/default_profile.jpg" width="70"/>
    <input type="file" name="file_img"/> 
    <p>Username:</p> <input type="text" name="user_name" />
    <p>First Name:</p> <input type="text" name="first_name" />
    <p>Last Name:</p> <input type="text" name="last_name" />
    <p>Location:</p> <input type="text" name="location" />
    <p>Password:</p> <input type="password" name="user_pass">
    <p>Confirm Password:</p> <input type="password" name="user_pass_check">
    <p>E-mail:</p> <input type="email" name="user_email">
    <input type="submit" name="btn_upload" value="Sign Up">
    </form>';
}


else
{
    if(isset($_POST['btn_upload']))
{
    $check = getimagesize($_FILES['file_img']['tmp_name']);
        
       
        $filetmp = $_FILES['file_img']['tmp_name'];//file control name
        $filename = $_FILES['file_img']['name'];
        $filetype = $_FILES['file_img']['type'];
        
        if($check !== false)
        {
            
           
            
            $filepath = "photofile/".$filename; //photofile = name of folder 
            move_uploaded_file($filetmp,$filepath);
            
            $_SESSION['file_img'] = $filepath;
            
          //add default photo    

        } else {
            echo "File is not an image";
            
            $filename= "default_profile.jpg";
            $filepath = "photofile/".$filename;
            move_uploaded_file($filetmp,$filepath);
            
            $_SESSION['file_img'] = $filepath;
             
        }
}
    
    $errors = array();
    if(isset($_POST['user_name']))
    {
        $username = $_POST['user_name'];
        
        $getUsername = "SELECT user_name FORM users WHRE user_name='$username'";
        $rows = mysql_query ($getUsername);
        $userNameData = mysql_result($rows,0,"user_name");
        
        if($username == $usernameData){
            $errors[] = 'The username is already taken.'; 
        } 
        
        if(!ctype_alnum($_POST['user_name'])){
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($_POST['user_name']) > 30){
            $errors[] = 'The username cannot be longer than 30 characters.';
        }
        if(strlen($_POST['user_name']) < 5){
            $errors[] = 'The username cannot be shorter than 5 characters.';
        }
        
    }else
    {
        $errors[] = 'The username field must not be empty.';
    }
     
    
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
    
   
    if(isset($_POST['user_email']))
    {
        if(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Invalid email format';
        }
        if(strlen($_POST['user_email']) > 30){
            $errors[] = 'The location cannot be longer than 30 characters.';
        }
        if(strlen($_POST['user_email']) < 5){
            $errors[] = 'The location cannot be shorter than 5 characters.';
        }
    }else
    {
        $errors[] = 'The location must not be empty.';
    }
     
    
    if(isset($_POST['user_pass']))
    {
        if($_POST['user_pass'] != $_POST['user_pass_check']){
            $errors[] = 'The two passwords did not match.';
        }
    }
    else
    {
        $errors[] = 'The password field cannot be empty.';
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
        $sql = "INSERT INTO users(user_name, user_pass, user_email ,user_date,
        user_level,img_name,img_path,img_type,first_name,last_name,location)
        VALUES('" . mysql_real_escape_string($_POST['user_name']) . "','" . sha1($_POST['user_pass']) . "','" .mysql_real_escape_string($_POST['user_email']) . "',
        NOW(),0,'$filename','$filepath','$filetype','" . mysql_real_escape_string($_POST['first_name']) . "','" . mysql_real_escape_string($_POST['last_name']) . "','" . mysql_real_escape_string($_POST['location']) . "')";
        
        
        
        $_SESSION['user_name'] = $_POST['user_name'];
        $_SESSION['first_name'] = $_POST['first_name'];
        $_SESSION['last_name'] = $_POST['last_name'];
        $_SESSION['location'] = $_POST['location'];
        $_SESSION['user_email'] = $_POST['user_email'];
        
        
        
        
        $result = mysql_query($sql);
        
        
        
        
        if(!$result)
        {
            echo 'Something went wrong while registering. Please try again
            later.';
        }
        else
        {
            
            echo 'Successfully registered. You can now <a
            href="signin.php">sign in</a> and start posting!';
            
            echo  'Welcome '.$_SESSION['user_name'].'. You are now sucessfully registered. You can now <a
            href="profilePage.php">Profile Page</a> and start posting!<br/>
            
            <img src = "http://localhost:8888/PairIt/Pair_It_Website/'.$_SESSION['file_img'].'"/><br/>
            
            
            
            
            ';
           
            
           

            
               
        }
    }
}



?> 


<?php
    mysql_close();
?>