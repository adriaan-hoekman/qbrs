<?php
/*
 * Database Connection info
 * Author: @QCRS Group, CISC 498
 */

// Define Database Connection
//define('DB_HOST', Null);
define('DB_PORT','4444');
define('DB_FILE','/home/users/qbrssec/www-data/tmp/mysql.sock');
define('DB_USER','test');
define('DB_PWD','testqbrs');
define('DB_DBNAME','qbrs');

// Using MySQL
$dbc = mysqli_connect(Null,DB_USER,DB_PWD,DB_DBNAME,DB_PORT,DB_FILE);
//$link = mysqli_connect(Null,'test','testqbrs','qbrs','4444','/home/users/qbrssec/www-data/tmp/mysql.sock');

?>