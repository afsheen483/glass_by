<?php 
include_once("global.php");
include_once("./includes/core/dbmodel.php");
include_once("./includes/core/session.php");

if($logged==0){
?><script>window.location="./"</script><?php 
}

if($session_role != 'admin'){
?><script>window.location="./"</script><?php     
}


/*get Clients*/
// $getGlasses_sql = "SELECT * FROM `glassBuy_glasses` ORDER BY `created_at` DESC";
$getGlasses_sql = "SELECT * FROM `glassBuy_glasses` WHERE productCategory = 'Glasses' ORDER BY `created_at` DESC";
$getGlasses = getAll($con,$getGlasses_sql);

$glass_id = $_GET['id'];
//dd($glass_id);

if (isset($_POST['submit'])) {
   
    $color_1 = $_POST['color_1'];   
    $color_2 = $_POST['color_2'];   
    $size = $_POST['size'];
    $frame_a_width = $_POST['frame_a_width'];   
    $frame_b_height = $_POST['frame_b_height'];   
    $frame_ed = $_POST['frame_ed'];   
    $frame_db_bridge = $_POST['frame_db_bridge'];   
    $frame_temple_legs = $_POST['frame_temple_legs'];   
    $frame_total_width = $_POST['frame_total_width'];   
    $minimum_pd_p_sph = $_POST['minimum_pd_p_sph'];   
    $minimum_pd_n_sph = $_POST['minimum_pd_n_sph'];  
    $color_code_1 = $_POST['color_code_1'];  
    $color_code_2 = $_POST['color_code_2'];  
    $fileName  =  $_FILES['file']['name'];
    $tempPath  =  $_FILES['file']['tmp_name'];
    $glass_id = getRandomString();
    $uploaddir = 'uploads/';
    if(!is_dir($uploaddir)){
        mkdir($uploaddir);
    }
    $uploadfile = basename($fileName);

    $image_upload_path = $uploaddir.$fileName;

    move_uploaded_file($tempPath, $uploaddir . $fileName);


    $color_3 = $_POST['color_3'];   
    $color_4 = $_POST['color_4'];   
    $s_color_code_1 = $_POST['s_color_code_1'];   
    $s_size = $_POST['s_size'];
    $s_frame_a_width = $_POST['s_frame_a_width'];   
    $s_frame_b_height = $_POST['s_frame_b_height'];   
    $s_frame_ed = $_POST['s_frame_ed'];   
    $s_frame_db_bridge = $_POST['s_frame_db_bridge'];   
    $s_frame_temple_legs = $_POST['s_frame_temple_legs'];   
    $s_frame_total_width = $_POST['s_frame_total_width'];   
    $s_minimum_pd_p_sph = $_POST['s_minimum_pd_p_sph'];   
    $s_minimum_pd_n_sph = $_POST['s_minimum_pd_n_sph'];  
    $s_fileName  =  $_FILES['s_file']['name'];
    $s_tempPath  =  $_FILES['s_file']['tmp_name'];
    $s_glass_id = getRandomString();
    $uploaddir = 'uploads/';
    if(!is_dir($uploaddir)){
        mkdir($uploaddir);
    }
    $uploadfile = basename($s_fileName);

    $s_image_upload_path = $uploaddir.$s_fileName;

    move_uploaded_file($tempPath, $uploaddir . $s_fileName);


    $color_5 = $_POST['color_5'];   
    $color_6 = $_POST['color_6'];   
    $t_color_code_1 = $_POST['t_color_code_1'];   
    $t_size = $_POST['t_size'];
    $t_frame_a_width = $_POST['t_frame_a_width'];   
    $t_frame_b_height = $_POST['t_frame_b_height'];   
    $t_frame_ed = $_POST['t_frame_ed'];   
    $t_frame_db_bridge = $_POST['t_frame_db_bridge'];   
    $t_frame_temple_legs = $_POST['t_frame_temple_legs'];   
    $t_frame_total_width = $_POST['t_frame_total_width'];   
    $t_minimum_pd_p_sph = $_POST['t_minimum_pd_p_sph'];   
    $t_minimum_pd_n_sph = $_POST['t_minimum_pd_n_sph'];  
    $t_fileName  =  $_FILES['t_file']['name'];
    $t_tempPath  =  $_FILES['t_file']['tmp_name'];
    $s_glass_id = getRandomString();
    $uploaddir = 'uploads/';
    if(!is_dir($uploaddir)){
        mkdir($uploaddir);
    }
    $uploadfile = basename($s_fileName);

    $t_image_upload_path = $uploaddir.$t_fileName;

    move_uploaded_file($tempPath, $uploaddir . $t_fileName);

    $query = "INSERT INTO `glassbuy_glass_variations`(`color_code_1`, `color_1`, `color_2`, `size`, `frame_a_width`, `frame_b_height`, `frame_ed`, `frame_db_bridge`, `frame_temple_legs`, `frame_total_width`, `minimum_pd_p_sph`, `minimum_pd_n_sph`,  `file`) VALUES ('$color_code_1','$color_1','$color_2','$size','$frame_a_width','$frame_b_height','$frame_ed','$frame_db_bridge','$frame_temple_legs','$frame_total_width','$minimum_pd_p_sph','$minimum_pd_n_sph','$image_upload_path')";
    $fire = mysqli_query($con,$query) or die(mysqli_error($con));


    $query1 = "INSERT INTO `glassbuy_glass_variations`(`color_code_1`, `color_1`, `color_2`, `size`, `frame_a_width`, `frame_b_height`, `frame_ed`, `frame_db_bridge`, `frame_temple_legs`, `frame_total_width`, `minimum_pd_p_sph`, `minimum_pd_n_sph`, `file`) VALUES ('$s_color_code_1','$color_3','$color_4','$s_size','$s_frame_a_width','$s_frame_b_height','$s_frame_ed','$s_frame_db_bridge','$s_frame_temple_legs','$s_frame_total_width','$s_minimum_pd_p_sph','$s_minimum_pd_n_sph','$s_image_upload_path')";
    $fire1 = mysqli_query($con,$query1) or die(mysqli_error($con));


    $query2 = "INSERT INTO `glassbuy_glass_variations`(`color_code_1`, `color_1`, `color_2`, `size`, `frame_a_width`, `frame_b_height`, `frame_ed`, `frame_db_bridge`, `frame_temple_legs`, `frame_total_width`, `minimum_pd_p_sph`, `minimum_pd_n_sph`,  `file`) VALUES ('$t_color_code_1','$color_5','$color_6','$t_size','$t_frame_a_width','$t_frame_b_height','$t_frame_ed','$t_frame_db_bridge','$t_frame_temple_legs','$t_frame_total_width','$t_minimum_pd_p_sph','$t_minimum_pd_n_sph','$t_image_upload_path')";
    $fire2 = mysqli_query($con,$query2) or die(mysqli_error($con));
    if ($fire || $fire1 || $fire2 ) {
        setFlash("error","Glass variations created Successfully.","alert-success");
            header("Location:admin_variations_view.php");
            exit();
        }else{
            setFlash("error","Something went wrong, Please try again.","alert-danger");
            header("Location:glasses_variation.php");
            exit();
        }
   


}
/*end of get Clients*/
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<?php require("./includes/head.php");?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
</head>
<style>
    li:first-child input[type='radio']{
    -webkit-appearance:none;
    width:15px;
    height:15px;
    border:3px solid black;
    color:black;
    background: black;
    border-radius:50%;
    outline:none;
    margin: 0 13px -3px 0;
    /*box-shadow:0 0 5px 0px #6a706d inset;*/
    }
    li:first-child input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:first-child input[type='radio']:checked:before {
        background:#6a706d;
    }
    li:nth-child(2) input[type='radio'] {
    -webkit-appearance:none;
    width:15px;
    height:15px;
    border:3px solid rgb(74,60,41);
    color:black;
    background: rgb(74,60,41);
    border-radius:50%;
    outline:none;
     margin: 0 13px -3px 0;
    }

    li:nth-child(2) input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:nth-child(2) input[type='radio']:checked:before{
        background:#f1d04d;
    }

    li:nth-child(3) input[type='radio'] {
    -webkit-appearance:none;
    width:15px;
    height:15px;

    border-radius:50%;
    border:3px solid rgb(92,3,35);
    color:black;
    background: rgb(92,3,35);
    outline:none;
    /*box-shadow:0 0 5px 0px #caaf40 inset;*/
    margin: 0 13px -3px 0;
    }

    li:nth-child(3) input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:nth-child(3) input[type='radio']:checked:before{
        background:#caaf40;
    }

    li:nth-child(4) input[type='radio'] {
    -webkit-appearance:none;
    width:15px;
    height:15px;
    border:3px solid #92d04f;
    border-radius:50%;
    outline:none;
    /*box-shadow:0 0 5px 0px #92d04f inset;*/
    margin: 0 13px -3px 0;
    }

    li:nth-child(4) input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:nth-child(4) input[type='radio']:checked:before{
        background:#92d04f;
    }

    li:nth-child(5) input[type='radio'] {
    -webkit-appearance:none;
    width:15px;
    height:15px;
    border:3px solid #7aaf42;
    border-radius:50%;
    outline:none;
    /*box-shadow:0 0 5px 0px #7aaf42 inset;*/
    margin: 0 13px -3px 0;
    }
    li:nth-child(5) input[type='radio']:hover {
        box-shadow:0 0 5px 0px #7aaf42 inset;
    }
    li:nth-child(5) input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:nth-child(5) input[type='radio']:checked:before{
        background:#7aaf42;
    }    

    li:nth-child(6) input[type='radio'] {
    -webkit-appearance:none;
    width:15px;
    height:15px;
    border:3px solid #ed5850;
    border-radius:50%;
    outline:none;
    /*box-shadow:0 0 5px 0px #b70218 inset;*/
    margin: 0 13px -3px 0;
    }

    li:nth-child(6) input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:nth-child(6) input[type='radio']:checked:before{
        background:#ed5850;
    }

    li:nth-child(7) input[type='radio'] {
    -webkit-appearance:none;
    width:15px;
    height:15px;
    border:3px solid #b70218;
    border-radius:50%;
    outline:none;
    /*box-shadow:0 0 5px 0px #b70218 inset;*/
    margin: 0 13px -3px 0;
    }
    li:nth-child(7) input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:nth-child(7) input[type='radio']:checked:before{
        background:#b70218;
    }
    .caret{
        display: none
    }
    #table tr{
                cursor: pointer;transition: all .25s ease-in-out;
            }
            #table tr:hover{background-color: #ddd;}
