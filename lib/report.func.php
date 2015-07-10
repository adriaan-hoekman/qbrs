<?php

/**
 * Report functions file that allow user to get and generate report
 */

function nonreg_submit_report($dbc, $date, $time, $location, $description, $returnlocation, $serialnumber) {

  $query = mysqli_query($dbc, "SELECT BicycleID FROM Bicycle WHERE Serial = '$serialnumber';");
  $row = mysqli_fetch_assoc($query);
  $bicycleid = $row['BicycleID'];

  $mysql_date = date('Y-m-d',strtotime($date));
  $mysql_time = date('G:i:s',strtotime($time));
  switch ($returnlocation) {
    case "security" :
      $returnlocationnum = 1;
      break;
    case "parking" :
      $returnlocationnum = 2;
      break;
    case "police" :
      $returnlocationnum = 3;
      break;
    case "directContact" :
      $returnlocationnum = 0;
      break;
  }
  $result = mysqli_query($dbc,
      "INSERT INTO Report (Date, Time, Location, Description, ReturnLocation, BicycleID)
                VALUES ('$mysql_date', '$mysql_time', '$location', '$description' ,'$returnlocationnum', '$bicycleid');")
      or die ("<br />Couldn't execute query.");
  return $result;
}

function no_serial_submit_report($dbc, $date, $time, $location, $description) {

  
  $bicycleid = 0;

  $mysql_date = date('Y-m-d',strtotime($date));
  $mysql_time = date('G:i:s',strtotime($time));
  
  $returnlocationnum = 0;

  $result = mysqli_query($dbc,
      "INSERT INTO Report (Date, Time, Location, Description, ReturnLocation, BicycleID)
                VALUES ('$mysql_date', '$mysql_time', '$location', '$description' ,'$returnlocationnum', '$bicycleid');")
      or die ("<br />Couldn't execute query.");
  return $result;
}
?>