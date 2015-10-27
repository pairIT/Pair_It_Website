<?php

		include 'connect.php';
		include 'like.php';
        session_start();
		
		if (isset($_POST['comment_id']) && isset($_SESSION['user_id']) && comment_exists($_POST['comment_id']))
		{
			$comment_id = $_POST['comment_id'];
			
			if (previously_liked($comment_id) == true)
			{
				echo 'You have already liked this';
			} else
			{
				add_like($comment_id);
				echo 'Success';
			}
			
		}
?>

<?php
    mysql_close();
?>
