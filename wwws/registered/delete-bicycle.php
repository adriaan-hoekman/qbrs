<?php
/*
|--------------------------------------------------------------------------
| Delete bicycle function file.
|--------------------------------------------------------------------------
|
| This file handle bicycle delete method.
|
*/

    // Include function/config file for feature uses.
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
    include_once '../../lib/bicycle.func.php';
    include_once '../../lib/mail.func.php';
?>

<?php
	$result = delete_bicycle($dbc, $_GET['id']);
    if ($result != false) {
      header('Location: ./home.php');
    }else{
      header('Location: ./home.php');
    }

?>