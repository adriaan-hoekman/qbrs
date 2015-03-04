<?php

/**
 * Bicycle modification functions file
 */

function add_bicycle($dbc, $serialNum, $make, $model, $pic, $other, $userid) {

	
	//$id = array_values(mysqli_fetch_array(mysqli_query($dbc, "SELECT UserID FROM User WHERE NetID = '$userid'")))[0];
	
	$query = mysqli_query($dbc, "SELECT UserID FROM User WHERE NetID = '$userid';");
	$row = mysqli_fetch_assoc($query);
	$id = $row['UserID'];
	
	
	if (empty($other) == False){
		// other is input
		if (empty($pic) == False){
			// Other and Pic not empty
			$result = mysqli_query($dbc,
			"INSERT INTO Bicycle (Serial, Make, Model, Image, Other, Missing, UserID)
			VALUES ('$serialNum', '$make', '$model', '$pic', '$other', '0', '$id');")
			or die ("<br />Couldn't execute query.");
		}else{
			// Other is not empty but pic is
			$result = mysqli_query($dbc,
			"INSERT INTO Bicycle (Serial, Make, Model, Other, Missing, UserID)
			VALUES ('$serialNum', '$make', '$model', '$other', '0', '$id');")
			or die ("<br />Couldn't execute query.");
		}
	}else{
		if (empty($pic) == False){
			// Other is empty but pic is not
			$result = mysqli_query($dbc,
			"INSERT INTO Bicycle (Serial, Make, Model, Image, Missing, UserID)
			VALUES ('$serialNum', '$make', '$model', '$pic', '0', '$id');")
			or die ("<br />Couldn't execute query.");
		}else{
			// Other and pic is all empty
			$result = mysqli_query($dbc,
			"INSERT INTO Bicycle (Serial, Make, Model, Missing, UserID)
			VALUES ('$serialNum', '$make', '$model', '0', '$id');")
			or die ("<br />Couldn't execute query.");
		}
	}

	// $result = mysqli_query($dbc,
	// 	"INSERT INTO Bicycle (Serial, Make, Model, Image, Other, Missing, UserID)
	// 		VALUES ('$serialNum', '$make', '$model', '$pic', '$other', '0', '$userid');")
	// 	or die ("<br />Couldn't execute query.");
	
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
	$result = mysqli_query($dbc, $sql)or die ("<br />Couldn't execute query.");

	return $result;
}

function report_bicycle_add($dbc, $date, $time, $loca, $desc, $bikeid){
	$result = mysqli_query($dbc,
				"INSERT INTO Report (`Date`, `Time`, `Location`, `Description`, `ReturnLocation`, `BicycleID`)
				 VALUES ('$date', '$time','$loca','$desc','0','$bikeid');")
				or die ("<br />Couldn't execute query.");

	return $result;
}

?>