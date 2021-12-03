<?php include_once("global.php");

include_once("database.php");

$s = mb_htmlentities($_GET['s']);
$color = mb_htmlentities($_GET['color']);
$shape = mb_htmlentities($_GET['shape']);
$gender = mb_htmlentities($_GET['gender']);
$material = mb_htmlentities($_GET['material']);
$brand = mb_htmlentities($_GET['brand']);
$collection = mb_htmlentities($_GET['_collection']);
if($collection!="Accessories"){
    $collection = "Glasses";
}

$ratingCount = array();
$temp = getAll($con, "SELECT AVG(rating) avg, r.glassId, count(rating) cnt from glassBuy_glass_reviews r GROUP by r.glassId");
foreach($temp as $row){
    $ratingCount[$row['glassId']] = array(round($row['avg'], 1), $row['cnt']);
}

$sql ="SELECT * FROM glassBuy_glasses g where g.title like '%$s%' and  g.color1 like '%$color%' and  g.gender like '%$gender%' and  g.shape like '%$shape%' and  g.material like '%$material%' and  g.brand like '%$brand%' and productCategory like '%$collection%'";
// echo $sql;
$result = $con->query($sql);

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <?php require("./includes/comman/shop/head.php");?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
  <style>
      
      
      @media screen and (max-width: 480px) {
            #filteroptions{
              display:none;
            }
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
    <div class="fl-builder-content fl-builder-content-561 fl-builder-global-templates-locked" data-post-id="561">
        <div class="fl-row fl-row-fixed-width fl-row-bg-color fl-node-5eb402e784d71 fl-row-custom-height fl-row-align-center listing-banner" data-node="5eb402e784d71">
            <div class="fl-row-content-wrap">
                <div class="fl-row-content fl-row-fixed-width fl-node-content">
                    <div class="fl-col-group fl-node-5eb402e784bbe fl-col-group-equal-height fl-col-group-align-center" data-node="5eb402e784bbe">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5eb3b3972b87a filters-holder" data-node="5eb3b3972b87a">
            <div class="fl-row-content-wrap" id="filteroptions" >
                <form action="" method="get">
                    <div class="fl-row-content fl-row-fixed-width fl-node-content">
                    <div class="fl-col-group fl-node-5eb90202de3d1" data-node="5eb90202de3d1">
                        <div class="fl-col fl-node-5eb90202de51f filters-selection" data-node="5eb90202de51f">
                            <div class="fl-col-content fl-node-content">
                                <div class="fl-module fl-module-pp-smart-button fl-node-5eb3ca9f8ee37 fl-visible-mobile clear-filters-link" data-node="5eb3ca9f8ee37">
                                    <div class="fl-module-content fl-node-content">
                                        <a href="?">
                                        <div class="pp-button-wrap pp-button-width-auto">
                                            <button class="pp-button" role="button" aria-label="Clear all filters X">
                                                <span  class="pp-button-text">Clear all filters X</span>
                                            </button>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                <script>
                                    jQuery(".pp-button[aria-label='Clear all filters X']").click(function() {
                                          window.location="?"
                                        })
                                    
                                </script>
                                <div class="fl-module fl-module-class-selections fl-node-5eb90219e8bcd fl-visible-mobile" data-node="5eb90219e8bcd">
                                    <div class="fl-module-content fl-node-content">
                                        <div class="facetwp-selections"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fl-col-group fl-node-5eb3b3972eefa fl-col-group-custom-width" data-node="5eb3b3972eefa">
                        <div class="fl-col fl-node-5eb3b3972f051 fl-col-small filters-col" data-node="5eb3b3972f051">
                            <div class="fl-col-content fl-node-content">
                                <div class="fl-module fl-module-class-facet fl-node-5eb3b3972b6f2 collection" data-node="5eb3b3972b6f2">
                                    <div class="fl-module-content fl-node-content">
                                        <div class="facetwp-bb-module">
                                            <h4 class="facetwp-facet-title">Type</h4>
                                            <div class="facetwp-facet facetwp-facet-collection facetwp-type-checkboxes" data-name="collection" data-type="checkboxes">
                                                <div class="facetwp-checkbox" data-value="glasses">Glasses <span class="facetwp-counter">(32)</span></div>
                                                <div class="facetwp-checkbox" data-value="sunglasses">Sunglasses <span class="facetwp-counter">(2)</span></div>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                    <div class="fl-module-content fl-node-content">
                                        <div class="facetwp-bb-module">
                                            <h4 class="facetwp-facet-title">PD Range</h4>
                                            
                                            <div class="s" data-name="collection" data-type="checkboxes">
                                               
                                               <div class="row" style="width: 200px;">
                                                   
                                                <div class="col-md-6">
                                                     <input class="form-control" placeholder="Start">
                                                </div>
                                                <div class="col-md-6">
                                                    <button class="btn" type="submit">Apply</button>
                                                </div>
                                            </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                </div>
                                <div class="fl-module fl-module-class-facet fl-node-5eb3b3d67ba95 gender" data-node="5eb3b3d67ba95">
                                    <div class="fl-module-content fl-node-content">
                                        <div class="facetwp-bb-module">
                                            <h4 class="facetwp-facet-title">Gender</h4>
                                            <div class="facetwp-facet facetwp-facet-gender facetwp-type-checkboxes" data-name="gender" data-type="checkboxes">
                                                <div class="facetwp-checkbox" data-value="men">Men <span class="facetwp-counter">(24)</span></div>
                                                <div class="facetwp-checkbox" data-value="women">Women <span class="facetwp-counter">(27)</span></div>
                                                <div class="facetwp-checkbox" data-value="unisex">Unisex <span class="facetwp-counter">(27)</span></div>
                                                
                                                
                                            
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fl-col fl-node-5eb3b9be56038 text-right filters-col" data-node="5eb3b9be56038">
                            <div class="fl-col-content fl-node-content">
                                <div class="fl-module fl-module-pp-smart-button fl-node-5eb8f42d32196 fl-visible-desktop-medium clear-filters-link" data-node="5eb8f42d32196">
                                    <div class="fl-module-content fl-node-content">
                                        <div class="pp-button-wrap pp-button-width-auto">
                                            <a href="?" target="_self" class="pp-button" role="button" aria-label="Clear all filters X">
                                                <span class="pp-button-text">Clear all filters X</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="fl-module fl-module-class-facet fl-node-5eb3b9be5619e colour grouped" data-node="5eb3b9be5619e">
                                    <div class="fl-module-content fl-node-content">
                                        <div class="facetwp-bb-module">
                                            <!--<h4 class="facetwp-facet-title">Colour</h4>-->
                                            <select class=" form-control" name="colour" data-type="checkboxes" style="overflow: hidden; outline: currentcolor none medium;" tabindex="1">
                                                <option value="">Select Color</option>
                                                <?$cols = getAll($con, "SELECT * from glassBuy_glasses g group by g.colour;");
                                                foreach( $cols as $col ){?>
                                                <option><?echo $col['colour']?></option>
                                                <?}?>
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="fl-module fl-module-class-facet fl-node-5eb3b9be561d9 shape grouped" data-node="5eb3b9be561d9">
                                    <div class="fl-module-content fl-node-content">
                                        <div class="facetwp-bb-module">
                                            <select class=" form-control" name="shape"  data-type="checkboxes" style="overflow: hidden; outline: currentcolor none medium;" tabindex="1">
                                                <option value="">Select Shape</option>
                                                <?$cols = getAll($con, "SELECT * from glassBuy_glasses g group by g.shape;");
                                                foreach( $cols as $col ){?>
                                                <option><?echo $col['shape']?></option>
                                                <?}?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="fl-module fl-module-class-facet fl-node-5eb3b9be56216 material grouped" data-node="5eb3b9be56216">
                                    <div class="fl-module-content fl-node-content">
                                        <div class="facetwp-bb-module">
                                            <select class=" form-control" name="material"  data-type="checkboxes" style="overflow: hidden; outline: currentcolor none medium;" tabindex="1">
                                                <option value="">Select Material</option>
                                                <?$cols = getAll($con, "SELECT * from glassBuy_glasses g group by g.material;");
                                                foreach( $cols as $col ){?>
                                                <option><?echo $col['material']?></option>
                                                <?}?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="fl-module fl-module-class-facet fl-node-5eb3b9be56253 brand grouped" data-node="5eb3b9be56253">
                                    <div class="fl-module-content fl-node-content">
                                        <div class="facetwp-bb-module">
                                            <select class=" form-control" name="brand"  data-type="checkboxes" style="overflow: hidden; outline: currentcolor none medium;" tabindex="1">
                                                <option value="">Select Brand</option>
                                                <?$cols = getAll($con, "SELECT * from glassBuy_glasses g group by g.brand;");
                                                foreach( $cols as $col ){?>
                                                <option><?echo $col['brand']?></option>
                                                <?}?>
                                            </select>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5eb5586d82bb5 fl-visible-mobile" data-node="5eb5586d82bb5">
            <div class="fl-row-content-wrap">
                <div class="fl-row-content fl-row-fixed-width fl-node-content">
                    <div class="fl-col-group fl-node-5eb5586d8c170" data-node="5eb5586d8c170">
                        <div class="fl-col fl-node-5eb5586d8c381" data-node="5eb5586d8c381">
                            <div class="fl-col-content fl-node-content">
                                <div class="fl-module fl-module-pp-smart-button fl-node-5eb5507c94cce filters-btn" data-node="5eb5507c94cce">
                                    <div class="fl-module-content fl-node-content">
                                        <div class="pp-button-wrap pp-button-width-full">
                                            <a href="#" target="_self" class="pp-button" role="button" aria-label="Filter Results" onclick="toggleFilters();">
                                                <span class="pp-button-text">Filter Results</span>
                                            </a>
                                            <style>
                                                .filters-btn a.pp-button span::after {
    content: "\f106";
    font-family: 'FontAwesome';
    position: absolute;
    right: 0;
    top: 0;
    font-size: 18px;
    -webkit-transition: all .5s;
    -o-transition: all .5s;
    -moz-transition: all .5s;
    transition: all .5s;
    line-height: 1.3;
    display: none;
}
                                            </style>
                                            <script>
                                            function toggleFilters(){
                                                jQuery("#filteroptions").toggle()
                                            }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5eb3e24756483 sorting-bar" data-node="5eb3e24756483">
            <div class="fl-row-content-wrap">
                <div class="fl-row-content fl-row-fixed-width fl-node-content">
                    <div class="fl-col-group fl-node-5eb3ed1d7322e" data-node="5eb3ed1d7322e">
                        <div class="fl-col fl-node-5eb3ed1d73346" data-node="5eb3ed1d73346">
                            <div class="fl-col-content fl-node-content">
                                <div class="fl-module fl-module-separator fl-node-5eb3ed1d73153 fl-visible-desktop-medium" data-node="5eb3ed1d73153">
                                    <div class="fl-module-content fl-node-content">
                                        <div class="fl-separator"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fl-col-group fl-node-5eb3e2475a27a fl-col-group-custom-width" data-node="5eb3e2475a27a">
                        <div class="fl-col fl-node-5eb3e2475a3c7 fl-col-small" data-node="5eb3e2475a3c7">
                            <div class="fl-col-content fl-node-content">
                                <div class="fl-module fl-module-fl-woo-breadcrumb fl-node-5eb3e26aa655c" data-node="5eb3e26aa655c">
                                    <div class="fl-module-content fl-node-content">
                                        <nav class="woocommerce-breadcrumb"><a href="https://directvisioneyewear.ca">Home</a>&nbsp;/&nbsp;Shop</nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <!-- <div class="fl-col fl-node-5eb3e2475a40e fl-col-small" data-node="5eb3e2475a40e">
                            <div class="fl-col-content fl-node-content">
                                <div class="fl-module fl-module-class-sort fl-node-5eb3e2c5508fe" data-node="5eb3e2c5508fe">
                                    <div class="fl-module-content fl-node-content">
                                        <div class="facetwp-sort">
                                            <select class="facetwp-sort-select">
                                                <option value="default">Sort by</option>
                                                <option value="title_asc">Name (A-Z)</option>
                                                <option value="title_desc">Name (Z-A)</option>
                                                <option value="price">Price (Low to high)</option>
                                                <option value="price-desc">Price (High to low)</option>
                                                <option value="popularity" selected="selected">Popularity</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <style>
            .prod-img{
                position:relative;
            }
        </style>
        <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5eb3b905a7304" data-node="5eb3b905a7304">
            <div class="fl-row-content-wrap">
                <div class="fl-row-content fl-row-fixed-width fl-node-content">
                    <div class="fl-col-group fl-node-5eb3b905a93ee" data-node="5eb3b905a93ee">
                        <div class="fl-col fl-node-5eb3b905a9520" data-node="5eb3b905a9520">
                            <div class="fl-col-content fl-node-content">
                                <div class="fl-module fl-module-pp-content-grid fl-node-5eb3ee5b573bf prod-listing products-listing facetwp-template facetwp-bb-module" data-node="5eb3ee5b573bf" style="opacity: 1;">
                                    <div class="fl-module-content fl-node-content">
                                        <div class="pp-posts-wrapper pp-posts-initiated">
                                            <div class="pp-content-posts">
                                                <div class="pp-content-post-grid pp-equal-height clearfix" itemscope="itemscope" itemtype="https://schema.org/Collection" style="position: relative; height: 1077px;">
                                                    <!--fwp-loop-->

                                                     
													    <!-- sandeep code -->                               <?php 
														  if ($result->num_rows > 0) {
															  while($row = $result->fetch_assoc()) {
															   $id = $row['glass_id'];  
															$sql ="SELECT * FROM glassBuy_glass_picture WHERE glass_id='$id'";
																  $img_data = $con->query($sql);
																  if($img_data->num_rows > 0){
																	  $rowd = $img_data->fetch_assoc();
																	  $img = $rowd['name'];
																  }
																  else{
																	$img = "https://dummyimage.com/600x400/000/fff.jpg";
																  }
																  //$img_row = $img_data->fetch_assoc();
															   ?>
                                                    
                                                    <div
                                                        class="pp-content-post pp-content-grid-post pp-grid-custom post-<?php echo $id; ?> product type-product status-publish has-post-thumbnail product_cat-brooklyn-heights-glasses product_cat-collection product_cat-glasses product_cat-women-glasses pa_brand-brooklyn-heights pa_collection-glasses pa_colour-gold pa_gender-women pa_material-metal pa_primary-colour-gold pa_shape-oval pa_size-48-23-145 pa_supplier-direct-vision pa_virtual-try-on-yes first instock sold-individually taxable shipping-taxable purchasable product-type-variable"
                                                        itemscope=""
                                                        data-id=""
                                                        style="visibility: visible; position: relative; left: 0%; top: 0px; height: 309px;"
                                                    >
                                                        <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" itemid="./product.php?id=<?php echo $id; ?>" content="<?php echo $row['title']; ?>" />
                                                        <meta itemprop="datePublished" content="2020-09-01" /><meta itemprop="dateModified" content="2020-11-08" />
                                                        <div itemprop="publisher" itemscope="" itemtype="https://schema.org/Organization"><meta itemprop="name" content="Direct Vision" /></div>
                                                        <div itemscope="" itemprop="author" itemtype="https://schema.org/Person">
                                                            <meta itemprop="url" content="https://directvisioneyewear.ca/author/tlustvup/" /><meta itemprop="name" content="tlustvup" />
                                                        </div>
                                                        <div itemscope="" itemprop="image" itemtype="https://schema.org/ImageObject">
                                                            <meta itemprop="url" content="https://atttpgdeen.cloudimg.io/cdn/n/n/_v1Product_/direct_vision/BROOKLYNHEIGHTS_<?php echo $row['title']; ?>-O-GOLD-48-23-145-Front.jpg" />
                                                            <meta itemprop="width" content="2500" /><meta itemprop="height" content="1400" />
                                                        </div>
                                                        <div itemprop="interactionStatistic" itemscope="" itemtype="https://schema.org/InteractionCounter">
                                                            <meta itemprop="interactionType" content="https://schema.org/CommentAction" /><meta itemprop="userInteractionCount" content="0" />
                                                        </div>
                                                        <div class="product-wrap pt-2">
                                                            <div class="prod-img">
                                                                <?if($ratingCount[$id][0]!=""){?>
                                                                <span style="position: absolute;
background: white;
padding: 4px;
border-radius: 3px;
top: 5px;"><?echo $ratingCount[$id][0]?> stars (<?echo $ratingCount[$id][1]?>)</span>
<?}?>



                                                                <a href="./product.php?id=<?php echo $id; ?>" title="<?php echo $row['title']; ?>">
                                                                    <img
                                                                        src="uploads/<?php echo $img; ?>"
                                                                        class="wp-post-image"
                                                                        alt=""
                                                                        loading="lazy"
                                                                        itemprop="image"
                                                                        width="750"
                                                                        height="1400"
                                                                    />
                                                                </a>
                                                                
                                                                <?if($row['ribboon_text']!=""){?>
                                                                <span style="position: absolute;
background: <?echo $row['ribboon_color']?>;
padding: 4px;
border-radius: 3px;
top: 5px;
color:black;
right:10px;"><?echo $row['ribboon_text']?></span>
<?}?>

                                                            </div>

                                                            <div class="product-text" style="margin-top: 8px;">
                                                                <h3 class="prod-title title-col"><a href="./product.php?id=<?php echo $id; ?>" title="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></a></h3>
                                                                <span class="prod-price">
                                                                    <span class="price">
                                                                        <span class="woocommerce-Price-amount amount">
                                                                            <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $row['price']; ?></bdi>
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                            
                                                            <div class="vto-btns">
                                                                <?if($row['productCategory']!="Accessories"){?>
                                                                <div class="btn-vto"><a href="#" class="try-on" data-try_on="566956">TRY - ON</a></div>
                                                                <?}?>

                                                                <a href="./product.php?id=<?php echo $id; ?>" class="btn-details">Buy Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
													  
													<?php
													  }  //while sandeep
												  }
												  else{
													// NO DATA FOUND
												  }
												?>
												<!-- sandeep code end -->	
													    
														   
														
													 
													
                                                    <div class="pp-grid-space"></div>
                                                </div>

                                                <div class="fl-clear"></div>
                                            </div>
                                            <!-- .pp-content-posts -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- pagination code -->
       <!-- <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5eb3f27087433" data-node="5eb3f27087433">
            <div class="fl-row-content-wrap">
                <div class="fl-row-content fl-row-fixed-width fl-node-content">
                    <div class="fl-col-group fl-node-5eb3f2708b44f" data-node="5eb3f2708b44f">
                        <div class="fl-col fl-node-5eb3f2708b58f" data-node="5eb3f2708b58f">
                            <div class="fl-col-content fl-node-content">
                                <div class="fl-module fl-module-class-pager fl-node-5eb3f27086d62" data-node="5eb3f27086d62">
                                    <div class="fl-module-content fl-node-content">
                                        <div class="facetwp-pager">
                                            <a class="facetwp-page first active" data-page="1">1</a><a class="facetwp-page" data-page="2">2</a><a class="facetwp-page" data-page="3">3</a><a class="facetwp-page last" data-page="4">4</a>
                                            <a class="facetwp-page next" data-page="2">&gt;&gt;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		-->
        
    </div>
