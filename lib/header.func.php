<?php
// This function calculates the number of bicycles that have been recovered by the system
// This calculation is based on the assumption that any bicycle with a missing report and also is currently not marked as missing
// has been recovered
function returned_bicycles_count($dbc) {
  $sql = "SELECT count(distinct Bicycle.serial) from Bicycle,Report where Bicycle.bicycleid=Report.bicycleid and Bicycle.missing=0";
  $query = $dbc -> query($sql);
  $row = mysqli_fetch_assoc($query);
  return $row;
}

?>