<html>
	<head>
		<link rel = "stylesheet" href = "style.css" />
		<script src="js/jquery-1.11.2.js"></script> 
		<script type="text/javascript" src="jquery.js"></script>
		<!--<script type="text/javascript" src="like.js"></script>-->
	</head>
	<body>

	<script type="text/javascript">
	function add_like(comment_id) {
		
		$.post('like_add.php', {comment_id:comment_id},  function(data){
			if(data == 'success')
			{
				// do something
				like_get(comment_id);
			} else{
				alert(data);
			}
		});
		
	}

	function like_get(comment_id){
		
		$.post('like_get.php', {comment_id:comment_id},  function(data){
			$('#comment_'+comment_id+'_likes').text(data);
		});
		
	}


	</script>

<?php
        include 'connect.php';
		include 'like.php';
        session_start();

$post_id = $_GET["post_id"];



//comments

class Comment
{
	public $comment_id;
    public $brand_name;
    public $varietal;
    public $vintage;
    public $user_id;
	public $comment_likes;
}



echo 'Welcome, ' . $_SESSION['user_name'] . " " . $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $post_comment = new Comment();
    $post_comment->brand_name = $_POST["brand"];
    $post_comment->varietal = $_POST["varietal"];
    $post_comment->vintage = $_POST["vintage"];
    $post_comment->user_id = $_SESSION['user_id'];
		echo "INSERT INTO comments(brand_name, varietal, vintage,post_id, user_id)
    VALUES ('$post_comment->brand_name', '$post_comment->varietal','$post_comment->vintage', $post_id,$post_comment->user_id, $post_comment->comment_likes)";
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

    $rows = mysql_query("SELECT comments.id, comments.brand_name, comments.varietal, comments.vintage, comments.user_id, comments.comment_likes, users.user_name  FROM comments INNER JOIN users on comments.user_id = users.user_id WHERE comments.post_id = $post_id;");
    
        echo "<h3> Comments </h3>";
  
    for ($i = 0; $i < mysql_numrows($rows); $i++)
    {
        $username = mysql_result($rows, $i,"users.user_name");
        $brand_name = mysql_result($rows, $i,"comments.brand_name");
        $varietal = mysql_result($rows, $i,"comments.varietal");
        $vintage = mysql_result($rows, $i,"comments.vintage");
		$comment_likes = mysql_result($rows, $i,"comments.comment_likes");
		$comment_id = mysql_result($rows, $i,"comments.id");
        
        echo "<p><strong>$username</strong></p>";
        echo "<p> $brand_name $varietal $vintage</p>";
		echo "<p><a class='like' href='#' onclick = 'add_like(", $comment_id['comment_id'] ,");'>LIKE</a> <span id='comment_ $comment_id _likes'>$comment_likes</span>likes</p>";
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
	
	</body>
</html>
    
<?php
    mysql_close();
?>