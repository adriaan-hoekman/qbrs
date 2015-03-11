<?php

/**
 * Report functions file that allow user to get and ganerate report
 */

function get_report($search_item) {
	// Search Report
}

function format_report() {
	// This part we use XML ganerater to formate report information to a XML file
}

function nonreg_submit_report($dbc, $date, $time, $location, $description, $returnlocation, $serialnumber) {
  //$bicycleid = array_values(mysqli_fetch_array($dbc->query("SELECT BicycleID FROM bicycle WHERE Serial = '$serialnumber'")))[0];

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
      "INSERT INTO report (Date, Time, Location, Description, ReturnLocation, BicycleID)
                VALUES ('$date', '$time', '$location', '$description' ,'$returnlocationnum', '$bicycleid');")
      or die ("<br />Couldn't execute query.");
  return $result;
}

?>