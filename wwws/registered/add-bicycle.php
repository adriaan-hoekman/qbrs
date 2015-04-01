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
    <div id="message"> </div>
        <form class="form-horizontal" align="center" method="post" action="add-bicycle.php" enctype="multipart/form-data">
            <table align="center">
                <tr><td><label class="col-lg-10 control-label">Serial Number*: </label></td>
                    <td><div class="col-lg-10">
                        <?php
                            if (isset($_POST['serial'])) {
                                echo '<input CLASS="form-control" type="text" name="serial" value="'.$_POST['serial'].'">';
                            } else {
                                echo '<input class="form-control" type="text" name="serial"></input>';
                            }
                        ?>
                    </div></td></tr>
                <tr><td><label class="col-lg-10 control-label">Make*: </label></td>
                    <td><div class="col-lg-10">
                        <?php
                            if (isset($_POST['make'])) {
                                echo '<input CLASS="form-control" type="text" name="make" value="'.$_POST['make'].'">';
                            } else {
                                echo '<input class="form-control" type="text" name="make"></input>';
                            }
                        ?>
                    </div></td></tr>
                <tr><td><label class="col-lg-10 control-label">Model/Type*: </label></td>
                    <td><div class="col-lg-10">
                        <?php
                            if (isset($_POST['model'])) {
                                echo '<input CLASS="form-control" type="text" name="model" value="'.$_POST['model'].'">';
                            } else {
                                echo '<input class="form-control" type="text" name="model"></input>';
                            }
                        ?>
                    </div></td></tr>
                <tr><td><label class="col-lg-10 control-label">Other: </label></td>
                    <td><div class="col-lg-10">
                        <?php
                            if (isset($_POST['other'])) {
                                echo '<textarea class="form-control" name="other" rows="10" cols=auto>'.$_POST['other'].'</textarea>';
                            } else {
                                echo '<textarea class="form-control" name="other" rows="10" cols=auto></textarea>';
                            }
                        ?>
                        
                    </div></td></tr>
                <tr><td><label class="col-lg-10 control-label">Select Your Bicycle's Image: </label></td><td><div class="col-lg-10"><input class="form-control" type="file" name="pics" accept="image/*" /> * Max image size is 1.5MB</div></td></tr>
            </table>
        </br> * denotes a required field.
            </br>
            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            <input type="button" class="btn btn-primary" value="Cancel" onClick="window.location.href='./home.php'">
            <input type="hidden" name="addBicycle" value="1">
            <input type="hidden" id = "netidx" name="netidx" value="<?php echo $netid; ?>">
        </form>
</div>
<!--</section>-->

<?php
    if(isset($_POST['addBicycle']) AND $_POST['addBicycle']) {

        if ($_POST['serial'] == ""){
           ?>
            <script type="text/javascript">
            $('#message').html('<div class="alert alert-success fade in"><button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">X</button>Please enter your Serial Number.</div>');
            </script>
            <?php
            exit();
        }

        if ($_POST['make'] == ""){
           ?>
            <script type="text/javascript">
            $('#message').html('<div class="alert alert-success fade in"><button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">X</button>Please enter the Make of your Bicycle.</div>');
            </script>
            <?php
            exit();
        }

        if ($_POST['model'] == ""){
           ?>
            <script type="text/javascript">
            $('#message').html('<div class="alert alert-success fade in"><button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">X</button>Please enter the Model of your Bicycle.</div>');
            </script>
            <?php
            exit();
        }

        if (bicycle_is_exist($dbc, $_POST['serial']) == 1){
           ?>
            <script type="text/javascript">
            $('#message').html('<div class="alert alert-success fade in"><button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">X</button>This Bicycle (Serial Number) is already in the database. Please contact an Administrator for more details.</div>');
            </script>
            <?php
            bicycle_alread_in_send_mail($dbc, $netid, $_POST['serial']);
            exit();
        }

        if ($_FILES["pics"]["size"] > 1500000 || $_FILES["pics"]["error"] == 1){
           ?>
            <script type="text/javascript">
            $('#message').html('<div class="alert alert-success fade in"><button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">X</button>The image cannot be larger than 1.5MB. Thank you.</div>');
            </script>
            <?php
            exit();
        }

        if (!file_exists($_FILES['pics']['tmp_name']) || !is_uploaded_file($_FILES['pics']['tmp_name'])){
            $pic_name = NULL;
        } else {
            // This following line for PROD Server
            // -------------------------------------
            // $uploads_dir = '/home/users/qbrssec/bbSSttHH/GGaaSSpp/wwws/uploads';

            // This following line for LocalHost
            // -------------------------------------
            $uploads_dir = '../uploads';
            $name = $_FILES["pics"]["name"];
            $pic_name = "../uploads/" . $_POST['serial'] . basename($_FILES["pics"]["name"]);
            copy($_FILES["pics"]["tmp_name"], $uploads_dir. '/' .$_POST['serial'].$name);
        }
        $result = add_bicycle($dbc, $_POST['serial'],
                                    $_POST['make'],
                                    $_POST['model'],
                                    $pic_name,
                                    $_POST['other'],
                                    $netid);
        if ($result != false) {
            // header('Location: ./home.php');
            flush();
            ob_flush();
            session_write_close();
            ?>
                <script language="JavaScript">
                window.location.href = './home.php';
                </script>
            <?php
        } else {
            echo "Fail";
        }
    }
?>

<?php
	include_once '../includes/footer.php';
?>