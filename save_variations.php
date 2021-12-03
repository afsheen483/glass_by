<?php
//$id = $_GET['id'];
include_once("global.php");
// print_r($_POST['ti']);
// $data = explode(",", $_POST['ti']);

// //print_r($data);
// foreach($data as $d){
//     echo $d;
// }
$data    = $_POST["result"];
$glass_id    = $_POST["glass_id"];

$data    = json_decode("$data", true);
foreach($data as $data){

    if($data['file']['name'] != ''){
        $test = explode('.', $data['file']['name']);
        $extension = end($test);    
        $name = rand(100,999).'.'.$extension;
    
        $location = 'uploads/'.$name;
        move_uploaded_file($data['file']['tmp_name'], $location);
    }
    $glass_id = $data['glass_id'];
    $color_code_1 = $data['color_code_1'];
    $color_1 = $data['color_1'];
    $color_2 = $data['color_2'];
    $size = $data['size'];
    $frame_a_width = $data['frame_a_width'];
    $frame_b_height = $data['frame_b_height'];
    $frame_ed = $data['frame_ed'];
    $frame_db_bridge = $data['frame_db_bridge'];
    $frame_temple_legs = $data['frame_temple_legs'];
    $frame_total_width = $data['frame_total_width'];
    $minimum_pd_p_sph = $data['minimum_pd_p_sph'];
    $minimum_pd_n_sph = $data['minimum_pd_n_sph'];
    $image_upload_path = $data['file'];
    $query = "INSERT INTO `glassbuy_glass_variations`(`glass_id`,`color_code_1`, `color_1`, `color_2`, `size`, `frame_a_width`, `frame_b_height`, `frame_ed`, `frame_db_bridge`, `frame_temple_legs`, `frame_total_width`, `minimum_pd_p_sph`, `minimum_pd_n_sph`,  `file`) VALUES ('$glass_id','$color_code_1','$color_1','$color_2','$size','$frame_a_width','$frame_b_height','$frame_ed','$frame_db_bridge','$frame_temple_legs','$frame_total_width','$minimum_pd_p_sph','$minimum_pd_n_sph','$image_upload_path')";
    $fire = mysqli_query($con,$query) or die(mysqli_error($con));

}

//just echo an item in the array// $id = isset($_POST['id']) ? $_POST['id'] : '';
// //$query = "UPDATE `glassbuy_glasses` SET `fvrt`='1',`user_id`='$session_userId'  WHERE `glass_id` = '$id'";
// $query = "INSERT INTO `glassbuy_favourites`(`product_id`, `user_id`) VALUES ('$id','$session_userId')";
// $fire = mysqli_query($con,$query);
// print($id);


?>