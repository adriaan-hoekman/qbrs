<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
    include_once '../../lib/bicycle.func.php';
    include_once '../../lib/mail.func.php';
?>

<?php

if($_POST['name']=='serialNumber'){
    $id=$_POST['pk'];
    $serial=$_POST['value'];
    $sql = "UPDATE Bicycle SET Serial = '". $serial ."' WHERE BicycleID = '$id' ";
	  mysqli_query($dbc, $sql)or die ("<br />Couldn't execute query.");
}

if($_POST['name']=='bicycleMake'){
    $id=$_POST['pk'];
    $make=$_POST['value'];
    $sql = "UPDATE Bicycle SET Make = '". $make ."' WHERE BicycleID = '$id' ";
	  mysqli_query($dbc, $sql)or die ("<br />Couldn't execute query.");
}

if($_POST['name']=='bicycleModel'){
    $id=$_POST['pk'];
    $model=$_POST['value'];
    $sql = "UPDATE Bicycle SET Model = '". $model ."' WHERE BicycleID = '$id' ";
	  mysqli_query($dbc, $sql)or die ("<br />Couldn't execute query.");
}

if($_POST['name']=='bicycleOther'){
    $id=$_POST['pk'];
    $other=$_POST['value'];
    $sql = "UPDATE Bicycle SET Other = '". $other ."' WHERE BicycleID = '$id' ";
      mysqli_query($dbc, $sql)or die ("<br />Couldn't execute query.");
}

if($_POST['name']=='phoneNumber'){
    $id=$_POST['pk'];
    $phone=$_POST['value'];
    $sql = "UPDATE User SET Phone = '". $phone ."' WHERE NetID = '$id' ";
      mysqli_query($dbc, $sql)or die ("<br />Couldn't execute query.");
}

if($_GET['found']=='1'){
    $id=$_GET['id'];
    $sql = "UPDATE Bicycle SET Missing = '0' WHERE BicycleID = '$id' ";
    mysqli_query($dbc, $sql)or die ("<br />Couldn't execute query.");
    header('Location: ./home.php');
}

?>