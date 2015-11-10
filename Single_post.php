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
                    <a href="index.php"><img src="photofile/logo.png" class="img-logo-profile"></a>
                </li>
                <li>
                    <h4 class="sub-txt-p" style="margin-left:-20px;">Pair It</h4>
                </li>
				</br>
				</br>
				</br>
                <li>
                    <a href="login.php"><h4 class="sub-txt-p" style="margin-left:-20px;">LOGIN</h4></a>
                </li>
				</br>
				<li>
                    <a href="Signup_photo.php"><h4 class="sub-txt-p" style="margin-left:-20px;">SIGN UP</h4></a>
                </li>
				</br>
				<li>
                   <a href="signout.php"><h4 class="sub-txt-p" style="margin-left:-20px;">LOGOUT</h4></a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
		
		 <!-- Sidebar 2-->
        <div id="sidebar-wrapper-two" style="background-color:#EAAC3B; margin-right:50px;">
            <br><br><br><br><br>
            <a href="profile.php"><i class="profile-06 icons-active" style="margin-left:120px; color:#fff; font-size:90px;"></i></a>
            <br><br><br><br>
            <a href="index.php"><i class="blog icons" style="margin-left:120px; font-size:90px;"></i></a>
            <br><br><br><br>
        </div>
    
        <!-- /#sidebar-wrapper -->

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
        
        <div style="margin-left:50px;">  

		<?php
			include 'connect.php';
			include 'like.php';
			session_start();

		$post_id = $_GET["post_id"];
		$user_level = 0;


        echo '<div class="row" style="margin-left:30px;">';
        echo '<div class="col-md-12">';
        echo '<div class="alert-box">';
        echo 'Welcome,'. $_SESSION['user_name']. " " ;          
        echo '</div>';
        echo '<div>';
        echo '</div>';
        echo '<hr class="hr-long">';

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
                
                echo '<div class="row" style="margin-left:30px;">
                <div class="col-md-12">
                    <div class="alert-box">
                        <h4 class="sub-txt-left">To start posting questions and leaving comments please <a href="login.php"> Log In</a> or <a href="Signup_photo.php"> Sign Up</a></h4>
                    </div>
                <div>
              </div>
                ';
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


			echo "<div class='blog-box-new'>";
            echo "<h4 class='sub-txt-left'> - Posted by $username</h4> <br>";
			echo "<h4 class='sub-txt-left' style='font-size:40px;'>$question</h4> <br>";
			echo "<h4 class='sub-txt-left' style='font-size:15px;'>Description - $description</h4>";
			echo "</div>";
			
           
		?>
		
		<?php
			//delete post
			if (isset($_POST["delete"])){
			$query= mysql_query("DELETE FROM post WHERE id = " . $_POST["post_id"]);
			} 
		?>
		
		<?php
			if($user_level == 2)
			{
			echo "<form id='delete'  method='post' action='Single_post.php?post_id=$post_id'>";  
			echo "<input name='post_id' type='hidden' value='$id' />";
			echo " <input type='submit' name='delete' value='Delete Post' />";
			echo "</form>";
			}
		?>
		
		<?php
			//delete comment
			
		?>
		
		<?php
				
			if (isset($_POST["delete_comment"])){
				$query = mysql_query("DELETE FROM comments WHERE id = " . $_POST["comment_id"]);}
		
			$rows = mysql_query("SELECT comments.id, comments.brand_name, comments.varietal, comments.vintage, 
			comments.user_id, comments.comment_likes, users.user_name  FROM comments INNER JOIN users ON 
			comments.user_id = users.user_id WHERE comments.post_id = $post_id;");

                echo "<br><h1 class='sub-txt-left'>COMMENTS</h1></div> </br>";
				echo "</br>";
				echo "</br>";
			
			
			
			for ($i = 0; $i < mysql_numrows($rows); $i++)
			{
				$username = mysql_result($rows, $i,"users.user_name");
				$brand_name = mysql_result($rows, $i,"comments.brand_name");
				$varietal = mysql_result($rows, $i,"comments.varietal");
				$vintage = mysql_result($rows, $i,"comments.vintage");
				$comment_likes = mysql_result($rows, $i,"comments.comment_likes");
				$comment_id = mysql_result($rows, $i,"comments.id");
			
			  if($user_level == 2)
					
					{
						
					echo "<h3 class='sub-txt-left'><strong>$username</strong></h3>";
					echo "<p> $brand_name $varietal $vintage</p>";
					echo "<p><a class='like' href='#' name='btn_upload' onclick='add_like($comment_id);'>LIKE</a> <span id='comment_ $comment_id _likes'>$comment_likes</span> likes</p>";

					
					echo "<form id='delete_comment' name='delete_comment' method='post' action='Single_post.php?post_id=$post_id'>";   
					echo "<input name='post_id' type='hidden' value='$id' />";
					echo " <input type='submit' name='delete_comment' value='Delete Comment'/>";
					echo "</form>";
				
					}
					else if($user_level ==1)
					{
						
					echo "<h3 class='sub-txt-left'><strong>$username</strong></h3>";
					echo "<p> $brand_name $varietal $vintage</p>";
					echo "<p><a class='like' href='#' name='btn_upload' onclick='add_like($comment_id);'>LIKE</a> <span id='comment_ $comment_id _likes'>$comment_likes</span> likes</p>";
					}
					
					echo "</br>";
			} 
			
			


		?>
		</br>
		
			<?php
			if($user_level == 1 OR $user_level == 2)
			{

				echo "<h4 class='sub-txt-left'>Post a comment</h4>";
				echo "<form id='comment' name='comment' method='post' action='Single_post.php?post_id=$post_id'>";
				echo "<label for='brand'>Brand Name</label>";
				echo "<input type='text' id='brand' name='brand'/> </br>";
				echo "<label for='varietals'>Wine Varietal</label>";
				echo "<input type='text' id='varietal' name='varietal'/> </br>";
				echo "<label for='vintage'>Vintage</label>";
				echo "<input type='text' id='vintage' name='vintage'/> </br>";
				echo "<input type='submit' value='Post Comment'/>";
				echo "</form>";
			}
		?>

		<?php
		mysql_close();
		?>

        <script src="js/jquery-1.11.2.js"></script> 
		<script type="text/javascript" src="jquery.js"></script>
        </div>
    </div>
    </body>
</html>