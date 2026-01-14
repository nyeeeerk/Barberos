<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'hrdnwghm_barberos');
define('DB_PASSWORD', 'pawpaw123');
define('DB_NAME', 'hrdnwghm_barberos');
 

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>