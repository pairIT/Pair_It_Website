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
    VALUES ('$post_post->question', '$post_post->description')");
}

class Comment
{
    public $comment_brand_name;
    public $comment_varietal;
    public $comment_vintage;
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $post_comment = new Comment();
    $post_comment->brand_name = $_POST["brand"];
    $post_comment->varietal = $_POST["varietal"];
    $post_comment->vintage = $_POST["vintage"];
        mysql_query("INSERT INTO comments(brand_name, varietal, vintage)
    VALUES ('$post_comment->brand_name', '$post_comment->varietal','$post_comment->vintage')");
}

?>


<html>
    
    <html>
    <form id="form1" name="form1" method="post" action="add_question.php">
        <h1>Post a Question</h1>
        <input name="question" type="text" id="question"/>
        <input name="description" type="text" id="desctription"/>
        <input type="submit" name="Submit" value="Submit" /> 
    </form>
        
        <h1>News Feed</h1>
        
        <?php

$rows = mysql_query("SELECT comments.brand_name, comments.brand_name, comments.varietal FROM comments INNER JOIN post ON comments.post_id=post.id");

$rows2 = mysql_query("SELECT post.question, post.description FROM post");

for ($i = 0; $i < mysql_numrows($rows); $i++)
{
    $question = mysql_result($rows2, $i, "post.question");
    $description = mysql_result($rows2, $i, "post.description");
    $comment_brand_name = mysql_result($rows, $i, "comments.brand_name");
    $comment_varietal = mysql_result($rows, $i, "comments.varietal");
    $comment_vintage = mysql_result($rows, $i, "comments.vintage");
    
    echo "<div class='post'>"; 
    echo "<h2>Question: $question</h2>";
    echo "<p>Description: $description</p>";
    echo "<div class='comments'>";
    echo "<h2>Comments</h2>";
    echo "<p>$comment_brand_name $comment_varietal $comment_vintage</p>";
    echo "</div>";
    echo " <h1>Post a comment</h1>";
//    echo " <form id="comment">";
//    echo "     <label for="brand">Brand Name</label>";
//    echo "     <input type="text" id="brand" name="brand" />";
//    echo "     <label for="varietal">Wine Varietal</label>";
//    echo "     <input type="text" id="varietal" name="varietal" />";
//    echo "     <label for="vintage">Vintage</label>";
//    echo "     <input type="text" id="vintage" name="vintage" />";
//    echo "     <input type="submit" value="Post Comment" />";
//    echo "  </form>";
//    echo "</div>";
}
    
        ?>
                        
    </body>
</html>

<?php
    mysql_close();
?>