<html>
<head>
  <title>Queens Bicycle Registration System</title>
</head>
<body>
  <h1>YOU LOGGED IN</h1>
  <?php
    echo "Hello ".$_SERVER['HTTP_COMMON_NAME'].PHP_EOL;
    echo "Your NetID is ".$_SERVER['HTTP_QUEENSU_NETID'].PHP_EOL;
    echo "Your Email is ".$_SERVER['HTTP_QUEENSU_MAIL'].PHP_EOL;
  ?>
	<FORM METHOD="LINK" ACTION="https://login.queensu.ca/idp/logout.jsp?goto=https://webapp.queensu.ca/pps/qbrs/">
  <INPUT TYPE="submit" VALUE="Logout">
  </FORM>
</body>
</html>

<?php
echo "<mm:dwdrfml documentRoot=" . __FILE__ .">";$included_files = get_included_files();foreach ($included_files as $filename) { echo "<mm:IncludeFile path=" . $filename . " />"; } echo "</mm:dwdrfml>";
?>
