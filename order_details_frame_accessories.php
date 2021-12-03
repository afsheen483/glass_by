<?php 
include_once("global.php");
/*
if($logged==0){
?><script>window.location="./"</script><?php 
}
*/
/*get Clients a*/
// $getGlasses_sql = "SELECT * FROM `glassBuy_glasses` ORDER BY `created_at` DESC";
// $getGlasses = getAll($con,$getGlasses_sql);
/*end of get Clients*/

$orderId = $_GET['id'];
$prescriptionDeets = getAll($con, "SELECT * from glassBuy_prescription where order_id='$orderId';")[0];
$orderDeets = getAll($con, "SELECT *, o.id order_id from glassBuy_order o inner join glassBuy_glasses g on g.glass_id=o.product_id where o.id='$orderId' ")[0];
$productId = $orderDeets['product_id'];
//dd($productId);
$orderDetailsDeets = getAll($con, "SELECT * from glassBuy_order_details where order_id='$orderId'")[0];
//$productDeets = getAll($con, "SELECT * from glassBuy_glasses where glass_id='$productId'")[0];
$productDeets = getAll($con, "SELECT g.*,p.name from glassBuy_glasses g JOIN glassbuy_glass_picture p ON p.glass_id = g.glass_id where g.glass_id='$productId'")[0];
 //var_dump($productDeets);


$myaccessories = array();
$rows = getAll($con, "select * from glassBuy_order_accessories a inner join glassBuy_glasses g on g.glass_id=a.accessoryId where orderId='$orderId'");
foreach($rows as $row){
    $myaccessories[$row['accessoryId']] = array($row['title'], $row['price']);
}

