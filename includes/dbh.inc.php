<?php

$servername = "us-cdbr-east-05.cleardb.net";
$dbUsername = "bb9fcd6313deff";
$dbpassword = "8c9f15bf";
// name of database
$dbName= "heroku_c1df3a5b9bfc854";

// CREATE CONNECTION (DATABASE)
$conn = mysqli_connect($servername, $dbUsername,$dbpassword,$dbName);

if(!$conn){
  die("Connection failed:" . mysqli_connect_error());
}
