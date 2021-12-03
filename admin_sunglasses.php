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
$getGlasses_sql = "SELECT * FROM `glassBuy_glasses` WHERE productCategory = 'SunGlasses' ORDER BY `created_at` DESC";
$getGlasses = getAll($con,$getGlasses_sql);
/*end of get Clients*/


// form_save

    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $price = $_POST['price'];   
        $cost = $_POST['cost'];   
        $manufacturer = $_POST['manufacturer'];   
        $mfg_code = $_POST['mfg_code'];   
        $product_code = $_POST['product_code'];   
        $sell_in_clinic = $_POST['sell_in_clinic'];   
        $features = $_POST['features'];   
        $rim = $_POST['rim'];   
        $shape = $_POST['shape'];   
        $material = $_POST['material'];   
        $gender = $_POST['gender'];  
        $sticker = $_POST['sticker'];  
        $glass_id = getRandomString();

        $query = "INSERT INTO `glassbuy_glasses`(`glass_id`, `title`, `sell_in_clinic`, `shape`, `material`, `gender`, `price`, `manufacturer`, `mfg_code`,`originalCode`,`rim`, `feature`,`sticker`,`productCategory`) VALUES ('$glass_id','$title','$sell_in_clinic','$shape','$material','$gender','$price','$manufacturer','$mfg_code','$product_code','$rim','$features','$sticker','SunGlasses')";
        $fire = mysqli_query($con,$query) or die(mysqli_error($con));
        if ($fire) {
            setFlash("error","Glass created Successfully.","alert-success");
				header("Location:admin_glasses_view.php");
				exit();
			}else{
				setFlash("error","Something went wrong, Please try again.","alert-danger");
				header("Location:admin_glass.php");
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
                    <a href="./admin_accessories_view.php" class="btn-link">Accessories</a>
                    <!-- <a href="./admin_variations_view.php" class="btn-link">Glasses Variation</a> -->

                </div>
               
              
                <?php if($session_role=="admin"){?>
                <a target="_blank" class="button" href="./export.php?table=glasses&format=excel">Export</a>

                <?php  }?>
                <a href="./admin_sunglasses_view.php" class="button">SunGlasses</a>

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
                    <td><input type="text" placeholder="Enter manufacturer" class="col-4" name="manufacturer"></td></tr>
                        <tr><td>MFG Code</td><td><input type="text" placeholder="Enter MFG Code" class="col-4" name="mfg_code"></td></td></tr>
                        <tr><td>OLA Product Code</td><td><input type="text" placeholder="Enter product code" class="col-4" name="product_code"></td></td></tr>
                        <tr><td>Sell In Clinic</td><td><select name="sell_in_clinic" id="" class="col-4">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select></td></tr>
                        <tr><td>Features</td><td><select name="features" id="" class="col-4">
                            <option value="nose-pad">Nose-Pad</option>
                            <option value="spring_hinge">Spring Hinge</option>
                        </select></td></tr>
                        <tr><td>RIM</td><td><select name="rim" id="" class="col-4">
                            <option value="rimless">Rimless</option>
                            <option value="semi-rim">Semi-Rim</option>
                            <option value="full-rim">Full Rim</option>
                        </select></td></tr>
                        <tr><td>Shape</td><td><select name="shape" id="" class="col-4">
                            <option value="rectangle">Rectangle</option>
                            <option value="round">Round</option>
                            <option value="square">Square</option>
                            <option value="aviator">Aviator</option>
                            <option value="polgon">Polygon</option>
                            <option value="cateye">Cat Eye</option>
                        </select></td></tr>
                        <tr><td>Material</td><td><select name="material" id="" class="col-4">
                            <option value="metal">Metal</option>
                            <option value="titanium">Titanium</option>
                            <option value="plastic">Plastic</option>
                            <option value="plastic_metal">Plastic Metal</option>
                        </select></td></tr>
                        <tr><td>Gender</td><td><input type="radio" name="gender" id="" value="men"><label for="">Men</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" id="" value="women"><label for="">Women</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" id="" value="unisex"><label for="">Unisex</label></td></tr>
                        <tr><td>Related Products</td><td><select name="products" id="" class="col-4">
                           <?php  foreach($getGlasses as $glass){?>
                            <option value="<?php echo $glass['id'] ?>"><?php echo $glass['title']?></option>
                                <?php
                            }?>
                        </select></td></tr>
                        <tr><td>Special Stickers</td><td><select name="sticker" id="" class="col-4">
                            <option value="hot">Hot</option>
                            <option value="new_arrival">New Arrival</option>
                            <option value="top_seller">Top Seller</option>
                        </select></td></tr>
                        
                        <tr>
                       

                            <td> <input type="submit" value="save" name="submit" class="btn btn-success"></td>
                            <td><a href="#" class="btn-link">Add Virtual Try On Link</a></td>
                            
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