</style>
<body
class="page-template-default page page-id-317 theme-bb-theme fl-builder woocommerce-account woocommerce-page woocommerce-no-js fl-theme-builder-header fl-theme-builder-footer woo-variation-swatches wvs-theme-bb-theme-child wvs-theme-child-bb-theme wvs-style-squared wvs-attr-behavior-blur wvs-tooltip wvs-css fl-framework-base fl-preset-default fl-full-width fl-scroll-to-top fl-search-active"
itemscope="itemscope"
itemtype="https://schema.org/WebPage"
>
<!-- Google Tag Manager (noscript) -->
<!-- End Google Tag Manager (noscript) -->
<a aria-label="Skip to content" class="fl-screen-reader-text" href="#fl-main-content">Skip to content</a>
<div class="fl-page">
<?php require("./includes/header.php");?>
<div id="fl-main-content" class="fl-page-content" itemprop="mainContentOfPage" role="main">
<div class="fl-content-full container">
<div class="row">
<div class="fl-content col-md-12">
<article class="fl-post post-317 page type-page status-publish hentry" id="fl-post-317" itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
<div class="fl-post-content clearfix" itemprop="text">
<div class="fl-builder-content fl-builder-content-317 fl-builder-content-primary fl-builder-global-templates-locked" data-post-id="317">
<div class="fl-row fl-row-fixed-width fl-row-bg-none fl-node-5ec37624db7df" data-node="5ec37624db7df">
<div class="fl-row-content-wrap">
<div class="fl-row-content fl-row-fixed-width fl-node-content">
<div class="fl-col-group fl-node-5ec37624db690" data-node="5ec37624db690">
<div class="fl-col fl-node-5ec37624db6d6" data-node="5ec37624db6d6">
<div class="fl-col-content fl-node-content">
<div class="fl-module fl-module-separator fl-node-5ec37624db769" data-node="5ec37624db769">
<div class="fl-module-content fl-node-content">
<div class="fl-separator"></div>
</div>
</div>
<div class="fl-module fl-module-pp-heading fl-node-5ec37624db728" data-node="5ec37624db728">
<div class="fl-module-content fl-node-content">
<div class="pp-heading-content">
<div class="pp-heading pp-left">
<h2 class="heading-title">
    <span class="title-text pp-primary-title">My Account</span>