if(isset($_GET['print']) && !isset($_GET['norecurs'])){
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."&norecurs=1&filehash=".$filehash;


    $key = "c7nTivtay4QGoyGG";
    $url = "https://v2.convertapi.com/convert/web/to/pdf?Secret=$key&Url=".urlencode($actual_link)."&StoreFile=true&ViewportWidth=1200&Background=false&PageOrientation=landscape";
    // echo $url;
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $return = curl_exec($ch);
    $return = json_decode($return, true);
    if($return['Code']!=""){
        $code= ($return['Code']);
    }

    $content = $return['Files'][0]['Url'];
            
            
    if(!isset($_GET['norecurs'])){
        	    

        	    ?>
                <script>window.open('<?php echo $content?>', '_blank'); </script>
                <?php 
            
        	}
            
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    
    <style type="text/css" media="print">
  @page { size: landscape; }
</style>
<?php 
if(!isset($_GET['print'])){
}
require("./includes/head.php");

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
    
</div>
</div>
</div>
</div>
<div class="fl-module fl-module-rich-text fl-node-5ec37624db6e7" data-node="5ec37624db6e7">
<div class="fl-module-content fl-node-content">
<div class="fl-rich-text">
<div>
<div class="woocommerce">
   

            <div class="woocommerce-MyAccount-content" style="width: 100%;
padding-left: 0px;
margin: 0;">
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
                
                <?php if(isset($_GET['thankyou'])){?>
                <h3 class="heading-title" style="    text-align: center;
    font-size: 20px;">
                    <span class="title-text pp-primary-title">Thank you for placing your order with us. Your order details are as follows.</span>
                </h3>
                
                <?php }?>
                <h2 class="heading-title" style="    text-align: center;
    font-size: 30px;">
                    <span class="title-text pp-primary-title">ORDER ID # <?php echo $orderId?></span>
                </h2>
                
                <?php if(!isset($_GET['print'])){?>
                
                 <a target="_blank" class="button" href="?id=<?php echo $_GET['id']?>&print=<?php echo $_GET['id']?>" style="color:white;">Print</a>
                 
                 
                 <?php }?>
                <div class="row">
                    <div class='col-sm-4'>
                        <h3>Customer Details</h3>
                        <p><b>Firstname: </b><?php echo $orderDetailsDeets['fname']?></p>
                        <p><b>Lastname: </b><?php echo $orderDetailsDeets['lname']?></p>
                        <p><b>DOB: </b></p>
                        <p><b>Shipping Address: </b><?php echo $orderDetailsDeets['city']?> <?php echo $orderDetailsDeets['province']?> <?php echo $orderDetailsDeets['postalcode']?> <?php echo $orderDetailsDeets['country']?></p>
                        <p><b>Email ID: </b><?php echo $orderDetailsDeets['email']?></p>
                        <p><b>Phone Number: </b><?php echo $orderDetailsDeets['phone']?></p>
                        
                        <!-- <h3>Order Details</h3>
                        <p><b>Frame Title: </b>
                        <?php
                        //  echo $orderDetailsDeets['product_name']
                         ?>
                    </p>
                        <p><b>Frame Color: </b><?php 
                        // echo $productDeets['colour']
                        ?></p>
                        <small>
                        <p><span>Lens Type: </span><?php 
                        // echo $orderDetailsDeets['lensType']
                        ?></p>
                        <p><span>Lens Enhancement: </span><?php 
                        // echo $orderDetailsDeets['vision']
                        ?></p> -->
                        
                        
                        <!-- <p>Comments:<br> -->
                        
                        <?php 
                        // echo $orderDeets['order_comments']
                        ?>
                        </p>
                        <hr>
                        <?php foreach($myaccessories as $row){?>
                        <p><span><?php 
                        // echo $row[0]
                        ?> </span><?php 
                            // echo $row[1]
                            ?></p>
                        <?php }?>
                        </small>
                       
                    </div>
                    
                    
                    <div class='col-sm-4'>
                        <!-- <h3>Prescription Entered</h3> -->
                        <h3>Glasses Order</h3>
                        <table class="table" border="1">
                            <tr>
                                <th>Frame Title</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Frame Color</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Frame Image</th>
                                <td><img src="<?php echo "uploads/".$productDeets['name']?>" alt="image" width="50px" height="50px"></td>
                            </tr>
                            
                        </table>

                      
                       
                            <table class="table" border = "1">
                                    <tr>
                                        <th>Accessory Name</th>
                                        <th>Accessory Title</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $orderDetailsDeets['product_name']?></td>
                                        <td><?php echo $productDeets['colour']?></td>
                                    </tr>
                            </table>
                        <!-- <p><b>PD: </b><?php 
                        // echo $prescriptionDeets['pd']
                        ?></p> -->
                        <!-- <p><b>PD Photo: </b> -->
                        <?php 
                        // if($prescriptionDeets['file_name']!="")
                        //{
                            ?>
                            <!-- <img src="./uploads/<?php 
                                // echo $prescriptionDeets['file_name']
                                ?>" style="width:100%;"> -->
                            <br>
                            <!-- <a download href="./uploads/<?php 
                            // echo $prescriptionDeets['file_name']
                            ?>">Download</a>
                            <?php
                         //}
                         ?> -->
                        </p>
                        <!-- <p><b>PD Measurement Photo: </b> -->
                        <?php
                        //  if($prescriptionDeets['pdimage']!=""){
                             ?>
                            <!-- <img src="./uploads/<?php 
                            // echo $prescriptionDeets['pdimage']
                            ?>" style="width:100%;"> -->
                            <br>
                            <!-- <a download href="./uploads/<?php 
                            // echo $prescriptionDeets['pdimage']
                            ?>">Download</a> -->
                            <?php 
                        //}
                        ?>
                        </p>
                        
                        
                        
                        
                    </div>
                    <div class="col-sm-4">
                        
                        <div id="order_review" class="woocommerce-checkout-review-order">
                                                                                <div class="checkout-items">
                                                                                    <h3 id="order_review_heading">Order Summary</h3>
    
                                                                                    <table class="shop_table woocommerce-checkout-review-order-table">
                                                                                        <tbody>
                                                                                            <tr class="cart_item">
                                                                                                <td class="product-name"><?php echo $orderDetailsDeets['product_name']?><strong class="product-quantity">×&nbsp;1</strong></td>
                                                                                                <td class="product-total">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $productDeets['price']?></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <style>
                                                                                                .woocommerce #order_review .woocommerce-checkout-review-order-table tbody tr:last-child td {
                                                                                                    width: 50%;
                                                                                                    float: left;
                                                                                                }
                                                                                            </style>
                                                                                            <tr class="cart_item">
                                                                                                <!-- <td class="product-name">Prescription Lenses&nbsp; <strong class="product-quantity">×&nbsp;1</strong></td> -->
                                                                                                <td class="product-name">
                                                                                                    Frame
                                                                                                <br>
                                                                                            Lenses
                                                                                        <br>
                                                                                    Accessory</td>
                                                                                                <td class="product-total">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $orderDetailsDeets['product_price']?>
                                                                                                    <br>
                                                                                                    $</span><?php echo $orderDetailsDeets['product_price']?></bdi>
                                                                                                    </span>
                                                                                                    <br>
                                                                                                    $</span><?php echo $orderDetailsDeets['product_price']?></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            
                                                                                        </tbody>
                                                                                        <tfoot>
                                                                                            <tr class="cart-subtotal">
                                                                                                <th>Subtotal</th>
                                                                                                <td>
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $productDeets['price']?></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            
                                                                                            <?php $discount = round(($_SESSION['coupon_discount']/100) * $productDeets['price'], 2);
                                                                                            $tax = round(($productDeets['price'] * 0.04712), 2)  ;?>
    
                                                                                            <tr class="woocommerce-shipping-totals shipping">
                                                                                                <th>
                                                                                                    Shipping<br />
                                                                                                </th>
                                                                                                <td data-title="Shipping">$<span class="woocommerce-Price-amount amount">9</span></td>
                                                                                            </tr>
                                                                                            <tr class="woocommerce-shipping-totals shipping">
                                                                                                <th>
                                                                                                    Discount<br />
                                                                                                </th>
                                                                                                <td data-title="Shipping">$<span class="woocommerce-Price-amount amount"><?php echo $discount?></span></td>
                                                                                            </tr>
                                                                                            
                                                                                            
    
                                                                                            <tr class="tax-total">
                                                                                                <th>Tax</th>
                                                                                                <td>
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $tax;?></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
    
                                                                                            <tr class="order-total">
                                                                                                <th>Order Total</th>
                                                                                                <td>
                                                                                                    <strong>
                                                                                                        <input name="total" value="<?php echo round(($tax+ $productDeets['price'] + 9) - $discount, 2)?>" hidden>
                                                                                                        <span class="woocommerce-Price-amount amount">
                                                                                                            <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo round(($tax+ $productDeets['price'] + 9) - $discount, 2)?></bdi>
                                                                                                        </span>
                                                                                                    </strong>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tfoot>
                                                                                    </table>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        
                    </div>
                </div>
                
                <?php if(!isset($_GET['print'])){?>
                <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=613aff08f7277c0019b0d64b&product=inline-share-buttons" async="async"></script>

<!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons" style="margin-top:20px;"></div><!-- ShareThis END --> 


<?php }?>
                
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
        $("table").dataTable(
            {
           buttons: [{
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3,4]
                }
            }]
        });
        $("form.deleteGlass").on('submit',function(e){
            return confirm("do you want to delete this record?");
        })
    });
    
    <?php if(isset($_GET['print'])){?>
    // print();
    
    
    
    <?php }?>
</script>
</body>
</html>
