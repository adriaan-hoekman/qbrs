<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
    include_once '../../lib/bicycle.func.php';
?>

<section>
<nav>
<h1>Add Bicycle</h1>
<h2>Please Add your bicycle information</h2>
</nav>

<div class="container">
    <?php

        date_default_timezone_set("America/Toronto");

        $netid = $_SERVER['HTTP_QUEENSU_NETID'];
        $name = $_SERVER['HTTP_COMMON_NAME'];
        $email = $_SERVER['HTTP_QUEENSU_MAIL'];
        $da = date("Y-m-d H:i:s");
    ?>
        <form align="center" method="post" action="add-bicycle.php" enctype="multipart/form-data">
            <table align="center">
                <tr><td>Serial Number*: </td><td><input type="text" name="serial"></input></td></tr>     
                <tr><td>Make*: </td><td><input type="text" name="make"></input></td></tr>
                <tr><td>Model*: </td><td><input type="text" name="model"></input></td></tr> 
                <tr><td>Other: </td><td><textarea name="other" rows="10" cols=auto></textarea></td></tr>
                <tr><td>Select Your Bicycle's Image: </td><td><input type="file" name="pics" accept="image/*" /></td></tr>
            </table>
        </br> * is required filed.
            </br>
            <input type="submit" name="submit" value="Submit">
            <input type="button" value="Cancel" onClick="history.go(-1);">
            <input type="hidden" name="addBicycle" value="1">
            <input type="hidden" id = "netidx" name="netidx" value="<?php echo $netid; ?>">
        </form>
</div>
</section>

<?php
	include_once '../includes/footer.php';
?>

<?php 
    if(isset($_POST['addBicycle']) AND $_POST['addBicycle']) { 
        if (!file_exists($_FILES['pics']['tmp_name']) || !is_uploaded_file($_FILES['pics']['tmp_name'])){
            $pic_name = NULL;        
        }else{
            $pic_name = "../images/" . $_POST['serial'] . basename($_FILES["pics"]["name"]);
            move_uploaded_file($_FILES["pics"]["tmp_name"], $pic_name);        
        } 

        $result = add_bicycle($dbc, $_POST['serial'],
                                       $_POST['make'],
                                       $_POST['model'],
                                       $pic_name,
                                       $_POST['other'], 
                                       $netid);
        if ($result != false) {
            header('Location: ./home.php');
        }else{
            echo "Fail";
        }
    }
?>