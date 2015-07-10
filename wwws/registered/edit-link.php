<?php
	include_once '../includes/header.php';
	include_once '../../lib/global.conf.php';
	include_once '../../lib/links.func.php';

// Admin has pressed the add link button
if (isset($_POST['addLink'])) {
	$sql = "INSERT INTO UsefulLink (Description, Url) VALUES ('Empty', 'Empty')";
	mysqli_query($dbc, $sql) or die ("<br />Couldn't execute query.");
	header('Location: ./edit-links.php');
}

// Admin has pressed a delete link button
if (isset($_POST['deleteLink'])) {
	$_POST['deleteLink'] = mysqli_real_escape_string($dbc, $_POST['deleteLink']);
	$sql = "DELETE FROM UsefulLink WHERE LinkID = '".$_POST['deleteLink']."'";
	mysqli_query($dbc, $sql) or die ("<br />Couldn't execute query.");
	header('Location: ./edit-links.php');
}

// Admin has edited a link description
if ($_POST['name'] == 'linkDesc') {
	$_POST['value'] = mysqli_real_escape_string($dbc, $_POST['value']);
	$_POST['pk'] = mysqli_real_escape_string($dbc, $_POST['pk']);
	$sql = "UPDATE UsefulLink SET Description = '".$_POST['value']."' WHERE LinkID = '".$_POST['pk']."'";
	mysqli_query($dbc, $sql) or die ("<br />Couldn't execute query.");
}

// Admin has edited a link url
if ($_POST['name'] == 'linkUrl') {
	$_POST['value'] = mysqli_real_escape_string($dbc, $_POST['value']);
	$_POST['pk'] = mysqli_real_escape_string($dbc, $_POST['pk']);
	$sql = "UPDATE UsefulLink SET Url = '".$_POST['value']."' WHERE LinkID = '".$_POST['pk']."'";
	mysqli_query($dbc, $sql) or die ("<br />Couldn't execute query.");
}

?>