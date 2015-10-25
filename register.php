<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Register</title>
 
<link rel="stylesheet" href="stylesheets/styles.css" type="text/css" />

</head>
    
<?php include 'connect.php'; ?>

<body class="main-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="txt-center heading-txt">Register</h1>
            <div class="row">
                <div class="col-xs-2 col-md-4">
                </div>
                <div class="col-xs-8 col-md-4">
                     <div class="row">
                    <?php
                    if($_SERVER['REQUEST_METHOD'] != 'POST')
                    {  
                    echo'
                        <div class="col-xs-4">
                            <form method="post" action="">
                            <h4 class="sub-txt">Name</h4>
                            <h4 class="sub-txt" style="margin-top:25px;">Email</h4>
                            <h4 class="sub-txt" style="margin-top:30px;">Password</h4>
                            <h4 class="sub-txt" style="margin-top:30px; margin-left:-100px;">Confirm Password</h4><form>
                        </div>
                        <div class="col-xs-8">';

                                echo'
                                 <form method="post" action="">
                                    <input type="name" class="form-control" id="InputName" placeholder="Type your name"><br>              
                                    <input type="email" class="form-control" id="InputEmail1" placeholder="Type your email address"><br>
                                    <input type="password" class="form-control" id="InputPassword1" placeholder="Type your password"><br>
                                    <input type="password" class="form-control" id="InputPasswordConfirm" placeholder="Confirm your password">
                            </div>
                         </div> 
                        <br>
                            <button type="submit" class="btn btn-default submit-btn" value="Sign Up">Submit</button>
                        </form>';
                    }

                    else
                    {
                        $errors = array();
                        if(isset($_POST['user_name']))
                        {
                            if(!ctype_alnum($_POST['user_name']))
                            {
                                $errors[] = '<p class="default-p">The username can only contain letters and digits.</p>';
                            }
                            if(strlen($_POST['user_name']) > 30)
                            {
                                $errors[] = '<p class="default-p">The username cannot be longer than 30 characters.</p>';
                            }
                        }
                        else
                        {
                            $errors[] = '<p class="default-p">The username field must not be empty.</p>';
                        }


                        if(isset($_POST['user_pass']))
                        {
                            if($_POST['user_pass'] != $_POST['user_pass_check'])
                            {
                                $errors[] = '<p class="default-p">The two passwords did not match.</p>';
                            }
                        }
                        else
                        {
                            $errors[] = '<p class="default-p">The password field cannot be empty.</p>';
                        }

                        if(!empty($errors))
                        {
                           
                            echo '<h4 class="sub-txt error-txt">Some of the fields are filled in incorrectly<h4><br>';
                            echo '<ul>';
                            foreach($errors as $key => $value)
                            {
                                echo '<li>' . $value . '</li>';
                            }
                            echo '</ul>';
                            echo '<br><br><form><button type="button" onClick="goBack()" value="Refresh" class="btn btn-default submit-btn">Reload</button></form>';
            
                        }
                        else
                        {
                            $sql = "INSERT INTO users(user_name, user_pass, user_email ,user_date,
                            user_level)
                            VALUES('" . mysql_real_escape_string($_POST['user_name']) . "',
                            '" . sha1($_POST['user_pass']) . "',
                            '" . mysql_real_escape_string($_POST['user_email']) . "',
                            NOW(),0)";

                            $result = mysql_query($sql);
                            if(!$result)
                            {
                                echo '<p class="default-p">Something went wrong while registering. Please try again
                                later.</p>';
                            }
                            else
                            {
                                echo 'Successfully registered. You can now <a
                                href="signin.php">sign in</a> and start posting!';
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-xs-2 col-md-4">
                </div>
            </div>
        </div>
    </div>
    <script>
    function goBack() {
        window.history.back();
    }
    </script>
    <script src="javascripts/bootstrap.min.js"></script> 
</body>
</html>