<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Profile</title>
 
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
            <a href="index.php"><i class="blog icons" style="margin-left:120px; font-size:90px;"></i></a>
            <br><br><br><br>
            <a href="notifications.php"><i class="notifications icons" style="margin-left:120px; font-size:90px;"></i></a>
        </div>
        <!-- /#sidebar-wrapper -->

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
                         <img src="http://localhost:8888/PairIt/Pair_It_Website/'.$_SESSION['file_img'].'" class="img-logo-profile-pic">
                        <br><br> 
                            <h4 class="sub-txt-style2">'.$_SESSION['user_name'].'</h4>
                        <hr class="hr-white">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10"> ';
                                    
                             
                               
                                echo  "The name is ".$_SESSION['user_name']."";
                                $user_name = $_SESSION['user_name'];
                                $sql = mysql_query("SELECT user_rep FROM users WHERE user_name='$user_name'");
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
                                <h4 class="sub-txt" style="text-align:left; margin-top:20px;">'.$_SESSION['first_name'].'</h4>
                            </div>
                            <div class="col-sm-5">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Surname:</h4>
                                <h4 class="sub-txt" style="text-align:left; margin-top:20px;">'.$_SESSION['last_name'].'</h4>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>

                        
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Location</h4>
                                <h4 class="sub-txt" style="text-align:left; margin-top:20px;">'.$_SESSION['location'].'</h4>
                            </div>
                            <div class="col-sm-5">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Email</h4>
                                <h4 class="sub-txt" style="text-align:left; margin-top:20px;">'.$_SESSION['user_email'].'</h4>
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
</html>