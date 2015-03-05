<?php
    include_once './includes/header.php';
    include_once '../lib/global.conf.php';
    include_once '../lib/reg.func.php';
    include_once '../lib/search.func.php';
?>

<?php
$result = search_netid($dbc, "1zj");
$result = mysql_fetch_row($results);
?>

<a href="#" id="username" data-type="text" data-pk="1" data-url="post.php" data-title="Enter username">
<?php
    if (!empty($result[1])) {
         echo $result[1];
    } else {  
         echo "muni";
    }
?></a>

                    <script type="text/javascript">
                        type = "";
                        $('#inline').change(function() {
                            type = $(this).val();
                            console.log((type != "" ? "inline" : "popup"));
                            $.fn.editable.defaults.mode = (type != "" ? "inline" : "popup");
                        });

                        $(document).ready(function() {
                            $.fn.editable.defaults.mode ="inline";
                            $('#username').editable();
                            $('#comments').editable();

                        });
                    </script>

