<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';
?>

<section>
<nav>
<h1>CYCLIST HOME PAGE</h1>
<h2>Welcome <?php echo $_SERVER['HTTP_COMMON_NAME']; ?></h2>
</nav>

<div class="container">
    <button onclick="location.href='./add-bicycle.php'">Add Bicycle</button>

    <?php

        date_default_timezone_set("America/Toronto");

        $netid = $_SERVER['HTTP_QUEENSU_NETID'];
        $name = $_SERVER['HTTP_COMMON_NAME'];
        $email = $_SERVER['HTTP_QUEENSU_MAIL'];
        $da = date("Y-m-d H:i:s");

        // Get Bicycle list from batadase.
        $result = search_netid($dbc, $netid);

        if ($result != false && $result -> num_rows != 0) {
            echo "<table id='cyclist-show' align='center'>";
                echo "<tr>
                        <td id='cyclist-show-td'>Image</td>
                        <td id='cyclist-show-td'>Serial Number</td>
                        <td id='cyclist-show-td'>Make</td>
                        <td id='cyclist-show-td'>Model</td>
                        <td id='cyclist-show-td'>Missing Report</td>
                    </tr>";
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr><td id='cyclist-show-td'><img height='75px' src=".$row['Image']."></td>
                          <td id='cyclist-show-td'>".$row['Serial']."</td>
                          <td id='cyclist-show-td'>".$row['Make']."</td>
                          <td id='cyclist-show-td'>".$row['Model']."</td>
                          <td id='cyclist-show-td'>
                          <input type='checkbox' value=".htmlspecialchars('./missing-report.php?id='.$row['BicycleID'].'&serial='.$row['Serial'])." name='checket' onClick='if (this.checked) {window.location = this.value;}' "?><?php if($row['Missing'] != 0){echo 'checked';} ?><?php echo "></input></td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "You do not have any bicycle that registered with system";
        }
    ?>
</div>
</section>

<?php
	include_once '../includes/footer.php';
?>
