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

    <table alian="center">
        <form alian="center" action="POST">
            <td>
                <tr>Location: <input name="Serial"></input></br></tr>        
                <tr>Time: <input name="Make"></input></br></tr>
                <button name="submit" value="Submit">Submit</button> 
            </td>
        </form>
    </table>


</div>
</section>

<?php
	include_once '../includes/footer.php';
?>
