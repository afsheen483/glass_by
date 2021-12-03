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


if(isset($_POST['coupon'])){
    $coupon = $_POST['coupon'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $discount = $_POST['discount'];
    $text = $_POST['text'];
    $link = $_POST['link'];
    $color = $_POST['color'];
    if(!isset($_GET['edit'])){
        $id = generateRandomString();
        $sql  = "INSERT INTO glassBuy_coupons set id='$id', coupon='$coupon', discount='$discount', description='$description', status='$status',text='$text',color='$color',link='$link'";
           
            
    }else{
        $id = $_GET['edit'];
        $sql= "update glassBuy_coupons set coupon='$coupon', discount='$discount', description='$description', status='$status',text='$text',color='$color',link='$link' where id='$id'";
    }
    if (!mysqli_query($con, $sql)) {
                echo "account notcreated";
            } 
}
/*get Clients*/
$getGlasses_sql = "SELECT * FROM `glassBuy_coupons`";
$getGlasses = getAll($con,$getGlasses_sql);
/*end of get Clients*/
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<?php require("./includes/head.php");?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

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
                    <!--<a href="./admin_glass_form.php" class="btn-link">Add Glass</a>-->
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
                
                
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-wrap">
                        <?php  
                        $edit = $_GET['edit'];
                        $getGlasses_sql = "SELECT * FROM `glassBuy_coupons` where id='$edit'";
                        $getGlass = getAll($con,$getGlasses_sql)[0];?>
                        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                            <label for="type">Coupon<span class="required">*</span></label>
                            <input class="input-text" name="coupon" value="<?php  echo $getGlass['coupon']?>" id="type" required>
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                            <label for="type">Discount<span class="required">*</span></label>
                            <input class="input-text" name="discount" value="<?php  echo $getGlass['discount']?>" id="type" type="number" min="0" max="100" required>
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-first">
                            <label for="type">Description<span class="required">*</span></label>
                            <input class="input-text" name="description" value="<?php  echo $getGlass['description']?>" id="type" type="text"  required>
                        </p>

                        <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                            <label for="type">Status<span class="required">*</span></label>
                            <select class="input-text" name="status" >
                                <option <?php  if( $getGlass['status']=="active"){echo "selected";}?> >active</option>
                                <option <?php  if( $getGlass['status']=="de-active"){echo "selected";}?> >de-active</option>
                            </select>
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-first">
                            <label for="type">Text<span class="required">*</span></label>
                            <input class="input-text" name="text" value="<?php  echo $getGlass['text']?>" id="type" type="text"  required>
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                            <label for="type">Link<span class="required">*</span></label>
                            <input class="input-text" name="link" value="<?php  echo $getGlass['link']?>" id="type" type="text"  required>
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                            <label for="type">Color<span class="required">*</span></label>
                            <input class="input-text" name="color" value="<?php  echo $getGlass['color']?>" id="type" type="text"  required>
                        </p> 
                        </div>
                        <div >
                        
                            <button class="btn-link" type="submit">Submit</button>
                        
                        </div>
                    </form>
                    
                    <?php  if($session_role=="admin"){?>
                <a target="_blank" class="button" href="./export.php?table=coupons&format=excel" style="margin-top: 1px;">Export</a>
                <?php  }?>
                
                <table class="table">
                    <thead>
                        <tr>
                            
                            <th>Coupon</th>
                            <th>Status</th>
                            <th>Discount</th>
                            <th>Times Used</th>
                            <th>Description</th>
                            <th>Text</th>
                            <th>Link</th>
                            <th>Color</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($getGlasses as $k => $glass){ 
                           
                            ?>
                        <tr>
                            <td><?php echo $glass['coupon'];?></td>
                            <td><?php echo $glass['status'];?></td>

                            <td><?php echo $glass['discount'];?></td>
                            <td><?php echo $glass['timesUsed'];?></td>
                            <td><?php echo $glass['description']?></td>
                            <td><?php echo $glass['text']?></td>
                            <td><?php echo $glass['link']?></td>
                            <td><?php echo $glass['color']?></td>
                           
                            <td>
                                <a class="btn-link" href="?edit=<?php echo $glass['id'];?>">Edit</a>
                                <a class="btn-link" href="?delete=<?php echo $glass['id'];?>">Delete</a>
                                
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
