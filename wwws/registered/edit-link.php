<?php
	include_once '../includes/header.php';
	include_once '../../lib/global.conf.php';
	include_once '../../lib/links.func.php';

if (isset($_POST['addLink'])) {
	$sql = "INSERT INTO UsefulLink (Description, Url) VALUES ('Empty', 'Empty')";
	mysqli_query($dbc, $sql) or die ("<br />Couldn't execute query.");
	header('Location: ./edit-links.php');
}

if (isset($_POST['deleteLink'])) {
	$sql = "DELETE FROM UsefulLink WHERE LinkID = '".$_POST['deleteLink']."'";
	mysqli_query($dbc, $sql) or die ("<br />Couldn't execute query.");
	header('Location: ./edit-links.php');
}

if ($_POST['name'] == 'linkDesc') {
	$sql = "UPDATE UsefulLink SET Description = '".$_POST['value']."' WHERE LinkID = '".$_POST['pk']."'";
	mysqli_query($dbc, $sql) or die ("<br />Couldn't execute query.");
}

if ($_POST['name'] == 'linkUrl') {
	$sql = "UPDATE UsefulLink SET Url = '".$_POST['value']."' WHERE LinkID = '".$_POST['pk']."'";
	mysqli_query($dbc, $sql) or die ("<br />Couldn't execute query.");
}

?>