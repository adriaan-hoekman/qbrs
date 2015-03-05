<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
?>

<script type="text/javascript">
    type = "";
    $('#inline').change(function() {
        type = $(this).val();
        console.log((type != "" ? "inline" : "popup"));
        $.fn.editable.defaults.mode = (type != "" ? "inline" : "popup");
    });

    $(document).ready(function() {
    $.fn.editable.defaults.mode ="inline";
    $('#cyclist-show a').editable(); 
    });
</script>

<section>
<nav>
<h3 align='center'>CYCLIST HOME PAGE</h1>
<h4 align='center'>Welcome <?php echo $_SERVER['HTTP_COMMON_NAME']; ?></h2>
</nav>

<div class="container" align='center'>
    <button class="btn btn-primary" onclick="location.href='./add-bicycle.php'">Add Bicycle</button>
<?php
    $netid = $_SERVER['HTTP_QUEENSU_NETID'];
    if (is_admin($dbc, $netid) != 0) {
        ?>
        <button class="btn btn-primary" onclick="location.href='./admin.php'">Admin Panel</button>
        <?php
    }
?>

    <?php

        date_default_timezone_set("America/Toronto");

        $netid = $_SERVER['HTTP_QUEENSU_NETID'];
        $name = $_SERVER['HTTP_COMMON_NAME'];
        $email = $_SERVER['HTTP_QUEENSU_MAIL'];
        $da = date("Y-m-d H:i:s");

        // Get Bicycle list from batadase.
        $result = search_netid($dbc, $netid);

        if ($result != false && $result -> num_rows != 0) {
            echo "<table class='table table-striped table-hover' id='cyclist-show' align='center'>";
                echo "<tr>
                        <td id='cyclist-show-td'>Image</td>
                        <td id='cyclist-show-td'>Serial Number</td>
                        <td id='cyclist-show-td'>Make</td>
                        <td id='cyclist-show-td'>Model</td>
                        <td id='cyclist-show-td'>Missing Report</td>
                    </tr>";
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                if ($row['Image'] == NULL){
                    echo "<td id='cyclist-show-td'><img height='75px' src='../images/Queens_logo.png'></td>";
                }else{
                    echo "<td id='cyclist-show-td'><img height='75px' src=".$row['Image']."></td>";
                }

                    // echo "<td id='cyclist-show-td'>".$row['Serial']."</td>
                    //       <td id='cyclist-show-td'>".$row['Make']."</td>
                    //       <td id='cyclist-show-td'>".$row['Model']."</td>";
                echo "<td id='cyclist-show-td'><a href='#' id='serialNumber' data-type='text' data-pk='".$row['BicycleID']."' data-url='edit-bicycle.php'>".$row['Serial']."</a></td>
                           <td id='cyclist-show-td'><a href='#' id='bicycleMake' data-type='text' data-pk='".$row['BicycleID']."' data-url='edit-bicycle.php'>".$row['Make']."</a></td>
                           <td id='cyclist-show-td'><a href='#' id='bicycleModel' data-type='text' data-pk='".$row['BicycleID']."' data-url='edit-bicycle.php'>".$row['Model']."</a></td>";

                echo "<td id='cyclist-show-td'>
                          <input type='checkbox' value=".htmlspecialchars('./missing-report.php?id='.$row['BicycleID'].'&serial='.$row['Serial'])." name='checket' onClick='if (this.checked) {window.location = this.value;}' "?><?php if($row['Missing'] != 0){echo 'checked';} ?><?php echo "></input></td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "</br>You do not have any bicycle that registered with system";
        }
    ?>
</div>
</section>

<?php
	include_once '../includes/footer.php';
?>