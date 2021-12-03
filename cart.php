<?php include_once("global.php");

// var_dump($_SESSION['product_id']);
if(isset($_GET['remove'])){
    // unset($_SESSION['product_id'][$_GET['remove']]);
    
    foreach($_SESSION['product_id'] as $key=>$row){
        if($row['id'] == $_GET['remove']){
          unset($_SESSION['product_id'][$key]);
            header("Location: ./cart.php");
          exit();
        }
    }  


}


if(isset($_GET['product_id']) && isset($_GET['qty'])){
    $product_id = $_GET['product_id'];
    $qty = $_GET['qty'];
    foreach($_SESSION['product_id'] as $key=>$row){
        if($row['id'] == $product_id){
             $_SESSION['product_id'][$key]['quantity'] = $qty;
        }
    }
}

$sessionId = session_id();
if(isset($_POST['quantity'])){
    foreach($_POST['quantity'] as $id=>$quant){
        $order_sql = "update glassBuy_order_accessories set quantity='$quant' where accessoryId='$id' and sessionId='$sessionId';";
        if($con->query($order_sql) === TRUE){
        }
    
    }
}



$assTotal = 0;
$myaccessories = array();
$rows = getAll($con, "select * from glassBuy_order_accessories a inner join glassBuy_glasses g on g.glass_id=a.accessoryId where sessionId='$sessionId' and quantity>0");
foreach($rows as $row){
    $myaccessories[$row['accessoryId']] = array($row['title'], $row['price'], $row['quantity']);
    $assTotal+=$row['price']* $row['quantity'];
}



if(isset($_GET['accessoryId'])){
    $accessoryId = mb_htmlentities($_GET['accessoryId']);
    $id = generateRandomString();
    $quantity = 1;
    if(count($myaccessories[$accessoryId])>1){
        $quantity = $myaccessories[$accessoryId][2];
    }
    $order_sql = "INSERT INTO glassBuy_order_accessories(id,accessoryId,sessionId,orderId, quantity) VALUES('$id','$accessoryId','$sessionId', '', '$quantity')";
    if($con->query($order_sql) === TRUE){
    }
    header("location: ?");
        
}



// $couponDeets['discount'] = 0;
if(isset($_POST['coupon'])){
    $coupon = mb_htmlentities($_POST['coupon']);
    $pro ="SELECT * FROM glassBuy_coupons WHERE coupon='$coupon' and status='active'";
    $product_data = $con->query($pro);
    if($product_data->num_rows > 0){
        $couponDeets = $product_data->fetch_assoc();;
        $_SESSION['coupon_used'] = $coupon;
        $_SESSION['coupon_discount'] = $couponDeets['discount'];
        $m = "Coupon activated successfully";
        
        $pro ="update glassBuy_coupons set timesUsed=timesUsed+1 WHERE coupon='$coupon'";
        $con->query($pro);
        
    }else{
        $m = "Coupon Code is not valid.";
    }
    
}


?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <?php require("./includes/comman/cart/head.php");?>
   <style>
      .owl-carousel .owl-item img {
    display: block;
    width: 100%;
    max-height: 300px;
}
  </style>
