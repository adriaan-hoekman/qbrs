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

        <form align="center" method="POST" action="addReport.php" enctype="multipart/form-data">
            <table align="center">
                <tr><td>Bicycle: </td><td><input name="id" value="<?php echo $_GET['serial']; ?>" /></td></tr>
                <tr><td>Date: </td><td><input name="date"></input></td></tr>     
                <tr><td>Time: </td><td><input name="time"></input></td></tr>     
                <tr><td>Location: </td><td><input name="location"></input></td></tr>    
                <tr><td>Description: </td><td><input name="desc"></input></td></tr>
            </table>
            </br>
            <input type="hidden" name="addReport" value="1">
            <input type="hidden" id = "netidx" name="netidx" value="<?php echo $netid; ?>">
            <input type="hidden" id = "idx" name="idx" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" id = "serialx" name="serialx" value="<?php echo $_GET['serial']; ?>">
            <input type="submit" name="submit" value="Submit">
        </form>


</div>
</section>

<?php
	include_once '../includes/footer.php';
?>

<?php
    if(isset($_POST['addReport']) AND $_POST['addReport']) { 
        $mysql_date = date('Y-m-d',strtotime($_POST['date']));
        $mysql_time = date('G:i:s',strtotime($_POST['time']));
        echo $mysql_date;
        echo $_POST['location'];
        echo $_POST['desc'];
        echo $_POST['idx'];
        echo $_POST['serialx'];
        $result = report_bicycle_add($dbc, $mysql_date,
                                      $mysql_time,
                                      $_POST['location'],
                                      $_POST['desc'],
                                      $_POST['idx']);
        if ($result != false) {
            $miss = report_bicycle($dbc, $_POST['serialx']);
            if ($miss != false){
                header('Location: ./home.php');
            }else{
                echo "Fail";
            }
        }else{
            echo "Fail";
        }
    }
?>