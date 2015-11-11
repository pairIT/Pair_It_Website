<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Profile</title>
 
<link rel="stylesheet" href="stylesheets/styles.css" type="text/css" />
<link rel="stylesheet" href="fonts/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

    <body class="main-wrapper  backgound-style3" style="color:#fff;" id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

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
        
<div style="margin-left:50px; margin-top:70px;">    
        
<?php
session_start();        
include 'connect.php';
        

class Post
{
    public $id;
    public $question;
    public $description;
    public $user_id;
}


$user_level = 0;

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true && $_SESSION['user_level'] == 0 && $user_level == 0)
{
    $user_level = 1;
    
	
    echo '<div class="row" style="margin-left:30px;">';
    echo '<div class="col-md-12">';
    echo '<div class="alert-box">';
    echo 'Welcome,'. $_SESSION['user_name']. " " ;          
    echo '</div>';
    echo '<div>';
    echo '</div>';
    echo '<hr class="hr-long">';
 
   
}

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true && $_SESSION['user_level'] == 2)
{
    $user_level = 2;
}

if($user_level == 0)
{

echo '<div class="row" style="margin-left:30px;">
        <div class="col-md-12">
            <div class="alert-box">
                <h4 class="sub-txt-left">To start posting questions and leaving comments please <a href="login.php"> Log In</a> or <a href="Signup_photo.php"> Sign Up</a></h4>
            </div>
        <div>
      </div>
      <hr class="hr-long">
      ';
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["question_form"]))
{
    $post_post = new Post();
    $post_post->question = $_POST["question"];
    $post_post->description = $_POST["description"];
    $post_post->user_id = $_SESSION['user_id'];
    
        mysql_query("INSERT INTO post(question, description, user_id)
    VALUES ('$post_post->question', '$post_post->description', '$post_post->user_id')");
}


if($user_level == 1 OR $user_level == 2)
{

echo '<div class="row">
        <div class="col-sm-4">
            <form id="question_form" method="post" action="index.php">
                <h4 class="sub-txt-left" style="font-size:40px;">Post a Question</h4>
                <h4 class="sub-txt-left" style="font-size:20px;">Question</h4>
                <input name="question" type="text" id="question" class="form-control"/>
                <h4 class="sub-txt-left" style="font-size:20px;">Description</h4>
                <input name="description" type="text" id="desctription" class="form-control"/>
                <br><br>
                <input type="submit" name="question_form" value="Submit" class="btn btn-default submit-btn"/>
            </form>
        </div>
        <div class="col-sm-4">
            <h4 class="sub-txt-left" style="font-size:65px; margin-left:10px;">Did you know wine is good for your heart?</h4>
        </div>
     </div>';    
    
}

?>
 <br><br>
<h4 class="sub-txt-left" style="font-size:40px;">News Feed</h4>

        
<?php

if (isset($_POST["delete"])){
$query= mysql_query("DELETE FROM post WHERE id = " . $_POST["post_id"]);
}   

$rows = mysql_query("SELECT post.id, post.question, post.description FROM post");

for ($i = 0; $i < mysql_numrows($rows); $i++)
{
    $id = mysql_result($rows, $i, "post.id");
    $question = mysql_result($rows, $i, "post.question");
    $description = mysql_result($rows, $i, "post.description");
    
    if($user_level ==2)
        {
            echo "
            <div class='col-md-4 blog-box' style='margin-left:-10px;'>
                <a href='Single_post.php?post_id=$id'>
                <h4 class='sub-txt-left' style='color:#333; margin:40px 15px 10px 15px;' id=''>Question<br><br> $question</h4>
                <h4 class='sub-txt-left' style='font-size:17px; color:#EAAC3B; margin:0px 15px 10px 17px; font-weight:normal;'>Description: $description</h4></a>
                <form id='delete' method='post' action='index.php'>
                    <input name='post_id' type='hidden' value='$id' />
                    <input type='submit' name='delete' value='Delete Post' class='btn btn-default submit-btn'/>
                </form>
            </div>";
        }
    
    else if($user_level ==1)
        {
            echo "
            <div class='col-md-4 blog-box' style='margin-left:-10px;'>
                <a href='Single_post.php?post_id=$id'>
                <h4 class='sub-txt-left' style='color:#333; margin:40px 15px 10px 15px;' id=''>Question<br><br> $question</h4>
                <h4 class='sub-txt-left' style='font-size:17px; color:#EAAC3B; margin:0px 15px 10px 17px; font-weight:normal;'>Description: $description</h4></a>
            </div>";
        }
    
    else if($user_level ==0)
        {
            echo "
            <div class='col-md-4 blog-box' style='margin-left:-10px;'>
                <a href='Single_post.php?post_id=$id'>
                <h4 class='sub-txt-left' style='color:#333; margin:40px 15px 10px 15px;' id=''>Question<br><br> $question</h4>
                <h4 class='sub-txt-left' style='font-size:17px; color:#EAAC3B; margin:0px 15px 10px 17px; font-weight:normal;'>Description: $description</h4></a>
            </div>";
        }
    
}
?>

<?php
    mysql_close();
?>
</div>
</div><!-- /#wrapper -->
</body>
</html>