</div>

<!-- .fl-page-content -->
<?php require("./includes/footer.php");?>
</div>
<!-- .fl-page -->
<?php// require("./includes/comman/shop/footerjs.php");?>
<style>
    .facetwp-checkbox{
        cursor:pointer;
    }
    .fl-row-full-height.fl-row-align-center .fl-row-content-wrap, .fl-row-custom-height.fl-row-align-center .fl-row-content-wrap {
    align-items: center;
    justify-content: center;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-align: center;
    -ms-flex-pack: center;
    background: url("./images/1155img (7).jpeg");
}

.listing-banner .fl-row-content-wrap::before {
    position: absolute;
    right: 0;
    top: 0;
    width: 457px;
    height: 100%;
    content: '';
    background: none;
        background-size: auto;
    background-size: cover;
}

.fl-node-5eb402e784d71.fl-row > .fl-row-content-wrap {
    padding-top: 150px;
}

.listing-banner .fl-row-content-wrap::after {
    position: absolute;
    right: 0;
    top: 0;
    width: 457px;
    height: 100%;
    content: '';
    background: none;
        background-size: auto;
    background-size: cover;
}
</style>
<script>
    jQuery(".facetwp-checkbox[data-value='glasses']").click(function() {
          window.location="?type=glasses";
        })
        
    jQuery(".facetwp-checkbox[data-value='sunglasses']").click(function() {
          window.location="?type=sunglasses";
        })
</script>
<script>
    jQuery(".facetwp-checkbox[data-value='men']").click(function() {
          window.location="?gender=men";
        })
        
    jQuery(".facetwp-checkbox[data-value='women']").click(function() {
          window.location="?gender=women";
        })
    jQuery(".facetwp-checkbox[data-value='unisex']").click(function() {
          window.location="?gender=unisex";
        })
        
        
</script>
<!-- WooCommerce JavaScript -->
</body>
</html>