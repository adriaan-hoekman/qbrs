<? php
/*
 * Database Connection info
 * Author: @QCRS Group, CISC 498
 */

// Define Database Connection
define('DB_HOST', '130.15.242.33');
define('DB_PORT', '4444');
define('DB_FILE', '/home/users/qbrsec/www-data/tmp/mysql.sock');
define('DB_USER', 'test');
define('DB_PWD', 'testqbrs');
define('DB_DBNAME', 'qbrs');
define('DB_CHARSET', 'utf8');

// Using MySQL
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_DBNAME,DB_PORT,DB_FILE);
$db_char = DB_CHARSET;
$dbc -> query("SET NAMES utf8");