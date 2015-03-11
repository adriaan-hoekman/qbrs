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
  <?php

    date_default_timezone_set("America/Toronto");

    $da = date("Y-m-d H:i:s");
    
    
  ?>
  <h1>SUCCESS!</h1>

</section>


<?php
  include_once './includes/footer.php';
?>