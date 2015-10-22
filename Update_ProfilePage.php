<?php
include 'connect.php';
session_start();

 class User
    {
        public $username; 
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
    
    if(isset($_POST['btn_upload']))
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

