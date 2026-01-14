<?php
require_once('config.php');
$id = $_GET['id'];
$DelSql = "DELETE FROM `booking` WHERE id=$id";
$res = mysqli_query($link, $DelSql);
if($res){
	header('location: view.php');
}else{
	echo "Failed to delete";
}
?>