</h2>
</div>
</div>
</div>
</div>
<div class="fl-module fl-module-rich-text fl-node-5ec37624db6e7" data-node="5ec37624db6e7">
<div class="fl-module-content fl-node-content">
<div class="fl-rich-text">
<div>
<div class="woocommerce">
    <?php include('./includes/sidebar.php'); ?>
 <!-- alert section -->
 <?php 
                if(getFlash("error")){
                    ?>
                    <div class="alert <?php echo getFlashType("error"); ?>" role="alert">
                        <div class="alert-text">
                            <?php echo getFlash("error"); removeFlash("error"); ?>
                        </div>
                    </div>
                <?php } ?>
                <!-- end alert section -->
            <div class="woocommerce-MyAccount-content">
                <div class="woocommerce-notices-wrapper"></div>
                <div class="rightSideBox">
                    <a href="./admin_glasses.php" class="btn-link">Glasses</a>
                    <a href="./admin_glass_form.php" class="btn-link">SunGlasses</a>
                    <a href="./add_accessories.php" class="btn-link">Accessories</a>
                </div>
               
               
                <?php if($session_role=="admin"){?>
                <a target="_blank" class="button" href="./export.php?table=glasses&format=excel">Export</a>

                <?php  }?>
                <a href="./admin_variations_view.php" class="button">Glasses Variation</a>

                    <form  method="post" enctype="multipart/form-data" class="data-form">
                <table class="table">
                    <thead>
                        <tr>
                            <input type="text" value="<?php echo $glass_id ?>" name="glass_id" id="glass_id" hidden> 
                            <th>Color Code</th>
                            <td><input type="text" name="color_code_1" id="color_code_1" class="col-4 form-control" >
                            
                            </td>
                            <!-- <th>Overall Information</th>
                            <th>Price</th>
                            <th>Additional Info</th>
                            <th>Pictures</th>
                            <th>Clicks</th> -->
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Color 1</td>
                        <td><select name="color_1"  class="col-4 form-control" id="color_1">
                            <option value="Black">Black</option>
                            <option value="Antique">Antique</option>
                            <option value="Burgundy">Burgundy</option>
                        </select></td>
                        <!-- <td> -->
            <!-- <div class="btn-group dropdown todos" id="todos">
            <button class="btn btn-default dropdown-toggle botn-todos" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Select
            </button>
            <ul class="dropdown-menu ancho-todos" aria-labelledby="dropdownMenu1">
              <li><a href="#" ><input value="Black" name="color_1" type="radio" class="todoss" style="color:black"><span> Black</span></a></li>
              <li><a href="#"><input value="Antique" name="color_1" type="radio" class="enc"> Antique</a></li>
              <li><a href="#"><input value="Burgundy" name="color_1" type="radio" class="enca"> Burgundy</a></li>
            </ul>
          </div> -->
        <!-- </td> -->
                        </tr>
                        <tr><td>Color 2</td>
                        <td>
                        <select name="color_2"  class="col-4 form-control" id="color_2">
                            <option value="Black">Black</option>
                            <option value="Antique">Antique</option>
                            <option value="Burgundy">Burgundy</option>
                        </select>
                            <!-- <div class="btn-group dropdown todos" id="todos">
            <button class="btn btn-default dropdown-toggle botn-todos" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Select
            </button>
            <ul class="dropdown-menu ancho-todos" aria-labelledby="dropdownMenu1">
              <li><a href="#" ><input value="Black" name="color_2" type="radio" class="todoss" style="color:black"><span> Black</span></a></li>
              <li><a href="#"><input value="Antique" name="color_2" type="radio" class="enc"> Antique</a></li>
              <li><a href="#"><input value="Burgundy" name="color_2" type="radio" class="enca"> Burgundy</a></li>
            </ul>
          </div> -->
        </td>
                    </tr>
                        <tr><td>Size</td>
                    <td><select name="size" id="size" class="form-control col-4">
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                    </select></td></tr>
                        <tr><td>Frame A- Width</td><td><input type="text"  class="col-4 form-control" name="frame_a_width" id="frame_a_width" value=""></td></td></tr>
                        <tr><td>Frame B - Height</td><td><input type="text"  class="col-4 form-control" name="frame_b_height" id="frame_b_height" value=""></td></td></tr>
                        <tr><td>Frame ED</td><td><input type="text" name="frame_ed" id="frame_ed" class="col-4 form-control" value=""></td></tr>
                        <tr><td>Frame DB Bridge</td><td><input type="text" name="frame_db_bridge" id="frame_db_bridge" class="col-4 form-control" value=""></td></tr>
                        <tr><td>Frame Temple Legs</td><td><input type="text" name="frame_temple_legs" id="frame_temple_legs"  class="col-4 form-control" value=""></td></tr>
                        <tr><td>Frame Total Width</td><td><input type="text" name="frame_total_width" id="frame_total_width" class="col-4 form-control" value=""></td></tr>
                        <tr><td>Minimum PD: +SPH</td><td><input type="text" name="minimum_pd_p_sph" id="minimum_pd_p_sph" class="col-4 form-control" value=""></td></tr>
                        <tr><td>Minimum PD: -SPH</td><td><input type="text" name="minimum_pd_n_sph" id="minimum_pd_n_sph"  class="col-4 form-control" value=""></td></tr>
                        <tr><td><input type="file" name="file" id="file"></td><td><a href="" class="btn-link">Fitting Box Link</a></td></tr>
                       <input type="text" name="edit_file" id="edit_file" hidden>
                        <?php
                        //  foreach($getGlasses as $glass){ 
                        //    //  dd($glass);
                        //     $glassID = $glass['glass_id'];
                        //     $getGlassPic_sql = "SELECT * FROM `glassBuy_glass_picture` WHERE `glass_id` = '$glassID'";
                        //     $getGlassPictures = getAll($con,$getGlassPic_sql);
                            ?>
                            
                       
                            <!-- <td><?php //echo $glass["price"];?></td> -->
                        

                            <!-- <td><?php
                         //}
                           //  echo ($k+1);
                             ?></td>
                            <td><?php 
                           // echo $glass['title'];
                            ?></td>
                            <td> -->
                                <?php 
                                // echo "<b>Colour</b> : ".$glass['colour']."<br>";
                                // echo "<b>Type</b> : ".$glass['productCategory']."<br>";
                                // echo "<b>Shape</b> : ".$glass['shape']."<br>";
                                // echo "<b>Material</b> : ".$glass['material']."<br>";
                                // echo "<b>Brand</b> : ".$glass['brand']."<br>";
                                // echo "<b>Gender</b> : ".$glass['gender']."<br>";
                                // echo "<b>Available Sizes</b> : ".$glass['available_sizes']."<br>";
                                ?>
                            <!-- </td>
                            <td><?php 
                            //echo $glass['price'];
                            ?></td>
                            <td><?php 
                           // echo $glass['additional_info'];
                            ?></td> -->
                            <!-- <td>Pictures: -->
                                <?php 
                                // foreach($getGlassPictures as $pi => $pic){
                                     ?>
                                    <!-- <br>
                                    <a href="./uploads/<?php 
                                    // echo $pic['name']; 
                                    ?>" target="_blank">
                                        <img src="./uploads/<?php 
                                        // echo $pic['name']; 
                                        ?>" width="60px" height="auto" style="margin-bottom: 10px;">
                                    </a>
                                <?php 
                           // }
                            ?>
                            </td>
                            <td><?php
                            //  echo $glass['clicks'];
                             ?></td>
                            <td>
                                <a class="btn-link" href="./admin_glass_form.php?e=<?php
                                //  echo $glass['glass_id'];
                                 ?>">Edit</a>
                                <form action="./includes/models/glass.php" method="post" class="deleteGlass mt-10">
                                    <input type="hidden" name="glass_id" value="<?php 
                                    // echo $glass['glass_id'];
                                     ?>">
                                    <button type="submit" name="DELETE_GLASS" value="true">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                     //}
                      ?> --> 
                      <!-- <tr>
                          <td><button type="submit" name="submit" class="btn btn-info">Save</button></td>
                      </tr> -->
                      <tr>
                          <td><button type="button" name="submit" class="btn btn-info" id="add_to_cart">Add Variations</button></td>
                      </tr>
                    </tbody>
                </table>
                                </form>
             


                <table class="table data-table" id="table" width="100%">
                  <thead>
                  <tr>
                      <th>ID</th>
                        <th>Color Code 1</th>
                        <th>Color 1</th>
                        <th>Color 2</th>
                        <th>Size</th>
                        <th>Frame A- Width</th>
                        <th>Frame B- Height</th>
                        <th>Frame ED</th>
                        <th>Frame DB Bridge</th>
                        <th>Frame Temple Legs</th>
                        <th>Frame Total Width</th>
                        <th>Minimum PD: +SPH</th>
                        <th>Minimum PD: -SPH</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="add">

                  </tbody>

                </table>
                <button id="saveTicketbtn" type="button" class="btn btn-info">Save Variations</button>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- .fl-post-content -->
