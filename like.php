<?php


function comment_exists($comment_id)
{
	$comment_id = (int)$comment_id;
	return (mysql_result(mysql_query("SELECT COUNT(id) FROM comments WHERE id = $comment_id"), 0) == 0) ? false : true;
}

function previously_liked($comment_id)
{
	$comment_id = (int)$comment_id;
	return (mysql_result( mysql_query ("SELECT COUNT(id) FROM likes WHERE user_id = ".$_SESSION['user_id']." AND  comment_likes=$comment_id"), 0) ==0) ? false : true;
	
}

function like_count($comment_id)
{
	$comment_id = (int)$comment_id;
	return (int) mysql_result(mysql_query("SELECT comment_likes FROM comments WHERE id=$comment_id"), 0, 'comment_likes');
}

function add_like($comment_id)
{
	$comment_id = (int)$comment_id;
	mysql_query("UPDATE comments SET comment_likes = comment_likes + 1 WHERE id = $comment_id");
	mysql_query("INSERT INTO likes ('user_id','comment_id') VALUES (".$_SESSION['user_id'].", $comment_id )");
    
    $rows = mysql_query("SELECT comments.post_id, comments.user_id, comments.comment_likes, users.user_rep FROM comments INNER JOIN users ON users.user_id = comments.user_id WHERE comments.id = $comment_id;");
    
    $user_id = mysql_result($rows, 0,"comments.user_id");
    $user_rep = mysql_result($rows, 0,"users.user_rep");
    $new_rep = $user_rep + 1;
    
    mysql_query("UPDATE users set user_rep=$new_rep WHERE user_id=$user_id;");
}


?>
