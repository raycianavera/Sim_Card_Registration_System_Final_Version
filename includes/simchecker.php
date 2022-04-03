<?php
//.inc.php. .inc has nothing to do. just naming purpose
$dbServername = "us-cdbr-east-05.cleardb.net";
$dbUsername = "bb9fcd6313deff"; //this will be ONLY change if using server not local
$dbPassword = "8c9f15bf"; //i set a password to nothing . you can put one
$dbName = "heroku_c1df3a5b9bfc854"; //this is where we will put our database name

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword,$dbName) //stands for CONNection
 ?>
