
<html>
<head>
  <title>Queens Bicycle Registration System</title>
</head>
<body>
  <h1>This is the main page for the Queens Bicycle Registration System</h1>
  <?php
    echo "Hello World!";
  ?>
  <FORM METHOD="LINK" ACTION="https://webapp.queensu.ca/pps/qbrs/registered">
  <INPUT TYPE="submit" VALUE="Login">
  </FORM>
</body>
</html>

<?php
echo "<mm:dwdrfml documentRoot=" . __FILE__ .">";$included_files = get_included_files();foreach ($included_files as $filename) { echo "<mm:IncludeFile path=" . $filename . " />"; } echo "</mm:dwdrfml>";
?>
