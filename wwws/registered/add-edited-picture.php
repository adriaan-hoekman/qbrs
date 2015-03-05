<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
    include_once '../../lib/bicycle.func.php';
    include_once '../../lib/mail.func.php';
?>

<?php 
    if(isset($_POST['editPicture']) AND $_POST['editPicture']) { 
        if (!file_exists($_FILES['pics']['tmp_name']) || !is_uploaded_file($_FILES['pics']['tmp_name'])){
            $pic_name = NULL;        
        }else{
            $pic_name = "../uploads/" . $_POST['bicycleid'] . basename($_FILES["pics"]["name"]);
            move_uploaded_file($_FILES["pics"]["tmp_name"], $pic_name);        
        } 
        $result = edit_picture($dbc, $_POST['bicycleid'], $pic_name); 
        if ($result != false) {
            header('Location: ./home.php');
        }else{
            echo "Fail";
        }
    }
?>