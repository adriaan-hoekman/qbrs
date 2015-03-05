<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
    include_once '../../lib/bicycle.func.php';
?>

<!--<section>-->
<nav>
<h3 align='center'>Add Bicycle</h3>
<h4 align='center'>Please Add your bicycle information</h4>
</nav>

<div class="container" align='center'>
    <?php
        $netid = $_SERVER['HTTP_QUEENSU_NETID'];
        $name = $_SERVER['HTTP_COMMON_NAME'];
        $email = $_SERVER['HTTP_QUEENSU_MAIL'];
        $da = date("Y-m-d H:i:s");
    ?>
        <form class="form-horizontal" align="center" method="post" action="add-bicycle.php" enctype="multipart/form-data">
            <table align="center">
                <tr><td><label class="col-lg-10 control-label">Serial Number*: </label></td><td><div class="col-lg-10"><input class="form-control" type="text" name="serial"></input></div></td></tr>     
                <tr><td><label class="col-lg-10 control-label">Make*: </label></td><td><div class="col-lg-10"><input class="form-control" type="text" name="make"></input></div></td></tr>
                <tr><td><label class="col-lg-10 control-label">Model*: </label></td><td><div class="col-lg-10"><input class="form-control" type="text" name="model"></input></div></td></tr> 
                <tr><td><label class="col-lg-10 control-label">Other: </label></td><td><div class="col-lg-10"><textarea class="form-control" name="other" rows="10" cols=auto></textarea></div></td></tr>
                <tr><td><label class="col-lg-10 control-label">Select Your Bicycle's Image: </label></td><td><div class="col-lg-10"><input class="form-control" type="file" name="pics" accept="image/*" /></div></td></tr>
            </table>
        </br> * is required filed.
            </br>
            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            <input type="button" class="btn btn-primary" value="Cancel" onClick="history.go(-1);">
            <input type="hidden" name="addBicycle" value="1">
            <input type="hidden" id = "netidx" name="netidx" value="<?php echo $netid; ?>">
        </form>
</div>
<!--</section>-->

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

<?php
	include_once '../includes/footer.php';
?>