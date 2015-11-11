<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Sign Out</title>
 
<link rel="stylesheet" href="stylesheets/styles.css" type="text/css" />
<link rel="stylesheet" href="fonts/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

</head>

<?php
        session_start();
        session_destroy();
?>
    
<html>
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
        <div class="col-md-12">
            <h1 class="txt-center heading-txt">SIGN OUT</h1>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <h4 class="sub-txt" style="text-align:center;">You have been signed out</h4>
                    <br>
                    <a href="login.php"><button type="button" value="Refresh" class="btn btn-default submit-btn">Sign in again</button></a>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </div>
</body>
    
</html>
