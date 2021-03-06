<?php
  include_once './includes/header.php';
  include_once '../lib/global.conf.php';
  include_once '../lib/reg.func.php';
  include_once '../lib/search.func.php';
  include_once '../lib/report.func.php';
  include_once '../lib/mail.func.php';
?>

<?php
   // This is the report entry page when a user wants to report a bicycle without knowing the serial number of the bicycle 

    date_default_timezone_set("America/Toronto");

    $servertime = date("H:i:s");
  ?>

<?php
    if(isset($_POST['submitReport']) AND $_POST['submitReport']) {
      $result = no_serial_submit_report($dbc,
                                     $_POST['DateFound'],
                                     $servertime,
                                     $_POST['LocationFound'],
                                     $_POST['OtherInfo']);
        if ($result != false) {
            $emailresult = no_serial_missing_send_mail($dbc,
                                               $_POST['DateFound'],
                                               $servertime,
                                               $_POST['LocationFound'],
                                               $_POST['OtherInfo'],
                                               $_POST['contactField']);
            if ($emailresult != false) {
              header('Location: nonreg-report-confirm.php?returnmethod=directContact');
            }else{
              echo "Fail";
            }
        }
    }
?>

<nav>
<h1>Missing Bicycle Report</h1>
<h2>Please enter detailed information about the found bicycle:</h2>
</nav>

<section>

  <form class="form-horizontal" METHOD="POST" ACTION="no-serial-missing-report.php">
  <table align="center" cellspacing="100">
    <tr>
      <td style="padding-right: 5px" align="right" width=200px><label>Date Found: </label></td>
      <td><div class="col-lg-20"><input class="form-control" type="text" name="DateFound" id="DateFound"></input></div></td>
    </tr>
    <!-- <tr>
      <td style="padding-right: 5px" align="right"><label>Time Found: </label></td>
      <td style="padding-top: 5px"><div class="col-lg-20"><input class="form-control" type="time" name="TimeFound"></input></div></td>
    </tr> -->
    <tr>
      <td style="padding-right: 5px" align="right"><label>Location Found: </label></td>
      <td style="padding-top: 5px"><div class="col-lg-20"><input class="form-control" name="LocationFound" id="LocationFound"></input></div></td>
    </tr>
    <tr>
      <td style="padding-right: 5px" align="right"><label>Other Information: </label></td>
      <td style="padding-top: 5px"><div class="col-lg-20"><textarea class="form-control" rows="6" cols="25" name="OtherInfo"></textarea></div></td>
    </tr>
    <tr>
      <td align="right" id="contactLabel"style="padding-right: 5px"><label>Phone Number or Email: </label></td>
      <td style="padding-top: 5px">
        <div class="col-lg-20"><input class="form-control" type="text" name="contactField" id="contactField" /></div>
      </td>
    </tr>
  </table>
  </br>
  <input type="hidden" name="SerialNumber" value="<?php echo htmlspecialchars($serialnumber); ?>">
  <input type="hidden" name="submitReport" value="1">
  <INPUT class="btn btn-primary" type="submit" value="Submit">
  <input class="btn btn-primary" type="button" value="Cancel" onClick="window.location.href='./index.php'">
  </form>

</section>

    <script>

        var data = [
        {"label" : "John Deutsch University Centre(JDUC)"},
        {"label" : "Queen's Centre, including the Athletics and Recreation Centre (ARC)"},
        {"label" : "Physical and Health Education Centre (PEC)"},
        {"label" : "Douglas Library"},
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

          $( "#LocationFound" ).autocomplete(
          {
            source:data
          });

          $( "#DateFound" ).datepicker({maxDate: 0}); 
        });
    </script>

<?php
  include_once './includes/footer.php';
?>