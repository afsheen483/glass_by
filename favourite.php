<?php
//$id = $_GET['id'];
include_once("global.php");
$id = isset($_POST['id']) ? $_POST['id'] : '';
//$query = "UPDATE `glassbuy_glasses` SET `fvrt`='1',`user_id`='$session_userId'  WHERE `glass_id` = '$id'";
$query = "INSERT INTO `glassbuy_favourites`(`product_id`, `user_id`) VALUES ('$id','$session_userId')";
$fire = mysqli_query($con,$query);
print($id);


?>