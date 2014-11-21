<!DOCTYPE html>
<html>

<head>
  	<title>Queens Bicycle Registration System</title>
  	<?php include_once './includes/header,php';?>
</head>

<body>
 	<div class = "container">
 		<!-- Nav and Logo Header --> 
 		<?php include_once './includes/nav.php';?>

	    <div class="jumbotron">
	    <h1> Please Search Your Bicycles </h1>
	    <form method = "post" action="lib/search.func.php" id="searchForm">
	     	<input type "text" name="bicycle">
		<input class="btn btn-lg btn-success" type="submit" name="submit" value ="Search" role="button">
	</form>


	</div> <!-- /container -->

</body>

<footer>

	<?php include_once './includes/footer.php';?>
</footer>

</html>
