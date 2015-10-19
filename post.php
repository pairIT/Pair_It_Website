<?php
include 'connect.php';

class Post 
{
    public $question;
    public $description;
}


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $post_post = new Post();
    $post_post->question = $_POST["question"];
    $post_post->description = $_POST["description"];
        mysql_query("INSERT INTO post(question, description)
    VALUES ('$post_post->question', '$post_post->description)");
}

?>

<html>
    <head>
    <title></title>
  </head>

<body>
    
    <h1>Post a Question</h1>
    
    <form action="post.php" method="post">
        <label for="question">
                Question
        </label>        
        <input type="text" id="question" name="question" />
        
        <label for="description">Description
        </label>
        <input type="text" id="description" name="description" />
        
        <input type="submit" value="Post Question" />
        </form>
        
    </body>
</html>

<?php
    mysql_close();
?>