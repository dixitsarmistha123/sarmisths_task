<?php
@session_start();
$v3=$_SESSION["id"];
echo "hello";
var_dump($v3);
require_once('config/db1.php');
$sql="DELETE FROM category where `id`='$v3'";
$res= mysqli_query($con,$sql);
$val1=mysqli_affected_rows($con);
?>