</article>

<!-- .fl-post -->
</div>
</div>
</div>
</div>

<!-- .fl-page-content -->
<?php require("./includes/footer.php");?>
</div>
<!-- .fl-page -->
<?php require("./includes/footerjs.php");?>

<script type="text/javascript">
    $(document).ready(function(e){
        // alert("hi");
       // $("table").dataTable();
        $("form.deleteGlass").on('submit',function(e){
            return confirm("Do you want to delete this record?");
        });
        $('.dropdown-menu a').on('click',function() {
                var text = $(this).html();
                //alert(text);
                var htmlText = text;
                $(this).closest('.dropdown').find('.dropdown-toggle').html(htmlText);
            });
    });

    var ti = [];
    var del = 0;
    $('#add_to_cart').click(function(){
       // alert("your clicked");
       var glass_id = $("#glass_id").val();
            var color_code_1 = $('#color_code_1').val();
            var color_1 = $('#color_1').val();
            var color_2 = $('#color_2').val();
            var size = $('#size').val();
            var frame_a_width = $('#frame_a_width').val();
            var frame_b_height = $('#frame_b_height').val();
            var frame_ed = $('#frame_ed').val();
            var frame_db_bridge = $('#frame_db_bridge').val();
            var frame_temple_legs = $('#frame_temple_legs').val();
            var frame_total_width = $('#frame_total_width').val();
            var minimum_pd_p_sph = $('#minimum_pd_p_sph').val();
            var minimum_pd_n_sph = $('#minimum_pd_n_sph').val();
            var file = $('#file').val();

            del++;
          
           
            // alert(margin);
            
                var data = {
                    glass_id:glass_id,
                    color_code_1 : color_code_1,
                    color_1 : color_1,
                    color_2 : color_2,
                    size : size,
                    frame_a_width : frame_a_width,
                    frame_b_height : frame_b_height,
                    frame_ed : frame_ed,
                    frame_db_bridge : frame_db_bridge,
                    frame_temple_legs : frame_temple_legs,
                    frame_total_width : frame_total_width,
                    minimum_pd_p_sph : minimum_pd_p_sph,
                    minimum_pd_n_sph : minimum_pd_n_sph,
                    file : file,    
                    del : del   
                  
                }
                //alert(data)
                addToTicket(data);
                
            

        
        
        
       
    });
    function addToTicket(data){
            ti.push(data)
        var tableBody = $(".add");
        tableBody.html('');
        ti.forEach((item,index)=> {
           
            //console.log(item);
            var markup = '';
            markup = "<tr><td> " + item.glass_id  + " </td><td class='color_code_1'>" + item.color_code_1  + " </td><td class='color_1'> " +item.color_1 + " </td><td class='color_2'> " + item.color_2  + "  </td><td class='size'> " + item.size  +"</td><td class='frame_a_width'> " + item.frame_a_width  +"  </td><td class='frame_b_height'> " + item.frame_b_height +"  </td><td class='frame_ed'> " + item.frame_ed + "  </td><td class='frame_db_bridge'> " + item.frame_db_bridge + "</td><td class='frame_temple_legs'>"+item.frame_temple_legs+"</td><td class='frame_total_width'>"+item.frame_total_width+"</td><td class='minimum_pd_p_sph'>"+item.minimum_pd_p_sph+"</td><td class='minimum_pd_n_sph'>"+item.minimum_pd_n_sph+"</td><td class='file'>"+item.file+"</td><td><a class='edit' href='#'>edit</a>|<a href='#' data-del = "+del+"  class='t_del' data-index='"+index+"'>del</a></td></tr>";
            tableBody.append(markup);
        });   
        $(".t_del").click(function(){
               // alert("del");
                //  var id = $(this).data("del"); 
                var index = $(this).data('index')

                ti.splice(index, 1);
                var th = $(this);
                th.parents('tr').remove();
        
            });
    }
   

    // function addToTicket(data){
    //         var markup  = '';
    //         if (data.color_code_1 != '') {
    //             data.push(data)
    //         }
    //             var tableBody = $(".add");
    //             tableBody.html('');
            
    //         tickets.forEach((item, index)=> {
    //             // console.log('This is item ' + item.first_name);

    //             if (item.color_code_1 != '') {
    //                 markup = "<tr><td> " + item.color_code_1  + " </td><td> " +item.color_1 + " </td><td> " + item.color_2  + "  </td><td> " + item.frame_a_width  +"  </td><td> " + item.frame_b_height +"  </td><td> " + item.frame_ed + "  </td><td> " + item.frame_db_bridge + "</td><td>"+item.frame_db_bridge+"</td><td>"+frame_temple_legs+"</td><td>"+item.frame_total_width+"</td><td>"+item.minimum_pd_p_sph+"</td><td>"+item.minimum_pd_p_sph+"</td><td>"+minimum_pd_n_sph+"</td><td><a>"+file+"</a></td></tr>";
    //         tableBody.append(markup);
    //             }
    //         });    

           
    //     }

    $('#saveTicketbtn').click(function(){
           //console.log(ti);
           var glass_id = $("#glass_id").val();
//alert(glass_id);
            //alert('Clicked');
            //var url = "{{ url('save_variations') }}";
            $.ajax({  
         type:"POST",  
         url:"save_variations.php",  
         dataType: "json",
         async: true,  //for synchronize browser & server side.
         data    : {result:JSON.stringify(ti),glass_id:glass_id},
         cache: false,
         success:function(data){  
            //alert(data);  
            //location.reload();
            
         }  
      }); 
           
            //clearing form
            $('#color_1>option:eq(0)').attr('selected',true);
            $('#color_2>option:eq(0)').attr('selected',true);
            $('#size>option:eq(0)').attr('selected',true);
            $('#glass_id').val('');
            $('#color_code_id').val('');
            $('#frame_a_width').val('');
            $('#frame_b_height').val('');
            $('#frame_ed').val('');
            $('#frame_db_bridge').val('');
            $('#frame_temple_legs').val('');
            $('#frame_total_width').val('');
            $('#minimum_pd_p_sph').val('');
            $('#minimum_pd_n_sph').val('');
            $('#file').val('');
        });
