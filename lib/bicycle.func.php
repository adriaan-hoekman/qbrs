<?php

/**
 * Bicycle modification functions file
 */

function add_bicycle($dbc, $serialNum, $make, $model, $pic, $other, $userid) {
	$result = mysqli_query($dbc,
		"INSERT INTO Bicycle (Serial, Make, Model, Image, Other, Missing, UserID)
			VALUES ('$serialNum', '$make', '$model', '$pic', '$other', '0', '$userid');")
		or die ("<br />Couldn't execute query.");
	return $result;
}

function edit_bicycle($dbc, $serialNum, $make, $model, $pic) 
{
	// Edit Bicycle
}

function delete_bicycle($dbc, $serialNum) {
	$sql = "DELETE FROM Bicycle WHERE Serial = '$serialNum' limit 1";
	$query = $dbc -> query($sql);

	$result = $query -> fetch_array();

	if(empty($result)){
		// No User with this net ID in the database
		return 0;
	} else {
		// User is already in the database
		return 1;
	}
}

function report_bicycle($dbc, $serialNum) {
	$sql = "UPDATE Bicycle SET Missing = '1' WHERE Serial = '$serialNum' ";
	$result = mysqli_query($dbc, $sql)or die ("<br />Couldn't execute query report.");

	return $result;
}

function report_bicycle_add($dbc, $date, $time, $loca, $desc, $bikeid){
	$result = mysqli_query($dbc, "INSERT INTO Report (`Date`, `Time`, `Location`, `Description`, `Return`, `BicycleID`) 
				VALUES ('$date', '$time','$loca','$desc','0','$bikeid');")
				or die ("<br />Couldn't execute query add.");

	return $result;
}

?>