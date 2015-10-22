<?php
        include 'connect.php';
        session_start();

$post_id = $_GET["post_id"];

//comments

class Comment
{
    public $brand_name;
    public $varietal;
    public $vintage;
    public $user_id;
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $post_comment = new Comment();
    $post_comment->brand_name = $_POST["brand"];
    $post_comment->varietal = $_POST["varietal"];
    $post_comment->vintage = $_POST["vintage"];
    $post_comment->user_id = $_SESSION['user_id'];
        mysql_query("INSERT INTO comments(brand_name, varietal, vintage,post_id, user_id)
    VALUES ('$post_comment->brand_name', '$post_comment->varietal','$post_comment->vintage', $post_id,$post_comment->user_id)");
}


//post

$rows = mysql_query("SELECT post.question, post.description, users.user_name
FROM post INNER JOIN users ON post.user_id = users.user_id 
WHERE post.id = $post_id;");

    $username = mysql_result($rows, 0,"users.user_name");
    $question = mysql_result($rows, 0,"post.question");
    $description = mysql_result($rows, 0,"post.description");
    
    echo "<p><strong>posted by $username</strong></h3>";
    echo "<h2>$question</h2>";
    echo "<h4>$description</h4>";

    $rows = mysql_query("SELECT comments.brand_name, comments.varietal, comments.vintage, comments.user_id, users.user_name FROM comments INNER JOIN users on comments.user_id = users.user_id WHERE comments.post_id = $post_id;");
    
        echo "<h2> Comments </h2>";

    for ($i = 0; $i < mysql_numrows($rows); $i++)
    {
        $username = mysql_result($rows, $i,"users.user_name");
        $brand_name = mysql_result($rows, $i,"comments.brand_name");
        $varietal = mysql_result($rows, $i,"comments.varietal");
        $vintage = mysql_result($rows, $i,"comments.vintage");
        
        echo "<p><strong>$username</strong></p>";
        echo "<p> $brand_name $varietal $vintage</p>";
    }

?>


<h2>Post a comment</h2>
    <?php
    echo "<form id='comment' name='comment' method='post' action='Single_post.php?post_id=$post_id'>";
    ?>
        
        <label for="brand">Brand Name</label>
        <input type="text" id="brand" name="brand" />
        <label for="varietals">Wine Varietal</label>
        <input type="text" id="varietal" name="varietal" />
        <label for="vintage">Vintage</label>
        <input type="text" id="vintage" name="vintage" />
        <input type="submit" value="Post Comment" />
    </form>
    
<?php
    mysql_close();
?>