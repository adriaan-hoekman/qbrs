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
        <form class="form-horizontal" align="center" method="post" action="add-edited-picture.php" enctype="multipart/form-data">
            <table align="center">
                <tr><td><label class="col-lg-10 control-label">Select Your Bicycle's Image: </label></td><td><div class="col-lg-10"><input class="form-control" type="file" name="pics" accept="image/*" /></div></td></tr>
            </table>
            </br>
            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            <input type="button" class="btn btn-primary" value="Cancel" onClick="history.go(-1);">
            <input type="hidden" name="editPicture" value="1">
            <input type="hidden" name="bicycleid" value="<?php echo $_GET['id']?>">
        </form>
</div>
<!--</section>-->
