<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
    include_once '../../lib/bicycle.func.php';
    include_once '../../lib/mail.func.php';
?>

<?php
    if(isset($_POST['addReport']) AND $_POST['addReport']) { 
        $mysql_date = date('Y-m-d',strtotime($_POST['date']));
        $mysql_time = date('G:i:s',strtotime($_POST['time']));
        echo $mysql_date;
        echo $mysql_time;
        echo $_POST['location'];
        echo $_POST['desc'];
        echo $_POST['idx'];
        echo $_POST['serialx'];
        $result = report_bicycle_add($dbc, $mysql_date,
                                      $mysql_time,
                                      $_POST['location'],
                                      $_POST['desc'],
                                      $_POST['idx']);
        if ($result != false) {

            $bicycle = search_bicycle_id($dbc, $_POST['idx']);
            $bicycleInfo = mysqli_fetch_assoc($bicycle);

            $miss = report_bicycle($dbc, $_POST['serialx']);
            if ($miss != false){
                missing_send_mail($_SERVER['HTTP_QUEENSU_MAIL'], $_SERVER['HTTP_COMMON_NAME'], $bicycleInfo['Serial'], $bicycleInfo['Make'], $bicycleInfo['Model'], $bicycleInfo['Other'], $mysql_date, $mysql_time, $_POST['location'], $_POST['desc']);
                header('Location: ./home.php');
            }else{
                header('Location: ./missing-report.php?id='.$row['idx'].'&serial='.$row['Serial'].'');
            }
        }else{
                header('Location: ./missing-report.php?id='.$row['idx'].'&serial='.$row['Serial'].'');
        }
    }
?>