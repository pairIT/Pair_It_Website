<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Login</title>
    
<link rel="stylesheet" href="stylesheets/styles.css" type="text/css" />
    
</head>
 
<body class="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 class="txt-center heading-txt">SIGN IN</h1>
            <?php
            session_start();
            include 'connect.php';

            if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
            {

            echo '
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <h4 class="sub-txt-center">You are already signed in, you can sign out if you want.</h4><br>                    
                <a href="signout.php"><button type="button" class="btn btn-default submit-btn" style="max-width50%;">Sign Out</button></a>
                </div>
                <div class="col-sm-4"></div>
            </div>
            ';

            }
            else
            {
            if($_SERVER['REQUEST_METHOD'] != 'POST')
            {
                echo ' <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form method="post" action="login.php">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="sub-txt">Username</h4>
                                <h4 class="sub-txt" style="margin-top:28px;">Password</h4>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="user_name" class="form-control" placeholder="Type your username"><br>
                                <input type="password" name="user_pass" class="form-control" placeholder="Type your password" id="status" onkeyup="checkPassStrength()"/>
                                <span class="first"></span>
                                <label type="strength" id="label"></label>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" value="Sign in" class="btn btn-default submit-btn" style="margin-top:40px;"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4"></div>
                </div>';
            }
                
            else
            {
                $errors = array();

                if(!isset($_POST['user_name']))
                {
                    $errors[] = 'The username field must not be empty.';
                }

                if(!isset($_POST['user_pass']))
                {
                    $errors[] = 'The password field must not be empty.';
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
                    $sql = "SELECT user_id, user_name, user_level FROM users WHERE user_name = '" . mysql_real_escape_string($_POST['user_name']) . "' AND user_pass = '" . sha1($_POST['user_pass']) . "'";
                    $result = mysql_query($sql);
                    if(!$result)
                    {
                        echo '
                                <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                        <h4 class="sub-txt error-txt">Something went wrong while signing in. Please try again later.</h4><br>
                                    <form>
                                    <button type="button" onClick="goBack()" value="Refresh" class="btn btn-default submit-btn" style="max-width50%;">Reload</button></form>
                                    </div>
                                    <div class="col-sm-4"></div>
                                </div>
                            ';
                    }
                    else
                    {
                        if(mysql_num_rows($result) == 0)
                        {
                            echo '
                                <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                        <h4 class="sub-txt error-txt">You have supplied a wrong user/password combination. Please try again.</h4><br>
                                    <form>
                                    <button type="button" onClick="goBack()" value="Refresh" class="btn btn-default submit-btn" style="max-width50%;">Reload</button></form>
                                    </div>
                                    <div class="col-sm-4"></div>
                                </div>
                            ';
                            
                        }
                        else
                        {
                            $_SESSION['signed_in'] = true;
                            while($row = mysql_fetch_assoc($result))
                            {
                                $_SESSION['user_id']    = $row['user_id'];
                                $_SESSION['user_name']  = $row['user_name'];
                                $_SESSION['user_level'] = $row['user_level'];
                            }
                            
                            echo '
                                <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                        <h4 class="sub-txt-center"> Welcome, ' . $_SESSION['user_name'] . " "  . '.</h4><br>
                                    <a href="index.php"><button type="button" class="btn btn-default submit-btn" style="max-width50%;">Proceed to the forum overview</button></a>
                                    </div>
                                    <div class="col-sm-4"></div>
                                </div>
                            ';
                        }
                    }
                }
            }
        }
        ?>

 
        <?php
        mysql_close();
        ?>
    </div>
</div>
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
