<?php 
include_once("global.php");

if($logged==0){
?><script>window.location="./"</script><?php 
}

/*get Clients a*/
// $getGlasses_sql = "SELECT * FROM `glassBuy_glasses` ORDER BY `created_at` DESC";
// $getGlasses = getAll($con,$getGlasses_sql);
/*end of get Clients*/
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    
<?
if(!isset($_GET['print'])){
require("./includes/head.php");
}
?>
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
    <?if(!isset($_GET['print'])){ ?>
<h2 class="heading-title">
    <span class="title-text pp-primary-title">My Account</span>
</h2>
<?}?>
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
                
                <h5>Addresses</h5>
                <?if(true){?>
                <style>
                    #DataTables_Table_0_wrapper{
                        overflow:auto !important;
                    }
                </style>
                
                <table >
                    <thead>
                        <tr>
                            <?
                            
                            $myOrderIds = array();
                            $query = "SELECT *, o.id order_id from glassBuy_order o inner join glassBuy_glasses g on g.glass_id=o.product_id where o.user_id='$session_userId' and isPaid='1';";
                            $orders = getAll($con, $query);
                            foreach($orders as $row){
                                $myOrderIds[] = $row['order_id'];
                            }
                            
                            $myOrderIds = "('".implode("','", $myOrderIds)."')";
                            $presRows = array();
                            $od = getAll($con, "SELECT * from glassBuy_order_details limit 1;");
                            foreach($od as $row){
                                // $presRows[$row['order_id']] = $row;
                                foreach($row as $r => $val){
                                    if(!in_array($r, array("product_name", "product_id", "order_id", "id", "product_price", "create_password", "order_date"))){
                                        $presRows[] = $r;
                                        ?>
                                         <th><?echo $r?></th>
                                        <?
                                    }
                                }
                            }
                            ?>
                        </tr>
                        <tbody>
                            <?
                            $query = "SELECT * from glassBuy_order_details where order_id in $myOrderIds;";
                            $od = getAll($con, $query);
                            foreach($od as $row){
                                ?><tr><?
                                foreach($presRows as $pr){
                                    ?>
                                    <td>
                                        <?if($pr!="file_name"){?>
                                        <?echo $row[$pr]?>
                                        <?}else{?>
                                        <a href="./uploads/<?echo $row[$pr]?>" target="_blank">View file</a>
                                        <?}?>
                                    
                                    </td>
                                    <?
                                }
                                ?></tr><?
                            }?>
                        </tbody>
                    </thead>
                    
                </table>
                <?}?>
                
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
        $("table").dataTable();
        $("form.deleteGlass").on('submit',function(e){
            return confirm("do you want to delete this record?");
        })
    });
    
    <?if(isset($_GET['print'])){?>
    print();
    <?}?>
</script>
</body>
</html>
