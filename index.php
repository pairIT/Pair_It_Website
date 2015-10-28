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
        <div id="sidebar-wrapper-two" style="background-color:#EAAC3B;">
            <br><br><br><br><br>
            <a href="profile.php"><i class="profile-06 icons-active" style="margin-left:120px; color:#fff; font-size:90px;"></i></a>
            <br><br><br><br>
            <a href="index.php"><i class="blog icons" style="margin-left:120px; font-size:90px;"></i></a>
            <br><br><br><br>
            <a href="notifications.php"><i class="notifications icons" style="margin-left:120px; font-size:90px;"></i></a>
        </div>
    
        <!-- /#sidebar-wrapper -->
        
        
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
	
	echo 'Welcome,'. $_SESSION['user_name']. " " . $_SESSION['user_id'];
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
                <h1>Post a Question</h1>
                <h4>Question</h4>
                <input name="question" type="text" id="question"/>
                <h3>Description</h3>
                <input name="description" type="text" id="desctription"/>
                <input type="submit" name="question_form" value="Submit" />
            </form>
        </div>
     </div>';    
    
}

?>
      
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
    
    echo "
        <div class='col-md-4 blog-box' style='margin-left:-10px;'>
            <a href='Single_post.php?post_id=$id'>
            <h4 class='sub-txt-left' style='color:#333; margin:40px 15px 10px 15px;' id=''>Question<br><br> $question</h4>
            <h4 class='sub-txt-left' style='font-size:17px; color:#EAAC3B; margin:0px 15px 10px 17px; font-weight:normal;'>Description: $description</h4></a>
    
        </div>
    "; 
    

    
    if($user_level == 2)
    {
        echo "<form id='delete' method='post' action='index.php'>";        
        echo "<input name='post_id' type='hidden' value='$id' />";
		echo "<input type='submit' name='delete' value='Delete Post' />";
		
        echo "</form>";
    }
}
    
        ?>
                        
    </body>
</html>

<?php
    mysql_close();
?>
</div><!-- /#wrapper -->
</body>
</html>