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
    <div class="alert alert-danger hide" role="alert" id="addBicycleError">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    Serial Number, Make and Model cannot be empty. 
    </div>
        <form name="addBicycleForm" class="form-horizontal" align="center" method="post" action="add-bicycle.php" enctype="multipart/form-data">
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
            // $uploads_dir = '/home/users/qbrssec/bbSSttHH/GGaaSSpp/wwws/uploads';
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
            header('Location: ./home.php');
        }else{
            echo "Fails";
        }
    }
?>

<?php
	include_once '../includes/footer.php';
?>

<script type="text/javascript">
$(document).ready(function () {
    // Run this code only when the DOM (all elements) are ready

    $('form[name="addBicycleForm"]').on("submit", function (e) {
        // Find all <form>s with the name "register", and bind a "submit" event handler

        // Find the <input /> element with the name "username"
        var serial = $(this).find('input[name="serial"]');
        var make = $(this).find('input[name="make"]');
        var model = $(this).find('input[name="model"]');
        if ($.trim(serial.val()) === "" || $.trim(make.val()) === "" || $.trim(model.val()) === "") {
            // If its value is empty
            e.preventDefault();    // Stop the form from submitting
            $("#addBicycleError").slideDown(400);    // Show the Alert
        } else {
            e.preventDefault();    // Not needed, just for demonstration
            $("#addBicycleError").slideUp(400, function () {    // Hide the Alert (if visible)
                alert("Would be submitting form");    // Not needed, just for demonstration
            });
        }
    });

    $(".alert").find(".close").on("click", function (e) {
        // Find all elements with the "alert" class, get all descendant elements with the class "close", and bind a "click" event handler
        e.stopPropagation();    // Don't allow the click to bubble up the DOM
        e.preventDefault();    // Don't let any default functionality occur (in case it's a link)
        $(this).closest(".alert").slideUp(400);    // Hide this specific Alert
    });
});
</script>