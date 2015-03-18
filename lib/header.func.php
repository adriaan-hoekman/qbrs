<?php

function returned_bicycles_count($dbc) {
  $sql = "SELECT count(distinct Bicycle.serial) from Bicycle,Report where Bicycle.bicycleid=Report.bicycleid and Bicycle.missing=0";
  $query = $dbc -> query($sql);
  $row = mysqli_fetch_assoc($query);
  return $row;
}

?>