</head>
<body class="home page-template-default page page-id-2 theme-bb-theme fl-builder woocommerce-no-js fl-theme-builder-header fl-theme-builder-footer woo-variation-swatches wvs-theme-bb-theme-child wvs-theme-child-bb-theme wvs-style-squared wvs-attr-behavior-blur wvs-tooltip wvs-css fl-framework-base fl-preset-default fl-full-width fl-scroll-to-top fl-search-active" itemscope="itemscope" itemtype="https://schema.org/WebPage">
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJ5Q9NM" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <a aria-label="Skip to content" class="fl-screen-reader-text" href="#fl-main-content">Skip to content</a>
  <div class="fl-page">
   <?php require("./includes/header.php");?>

    <div id="fl-main-content" class="fl-page-content" itemprop="mainContentOfPage" role="main">
    <div class="fl-content-full container">
        <div class="row">
            <div class="fl-content col-md-12">
                <article class="fl-post post-313 page type-page status-publish hentry" id="fl-post-313" itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
                    <div class="fl-post-content clearfix" itemprop="text">
                        <div class="fl-builder-content fl-builder-content-313 fl-builder-content-primary fl-builder-global-templates-locked" data-post-id="313">
                            <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5ebe37552550a" data-node="5ebe37552550a">
                                <div class="fl-row-content-wrap">
                                    <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                        <div class="fl-col-group fl-node-5ebe3755289d5" data-node="5ebe3755289d5">
                                            <div class="fl-col fl-node-5ebe375528b17" data-node="5ebe375528b17">
                                                <div class="fl-col-content fl-node-content">
                                                    <div class="fl-module fl-module-separator fl-node-5ebe375525175" data-node="5ebe375525175">
                                                        <div class="fl-module-content fl-node-content">
                                                            <div class="fl-separator"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fl-row fl-row-fixed-width fl-row-bg-none fl-node-5ebe364c3e28a" data-node="5ebe364c3e28a">
                                <div class="fl-row-content-wrap">
                                    <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                        <div class="fl-col-group fl-node-5ebe364c3e18f" data-node="5ebe364c3e18f">
                                            <div class="fl-col fl-node-5ebe364c3e1d3" data-node="5ebe364c3e1d3">
                                                <div class="fl-col-content fl-node-content">
                                                    <div class="fl-module fl-module-pp-heading fl-node-5ebe364c3e24f" data-node="5ebe364c3e24f">
                                                        <div class="fl-module-content fl-node-content">
                                                            <div class="pp-heading-content">
                                                                <div class="pp-heading pp-left">
                                                                    <h2 class="heading-title">
                                                                        <span class="title-text pp-primary-title">Your Cart</span>
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="fl-module fl-module-rich-text fl-node-5ebe364c3e214" data-node="5ebe364c3e214">
                                                        <div class="fl-module-content fl-node-content">
                                                            <div class="fl-rich-text">
                                                                <p></p>
                                                                <div class="woocommerce">
                                                                    <div class="woocommerce-notices-wrapper">
                                                                        
                                                                    	<div class="woocommerce-message" role="alert">
                                                                    		<a href="./shop.php" tabindex="1" class="button wc-forward">Continue shopping</a> Cart Updated
                                                                    		</div>
                                                                    </div>
                                                                    
                                                                    
                                                                    <?if(count($_SESSION['product_id'])>0){?>
                                                                    
                                                                    <div class="woocommerce-cart-form" action="" method="post">
                                                                        <div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                                                           
                                                                           
                                                                            <?
                                                                            

                                                                            $subbtotal = 0;
                                                                            $Prescription_Lenses_cost_total =0; 
                                                                            foreach($_SESSION['product_id'] as $pidinfo){
                                                                                
                                                                                $pid = $pidinfo['id'];
                                                                                
                                                                                $Prescription_Lenses_cost = 0;
                                                                                if($pidinfo['lensType']=="Ultimate Anti Reflection"){
                                                                                    $Prescription_Lenses_cost = 25;
                                                                                }
                                                                                $Prescription_Lenses_cost_total+=$Prescription_Lenses_cost;


                                                                            	$sql ="SELECT * FROM glassBuy_glass_picture WHERE glass_id='$pid'";
                                                                                      $img_data = $con->query($sql);
                                                                                      if($img_data->num_rows > 0){
                                                                                          $rows = $img_data->fetch_assoc();
                                                                                          $img = $rows['name'];
                                                                                      }
                                                                            	
                                                                            	$pro ="SELECT * FROM glassBuy_glasses WHERE glass_id='$pid'";
                                                                                    $product_data = $con->query($pro);
                                                                                    if($product_data->num_rows > 0){
                                                                                       $rowd = $product_data->fetch_assoc();
                                                                                       $p_name = $rowd['title'];
                                                                                       $p_price = $rowd['price'];
                                                                            		   $desc = $rowd['additional_info'];
                                                                            		   $subbtotal+=(($p_price+$Prescription_Lenses_cost)*$pidinfo['quantity']);
                                                                                    }
                                                                                                                                                    
                                                                            ?>
                                                                           
                                                                            <div class="product-container">
                                                                           
                                                                           <?if($p_name!=""){?>      <div class="header-area">
                                                                                    <div class="prescription-name"></div>
                                                                                    <div class="product-removea">
                                                                                        <a
                                                                                            href="?remove=<?echo $pid?>"
                                                                                            class="removea"
                                                                                        >
                                                                                            <!--<img src="./wp-content/uploads/2020/08/del-icon.png">-->
                                                                                            Remove
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="product-inner-container">
                                                                                    <div class="product-thumbnail">
                                                                                        <a href="uploads/<?php echo $img; ?>">
                                                                                            <img
                                                                                                src="uploads/<?php echo $img; ?>"
                                                                                                class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                                                                alt=""
                                                                                                loading="lazy"
                                                                                                srcset="
                                                                                                    uploads/<?php echo $img; ?>    750w,
                                                                                                    uploads/<?php echo $img; ?>  1640w,
                                                                                                    uploads/<?php echo $img; ?>    300w,
                                                                                                    uploads/<?php echo $img; ?>  1024w,
                                                                                                    uploads/<?php echo $img; ?>     150w,
                                                                                                    uploads/<?php echo $img; ?>    768w,
                                                                                                    uploads/<?php echo $img; ?>  1536w,
                                                                                                    uploads/<?php echo $img; ?> 2048w
                                                                                                "
                                                                                                sizes="(max-width: 750px) 100vw, 750px"
                                                                                                width="750"
                                                                                                height="420"
                                                                                            />
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="products-section">
                                                                                        <div class="product-detail">
                                                                                            <div class="product-name">
                                                                                                <span class="item-title"><?php echo $p_name; ?></span>
                                                                                                <dl class="variation">
                                                                                                    <dt class="variation-Size">Size:</dt>
                                                                                                    <dd class="variation-Size"><p><?echo $rowd['available_sizes']?></p></dd>
                                                                                                    <dt class="variation-Colour">Colour:</dt>
                                                                                                    <dd class="variation-Colour"><p><?echo $rowd['colour']?></p></dd>
                                                                                                </dl>
                                                                                            </div>
                                                                                            <div class="product-price">
                                                                                                <span class="woocommerce-Price-amount amount">
                                                                                                    <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $p_price; ?>.00</bdi>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="product-detail prescription-item" style="display:none;">
                                                                                            <div class="product-name">
                                                                                                <span class="item-title">Prescription Lenses</span>
                                                                                                <div class="detail-txt">Details</div>
                                                                                            </div>
                                                                                            <div class="product-price">
                                                                                                <span class="woocommerce-Price-amount amount">
                                                                                                    <bdi><span class="woocommerce-Price-currencySymbol">$</span>25.00</bdi>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="detail-section">
                                                                                            <div class="product-detail">
                                                                                                <div class="product-name">
                                                                                                    <span class="item-title">
                                                                                                        <dl class="component">
                                                                                                            <dt class="component-Vision">Vision:</dt>
                                                                                                            <dd class="component-Vision"><p>No Prescription</p></dd>
                                                                                                        </dl>
                                                                                                    </span>
                                                                                                </div>
                                                                                                <div class="product-price">
                                                                                                    <span class="component_table_item_price">
                                                                                                        <span class="woocommerce-Price-amount amount">
                                                                                                            <bdi><span class="woocommerce-Price-currencySymbol">$</span>0.00</bdi>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="product-detail">
                                                                                                <div class="product-name">
                                                                                                    <span class="item-title">
                                                                                                        <dl class="component">
                                                                                                            <dt class="component-LensType">Lens Type:</dt>
                                                                                                            <dd class="component-LensType"><p>Clear</p></dd>
                                                                                                        </dl>
                                                                                                    </span>
                                                                                                </div>
                                                                                                <div class="product-price">
                                                                                                    <span class="component_table_item_price">
                                                                                                        <span class="woocommerce-Price-amount amount">
                                                                                                            <bdi><span class="woocommerce-Price-currencySymbol">$</span>0.00</bdi>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="product-detail">
                                                                                                <div class="product-name">
                                                                                                    <span class="item-title">
                                                                                                        <dl class="component">
                                                                                                            <dt class="component-Enhance">Enhance:</dt>
                                                                                                            <dd class="component-Enhance"><p>Ultimate Anti Reflection</p></dd>
                                                                                                        </dl>
                                                                                                    </span>
                                                                                                </div>
                                                                                                <div class="product-price">
                                                                                                    <span class="component_table_item_price">
                                                                                                        <span class="woocommerce-Price-amount amount">
                                                                                                            <bdi><span class="woocommerce-Price-currencySymbol">$</span>25.00</bdi>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="edit-prescription">
                                                                                                <a
                                                                                                    class="edit_composite_in_cart_text edit_in_cart_text"
                                                                                                    href="https://directvisioneyewear.ca/product/prescription-lenses/?wccp_component_selection%5B1584107434%5D=389&amp;wccp_component_selection%5B1584107435%5D&amp;wccp_component_selection%5B1584107436%5D=391&amp;wccp_component_selection%5B1584107438%5D&amp;wccp_component_selection%5B1584107439%5D=403&amp;wccp_component_quantity%5B1584107434%5D=1&amp;wccp_component_quantity%5B1584107435%5D=1&amp;wccp_component_quantity%5B1584107436%5D=1&amp;wccp_component_quantity%5B1584107438%5D=1&amp;wccp_component_quantity%5B1584107439%5D=1&amp;quantity=1&amp;update-composite=c0aad098b3c8d9c3dfdb0e3e0432ab77&amp;product_id=21464&amp;variation_id=21465"
                                                                                                >
                                                                                                    <small>Edit Lenses</small>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    <form action="" method="get">
                                                                                      <input onchange="calculateCost();" name="qty" value="<?echo $pidinfo['quantity']?>" min="1" class="form-control calc-quantity" id="asd" required style=" width: 80px;margin-left: 5px;" type="number">
                                                                                      <input name="product_id" value="<?echo $pid?>" hidden>
                                                                                      <input  value="<?echo $p_price?>" class="calc-cost" hidden>
                                                                                      <button type="submit" class="button">Update Cart</button>
                                                                                    </form>

                                                                                        <div class="subtotal-area">
                                                                                            
                                                                                            <div class="subtotal-wrapper">
                                                                                                <div class="subtotal_text">Subtotal</div>
                                                                                                <div class="subtotal_amount">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><span class="calc-total-price"><?php echo $p_price; ?></span>.00</bdi>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                        <?if($pidinfo['frame-only']!="frame-only"){?>
                                                                                        <div class="subtotal-area">
                                                                                            
                                                                                            <div class="subtotal-wrapper">
                                                                                                <div class="subtotal_text">Prescription Lense</div>
                                                                                                <div class="subtotal_amount">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $Prescription_Lenses_cost_total; ?>.00</bdi>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?}?>
                                                                                        
                                                                                        
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <?}?>
                                                                            </div>
                                                                            
                                                                            <?}?>
                                                                            
                                                                            
                                                                            
                                                                            <div class="pp-heading pp-left">
                                                                    <h2 class="heading-title">
                                                                        <span class="title-text pp-primary-title">Add the following accessories to your order.</span>
                                                                    </h2>
                                                                </div>
                                                                
                                                                             <div class="row">
                                                                                 <?php 
                                                                                 $sql ="SELECT * FROM glassBuy_glasses where productCategory='Accessories' limit 3";
                                                                                $result = $con->query($sql);
                                                                                  if ($result->num_rows > 0) {
                                                                                      while($row = $result->fetch_assoc()) {
                                                                                       $id = $row['glass_id'];  
                                                                                    $sql ="SELECT * FROM glassBuy_glass_picture WHERE glass_id='$id'";
                                                                                          $img_data = $con->query($sql);
                                                                                          if($img_data->num_rows > 0){
                                                                                              $row1 = $img_data->fetch_assoc();
                                                                                              $img = $row1['name'];
                                                                                          }
                                                                                          else{
                                                                                            $img = "https://dummyimage.com/600x400/000/fff.jpg";
                                                                                          }
                                                                                          //$img_row = $img_data->fetch_assoc();
                                                                                       ?>
                                                                                 <div class="col-md-4 <?if(count($myaccessories[$id])==2){echo ' img-thumbnail';}?>">
                                                                                     <div class="pp-content-post pp-content-carousel-post pp-grid-custom post-<?php echo $id; ?> product type-product status-publish has-post-thumbnail product_cat-collection product_cat-glasses product_cat-men-glasses product_cat-pz-optical-glasses product_cat-women-glasses pa_brand-pz-optical pa_collection-glasses pa_colour-brown-light-brown pa_gender-men pa_gender-women pa_material-plastic pa_primary-colour-brown pa_shape-cat-eye pa_size-54-17-140 pa_supplier-direct-vision pa_virtual-try-on-yes first instock sold-individually taxable shipping-taxable purchasable product-type-variable" itemscope data-id="<?php echo $id; ?>">
                                                                                        <a style="margin: 1px auto;
justify-content: center;
display: flex;" href="./cart.php?accessoryId=<?echo $id?>" class="btn btn-primary button">Add to Cart</a>
                                                                                        <div  class="prod-img">
                                                                                            <a target="_blank" href="./product.php?id=<?echo $id?>" title="">
                                                                                                <img width="750" height="1400" src="uploads/<?php echo $img; ?>" class=" wp-post-image" alt="" loading="lazy" itemprop="image"></a>
                                                                                        </div>
                                                                                        <h3 class="prod-title"><a target="_blank" href="./product.php?id=<?echo $id?>" title=""><?php echo $row['title']; ?></a></h3>
                                                                                        <span class="prod-price">
                                                                                           <span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $row['price']; ?></bdi></span></span>
                                                                                       </span>
                                                                                       <span class="extras"><?php echo $row['additional_info']; ?></span>
                                                                                   </div>
                                                                                 </div>
                                                                                 <?}}?>
                                                                             </div>
                                                                            

                                                                        </div>

                                                                        <div class="cart-side-area">
                                                                            <div class="cart-collaterals">
                                                                                <div class="cart_totals">
                                                                                    <h2>Cart totals</h2>
                                                                                    <form action="" method='post'>
                                                                                         <button  style="width: 100%;" type="submit" class="checkout-button button"> Update Cart</button>
                                                                                    <table class="shop_table shop_table_responsive" cellspacing="0">
                                                                                        <tbody>
                                                                                            <tr class="cart-subtotal">
                                                                                                <th>Subtotal</th>
                                                                                                <td data-title="Subtotal">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><span class="calc-total-price"><?echo $subbtotal?></span></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <?if($Prescription_Lenses_cost_total!=0){?>
                                                                                            <!--<tr class="cart-subtotal">-->
                                                                                            <!--    <th>Prescription Lenses</th>-->
                                                                                            <!--    <td data-title="Subtotal">-->
                                                                                            <!--        <span class="woocommerce-Price-amount amount">-->
                                                                                            <!--            <bdi><span class="woocommerce-Price-currencySymbol">$</span><?echo $Prescription_Lenses_cost_total?></bdi>-->
                                                                                            <!--        </span>-->
                                                                                            <!--    </td>-->
                                                                                            <!--</tr>-->
                                                                                            <?}?>
                                                                                            
                                                                                            

                                                                                            <tr class="woocommerce-shipping-totals shipping">
                                                                                                <th>
                                                                                                    Shipping<br />
                                                                                                </th>
                                                                                                <td data-title="Shipping"><span class="woocommerce-Price-amount amount">$ 9</span></td>
                                                                                            </tr>
                                                                                            <?
                                                                                            
                                                                                            foreach($myaccessories as $i=>$ass){
                                                                                                // var_dump($ass);
                                                                                            ?>
                                                                                            <tr class="woocommerce-shipping-totals shipping">
                                                                                                <th style="width:100% !important">
                                                                                                    <div style="display: flex;flex-flow: row wrap;align-items: center;">
                                                                                                        <label for="asd"><?echo $ass[0]?></label>
                                                                                                        <input name="quantity[<?echo $i?>]" value="<?echo $ass[2]?>" min="0" class="form-control" id="asd" required style="    width: 60px;margin-left: 5px;" type="number">
                                                                                                    </div>
                                                                                                </th>
                                                                                                <td data-title="<?echo $ass[0]?>"><span class="woocommerce-Price-amount amount">$ <?$a =  $ass[1] * $ass[2];
                                                                                                $subbtotal+= $a;
                                                                                                echo $a;
                                                                                                
                                                                                                ?></span></td>
                                                                                            </tr>
                                                                                            <?}?>
                                                                                            <tr class="tax-total">
                                                                                                <th>Tax</th>
                                                                                                <td data-title="Tax">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><span class="calc-tax"><?echo $tax = round(($subbtotal * 0.04712), 2)?></span></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr class="tax-total">
                                                                                                <th>Discount</th>
                                                                                                <td data-title="Tax">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">- $</span><?
                                                                                                        $discount = round(($_SESSION['coupon_discount']/100) * ($subbtotal+$assTotal), 2);
                                                                                                        
                                                                                                        echo $discount?></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>

                                                                                            <tr class="order-total">
                                                                                                <th>Order Total</th>
                                                                                                <td data-title="Total">
                                                                                                    <strong>
                                                                                                        <span class="woocommerce-Price-amount amount">
                                                                                                            <bdi><span class="woocommerce-Price-currencySymbol">$</span><span class="calc-total-order"><?echo round(($tax+ $subbtotal + 9 + $assTotal) - $discount, 2)?></span></bdi>
                                                                                                        </span>
                                                                                                    </strong>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    
                                                                                    <div class="wc-proceed-to-checkout">
                                                                                       
                                                                                       
                                                                                    </div>
                                                                                    
                                                                                    
                                                                                    
                                                                                    </form>
                                                                                    <div class="wc-proceed-to-checkout">
                                                                                        <form action="./checkout.php" method="get">
                                                                                            <button  style="width: 100%;" type="submit" class="checkout-button button alt wc-forward"> Proceed to checkout</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <style>
                                                                                .coupon > label::after {
    float: right;
    content: '+';
    font-size: 30px;
    color: #333;
    font-weight: 400;
}

.woocommerce table.shop_table_responsive tbody th, .woocommerce-page table.shop_table_responsive tbody th {
    display: block !important;
}

                                                                            </style>
                                                                           <!-- <div class="coupon">
                                                                                <form action="" method="post">
                                                                                <label for="coupon">Have a coupon code?</label>
                                                                                <div class="coupon-fields">
                                                                                    <input type="text" name="coupon" class="input-text" id="coupon" value="" placeholder="Enter code here" />
                                                                                    <button type="submit" class="button" name="apply" value="Apply">Apply</button>
                                                                                </div>
                                                                                </form>
                                                                            </div>-->
                                                                            <form action="" method="post">
                                                                            <div class="coupon">
                                                                                <label for="coupon_code">Have a coupon code?</label>
                                                                                <div class="coupon-fields" style="display: none;">
                                                                                    <input type="text" name="coupon" class="input-text" id="coupon_code" value="" placeholder="Enter code here">
                                                                                    <button type="submit" class="button" name="apply" value="Apply">Apply</button>
                                                                                </div>
                                                                            </div>
                                                                            </form>
                                                                            
                                                                            <?if($m!=""){?>
                                                                        <div class="woocommerce-message" role="alert">
                                                                    		<?echo $m?>
                                                                    		</div>
                                                                        <?}?>

                                                                        </div>
                                                                    </div>

                                                                    <script>
                                                                        (function ($) {
                                                                            $(".remove")
                                                                                .off("click", ".remove")
                                                                                .on("click", function () {
                                                                                    gtag("event", "remove_from_cart", {
                                                                                        items: [
                                                                                            {
                                                                                                id: $(this).data("product_sku") ? $(this).data("product_sku") : "#" + $(this).data("product_id"),
                                                                                                quantity: $(this).parent().parent().find(".qty").val() ? $(this).parent().parent().find(".qty").val() : "1",
                                                                                            },
                                                                                        ],
                                                                                    });
                                                                                });
                                                                        })(jQuery);
                                                                    </script>
                                                                    <?}else{?>
                                                                    
                                                                    <p class="cart-empty woocommerce-info">Your cart is currently empty.</p>
                                                                    <p class="return-to-shop">
                                                                		<a class="button wc-backward" href="./shop.php">
                                                                			Return to shop		</a>
                                                                	</p>
                                                                    <?}?>
                                                                    
                                                                    
                                                                    
                                                                </div>
                                                                <p></p>
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
<?php require("./includes/comman/cart/footerjs.php");?>
<!-- WooCommerce JavaScript -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function calculateCost(){
        qties = $(".calc-quantity");
        coststies = $(".calc-cost");
        total  = 0;
        for(var i=0; i<qties.length; i++){
            console.log("aa", parseFloat($(qties[i]).val()) ,  parseFloat($(coststies[i]).val()) )
            
            total+= (parseFloat($(qties[i]).val()) * parseFloat($(coststies[i]).val()))
        }
        console.log("total", total)
        
        tax = Math.round(0.04712* total);
        total = Math.round(total);
        $(".calc-total-price").text(total)
        $(".calc-tax").text(tax)
        $(".calc-total-order").text(total+tax+9)
    }
</script>
</body>
</html>