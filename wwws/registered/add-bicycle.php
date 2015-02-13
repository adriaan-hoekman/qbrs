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
        <form align="center" method="post" action="addBicycle.php" enctype="multipart/form-data">
            <table align="center">
                <tr><td>Serial Number: </td><td><input type="text" name="serial"></input></td></tr>     
                <tr><td>Make: </td><td><input type="text" name="make"></input></td></tr>
                <tr><td>Model: </td><td><input type="text" name="model"></input></td></tr> 
                <tr><td>Other: </td><td><textarea name="other" rows="10" cols=auto></textarea></td></tr>
                <tr><td>Select Your Bicycle's Image: </td><td><input type="file" name="pics" accept="image/*" /></td></tr>
            </table>
            </br>
            <input type="submit" name="submit" value="Submit">
            <input type="hidden" name="addBicycle" value="1">
            <input type="hidden" id = "netid" name="netid" value="<?php echo $netid; ?>">
        </form>
</div>
</section>

<?php
	include_once '../includes/footer.php';
?>
