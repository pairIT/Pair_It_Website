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