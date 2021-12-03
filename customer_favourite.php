<?php 
include_once("global.php");

if($logged==0){
?><script>window.location="./"</script><?php 
}

if(isset($_POST['wccp_component_selection'])){
    //   echo "submitted";
    echo "redirecting...";
      $_SESSION['product_id'] = $id;
    $_SESSION['prescript_data1'] = $_POST;
    if(isset($_FILES)){
       
       move_uploaded_file($_FILES['addon-1584107435-upload-your-prescription-14']['tmp_name'], 'uploads/'.$_FILES['addon-1584107435-upload-your-prescription-14']['name']);
    }
    $_SESSION['file1'] = $_FILES;
    
    
    
    //PRESCRIPTION
        $r_sph = $_SESSION['prescript_data1']['addon-1584107435-1-sph-0'];
        $r_cyl = $_SESSION['prescript_data1']['addon-1584107435-1-cyl-1'];
        $r_axis = $_SESSION['prescript_data1']['addon-1584107435-1-axis-2'];
        $r_add = $_SESSION['prescript_data1']['addon-1584107435-1-add-3'];

        $l_sph = $_SESSION['prescript_data1']['addon-1584107435-2-sph-0'];
        $l_cyl = $_SESSION['prescript_data1']['addon-1584107435-2-cyl-1'];
        $l_axis = $_SESSION['prescript_data1']['addon-1584107435-2-axis-2'];
        $l_add = $_SESSION['prescript_data1']['addon-1584107435-2-add-3'];

        $quantity1 = $_SESSION['prescript_data1']['component_1584107435_bundle_quantity_1'];

        $pd = $_SESSION['prescript_data1']['addon-1584107435-pd-2'];
        $my_pd = $_SESSION['prescript_data1']['addon-1584107435-measure-my-pd-5'];

        $prescript = $_SESSION['prescript_data1']['addon-1584107435-save-your-prescription-for-future-11'];
        $lens_type = $_SESSION['lens_type'];

        if(empty($_SESSION['prescript_data2']['addon-1584107435-first-name-12'])){
          $pre_fname = $_SESSION['prescript_data1']['addon-1584107435-first-name-8'];
        }
        else{
          $pre_fname = $_SESSION['prescript_data2']['addon-1584107435-first-name-12'];
        }

        if(empty($_SESSION['prescript_data2']['addon-1584107435-last-name-13'])){
          $pre_lname = $_SESSION['prescript_data1']['addon-1584107435-last-name-9'];
        }
        else{
           $pre_lname = $_SESSION['prescript_data2']['addon-1584107435-last-name-13'];
        }

        if(empty($_SESSION['file2']['addon-1584107435-upload-your-prescription-1']['name'])){
          $pre_file = $_SESSION['file1']['addon-1584107435-upload-your-prescription-14']['name'];
        }
        else{
         $pre_file = $_SESSION['file2']['addon-1584107435-upload-your-prescription-1']['name'];
        }
        

        if(isset($_GET['id']) && ($_GET['id']=="new")){
            $time = $_POST['addon-1584107435-date-of-prescription-12'];
            $last_id = $time;
             $prescription = "INSERT INTO glassBuy_prescription(product_id,order_id,r_sph,r_cyl,r_axis,r_add,l_sph,l_cyl,l_axis,l_add,lens_type,quantity,pd,fname,lname,prescription,file_name, userId, timeAdded) 
             VALUES('$pid','$last_id','$r_sph','$r_cyl','$r_axis','$r_add','$l_sph','$l_cyl','$l_axis','$l_add','$lens_type','$quantity','$pd','$pre_fname','$pre_lname','$prescript','$pre_file', '$session_userId', '$time')";
             $con->query($prescription);
        }else{
            $id = $_GET['id'];
            $prescription = "update glassBuy_prescription set r_sph='$r_sph',r_cyl='$r_cyl',r_axis='$r_axis',r_add='$r_add',l_sph='$l_sph',
            l_cyl='$l_cyl',l_axis='$l_axis',l_add='$l_add',pd='$pd',fname='$pre_fname',lname='$pre_lname',prescription='$prescript'
            ,file_name='$pre_file',timeAdded='$time' where id='$id' ";
             $con->query($prescription);
        }
        
         
         
    
    
    ?>
     <script type="text/javascript">
      window.location="?";
     </script>
    <?php
  }
  
  
if(isset($_GET['delete'])){
    $del = $_GET['delete'];
   
    
        $fvrt = "delete from glassbuy_favourites where id='$del'";
        $con->query($fvrt);
    
         
}


$presId = $_GET['id'];
$query  ="SELECT * from glassBuy_prescription where id='$presId'";
$od = getAll($con, $query);
foreach($od as $row){
    $presDeets = $row;
}
  
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    
<?php  
if(!isset($_GET['print'])){
require("./includes/head.php");
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<style>
    #product-addons-total{
                                                                display:none !important;
                                                            }
