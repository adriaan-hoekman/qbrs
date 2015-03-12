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
            // $uploads_dir = '/home/users/qbrssec/bbSSttHH/GGaaSSpp/wwws/uploads';
            $uploads_dir = '../uploads'
            $name = $_FILES["pics"]["name"];
            $pic_name = "../uploads/" . $_POST['bicycleid'] . basename($_FILES["pics"]["name"]);
            copy($_FILES["pics"]["tmp_name"], $uploads_dir. '/' .$_POST['bicycleid'].$name);       
        } 
        $result = edit_picture($dbc, $_POST['bicycleid'], $pic_name); 
        if ($result != false) {
            header('Location: ./home.php');
        }else{
            echo "Fail";
        }
    }