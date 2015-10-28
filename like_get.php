<?php

		include 'connect.php';
		include 'like.php';
        session_start();
		
		if (isset($_POST['comment_id'], $_SESSION['user_id']) && comment_exists($_POST['comment_id']))
		{
			echo like_count($_POST['comment_id']);
		}

?>

<?php
    mysql_close();
?>