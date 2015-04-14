<?php

/*
|--------------------------------------------------------------------------
| Bicycle management functions file
|--------------------------------------------------------------------------
|
| This file contain all bicycle related functions.
| All functions are used to connect PHP code with database,
| and to query/insert bicycle data from database.
|
*/


/**
 * add_bicycle function is used to add bicycle to the database.
 * 
 * @param $dbc, Database connection param.
 * @param $serialNum, Serial number filed.
 * @param $make, Bicycle make filed.
 * @param $model, Bicycle model filed
 * @param $pic, Bicycle picture filed. (Optional)
 * @param $other, Bicycle description filed. (Optional)
 * @param $userid, User Id filed that connect each Bicycle to a User.
 */
function add_bicycle($dbc, $serialNum, $make, $model, $pic, $other, $userid) {

	// Get UserID from database by using User's NetID
	$query = mysqli_query($dbc, "SELECT UserID FROM User WHERE NetID = '$userid';");
	$row = mysqli_fetch_assoc($query);
	$id = $row['UserID'];

	// Database string handler
	$serialNum = mysqli_real_escape_string($dbc, $serialNum);
	$make = mysqli_real_escape_string($dbc, $make);
	$model = mysqli_real_escape_string($dbc, $model);

	// Check if $other, and $pic is entered
	if (empty($other) == False){
		// other is input
		$other = mysqli_real_escape_string($dbc, $other);
		if (empty($pic) == False){
			// Other and Pic not empty
			$pic = mysqli_real_escape_string($dbc, $pic);
			$result = mysqli_query($dbc,
			"INSERT INTO Bicycle (Serial, Make, Model, Image, Other, Missing, UserID)
			VALUES ('$serialNum', '$make', '$model', '$pic', '$other', '0', '$id');")
			or die ("<br />Couldn't execute query.");
		} else {
			// Other is not empty but pic is
			$result = mysqli_query($dbc,
			"INSERT INTO Bicycle (Serial, Make, Model, Other, Missing, UserID)
			VALUES ('$serialNum', '$make', '$model', '$other', '0', '$id');")
			or die ("<br />Couldn't execute query.");
		}
	} else {
		if (empty($pic) == False){
			// Other is empty but pic is not
			$pic = mysqli_real_escape_string($dbc, $pic);
			$result = mysqli_query($dbc,
			"INSERT INTO Bicycle (Serial, Make, Model, Image, Missing, UserID)
			VALUES ('$serialNum', '$make', '$model', '$pic', '0', '$id');")
			or die ("<br />Couldn't execute query.");
		} else {
			// Other and pic is all empty
			$result = mysqli_query($dbc,
			"INSERT INTO Bicycle (Serial, Make, Model, Missing, UserID)
			VALUES ('$serialNum', '$make', '$model', '0', '$id');")
			or die ("<br />Couldn't execute query.");
		}
	}

	return $result;
}


/**
 * Edit Bicycle picture, replace old link with a new picture link.
 * 
 * @param  $dbc, Database connection param.
 * @param  $bicycleid, Bicycle ID filed.
 * @param  $pic, A new bicycle picture link.
 * 
 * @return Bool, Fail or Success.
 */
function edit_picture($dbc, $bicycleid, $pic)
{
	$pic = mysqli_real_escape_string($dbc, $pic);
	$sql = "UPDATE Bicycle SET Image = '$pic' WHERE BicycleID = '$bicycleid' ";
	$result = mysqli_query($dbc, $sql)or die ("<br />Couldn't execute query.");

	return $result;
}

/**
 * This function delete bicycle information by mark/change serial number to a "DELETED-"
 * 
 * @param  $dbc, Database connection param.
 * @param  $bicycleid, Bicycle ID filed that used to indicate bicycle.
 * 
 * @return Bool, Fail or Success.
 */
function delete_bicycle($dbc, $bicycleid) {
	$query = mysqli_query($dbc, "SELECT Serial, COUNT(*) FROM Bicycle WHERE BicycleID = '$bicycleid';");
	$row = mysqli_fetch_assoc($query);
	$serialNum = $row['Serial'];
	$count = $row['COUNT(*)'];
	$newSerial = 'DELETED-'.($count++).'-'.$serialNum;

	$sql = "UPDATE Bicycle SET `Serial` = '$newSerial'	WHERE `BicycleID` = '$bicycleid' limit 1";
	$result = mysqli_query($dbc, $sql)or die ("<br />Couldn't execute query.");

	return $result;
}


/**
 * This function mark bicycle 'missing' field to '1' which indicate that bicycle is missing.
 * 
 * @param  $dbc, Database connection param.
 * @param  $serialNum, Bicycle serial number.
 * 
 * @return Bool, Fail or Success.
 */
function report_bicycle($dbc, $serialNum) {
	$sql = "UPDATE Bicycle SET Missing = '1' WHERE Serial = '$serialNum' ";
	$result = mysqli_query($dbc, $sql)or die ("<br />Couldn't execute query.");

	return $result;
}

/**
 * This function file the report and record the report detail into database.
 * 
 * @param  $dbc, Database connection param.
 * @param  $date, $time, $loca, $desc, Report detail information.
 * @param  $bikeid, Bicycle ID.
 *
 * @return Bool, Fail or Success.
 */
function report_bicycle_add($dbc, $date, $time, $loca, $desc, $bikeid){

	// Database string handler
	$date = mysqli_real_escape_string($dbc, $date);
	$time = mysqli_real_escape_string($dbc, $time);
	$loca = mysqli_real_escape_string($dbc, $loca);
	$desc = mysqli_real_escape_string($dbc, $desc);

	$result = mysqli_query($dbc,
				"INSERT INTO Report (`Date`, `Time`, `Location`, `Description`, `ReturnLocation`, `BicycleID`)
				 VALUES ('$date', '$time','$loca','$desc','0','$bikeid');")
				or die ("<br />Couldn't execute query.");

	return $result;
}

/**
 * This function is used to check if the serial number that user entered is already in database.
 * 
 * @param  $dbc, Database Connection param.
 * @param  $serialNum, Serial number of bicycle.
 * 
 * @return Int, 0 or 1 indicate the query is Fail or Success.
 */
function bicycle_is_exist($dbc, $serialNum){
	$sql = "SELECT * FROM Bicycle WHERE Serial = '$serialNum' limit 1";
	$query = $dbc -> query($sql);

	$result = $query -> fetch_array();

	if(empty($result)){
		// No Bicycle with this serial in the database
		return 0;
	} else {
		// Bicycle is already in the database
		return 1;
	}
}

?>