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
            <a href="blog.php"><i class="blog icons" style="margin-left:120px; font-size:90px;"></i></a>
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
                            <div class="col-sm-5">
                                <button type="button" class="btn btn-default profile-btn">My Reputation 12</button>
                            </div>
                            <div class="col-sm-5">
                                <button type="button" class="btn btn-default profile-btn">Following 500</button>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">About Me</h4>
                                <h4 class="sub-txt" style="text-align:left; margin-top:20px;">There are few things in life that gives me as much pleasure as food and wine. As a young girl I had always a love for food, and now I marval in the combinations of colours and emotions each time I take a sip of marvelous wine with its host of delious food.</h4>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Name</h4>
                                <h4 class="sub-txt" style="text-align:left; margin-top:20px;">'.$_SESSION['first_name'].'</h4>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Name</h4>
                                <h4 class="sub-txt" style="text-align:left; margin-top:20px;">'.$_SESSION['last_name'].'</h4>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Location</h4>
                                <h4 class="sub-txt" style="text-align:left; margin-top:20px;">'.$_SESSION['location'].'</h4>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <h4 class="sub-txt" style="text-align:left; margin-top:60px; font-weight:200;">Email</h4>
                                <h4 class="sub-txt" style="text-align:left; margin-top:20px;">'.$_SESSION['user_email'].'</h4>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        ';
        ?>

        <?php
            mysql_close();
        ?>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>    
    
    
    
<script src="javascripts/bootstrap.min.js"></script>    
</html>