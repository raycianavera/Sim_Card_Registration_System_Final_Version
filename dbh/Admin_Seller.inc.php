<?php
$servername = "us-cdbr-east-05.cleardb.net";
$dbUsername = "bb9fcd6313deff";
$dbpassword = "8c9f15bf";
// name of database
$dbName= "heroku_c1df3a5b9bfc854m";

ini_set ('error_reporting', E_ALL);
ini_set ('display_errors', '1');
error_reporting (E_ALL|E_STRICT);

$db = mysqli_init();
mysqli_options ($db, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);

$db->ssl_set('/etc/mysql/ssl/client-key.pem', '/etc/mysql/ssl/client-cert.pem', '/etc/mysql/ssl/ca-cert.pem', NULL, NULL);
$conn = mysqli_real_connect ($db, $servername, $dbUsername, $dbpassword, $dbName, 3306, NULL, MYSQLI_CLIENT_SSL);
if (!$conn)
{
    die ('Connect error (' . mysqli_connect_errno() . '): ' . mysqli_connect_error() . "\n");
} 
?>