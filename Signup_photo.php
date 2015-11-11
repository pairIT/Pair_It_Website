<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Register</title>
    
<link rel="stylesheet" href="stylesheets/styles.css" type="text/css" />
<link rel="stylesheet" href="fonts/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

</head>
<body class="main-wrapper">
		
		<!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li>
                   <a href="index.php"><img src="photofile/logo.png" class="img-logo-profile"></a>
                </li>
                <li>
                    <h4 class="sub-txt-p" style="margin-left:-20px;">Pair It</h4>
                </li>
				</br>
				</br>
				</br>
                <li>
                    <a href="login.php"><h4 class="sub-txt-p" style="margin-left:-20px;">LOGIN</h4></a>
                </li>
				</br>
				<li>
                    <a href="Signup_photo.php"><h4 class="sub-txt-p" style="margin-left:-20px;">SIGN UP</h4></a>
                </li>
				</br>
				<li>
                   <a href="signout.php"><h4 class="sub-txt-p" style="margin-left:-20px;">LOGOUT</h4></a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
		
		 <!-- Sidebar 2-->
        <div id="sidebar-wrapper-two" style="background-color:#EAAC3B; margin-right:50px;">
            <br><br><br><br><br>
            <a href="profile.php"><i class="profile-06 icons-active" style="margin-left:120px; color:#fff; font-size:90px;"></i></a>
            <br><br><br><br>
            <a href="index.php"><i class="blog icons" style="margin-left:120px; font-size:90px;"></i></a>
            <br><br><br><br>
        </div>
    
        <!-- /#sidebar-wrapper -->

    <div class="row">
        <div class="col-xs-12">
            <h1 class="txt-center heading-txt">Register</h1>
            <div class="row">
                <div class="col-xs-4 col-md-4"></div>
                <div class="col-xs-4 col-md-4">
                    <?php
                    session_start();
                    include 'connect.php';

                    if($_SERVER['REQUEST_METHOD'] != 'POST')
                    {

                        echo '
                        
                        <form action="Signup_photo.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <img src = "photofile/default_profile.png" width="70"/>
                                <input type="file" name="file_img"/>
                                <br><br>
                                <h4 class="sub-txt">Username</h4>
                                <h4 class="sub-txt" style="margin-top:25px;">Firstname</h4>
                                <h4 class="sub-txt" style="margin-top:30px;">Surname</h4>
                                <h4 class="sub-txt" style="margin-top:30px;">Location</h4>
                                <h4 class="sub-txt" style="margin-top:30px;">Email</h4>
                                <h4 class="sub-txt" style="margin-top:30px;">Password</h4>
                                <h4 class="sub-txt" style="margin-top:30px; margin-left:-100px;">Confirm Password</h4><form>

                            </div>
                            <div class="col-md-8">

                                 <input type="text" name="user_name" class="form-control" placeholder="Type your username" style="margin-top:130px;"/><br> 
									<input type="text" name="first_name" class="form-control" placeholder="Type your firstname"/><br>
									<input type="text" name="last_name" class="form-control" placeholder="Type your lastname"/><br>
									<input type="text" name="location" class="form-control" placeholder="Type your location"/><br>
									<input type="email" name="user_email" class="form-control" placeholder="Type your email address"/><br>
                                 <input type="password" name="user_pass" class="form-control" placeholder="Type your password" id="status" onkeyup="checkPassStrength()"/>
									<span class="first"></span>
									<label type="strength" id="label"></label><br>
                                 <input type="password" name="user_pass_check" placeholder="Confirm password" class="form-control" style="margin-top:18px;"> 

                            </div>
                        </div>
						
                        <div class="row">
                            <input type="submit" name="btn_upload" value="Sign Up" class="btn btn-default submit-btn" style="margin-bottom:100px; margin-top:50px;">
                            </form>
                        </div>';
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
                                 $errors[] = '<h4 class="sub-txt error-txt">File is not an image</h4>'; 

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
                                $errors[] = '<h4 class="sub-txt error-txt">The username is already taken.</h4>'; 
         
                            }                             
                            
                            if(!ctype_alnum($_POST['user_name'])){
                                $errors[] = '<h4 class="sub-txt error-txt">The username can only contain letters and digits.</h4>';
                            }
                            if(strlen($_POST['user_name']) > 30){
                                $errors[] = '<h4 class="sub-txt error-txt">The username cannot be longer than 30 characters.</h4>';
                            }
                            if(strlen($_POST['user_name']) < 5){
                                $errors[] = '<h4 class="sub-txt error-txt">The username cannot be shorter than 5 characters.</h4>';
                            }

                        }else
                        {
                            $errors[] = '<h4 class="sub-txt error-txt">The username field must not be empty.</h4>';
                        }


                        if(isset($_POST['first_name']))
                        {
                            if(!preg_match('/^[a-z0-9 .\-]+$/i', $_POST['first_name'])){
                                $errors[] = '<h4 class="sub-txt error-txt">The first name can only contain letters and digits.</h4>';
                            }
                            if(strlen($_POST['first_name']) > 30){
                                $errors[] = '<h4 class="sub-txt error-txt">The first name cannot be longer than 30 characters.</h4>';
                            }
                            if(strlen($_POST['first_name']) < 5){
                                $errors[] = '<h4 class="sub-txt error-txt">The first name cannot be shorter than 5 characters.</h4>';
                            }
                        }else
                        {
                            $errors[] = '<h4 class="sub-txt error-txt">The first name must not be empty.</h4>';
                        }


                          if(isset($_POST['last_name']))
                        {
                            if(!preg_match('/^[a-z0-9 .\-]+$/i', $_POST['last_name'])){
                                $errors[] = '<h4 class="sub-txt error-txt">The last name can only contain letters and digits.</h4>';
                            }
                            if(strlen($_POST['last_name']) > 30){
                                $errors[] = '<h4 class="sub-txt error-txt">The last name cannot be longer than 30 characters.</h4>';
                            }
                            if(strlen($_POST['last_name']) < 5){
                                $errors[] = '<h4 class="sub-txt error-txt">The last name cannot be shorter than 5 characters.</h4>';
                            }
                        }else
                        {
                            $errors[] = '<h4 class="sub-txt error-txt">The last name must not be empty.</h4>';
                        }

                        if(isset($_POST['location']))
                        {
                            if(!preg_match('/^[a-z0-9 .\-]+$/i', $_POST['location'])){
                                $errors[] = '<h4 class="sub-txt error-txt">The location can only contain letters and digits.</h4>';
                            }
                            if(strlen($_POST['location']) > 30){
                                $errors[] = '<h4 class="sub-txt error-txt">The location cannot be longer than 30 characters.</h4>';
                            }
                            if(strlen($_POST['location']) < 5){
                                $errors[] = '<h4 class="sub-txt error-txt">The location cannot be shorter than 5 characters.</h4>';
                            }
                        }else
                        {
                            $errors[] = '<h4 class="sub-txt error-txt">The location must not be empty.</h4>';
                        }


                        if(isset($_POST['user_email']))
                        {
                            if(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)){
                                $errors[] = '<h4 class="sub-txt error-txt">Invalid email format</div>';
                            }
                            if(strlen($_POST['user_email']) > 30){
                                $errors[] = '<h4 class="sub-txt error-txt">The location cannot be longer than 30 characters.</div>';
                            }
                            if(strlen($_POST['user_email']) < 5){
                                $errors[] = '<h4 class="sub-txt error-txt">The location cannot be shorter than 5 characters.</div>';
                            }
                        }else
                        {
                            $errors[] = '<h4 class="sub-txt error-txt">The location must not be empty.</div>';
                        }


                        if(isset($_POST['user_pass']))
                        {
                            if($_POST['user_pass'] != $_POST['user_pass_check']){
                                $errors[] = '<h4 class="sub-txt error-txt">The two passwords did not match.</div>';
                            }
                        }
                        else
                        {
                            $errors[] = '<h4 class="sub-txt error-txt">The password field cannot be empty.</div>';
                        }

                        if(!empty($errors))
                        {
                            echo '<h4 class="sub-txt error-txt">Some of the fields are filled in incorrectly</div>';
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
                                echo '<a href="Signup_photo.php" type="button" class="btn btn-default submit-btn">Reload</a>';
                            }
                            
                            else
                            {

								echo  '<img src = "http://localhost:8888/PairIt/Pair_It_Website/'.$_SESSION['file_img'].'"/><br/>';
								
                                echo '<h4 class="sub-txt-center">Welcome '.$_SESSION['user_name'].' <br>You are successfully registered.<br> You can now Sign In and start posting! </h4>';
								echo '<a href="login.php"><button type="button" class="btn btn-default submit-btn">Sign In</button></a><br><br>';
								
                                echo  '<h4 class="sub-txt-center">You can also view your Profile Page and update your details.<br/></h4>'; 
								 
								echo '<a href="profile.php"><button type="button" class="btn btn-default submit-btn">Profile Page</button></a>';
								 
                               
                             
                                
                                
                               
                            }
                        }
                    }
                    ?> 


                </div>
                <div class="col-xs-4 col-md-4"></div>
            </div>
        </div>
    </div>

	<?php
    mysql_close();
?>
	<script>

    function goBack() {
        window.history.back();
    }
    </script>
    <script src="javascripts/bootstrap.min.js"></script> 
    <script src="js/jquery-1.11.2.js"></script> 
<script src="js/password.js"></script>



</body>
</html>
