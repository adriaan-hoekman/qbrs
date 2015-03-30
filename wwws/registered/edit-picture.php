<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
    include_once '../../lib/bicycle.func.php';
    include_once '../../lib/mail.func.php';
?>

<!--<section>-->
<nav>
<h3 align='center'>Edit Your Bicycle Picture </h3>
</nav>

<div class="container" align='center'>
        <div id="message"> </div>
        <form class="form-horizontal" align="center" method="post" action="edit-picture.php" enctype="multipart/form-data">
            <table align="center">
                <tr><td><label class="col-lg-10 control-label">Select Your Bicycle's Image: </label></td><td><div class="col-lg-10"><input class="form-control" type="file" name="pics" accept="image/*" /> * Image CAN'T larger than 1.5M</div></td></tr>
            </table>
            </br>
            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            <input type="button" class="btn btn-primary" value="Cancel" onClick="window.location.href='./home.php'">
            <input type="hidden" name="editPicture" value="1">
            <input type="hidden" name="bicycleid" value="<?php echo $_GET['id']?>">
        </form>
</div>
<!--</section>-->

<?php 
    if(isset($_POST['editPicture']) AND $_POST['editPicture']) { 
        if ($_FILES["pics"]["size"] > 1500000 || $_FILES["pics"]["error"] == 1){
            ?>
            <script type="text/javascript">
            $('#message').html('<div class="alert alert-success fade in"><button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">X</button>The image cannot be larger than 1.5MB. Thank you.</div>');
            window.location.href = './edit-picture.php?id='+<?php echo $_POST['bicycleid']; ?>;
            </script>
            <?php
            exit();
        }

        if (!file_exists($_FILES['pics']['tmp_name']) || !is_uploaded_file($_FILES['pics']['tmp_name'])){
            $pic_name = NULL;        
        }else{
            // This following line for PROD Server
            // -------------------------------------
            // $uploads_dir = '/home/users/qbrssec/bbSSttHH/GGaaSSpp/wwws/uploads';

            // This following line for LocalHost
            // -------------------------------------
            $uploads_dir = '../uploads';
            $name = $_FILES["pics"]["name"];
            $pic_name = "../uploads/" . $_POST['bicycleid'] . basename($_FILES["pics"]["name"]);
            copy($_FILES["pics"]["tmp_name"], $uploads_dir. '/' .$_POST['bicycleid'].$name);       
        } 
        $result = edit_picture($dbc, $_POST['bicycleid'], $pic_name); 
        if ($result != false) {
            header('Location: ./home.php');
        }else{
            echo "Fail";
        }
    }

?>