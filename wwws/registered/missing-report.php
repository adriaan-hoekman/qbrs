<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
?>

<section>
<nav>
<h3>Bicycle Missing Report</h1>
<h4>Please fill in the following details regarding your missing bicycle</h2>
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
                <!--<tr><td><label class="col-lg-5 control-label">Time: </label></td><td><div class="col-lg-20"><input class="form-control" type="time" name="time"></input></div></td></tr>-->
                <tr><td><label class="col-lg-5 control-label">Location: </label></td><div class="col-lg-15"><td><input class="form-control" name="location" id="location"></input></div></td></tr>
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


    <script>

        var data = [
        {"label" : "John Deutsch University Centre(JDUC)"},
        {"label" : "Queen's Centre, including the Athletics and Recreation Centre (ARC)"},
        {"label" : "Physical and Health Education Centre (PEC)"},
        {"label" : "Dauglas Library"},
        {"label" : "Joseph S. Stauffer Library"},
        {"label" : "Goodes Hall"},
        {"label" : "Dupuis Hall"},
        {"label" : "Beamish-Munro Hall (ILC)"},
        {"label" : "Goodwin Hall"},
        {"label" : "Walter Light Hall"},
        {"label" : "Robert Sutherland Hall"},
        {"label" : "Sir John A. Macdonald Hall"},
        {"label" : "Dunning Hall"},
        {"label" : "Mackintosh-Corry Hall (Mac-Corry)"},
        {"label" : "Ellis Hall"},
        {"label" : "Jean Royce Hall"},
        {"label" : "BioSciences Complex"},
        {"label" : "McArthur Hall"},
        {"label" : "An Clachan"},
        {"label" : "Etherington Hall"},
        {"label" : "Donald Gordon Centre"},
        {"label" : "Waldron Tower"},
        {"label" : "Watts Hall"},
        {"label" : "Ban Righ Hall"},
        {"label" : "Botterell Hall"},
        {"label" : "Gordon Brockington Houses"},
        {"label" : "Jeffery Hall"},
        {"label" : "Kingston Hall"},
        {"label" : "Leggett Hall"},
        {"label" : "Leonard Hall"},
        {"label" : "Morris Hall"},
        {"label" : "Stirling Hall"},
        {"label" : "Watson Hall"},
        {"label" : "Cataraqui Building"},
        {"label" : "Kingston Centre"},
        {"label" : "Kingston Downtown"}
        ];

        $(function() {

            $( "#location" ).autocomplete(
        {
            source:data
        })
});
    </script>

<?php
	include_once '../includes/footer.php';
?>
