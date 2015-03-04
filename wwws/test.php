<HTML>

<HEAD>
</HEAD>

<BODY>
  <form align="center" method="post" action="test.php" enctype="multipart/form-data">
            <table align="center">
                <tr><td>Select Your Bicycle's Image: </td><td><input type="file" name="pics" accept="image/*" /></td></tr>
            </table>
        </br> * is required filed.
            </br>
            <input type="submit" name="submit" value="Submit">
            <input type="hidden" name="add" value="1">
        </form>
</BODY>
</HTML>	
<?php 
  if(isset($_POST["add"]) && $_POST["add"]){
	$uploads_dir = '/home/users/qbrssec/bbSSttHH/GGaaSSpp/wwws/images';
	echo "Temp File: ";
	echo $_FILES["pics"]["tmp_name"];
	echo "File Exists?: ";
	echo file_exists($_FILES['pics']['tmp_name']);
	$name = $_FILES["pics"]["name"];
	echo $name;
    if(copy($_FILES["pics"]["tmp_name"], $uploads_dir. '/' .$name)){ 
        echo("File uploaded successfully. - <br />"); 
    }else{ 
        echo("File was not successfully uploaded<br />" );
		echo $_FILES['pics']['error'];
	}
}
?> 