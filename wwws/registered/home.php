<?php

/*
|--------------------------------------------------------------------------
| Cyclist Home Page. (PHP+HTML)
|--------------------------------------------------------------------------
|
| Cyclist Home Page that show user all their bicycle.
|
*/

    // Include function/config file for feature uses.
    include_once '../includes/header.php';
    include_once '../../lib/global.conf.php';
    include_once '../../lib/reg.func.php';
    include_once '../../lib/search.func.php';

    // Set default time zone to Toronto EST.
    date_default_timezone_set("America/Toronto");

    // Get Account Deatil Header form SSO
    $netid = $_SERVER['HTTP_QUEENSU_NETID'];
    $name = $_SERVER['HTTP_COMMON_NAME'];
    $email = $_SERVER['HTTP_QUEENSU_MAIL'];

    // Get Server Date
    $da = date("Y-m-d H:i:s");
?>


<!-- Custom CSS -->
<style type="text/css">

.img-wrap {    
    position: relative;
    max-width:350px;
}

.img-wrap .icon-wrap,
.img-wrap .glyphicon {
    opacity:0;
    position: absolute;
    top:0;
    right:0;
    bottom:0;
    left:0;
    margin:auto;
    width:15px;
    height:15px;
    transition:all 0.2s ease;
}

.img-wrap .glyphicon {
    opacity:0;
}

.icon-wrap::before {
    font-family: FontAwesome;
    content: 'glyphicon glyphicon-camera';   
    display:block;
}


.img-wrap:hover .icon-wrap,
.img-wrap:hover .glyphicon {
    opacity:1;
}

</style>

<!-- Custom JavaScript -->
<!-- All this JavaScript is used for Inline-Editing --> 
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
    };

</script>

<!-- Page Body -->
<section>
<nav>
    <?php
        $query = mysqli_query($dbc, "SELECT Phone from User Where NetID = '$netid';");
        $phoneResult = mysqli_fetch_assoc($query);
        $phone = $phoneResult['Phone'];

        echo "<h4>Your Phone Number is: <a href='#' id='phoneNumber' data-type='text' data-pk='".$netid."' data-url='edit-bicycle.php'>".$phoneResult['Phone']."</a></h4>";
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
    <button class="btn btn-primary" onclick="location.href='./add-bicycle.php'">
        <span class='glyphicon glyphicon-plus'></span> Add Bicycle
        </button>
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
                        <th id='cyclist-show-th'>Make</th>
                        <th id='cyclist-show-th'><div class='hidden-xs'>Model/Type</div></th>
                        <th id='cyclist-show-th'><div class='hidden-xs'>Description</div></th>
                        <th id='cyclist-show-th'>Missing</th>
                    </tr>";
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                if ($row['Image'] == NULL){
                    echo "<td id='cyclist-show-td'><div class='hidden-xs'><div class='img-wrap'><img id='current_image' onclick='editPicture(".$row['BicycleID'].")' height='75px' src='../images/default_bicycle.png'><span onclick='editPicture(".$row['BicycleID'].")' class='glyphicon glyphicon-camera'></span></div></div></td>";
                }else{
                    echo "<td id='cyclist-show-td'><div class='hidden-xs'><div class='img-wrap'><img id='current_image' onclick='editPicture(".$row['BicycleID'].")' height='75px' src=".$row['Image']."><span onclick='editPicture(".$row['BicycleID'].")' class='glyphicon glyphicon-camera'></span></div></div></td>";
                }

                echo "<td id='cyclist-show-td'><a href='#' id='serialNumber' data-type='text' data-pk='".$row['BicycleID']."' data-url='edit-bicycle.php'>".$row['Serial']."</a></td>
                                            <td id='cyclist-show-td'><a href='#' id='bicycleMake' data-type='text' data-pk='".$row['BicycleID']."' data-url='edit-bicycle.php'>".$row['Make']."</a></td>
                                            <td id='cyclist-show-td'><div class='hidden-xs'><a href='#' id='bicycleModel' data-type='text' data-pk='".$row['BicycleID']."' data-url='edit-bicycle.php'>".$row['Model']."</a></div></td>
                                            <td id='cyclist-show-td'><div class='hidden-xs'><a href='#' id='bicycleOther' data-type='text' data-pk='".$row['BicycleID']."' data-url='edit-bicycle.php'>".$row['Other']."</a></div></td>";

                echo "<td id='cyclist-show-td'>

                                <input type='checkbox' value=".htmlspecialchars('./missing-report.php?id='.$row['BicycleID'].'&serial='.$row['Serial'])." src=".htmlspecialchars('./edit-bicycle.php?found=1&id='.$row['BicycleID'].'&serial='.$row['Serial'])." name='checket' onClick='location.assign(this.checked?this.value:this.src)' "?><?php if($row['Missing'] != 0){echo 'checked';} ?><?php echo "></input>

                                </td>";

                                    echo "<td id='cyclist-button-td'>";
                                    echo "<div class='hidden-xs'>";
                                    ?>
                                    <button class="btn btn-danger" data-href="./delete-bicycle.php?id=<?php echo $row['BicycleID']?>" data-toggle="modal" data-target="#confirm-delete">
                                        <span class='glyphicon glyphicon-remove'></span>
                                    </button>
                                    <?php
                                    echo "</div>";
                                    echo "</td>";

                                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "</br>You do not have any bicycles registered!";
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
    // Include Fotter.
    include_once '../includes/footer.php';
?>