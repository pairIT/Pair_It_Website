    
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Profile Update</title>
 
<link rel="stylesheet" href="stylesheets/styles.css" type="text/css" />
<link rel="stylesheet" href="fonts/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

</head>

<body class="main-wrapper">
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li>
                    <img src="photofile/logo.png" class="img-logo-profile">
                </li>
                <li>
                    <h4 class="sub-txt-p" style="margin-left:-20px;">Pair It</h4>
                </li>
                <li>
                    <div class="verticalLine"></div>
                </li>
                <li>
                    <h4 class="sub-txt-p" style="margin-left:-20px;">Log Out</h4>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        
        <!-- Sidebar 2-->
        <div id="sidebar-wrapper-two">
            <br><br><br><br><br>
            <a href="profile.php"><i class="profile-06 icons-active" style="margin-left:120px; color:#fff; font-size:90px;"></i></a>
            <br><br><br><br>
            <a href="blog.php"><i class="blog icons" style="margin-left:120px; font-size:90px;"></i></a>
            <br><br><br><br>
            <a href="notifications.php"><i class="notifications icons" style="margin-left:120px; font-size:90px;"></i></a>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row" style="margin-top:-120px;">
                    <div class="col-lg-12">
<!--
                        <a href="">
                            <div class="circle">
                                <i class="fa fa-pencil edit-btn"></i>
                            </div>
                        </a>
-->
                        
                        <!--start of php for image upload-->
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
                                    <img src="photofile/profile.png" class="img-logo-profile-pic">
                                    <br><br>
                                    <h4 class="sub-txt-style2">'.$_SESSION['user_name'].'</h4>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-5">
                                            <input type="file" name="file_img" class="btn btn-default profile-btn"/>
                                        </div>
                                        <div class="col-sm-5">
                                            <button type="submit" name="Update_photo" value="Upload photo" class="btn btn-default profile-btn">Save Upload Photo</button>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
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
                        <!--end of php for image upload-->
                        <hr class="hr-white">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <button type="button" class="btn btn-default profile-btn">My Rating 12</button>
                            </div>
                            <div class="col-sm-5">
                                <button type="button" class="btn btn-default profile-btn">Following 500</button>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        
                        <!--start of form-->
                        <form action="Update_ProfilePage.php" method="POST">  
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">About Me</h4>
                                <input type="text" class="form-control" name="about_me"> 
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Name</h4>
                                <input type="text" class="form-control" name="first_name">  
                            </div>
                            <div class="col-sm-5">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Surname</h4>
                                <input type="text" class="form-control" name="last_name"> 
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Location</h4>
                                <input type="text" class="form-control" name="location">                                 
                            </div>
                            <div class="col-sm-5">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Email</h4>
                                <input type="text" class="form-control" name="user_email"> 
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <br><br><br>
                        <div class="row" style="margin-bottom:100px;">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <button type="submit" value="Update"  name="Update_info" class="btn btn-default" style="width:100%">Update</button>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        </form>  <!-- /#end of form -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>    
    
    
    
<script src="javascripts/bootstrap.min.js"></script> 
<?php
    mysql_close();
?>
</html>