<?php
/*
 * Database Connection info
 * Author: @QBRS Group, CISC 498
 */

// Define Database Connection
//define('DB_HOST', Null);
//define('DB_PORT','4444');
//define('DB_FILE','/home/users/qbrssec/www-data/tmp/mysql.sock');
define('DB_USER','test');
define('DB_PWD','testqbrs');
define('DB_DBNAME','QBRS');

$_SERVER['HTTP_QUEENSU_NETID'] = '1zwj';
$_SERVER['HTTP_COMMON_NAME'] = 'David';
$_SERVER['HTTP_QUEENSU_MAIL'] = 'SharkIng@Shacas.com';

// Using MySQL
$dbc = mysqli_connect('localhost',DB_USER,DB_PWD,DB_DBNAME,Null,Null);
//$link = mysqli_connect(Null,'test','testqbrs','qbrs','4444','/home/users/qbrssec/www-data/tmp/mysql.sock');

?>