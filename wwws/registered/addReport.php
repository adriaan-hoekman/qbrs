<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
    include_once '../../lib/bicycle.func.php';
?>

<?php
    if(isset($_POST['addReport']) AND $_POST['addReport']) { 
        $mysql_date = date('Y-m-d',strtotime($_POST['date']));
        $mysql_time = date('G:i:s',strtotime($_POST['time']));
        echo $mysql_date;
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
            $miss = report_bicycle($dbc, $_POST['serialx']);
            if ($miss != false){
                header('Location: ./home.php');
            }else{
                header('Location: ./missing-report.php?id='.$row['idx'].'&serial='.$row['Serial'].'');
            }
        }else{
                header('Location: ./missing-report.php?id='.$row['idx'].'&serial='.$row['Serial'].'');
        }
    }
?>