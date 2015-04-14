<?php
  include_once './includes/header.php';
  include_once '../lib/global.conf.php';
  include_once '../lib/reg.func.php';
  include_once '../lib/search.func.php';
  include_once '../lib/report.func.php';
  include_once '../lib/mail.func.php';
?>

<nav>
<h1>Missing Bicycle Report Confirmation</h1>
</nav>

 

<section>

  <h1>SUCCESS!</h1>

  <?php
    // This is the report confirmation page, after the report has been submitted and the email has been successfully sent.
    date_default_timezone_set("America/Toronto");

    $da = date("Y-m-d H:i:s");

    $parkingphone = $_SERVER['parkingphone'];
    $parkingemail = $_SERVER['parkingemail'];
    $securityphone = $_SERVER['securityphone'];
    $securityemail = $_SERVER['securityemail'];
    $kingstonpolicephone = $_SERVER['kingstonpolicephone'];
    $kingstonpoliceemail = $_SERVER['kingstonpoliceemail'];

    $returnmethod = $_GET['returnmethod'];

    switch ($returnmethod) {
    case 'security' :
      $locationmessage = "Campus Security: Phone: ".$securityphone." E-mail: ".$securityemail;
      break;
    case 'parking' :
      $locationmessage = "Campus Parking: Phone: ".$parkingphone." E-mail: ".$parkingemail;
      break;
    case 'police' :
      $locationmessage = "Kingston Police: Phone: ".$kingstonpolicephone." E-mail: ".$kingstonpoliceemail;
      break;
    case 'directContact' :
      $locationmessage = "Please wait for the owner of the bicycle to contact you via Phone or E-mail.";
      break;
  }
    echo "Please find below the contact details for the return method you have selected:";
    echo "<br />";
    echo "<br />";
    echo $locationmessage;
    echo "<br />";
    echo "<br />";

    
  ?>
 
  <form>
  <input class="btn btn-primary" type="button" value="Continue" onClick="window.location.href='./index.php'">
  </form>

</section>


<?php
  include_once './includes/footer.php';
?>