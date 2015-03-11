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

function edit_picture($dbc, $bicycleid, $pic)
{
	$sql = "UPDATE Bicycle SET Image = '$pic' WHERE BicycleID = '$bicycleid' ";
	$result = mysqli_query($dbc, $sql)or die ("<br />Couldn't execute query.");

	return $result;
}

function delete_bicycle($dbc, $bicycleid) {
	$query = mysqli_query($dbc, "SELECT Serial, COUNT(*) FROM Bicycle WHERE BicycleID = '$bicycleid';");
	$row = mysqli_fetch_assoc($query);
	$serialNum = $row['Serial'];
	$count = $row['COUNT(*)'];
	$newSerial = $serialNum.'-DELETED-'.($count++);

	$sql = "UPDATE Bicycle SET `Serial` = '$newSerial'	WHERE `BicycleID` = '$bicycleid' limit 1";
	$result = mysqli_query($dbc, $sql)or die ("<br />Couldn't execute query.");

	return $result;
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