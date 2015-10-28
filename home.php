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
        <div id="sidebar-wrapper-two" style="background-color:#FFC24B;">
            <br><br><br><br><br>
            <a href="profile.php"><i class="profile-06 icons" style="margin-left:120px; font-size:90px;"></i></a>
            <br><br><br><br>
            <a href="home.php"><i class="blog icons icons-active" style="margin-left:120px; font-size:90px;"></i></a>
            <br><br><br><br>
            <a href="notifications.php"><i class="notifications icons" style="margin-left:120px; font-size:90px;"></i></a>
        </div>
        <!-- /#sidebar-wrapper -->
<div id="page-content-wrapper">
   <div class="container-fluid">
       
    <?php
    // Check your database config:
	include 'connect.php';
	
	//if(!isset($_POST['search'])) {
	// If you ever change the header info do it before ALL html on the page
	//	header("Location:index.php");
	//}
    ?>

    <div class="header-sec">
        <div class="row">
            <div class="col-md-9 col-sm-8">
                <h4 class="sub-txt" style="text-align:left;">Pair It</h4>
            </div>
            <div class="col-md-1 col-sm-2">
               <h4 class="sub-txt">Logout</h4> 
            </div>
            <div class="col-md-1 col-sm-2">
               <h4 class="sub-txt">Register</h4> 
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            <form name="searchform" method="POST" action="search.php">
                <input name="search" type="text" size="40" class="search-bar"/>
                <i type="submit" name="Submit" value="Search" class="fa fa-search search-icon"></i>
                <input type="submit" name="Submit" value="Search" class="search"/>
            </form>
        </div>
     </div>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	
	$search_sql = "SELECT * FROM users WHERE user_name LIKE '%".$_POST['search']."%'";
	$search_query = mysql_query($search_sql);
	
	if(mysql_num_rows($search_query)!=0)
	{
		while ($search_rs=mysql_fetch_assoc($search_query))
		{ 
			echo "<p>" . $search_rs['user_name'] . "</p>";
		
		}
	} else
	{
		echo "No results found!";
	}
}

?>
       
<?php
// Don't forget to close the connection
mysql_close();
?>  
       
       
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


<<<<<<< HEAD
echo 'Welcome, ' . $_SESSION['user_name'] . " " . $_SESSION['user_id'];
=======
$user_level = 0;

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true && $_SESSION['user_level'] == 0 && $user_level == 0)
{
    $user_level = 1;
}

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true && $_SESSION['user_level'] == 2)
{
    $user_level = 2;
}

if($user_level == 0)
{

echo "<p>To start posting questions and leaving comments please <a href = 'login.php'>log in</a> or <a href='Signup_photo.php'>sign up</a></p>";

}


>>>>>>> 97bd5fc1e25bd3c6cb5472f638910800ade6c2b1

$user_level = 0;

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true && $_SESSION['user_level'] == 0 && $user_level == 0)
{
    $user_level = 1;
}

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true && $_SESSION['user_level'] == 2)
{
    $user_level = 2;
}

if($user_level == 0)
{

echo "<p>To start posting questions and leaving comments please <a href = 'login.php'>log in</a> or <a href='Signup_photo.php'>sign up</a></p>";

}



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $post_post = new Post();
    $post_post->question = $_POST["question"];
    $post_post->description = $_POST["description"];
    $post_post->user_id = $_SESSION['user_id'];
    
        mysql_query("INSERT INTO post(question, description, user_id)
    VALUES ('$post_post->question', '$post_post->description', '$post_post->user_id')");
}


<<<<<<< HEAD
       <div class="header-sec">
        <div class="row">
            <h4 class="sub-txt" style="text-align:left; margin-left:10px;">Post a Question</h4>   
        </div>
            <form id="form1" name="form1" method="post" action="home.php">
                <div class="row">
                <div class="col-md-6">
                    <input name="question" type="text" id="question" placeholder="Question" class="search-bar"  style="margin-left:-7px;"/>
                </div>
                <div class="col-md-6"></div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <input name="description" type="text" id="desctription" placeholder="Description" class="search-bar" style="margin-left:-7px; margin-top:-120px;"/>
                </div>
                <div class="col-md-6">
                    <input type="submit" name="Submit" value="Submit" class="btn btn-default submit-btn" style="margin-top:-100px; height:130px; width:90%;"/>
                </div>
                </div>
        </form>
           
        <hr class="hr-white">
         
        <h3 class="sub-txt" style="text-align:center; font-size:30px;">News Feed</h3> 
     </div>


if($user_level == 1 OR $user_level == 2)
{

echo "<html>";
echo "    <form id='form1' name='form1' method='post' action='home.php'>";
echo "        <h1>Post a Question</h1>";
echo "        <h4>Question</h4>";
echo "        <input name='question' type='text' id='question'/>";
echo "        <h3>Description</h3>";
echo "        <input name='description' type='text' id='desctription'/>";
echo "        <input type='submit' name='Submit' value='Submit' /> ";
echo "    </form>";
}

=======
if($user_level == 1 OR $user_level == 2)
{

echo "<html>";
echo "    <form id='form1' name='form1' method='post' action='home.php'>";
echo "        <h1>Post a Question</h1>";
echo "        <h4>Question</h4>";
echo "        <input name='question' type='text' id='question'/>";
echo "        <h3>Description</h3>";
echo "        <input name='description' type='text' id='desctription'/>";
echo "        <input type='submit' name='Submit' value='Submit' /> ";
echo "    </form>";
}

>>>>>>> 97bd5fc1e25bd3c6cb5472f638910800ade6c2b1
?>
      
        <h1>News Feed</h1>
        
<?php

if (isset($_POST["delete"])){
$query= mysql_query("DELETE FROM post WHERE id = $post_id");
}   

$rows = mysql_query("SELECT post.id, post.question, post.description FROM post");

for ($i = 0; $i < mysql_numrows($rows); $i++)
{
    $id = mysql_result($rows, $i, "post.id");
    $question = mysql_result($rows, $i, "post.question");
    $description = mysql_result($rows, $i, "post.description");
    
    echo "<a href='Single_post.php?post_id=$id'>"; 
    echo "<h3>Q: $question</h3>";
    echo "<p>Description: $description</p></a>";
    
    if($user_level == 2)
    {
        echo "<form id='delete' name='delete' method='post' action='home.php
post_id='$post_id'>";        
        echo "<input type='submit' value='Delete Post' />";
        echo "</form>";
    }
}
    
        ?>
                        
    </body>
</html>

<?php
    mysql_close();
?>
</div></div>
</div>
</body>
</html>
