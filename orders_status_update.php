<?php
//$id = $_GET['id'];
include_once("global.php");
$id = isset($_POST['id']) ? $_POST['id'] : '';
$order_status = isset($_POST['order_status']) ? $_POST['order_status'] : '';
//dd($order_status);
//$query = "UPDATE `glassbuy_glasses` SET `fvrt`='1',`user_id`='$session_userId'  WHERE `glass_id` = '$id'";
$query = "UPDATE `glassbuy_order` SET `status`='$order_status' WHERE `id`='$id'";
$fire = mysqli_query($con,$query);
print($id);


?>