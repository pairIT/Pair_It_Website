<?php
// Check your database config:
	include 'connect.php';
	
?>

<p>Search</p>
<form name="searchform" method="POST" action="search.php">
<input name="search" type="text" size="40" maxlength="50"/>
<input type="submit" name="Submit" value="Search"/>
</form>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//if(!isset($_POST['search'])) {
	// If you ever change the header info do it before ALL html on the page
	//	header("Location:index.php");
	//}
	
	$search_sql = "SELECT * FROM users WHERE user_name LIKE '%".$_POST['search']."%'";
	$search_query = mysql_query($search_sql);
	
	if(mysql_num_rows($search_query)!=0)
	{
		while ($search_rs=mysql_fetch_assoc($search_query))
		{ 
			echo "<a>" . $search_rs['user_name'] . "</a>";	
		}
	} else
	{
		echo "No results found!";
	}
}



?>

<?php
// Don't forget to close the connection
mysql_close();


?>
