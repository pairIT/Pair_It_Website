<html>
	<head>
		<link rel = "stylesheet" href = "style.css" />
		<script src="js/jquery-1.11.2.js"></script> 
		<script type="text/javascript" src="jquery.js"></script>
		<!--<script type="text/javascript" src="like.js"></script>-->
	</head>
	<body>

	<script type="text/javascript">
	function add_like(comment_id) 
	{
		
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

	function like_get(comment_id)
	{
		
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
		$user_level = 0;

		echo 'Welcome,'. $_SESSION['user_name']. " " . $_SESSION['user_id'];
		
		?>
			
		<?php

			if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true && $_SESSION['user_level'] == 0)
			{
			$user_level = 1;
			}

			if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true && $_SESSION['user_level'] == 2)
			{
			$user_level = 2;
			}

			if($user_level == 0)
			{

			echo "<p>To start posting questions and leaving comments please 
			<a href = 'login.php'>log in</a> or <a href='Signup_photo.php'>sign up</a></p>";
			}

		?>
		   
		<?php

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
		?>
		
		<?php
			//delete post
			if (isset($_POST["delete_post"])){
			$query = mysql_query("DELETE FROM post WHERE id = " . $_POST["post_id"]);}
		?>
		  
		<?php
			if($user_level == 2)
			{
			echo "<form id='delete'  method='post' action='Single_post.php?post_id=$post_id'>";        
			echo "<input type='submit' name='delete_post' value='Delete Post' />";
			echo "</form>";
			}
		?>

		<?php
			$rows = mysql_query("SELECT comments.id, comments.brand_name, comments.varietal, comments.vintage, 
			comments.user_id, comments.comment_likes, users.user_name  FROM comments INNER JOIN users ON 
			comments.user_id = users.user_id WHERE comments.post_id = $post_id;");

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
				echo "<p><a class='like' href='#' name='btn_upload' onclick='add_like(", $comment_id['comment_id'] ,");'>LIKE</a> <span id='comment_ $comment_id _likes'>$comment_likes</span> likes</p>";
			} 


		?>

		<?php
			if($user_level == 2)
			{
			echo "<form id='delete_comment' name='delete_comment' method='post' action='Single_post.php?post_id=$post_id'>";        
			echo "<input type='submit' value='Delete Comment' />";
			echo "</form>";
			}
			?>
				
			<?php
			if($user_level == 1 OR $user_level == 2)
			{
				echo "<h2>Post a comment</h2>";
				echo "<form id='comment' name='comment' method='post' action='Single_post.php?post_id=$post_id'>";
				echo "<label for='brand'>Brand Name</label>";
				echo "<input type='text' id='brand' name='brand'/>";
				echo "<label for='varietals'>Wine Varietal</label>";
				echo "<input type='text' id='varietal' name='varietal'/>";
				echo "<label for='vintage'>Vintage</label>";
				echo "<input type='text' id='vintage' name='vintage'/>";
				echo "<input type='submit' value='Post Comment'/>";
				echo "</form>";
			}
		?>

		</body>
		</html>

		<?php
		mysql_close();
		?>