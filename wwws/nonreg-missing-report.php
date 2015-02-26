<?php
  include_once '/includes/header.php';
  include_once '../lib/global.conf.php';
  include_once '../lib/reg.func.php';
  include_once '../lib/search.func.php';
?>

<nav>
  <h1>
    MISSING REPORT
  </h1>
</nav>

<section>
  <?php
  $serialnumber = $_POST['SerialNumber'];
  echo $serialnumber;
  ?>  
</section>


<?php
  include_once './includes/footer.php';
?>
