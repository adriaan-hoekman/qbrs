<?php
  include_once './includes/header.php';
  include_once '../lib/global.conf.php';
  include_once '../lib/reg.func.php';
  include_once '../lib/search.func.php';
  include_once '../lib/report.func.php';
  include_once '../lib/mail.func.php';
?>

<?php
    $serialnumber = $_POST['SerialNumber'];

    date_default_timezone_set("America/Toronto");

    $da = date("Y-m-d H:i:s");
  ?>

<?php
    if(isset($_POST['submitReport']) AND $_POST['submitReport']) {
      $result = nonreg_submit_report($dbc,
                                     $_POST['DateFound'],
                                     $_POST['TimeFound'],
                                     $_POST['LocationFound'],
                                     $_POST['OtherInfo'],
                                     $_POST['ReturnMethod'],
                                     $serialnumber);
        if ($result != false) {
            $emailresult = nonreg_missing_send_mail($dbc,
                                               $_POST['DateFound'],
                                               $_POST['TimeFound'],
                                               $_POST['LocationFound'],
                                               $_POST['OtherInfo'],
                                               $_POST['ReturnMethod'],
                                               $_POST['contactField'],
                                                $serialnumber);
            if ($emailresult != false) {
              header('Location: nonreg-report-confirm.php?returnmethod='.$_POST['ReturnMethod']);
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

  <form class="form-horizontal" METHOD="POST" ACTION="nonreg-missing-report.php">
  <table align="center" cellspacing="100">
    <tr>
      <td style="padding-right: 5px" align="right" width=200px><label>Date Found: </label></td>
      <td><div class="col-lg-20"><input class="form-control" type="date" name="DateFound"></input></div></td>
    </tr>
    <tr>
      <td style="padding-right: 5px" align="right"><label>Time Found: </label></td>
      <td style="padding-top: 5px"><div class="col-lg-20"><input class="form-control" type="time" name="TimeFound"></input></div></td>
    </tr>
    <tr>
      <td style="padding-right: 5px" align="right"><label>Location Found: </label></td>
      <td style="padding-top: 5px"><div class="col-lg-20"><input class="form-control" name="LocationFound"></input></div></td>
    </tr>
    <tr>
      <td style="padding-right: 5px" align="right"><label>Other Information: </label></td>
      <td style="padding-top: 5px"><div class="col-lg-20"><textarea class="form-control" rows="6" cols="25" name="OtherInfo"></textarea></div></td>
    </tr>
    <tr>
      <td style="padding-right: 5px" align="right"><label>Return Method: </label></div></td>
      <td style="padding-top: 5px">
        <div class="col-lg-20"><select class="form-control" name="ReturnMethod" id="ReturnMethod" onchange="DirectContact()">
          <option value="security">Will return to Campus Security</option>
          <option value="parking">Will return to Campus Parking</option>
          <option value="police">Will return to Kingston Police</option>
          <option value="directContact">Contact me directly</option>
        </select></div>
      </td>
    </tr>
    <tr>
      <td align="right" id="contactLabel"style="display: none; padding-right: 5px"><label>Phone Number or Email: </label></td>
      <td style="padding-top: 5px">
        <div class="col-lg-20"><input class="form-control" type="text" name="contactField" id="contactField" style="display: none" /></div>
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

<?php
    if(isset($_POST['submitReport']) AND $_POST['submitReport']) {
      $result = nonreg_submit_report($dbc,
                                     $_POST['DateFound'],
                                     $_POST['TimeFound'],
                                     $_POST['LocationFound'],
                                     $_POST['OtherInfo'],
                                     $_POST['ReturnMethod'],
                                     $serialnumber);
        if ($result != false) {
            $result = nonreg_missing_send_mail($dbc,
                                               $_POST['DateFound'],
                                               $_POST['TimeFound'],
                                               $_POST['LocationFound'],
                                               $_POST['OtherInfo'],
                                               $_POST['ReturnMethod'],
                                               $_POST['contactField'],
                                                $serialnumber);
            if ($result != false) {
              header('Location: nonreg-report-confirm.php');
            }else{
              echo "Fail";
            }
        }
    }
?>

<?php
  include_once './includes/footer.php';
?>
<script type="text/javascript">
function DirectContact(){
    selectedSubject = document.getElementById('ReturnMethod').value;
    if (selectedSubject == 'directContact'){
      document.getElementById('contactField').style.display = 'block';
      document.getElementById('contactLabel').style.display = 'block';
    } else {
      document.getElementById('contactField').style.display = 'none';
      document.getElementById('contactLabel').style.display = 'none';
    }
}
</script>