//         $('.edit_doc').click(function() {
//             alert("hi");
//         var row1=$(this).closest('tr').find('td').eq(0).html();
//         var td = $(this).closest('tr').find('td');
// var row1 = td.eq(0).html();
// var row2 = td.eq(1).html();
// var row3 = td.eq(2).html();
// console.log(row1);
// $("#color_1").val( $(this).find('td:nth-child(1)').html() );
//         $("#color_2").val($(this).find('td:nth-child(2)').html());
//         $("#size").val($(this).find('td:nth-child(3)').html());
//         });
$(document).on('click', '.edit', function () {
    //alert("hi");
    edit_row = $(this).closest('tr');
    console.log($(this).closest('tr').find('.color_1').text());
    $("#color_code_1").val($(this).closest('tr').find('.color_code_1').text());
    $("#color_1").val($(this).closest('tr').find('.color_1').text());
    $("#color_2").val($(this).closest('tr').find('.color_2').text());
    $("#size").val($(this).closest('tr').find('.size').text());
    $("#frame_a_width").val($(this).closest('tr').find('.frame_a_width').text());
    $("#frame_b_height").val($(this).closest('tr').find('.frame_b_height').text());
    $("#frame_ed").val($(this).closest('tr').find('.frame_ed').text());
    $("#frame_db_bridge").val($(this).closest('tr').find('.frame_db_bridge').text());
    $("#frame_temple_legs").val($(this).closest('tr').find('.frame_temple_legs').text());
    $("#frame_total_width").val($(this).closest('tr').find('.frame_total_width').text());
    $("#minimum_pd_p_sph").val($(this).closest('tr').find('.minimum_pd_p_sph').text());
    $("#minimum_pd_n_sph").val($(this).closest('tr').find('.minimum_pd_n_sph').text());
    $("#file").val($(this).closest('tr').find('.file').text());
});
  
</script>
</body>
</html>
