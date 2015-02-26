<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
?>

<section>
<nav>
<h1>Bicycle Missing Report</h1>
<h2>Please Enter detail information about your missing bicycle</h2>
</nav>

<div class="container">
    <?php
        date_default_timezone_set("America/Toronto");

        $netid = $_SERVER['HTTP_QUEENSU_NETID'];
        $name = $_SERVER['HTTP_COMMON_NAME'];
        $email = $_SERVER['HTTP_QUEENSU_MAIL'];
        $da = date("Y-m-d H:i:s");
    ?>

        <form align="center" action="POST" action="missing-report.php" enctype="multipart/form-data">
        <table align="center">
            <tr><td>Bicycle: </td><td><input name="id" value="<?php echo $_GET['id']; ?>" /></td></tr>
            <tr><td>Date: </td><td><input name="date"></input></td></tr>     
            <tr><td>Time: </td><td><input name="time"></input></td></tr>     
            <tr><td>Location: </td><td><input name="location"></input></td></tr>    
            <tr><td>Description: </td><td><input name="desc"></input></td></tr>
        </table>
        </br>
        <input type="hidden" name="addReport" value="1">
        <button name="submit" value="Submit">Submit</button>
        </form>


</div>
</section>

<?php
	include_once '../includes/footer.php';
?>

<?php
    if(isset($_POST['addReport']) AND $_POST['addReport']) { 
        $result = report_bicycle_add($dbc, $_POST['date'],
                                       $_POST['time'],
                                       $_POST['location'],
                                       $_POST['desc'],
                                       $_POST['id']);
        if ($result != false) {
            $miss = report_bicycle($dbc, $_POST['id']);
            if ($miss != false){
                header('./home.php');
            }else{
                echo "Fail";
            }
        }else{
            echo "Fail";
        }
    }
?>