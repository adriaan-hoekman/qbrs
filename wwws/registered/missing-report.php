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

        <form align="center" action="POST">
        <table align="center">
            <tr><td>Date: </td><td><input name="date"></input></td></tr>     
            <tr><td>Time: </td><td><input name="time"></input></td></tr>     
            <tr><td>Location: </td><td><input name="location"></input></td></tr>    
            <tr><td>Description: </td><td><input name="desc"></input></td></tr>
        </table>
    </br>
        <button name="submit" value="Submit">Submit</button>
        </form>


</div>
</section>

<?php
	include_once '../includes/footer.php';
?>
