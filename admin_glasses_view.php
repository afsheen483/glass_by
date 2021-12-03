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


// form_save


?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<?php require("./includes/head.php");?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
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
                    <a href="./admin_sunglasses.php" class="btn-link">SunGlasses</a>
                    <a href="./admin_accessories_view.php" class="btn-link">Accessories</a>
                   

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
                <a href="./admin_glasses.php" class="button">Add Glass</a>

                <?php  }?>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <table class="table display responsive nowrap" width="100%">
                   <thead>
                       <tr>
                           <th></th>
                           <th>Title</th>
                           <th>Price</th>
                           <th>Cost</th>
                           <th>Manufacturer</th>
                           <th>MFG Code</th>
                           <th>OLA Product Code</th>
                           <th>Sell In Clinic</th>
                           <th>Features</th>
                           <th>RIM</th>
                           <th>Shape</th>
                           <th>Material</th>
                           <th>Gender</th>
                           <!-- <th>Related Products</th> -->
                           <th>Special Stickers</th>
                           <th>Action</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php  $query = "SELECT * FROM `glassbuy_glasses` WHERE `productCategory` = 'Glasses'";
                                $fire = mysqli_query($con,$query);
                                while ($row = mysqli_fetch_assoc($fire)){
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $row['title']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['cost']; ?></td>
                                        <td><?php echo $row['manufacturer']; ?></td>
                                        <td><?php echo $row['mfg_code']; ?></td>
                                        <td><?php echo $row['originalCode']; ?></td>
                                        <td><?php echo $row['sell_in_clinic']; ?></td>
                                        <td><?php echo $row['feature']; ?></td>
                                        <td><?php echo $row['rim']; ?></td>
                                        <td><?php echo $row['shape']; ?></td>
                                        <td><?php echo $row['material']; ?></td>
                                        <td><?php echo $row['gender']; ?></td>
                                        <td><?php echo $row['strickers']; ?></td>
                                        <td>
                                        <a href="edit_glasses.php?update_id=<?php echo $row['id']?>" class="btn-sm btn-warning"  id="update">Edit Data</a>
                                        <a href="./glasses_variation.php?id=<?php echo $row['glass_id']?>" class="btn-sm btn-warning">Glasses Variation</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                       ?>
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
    $.noConflict();
    $(document).ready(function(e){
       
        
        $(".table").dataTable({
            ordering: false,
            responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [ {
            className: 'control',
            ordering: false,
            targets:   0
        } ],
        });
    });
</script>
</body>
</html>
