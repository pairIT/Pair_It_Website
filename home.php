<?php
        include 'connect.php';
        session_start();

class Post
{
    public $id;
    public $question;
    public $description;
    public $user_id;
}

echo 'Welcome, ' . $_SESSION['user_name'] . " " . $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $post_post = new Post();
    $post_post->question = $_POST["question"];
    $post_post->description = $_POST["description"];
    $post_post->user_id = $_SESSION['user_id'];
    
        mysql_query("INSERT INTO post(question, description, user_id)
    VALUES ('$post_post->question', '$post_post->description', '$post_post->user_id')");
}

?>


<html>
    <form id="form1" name="form1" method="post" action="home.php">
        <h1>Post a Question</h1>
        <h4>Question</h4>
        <input name="question" type="text" id="question"/>
        <h3>Description</h3>
        <input name="description" type="text" id="desctription"/>
        <input type="submit" name="Submit" value="Submit" /> 
    </form>
        
        <h1>News Feed</h1>
        
        <?php


$rows = mysql_query("SELECT post.id, post.question, post.description FROM post");

for ($i = 0; $i < mysql_numrows($rows); $i++)
{
    $id = mysql_result($rows, $i, "post.id");
    $question = mysql_result($rows, $i, "post.question");
    $description = mysql_result($rows, $i, "post.description");
    
    echo "<a href='Single_post.php?post_id=$id'>"; 
    echo "<h3>Q: $question</h3>";
    echo "<p>Description: $description</p></a>";
}
    
        ?>
                        
    </body>
</html>

<?php
    mysql_close();
?>