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
}


?>