</style>
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
<?php if(!isset($_GET['print'])){require("./includes/header.php");}?>
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
    <?php  if(!isset($_GET['print'])){ ?>
<h2 class="heading-title">
    <span class="title-text pp-primary-title">My Account</span>
</h2>
<?php  }?>
</div>
</div>
</div>
</div>
<div class="fl-module fl-module-rich-text fl-node-5ec37624db6e7" data-node="5ec37624db6e7">
<div class="fl-module-content fl-node-content">
<div class="fl-rich-text">
<div>
<div class="woocommerce">
    <?php if(!isset($_GET['print'])){
include('./includes/sidebar.php');} ?>

            <div class="woocommerce-MyAccount-content">
                <div class="woocommerce-notices-wrapper"></div>
                
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
                
                <h3>Favourite</h3>
               
               
                
               
               
                <table class="table">
                    <thead>
                        <tr>
                            <td>Thumbnail</td>
                            <td>Color</td>
                            <td>Size</td>
                            <td>Price</td>
                            <td>Action</td>
                        </tr>
                        <tbody>
                            <?php  
                            $query = "SELECT f.id,f.product_id, g.title,p.name AS image,g.colour,g.shape,g.material,g.gender,g.price,g.available_sizes,g.mfg_code,g.manufacturer  FROM glassbuy_favourites f JOIN glassbuy_glasses g ON g.glass_id = f.product_id JOIN glassbuy_glass_picture p ON p.glass_id = f.product_id WHERE f.user_id = '$session_userId' GROUP BY f.product_id";
                            $fire = mysqli_query($con,$query);
                            while($row = mysqli_fetch_assoc($fire))
                            {
                                ?><tr>
                                    
                                    <td><img src="uploads/<?php  echo $row['image']?>" alt="" width="50px" height="50px"></td>
                                    <td><?php echo $row['colour'] ?></td>
                                    <td><?php echo $row['available_sizes'] ?></td>
                                    <td>$<?php echo $row['price'] ?></td>
                                    <td>
                                       
                                       
                                        <a class="button" href="?details=<?php  echo $row['id']?>&enc=<?php  echo ($row['id'])?>">More Details</a>
                                        <a class="button" href="?delete=<?php  echo $row['id']?>&enc=<?php  echo ($row['id'])?>">Delete</a>
                                    </td>
                                </tr><?php  
                            }?>
                        </tbody>
                    </thead>
                    
                </table>
                
                
                <?php  if(isset($_GET['id'])){?>
                
                <form action="" method="post" enctype="multipart/form-data">

                <div style="" id="component_1584107435" class="composite_component component paged options-style-thumbnails paginate-results multistep autotransition active" data-nav_title="Prescription" data-item_id="1584107435">
                                                            <div id="composite_navigation_394" class="composite_navigation top paged standard">
                                                                <div class="composite_navigation_inner">
                                                                    <!-- <a class="page_button next " href="#lens-type" rel="nofollow" aria-label="Go to Lens Type">Lens Type</a> -->
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="">
                                                                <h2 class="step_title_wrapper component_title">
                                                                    <span class="aria_title" aria-label="Prescription" tabindex="-1">Prescription</span>
                                                                    <!--<span class="component_title_text step_title_text"><span class="step_index">2</span> <span class="step_title">Prescription</span></span>-->
                                                                </h2>
                                                            </div>
                                                        
                                                            <div style="display: block;" id="" class="">
                                                                <div class="component_description_wrapper">
                                                                    <div class="component_description"><p>Insert prescription</p></div>
                                                                </div>
                                                                <div class="">
                                                                    <div class="scroll_show_component_details"></div>
                                                                    <div class="component_message top" style="display: block;">
                                                                        <div class="validation_message woocommerce-info">
                                                                            <ul style="list-style: none;">
                                                                                <li>Please choose an option to continue…</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
																	<!-- first form -->
																	<div method="post" id="first_form">
                                                                    <div data-product_id="1584107435" style="height: auto; display: block;" class="">
                                                                        <div class="component_summary cp_clearfix">
                                                                            <div class="product content summary_content populated bundle_form initialized">
                                                                                <div class="composited_product_title_wrapper" data-show_title="yes" tabindex="-1">
                                                                                    <p class="component_section_title selected_option_label_wrapper">
                                                                                        <label class="selected_option_label">Your selection:</label>
                                                                                    </p>
                                                        
                                                                                    <h4 class="composited_product_title component_section_title product_title">Enter Prescription Now</h4>
                                                        
                                                                                    <p class="component_section_title clear_component_options_wrapper">
                                                                                        <a class="clear_component_options" href="#">Clear selection</a>
                                                                                    </p>
                                                                                </div>
                                                                                <div class="">
                                                                                    <div class="composited_product_images images" style="opacity: 1;">
                                                                                        <figure class="composited_product_image woocommerce-product-gallery__image">
                                                                                            <a href="https://directvisioneyewear.ca/wp-content/uploads/2020/05/edit.png" class="image zoom" title="edit.png" data-rel="photoSwipe">
                                                                                                <img src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/edit.png" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" loading="lazy" title="edit.png" data-caption="" data-large_image="https://directvisioneyewear.ca/wp-content/uploads/2020/05/edit.png" data-large_image_width="36" data-large_image_height="36" width="36" height="36">
                                                                                            </a>
                                                                                        </figure>
                                                                                    </div>
                                                                                    <div class="details component_data">
                                                                                        <ul class="products bundled_products columns-3">
                                                                                            <li class="bundled_item_1 bundled_product bundled_product_summary product thumbnail_hidden first">
                                                                                                <div class="details">
                                                                                                    <h4 class="bundled_product_title product_title">
                                                                                                        <span class="bundled_product_title_inner"><span class="item_title">Right Eye</span><span class="item_qty"></span><span class="item_suffix"></span></span>
                                                                                                    </h4>
                                                                                                    <div class="cart" data-title="Right Eye" data-product_title="Right Eye" data-visible="yes" data-optional_suffix="" data-optional="no" data-type="simple" data-bundled_item_id="1" data-custom_data="[]" data-product_id="386" data-bundle_id="387">
                                                                                                        <div class="bundled_item_wrap">
                                                                                                            <div class="bundled_item_cart_content">
                                                                                                                <div class="bundled_item_cart_details">
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-sph" data-product-name="Right Eye">
                                                                                                                        <label for="addon-1584107435-1-sph-0" class="wc-pao-addon-name" data-addon-name="SPH" data-has-per-person-pricing="" data-has-per-block-pricing="">SPH </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-1-sph-0">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-1-sph-0" id="addon-1584107435-1-sph-0">
                                                                                                                                <?php  
                                                                                                                                // function formatNum($num){
                                                                                                                                //     return sprintf("%+f",$num);
                                                                                                                                // }
                                                                                                                                
                                                                                                                                function formatNum($num) {
                                                                                                                                  $num = (float) $num; // or (float) if you'd rather
                                                                                                                                  return (($num >= 0) ? '+' : '') . $num; // implicit cast back to string
                                                                                                                                }

                                                                                                                                $points = +8.00;
                                                                                                                                while($points>=-8.00){?>
                                                                                                                                    <option <?php  if($points==$presDeets['r_sph']){echo "selected";}?>><?php   echo  number_format((float)formatNum($points), 2, '.', '');?></option>
                                                                                                                                <?php  $points-=0.25;
                                                                                                                                }?>
                                                        
                                                                                                                                </select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-cyl" data-product-name="Right Eye">
                                                                                                                        <label for="addon-1584107435-1-cyl-1" class="wc-pao-addon-name" data-addon-name="CYL" data-has-per-person-pricing="" data-has-per-block-pricing="">CYL </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-1-cyl-1">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-1-cyl-1" id="addon-1584107435-1-cyl-1">
                                                                                                                                <option value="">0.0</option>
                                                                                                                                
                                                                                                                                <?php  $points = +3.00;
                                                                                                                                while($points>=-3.00){?>
                                                                                                                                    <option <?php  if($points==$presDeets['r_cyl']){echo "selected";}?>><?php   echo  number_format((float)formatNum($points), 2, '.', '');?></option>
                                                                                                                                <?php  $points-=0.25;
                                                                                                                                }?>
                                                        
                                                                                                                            </select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-axis" data-product-name="Right Eye">
                                                                                                                        <label for="addon-1584107435-1-axis-2" class="wc-pao-addon-name" data-addon-name="Axis" data-has-per-person-pricing="" data-has-per-block-pricing="">Axis </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-1-axis-2">
                                                                                                                            <input type="text" class="input-text wc-pao-addon-field wc-pao-addon-custom-text" data-raw-price="" data-price="" name="addon-1584107435-1-axis-2" id="addon-1584107435-1-axis-2" data-price-type="flat_fee" value="<?php  echo $presDeets['r_axis']?>" ><small class="wc-pao-addon-chars-remaining"><span>5</span> characters remaining</small>
                                                                                                                            <small class="wc-pao-addon-chars-remaining"><span>5</span> characters remaining</small>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-add" data-product-name="Right Eye">
                                                                                                                        <label for="addon-1584107435-1-add-3" class="wc-pao-addon-name" data-addon-name="Add" data-has-per-person-pricing="" data-has-per-block-pricing="">Add </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-1-add-3">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-1-add-3" id="addon-1584107435-1-add-3">
                                                                                                                                <option value="">0.0</option>
                                                                                                                                
                                                                                                                                <?php  $points = +0.25;
                                                                                                                                while($points<6.00){?>
                                                                                                                                    <option <?php  if($points==$presDeets['r_add']){echo "selected";}?>><?php   echo  number_format((float)formatNum($points), 2, '.', '');?></option>
                                                                                                                                <?php $points+=0.25;
                                                                                                                                }?>
                                                        
                                                                                                                            </select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-pd" data-product-name="Right Eye">
                                                                                                                        <label for="addon-1584107435-1-pd-4" class="wc-pao-addon-name" data-addon-name="PD" data-has-per-person-pricing="" data-has-per-block-pricing="">PD </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-1-pd-4">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-1-pd-4" id="addon-1584107435-1-pd-4">
                                                                                                                                <option value="">0.0</option>
                                                                                                                                
                                                                                                                                 <?php $points = 22.00;
                                                                                                                                while($points<37.00){?>
                                                                                                                                    <option <?php  if($points==$presDeets['pd']){echo "selected";}?>><?php   echo  number_format((float)($points), 2, '.', '');?></option>
                                                                                                                                <?php  $points+=0.5;
                                                                                                                                }?>
                                                                                                                               </select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                                                                                    <div id="product-addons-total" data-show-sub-total="1" data-type="simple" data-tax-mode="excl" data-tax-display-mode="excl" data-price="0" data-raw-price="0" data-product-id="386" style="display: none;"><div class="product-addon-totals"><ul><li><div class="wc-pao-col1"><strong>1x Right Eye</strong></div><div class="wc-pao-col2"><strong><span class="amount">$0.00</span></strong></div></li><li><div class="wc-pao-col1"><strong>SPH - 0.00</strong></div><div class="wc-pao-col2">-</div></li><li><div class="wc-pao-col1"><strong>CYL - 0.00</strong></div><div class="wc-pao-col2">-</div></li><li class="wc-pao-subtotal-line"><p class="price">Subtotal <span class="amount">$0.00</span></p></li></ul></div></div>
                                                                                                                </div>
                                                                                                                <div class="bundled_item_after_cart_details bundled_item_button">
                                                                                                                    <div class="quantity quantity_hidden">
                                                                                                                        <input class="qty bundled_qty" type="hidden" name="component_1584107435_bundle_quantity_1" value="1">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="bundled_item_2 bundled_product bundled_product_summary product thumbnail_hidden">
                                                                                                <div class="details">
                                                                                                    <h4 class="bundled_product_title product_title">
                                                                                                        <span class="bundled_product_title_inner"><span class="item_title">Left Eye</span><span class="item_qty"></span><span class="item_suffix"></span></span>
                                                                                                    </h4>
                                                                                                    <div class="cart" data-title="Left Eye" data-product_title="Left Eye" data-visible="yes" data-optional_suffix="" data-optional="no" data-type="simple" data-bundled_item_id="2" data-custom_data="[]" data-product_id="385" data-bundle_id="387">
                                                                                                        <div class="bundled_item_wrap">
                                                                                                            <div class="bundled_item_cart_content">
                                                                                                                <div class="bundled_item_cart_details">
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-sph" data-product-name="Left Eye">
                                                                                                                        <label for="addon-1584107435-2-sph-0" class="wc-pao-addon-name" data-addon-name="SPH" data-has-per-person-pricing="" data-has-per-block-pricing="">SPH </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-2-sph-0">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-2-sph-0" id="addon-1584107435-2-sph-0">
                                                                                                                                <option value="">0.0</option>
                                                                                                                                
                                                                                                                                <?php  $points = +8.00;
                                                                                                                                while($points>=-8.00){?>
                                                                                                                                    <option <?php  if($points==$presDeets['l_sph']){echo "selected";}?>><?php   echo  number_format((float)formatNum($points), 2, '.', '');?></option>
                                                                                                                                <?php  $points-=0.25;
                                                                                                                                }?>
                                                                                                                               
                                                                                                                            </select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-cyl" data-product-name="Left Eye">
                                                                                                                        <label for="addon-1584107435-2-cyl-1" class="wc-pao-addon-name" data-addon-name="CYL" data-has-per-person-pricing="" data-has-per-block-pricing="">CYL </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-2-cyl-1">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-2-cyl-1" id="addon-1584107435-2-cyl-1">
                                                                                                                                <option value="">0.0</option>
                                                        
                                                                                                                                <?php  $points = +3.00;
                                                                                                                                while($points>=-3.00){?>
                                                                                                                                    <option <?php  if($points==$presDeets['l_cyl']){echo "selected";}?>><?php   echo  number_format((float)formatNum($points), 2, '.', '');?></option>
                                                                                                                                <?php  $points-=0.25;
                                                                                                                                }?>
                                                                                                                                </select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-axis" data-product-name="Left Eye">
                                                                                                                        <label for="addon-1584107435-2-axis-2" class="wc-pao-addon-name" data-addon-name="Axis" data-has-per-person-pricing="" data-has-per-block-pricing="">Axis </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-2-axis-2">
                                                                                                                            <input type="text" class="input-text wc-pao-addon-field wc-pao-addon-custom-text" data-raw-price="" data-price="" name="addon-1584107435-2-axis-2" id="addon-1584107435-2-axis-2" data-price-type="flat_fee" value="<?echo $presDeets['l_axis']?>" ><small class="wc-pao-addon-chars-remaining"><span>5</span> characters remaining</small>
                                                                                                                            <small class="wc-pao-addon-chars-remaining"><span>5</span> characters remaining</small>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-add" data-product-name="Left Eye">
                                                                                                                        <label for="addon-1584107435-2-add-3" class="wc-pao-addon-name" data-addon-name="Add" data-has-per-person-pricing="" data-has-per-block-pricing="">Add </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-2-add-3">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-2-add-3" id="addon-1584107435-2-add-3">
                                                                                                                                <option value="">0.0</option>
                                                        
                                                                                                                                    <?php  $points = +0.25;
                                                                                                                                while($points<6.00){?>
                                                                                                                                    <option <?php  if($points==$presDeets['l_add']){echo "selected";}?>><?php   echo  number_format((float)formatNum($points), 2, '.', '');?></option>
                                                                                                                                <?php  $points+=0.25;
                                                                                                                                }?>
                                                                                                                            </select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-pd" data-product-name="Left Eye">
                                                                                                                        <label for="addon-1584107435-2-pd-4" class="wc-pao-addon-name" data-addon-name="PD" data-has-per-person-pricing="" data-has-per-block-pricing="">PD </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-2-pd-4">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-2-pd-4" id="addon-1584107435-2-pd-4">
                                                                                                                                <option value="">0.0</option>
                                                        
                                                                                                                                <?php  $points = 22.00;
                                                                                                                                while($points<37.00){?>
                                                                                                                                    <option <?php  if($points==$presDeets['pd']){echo "selected";}?>><?php   echo  number_format((float)($points), 2, '.', '');?></option>
                                                                                                                                <?php  $points+=0.5;
                                                                                                                                }?>
                                                                                                                                
                                                                                                                            </select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                                                                                    <div id="product-addons-total" data-show-sub-total="1" data-type="simple" data-tax-mode="excl" data-tax-display-mode="excl" data-price="0" data-raw-price="0" data-product-id="385" style="display: none;"><div class="product-addon-totals"><ul><li><div class="wc-pao-col1"><strong>1x Left Eye</strong></div><div class="wc-pao-col2"><strong><span class="amount">$0.00</span></strong></div></li><li class="wc-pao-subtotal-line"><p class="price">Subtotal <span class="amount">$0.00</span></p></li></ul></div></div>
                                                                                                                </div>
                                                                                                                <div class="bundled_item_after_cart_details bundled_item_button">
                                                                                                                    <div class="quantity quantity_hidden">
                                                                                                                        <input class="qty bundled_qty" type="hidden" name="component_1584107435_bundle_quantity_2" value="1">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ul>
                                                                                        <div class="cart bundle_data bundle_data_387" data-bundle_price_data="{&quot;zero_items_allowed&quot;:&quot;yes&quot;,&quot;raw_bundle_price_min&quot;:0,&quot;raw_bundle_price_max&quot;:0,&quot;is_purchasable&quot;:&quot;yes&quot;,&quot;show_free_string&quot;:&quot;yes&quot;,&quot;show_total_string&quot;:&quot;no&quot;,&quot;prices&quot;:{&quot;1&quot;:0,&quot;2&quot;:0},&quot;regular_prices&quot;:{&quot;1&quot;:0,&quot;2&quot;:0},&quot;prices_tax&quot;:{&quot;1&quot;:{&quot;incl&quot;:1,&quot;excl&quot;:1},&quot;2&quot;:{&quot;incl&quot;:1,&quot;excl&quot;:1}},&quot;addons_prices&quot;:{&quot;1&quot;:&quot;&quot;,&quot;2&quot;:&quot;&quot;},&quot;regular_addons_prices&quot;:{&quot;1&quot;:&quot;&quot;,&quot;2&quot;:&quot;&quot;},&quot;quantities&quot;:{&quot;1&quot;:&quot;&quot;,&quot;2&quot;:&quot;&quot;},&quot;product_ids&quot;:{&quot;1&quot;:386,&quot;2&quot;:385},&quot;is_sold_individually&quot;:{&quot;1&quot;:&quot;no&quot;,&quot;2&quot;:&quot;no&quot;},&quot;recurring_prices&quot;:{&quot;1&quot;:&quot;&quot;,&quot;2&quot;:&quot;&quot;},&quot;regular_recurring_prices&quot;:{&quot;1&quot;:&quot;&quot;,&quot;2&quot;:&quot;&quot;},&quot;recurring_html&quot;:{&quot;1&quot;:&quot;&quot;,&quot;2&quot;:&quot;&quot;},&quot;recurring_keys&quot;:{&quot;1&quot;:&quot;&quot;,&quot;2&quot;:&quot;&quot;},&quot;base_price&quot;:&quot;0&quot;,&quot;base_regular_price&quot;:&quot;0&quot;,&quot;base_price_tax&quot;:{&quot;incl&quot;:1,&quot;excl&quot;:1},&quot;base_price_totals&quot;:{&quot;price&quot;:0,&quot;regular_price&quot;:0,&quot;price_incl_tax&quot;:0,&quot;price_excl_tax&quot;:0},&quot;subtotals&quot;:{&quot;price&quot;:0,&quot;regular_price&quot;:0,&quot;price_incl_tax&quot;:0,&quot;price_excl_tax&quot;:0},&quot;totals&quot;:{&quot;price&quot;:0,&quot;regular_price&quot;:0,&quot;price_incl_tax&quot;:0,&quot;price_excl_tax&quot;:0},&quot;recurring_totals&quot;:{&quot;price&quot;:0,&quot;regular_price&quot;:0,&quot;price_incl_tax&quot;:0,&quot;price_excl_tax&quot;:0},&quot;is_nyp&quot;:{&quot;1&quot;:&quot;no&quot;,&quot;2&quot;:&quot;no&quot;},&quot;is_priced_individually&quot;:{&quot;1&quot;:&quot;no&quot;,&quot;2&quot;:&quot;no&quot;},&quot;bundled_item_1_totals&quot;:{&quot;price&quot;:0,&quot;regular_price&quot;:0,&quot;price_incl_tax&quot;:0,&quot;price_excl_tax&quot;:0},&quot;bundled_item_1_recurring_totals&quot;:{&quot;price&quot;:0,&quot;regular_price&quot;:0,&quot;price_incl_tax&quot;:0,&quot;price_excl_tax&quot;:0},&quot;bundled_item_2_totals&quot;:{&quot;price&quot;:0,&quot;regular_price&quot;:0,&quot;price_incl_tax&quot;:0,&quot;price_excl_tax&quot;:0},&quot;bundled_item_2_recurring_totals&quot;:{&quot;price&quot;:0,&quot;regular_price&quot;:0,&quot;price_incl_tax&quot;:0,&quot;price_excl_tax&quot;:0},&quot;price_string&quot;:&quot;%s&quot;,&quot;group_mode_features&quot;:[&quot;parent_item&quot;,&quot;child_item_indent&quot;,&quot;aggregated_subtotals&quot;,&quot;parent_cart_widget_item_meta&quot;]}" data-bundle_id="387">
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-space-and-border" data-product-name="Enter Prescription Now">
                                                                                                <h3 class="wc-pao-addon-heading">Space and Border</h3>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-pupillary-distance-pd" data-product-name="Enter Prescription Now">
                                                                                                <h3 class="wc-pao-addon-heading">Pupillary Distance (PD)</h3>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-pd" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-pd-2" class="wc-pao-addon-name" data-addon-name="PD" data-has-per-person-pricing="" data-has-per-block-pricing="">PD </label>
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-pd-2">
                                                                                                    <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-pd-2" id="addon-1584107435-pd-2">
                                                                                                        <option value="">0.0</option>
                                                                                                        
                                                                                                        
                                                        
                                                                                                        <option data-raw-price="" data-price="" data-price-type="flat_fee" value="0-1" data-label="0">0 </option>
                                                                                                        <?php  $points = 44.00;
                                                                                                        while($points<74.00){?>
                                                                                                            <option <?php  if($points==$presDeets['pd']){echo "selected";}?>><?php   echo  number_format((float)($points), 0, '.', '');?></option>
                                                                                                        <?php  $points+=1;
                                                                                                        }?>
                                                                                                        
                                                                                                    </select>
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-right-pd" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-right-pd-3" class="wc-pao-addon-name" data-addon-name="Right PD" data-has-per-person-pricing="" data-has-per-block-pricing="">Right PD </label>
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-right-pd-3">
                                                                                                    <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-right-pd-3" id="addon-1584107435-right-pd-3">
                                                                                                        <option value="">0.0</option>
                                                                                                        
                                                                                                        <?php  $points = 22.00;
                                                                                                        while($points<37.00){?>
                                                                                                            <option <?php  if($points==$presDeets['addon-1584107435-right-pd-3']){echo "selected";}?>><?php   echo  number_format((float)($points), 2, '.', '');?></option>
                                                                                                        <?php  $points+=0.5;
                                                                                                        }?>
                                                        
                                                                                                      
                                                                                                    </select>
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-left-pd" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-left-pd-4" class="wc-pao-addon-name" data-addon-name="Left PD" data-has-per-person-pricing="" data-has-per-block-pricing="">Left PD </label>
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-left-pd-4">
                                                                                                    <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-left-pd-4" id="addon-1584107435-left-pd-4">
                                                                                                        <option value="">0.0</option>
                                                                                                        
                                                                                                        <option data-raw-price="" data-price="" data-price-type="flat_fee" value="0-00-1" data-label="0.00">0.00 </option>
                                                                                                        <?php  $points = 22.00;
                                                                                                        while($points<37.00){?>
                                                                                                            <option <?php  if($points==$presDeets['addon-1584107435-left-pd-3']){echo "selected";}?>><?php   echo  number_format((float)($points), 2, '.', '');?></option>
                                                                                                        <?php  $points+=0.5;
                                                                                                        }?>
                                                                                                        </select>
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        <!--
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-measure-my-pd" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-measure-my-pd-5" class="wc-pao-addon-name" data-addon-name="Measure My PD" data-has-per-person-pricing="" data-has-per-block-pricing="">Measure My PD </label>
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-measure-my-pd-5">
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="input-text wc-pao-addon-field wc-pao-addon-custom-text"
                                                                                                        data-raw-price=""
                                                                                                        data-price=""
                                                                                                        name="addon-1584107435-measure-my-pd-5"
                                                                                                        id="addon-1584107435-measure-my-pd-5"
                                                                                                        data-price-type="flat_fee"
                                                                                                        value=""
                                                                                                    />
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        -->
                                                                                            <!--<div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-pd-checkbox" data-product-name="Enter Prescription Now">
                                                                                                <label class="wc-pao-addon-name" data-addon-name="PD Checkbox" data-has-per-person-pricing="" data-has-per-block-pricing="" style="display: none;"></label>
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-pd-checkbox-6-0">
                                                                                                    <label>
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            class="wc-pao-addon-field wc-pao-addon-checkbox"
                                                                                                            name="addon-1584107435-pd-checkbox-6[]"
                                                                                                            data-raw-price=""
                                                                                                            data-price=""
                                                                                                            data-price-type="flat_fee"
                                                                                                            value="two-pd-numbers"
                                                                                                            data-label="Two PD numbers"
                                                                                                        />
                                                                                                        Two PD numbers
                                                                                                    </label>
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>-->
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-who-is-the-prescription-for" data-product-name="Enter Prescription Now">
                                                                                                <h3 class="wc-pao-addon-heading">Who is the prescription for? *</h3>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-required-addon wc-pao-addon wc-pao-addon-first-name" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-first-name-8" class="wc-pao-addon-name" data-addon-name="First Name" data-has-per-person-pricing="" data-has-per-block-pricing="">
                                                                                                    First Name <em class="required" title="Required field">*</em>&nbsp;
                                                                                                </label>
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-first-name-8">
                                                                                                    <input type="text" class="input-text wc-pao-addon-field wc-pao-addon-custom-text" data-raw-price="" data-price="" name="addon-1584107435-first-name-8" id="addon-1584107435-first-name-8" data-price-type="flat_fee" value="<?php  echo $presDeets['fname']?>" maxlength="20" pattern="[A-Za-z0-9-]+" title="Only letters and numbers" required=""><small class="wc-pao-addon-chars-remaining"><span>20</span> characters remaining</small>
                                                                                                    <small class="wc-pao-addon-chars-remaining"><span>20</span> characters remaining</small>
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-required-addon wc-pao-addon wc-pao-addon-last-name" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-last-name-9" class="wc-pao-addon-name" data-addon-name="Last Name" data-has-per-person-pricing="" data-has-per-block-pricing="">
                                                                                                    Last Name <em class="required" title="Required field">*</em>&nbsp;
                                                                                                </label>
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-last-name-9">
                                                                                                    <input type="text" class="input-text wc-pao-addon-field wc-pao-addon-custom-text" data-raw-price="" data-price="" name="addon-1584107435-last-name-9" id="addon-1584107435-last-name-9" data-price-type="flat_fee" value="<?php  echo $presDeets['lname']?>" maxlength="20" pattern="[A-Za-z0-9-]+" title="Only letters and numbers" required=""><small class="wc-pao-addon-chars-remaining"><span>20</span> characters remaining</small>
                                                                                                    <small class="wc-pao-addon-chars-remaining"><span>20</span> characters remaining</small>
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-save-prescription" data-product-name="Enter Prescription Now">
                                                                                                <h3 class="wc-pao-addon-heading">Save Prescription *</h3>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-save-your-prescription-for-future-use" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-save-your-prescription-for-future-11" class="wc-pao-addon-name" data-addon-name="Save your prescription for future use" data-has-per-person-pricing="" data-has-per-block-pricing="">
                                                                                                    Save your prescription for future use
                                                                                                </label>
                                                                                                <!--<div class="wc-pao-addon-description"><p>e.g. Prescription name</p></div>-->
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-save-your-prescription-for-future-11">
                                                                                                    <input type="text" class="input-text wc-pao-addon-field wc-pao-addon-custom-text" data-raw-price="" data-price="" name="addon-1584107435-save-your-prescription-for-future-11" id="addon-1584107435-save-your-prescription-for-future-11" data-price-type="flat_fee" value="<?php  echo $presDeets['prescription']?>" pattern="[A-Za-z0-9-]+" title="Only letters and numbers">
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-required-addon wc-pao-addon wc-pao-addon-date-of-prescription" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-date-of-prescription-12" class="wc-pao-addon-name" data-addon-name="Date of prescription" data-has-per-person-pricing="" data-has-per-block-pricing="">
                                                                                                    Date of prescription <em class="required" title="Required field">*</em>&nbsp;
                                                                                                </label>
                                                                                                <div class="wc-pao-addon-description"><p>mm/dd/yyyy</p></div>
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-date-of-prescription-12">
                                                                                                    <input type="date" class="" data-raw-price="" data-price=""  name="addon-1584107435-date-of-prescription-12" id="addon-1584107435-date-of-prescription-12" data-price-type="flat_fee" value="<?php  echo $presDeets['timeAdded']?>" maxlength="10" style="border-radius: 3px;
border: 1px solid #c0c0c0;
background: transparent;
height: 49px;
padding: 6px 7px;
font-size: 20px;
color: #000;">
                                                                                                    <small class="wc-pao-addon-chars-remaining"><span>10</span> characters remaining</small>
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-upload-prescription" data-product-name="Enter Prescription Now">
                                                                                                <h3 class="wc-pao-addon-heading">Upload Prescription *</h3>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-required-addon wc-pao-addon wc-pao-addon-upload-your-prescription" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-upload-your-prescription-14" class="wc-pao-addon-name" data-addon-name="Upload your prescription" data-has-per-person-pricing="" data-has-per-block-pricing="">
                                                                                                    Upload your prescription <em class="required" title="Required field">*</em>&nbsp;
                                                                                                </label>
                                                                                                <!--<div class="wc-pao-addon-description"><p>Allowed Types (PDF, PNG, JPEG, JPG)</p></div>-->
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-upload-your-prescription-14">
                                                                                                    <input onchange="loadFile(event)" type="file" class="wc-pao-addon-file-upload input-text wc-pao-addon-field" data-raw-price="" data-price="" data-price-type="flat_fee" name="addon-1584107435-upload-your-prescription-14" id="addon-1584107435-upload-your-prescription-14" required="" accept=".png,.jpg,.jpeg">
                                                                                                    <small>(max file size 200 MB)</small>
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                                <br><img id="output" class="<?php  if($presDeets['file_name']==""){echo 'hide';}?>" width="200" src="./uploads/<?php  echo $presDeets['file_name']?>" /><br>
                                                                                            </div>
                                                        
                                                                                           
                                                                                            <!--
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-confirm" data-product-name="Enter Prescription Now">
                                                                                                <input type="submit" class="wc-pao-addon-heading" name="first_submit" value="confirm" style="top: 0px !important;">
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                                                            -->
                                                                                            <div class="wc-pao-addon-container  wc-pao-addon wc-pao-addon-confirm" data-product-name="Enter Prescription Now" onclick="submitform()">
                                                                                            	    <h3 class="wc-pao-addon-heading">Confirm</h3>
                                                                                            	<div class="clear"></div>
                                                                                            </div>


                                                                                            <div id="product-addons-total" data-show-sub-total="1" data-type="bundle" data-tax-mode="excl" data-tax-display-mode="excl" data-price="0" data-raw-price="0" data-product-id="387"><div class="product-addon-totals"><ul><li><div class="wc-pao-col1"><strong>1x Enter Prescription Now</strong></div><div class="wc-pao-col2"><strong><span class="amount">$0.00</span></strong></div></li><li class="wc-pao-subtotal-line"><p class="price">Subtotal <span class="amount">$0.00</span></p></li></ul></div></div>
                                                                                            <div class="bundle_wrap component_wrap">
                                                                                                <div class="bundle_price" style="display: none;"></div>
                                                                                                <div class="bundle_availability" style="display: none;"></div>
                                                                                                <div class="bundle_button">
                                                                                                    <div class="quantity">
                                                                                                        <label class="screen-reader-text" for="quantity_60ae2396c9dce">Enter Prescription Now quantity</label>
                                                                                                        <input type="number" id="quantity_60ae2396c9dce" class="input-text qty text" step="1" min="1" max="" name="wccp_component_quantity[1584107435]" value="1" title="Qty" size="4" placeholder="" inputmode="numeric">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div id="composite_navigation_394" class="composite_navigation movable paged standard">
                                                                                <div class="composite_navigation_inner">
                                                                                    <!--<a class="page_button prev" href="#vision" rel="nofollow" aria-label="Go to Vision">Back</a>-->
                                                                                    <!-- <a class="page_button next " href="#lens-type" rel="nofollow" aria-label="Go to Lens Type">Lens Type</a> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
																	</div>
																	<!-- first form -->
                                                                    <p class="component_section_title">
                                                                        <label class="select_label"> Available options: </label>
                                                                    </p>
                                                                    <div class="component_pagination cp_clearfix top" data-pagination_data="{&quot;page&quot;:1,&quot;pages&quot;:1}" style="display: none;">
                                                                        <p class="index woocommerce-result-count" tabindex="-1">Page 1 of 1</p>
                                                                        <nav class="woocommerce-pagination">
                                                                            <ul class="page-numbers">
                                                                                <li>
                                                                                    <span aria-current="page" class="page-numbers component_pagination_element number current" data-page_num="1">1</span>
                                                                                </li>
                                                                            </ul>
                                                                        </nav>
                                                                    </div>
                                                                    <div id="component_options_1584107435" class="component_options" data-options_data="[{&quot;option_id&quot;:&quot;387&quot;,&quot;option_title&quot;:&quot;Enter Prescription Now&quot;,&quot;option_price_html&quot;:&quot;&amp;nbsp;&quot;,&quot;option_thumbnail_html&quot;:&quot;<img width=\&quot;36\&quot; height=\&quot;36\&quot; src=\&quot;https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/edit.png\&quot; class=\&quot;attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\&quot; alt=\&quot;\&quot; loading=\&quot;lazy\&quot; \/>&quot;,&quot;option_product_data&quot;:&quot;&quot;,&quot;option_price_data&quot;:{&quot;price&quot;:&quot;0&quot;,&quot;regular_price&quot;:&quot;0&quot;,&quot;max_price&quot;:&quot;0&quot;,&quot;max_regular_price&quot;:&quot;0&quot;,&quot;min_qty&quot;:1,&quot;max_qty&quot;:&quot;&quot;,&quot;discount&quot;:&quot;&quot;},&quot;is_selected&quot;:false,&quot;is_configurable&quot;:true,&quot;has_addons&quot;:true,&quot;has_required_addons&quot;:true,&quot;is_in_view&quot;:true,&quot;option_description&quot;:&quot;Add new prescription,\r\nthis will be saved for future use.&quot;},{&quot;option_id&quot;:&quot;396&quot;,&quot;option_title&quot;:&quot;Upload Prescription&quot;,&quot;option_price_html&quot;:&quot;&amp;nbsp;&quot;,&quot;option_thumbnail_html&quot;:&quot;<img width=\&quot;36\&quot; height=\&quot;34\&quot; src=\&quot;https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/upload.png\&quot; class=\&quot;attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\&quot; alt=\&quot;\&quot; loading=\&quot;lazy\&quot; \/>&quot;,&quot;option_product_data&quot;:&quot;&quot;,&quot;option_price_data&quot;:{&quot;price&quot;:&quot;0&quot;,&quot;regular_price&quot;:&quot;0&quot;,&quot;max_price&quot;:&quot;0&quot;,&quot;max_regular_price&quot;:&quot;0&quot;,&quot;min_qty&quot;:1,&quot;max_qty&quot;:&quot;&quot;,&quot;discount&quot;:&quot;&quot;},&quot;is_selected&quot;:false,&quot;is_configurable&quot;:true,&quot;has_addons&quot;:true,&quot;has_required_addons&quot;:true,&quot;is_in_view&quot;:true,&quot;option_description&quot;:&quot;Take a photo of your paper prescription\r\nand your glasses will ship faster!&quot;},{&quot;option_id&quot;:&quot;397&quot;,&quot;option_title&quot;:&quot;Use Saved Prescription&quot;,&quot;option_price_html&quot;:&quot;&amp;nbsp;&quot;,&quot;option_thumbnail_html&quot;:&quot;<img width=\&quot;36\&quot; height=\&quot;36\&quot; src=\&quot;https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/folder.png\&quot; class=\&quot;attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\&quot; alt=\&quot;\&quot; loading=\&quot;lazy\&quot; \/>&quot;,&quot;option_product_data&quot;:&quot;&quot;,&quot;option_price_data&quot;:{&quot;price&quot;:&quot;0&quot;,&quot;regular_price&quot;:&quot;0&quot;,&quot;max_price&quot;:&quot;0&quot;,&quot;max_regular_price&quot;:&quot;0&quot;,&quot;min_qty&quot;:1,&quot;max_qty&quot;:&quot;&quot;,&quot;discount&quot;:&quot;&quot;},&quot;is_selected&quot;:false,&quot;is_configurable&quot;:true,&quot;has_addons&quot;:true,&quot;has_required_addons&quot;:true,&quot;is_in_view&quot;:true,&quot;option_description&quot;:&quot;Load a previously saved prescription\r\nfrom your account, requires login&quot;}]" style="display: none;">
                                                                        <div class="component_options_inner cp_clearfix">
                                                                            <div id="component_option_thumbnails_1584107435" class="component_option_thumbnails columns-3" data-component_option_columns="3">
                                                                                <ul class="component_option_thumbnails_container cp_clearfix" style="list-style: none;">
                                                                                    <li id="component_option_thumbnail_container_387" class="sandeep2press component_option_thumbnail_container first" style="margin-bottom: 20px;">
                                                                                        <div id="component_option_thumbnail_387" class="cp_clearfix component_option_thumbnail selected" data-val="387">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Enter Prescription Now2</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/edit.png" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" loading="lazy" width="36" height="36">
                                                                                            </div>
                                                                                            <div class="thumbnail_description">
                                                                                                <p>Add new prescription, this will be saved for future use.</p>
                                                        
                                                                                                <span class="thumbnail_price price">&nbsp;</span>
                                                                                            </div>
                                                                                            <div class="thumbnail_buttons">
                                                                                                <button class="button component_option_thumbnail_select" aria-label="Select Enter Prescription Now options">Select options</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                        
                                                                                    <li id="component_option_thumbnail_container_396" class="component_option_thumbnail_container" style="margin-bottom: 20px;">
                                                                                        <div id="component_option_thumbnail_396" class="cp_clearfix component_option_thumbnail" data-val="396">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Upload Prescription</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/upload.png" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" loading="lazy" width="36" height="34">
                                                                                            </div>
                                                                                            <div class="thumbnail_description">
                                                                                                <p>Take a photo of your paper prescription and your glasses will ship faster!</p>
                                                        
                                                                                                <span class="thumbnail_price price">&nbsp;</span>
                                                                                            </div>
                                                                                            <div class="thumbnail_buttons">
                                                                                                <button class="button component_option_thumbnail_select" aria-label="Select Upload Prescription options">Select options</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                        
                                                                                    <li id="component_option_thumbnail_container_397" class="component_option_thumbnail_container last" style="margin-bottom: 20px;">
                                                                                        <div id="component_option_thumbnail_397" class="cp_clearfix component_option_thumbnail" data-val="397">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Use Saved Prescription</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/folder.png" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" loading="lazy" width="36" height="36">
                                                                                            </div>
                                                                                            <div class="thumbnail_description">
                                                                                                <p>Load a previously saved prescription from your account, requires login</p>
                                                        
                                                                                                <span class="thumbnail_price price">&nbsp;</span>
                                                                                            </div>
                                                                                            <div class="thumbnail_buttons">
                                                                                                <button class="button component_option_thumbnail_select" aria-label="Select Use Saved Prescription options">Select options</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="component_options_select_wrapper" style="display: none;">
                                                                                <select id="component_options_1584107435" class="component_options_select" name="wccp_component_selection[1584107435]">
                                                                                    <option value="" selected="selected">Choose an option</option>
                                                        
                                                                                    <option value="387">Enter Prescription Now</option>
                                                        
                                                                                    <option value="396">Upload Prescription</option>
                                                        
                                                                                    <option value="397">Use Saved Prescription</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="component_pagination cp_clearfix bottom" data-pagination_data="{&quot;page&quot;:1,&quot;pages&quot;:1}" style="display: none;">
                                                                        <p class="index woocommerce-result-count" tabindex="-1">Page 1 of 1</p>
                                                                        <nav class="woocommerce-pagination">
                                                                            <ul class="page-numbers">
                                                                                <li>
                                                                                    <span aria-current="page" class="page-numbers component_pagination_element number current" data-page_num="1">1</span>
                                                                                </li>
                                                                            </ul>
                                                                        </nav>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="composite_navigation_394" class="composite_navigation bottom paged standard">
                                                                <div class="composite_navigation_inner">
                                                                    <!--<a class="page_button prev" href="#vision" rel="nofollow" aria-label="Go to Vision">Back</a>-->
                                                                    <!-- <a class="page_button next " href="#lens-type" rel="nofollow" aria-label="Go to Lens Type">Lens Type</a> -->
                                                                </div>
                                                            </div>
                                                        </div>
                </form>   
                <?php  }?>
                
                
                
                
                
                
                
                
                
                
                
                
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
<?php if(!isset($_GET['print'])){ require("./includes/footer.php");}?>
</div>
<!-- .fl-page -->
<?php require("./includes/footerjs.php");?>

<script type="text/javascript">
    $(document).ready(function(e){
        $(".table").dataTable({"bPaginate": false});
        $("form.deleteGlass").on('submit',function(e){
            return confirm("do you want to delete this record?");
        })
    });
    
    <?php  if(isset($_GET['print'])){?>
    print();
    <?php  }?>
    
    
    function submitform(){
        $("form").submit();
    }
</script>



<script type="text/javascript">
    const acceptedImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
    var loadFile = function(event) {
        console.log("function dalled")
      var image = document.getElementById('output');
      if(event.target.files[0]['type'] && acceptedImageTypes.includes(event.target.files[0]['type'])){
        image.classList.remove('hide');
        image.src = URL.createObjectURL(event.target.files[0]);
      }else{
        image.classList.add('hide');
      }
    };
  </script>
  
  
</body>
</html>
