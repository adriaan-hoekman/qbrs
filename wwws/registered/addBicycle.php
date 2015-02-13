<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
    include_once '../../lib/bicycle.func.php';
?>

<?php 
    if(isset($_POST['addBicycle']) AND $_POST['addBicycle']) { 
        $pic_name = "../../images/" . $_POST['serial'] . basename($_FILES["pics"]["name"]);
        move_uploaded_file($_FILES["pics"]["tmp_name"], $pic_name);
        $result = add_bicycle($dbc, $_POST['serial'],
                                       $_POST['make'],
                                       $_POST['model'],
                                       $pic_name,
                                       $_POST['other'], 
                                       $_POST['netid']);
        if ($result != false) {
            echo "Success";
        }else{
            echo "Fail";
        }
    }
?>