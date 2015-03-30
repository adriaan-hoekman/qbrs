<?php
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';

    date_default_timezone_set("America/Toronto");

    $netid = $_SERVER['HTTP_QUEENSU_NETID'];
    $name = $_SERVER['HTTP_COMMON_NAME'];
    $email = $_SERVER['HTTP_QUEENSU_MAIL'];
    $da = date("Y-m-d H:i:s");
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
    $('#cyclist-show a').editable(
    {
        validate: function(value) {
            if (value === null || value === '') {
                return 'Empty values not allowed';
            }
        }
    }
    );
    $('#phoneNumber').editable();
    });

    function editPicture(bicycleid){
        window.location.href = './edit-picture.php?id='+bicycleid;
    }
</script>

<section>
<nav>
<h3 align='center'>CYCLIST</h1>
<h4 align='center'>Welcome <?php echo $_SERVER['HTTP_COMMON_NAME']; ?></h2>
    <?php
        $query = mysqli_query($dbc, "SELECT Phone from User Where NetID = '$netid';");
        $phoneResult = mysqli_fetch_assoc($query);
        $phone = $phoneResult['Phone'];

        echo "</br>Your Phone Number is: <a href='#' id='phoneNumber' data-type='text' data-pk='".$netid."' data-url='edit-bicycle.php'>".$phoneResult['Phone']."</a>";
    ?>
</nav>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Bicycle Delete Confirmation</h4>
                </div>
            
                <div class="modal-body">
                    <p>You are about to delete this bicycle, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>

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
<div id="message"> </div>
    <?php

        // Get Bicycle list from batadase.
        $result = search_netid($dbc, $netid);

        if ($result != false && $result -> num_rows != 0) {
            echo "<div class = 'table-responsive'>";
            echo "<table class='table-responsive' id='cyclist-show' align='center'>";
                echo "<tr>
                        <th id='cyclist-show-th'><div class='hidden-xs'>Image</div></th>
                        <th id='cyclist-show-th'>Serial Number</th>
                        <th id='cyclist-show-th'><div class='hidden-xs'>Make</div></th>
                        <th id='cyclist-show-th'><div class='hidden-xs'>Model</div></th>
                        <th id='cyclist-show-th'>Description</th>
                        <th id='cyclist-show-th'>Missing</th>

                    </tr>";
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                if ($row['Image'] == NULL){
                    echo "<td id='cyclist-show-td'><div class='hidden-xs'><img height='75px' src='../images/default_bicycle.png'></div></td>";
                }else{
                    echo "<td id='cyclist-show-td'><div class='hidden-xs'><img height='75px' src=".$row['Image']."></div></td>";
                }

                    // echo "<td id='cyclist-show-td'>".$row['Serial']."</td>
                    //       <td id='cyclist-show-td'>".$row['Make']."</td>
                    //       <td id='cyclist-show-td'>".$row['Model']."</td>";
                echo "<td id='cyclist-show-td'><a href='#' id='serialNumber' data-type='text' data-pk='".$row['BicycleID']."' data-url='edit-bicycle.php'>".$row['Serial']."</a></td>
											<td id='cyclist-show-td'><div class='hidden-xs'><a href='#' id='bicycleMake' data-type='text' data-pk='".$row['BicycleID']."' data-url='edit-bicycle.php'>".$row['Make']."</a></div></td>
											<td id='cyclist-show-td'><div class='hidden-xs'><a href='#' id='bicycleModel' data-type='text' data-pk='".$row['BicycleID']."' data-url='edit-bicycle.php'>".$row['Model']."</a></div></td>
											<td id='cyclist-show-td'><a href='#' id='bicycleOther' data-type='text' data-pk='".$row['BicycleID']."' data-url='edit-bicycle.php'>".$row['Other']."</a></td>";

                echo "<td id='cyclist-show-td'>

								<input type='checkbox' value=".htmlspecialchars('./missing-report.php?id='.$row['BicycleID'].'&serial='.$row['Serial'])." src=".htmlspecialchars('./edit-bicycle.php?found=1&id='.$row['BicycleID'].'&serial='.$row['Serial'])." name='checket' onClick='location.assign(this.checked?this.value:this.src)' "?><?php if($row['Missing'] != 0){echo 'checked';} ?><?php echo "></input>

								</td>";

									// echo "<td id='cyclist-button-td'>";
									// echo "<div class='hidden-xs'>";
									// echo '<FORM>';
									// echo '<INPUT class="btn btn-danger" TYPE="button" VALUE="Delete" onClick="deleteConfirm('.$row['BicycleID'].')">';
									// echo "</FORM>";
									// echo "</div>";
									// echo "</td>";

                                    echo "<td id='cyclist-button-td'>";
                                    echo "<div class='hidden-xs'>";
                                    ?>
                                    <button class="btn btn-danger" data-href="./delete-bicycle.php?id=<?php echo $row['BicycleID']?>" data-toggle="modal" data-target="#confirm-delete">
                                    Delete
                                    </button>
                                    <?php
                                    echo "</div>";
                                    echo "</td>";
 
                                    echo "<td id='cyclist-button-td'>";
                                    echo "<div class='hidden-xs'>";
                                    ?>
                                    <button class="btn btn-primary" onclick="location.href='./edit-picture.php?id=<?php echo $row['BicycleID']?>'">
                                    Edit Picture
                                    </button>
                                    <?php
                                    echo "</div>";
                                    echo "</td>";                                    

									// echo "<td id='cyclist-button-td'>";
									// echo "<div class='hidden-xs'>";
									// echo '<FORM>';
									// echo '<INPUT class="btn btn-primary" TYPE="button" VALUE="Edit Picture" onClick="parent.location=\'./edit-picture.php?id='.$row['BicycleID'].'\'">';
									// echo "</FORM>";
									// echo "</div>";
									// echo "</td>";

								echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "</br>You do not have any bicycle that registered with system";
        }
    ?>
</div>
</section>
    
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>


<?php
	include_once '../includes/footer.php';
?>