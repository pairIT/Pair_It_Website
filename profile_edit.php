<?php
include 'connect.php';
 
echo '<h3>Profile</h3>';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo '
    
    <form action="profile_edit.php" method="post" enctype="multipart/form-data">
    <img src = "photofile/default_profile.jpg" width="70"/>
    <input type="file" name="file_img"/>
	<p>Name:</p> <input type="text" name="name" />
	<p>Surname:</p> <input type="text" name="surname" />
	<p>Location:</p> <input type="text" name="location" />
    <p>Username:</p> <input type="text" name="user_name" />
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
    $check = getimagesize($_FILES["file_img"]["tmp_name"]);

        if($check !== false)
        {
            $filetmp = $_FILES["file_img"]["tmp_name"];//file control name
            $filename = $_FILES["file_img"]["name"];
            $filetype = $_FILES["file_img"]["type"];
            $filepath = "photofile/".$filename; //photofile = name of folder 

            
            //move_uploaded_file($filetmp,$filepath);
            //$sql = "INSERT INTO users (img_name,img_path,img_type)
            //VALUES ('$filename','$filepath','$filetype')";
           
            //$query = mysql_query($sql);
            
            //echo out the last inserted image
            //$lastid = mysql_insert_id();
            //echo "Image uploaded. <p/>Yourimage:<p/><img src=getImage.php? $filepath/>";
            
            //$result = mysql_query ("SELECT  FROM users");
            //$row = mysql_fetch_array($result);
            
            //mysql_query ("SELECT ")
            //echo "<img src= '".$row['img_path']."' heigth ='130px'>";
            
            
            
            

        } else {
            echo "File is not an image";
        }
}
    
    $errors = array();
    if(isset($_POST['user_name']))
    {
        if(!ctype_alnum($_POST['user_name']))
        {
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($_POST['user_name']) > 30)
        {
            $errors[] = 'The username cannot be longer than 30 characters.';
        }
    }
    else
    {
        $errors[] = 'The username field must not be empty.';
    }
     
     
    if(isset($_POST['user_pass']))
    {
        if($_POST['user_pass'] != $_POST['user_pass_check'])
        {
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
        user_level,img_name,img_path,img_type)
        VALUES('" . mysql_real_escape_string($_POST['user_name']) . "',
        '" . sha1($_POST['user_pass']) . "',
        '" . mysql_real_escape_string($_POST['user_email']) . "',
        NOW(),0,'$filename','$filepath','$filetype')";

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
        }
    }
}


?> 
