<!DOCTYPE html>
<html>

<head>
  <title>Queens Bicycle Registration System</title>
</head>

<body>

  <div class = "container">
    <!-- Nav and Logo Header --> 
    <?php include_once './includes/nav.php';?>

      <div class="jumbotron">
        <h1>YOU LOGGED IN</h1>
        <?php
        echo "Hello ".$_SERVER['HTTP_COMMON_NAME'];
        echo "<br />";
        echo "Your NetID is ".$_SERVER['HTTP_QUEENSU_NETID'];
        echo "<br />";
        echo "Your Email is ".$_SERVER['HTTP_QUEENSU_MAIL'];
        echo "<br />";
        ?>
      </div> <!-- /container -->

</body>

<footer>
  <?php include_once '../../includes/footer.php';?>
</footer>

</html>
