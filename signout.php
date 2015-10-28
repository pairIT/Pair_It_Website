<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Sign Out</title>
 
<link rel="stylesheet" href="stylesheets/styles.css" type="text/css" />

</head>

<?php
        session_start();
        session_destroy();
?>
    
<html>
<body class="main-wrapper">
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
