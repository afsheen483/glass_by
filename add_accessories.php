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
/*end of get Clients*/



// form
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
        $price = $_POST['price'];   
        $cost = $_POST['cost'];   
        $manufacturer = $_POST['manufacturer']; 
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];    
            $folder = "uploads/".$filename;
        $glass_id = getRandomString();
        $query = "INSERT INTO `glassbuy_glasses`(`glass_id`, `title`,`price`, `manufacturer`, `cost`,`productCategory`) VALUES ('$glass_id','$title','$price','$manufacturer','$cost','Accessories')";
        $fire = mysqli_query($con,$query) or die(mysqli_error($con));

        $query1 = "INSERT INTO `glassbuy_glass_picture`(`glass_id`, `name`) VALUES ('$glass_id','$filename')";
        $fire1 = mysqli_query($con,$query1);
        if ($fire) {
            setFlash("error","Glass created Successfully.","alert-success");
				header("Location:admin_accessories_view.php");
				exit();
			}else{
				setFlash("error","Something went wrong, Please try again.","alert-danger");
				header("Location:add_accessories.php");
				exit();
			}
          
}
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

            <div class="woocommerce-MyAccount-content">
                <div class="woocommerce-notices-wrapper"></div>
                <div class="rightSideBox">
                <a href="./admin_glasses.php" class="btn-link">Glasses</a>
                    <a href="./admin_sunglasses.php" class="btn-link">SunGlasses</a>
                    <!-- <a href="./admin_variations_view.php" class="btn-link">Glasses Variation</a> -->
                </div>
               
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
                <?php if($session_role=="admin"){?>
                <a target="_blank" class="button" href="./export.php?table=glasses&format=excel">Export</a>
                <?php  }?>
                <a href="./admin_accessories_view.php" class="button">Accessories</a>

                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <td><input type="text" name="title" class="col-4" placeholder="Enter frame name">
                            
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
                        <tr><td>Price</td>
                        <td><input type="text" placeholder="$" class="col-4" name="price"></td>
                        </tr>
                        <tr><td>Cost</td>
                    <td><input type="text" placeholder="$" class="col-4" name="cost"></td></tr>
                        <tr><td>Manufacturer</td>
                    <td><input type="text" placeholder="Enter manufacturer" class="col-4" name="manufacturer"></td>
                    <tr><td>File</td><td><input type="file" name="image" id=""></td>
</tr>
                </tr>
                        
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
                      <tr>
                          <td><button type="submit" class="btn btn-info" name="submit">Save</button></td>
                      </tr>
                    </tbody>
                </table>
                </form>
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
        $(".table").dataTable();
        $("form.deleteGlass").on('submit',function(e){
            return confirm("Do you want to delete this record?");
        })
    });
</script>
</body>
</html>
