<?php
  include_once '/includes/header.php';
  include_once '../lib/global.conf.php';
  include_once '../lib/reg.func.php';
  include_once '../lib/search.func.php';
?>

<nav>
<h1>Missing Bicycle Report Confirmation</h1>
<h2>Please enter detailed information about the found bicycle:</h2>
</nav>

<section>
  <?php
    $serialnumber = $_POST['SerialNumber'];
    $bikeModel = $_POST['BicycleModel'];
    $bikeMake = $_POST['BicycleMake'];
    $bikeDateFound = $_POST['DateFound'];
    $bikeTimeFound = $_POST['TimeFound'];
    $bikeLocationFound = $_POST['LocationFound'];
    $bikeOtherInfo = $_POST['OtherInfo'];
    $bikeReturnMethod = $_POST['ReturnMethod'];
    $bikeContactField = $_POST['contactField'];

    // echo $serialnumber;
    // echo $bikeModel;
    // echo $bikeMake;
    // echo $bikeDateFound;
    // echo $bikeTimeFound;
    // echo $bikeLocationFound;
    // echo $bikeOtherInfo;
    // echo $bikeReturnMethod;
    // echo $bikeContactField;

    

    date_default_timezone_set("America/Toronto");

    $da = date("Y-m-d H:i:s");
  ?>
  
</section>


<?php
  include_once './includes/footer.php';
?>