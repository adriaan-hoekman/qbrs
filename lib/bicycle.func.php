<?php

/**
 * Bicycle modification functions file
 */

function add_bicycle($dbc, $serialNum, $make, $model, $pic, $other, $userid) {
	$result = mysqli_query($dbc,
		"INSERT INTO Bicycle (BicycleID, Serial, Make, Model, Image, Other, Missing, UserID)
		 VALUES ('', '$serialNum, '$make', '$model', '$pic', '$other', '1', '$userid');")
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

?>