<?php
//$id = $_GET['id'];
include_once("global.php");
$id = isset($_POST['id']) ? $_POST['id'] : '';
//$query = "UPDATE `glassbuy_glasses` SET `fvrt`='1',`user_id`='$session_userId'  WHERE `glass_id` = '$id'";
$query = "DELETE FROM `glassbuy_favourites` WHERE `product_id` = '$id' AND `user_id` = '$session_userId'";
$fire = mysqli_query($con,$query);
print($id);


?>