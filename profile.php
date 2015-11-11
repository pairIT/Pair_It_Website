<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Profile</title>
 
<link rel="stylesheet" href="stylesheets/styles.css" type="text/css" />
<link rel="stylesheet" href="fonts/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

</head>

<body class="main-wrapper  backgound-style" style="color:#fff;" id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars" style="color:#fff;"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    Pair IT
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Blog</a>
                    </li>
                    <li> 
                        <a href="profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="Signup_photo.php">Register</a>
                    </li>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                    <li>
                        <a href="login.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="wrapper">
        
        <!-- Page Content -->
        <?php
        session_start();
        include 'connect.php';

        echo '
            <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row" style="margin-top:70px;">
                    <div class="col-lg-12">
                        <a href="Update_ProfilePage.php">
                            <div class="circle">
                                <i class="fa fa-pencil edit-btn"></i>
                            </div>
                        </a>
                         <img src="photofile/'.$_SESSION['file_img'].'" class="img-logo-profile-pic"> 
                        <br><br> 
                            <h4 class="sub-txt-style2">'.$_SESSION['user_name'].'</h4>
                        <hr class="hr-white">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10"> ';
                                    
                             
                               
                                $user_name = $_SESSION['user_name'];
                                $sql = mysql_query("SELECT user_rep FROM users WHERE user_name='$user_name'");
								$name = mysql_query("SELECT first_name, last_name, location, user_email FROM users WHERE user_name='$user_name'");
								$first_name = mysql_result($name,0,'users.first_name');
								$last_name = mysql_result($name,0,'users.last_name');
								$location = mysql_result($name,0,'users.location');
								$user_email = mysql_result($name,0,'users.user_email');
                                $rep = mysql_result($sql,0,'users.user_rep');
                                
                              
                               if ($rep >= 0 && $rep <=5)
                               {
                                   echo "<h2 type='text' class='btn btn-default profile-btn'>Wine Rookie. 
                                   Points = $rep</h2>";
                                } else if ($rep >= 6 && $rep <=20)
                               {
                                    echo "<h2 type='text' class='btn btn-default profile-btn'>Wine Enthusiast. 
                                   Points = $rep</h2>";
                               } else if ($rep >= 21)
                               {
                                    echo "<h2 type='text' class='btn btn-default profile-btn'>Wine Sommaelier. 
                                   Points = $rep</h2>";
                               } else
                               {
                                   echo "<h2 type='text' class='btn btn-default profile-btn'>No Reputation</h2>";
                               
                               }


                            echo '
                                
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Name:</h4>
                                <h4 class="sub-txt" style="text-align:left; margin-top:20px;">'; echo "$first_name"; echo '</h4>
                            </div>
							
                            <div class="col-sm-5">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Surname:</h4>
                                <h4 class="sub-txt" style="text-align:left; margin-top:20px;">'; echo "$last_name"; echo '</h4>
                            </div>
                            <div class="col-sm-1"></div>
                        </div> ';

                         echo '
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Location</h4>
                                <h4 class="sub-txt" style="text-align:left; margin-top:20px;">'; echo "$location"; echo '</h4>
                            </div>
                            <div class="col-sm-5">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Email</h4>
                                <h4 class="sub-txt" style="text-align:left; margin-top:20px;">'; echo "$user_email"; echo '</h4>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        ';?>

        <?php
            mysql_close();
        ?>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>    
    
    
    
<script src="javascripts/bootstrap.min.js"></script>   
<script src="javascripts/jquery.min.js"></script>    
<script src="javascripts/jquery.easings.min.js"></script> 
<script src="javascripts/grayscale.js"></script> 

    
</html>