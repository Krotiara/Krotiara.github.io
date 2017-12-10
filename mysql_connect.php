<?php
$db_host = "localhost";
$db_username = 'id3938818_hitcounteradmin';
$db_pass = "12345";
$db_name = "id3938818_hitcounter2";

$con = mysqli_connect("$db_host","$db_username","$db_pass");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
@mysqli_select_db($con,"$db_name");
?>