<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Login</title>
    
<link rel="stylesheet" href="stylesheets/styles.css" type="text/css" />
    
</head>
 
<body class="main-wrapper">
    
    <?php include 'connect.php'; ?>
    
    <div class="row">
        <div class="col-md-12">
            <h1 class="txt-center heading-txt">SIGN UP</h1>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                     <div class="row">
                        <?php 
                        if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
                        {
                            echo 'You are already signed in, you can <a href="signout.php">sign out</a> if you want.';
                        }
                    else
                        {
                        if($_SERVER['REQUEST_METHOD'] != 'POST')
                        {
                        echo '<div class="col-md-4">
                                <h4 class="sub-txt">Email</h4>
                                <h4 class="sub-txt" style="margin-top:25px;">Password</h4>
                             </div>
                             <div class="col-md-8">';
                                 echo '<form method="post" action="">
                                            <input type="text" class="form-control" name="user_name" placeholder="Type your username"><br>
                                            <input type="password" class="form-control" name="user_pass" placeholder="Type your password">
                                            </div>
                                            </div>
                                            <br>
                                            <button type="submit" value="Sign in" class="btn btn-default submit-btn">Submit</button>
                                        </form>';         
                                    
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
                                            echo 'Something went wrong while signing in. Please try again later.';
                                        }
                                        else
                                        {
                                            if(mysql_num_rows($result) == 0)
                                            {
                                                echo '<h4 class="sub-txt error-txt">You have supplied a wrong user/password combination. Please try again.</h4><br>
                                                <form><button type="button" onClick="goBack()" value="Refresh" class="btn btn-default submit-btn">Reload</button></form>';
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
                            echo 'Welcome, ' . $_SESSION['user_name'] . '. <a href="index.php">Proceed to the forum overview</a>.';
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>
</body>
    
<script>
    function goBack() {
        window.history.back();
    }
</script>
<script src="javascripts/bootstrap.min.js"></script>    
</html>