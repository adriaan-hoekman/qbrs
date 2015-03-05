<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
?>

<section>
<nav>
<h3>Bicycle Missing Report</h1>
<h4>Please Enter detail information about your missing bicycle</h2>
</nav>

<div class="container">
    <?php
        date_default_timezone_set("America/Toronto");

        $netid = $_SERVER['HTTP_QUEENSU_NETID'];
        $name = $_SERVER['HTTP_COMMON_NAME'];
        $email = $_SERVER['HTTP_QUEENSU_MAIL'];
        $da = date("Y-m-d H:i:s");
    ?>

        <form class="form-horizontal" align="center" method="POST" action="add-report.php" enctype="multipart/form-data">
            <table align="center">
                <tr><td><label class="col-lg-5 control-label">Bicycle: </label></td><td><div class="col-lg-20"><input class="form-control" name="id" value="<?php echo $_GET['serial']; ?>" disabled/></div></td></tr>
                <tr><td><label class="col-lg-5 control-label">Date: </label></td><td><div class="col-lg-20"><input class="form-control" type="date" name="date"></input></div></td></tr>     
                <tr><td><label class="col-lg-5 control-label">Time: </label></td><td><div class="col-lg-20"><input class="form-control" type="time" name="time"></input></div></td></tr>     
                <tr><td><label class="col-lg-5 control-label">Location: </label></td><div class="col-lg-15"><td><input class="form-control" name="location"></input></div></td></tr>    
                <tr><td><label class="col-lg-5 control-label">Description: </label></td><div class="col-lg-15"><td><textarea class="form-control" name="desc" rows="10" cols=auto></textarea></div></td></tr>
            </table>
            </br>
            <input type="hidden" name="addReport" value="1">
            <input type="hidden" id = "netidx" name="netidx" value="<?php echo $netid; ?>">
            <input type="hidden" id = "idx" name="idx" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" id = "serialx" name="serialx" value="<?php echo $_GET['serial']; ?>">
            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            <input class="btn btn-primary" type="button" value="Cancel" onClick="javascript:window.location='./home.php';">
        </form>


</div>
</section>

<?php
	include_once '../includes/footer.php';
?>
