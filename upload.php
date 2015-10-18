<?php
// Check your database config:
    $username="root";
    $password="root";
    $database="TestPairIt";
    mysql_connect(localhost,$username,$password);
    @mysql_select_db($database) or die("Database Error");

?>



<form action="upload.php" method="post" enctype="multipart/form-data">
<img src = "photofile/default_profile.jpg" width="70"/>
<input type="file" name="file_img"/> 
<input type="submit" name="btn_upload" value="Upload">
</form>


<?php
if(isset($_POST['btn_upload']))
{
    $check = getimagesize($_FILES["file_img"]["tmp_name"]);

        if($check !== false)
        {
            $filetmp = $_FILES["file_img"]["tmp_name"];//file control name
            $filename = $_FILES["file_img"]["name"];
            $filetype = $_FILES["file_img"]["type"];
            $filepath = "photofile/".$filename; //photofile = name of folder 

            
            move_uploaded_file($filetmp,$filepath);
            $sql = "INSERT INTO uploads (img_name,img_path,img_type)
            VALUES ('$filename','$filepath','$filetype')";
           
            $query = mysql_query($sql);
            
            //echo out the last inserted image
            //$lastid = mysql_insert_id();
            //echo "Image uploaded. <p/>Yourimage:<p/><img src=getImage.php?id=$lastid/>";
            
            $result = mysql_query ("SELECT * FROM uploads");
            $row = mysql_fetch_array($result);
            echo "<img src= '".$row['img_path']."' heigth ='130px'>";
            
            
            
            

        } else {
            echo "File is not an image";
        }
}

?>



<?php
// Don't forget to close the connection
mysql_close();
?>