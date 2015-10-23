<?php
session_start();
include 'connect.php';



echo $_SESSION['user_name'];
/*echo  'Profile of '.$_SESSION['user_name'].'.<br/>
            
     <img src = "http://localhost:8888/PairIt/Pair_It_Website/'.$_SESSION['file_img'].'"/><br/>
            
      First Name: '.$_SESSION['first_name'].'<br/> 
      Last Name: '.$_SESSION['last_name'].'<br/>
      Location: '.$_SESSION['location'].'<br/>
      Email: '.$_SESSION['user_email'].'<br/>
            
     Update profile: <a href="Update_ProfilePage.php">Update</a>
            
            ';
*/


?>

<?php
    mysql_close();
?>