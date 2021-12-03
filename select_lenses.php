<?php include_once("global.php");

function formatNum($num) {
    $num = (float) $num; // or (float) if you'd rather
    return (($num >= 0) ? '+' : '') . $num; // implicit cast back to string
}

if(isset($_FILES['webmasterfile'])){
    if(isset($_FILES["webmasterfile"])){
       
        $fileContent = file_get_contents($_FILES['webmasterfile']['tmp_name']);

        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $fileContent));
        
        $filename = generateRandomString().".png";
        file_put_contents('./uploads/'.$filename, $data);
        
        $_SESSION['pdImage'] = $filename;
	
    }
    
}


$id = $_GET['product_id'];
$sql ="SELECT * FROM glassBuy_glass_picture WHERE glass_id='$id'";
$img_data = $con->query($sql);
if($img_data->num_rows > 0){
  $rowd = $img_data->fetch_assoc();
  $img = $rowd['name'];
}
else{
    $img = "https://dummyimage.com/600x400/000/fff.jpg";
}


$sql ="SELECT * FROM glassBuy_glasses where glass_id='$id'";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
    $glassDeets = $row;
}
if($_SESSION['product_id']==""){
    $_SESSION['product_id'] = array();
}
// $_SESSION['product_id'] = array();
if($_GET['frame-btn']=="frame-only"){
    $_SESSION['product_id'][] = array("id"=>$id, "frame-only"=>"frame-only");
    // echo "sad";
    header("Location: ./cart.php");
}

// var_dump($_POST);
if(isset($_POST['wccp_component_selection'])){
    //   echo "submitted";
    // echo "redirecting...";
      $_SESSION['product_id'][] = array(
          "id"=>$id,
          "lensType" => mb_htmlentities($_POST['lensType']),
          "vision" => mb_htmlentities($_POST['vision']),
      );;
    $_SESSION['prescript_data1'] = $_POST;
    $_SESSION['prescript_data1']['pdimage'] = $_SESSION['pdImage'];
    
    if(isset($_FILES)){
       
       move_uploaded_file($_FILES['addon-1584107435-upload-your-prescription-14']['tmp_name'], 'uploads/'.$_FILES['addon-1584107435-upload-your-prescription-14']['name']);
    }
    $_SESSION['file1'] = $_FILES;
    
    header("Location: ./cart.php");
  }
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <?php require("./includes/comman/select_lenses/head.php");?>
  <style>
/*      

.fl-page button:visited, .fl-responsive-preview-content button:visited, .fl-button-lightbox-content button:visited, .fl-page input[type="button"], .fl-responsive-preview-content input[type="button"], .fl-button-lightbox-content input[type="button"], .fl-page input[type="submit"], .fl-responsive-preview-content input[type="submit"], .fl-button-lightbox-content input[type="submit"], .fl-page a.fl-button, .fl-responsive-preview-content a.fl-button, .fl-button-lightbox-content a.fl-button, .fl-page a.fl-button:visited, .fl-responsive-preview-content a.fl-button:visited, .fl-button-lightbox-content a.fl-button:visited, .fl-page a.button, .fl-responsive-preview-content a.button, .fl-button-lightbox-content a.button, .fl-page a.button:visited, .fl-responsive-preview-content a.button:visited, .fl-button-lightbox-content a.button:visited, .fl-page button.button, .fl-responsive-preview-content button.button, .fl-button-lightbox-content button.button, .fl-page button.button:visited, .fl-responsive-preview-content button.button:visited, .fl-button-lightbox-content button.button:visited, .fl-page .fl-page-nav-toggle-button .fl-page-nav .navbar-toggle, .fl-responsive-preview-content .fl-page-nav-toggle-button .fl-page-nav .navbar-toggle, .fl-button-lightbox-content .fl-page-nav-toggle-button .fl-page-nav .navbar-toggle, .fl-page .fl-page-nav-toggle-button .fl-page-nav .navbar-toggle:visited, .fl-responsive-preview-content .fl-page-nav-toggle-button .fl-page-nav .navbar-toggle:visited, .fl-button-lightbox-content .fl-page-nav-toggle-button .fl-page-nav .navbar-toggle:visited {
    color: #fff;
    background-color: #ab8e47;
    font-family: "Open Sans",sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 1.2;
    text-transform: uppercase;
    border-style: none;
    border-width: 0px;
    border-color: initial;
    border-radius: 0px;
    position: relative !important;top: 510px !important;
    
}*/


.wc-pao-addon-container.wc-pao-addon.wc-pao-addon-save-your-prescription-for-future-use {
    float: left;
    width: 40%;
    max-width: 288px;
    text-align: left;
    font-size: 14px;
    text-transform: capitalize;
    padding-right: 8px;
    line-height: 1.2;
}
.wc-pao-addon-container.wc-pao-required-addon.wc-pao-addon.wc-pao-addon-date-of-prescription {
    float: left;
    width: 31%;
    max-width: 168px;
    text-align: left;
    font-size: 14px;
    text-transform: capitalize;
    line-height: 1.2;
    margin-bottom: 38px;
}
  </style>
  
  <!--<link rel="stylesheet" href="./js/main.css" />-->
     <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
    <script src="./js/twilio-video.min.js"></script>

<style>


/* BOOSTRAP MEDIA BREAKPOINTS */
/* Small devices (landscape phones, 576px and up) */
@media (min-width: 576px) {  
  #image_pd_video
 display: block;
    position: fixed;
    margin-left: inherit;
    margin-right: auto;
    border: 1px solid rgba(255, 255, 255, 0.7);
    font-size: 14px;
    color: rgba(255, 255, 255, 1.0);
    cursor: pointer;
    width: 50%;
    height: 54%;
    z-index: 1;
}
}
/* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
@media (min-width: 768px) {
    #image_pd_video
 display: block;
    position: fixed;
    margin-left: inherit;
    margin-right: auto;
    border: 1px solid rgba(255, 255, 255, 0.7);
    font-size: 14px;
    color: rgba(255, 255, 255, 1.0);
    cursor: pointer;
    width: 83% !important;
    height: 48%;
    z-index: 1;
}
}
/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) {
    #image_pd_video
 display: block;
    position: fixed;
    margin-left: inherit;
    margin-right: auto;
    border: 1px solid rgba(255, 255, 255, 0.7);
    font-size: 14px;
    color: rgba(255, 255, 255, 1.0);
    cursor: pointer;
    width: 25.5% !important;
    height: 65%;
    z-index: 1;
}

}
/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {

      #image_pd_video
 display: block;
    position: fixed;
    margin-left: inherit;
    margin-right: auto;
    border: 1px solid rgba(255, 255, 255, 0.7);
    font-size: 14px;
    color: rgba(255, 255, 255, 1.0);
    cursor: pointer;
    width: 19.5% !important;
    height: 31%;
    z-index: 1;
}

}



#output_pd{
    -webkit-transform: scaleX(-1);
      transform: scaleX(-1);
}

</style>

</head>
<form action="" method="post" enctype="multipart/form-data">
    <input type="submit"  hidden class="wc-pao-addon-heading" name="first_submit" value="confirm" style="top: 0px !important;">
<body class="product-template-default single single-product postid-394 theme-bb-theme woocommerce woocommerce-page woocommerce-js fl-theme-builder-header fl-theme-builder-footer fl-theme-builder-singular woo-variation-swatches wvs-theme-bb-theme-child wvs-theme-child-bb-theme wvs-style-squared wvs-attr-behavior-blur wvs-tooltip wvs-css fl-framework-base fl-preset-default fl-full-width fl-scroll-to-top fl-search-active woo-3 woo-products-per-page-16 fl-builder-breakpoint-large" itemscope="itemscope" itemtype="https://schema.org/WebPage">
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJ5Q9NM" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <a aria-label="Skip to content" class="fl-screen-reader-text" href="#fl-main-content">Skip to content</a>
  <div class="fl-page">
   <?php// require("./includes/header.php");?>

    <header
                class="fl-builder-content fl-builder-content-13201 fl-builder-global-templates-locked product"
                data-post-id="13201"
                data-type="header"
                data-sticky="0"
                data-sticky-breakpoint="medium"
                data-shrink="0"
                data-overlay="0"
                data-overlay-bg="transparent"
                data-shrink-image-height="50px"
                itemscope="itemscope"
                itemtype="http://schema.org/WPHeader"
            ></header>
     <div id="fl-main-content" class="fl-page-content" itemprop="mainContentOfPage" role="main">
                <div class="woocommerce-notices-wrapper"></div>
                <div class="fl-builder-content fl-builder-content-13199 fl-builder-global-templates-locked product" data-post-id="13199">
                    <div class="fl-row fl-row-full-width fl-row-bg-color fl-node-5e6b9797181de" data-node="5e6b9797181de">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                <div class="fl-col-group fl-node-5e6b97971a297 fl-col-group-equal-height fl-col-group-align-center fl-col-group-custom-width" data-node="5e6b97971a297">
                                    <div class="fl-col fl-node-5e6b97971a3b4 fl-col-small" data-node="5e6b97971a3b4">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-pp-image fl-node-5e6b9d5cdf673" data-node="5e6b9d5cdf673">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-photo-container">
                                                        <div class="pp-photo pp-photo-align-left pp-photo-align-responsive-default" itemscope itemtype="http://schema.org/ImageObject">
                                                            <div class="pp-photo-content">
                                                                <div class="pp-photo-content-inner">
                                                                    <img
                                                                        loading="lazy"
                                                                        width="257"
                                                                        height="30"
                                                                        class="pp-photo-img wp-image-33 size-full"
                                                                        src="https://directvisioneyewear.ca/wp-content/uploads/2020/04/logo.png"
                                                                        alt="logo"
                                                                        itemprop="image"
                                                                        srcset="https://directvisioneyewear.ca/wp-content/uploads/2020/04/logo.png 257w, https://directvisioneyewear.ca/wp-content/uploads/2020/04/logo-150x18.png 150w"
                                                                        sizes="(max-width: 257px) 100vw, 257px"
                                                                    />
                                                                    <div class="pp-overlay-bg"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fl-col fl-node-5e6b9d3ed9916 fl-col-small" data-node="5e6b9d3ed9916">
                                        <div class="fl-col-content fl-node-content">
                                            <div id="cross-rx" class="fl-module fl-module-pp-image fl-node-5e6b9d3ed99f3" data-node="5e6b9d3ed99f3">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-photo-container">
                                                        <div class="pp-photo pp-photo-align-right pp-photo-align-responsive-default" itemscope itemtype="http://schema.org/ImageObject">
                                                            <div class="pp-photo-content">
                                                                <div class="pp-photo-content-inner">
                                                                    <img class="pp-photo-img wp-image-13202 size-full" src="https://gumptionglasses.optiserver.co.uk/wp-content/uploads/2020/03/cancel1.png" alt="cancel[1]" itemprop="image" />
                                                                    <div class="pp-overlay-bg"></div>
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
                    <div class="fl-row fl-row-full-width fl-row-bg-color fl-node-5e6b937ad7269" data-node="5e6b937ad7269">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                <div class="fl-col-group fl-node-5e6b937ad72ad" data-node="5e6b937ad72ad">
                                    <div class="fl-col fl-node-5e6b937ad72f6" data-node="5e6b937ad72f6">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-fl-woo-cart-button fl-node-5e6b937ad7534" data-node="5e6b937ad7534">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="cart form cart_group composite_form paged standard full_width">
                                                        <div class="scroll_show_component"></div>
                                                        <div class="form_input_blocker"></div>
                                                    
                                                    
                                                        <div id="composite_pagination_394" class="composite_pagination">
                                                        	<nav class="pagination_elements_wrapper">
                                                        		<ul class="pagination_elements" style="list-style:none">
                                                        			
                                                        				<li class="pagination_element pagination_element_1584107434 " data-item_id="1584107434">
                                                        					<span class="element_inner">
                                                        						<span class="element_index">1</span>
                                                        						<span class="element_title">
                                                        							<a class="element_link " href="#vision" rel="nofollow" onclick="viewStage(1)">Vision</a>
                                                        						</span>
                                                        					</span>
                                                        				</li>
                                                        			
                                                        				<li class="pagination_element pagination_element_1584107436 " data-item_id="1584107436">
                                                        					<span class="element_inner">
                                                        						<span class="element_index">2</span>
                                                        						<span class="element_title">
                                                        							<a class="element_link " href="#lens-type" rel="nofollow" onclick="viewStage(2)">Lens Type</a>
                                                        						</span>
                                                        					</span>
                                                        				</li>
                                                        			
                                                        				<li class="pagination_element pagination_element_1584107439 " data-item_id="1584107439">
                                                        					<span class="element_inner">
                                                        						<span class="element_index">3</span>
                                                        						<span class="element_title">
                                                        							<a class="element_link " href="#enhance" rel="nofollow" onclick="viewStage(4)">Enhance</a>
                                                        						</span>
                                                        					</span>
                                                        				</li>
                                                        			
                                                        				<li class="pagination_element pagination_element_review " data-item_id="review">
                                                        					<span class="element_inner">
                                                        						<span class="element_index">4</span>
                                                        						<span class="element_title">
                                                        							<a class="element_link inactive" href="#review" rel="nofollow" onclick="viewStage(5)">Review and Purchase</a>
                                                        						</span>
                                                        					</span>
                                                        				</li>
                                                        			
                                                        		</ul>
                                                        	</nav>
                                                        </div>



                                                        <div id="composite_navigation_394" class="composite_navigation top paged standard" style="display: block;"></div>
                                                        <div id="composite_navigation_394" class="composite_navigation movable hidden paged standard" style="display: block;"></div>
                                                        <div
                                                            id="component_1584107434"
                                                            class="composite_component component paged options-style-thumbnails paginate-results multistep active first autotransition"
                                                            data-nav_title="Vision"
                                                            data-item_id="1584107434"
                                                            style="display: block;"
                                                        >
                                                            <div class="component_title_wrapper">
                                                                <h2 class="step_title_wrapper component_title">
                                                                    <span class="aria_title" aria-label="Vision" tabindex="-1">Vision</span>
                                                                    <span class="component_title_text step_title_text"><span class="step_index">1</span> <span class="step_title">Vision</span></span>
                                                                </h2>
                                                            </div>
                                                            <div id="component_1584107434_inner" class="component_inner" style="display: block !important;">
                                                                <div class="component_description_wrapper">
                                                                    <div class="component_description"><p>How will you use your glasses?</p></div>
                                                                </div>
                                                                <div class="component_selections">
                                                                    <a href="#back" onclick="viewStage('back')">< Back</a>
                                                                    <!--stage 1-->
                                                                    <div
                                                                        id="component_options_1584107434"
                                                                        class="component_options"
                                                                        data-options_data='[{"option_id":"388","option_title":"Distance Single Vision","option_price_html":"Included","option_thumbnail_html":"<img width=\"61\" height=\"52\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/distance-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":{"price":"0","regular_price":"0","product_type":"simple","variation_id":"","variations_data":false,"tax_ratios":{"incl":1,"excl":1},"image_data":{"image_src":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/distance-ico.png","image_srcset":"","image_sizes":"(max-width: 61px) 100vw, 61px","image_title":"Distance Single Vision"},"stock_status":"in-stock","product_html":"\t<div class=\"composited_product_title_wrapper\" data-show_title=\"yes\" tabindex=\"-1\"><\/div>\n\t<div class=\"composited_product_details_wrapper\"><div class=\"composited_product_images images\"><figure class=\"composited_product_image woocommerce-product-gallery__image\"><a href=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/distance-ico.png\" class=\"image zoom\" title=\"distance-ico\" data-rel=\"photoSwipe\"><img width=\"61\" height=\"52\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/distance-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" title=\"distance-ico\" data-caption=\"\" data-large_image=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/distance-ico.png\" data-large_image_width=\"61\" data-large_image_height=\"52\" \/><\/a><\/figure><\/div>\n<div class=\"details component_data\"><div class=\"component_wrap\"><span class=\"price\"><span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">&amp;#36;<\/span>0.00<\/bdi><\/span> <span class=\"component_option_each\">each<\/span><\/span>\n<div class=\"quantity_button\">\t<div class=\"quantity\">\n\t\t\t\t<label class=\"screen-reader-text\" for=\"quantity_60ae1f237e0b1\">Distance Single Vision quantity<\/label>\n\t\t<input\n\t\t\ttype=\"number\"\n\t\t\tid=\"quantity_60ae1f237e0b1\"\n\t\t\tclass=\"input-text qty text\"\n\t\t\tstep=\"1\"\n\t\t\tmin=\"1\"\n\t\t\tmax=\"\"\n\t\t\tname=\"wccp_component_quantity[1584107434]\"\n\t\t\tvalue=\"1\"\n\t\t\ttitle=\"Qty\"\n\t\t\tsize=\"4\"\n\t\t\tplaceholder=\"\"\n\t\t\tinputmode=\"numeric\" \/>\n\t\t\t<\/div>\n\t<\/div>\n\t<\/div>\n<\/div>\n\n<\/div>"},"option_price_data":{"price":"0","regular_price":"0","max_price":"0","max_regular_price":"0","min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":false,"has_addons":false,"has_required_addons":false,"is_in_view":true,"option_description":"One prescription that covers the whole lens. <br>Typically for seeing far away, like driving."},{"option_id":"21539","option_title":"Reading Single Vision","option_price_html":"Included","option_thumbnail_html":"<img width=\"71\" height=\"53\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/reading-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":{"price":"0","regular_price":"0","product_type":"simple","variation_id":"","variations_data":false,"tax_ratios":{"incl":1,"excl":1},"image_data":{"image_src":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/reading-ico.png","image_srcset":"","image_sizes":"(max-width: 71px) 100vw, 71px","image_title":"Reading Single Vision"},"stock_status":"in-stock","product_html":"\t<div class=\"composited_product_title_wrapper\" data-show_title=\"yes\" tabindex=\"-1\"><\/div>\n\t<div class=\"composited_product_details_wrapper\"><div class=\"composited_product_images images\"><figure class=\"composited_product_image woocommerce-product-gallery__image\"><a href=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/reading-ico.png\" class=\"image zoom\" title=\"reading-ico\" data-rel=\"photoSwipe\"><img width=\"71\" height=\"53\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/reading-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" title=\"reading-ico\" data-caption=\"\" data-large_image=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/reading-ico.png\" data-large_image_width=\"71\" data-large_image_height=\"53\" \/><\/a><\/figure><\/div>\n<div class=\"details component_data\"><div class=\"component_wrap\"><span class=\"price\"><span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">&amp;#36;<\/span>0.00<\/bdi><\/span> <span class=\"component_option_each\">each<\/span><\/span>\n<div class=\"quantity_button\">\t<div class=\"quantity\">\n\t\t\t\t<label class=\"screen-reader-text\" for=\"quantity_60ae1f2380349\">Reading Single Vision quantity<\/label>\n\t\t<input\n\t\t\ttype=\"number\"\n\t\t\tid=\"quantity_60ae1f2380349\"\n\t\t\tclass=\"input-text qty text\"\n\t\t\tstep=\"1\"\n\t\t\tmin=\"1\"\n\t\t\tmax=\"\"\n\t\t\tname=\"wccp_component_quantity[1584107434]\"\n\t\t\tvalue=\"1\"\n\t\t\ttitle=\"Qty\"\n\t\t\tsize=\"4\"\n\t\t\tplaceholder=\"\"\n\t\t\tinputmode=\"numeric\" \/>\n\t\t\t<\/div>\n\t<\/div>\n\t<\/div>\n<\/div>\n\n<\/div>"},"option_price_data":{"price":"0","regular_price":"0","max_price":"0","max_regular_price":"0","min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":false,"has_addons":false,"has_required_addons":false,"is_in_view":true,"option_description":"One prescription that covers the whole lens. <br>For close-up tasks, like reading."},{"option_id":"000","option_title":"Progressive","option_price_html":"Options","option_thumbnail_html":"<img width=\"51\" height=\"34\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/progressive-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":"","option_price_data":{"price":54,"regular_price":54,"max_price":84,"max_regular_price":84,"min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":true,"has_addons":false,"has_required_addons":false,"is_in_view":true,"option_description":"No-line progressive multifocal lenses, help you see\r\nclearly at all distances without the visible lines"},{"option_id":"389","option_title":"No Prescription","option_price_html":"Included","option_thumbnail_html":"<img width=\"44\" height=\"36\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/no-presc-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":{"price":"0","regular_price":"0","product_type":"simple","variation_id":"","variations_data":false,"tax_ratios":{"incl":1,"excl":1},"image_data":{"image_src":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/no-presc-ico.png","image_srcset":"","image_sizes":"(max-width: 44px) 100vw, 44px","image_title":"No Prescription"},"stock_status":"in-stock","product_html":"\t<div class=\"composited_product_title_wrapper\" data-show_title=\"yes\" tabindex=\"-1\"><\/div>\n\t<div class=\"composited_product_details_wrapper\"><div class=\"composited_product_images images\"><figure class=\"composited_product_image woocommerce-product-gallery__image\"><a href=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/no-presc-ico.png\" class=\"image zoom\" title=\"no-presc-ico.png\" data-rel=\"photoSwipe\"><img width=\"44\" height=\"36\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/no-presc-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" title=\"no-presc-ico.png\" data-caption=\"\" data-large_image=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/no-presc-ico.png\" data-large_image_width=\"44\" data-large_image_height=\"36\" \/><\/a><\/figure><\/div>\n<div class=\"details component_data\"><div class=\"component_wrap\"><span class=\"price\"><span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">&amp;#36;<\/span>0.00<\/bdi><\/span> <span class=\"component_option_each\">each<\/span><\/span>\n<div class=\"quantity_button\">\t<div class=\"quantity\">\n\t\t\t\t<label class=\"screen-reader-text\" for=\"quantity_60ae1f2384dae\">No Prescription quantity<\/label>\n\t\t<input\n\t\t\ttype=\"number\"\n\t\t\tid=\"quantity_60ae1f2384dae\"\n\t\t\tclass=\"input-text qty text\"\n\t\t\tstep=\"1\"\n\t\t\tmin=\"1\"\n\t\t\tmax=\"\"\n\t\t\tname=\"wccp_component_quantity[1584107434]\"\n\t\t\tvalue=\"1\"\n\t\t\ttitle=\"Qty\"\n\t\t\tsize=\"4\"\n\t\t\tplaceholder=\"\"\n\t\t\tinputmode=\"numeric\" \/>\n\t\t\t<\/div>\n\t<\/div>\n\t<\/div>\n<\/div>\n\n<\/div>"},"option_price_data":{"price":"0","regular_price":"0","max_price":"0","max_regular_price":"0","min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":false,"has_addons":false,"has_required_addons":false,"is_in_view":true,"option_description":"Non prescription lenses, for fashion or cosmetic wear."}]'
                                                                    >
                                                                        <div class="component_options_inner cp_clearfix">
                                                                            <div id="component_option_thumbnails_1584107434" class="component_option_thumbnails columns-3" data-component_option_columns="3">
                                                                                <ul class="component_option_thumbnails_container cp_clearfix" style="list-style: none;">
                                                                                    <li id="component_option_thumbnail_container_388" class="component_option_thumbnail_container first" onclick="viewStage(2); setSummary('summary_prescription', 'Distance Single Vision')" >
                                                                                        <div id="component_option_thumbnail_388" class="cp_clearfix component_option_thumbnail" data-val="388">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Distance Single Vision</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img
                                                                                                    src="./images/WhatsApp Image 2021-09-22 at 11.55.02 AM.jpeg"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    width="61"
                                                                                                    height="52"
                                                                                                    style="width: 100%;max-width: 310px;"
                                                                                                />
                                                                                            </div>
                                                                                            <div class="thumbnail_description">
                                                                                                <p>
                                                                                                    One prescription that covers the whole lens. <br />
                                                                                                    Typically for seeing far away, like driving.
                                                                                                </p>
                                                            
                                                                                                <span class="thumbnail_price price">Included</span>
                                                                                            </div>
                                                                                            <div class="thumbnail_buttons">
                                                                                                <button class="button component_option_thumbnail_select" aria-label="Select Distance Single Vision">Select</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                            
                                                                                    <li id="component_option_thumbnail_container_21539" class="component_option_thumbnail_container" onclick="viewStage(2); setSummary('summary_prescription', 'Reading Single Vision')">
                                                                                        <div id="component_option_thumbnail_21539" class="cp_clearfix component_option_thumbnail" data-val="21539">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Reading Single Vision</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <style>
                                                                                                    .product .component_option_thumbnail .image {
    margin: 12px 0 12px;
    height: auto;
    overflow: hidden;
    padding: 0;
    line-height: 1.8;
}
                                                                                                </style>
                                                                                                <img
                                                                                                    src="./images/WhatsApp Image 2021-09-22 at 11.54.47 AM.jpeg"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    width="71"
                                                                                                    height="53"
                                                                                                    style="width: 100%;max-width: 310px;"
                                                                                                />
                                                                                            </div>
                                                                                            <div class="thumbnail_description">
                                                                                                <p>
                                                                                                    One prescription that covers the whole lens. <br />
                                                                                                    For close-up tasks, like reading.
                                                                                                </p>
                                                            
                                                                                                <span class="thumbnail_price price">Included</span>
                                                                                            </div>
                                                                                            <div class="thumbnail_buttons">
                                                                                                <button class="button component_option_thumbnail_select" aria-label="Select Reading Single Vision">Select</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                            <!--
                                                                                    <li id="component_option_thumbnail_container_390" class="component_option_thumbnail_container last">
                                                                                        <div id="component_option_thumbnail_390" class="cp_clearfix component_option_thumbnail" data-val="390">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Progressive</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/progressive-ico.png"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    width="51"
                                                                                                    height="34"
                                                                                                />
                                                                                            </div>
                                                                                            <div class="thumbnail_description">
                                                                                                <p>No-line progressive multifocal lenses, help you see clearly at all distances without the visible lines</p>
                                                            
                                                                                                <span class="thumbnail_price price">Options</span>
                                                                                            </div>
                                                                                            <div class="thumbnail_buttons">
                                                                                                <button class="button component_option_thumbnail_select" aria-label="Select Progressive options">Select options</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                            -->
                                                                                    <li id="component_option_thumbnail_container_389" class="component_option_thumbnail_container first" onclick="viewStage(4); setSummary('summary_prescription', 'No Prescription')">
                                                                                        <div id="component_option_thumbnail_389" class="cp_clearfix component_option_thumbnail" data-val="389">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">No Prescription</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img
                                                                                                    src="./images/WhatsApp Image 2021-09-22 at 11.55.18 AM.jpeg"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    width="61"
                                                                                                    height="52"
                                                                                                    style="width: 100%;max-width: 310px;"
                                                                                                />
                                                                                            </div>
                                                                                            <div class="thumbnail_description">
                                                                                                <p>Non prescription lenses, for fashion or cosmetic wear.</p>
                                                            
                                                                                                <span class="thumbnail_price price">Included</span>
                                                                                            </div>
                                                                                            <div class="thumbnail_buttons">
                                                                                                <button class="button component_option_thumbnail_select" aria-label="Select No Prescription">Select</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="component_options_select_wrapper" style="display: none;">
                                                                                <select id="component_options_1584107434" class="component_options_select" name="wccp_component_selection[1584107434]">
                                                                                    <option value="" selected="selected">Choose an option</option>
                                                            
                                                                                    <option value="388">Distance Single Vision</option>
                                                            
                                                                                    <option value="21539">Reading Single Vision</option>
                                                            
                                                                                    <option value="390">Progressive</option>
                                                            
                                                                                    <option value="389">No Prescription</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--stage 2-->
                                                                    <div
                                                                    style="display:none;"
                                                                        id="component_options_1584107435component_options_1584107435"
                                                                        class="component_options"
                                                                        data-options_data='[{"option_id":"387","option_title":"Enter Prescription Now","option_price_html":"&amp;nbsp;","option_thumbnail_html":"<img width=\"36\" height=\"36\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/edit.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":"","option_price_data":{"price":"0","regular_price":"0","max_price":"0","max_regular_price":"0","min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":true,"has_addons":true,"has_required_addons":true,"is_in_view":true,"option_description":"Add new prescription,\r\nthis will be saved for future use."},{"option_id":"000","option_title":"Upload Prescription","option_price_html":"&amp;nbsp;","option_thumbnail_html":"<img width=\"36\" height=\"34\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/upload.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":"","option_price_data":{"price":"0","regular_price":"0","max_price":"0","max_regular_price":"0","min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":true,"has_addons":true,"has_required_addons":true,"is_in_view":true,"option_description":"Take a photo of your paper prescription\r\nand your glasses will ship faster!"},{"option_id":"397","option_title":"Use Saved Prescription","option_price_html":"&amp;nbsp;","option_thumbnail_html":"<img width=\"36\" height=\"36\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/folder.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":"","option_price_data":{"price":"0","regular_price":"0","max_price":"0","max_regular_price":"0","min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":true,"has_addons":true,"has_required_addons":true,"is_in_view":true,"option_description":"Load a previously saved prescription\r\nfrom your account, requires login"}]'
                                                                    >
                                                                        <div class="component_options_inner cp_clearfix">
                                                                            <div id="component_option_thumbnails_1584107435" class="component_option_thumbnails columns-3" data-component_option_columns="3">
                                                                                <ul class="component_option_thumbnails_container cp_clearfix" style="list-style: none;">
                                                                                    <li id="component_option_thumbnail_container_387" class="sandeeppres component_option_thumbnail_container first" style="margin-bottom: 20px;"  onclick="viewStage(3)">
                                                                                        <div id="component_option_thumbnail_387" class="cp_clearfix component_option_thumbnail" data-val="387">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Enter Prescription Now</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/edit.png" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" loading="lazy" width="36" height="36" />
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
                                                                    <!--
                                                                                    <li id="component_option_thumbnail_container_396" class="component_option_thumbnail_container" style="margin-bottom: 20px;">
                                                                                        
                                                                                        
                                                                                        <div id="component_option_thumbnail_396" class="cp_clearfix component_option_thumbnail" data-val="396">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Upload Prescription</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/upload.png" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" loading="lazy" width="36" height="34" />
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
                                                                                    
                                                                                    -->
                                                                    
                                                                                    <li id="component_option_thumbnail_container_397" class="component_option_thumbnail_container last" style="margin-bottom: 20px;" onclick="viewStage(7)">
                                                                                        <div id="component_option_thumbnail_397" class="cp_clearfix component_option_thumbnail" data-val="397">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Use Saved Prescription</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/folder.png" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" loading="lazy" width="36" height="36" />
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



                                                                    
                                                                    
                                                                </div>
                                                            </div>


                                                        </div>
                                                       
                                                       
                                                       <!--stage 3-->
                                                        <div style="display:none;" id="component_1584107435" class="composite_component component paged options-style-thumbnails paginate-results multistep autotransition active" data-nav_title="Prescription" data-item_id="1584107435" style="">
                                                            <div id="composite_navigation_394" class="composite_navigation top paged standard">
                                                                <div class="composite_navigation_inner">
                                                                    <a onclick="viewStage('back')" class="page_button prev" href="#vision" rel="nofollow" aria-label="Go to Vision">Back</a>
                                                                    <!-- <a class="page_button next " href="#lens-type" rel="nofollow" aria-label="Go to Lens Type">Lens Type</a> -->
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="component_title_wrapper">
                                                                <h2 class="step_title_wrapper component_title">
                                                                    <span class="aria_title" aria-label="Prescription" tabindex="-1">Prescription</span>
                                                                    <span class="component_title_text step_title_text"><span class="step_index">2</span> <span class="step_title">Prescription</span></span>
                                                                </h2>
                                                            </div>
                                                        
                                                            <div id="component_1584107435_inner" class="component_inner">
                                                                <div class="component_description_wrapper">
                                                                    <div class="component_description"><p>How will you provide your prescription?</p></div>
                                                                </div>
                                                                <div class="component_selections">
                                                                    <div class="scroll_show_component_details"></div>
                                                                    <div class="component_message top" style="display: block;">
                                                                        <div class="validation_message woocommerce-info">
                                                                            <ul style="list-style: none;">
                                                                                <li>Please choose an option to continue…</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
																	<!-- first form -->
																	<div method="post" id="first_form" >
                                                                    <div class="component_content" data-product_id="1584107435" style="height: auto; display: block;">
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
                                                                                <div class="composited_product_details_wrapper">
                                                                                    <div class="composited_product_images images" style="opacity: 1;">
                                                                                        <figure class="composited_product_image woocommerce-product-gallery__image">
                                                                                            <a href="https://directvisioneyewear.ca/wp-content/uploads/2020/05/edit.png" class="image zoom" title="edit.png" data-rel="photoSwipe">
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/edit.png"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    title="edit.png"
                                                                                                    data-caption=""
                                                                                                    data-large_image="https://directvisioneyewear.ca/wp-content/uploads/2020/05/edit.png"
                                                                                                    data-large_image_width="36"
                                                                                                    data-large_image_height="36"
                                                                                                    width="36"
                                                                                                    height="36"
                                                                                                />
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
                                                                                                    <div
                                                                                                        class="cart"
                                                                                                        data-title="Right Eye"
                                                                                                        data-product_title="Right Eye"
                                                                                                        data-visible="yes"
                                                                                                        data-optional_suffix=""
                                                                                                        data-optional="no"
                                                                                                        data-type="simple"
                                                                                                        data-bundled_item_id="1"
                                                                                                        data-custom_data="[]"
                                                                                                        data-product_id="386"
                                                                                                        data-bundle_id="387"
                                                                                                    >
                                                                                                        <div class="bundled_item_wrap">
                                                                                                            <div class="bundled_item_cart_content">
                                                                                                                <div class="bundled_item_cart_details">
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-sph" data-product-name="Right Eye">
                                                                                                                        <label for="addon-1584107435-1-sph-0" class="wc-pao-addon-name" data-addon-name="SPH" data-has-per-person-pricing="" data-has-per-block-pricing="">SPH </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-1-sph-0">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-1-sph-0" id="addon-1584107435-1-sph-0">
                                                                                                                                <option value="0.00">0.00</option>
                                                            
                                                                                                                                <?$points = +8.00;
                                                                                                                                while($points>=-8.00){?>
                                                                                                                                    <option <?if($points==$presDeets['r_sph']){echo "selected";}?>><? echo  number_format((float)formatNum($points), 2, '.', '');?></option>
                                                                                                                                <?$points-=0.25;
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
                                                                                                                                
                                                                                                                                <?$points = +3.00;
                                                                                                                                while($points>=-3.00){?>
                                                                                                                                    <option <?if($points==$presDeets['r_cyl']){echo "selected";}?>><? echo  number_format((float)formatNum($points), 2, '.', '');?></option>
                                                                                                                                <?$points-=0.25;
                                                                                                                                }?>
                                                                                                                            </select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-axis" data-product-name="Right Eye">
                                                                                                                        <label for="addon-1584107435-1-axis-2" class="wc-pao-addon-name" data-addon-name="Axis" data-has-per-person-pricing="" data-has-per-block-pricing="">Axis </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-1-axis-2">
                                                                                                                            <input
                                                                                                                                type="text"
                                                                                                                                class="input-text wc-pao-addon-field wc-pao-addon-custom-text"
                                                                                                                                data-raw-price=""
                                                                                                                                data-price=""
                                                                                                                                name="addon-1584107435-1-axis-2"
                                                                                                                                
                                                                                                                            />
                                                                                                                            <small class="wc-pao-addon-chars-remaining"><span>5</span> characters remaining</small>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-add" data-product-name="Right Eye">
                                                                                                                        <label for="addon-1584107435-1-add-3" class="wc-pao-addon-name" data-addon-name="Add" data-has-per-person-pricing="" data-has-per-block-pricing="">Add </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-1-add-3">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-1-add-3" id="addon-1584107435-1-add-3">
                                                                                                                                <option value="0.00">0.00</option>
                                                        
                                                                                                                                <?$points = +0.25;
                                                                                                                                while($points<6.00){?>
                                                                                                                                    <option <?if($points==$presDeets['r_add']){echo "selected";}?>><? echo  number_format((float)formatNum($points), 2, '.', '');?></option>
                                                                                                                                <?$points+=0.25;
                                                                                                                                }?>
                                                                                                                                
                                                                                                                                </select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-pd" data-product-name="Right Eye">
                                                                                                                        <label for="addon-1584107435-1-pd-4" class="wc-pao-addon-name" data-addon-name="PD" data-has-per-person-pricing="" data-has-per-block-pricing="">PD </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-1-pd-4">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-1-pd-4" id="addon-1584107435-1-pd-4">
                                                                                                                                <option value="0.00">0.00</option>
                                                        
                                                                                                                                <?$points = 22.00;
                                                                                                                                while($points<37.00){?>
                                                                                                                                    <option <?if($points==$presDeets['pd']){echo "selected";}?>><? echo  number_format((float)($points), 2, '.', '');?></option>
                                                                                                                                <?$points+=0.5;
                                                                                                                                }?></select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                                                                                    <div
                                                                                                                        id="product-addons-total"
                                                                                                                        data-show-sub-total="1"
                                                                                                                        data-type="simple"
                                                                                                                        data-tax-mode="excl"
                                                                                                                        data-tax-display-mode="excl"
                                                                                                                        data-price="0"
                                                                                                                        data-raw-price="0"
                                                                                                                        data-product-id="386"
                                                                                                                        style="display: none;"
                                                                                                                    ></div>
                                                                                                                </div>
                                                                                                                <div class="bundled_item_after_cart_details bundled_item_button">
                                                                                                                    <div class="quantity quantity_hidden">
                                                                                                                        <input class="qty bundled_qty" type="hidden" name="component_1584107435_bundle_quantity_1" value="1" />
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
                                                                                                    <div
                                                                                                        class="cart"
                                                                                                        data-title="Left Eye"
                                                                                                        data-product_title="Left Eye"
                                                                                                        data-visible="yes"
                                                                                                        data-optional_suffix=""
                                                                                                        data-optional="no"
                                                                                                        data-type="simple"
                                                                                                        data-bundled_item_id="2"
                                                                                                        data-custom_data="[]"
                                                                                                        data-product_id="385"
                                                                                                        data-bundle_id="387"
                                                                                                    >
                                                                                                        <div class="bundled_item_wrap">
                                                                                                            <div class="bundled_item_cart_content">
                                                                                                                <div class="bundled_item_cart_details">
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-sph" data-product-name="Left Eye">
                                                                                                                        <label for="addon-1584107435-2-sph-0" class="wc-pao-addon-name" data-addon-name="SPH" data-has-per-person-pricing="" data-has-per-block-pricing="">SPH </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-2-sph-0">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-2-sph-0" id="addon-1584107435-2-sph-0">
                                                                                                                                <option value="0.00">0.00</option>
                                                        
                                                                                                                               <?$points = +8.00;
                                                                                                                                while($points>=-8.00){?>
                                                                                                                                    <option <?if($points==$presDeets['l_sph']){echo "selected";}?>><? echo  number_format((float)formatNum($points), 2, '.', '');?></option>
                                                                                                                                <?$points-=0.25;
                                                                                                                                }?></select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-cyl" data-product-name="Left Eye">
                                                                                                                        <label for="addon-1584107435-2-cyl-1" class="wc-pao-addon-name" data-addon-name="CYL" data-has-per-person-pricing="" data-has-per-block-pricing="">CYL </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-2-cyl-1">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-2-cyl-1" id="addon-1584107435-2-cyl-1">
                                                                                                                                <option value="0.00">0.00</option>
                                                        
                                                                                                                                <?$points = +3.00;
                                                                                                                                while($points>=-3.00){?>
                                                                                                                                    <option <?if($points==$presDeets['l_cyl']){echo "selected";}?>><? echo  number_format((float)formatNum($points), 2, '.', '');?></option>
                                                                                                                                <?$points-=0.25;
                                                                                                                                }?></select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-axis" data-product-name="Left Eye">
                                                                                                                        <label for="addon-1584107435-2-axis-2" class="wc-pao-addon-name" data-addon-name="Axis" data-has-per-person-pricing="" data-has-per-block-pricing="">Axis </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-2-axis-2">
                                                                                                                            <input
                                                                                                                                type="text"
                                                                                                                                class="input-text wc-pao-addon-field wc-pao-addon-custom-text"
                                                                                                                                data-raw-price=""
                                                                                                                                data-price=""
                                                                                                                                name="addon-1584107435-2-axis-2"
                                                                                                                                
                                                                                                                            />
                                                                                                                            <small class="wc-pao-addon-chars-remaining"><span>5</span> characters remaining</small>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-add" data-product-name="Left Eye">
                                                                                                                        <label for="addon-1584107435-2-add-3" class="wc-pao-addon-name" data-addon-name="Add" data-has-per-person-pricing="" data-has-per-block-pricing="">Add </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-2-add-3">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-2-add-3" id="addon-1584107435-2-add-3">
                                                                                                                                <option value="0.00">0.00</option>
                                                        
                                                                                                                                <?$points = +0.25;
                                                                                                                                while($points<6.00){?>
                                                                                                                                    <option <?if($points==$presDeets['l_add']){echo "selected";}?>><? echo  number_format((float)formatNum($points), 2, '.', '');?></option>
                                                                                                                                <?$points+=0.25;
                                                                                                                                }?>
                                                                                                                                </select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                        
                                                                                                                    <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-pd" data-product-name="Left Eye">
                                                                                                                        <label for="addon-1584107435-2-pd-4" class="wc-pao-addon-name" data-addon-name="PD" data-has-per-person-pricing="" data-has-per-block-pricing="">PD </label>
                                                        
                                                                                                                        <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-2-pd-4">
                                                                                                                            <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-2-pd-4" id="addon-1584107435-2-pd-4">
                                                                                                                                <option value="0.00">0.00</option>
                                                        
                                                                                                                                <?$points = 22.00;
                                                                                                                                while($points<37.00){?>
                                                                                                                                    <option <?if($points==$presDeets['pd']){echo "selected";}?>><? echo  number_format((float)($points), 2, '.', '');?></option>
                                                                                                                                <?$points+=0.5;
                                                                                                                                }?></select>
                                                                                                                        </p>
                                                        
                                                                                                                        <div class="clear"></div>
                                                                                                                    </div>
                                                                                                                    <div
                                                                                                                        id="product-addons-total"
                                                                                                                        data-show-sub-total="1"
                                                                                                                        data-type="simple"
                                                                                                                        data-tax-mode="excl"
                                                                                                                        data-tax-display-mode="excl"
                                                                                                                        data-price="0"
                                                                                                                        data-raw-price="0"
                                                                                                                        data-product-id="385"
                                                                                                                        style="display: none;"
                                                                                                                    ></div>
                                                                                                                </div>
                                                                                                                <div class="bundled_item_after_cart_details bundled_item_button">
                                                                                                                    <div class="quantity quantity_hidden">
                                                                                                                        <input class="qty bundled_qty" type="hidden" name="component_1584107435_bundle_quantity_2" value="1" />
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ul>
                                                                                        <div
                                                                                            class="cart bundle_data bundle_data_387"
                                                                                            data-bundle_id="387"
                                                                                        >
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-space-and-border" data-product-name="Enter Prescription Now">
                                                                                                <h3 class="wc-pao-addon-heading">Space and Border</h3>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-pupillary-distance-pd" data-product-name="Enter Prescription Now">
                                                                                                <h3 class="wc-pao-addon-heading">Pupillary Distance (PD).</h3>
                                                        
                                                        <a href="#modal_instructions_pd" rel="modal:open" class="button" >?</a>
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-pd" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-pd-2" class="wc-pao-addon-name" data-addon-name="PD" data-has-per-person-pricing="" data-has-per-block-pricing="">PD </label>
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-pd-2">
                                                                                                    <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-pd-2" id="addon-1584107435-pd-2">
                                                                                                        <option value="0.00">0.00</option>
                                                        
                                                                                                        <?$points = 44.00;
                                                                                                        while($points<74.00){?>
                                                                                                            <option <?if($points==$presDeets['pd']){echo "selected";}?>><? echo  number_format((float)($points), 0, '.', '');?></option>
                                                                                                        <?$points+=1;
                                                                                                        }?> </select>
                                                                                                </p>
                                                                 
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                       
                                                       
                                                       <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-pd" data-product-name="Enter Prescription Now" style="    max-width: 200px;
    margin-top: 35px;">
                                                           <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-pd-2">
                                                                                                    <p><a href="#modal_take_photo" rel="modal:open" class="button" >Upload PD Picture</a></p>
                                                                                                </p>
                                                                                                
                                                       </div> 
                                                        
                                                        
                                                        
                                                                                                
                                                                                                
                                                                                                
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-right-pd" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-right-pd-3" class="wc-pao-addon-name" data-addon-name="Right PD" data-has-per-person-pricing="" data-has-per-block-pricing="">Right PD </label>
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-right-pd-3">
                                                                                                    <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-right-pd-3" id="addon-1584107435-right-pd-3">
                                                                                                        <option value="0.00">0.00</option>
                                                        
                                                                                                        <?$points = 22.00;
                                                                                                        while($points<37.00){?>
                                                                                                            <option <?if($points==$presDeets['addon-1584107435-right-pd-3']){echo "selected";}?>><? echo  number_format((float)($points), 2, '.', '');?></option>
                                                                                                        <?$points+=0.5;
                                                                                                        }?>
                                                                                                        </select>
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-left-pd" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-left-pd-4" class="wc-pao-addon-name" data-addon-name="Left PD" data-has-per-person-pricing="" data-has-per-block-pricing="">Left PD </label>
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-left-pd-4">
                                                                                                    <select class="wc-pao-addon-field wc-pao-addon-select" name="addon-1584107435-left-pd-4" id="addon-1584107435-left-pd-4">
                                                                                                        <option value="0.00">0.00</option>
                                                        
                                                                                                        <?$points = 22.00;
                                                                                                        while($points<37.00){?>
                                                                                                            <option <?if($points==$presDeets['addon-1584107435-left-pd-3']){echo "selected";}?>><? echo  number_format((float)($points), 2, '.', '');?></option>
                                                                                                        <?$points+=0.5;
                                                                                                        }?></select>
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
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="input-text wc-pao-addon-field wc-pao-addon-custom-text"
                                                                                                        data-raw-price=""
                                                                                                        data-price=""
                                                                                                        name="addon-1584107435-first-name-8"
                                                                                                        id="addon-1584107435-first-name-8"
                                                                                                        data-price-type="flat_fee"
                                                                                                        value=""
                                                                                                        maxlength="20"
                                                                                                        pattern="[A-Za-z0-9-]+"
                                                                                                        title="Only letters and numbers"
                                                                                                        required=""
                                                                                                    />
                                                                                                    <small class="wc-pao-addon-chars-remaining"><span>20</span> characters remaining</small>
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-required-addon wc-pao-addon wc-pao-addon-last-name" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-last-name-9" class="wc-pao-addon-name" data-addon-name="Last Name" data-has-per-person-pricing="" data-has-per-block-pricing="">
                                                                                                    Last Name <em class="required" title="Required field">*</em>&nbsp;
                                                                                                </label>
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-last-name-9">
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="input-text wc-pao-addon-field wc-pao-addon-custom-text"
                                                                                                        data-raw-price=""
                                                                                                        data-price=""
                                                                                                        name="addon-1584107435-last-name-9"
                                                                                                        id="addon-1584107435-last-name-9"
                                                                                                        data-price-type="flat_fee"
                                                                                                        value=""
                                                                                                        maxlength="20"
                                                                                                        pattern="[A-Za-z0-9-]+"
                                                                                                        title="Only letters and numbers"
                                                                                                        required=""
                                                                                                    />
                                                                                                    <small class="wc-pao-addon-chars-remaining"><span>20</span> characters remaining</small>
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-who-is-the-prescription-for" data-product-name="Enter Prescription Now">
                                                                                                <h3 class="wc-pao-addon-heading">Save Prescription *</h3>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-required-addon wc-pao-addon wc-pao-addon-first-name" data-product-name="Enter Prescription Now">
                                                                                                <label
                                                                                                    for="addon-1584107435-save-your-prescription-for-future-11"
                                                                                                    class="wc-pao-addon-name"
                                                                                                    data-addon-name="Save your prescription for future use"
                                                                                                    data-has-per-person-pricing=""
                                                                                                    data-has-per-block-pricing=""
                                                                                                >
                                                                                                    Save your prescription for future use
                                                                                                </label>
                                                                                                <!--<div class="wc-pao-addon-description"><p>e.g. Prescription name</p></div>-->
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-save-your-prescription-for-future-11">
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="input-text wc-pao-addon-field wc-pao-addon-custom-text"
                                                                                                        data-raw-price=""
                                                                                                        data-price=""
                                                                                                        name="addon-1584107435-save-your-prescription-for-future-11"
                                                                                                        id="addon-1584107435-save-your-prescription-for-future-11"
                                                                                                        data-price-type="flat_fee"
                                                                                                        value=""
                                                                                                        pattern="[A-Za-z0-9-]+"
                                                                                                        title="Only letters and numbers"
                                                                                                    />
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-required-addon wc-pao-addon wc-pao-addon-last-name" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-date-of-prescription-12" class="wc-pao-addon-name" data-addon-name="Date of prescription" data-has-per-person-pricing="" data-has-per-block-pricing="">
                                                                                                    Date of prescription <em class="required" title="Required field">*</em>&nbsp;
                                                                                                </label>
                                                                                                <div class="wc-pao-addon-description"><p>mm/dd/yyyy</p></div>
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-date-of-prescription-12">
                                                                                                    <input
                                                                                                        type="date"
                                                                                                        class=""
                                                                                                        data-raw-price=""
                                                                                                        data-price=""
                                                                                                        name="addon-1584107435-date-of-prescription-12"
                                                                                                        id="addon-1584107435-date-of-prescription-12"
                                                                                                        data-price-type="flat_fee"
                                                                                                        value=""
                                                                                                        maxlength="10"
                                                                                                        style="border-radius: 3px;
border: 1px solid #c0c0c0;
background: transparent;
height: 49px;
padding: 6px 7px;
font-size: 20px;
color: #000;"
                                                                                                    />
                                                                                                    <small class="wc-pao-addon-chars-remaining"><span>10</span> characters remaining</small>
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                        
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-upload-prescription" data-product-name="Enter Prescription Now">
                                                                                                <h3 class="wc-pao-addon-heading">Upload Prescription *</h3>
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                                                            <p class="requireFields" style="color:red;display:none;">You have not filled all the required fields. Make sure you fill all fields as well as upload PD photo.</p>
                                                                                            <div class="wc-pao-addon-container wc-pao-required-addon wc-pao-addon wc-pao-addon-upload-your-prescription" data-product-name="Enter Prescription Now">
                                                                                                <label for="addon-1584107435-upload-your-prescription-14" class="wc-pao-addon-name" data-addon-name="Upload your prescription" data-has-per-person-pricing="" data-has-per-block-pricing="">
                                                                                                    Upload your prescription (PNG, JPEG, JPG)<em class="required" title="Required field">*</em>&nbsp;
                                                                                                </label>
                                                                                                
                                                                                                <!--<div class="wc-pao-addon-description"><p>Allowed Types (PDF, PNG, JPEG, JPG)</p></div>-->
                                                        
                                                                                                <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-upload-your-prescription-14">
                                                                                                    <input
                                                                                                    onchange="loadFile(event)"
                                                                                                        type="file"
                                                                                                        class="wc-pao-addon-file-upload input-text wc-pao-addon-field"
                                                                                                        data-raw-price=""
                                                                                                        data-price=""
                                                                                                        data-price-type="flat_fee"
                                                                                                        name="addon-1584107435-upload-your-prescription-14"
                                                                                                        id="addon-1584107435-upload-your-prescription-14"
                                                                                                        accept=".png,.jpg,.jpeg"
                                                                                                        required=""
                                                                                                    />
                                                                                                    <small>(max file size 200 MB)</small>
                                                                                                </p>
                                                        
                                                                                                <div class="clear"></div>
                                                                                                <br><img id="output" class="hide" width="200" />
                                                                                                <img id="output_pd" class="hide" width="200"  style="-webkit-transform: scaleX(-1);transform: scaleX(-1);"/>
                                                                                                <br>
                                                                                            </div>
                                                        
                                                                                            <!--<div class="wc-pao-addon-container wc-pao-addon" data-product-name="Enter Prescription Now">-->
                                                                                            <!--    <h3 class="wc-pao-addon-heading">File Preview</h3>-->
                                                                                            <!--    <style>-->
                                                                                            <!--        .hide{-->
                                                                                            <!--          display: none;-->
                                                                                            <!--        }-->
                                                                                            <!--    </style>-->
                                                                                                
                                                                                            <!--    <div class="clear"></div>-->
                                                                                            <!--</div>-->
                                                                                            <!--
                                                                                            <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-confirm" data-product-name="Enter Prescription Now">
                                                                                                <input type="submit" class="wc-pao-addon-heading" name="first_submit" value="confirm" style="top: 0px !important;">
                                                        
                                                                                                <div class="clear"></div>
                                                                                            </div>
                                                                                            -->
                                                                                            <div class="wc-pao-addon-container  wc-pao-addon wc-pao-addon-confirm" data-product-name="Enter Prescription Now" onclick="viewStage(4)">
                                                                                            	    <h3 class="wc-pao-addon-heading">Confirm</h3>
                                                                                            	<div class="clear"></div>
                                                                                            </div>


                                                                                            <div id="product-addons-total" data-show-sub-total="1" data-type="bundle" data-tax-mode="excl" data-tax-display-mode="excl" data-price="0" data-raw-price="0" data-product-id="387"></div>
                                                                                            <div class="bundle_wrap component_wrap">
                                                                                                <div class="bundle_price" style="display: none;"></div>
                                                                                                <div class="bundle_availability" style="display: none;"></div>
                                                                                                <div class="bundle_button">
                                                                                                    <div class="quantity">
                                                                                                        <label class="screen-reader-text" for="quantity_60ae2396c9dce">Enter Prescription Now quantity</label>
                                                                                                        <input
                                                                                                            type="number"
                                                                                                            id="quantity_60ae2396c9dce"
                                                                                                            class="input-text qty text"
                                                                                                            step="1"
                                                                                                            min="1"
                                                                                                            max=""
                                                                                                            name="wccp_component_quantity[1584107435]"
                                                                                                            value="1"
                                                                                                            title="Qty"
                                                                                                            size="4"
                                                                                                            placeholder=""
                                                                                                            inputmode="numeric"
                                                                                                        />
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div id="composite_navigation_394" class="composite_navigation movable paged standard">
                                                                                <div class="composite_navigation_inner">
                                                                                    <a onclick="viewStage('back')" class="page_button prev" href="#vision" rel="nofollow" aria-label="Go to Vision">Back</a>
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
                                                                    <div class="component_pagination cp_clearfix top" data-pagination_data='{"page":1,"pages":1}' style="display: none;">
                                                                        <p class="index woocommerce-result-count" tabindex="-1">Page 1 of 1</p>
                                                                        <nav class="woocommerce-pagination">
                                                                            <ul class="page-numbers">
                                                                                <li>
                                                                                    <span aria-current="page" class="page-numbers component_pagination_element number current" data-page_num="1">1</span>
                                                                                </li>
                                                                            </ul>
                                                                        </nav>
                                                                    </div>
                                                                    <div
                                                                        id="component_options_1584107435"
                                                                        class="component_options"
                                                                        data-options_data='[{"option_id":"387","option_title":"Enter Prescription Now","option_price_html":"&amp;nbsp;","option_thumbnail_html":"<img width=\"36\" height=\"36\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/edit.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":"","option_price_data":{"price":"0","regular_price":"0","max_price":"0","max_regular_price":"0","min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":true,"has_addons":true,"has_required_addons":true,"is_in_view":true,"option_description":"Add new prescription,\r\nthis will be saved for future use."},{"option_id":"396","option_title":"Upload Prescription","option_price_html":"&amp;nbsp;","option_thumbnail_html":"<img width=\"36\" height=\"34\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/upload.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":"","option_price_data":{"price":"0","regular_price":"0","max_price":"0","max_regular_price":"0","min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":true,"has_addons":true,"has_required_addons":true,"is_in_view":true,"option_description":"Take a photo of your paper prescription\r\nand your glasses will ship faster!"},{"option_id":"397","option_title":"Use Saved Prescription","option_price_html":"&amp;nbsp;","option_thumbnail_html":"<img width=\"36\" height=\"36\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/folder.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":"","option_price_data":{"price":"0","regular_price":"0","max_price":"0","max_regular_price":"0","min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":true,"has_addons":true,"has_required_addons":true,"is_in_view":true,"option_description":"Load a previously saved prescription\r\nfrom your account, requires login"}]'
                                                                        style="display: none;"
                                                                    >
                                                                        <div class="component_options_inner cp_clearfix">
                                                                            <div id="component_option_thumbnails_1584107435" class="component_option_thumbnails columns-3" data-component_option_columns="3">
                                                                                <ul class="component_option_thumbnails_container cp_clearfix" style="list-style: none;">
                                                                                    <li id="component_option_thumbnail_container_387" class="sandeep2press component_option_thumbnail_container first" style="margin-bottom: 20px;">
                                                                                        <div id="component_option_thumbnail_387" class="cp_clearfix component_option_thumbnail selected" data-val="387">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Enter Prescription Now2</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/edit.png"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    width="36"
                                                                                                    height="36"
                                                                                                />
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
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/upload.png"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    width="36"
                                                                                                    height="34"
                                                                                                />
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
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/folder.png"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    width="36"
                                                                                                    height="36"
                                                                                                />
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
                                                                    <div class="component_pagination cp_clearfix bottom" data-pagination_data='{"page":1,"pages":1}' style="display: none;">
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
                                                                    <a onclick="viewStage('back')" class="page_button prev" href="#vision" rel="nofollow" aria-label="Go to Vision">Back</a>
                                                                    <!-- <a class="page_button next " href="#lens-type" rel="nofollow" aria-label="Go to Lens Type">Lens Type</a> -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--stage 4-->
                                                        <div style="display:none;" id="component_1584107405_inner" class="component_inner">
                                                            <div class="component_description_wrapper">
                                                                <div class="component_description"><p>How will you provide your prescription?</p></div>
                                                            </div>
                                                            <div class="component_selections">
                                                                <div class="scroll_show_component_details"></div>
                                                                <div class="component_message top" style="display: none;">
                                                                    <div class="validation_message woocommerce-info">
                                                                        <ul style="list-style: none;">
                                                                            <li>Please choose an option to continue…</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
																<!-- second form -->
                                                                <div class="component_content" data-product_id="1584107435" style="height: auto; display: block;">
                                                                    <div class="component_summary cp_clearfix">
                                                                        <div class="product content summary_content populated initialized bundle_form">
                                                                            <div class="composited_product_title_wrapper" data-show_title="yes" tabindex="-1">
                                                                                <p class="component_section_title selected_option_label_wrapper">
                                                                                    <label class="selected_option_label">Your selection:</label>
                                                                                </p>
                                                        
                                                                                <h4 class="composited_product_title component_section_title product_title">Upload Prescription</h4>
                                                        
                                                                                <p class="component_section_title clear_component_options_wrapper">
                                                                                    <a class="clear_component_options" href="#">Clear selection</a>
                                                                                </p>
                                                                            </div>
                                                                            <div class="composited_product_details_wrapper">
                                                                                <div class="composited_product_images images" style="opacity: 1;">
                                                                                    <figure class="composited_product_image woocommerce-product-gallery__image">
                                                                                        <a href="https://directvisioneyewear.ca/wp-content/uploads/2020/05/upload.png" class="image zoom" title="upload.png" data-rel="photoSwipe">
                                                                                            <img
                                                                                                src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/upload.png"
                                                                                                class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                alt=""
                                                                                                loading="lazy"
                                                                                                title="upload.png"
                                                                                                data-caption=""
                                                                                                data-large_image="https://directvisioneyewear.ca/wp-content/uploads/2020/05/upload.png"
                                                                                                data-large_image_width="36"
                                                                                                data-large_image_height="34"
                                                                                                width="36"
                                                                                                height="34"
                                                                                            />
                                                                                        </a>
                                                                                    </figure>
                                                                                </div>
                                                                                <div class="details component_data">
                                                                                    <ul class="products bundled_products columns-3">
                                                                                        <li class="bundled_item_3 bundled_product bundled_product_summary product thumbnail_hidden bundled_item_hidden" style="display: none;">
                                                                                            <div class="details">
                                                                                                <h4 class="bundled_product_title product_title">
                                                                                                    <span class="bundled_product_title_inner"><span class="item_title">Right Eye</span><span class="item_qty"></span><span class="item_suffix"></span></span>
                                                                                                </h4>
                                                                                                <div
                                                                                                    class="cart"
                                                                                                    data-title="Right Eye"
                                                                                                    data-product_title="Right Eye"
                                                                                                    data-visible="no"
                                                                                                    data-optional_suffix=""
                                                                                                    data-optional="no"
                                                                                                    data-type="simple"
                                                                                                    data-bundled_item_id="3"
                                                                                                    data-custom_data="[]"
                                                                                                    data-product_id="405"
                                                                                                    data-bundle_id="396"
                                                                                                >
                                                                                                    <div class="bundled_item_wrap">
                                                                                                        <div class="bundled_item_cart_content">
                                                                                                            <div class="bundled_item_cart_details">
                                                                                                                <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-right-eye" data-product-name="Right Eye">
                                                                                                                    <h3 class="wc-pao-addon-heading">Right Eye</h3>
                                                        
                                                                                                                    <div class="clear"></div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    id="product-addons-total"
                                                                                                                    data-show-sub-total="1"
                                                                                                                    data-type="simple"
                                                                                                                    data-tax-mode="excl"
                                                                                                                    data-tax-display-mode="excl"
                                                                                                                    data-price="0"
                                                                                                                    data-raw-price="0"
                                                                                                                    data-product-id="405"
                                                                                                                    style="display: none;"
                                                                                                                ></div>
                                                                                                            </div>
                                                                                                            <div class="bundled_item_after_cart_details bundled_item_button">
                                                                                                                <div class="quantity quantity_hidden">
                                                                                                                    <input class="qty bundled_qty" type="hidden" name="component_1584107435_bundle_quantity_3" value="1" />
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li class="bundled_item_4 bundled_product bundled_product_summary product thumbnail_hidden bundled_item_hidden" style="display: none;">
                                                                                            <div class="details">
                                                                                                <h4 class="bundled_product_title product_title">
                                                                                                    <span class="bundled_product_title_inner"><span class="item_title">Left Eye</span><span class="item_qty"></span><span class="item_suffix"></span></span>
                                                                                                </h4>
                                                                                                <div
                                                                                                    class="cart"
                                                                                                    data-title="Left Eye"
                                                                                                    data-product_title="Left Eye"
                                                                                                    data-visible="no"
                                                                                                    data-optional_suffix=""
                                                                                                    data-optional="no"
                                                                                                    data-type="simple"
                                                                                                    data-bundled_item_id="4"
                                                                                                    data-custom_data="[]"
                                                                                                    data-product_id="406"
                                                                                                    data-bundle_id="396"
                                                                                                >
                                                                                                    <div class="bundled_item_wrap">
                                                                                                        <div class="bundled_item_cart_content">
                                                                                                            <div class="bundled_item_cart_details">
                                                                                                                <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-left-eye" data-product-name="Left Eye">
                                                                                                                    <h3 class="wc-pao-addon-heading">Left Eye</h3>
                                                        
                                                                                                                    <div class="clear"></div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    id="product-addons-total"
                                                                                                                    data-show-sub-total="1"
                                                                                                                    data-type="simple"
                                                                                                                    data-tax-mode="excl"
                                                                                                                    data-tax-display-mode="excl"
                                                                                                                    data-price="0"
                                                                                                                    data-raw-price="0"
                                                                                                                    data-product-id="406"
                                                                                                                    style="display: none;"
                                                                                                                ></div>
                                                                                                            </div>
                                                                                                            <div class="bundled_item_after_cart_details bundled_item_button">
                                                                                                                <div class="quantity quantity_hidden">
                                                                                                                    <input class="qty bundled_qty" type="hidden" name="component_1584107435_bundle_quantity_4" value="1" />
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li class="sv-add-text pro-396"><span>If reading or progressive prescription, enter "Add" values</span></li>
                                                                                    </ul>
                                                                                    <div
                                                                                        class="cart bundle_data bundle_data_396"
                                                                                        data-bundle_id="396"
                                                                                    >
                                                                                        <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-upload-prescription" data-product-name="Upload Prescription">
                                                                                            <h3 class="wc-pao-addon-heading">Upload Prescription *</h3>
                                                        
                                                                                            <div class="clear"></div>
                                                                                        </div>
                                                        
                                                                                        <div class="wc-pao-addon-container wc-pao-required-addon wc-pao-addon wc-pao-addon-upload-your-prescription" data-product-name="Upload Prescription">
                                                                                            <label for="addon-1584107435-upload-your-prescription-1" class="wc-pao-addon-name" data-addon-name="Upload your prescription" data-has-per-person-pricing="" data-has-per-block-pricing="">
                                                                                                Upload your prescription <em class="required" title="Required field">*</em>&nbsp;
                                                                                            </label>
                                                                                            <div class="wc-pao-addon-description"><p>Allowed Types (PDF, PNG, JPEG, JPG)</p></div>
                                                        
                                                                                            <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-upload-your-prescription-1">
                                                                                                <input
                                                                                                onchange="loadFile(event)"
                                                                                                    type="file"
                                                                                                    class="wc-pao-addon-file-upload input-text wc-pao-addon-field"
                                                                                                    data-raw-price=""
                                                                                                    data-price=""
                                                                                                    data-price-type="flat_fee"
                                                                                                    name="addon-1584107435-upload-your-prescription-1"
                                                                                                    id="addon-1584107435-upload-your-prescription-1"
                                                                                                />
                                                                                                <small>(max file size 200 MB)</small>
                                                                                            </p>
                                                        
                                                                                            <div class="clear"></div>
                                                                                        </div>
                                                        
                                                                                        <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-file-preview" data-product-name="Upload Prescription">
                                                                                            <h3 class="wc-pao-addon-heading">File Preview</h3>
                                                        
                                                                                            <div class="clear"></div>
                                                                                        </div>
                                                        
                                                                                        <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-my-pupillary-distance-pd-is-listed-on-my-prescription" data-product-name="Upload Prescription">
                                                                                            <!--<label class="wc-pao-addon-name" data-addon-name="My Pupillary Distance (PD) is listed on my prescription" data-has-per-person-pricing="" data-has-per-block-pricing="" style="display: none;"></label>-->
                                                        
                                                                                         <!--   <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-my-pupillary-distance-pd-is-list-3-0">
                                                                                                <label>
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="wc-pao-addon-field wc-pao-addon-checkbox"
                                                                                                        name="addon-1584107435-my-pupillary-distance-pd-is-list-3[]"
                                                                                                        data-raw-price=""
                                                                                                        data-price=""
                                                                                                        data-price-type="flat_fee"
                                                                                                        value="my-pupillary-distance-pd-is-listed-on-my-prescription"
                                                                                                        data-label="My Pupillary Distance (PD) is listed on my prescription"
                                                                                                    />
                                                                                                    My Pupillary Distance (PD) is listed on my prescription
                                                                                                </label>
                                                                                            </p>-->
                                                        
                                                                                            <div class="clear"></div>
                                                                                        </div>
                                                        
                                                                                       <!-- <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-space-and-border" data-product-name="Upload Prescription">
                                                                                            <h3 class="wc-pao-addon-heading">Space and Border</h3>
                                                        
                                                                                            <div class="clear"></div>
                                                                                        </div>-->
                                                        
                                                                                       <!-- <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-pupillary-distance-pd" data-product-name="Upload Prescription">
                                                                                            <h3 class="wc-pao-addon-heading">Pupillary Distance (PD)</h3>
                                                        
                                                                                            <div class="clear"></div>
                                                                                        </div>-->
                                                        
                                                                                        
                                                        
                                                                                        <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-who-is-the-prescription-for" data-product-name="Upload Prescription">
                                                                                            <h3 class="wc-pao-addon-heading">Who is the prescription for? *</h3>
                                                        
                                                                                            <div class="clear"></div>
                                                                                        </div>
                                                        
                                                                                        <div class="wc-pao-addon-container wc-pao-required-addon wc-pao-addon wc-pao-addon-first-name" data-product-name="Upload Prescription">
                                                                                            <label for="addon-1584107435-first-name-12" class="wc-pao-addon-name" data-addon-name="First Name" data-has-per-person-pricing="" data-has-per-block-pricing="">
                                                                                                First Name <em class="required" title="Required field">*</em>&nbsp;
                                                                                            </label>
                                                        
                                                                                            <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-first-name-12">
                                                                                                <input
                                                                                                    type="text"
                                                                                                    class="input-text wc-pao-addon-field wc-pao-addon-custom-text"
                                                                                                    data-raw-price=""
                                                                                                    data-price=""
                                                                                                    name="addon-1584107435-first-name-12"
                                                                                                    id="addon-1584107435-first-name-12"
                                                                                                    data-price-type="flat_fee"
                                                                                                    value=""
                                                                                                    maxlength="20"
                                                                                                    pattern="[A-Za-z0-9-]+"
                                                                                                    title="Only letters and numbers"
                                                                                                />
                                                                                                <small class="wc-pao-addon-chars-remaining"><span>20</span> characters remaining</small>
                                                                                            </p>
                                                        
                                                                                            <div class="clear"></div>
                                                                                        </div>
                                                        
                                                                                        <div class="wc-pao-addon-container wc-pao-required-addon wc-pao-addon wc-pao-addon-last-name" data-product-name="Upload Prescription">
                                                                                            <label for="addon-1584107435-last-name-13" class="wc-pao-addon-name" data-addon-name="Last Name" data-has-per-person-pricing="" data-has-per-block-pricing="">
                                                                                                Last Name <em class="required" title="Required field">*</em>&nbsp;
                                                                                            </label>
                                                        
                                                                                            <p class="form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107435-last-name-13">
                                                                                                <input
                                                                                                    type="text"
                                                                                                    class="input-text wc-pao-addon-field wc-pao-addon-custom-text"
                                                                                                    data-raw-price=""
                                                                                                    data-price=""
                                                                                                    name="addon-1584107435-last-name-13"
                                                                                                    id="addon-1584107435-last-name-13"
                                                                                                    data-price-type="flat_fee"
                                                                                                    value=""
                                                                                                    maxlength="20"
                                                                                                    pattern="[A-Za-z0-9-]+"
                                                                                                    title="Only letters and numbers"
                                                                                                />
                                                                                                <small class="wc-pao-addon-chars-remaining"><span>20</span> characters remaining</small>
                                                                                            </p>
                                                        
                                                                                            <div class="clear"></div>
                                                                                        </div>
                                                        
                                                                                        <div class="wc-pao-addon-container wc-pao-addon wc-pao-addon-confirm" data-product-name="Upload Prescription">
                                                                                            <input type="submit" name="second_form" class="wc-pao-addon-heading" value="confirm">
                                                        
                                                                                            <div class="clear"></div>
                                                                                        </div>
                                                                                        <div id="product-addons-total" data-show-sub-total="1" data-type="bundle" data-tax-mode="excl" data-tax-display-mode="excl" data-price="0" data-raw-price="0" data-product-id="396"></div>
                                                                                        <div class="bundle_wrap component_wrap">
                                                                                            <div class="bundle_price" style="display: none;"></div>
                                                                                            <div class="bundle_availability" style="display: none;"></div>
                                                                                            <div class="bundle_button">
                                                                                                <div class="quantity">
                                                                                                    <label class="screen-reader-text" for="quantity_60ae5f6f069a9">Upload Prescription quantity</label>
                                                                                                    <input
                                                                                                        type="number"
                                                                                                        id="quantity_60ae5f6f069a9"
                                                                                                        class="input-text qty text"
                                                                                                        step="1"
                                                                                                        min="1"
                                                                                                        max=""
                                                                                                        name="wccp_component_quantity[1584107435]"
                                                                                                        value="1"
                                                                                                        title="Qty"
                                                                                                        size="4"
                                                                                                        placeholder=""
                                                                                                        inputmode="numeric"
                                                                                                    />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="composite_navigation_394" class="composite_navigation movable paged standard">
                                                                            <div class="composite_navigation_inner">
                                                                                <a onclick="viewStage('back')" class="page_button prev" href="#vision" rel="nofollow" aria-label="Go to Vision">Back</a>
                                                                                <!-- <a class="page_button next " href="#lens-type" rel="nofollow" aria-label="Go to Lens Type">Lens Type</a> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
																<!-- second form -->
                                                                <p class="component_section_title">
                                                                    <label class="select_label"> Available options: </label>
                                                                </p>
                                                                <div class="component_pagination cp_clearfix top" data-pagination_data='{"page":1,"pages":1}' style="display: none;">
                                                                    <p class="index woocommerce-result-count" tabindex="-1">Page 1 of 1</p>
                                                                    <nav class="woocommerce-pagination">
                                                                        <ul class="page-numbers">
                                                                            <li>
                                                                                <span aria-current="page" class="page-numbers component_pagination_element number current" data-page_num="1">1</span>
                                                                            </li>
                                                                        </ul>
                                                                    </nav>
                                                                </div>
                                                                <div class="component_pagination cp_clearfix bottom" data-pagination_data='{"page":1,"pages":1}' style="display: none;">
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
                                                        
                                                        <!--stage 6-->
                                                        <div style="display:none;" id="component_1584107436" class="composite_component component paged options-style-thumbnails paginate-results multistep autotransition active" data-nav_title="Lens Type" data-item_id="1584107436" style="height: auto; display: block;">
                                                            <div id="composite_navigation_394" class="composite_navigation top paged standard">
                                                                <div class="composite_navigation_inner">
                                                                    <a onclick="viewStage('back')" class="page_button prev" href="#vision" rel="nofollow" aria-label="Go to Vision">Back</a>
                                                                    <!-- <a class="page_button next " href="#enhance" rel="nofollow" aria-label="Go to Enhance">Enhance</a> -->
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="component_title_wrapper">
                                                                <h2 class="step_title_wrapper component_title">
                                                                    <span class="aria_title" aria-label="Lens Type" tabindex="-1">Lens Type</span>
                                                                    <span class="component_title_text step_title_text"><span class="step_index">2</span> <span class="step_title">Lens Type</span></span>
                                                                </h2>
                                                            </div>
                                                        
                                                            <div id="component_1584107436_inner" class="component_inner">
                                                                <div class="component_description_wrapper">
                                                                    <div class="component_description"><p>Choose a lens that best fit your lifestyle</p></div>
                                                                </div>
                                                                <div class="component_selections">
                                                                    <div class="scroll_show_component_details"></div>
                                                                    <div class="component_message top" style="display: none;">
                                                                        <div class="validation_message woocommerce-info">
                                                                            <ul style="list-style: none;">
                                                                                <li>Please choose product options to continue…</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="component_content" data-product_id="1584107436" style="height: auto; display: none;">
                                                                        <div class="component_summary cp_clearfix">
                                                                            <div class="product content summary_content populated cart" current-image="">
                                                                                <div class="composited_product_title_wrapper" data-show_title="yes" tabindex="-1">
                                                                                    <p class="component_section_title selected_option_label_wrapper">
                                                                                        <label class="selected_option_label">Your selection:</label>
                                                                                    </p>
                                                        
                                                                                    <h4 class="composited_product_title component_section_title product_title">Clear</h4>
                                                        
                                                                                    <p class="component_section_title clear_component_options_wrapper">
                                                                                        <a class="clear_component_options" href="#">Clear selection</a>
                                                                                    </p>
                                                                                </div>
                                                                                <div class="composited_product_details_wrapper">
                                                                                    <div class="composited_product_images images" style="opacity: 1;">
                                                                                        <figure class="composited_product_image woocommerce-product-gallery__image">
                                                                                            <a href="https://directvisioneyewear.ca/wp-content/uploads/2020/05/clear-ico.png" class="image zoom" title="clear-ico.png" data-rel="photoSwipe">
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/clear-ico.png"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    title="clear-ico.png"
                                                                                                    data-caption=""
                                                                                                    data-large_image="https://directvisioneyewear.ca/wp-content/uploads/2020/05/clear-ico.png"
                                                                                                    data-large_image_width="36"
                                                                                                    data-large_image_height="36"
                                                                                                    width="36"
                                                                                                    height="36"
                                                                                                />
                                                                                            </a>
                                                                                        </figure>
                                                                                    </div>
                                                                                    <div class="details component_data">
                                                                                        <div class="component_wrap">
                                                                                            <span class="price">
                                                                                                <span class="woocommerce-Price-amount amount">
                                                                                                    <bdi><span class="woocommerce-Price-currencySymbol">$</span>0.00</bdi>
                                                                                                </span>
                                                                                                <span class="component_option_each">each</span>
                                                                                            </span>
                                                                                            <div class="quantity_button">
                                                                                                <div class="quantity">
                                                                                                    <label class="screen-reader-text" for="quantity_60ae1f2396fb3">Clear quantity</label>
                                                                                                    <input
                                                                                                        type="number"
                                                                                                        id="quantity_60ae1f2396fb3"
                                                                                                        class="input-text qty text"
                                                                                                        step="1"
                                                                                                        min="1"
                                                                                                        max=""
                                                                                                        name="wccp_component_quantity[1584107436]"
                                                                                                        value="1"
                                                                                                        title="Qty"
                                                                                                        size="4"
                                                                                                        placeholder=""
                                                                                                        inputmode="numeric"
                                                                                                    />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div id="composite_navigation_394" class="composite_navigation movable paged standard">
                                                                                <div class="composite_navigation_inner">
                                                                                    <a onclick="viewStage('back')" class="page_button prev" href="#vision" rel="nofollow" aria-label="Go to Vision">Back</a>
                                                                                    <!-- <a class="page_button next " href="#enhance" rel="nofollow" aria-label="Go to Enhance">Enhance</a> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <p class="component_section_title">
                                                                        <label class="select_label"> Available options: </label>
                                                                    </p>
                                                                    <div class="component_pagination cp_clearfix top" data-pagination_data='{"page":1,"pages":1}' style="display: none;">
                                                                        <p class="index woocommerce-result-count" tabindex="-1">Page 1 of 1</p>
                                                                        <nav class="woocommerce-pagination">
                                                                            <ul class="page-numbers">
                                                                                <li>
                                                                                    <span aria-current="page" class="page-numbers component_pagination_element number current" data-page_num="1">1</span>
                                                                                </li>
                                                                            </ul>
                                                                        </nav>
                                                                    </div>
                                                                    <div
                                                                        id="component_options_1584107436"
                                                                        class="component_options"
                                                                        data-options_data='[{"option_id":"391","option_title":"Clear","option_price_html":"Included","option_thumbnail_html":"<img width=\"36\" height=\"36\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/clear-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":{"price":"0","regular_price":"0","product_type":"simple","variation_id":"","variations_data":false,"tax_ratios":{"incl":1,"excl":1},"image_data":{"image_src":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/clear-ico.png","image_srcset":"","image_sizes":"(max-width: 36px) 100vw, 36px","image_title":"Clear"},"stock_status":"in-stock","product_html":"\t<div class=\"composited_product_title_wrapper\" data-show_title=\"yes\" tabindex=\"-1\"><\/div>\n\t<div class=\"composited_product_details_wrapper\"><div class=\"composited_product_images images\"><figure class=\"composited_product_image woocommerce-product-gallery__image\"><a href=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/clear-ico.png\" class=\"image zoom\" title=\"clear-ico.png\" data-rel=\"photoSwipe\"><img width=\"36\" height=\"36\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/clear-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" title=\"clear-ico.png\" data-caption=\"\" data-large_image=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/clear-ico.png\" data-large_image_width=\"36\" data-large_image_height=\"36\" \/><\/a><\/figure><\/div>\n<div class=\"details component_data\"><div class=\"component_wrap\"><span class=\"price\"><span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">&amp;#36;<\/span>0.00<\/bdi><\/span> <span class=\"component_option_each\">each<\/span><\/span>\n<div class=\"quantity_button\">\t<div class=\"quantity\">\n\t\t\t\t<label class=\"screen-reader-text\" for=\"quantity_60ae1f2396fb3\">Clear quantity<\/label>\n\t\t<input\n\t\t\ttype=\"number\"\n\t\t\tid=\"quantity_60ae1f2396fb3\"\n\t\t\tclass=\"input-text qty text\"\n\t\t\tstep=\"1\"\n\t\t\tmin=\"1\"\n\t\t\tmax=\"\"\n\t\t\tname=\"wccp_component_quantity[1584107436]\"\n\t\t\tvalue=\"1\"\n\t\t\ttitle=\"Qty\"\n\t\t\tsize=\"4\"\n\t\t\tplaceholder=\"\"\n\t\t\tinputmode=\"numeric\" \/>\n\t\t\t<\/div>\n\t<\/div>\n\t<\/div>\n<\/div>\n\n<\/div>"},"option_price_data":{"price":"0","regular_price":"0","max_price":"0","max_regular_price":"0","min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":false,"has_addons":false,"has_required_addons":false,"is_in_view":true,"option_description":"Transparent lenses perfect for a wide range of\r\nprescriptions and everyday use."},{"option_id":"399","option_title":"Azure Blue Filter","option_price_html":"<span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">&amp;#36;<\/span>30.00<\/bdi><\/span> <span class=\"component_option_each\">each<\/span>","option_thumbnail_html":"<img width=\"32\" height=\"38\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/security.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":{"price":"30","regular_price":"30","product_type":"simple","variation_id":"","variations_data":false,"tax_ratios":{"incl":1,"excl":1},"image_data":{"image_src":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/security.png","image_srcset":"","image_sizes":"(max-width: 32px) 100vw, 32px","image_title":"Azure Blue Filter"},"stock_status":"in-stock","product_html":"\t<div class=\"composited_product_title_wrapper\" data-show_title=\"yes\" tabindex=\"-1\"><\/div>\n\t<div class=\"composited_product_details_wrapper\"><div class=\"composited_product_images images\"><figure class=\"composited_product_image woocommerce-product-gallery__image\"><a href=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/security.png\" class=\"image zoom\" title=\"security\" data-rel=\"photoSwipe\"><img width=\"32\" height=\"38\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/security.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" title=\"security\" data-caption=\"\" data-large_image=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/security.png\" data-large_image_width=\"32\" data-large_image_height=\"38\" \/><\/a><\/figure><\/div>\n<div class=\"details component_data\"><div class=\"component_wrap\"><span class=\"price\"><span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">&amp;#36;<\/span>30.00<\/bdi><\/span> <span class=\"component_option_each\">each<\/span><\/span>\n<div class=\"quantity_button\">\t<div class=\"quantity\">\n\t\t\t\t<label class=\"screen-reader-text\" for=\"quantity_60ae1f23991af\">Azure Blue Filter quantity<\/label>\n\t\t<input\n\t\t\ttype=\"number\"\n\t\t\tid=\"quantity_60ae1f23991af\"\n\t\t\tclass=\"input-text qty text\"\n\t\t\tstep=\"1\"\n\t\t\tmin=\"1\"\n\t\t\tmax=\"\"\n\t\t\tname=\"wccp_component_quantity[1584107436]\"\n\t\t\tvalue=\"1\"\n\t\t\ttitle=\"Qty\"\n\t\t\tsize=\"4\"\n\t\t\tplaceholder=\"\"\n\t\t\tinputmode=\"numeric\" \/>\n\t\t\t<\/div>\n\t<\/div>\n\t<\/div>\n<\/div>\n\n<\/div>"},"option_price_data":{"price":30,"regular_price":30,"max_price":30,"max_regular_price":30,"min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":false,"has_addons":false,"has_required_addons":false,"is_in_view":true,"option_description":"Blue blocking technology to protect your eyes from harmful digital blue light of phone &amp; computer screens.  100% UV protection."},{"option_id":"392","option_title":"Transitions \u00ae","option_price_html":"<span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">&amp;#36;<\/span>59.00<\/bdi><\/span> <span class=\"component_option_each\">each<\/span>","option_thumbnail_html":"<img width=\"52\" height=\"38\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/light-adap-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":{"price":"59","regular_price":"59","product_type":"simple","variation_id":"","variations_data":false,"tax_ratios":{"incl":1,"excl":1},"image_data":{"image_src":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/light-adap-ico.png","image_srcset":"","image_sizes":"(max-width: 52px) 100vw, 52px","image_title":"Transitions \u00ae"},"stock_status":"in-stock","product_html":"\t<div class=\"composited_product_title_wrapper\" data-show_title=\"yes\" tabindex=\"-1\"><\/div>\n\t<div class=\"composited_product_details_wrapper\"><div class=\"composited_product_images images\"><figure class=\"composited_product_image woocommerce-product-gallery__image\"><a href=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/light-adap-ico.png\" class=\"image zoom\" title=\"light-adap-ico.png\" data-rel=\"photoSwipe\"><img width=\"52\" height=\"38\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/light-adap-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" title=\"light-adap-ico.png\" data-caption=\"\" data-large_image=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/light-adap-ico.png\" data-large_image_width=\"52\" data-large_image_height=\"38\" \/><\/a><\/figure><\/div>\n<div class=\"details component_data\"><div class=\"component_wrap\"><span class=\"price\"><span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">&amp;#36;<\/span>59.00<\/bdi><\/span> <span class=\"component_option_each\">each<\/span><\/span>\n\n<div class=\"wc-pao-addon-container wc-pao-required-addon wc-pao-addon wc-pao-addon-color\" data-product-name=\"Transitions \u00ae\">\n\n\t\n\t\t\t\t\t\t<label class=\"wc-pao-addon-name\" data-addon-name=\"Color\" data-has-per-person-pricing=\"\" data-has-per-block-pricing=\"\" style=\"display:none;\"><\/label>\n\t\t\t\t\t\t\n\t\n<p class=\"form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107436-color-0\">\n\n\t\t<a href=\"#\" title=\"Brown &amp;lt;span class=&amp;quot;woocommerce-Price-amount amount&amp;quot;&amp;gt;&amp;lt;bdi&amp;gt;&amp;lt;span class=&amp;quot;woocommerce-Price-currencySymbol&amp;quot;&amp;gt;&amp;#036;&amp;lt;\/span&amp;gt;0.00&amp;lt;\/bdi&amp;gt;&amp;lt;\/span&amp;gt;\" class=\"wc-pao-addon-image-swatch\" data-value=\"brown-1\" data-price=\"&amp;lt;span class=&amp;quot;wc-pao-addon-image-swatch-price&amp;quot;&amp;gt;Brown &amp;lt;\/span&amp;gt;\">\n\t\t\t<img src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/icon-lense-brown.png\" \/>\n\t\t<\/a>\n\t\t<a href=\"#\" title=\"Gray &amp;lt;span class=&amp;quot;woocommerce-Price-amount amount&amp;quot;&amp;gt;&amp;lt;bdi&amp;gt;&amp;lt;span class=&amp;quot;woocommerce-Price-currencySymbol&amp;quot;&amp;gt;&amp;#036;&amp;lt;\/span&amp;gt;0.00&amp;lt;\/bdi&amp;gt;&amp;lt;\/span&amp;gt;\" class=\"wc-pao-addon-image-swatch\" data-value=\"gray-2\" data-price=\"&amp;lt;span class=&amp;quot;wc-pao-addon-image-swatch-price&amp;quot;&amp;gt;Gray &amp;lt;\/span&amp;gt;\">\n\t\t\t<img src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/icon-lense-gray.png\" \/>\n\t\t<\/a>\n\n<select class=\"wc-pao-addon-image-swatch-select wc-pao-addon-field\" name=\"addon-1584107436-color-0\">\n\t\t\t<option value=\"\">Select an option...<\/option>\n\t\t\t<option data-raw-price=\"\" data-price=\"\" data-price-type=\"flat_fee\" value=\"brown-1\" data-label=\"Brown\">Brown <\/option>\n\t\t\t<option data-raw-price=\"\" data-price=\"\" data-price-type=\"flat_fee\" value=\"gray-2\" data-label=\"Gray\">Gray <\/option>\n\t\n<\/select>\n<\/p>\n\t\n\t<div class=\"clear\"><\/div>\n<\/div>\n<div id=\"product-addons-total\" data-show-sub-total=\"1\" data-type=\"simple\" data-tax-mode=\"excl\" data-tax-display-mode=\"excl\" data-price=\"59\" data-raw-price=\"59\" data-product-id=\"392\"><\/div><div class=\"quantity_button\">\t<div class=\"quantity\">\n\t\t\t\t<label class=\"screen-reader-text\" for=\"quantity_60ae1f239c1d1\">Transitions \u00ae quantity<\/label>\n\t\t<input\n\t\t\ttype=\"number\"\n\t\t\tid=\"quantity_60ae1f239c1d1\"\n\t\t\tclass=\"input-text qty text\"\n\t\t\tstep=\"1\"\n\t\t\tmin=\"1\"\n\t\t\tmax=\"\"\n\t\t\tname=\"wccp_component_quantity[1584107436]\"\n\t\t\tvalue=\"1\"\n\t\t\ttitle=\"Qty\"\n\t\t\tsize=\"4\"\n\t\t\tplaceholder=\"\"\n\t\t\tinputmode=\"numeric\" \/>\n\t\t\t<\/div>\n\t<\/div>\n\t<\/div>\n<\/div>\n\n<\/div>"},"option_price_data":{"price":59,"regular_price":59,"max_price":59,"max_regular_price":59,"min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":true,"has_addons":true,"has_required_addons":true,"is_in_view":true,"option_description":"Adjust from fully clear indoors to a perfect tint outdoors,\r\n100% UV protection"},{"option_id":"393","option_title":"Sunglasses","option_price_html":"Options","option_thumbnail_html":"<img width=\"38\" height=\"38\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/sunglasses-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":"","option_price_data":{"price":20,"regular_price":20,"max_price":113,"max_regular_price":113,"min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":true,"has_addons":false,"has_required_addons":false,"is_in_view":true,"option_description":"Turn any frame into Rx sunglasses. Option of\r\ndark tints, polarized or mirror tints.<br>100% UV protection"},{"option_id":"19595","option_title":"Transitions \u00ae","option_price_html":"<span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">&amp;#36;<\/span>48.00<\/bdi><\/span> <span class=\"component_option_each\">each<\/span>","option_thumbnail_html":"<img width=\"52\" height=\"38\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/light-adap-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":{"price":"48","regular_price":"48","product_type":"simple","variation_id":"","variations_data":false,"tax_ratios":{"incl":1,"excl":1},"image_data":{"image_src":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/light-adap-ico.png","image_srcset":"","image_sizes":"(max-width: 52px) 100vw, 52px","image_title":"Transitions \u00ae"},"stock_status":"in-stock","product_html":"\t<div class=\"composited_product_title_wrapper\" data-show_title=\"yes\" tabindex=\"-1\"><\/div>\n\t<div class=\"composited_product_details_wrapper\"><div class=\"composited_product_images images\"><figure class=\"composited_product_image woocommerce-product-gallery__image\"><a href=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/light-adap-ico.png\" class=\"image zoom\" title=\"light-adap-ico.png\" data-rel=\"photoSwipe\"><img width=\"52\" height=\"38\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/light-adap-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" title=\"light-adap-ico.png\" data-caption=\"\" data-large_image=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/light-adap-ico.png\" data-large_image_width=\"52\" data-large_image_height=\"38\" \/><\/a><\/figure><\/div>\n<div class=\"details component_data\"><div class=\"component_wrap\"><span class=\"price\"><span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">&amp;#36;<\/span>48.00<\/bdi><\/span> <span class=\"component_option_each\">each<\/span><\/span>\n\n<div class=\"wc-pao-addon-container wc-pao-required-addon wc-pao-addon wc-pao-addon-color\" data-product-name=\"Transitions \u00ae\">\n\n\t\n\t\t\t\t\t\t<label class=\"wc-pao-addon-name\" data-addon-name=\"Color\" data-has-per-person-pricing=\"\" data-has-per-block-pricing=\"\" style=\"display:none;\"><\/label>\n\t\t\t\t\t\t\n\t\n<p class=\"form-row form-row-wide wc-pao-addon-wrap wc-pao-addon-1584107436-color-0\">\n\n\t\t<a href=\"#\" title=\"Brown &amp;lt;span class=&amp;quot;woocommerce-Price-amount amount&amp;quot;&amp;gt;&amp;lt;bdi&amp;gt;&amp;lt;span class=&amp;quot;woocommerce-Price-currencySymbol&amp;quot;&amp;gt;&amp;#036;&amp;lt;\/span&amp;gt;0.00&amp;lt;\/bdi&amp;gt;&amp;lt;\/span&amp;gt;\" class=\"wc-pao-addon-image-swatch\" data-value=\"brown-1\" data-price=\"&amp;lt;span class=&amp;quot;wc-pao-addon-image-swatch-price&amp;quot;&amp;gt;Brown &amp;lt;\/span&amp;gt;\">\n\t\t\t<img src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/icon-lense-brown.png\" \/>\n\t\t<\/a>\n\t\t<a href=\"#\" title=\"Gray &amp;lt;span class=&amp;quot;woocommerce-Price-amount amount&amp;quot;&amp;gt;&amp;lt;bdi&amp;gt;&amp;lt;span class=&amp;quot;woocommerce-Price-currencySymbol&amp;quot;&amp;gt;&amp;#036;&amp;lt;\/span&amp;gt;0.00&amp;lt;\/bdi&amp;gt;&amp;lt;\/span&amp;gt;\" class=\"wc-pao-addon-image-swatch\" data-value=\"gray-2\" data-price=\"&amp;lt;span class=&amp;quot;wc-pao-addon-image-swatch-price&amp;quot;&amp;gt;Gray &amp;lt;\/span&amp;gt;\">\n\t\t\t<img src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/icon-lense-gray.png\" \/>\n\t\t<\/a>\n\n<select class=\"wc-pao-addon-image-swatch-select wc-pao-addon-field\" name=\"addon-1584107436-color-0\">\n\t\t\t<option value=\"\">Select an option...<\/option>\n\t\t\t<option data-raw-price=\"\" data-price=\"\" data-price-type=\"flat_fee\" value=\"brown-1\" data-label=\"Brown\">Brown <\/option>\n\t\t\t<option data-raw-price=\"\" data-price=\"\" data-price-type=\"flat_fee\" value=\"gray-2\" data-label=\"Gray\">Gray <\/option>\n\t\n<\/select>\n<\/p>\n\t\n\t<div class=\"clear\"><\/div>\n<\/div>\n<div id=\"product-addons-total\" data-show-sub-total=\"1\" data-type=\"simple\" data-tax-mode=\"excl\" data-tax-display-mode=\"excl\" data-price=\"48\" data-raw-price=\"48\" data-product-id=\"19595\"><\/div><div class=\"quantity_button\">\t<div class=\"quantity\">\n\t\t\t\t<label class=\"screen-reader-text\" for=\"quantity_60ae1f23a15ec\">Transitions \u00ae quantity<\/label>\n\t\t<input\n\t\t\ttype=\"number\"\n\t\t\tid=\"quantity_60ae1f23a15ec\"\n\t\t\tclass=\"input-text qty text\"\n\t\t\tstep=\"1\"\n\t\t\tmin=\"1\"\n\t\t\tmax=\"\"\n\t\t\tname=\"wccp_component_quantity[1584107436]\"\n\t\t\tvalue=\"1\"\n\t\t\ttitle=\"Qty\"\n\t\t\tsize=\"4\"\n\t\t\tplaceholder=\"\"\n\t\t\tinputmode=\"numeric\" \/>\n\t\t\t<\/div>\n\t<\/div>\n\t<\/div>\n<\/div>\n\n<\/div>"},"option_price_data":{"price":48,"regular_price":48,"max_price":48,"max_regular_price":48,"min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":true,"has_addons":true,"has_required_addons":true,"is_in_view":true,"option_description":"Adjust from fully clear indoors to a perfect tint outdoors,\r\n100% UV protection"},{"option_id":"19599","option_title":"Sunglasses","option_price_html":"Continue","option_thumbnail_html":"<img width=\"38\" height=\"38\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/05\/sunglasses-ico.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" \/>","option_product_data":"","option_price_data":{"price":20,"regular_price":20,"max_price":113,"max_regular_price":113,"min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":true,"has_addons":false,"has_required_addons":false,"is_in_view":true,"option_description":"Turn any frame into Rx sunglasses. Option of\r\ndark tints, polarized or mirror tints.\r\n100% UV protection"}]'
                                                                        style="display: block;"
                                                                    >
                                                                        <div class="component_options_inner cp_clearfix">
                                                                            <div id="component_option_thumbnails_1584107436" class="component_option_thumbnails columns-3" data-component_option_columns="3">
                                                                                <ul class="component_option_thumbnails_container cp_clearfix" style="list-style: none;">
                                                                                    <li id="component_option_thumbnail_container_391" class="component_option_thumbnail_container first" style="margin-bottom: 20px; height: 256px;">
                                                                                        <div id="component_option_thumbnail_391" class="cp_clearfix component_option_thumbnail selected" data-val="391">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Clear</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/clear-ico.png"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    width="36"
                                                                                                    height="36"
                                                                                                />
                                                                                            </div>
                                                                                            <div class="thumbnail_description">
                                                                                                <p>Transparent lenses perfect for a wide range of prescriptions and everyday use.</p>
                                                        
                                                                                                <span class="thumbnail_price price">Included</span>
                                                                                            </div>
                                                                                            <div class="thumbnail_buttons">
                                                                                                <button class="button component_option_thumbnail_select" aria-label="Select Clear">Select</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                        
                                                                                    <li id="component_option_thumbnail_container_399" class="component_option_thumbnail_container" style="margin-bottom: 20px; height: 256px;">
                                                                                        <div id="component_option_thumbnail_399" class="cp_clearfix component_option_thumbnail" data-val="399">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Azure Blue Filter</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/security.png"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    width="32"
                                                                                                    height="38"
                                                                                                />
                                                                                            </div>
                                                                                            <div class="thumbnail_description">
                                                                                                <p>Blue blocking technology to protect your eyes from harmful digital blue light of phone &amp; computer screens. 100% UV protection.</p>
                                                        
                                                                                                <span class="thumbnail_price price">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span>30.00</bdi>
                                                                                                    </span>
                                                                                                    <span class="component_option_each">each</span>
                                                                                                </span>
                                                                                            </div>
                                                                                            <div class="thumbnail_buttons">
                                                                                                <button class="button component_option_thumbnail_select" aria-label="Select Azure Blue Filter">Select</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                        
                                                                                    <li id="component_option_thumbnail_container_392" class="component_option_thumbnail_container last" style="margin-bottom: 20px; height: 256px;">
                                                                                        <div id="component_option_thumbnail_392" class="cp_clearfix component_option_thumbnail" data-val="392">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Transitions ®</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/light-adap-ico.png"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    width="52"
                                                                                                    height="38"
                                                                                                />
                                                                                            </div>
                                                                                            <div class="thumbnail_description">
                                                                                                <p>Adjust from fully clear indoors to a perfect tint outdoors, 100% UV protection</p>
                                                        
                                                                                                <span class="thumbnail_price price">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span>59.00</bdi>
                                                                                                    </span>
                                                                                                    <span class="component_option_each">each</span>
                                                                                                </span>
                                                                                            </div>
                                                                                            <div class="thumbnail_buttons">
                                                                                                <button class="button component_option_thumbnail_select" aria-label="Select Transitions ® options">Select options</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                        
                                                                                    <li id="component_option_thumbnail_container_393" class="component_option_thumbnail_container first" style="margin-bottom: 20px; height: 256px;">
                                                                                        <div id="component_option_thumbnail_393" class="cp_clearfix component_option_thumbnail" data-val="393">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Sunglasses</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/sunglasses-ico.png"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    width="38"
                                                                                                    height="38"
                                                                                                />
                                                                                            </div>
                                                                                            <div class="thumbnail_description">
                                                                                                <p>
                                                                                                    Turn any frame into Rx sunglasses. Option of dark tints, polarized or mirror tints.<br />
                                                                                                    100% UV protection
                                                                                                </p>
                                                        
                                                                                                <span class="thumbnail_price price">Options</span>
                                                                                            </div>
                                                                                            <div class="thumbnail_buttons">
                                                                                                <button class="button component_option_thumbnail_select" aria-label="Select Sunglasses options">Select options</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                        
                                                                                    <li id="component_option_thumbnail_container_19595" class="component_option_thumbnail_container disabled" style="margin-bottom: 20px;">
                                                                                        <div id="component_option_thumbnail_19595" class="cp_clearfix component_option_thumbnail disabled" data-val="19595">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Transitions ®</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/light-adap-ico.png"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    width="52"
                                                                                                    height="38"
                                                                                                />
                                                                                            </div>
                                                                                            <div class="thumbnail_description">
                                                                                                <p>Adjust from fully clear indoors to a perfect tint outdoors, 100% UV protection</p>
                                                        
                                                                                                <span class="thumbnail_price price">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span>48.00</bdi>
                                                                                                    </span>
                                                                                                    <span class="component_option_each">each</span>
                                                                                                </span>
                                                                                            </div>
                                                                                            <div class="thumbnail_buttons">
                                                                                                <button class="button component_option_thumbnail_select" aria-label="Select Transitions ® options">Select options</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                        
                                                                                    <li id="component_option_thumbnail_container_19599" class="component_option_thumbnail_container last disabled" style="margin-bottom: 20px;">
                                                                                        <div id="component_option_thumbnail_19599" class="cp_clearfix component_option_thumbnail disabled" data-val="19599">
                                                                                            <div class="thumnail_title">
                                                                                                <h5 class="thumbnail_title title">Sunglasses</h5>
                                                                                            </div>
                                                                                            <div class="image thumbnail_image">
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/sunglasses-ico.png"
                                                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                    alt=""
                                                                                                    loading="lazy"
                                                                                                    width="38"
                                                                                                    height="38"
                                                                                                />
                                                                                            </div>
                                                                                            <div class="thumbnail_description">
                                                                                                <p>Turn any frame into Rx sunglasses. Option of dark tints, polarized or mirror tints. 100% UV protection</p>
                                                        
                                                                                                <span class="thumbnail_price price">Continue</span>
                                                                                            </div>
                                                                                            <div class="thumbnail_buttons">
                                                                                                <button class="button component_option_thumbnail_select" aria-label="Select Sunglasses options">Select options</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="component_options_select_wrapper" style="display: none;">
                                                                                <select id="component_options_1584107436" class="component_options_select" name="wccp_component_selection[1584107436]">
                                                                                    <option value="">Choose an option</option>
                                                        
                                                                                    <option value="391">Clear</option>
                                                        
                                                                                    <option value="399">Azure Blue Filter</option>
                                                        
                                                                                    <option value="392" selected="selected">Transitions ®</option>
                                                        
                                                                                    <option value="393">Sunglasses</option>
                                                        
                                                                                    <option value="19595" disabled="disabled">Transitions ®</option>
                                                        
                                                                                    <option value="19599" disabled="disabled">Sunglasses</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="component_pagination cp_clearfix bottom" data-pagination_data='{"page":1,"pages":1}' style="display: none;">
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
                                                                    <a onclick="viewStage('back')" class="page_button prev" href="#vision" rel="nofollow" aria-label="Go to Vision">Back</a>
                                                                    <!-- <a class="page_button next " href="#enhance" rel="nofollow" aria-label="Go to Enhance">Enhance</a> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!--stage 7-->
                                                        <div style="display:none;" id="component_1584107439_inner" class="component_inner">
                                                            <div class="component_description_wrapper">
                                                                <div class="component_description"><p>Choose a lens enhancement for your everyday needs</p></div>
                                                            </div>
                                                            <div class="component_selections">
                                                                <div class="scroll_show_component_details"></div>
                                                                <div
                                                                    id="component_options_1584107439"
                                                                    class="component_options"
                                                                    data-options_data='[{"option_id":"402","option_title":"Acuity Anti Reflection","option_price_html":"Included","option_thumbnail_html":"<img width=\"175\" height=\"32\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/4star.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" srcset=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/4star.png 175w, https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/4star-150x27.png 150w\" sizes=\"(max-width: 175px) 100vw, 175px\" \/>","option_product_data":{"price":"0","regular_price":"0","product_type":"simple","variation_id":"","variations_data":false,"tax_ratios":{"incl":1,"excl":1},"image_data":{"image_src":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/4star.png","image_srcset":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/4star.png 175w, https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/4star-150x27.png 150w","image_sizes":"(max-width: 175px) 100vw, 175px","image_title":"Acuity Anti Reflection"},"stock_status":"in-stock","product_html":"\t<div class=\"composited_product_title_wrapper\" data-show_title=\"yes\" tabindex=\"-1\"><\/div>\n\t<div class=\"composited_product_details_wrapper\"><div class=\"composited_product_images images\"><figure class=\"composited_product_image woocommerce-product-gallery__image\"><a href=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/4star.png\" class=\"image zoom\" title=\"4star\" data-rel=\"photoSwipe\"><img width=\"175\" height=\"32\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/4star.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" title=\"4star\" data-caption=\"\" data-large_image=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/4star.png\" data-large_image_width=\"175\" data-large_image_height=\"32\" srcset=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/4star.png 175w, https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/4star-150x27.png 150w\" sizes=\"(max-width: 175px) 100vw, 175px\" \/><\/a><\/figure><\/div>\n<div class=\"details component_data\"><div class=\"component_wrap\"><span class=\"price\"><span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">&amp;#36;<\/span>0.00<\/bdi><\/span> <span class=\"component_option_each\">each<\/span><\/span>\n<div class=\"quantity_button\">\t<div class=\"quantity\">\n\t\t\t\t<label class=\"screen-reader-text\" for=\"quantity_60ae1f23c062b\">Acuity Anti Reflection quantity<\/label>\n\t\t<input\n\t\t\ttype=\"number\"\n\t\t\tid=\"quantity_60ae1f23c062b\"\n\t\t\tclass=\"input-text qty text\"\n\t\t\tstep=\"1\"\n\t\t\tmin=\"1\"\n\t\t\tmax=\"\"\n\t\t\tname=\"wccp_component_quantity[1584107439]\"\n\t\t\tvalue=\"1\"\n\t\t\ttitle=\"Qty\"\n\t\t\tsize=\"4\"\n\t\t\tplaceholder=\"\"\n\t\t\tinputmode=\"numeric\" \/>\n\t\t\t<\/div>\n\t<\/div>\n\t<\/div>\n<\/div>\n\n<\/div>"},"option_price_data":{"price":"0","regular_price":"0","max_price":"0","max_regular_price":"0","min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":false,"has_addons":false,"has_required_addons":false,"is_in_view":true,"option_description":"Premium lenses offers reduced internal and external reflections, easy-to-clean and more impact resistant than standard anti reflective lenses\r\n<ul class=\"desc-ul\">\r\n \t<li><img class=\"alignleft size-full wp-image-10040\" src=\"\/wp-content\/uploads\/2020\/05\/anti-refl.png\" alt=\"\" width=\"27\" height=\"23\" \/>Anti reflection<\/li>\r\n \t<li><img class=\"alignleft size-full wp-image-10045\" src=\"\/wp-content\/uploads\/2020\/05\/scratch-res.png\" alt=\"\" width=\"28\" height=\"28\" \/>scratch resistant<\/li>\r\n \t<li><img class=\"alignleft size-full wp-image-10049\" src=\"\/wp-content\/uploads\/2020\/05\/uv-protect.png\" alt=\"\" width=\"34\" height=\"34\" \/>100% UV protection<\/li>\r\n<\/ul>"},{"option_id":"403","option_title":"Ultimate Anti Reflection","option_price_html":"<span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">&amp;#36;<\/span>25.00<\/bdi><\/span> <span class=\"component_option_each\">each<\/span>","option_thumbnail_html":"<img width=\"175\" height=\"32\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/5star.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" srcset=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/5star.png 175w, https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/5star-150x27.png 150w\" sizes=\"(max-width: 175px) 100vw, 175px\" \/>","option_product_data":{"price":"25","regular_price":"25","product_type":"simple","variation_id":"","variations_data":false,"tax_ratios":{"incl":1,"excl":1},"image_data":{"image_src":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/5star.png","image_srcset":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/5star.png 175w, https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/5star-150x27.png 150w","image_sizes":"(max-width: 175px) 100vw, 175px","image_title":"Ultimate Anti Reflection"},"stock_status":"in-stock","product_html":"\t<div class=\"composited_product_title_wrapper\" data-show_title=\"yes\" tabindex=\"-1\"><\/div>\n\t<div class=\"composited_product_details_wrapper\"><div class=\"composited_product_images images\"><figure class=\"composited_product_image woocommerce-product-gallery__image\"><a href=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/5star.png\" class=\"image zoom\" title=\"5star\" data-rel=\"photoSwipe\"><img width=\"175\" height=\"32\" src=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/5star.png\" class=\"attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image\" alt=\"\" loading=\"lazy\" title=\"5star\" data-caption=\"\" data-large_image=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/5star.png\" data-large_image_width=\"175\" data-large_image_height=\"32\" srcset=\"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/5star.png 175w, https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/08\/5star-150x27.png 150w\" sizes=\"(max-width: 175px) 100vw, 175px\" \/><\/a><\/figure><\/div>\n<div class=\"details component_data\"><div class=\"component_wrap\"><span class=\"price\"><span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">&amp;#36;<\/span>25.00<\/bdi><\/span> <span class=\"component_option_each\">each<\/span><\/span>\n<div class=\"quantity_button\">\t<div class=\"quantity\">\n\t\t\t\t<label class=\"screen-reader-text\" for=\"quantity_60ae1f23c2670\">Ultimate Anti Reflection quantity<\/label>\n\t\t<input\n\t\t\ttype=\"number\"\n\t\t\tid=\"quantity_60ae1f23c2670\"\n\t\t\tclass=\"input-text qty text\"\n\t\t\tstep=\"1\"\n\t\t\tmin=\"1\"\n\t\t\tmax=\"\"\n\t\t\tname=\"wccp_component_quantity[1584107439]\"\n\t\t\tvalue=\"1\"\n\t\t\ttitle=\"Qty\"\n\t\t\tsize=\"4\"\n\t\t\tplaceholder=\"\"\n\t\t\tinputmode=\"numeric\" \/>\n\t\t\t<\/div>\n\t<\/div>\n\t<\/div>\n<\/div>\n\n<\/div>"},"option_price_data":{"price":25,"regular_price":25,"max_price":25,"max_regular_price":25,"min_qty":1,"max_qty":"","discount":""},"is_selected":false,"is_configurable":false,"has_addons":false,"has_required_addons":false,"is_in_view":true,"option_description":"This versatile lens enhancement reduces reflections from all angles for exceptional visual clarity and enhanced lens aesthetics\r\n<ul class=\"desc-ul\">\r\n \t<li><img class=\"alignleft size-full wp-image-10040\" src=\"\/wp-content\/uploads\/2020\/10\/ec-icon.png\" alt=\"\" width=\"27\" height=\"23\" \/><span>Enhance clarity<\/span><\/li>\r\n \t<li><img class=\"alignleft size-full wp-image-10045\" src=\"\/wp-content\/uploads\/2020\/10\/ugr-icon.png\" alt=\"\" width=\"28\" height=\"28\" \/><span>Ultimate glare reduction<\/span><\/li>\r\n \t<li><img class=\"alignleft size-full wp-image-10046\" src=\"\/wp-content\/uploads\/2020\/10\/dsg-icon.png\" alt=\"\" width=\"26\" height=\"27\" \/><span>durable scratch guard<\/span><\/li>\r\n \t<li><img class=\"alignleft size-full wp-image-10049\" src=\"\/wp-content\/uploads\/2020\/10\/sr-icon.png\" alt=\"\" width=\"34\" height=\"34\" \/><span>SMUDGE RESISTANT<\/span><\/li>\r\n \t<li><img class=\"alignleft size-full wp-image-10049\" src=\"\/wp-content\/uploads\/2020\/10\/dr-icon.png\" alt=\"\" width=\"34\" height=\"34\" \/><span>DUST REPELLENT<\/span><\/li>\r\n \t<li><img class=\"alignleft size-full wp-image-10049\" src=\"\/wp-content\/uploads\/2020\/10\/uv-icon.png\" alt=\"\" width=\"34\" height=\"34\" \/><span>100% UV PROTECTION<\/span><\/li>\r\n<\/ul>"}]'
                                                                >
                                                                    <div class="component_options_inner cp_clearfix">
                                                                        <div id="component_option_thumbnails_1584107439" class="component_option_thumbnails columns-3" data-component_option_columns="3" >
                                                                            <ul class="component_option_thumbnails_container cp_clearfix" style="list-style: none;">
                                                                                <li onclick="viewStage(5); setSummary('summary_adons', 'Acuity Anti Reflection')" id="component_option_thumbnail_container_402" class="component_option_thumbnail_container first" style="margin-bottom: 20px;">
                                                                                    <div id="component_option_thumbnail_402" class="cp_clearfix component_option_thumbnail" data-val="402">
                                                                                        <img src="./uploads/WhatsApp Image 2021-09-16 at 10.58.34 PM.jpeg" style="max-width: 1110px;width:100%;">
                                                                                       <!-- <div class="thumnail_title">
                                                                                            <h5 class="thumbnail_title title">Acuity Anti Reflection</h5>
                                                                                        </div>
                                                                                        <div class="image thumbnail_image">
                                                                                            <img
                                                                                                src="https://directvisioneyewear.ca/wp-content/uploads/2020/08/4star.png"
                                                                                                class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                alt=""
                                                                                                loading="lazy"
                                                                                                srcset="https://directvisioneyewear.ca/wp-content/uploads/2020/08/4star.png 175w, https://directvisioneyewear.ca/wp-content/uploads/2020/08/4star-150x27.png 150w"
                                                                                                sizes="(max-width: 175px) 100vw, 175px"
                                                                                                width="175"
                                                                                                height="32"
                                                                                            />
                                                                                        </div>
                                                                                        <div class="thumbnail_description">
                                                                                            <p>Premium lenses offers reduced internal and external reflections, easy-to-clean and more impact resistant than standard anti reflective lenses</p>
                                                                                            <ul class="desc-ul">
                                                                                                <li><img class="alignleft size-full wp-image-10040" src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/anti-refl.png" alt="" width="27" height="23" />Anti reflection</li>
                                                                                                <li><img class="alignleft size-full wp-image-10045" src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/scratch-res.png" alt="" width="28" height="28" />scratch resistant</li>
                                                                                                <li><img class="alignleft size-full wp-image-10049" src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/uv-protect.png" alt="" width="34" height="34" />100% UV protection</li>
                                                                                            </ul>
                                                                                            <p></p>
                                                        
                                                                                            <span class="thumbnail_price price">Included</span>
                                                                                        </div>-->
                                                                                        <div class="thumbnail_buttons">
                                                                                            <!--<button class="button component_option_thumbnail_select" aria-label="Select Acuity Anti Reflection" onclick="viewStage(5); setSummary('summary_adons', 'Acuity Anti Reflection')">Select</button>-->
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                        
                                                                                <li onclick="viewStage(5); setSummary('summary_adons', 'Ultimate Anti Reflection')" id="component_option_thumbnail_container_403" class="component_option_thumbnail_container" style="margin-bottom: 20px;">
                                                                                    <div id="component_option_thumbnail_403" class="cp_clearfix component_option_thumbnail" data-val="403">
                                                                                        <img src="./uploads/WhatsApp Image 2021-09-16 at 10.58.46 PM.jpeg" style="max-width: 1110px;width:100%;">
                                                                                       <!-- <div class="thumnail_title">
                                                                                            <h5 class="thumbnail_title title">Ultimate Anti Reflection</h5>
                                                                                        </div>
                                                                                        <div class="image thumbnail_image">
                                                                                            <img
                                                                                                src="https://directvisioneyewear.ca/wp-content/uploads/2020/08/5star.png"
                                                                                                class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"
                                                                                                alt=""
                                                                                                loading="lazy"
                                                                                                srcset="https://directvisioneyewear.ca/wp-content/uploads/2020/08/5star.png 175w, https://directvisioneyewear.ca/wp-content/uploads/2020/08/5star-150x27.png 150w"
                                                                                                sizes="(max-width: 175px) 100vw, 175px"
                                                                                                width="175"
                                                                                                height="32"
                                                                                            />
                                                                                        </div>
                                                                                        <div class="thumbnail_description">
                                                                                            <p>This versatile lens enhancement reduces reflections from all angles for exceptional visual clarity and enhanced lens aesthetics</p>
                                                                                            <ul class="desc-ul">
                                                                                                <li><img class="alignleft size-full wp-image-10040" src="https://directvisioneyewear.ca/wp-content/uploads/2020/10/ec-icon.png" alt="" width="27" height="23" /><span>Enhance clarity</span></li>
                                                                                                <li><img class="alignleft size-full wp-image-10045" src="https://directvisioneyewear.ca/wp-content/uploads/2020/10/ugr-icon.png" alt="" width="28" height="28" /><span>Ultimate glare reduction</span></li>
                                                                                                <li><img class="alignleft size-full wp-image-10046" src="https://directvisioneyewear.ca/wp-content/uploads/2020/10/dsg-icon.png" alt="" width="26" height="27" /><span>durable scratch guard</span></li>
                                                                                                <li><img class="alignleft size-full wp-image-10049" src="https://directvisioneyewear.ca/wp-content/uploads/2020/10/sr-icon.png" alt="" width="34" height="34" /><span>SMUDGE RESISTANT</span></li>
                                                                                                <li><img class="alignleft size-full wp-image-10049" src="https://directvisioneyewear.ca/wp-content/uploads/2020/10/dr-icon.png" alt="" width="34" height="34" /><span>DUST REPELLENT</span></li>
                                                                                                <li><img class="alignleft size-full wp-image-10049" src="https://directvisioneyewear.ca/wp-content/uploads/2020/10/uv-icon.png" alt="" width="34" height="34" /><span>100% UV PROTECTION</span></li>
                                                                                            </ul>
                                                                                            <p></p>
                                                        
                                                                                            <span class="thumbnail_price price">
                                                                                                <span class="woocommerce-Price-amount amount">
                                                                                                    <bdi><span class="woocommerce-Price-currencySymbol">$</span>25.00</bdi>
                                                                                                </span>
                                                                                                <span class="component_option_each">each</span>
                                                                                            </span>
                                                                                        </div>-->
                                                                                        <div class="thumbnail_buttons">
                                                                                            <!--<button class="button component_option_thumbnail_select" aria-label="Select Ultimate Anti Reflection" >Select</button>-->
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="component_options_select_wrapper" style="display: none;">
                                                                            <select id="component_options_1584107439" class="component_options_select" name="wccp_component_selection[1584107439]">
                                                                                <option value="" selected="selected">No Enhance</option>
                                                        
                                                                                <option value="402">Acuity Anti Reflection</option>
                                                        
                                                                                <option value="403">Ultimate Anti Reflection</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="component_pagination cp_clearfix bottom" data-pagination_data='{"page":1,"pages":1}' style="display: none;">
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

                                                        <!--stage 8-->
                                                        
                                                        <div id="component_1584107435_inner_saved" class="component_inner" style="display:none;">
                                                            <div class="component_description_wrapper">
                                                                <div class="component_description"><p>How will you provide your prescription?</p></div>
                                                            </div>
                                                        
                                                            <div>
                                                                <div class="scroll_show_component_details"></div>
                                                                <div class="component_content" data-product_id="1584107435" style="height: auto; display: block;">
                                                                    <div class="component_summary cp_clearfix">
                                                                        <div class="product content summary_content populated initialized bundle_form">
                                                                            <div class="composited_product_details_wrapper">
                                                                                <div class="details component_data">
                                                                                    <div id="inline-1" style="display: block;">

                                                                                        <div class="saved-presc">
                                                                                            <div class="wrapper-popup">
                                                                                                <h3>YOUR SAVED PRESCRIPTIONS</h3>
                                                                                                <div class="panel panel-default">
                                                                                                    <div class="js-table-responsive">
                                                                                                        <table class="shop_table_responsivea">
                                                                                                            <input name="selected_prescription" value="" hidden>
                                                                                                            <tbody>
                                                                                                                
                                                                                                                
                                                                                                                <?$myOrderIds = array();
                                                                                                                $orders = getAll($con, "SELECT *, o.id order_id from glassBuy_order o inner join glassBuy_glasses g on g.glass_id=o.product_id where o.user_id='$session_userId' and isPaid='1';");
                                                                                                                foreach($orders as $row){
                                                                                                                    $myOrderIds[] = $row['order_id'];
                                                                                                                }
                                                                                                                
                                                                                                                $myOrderIds = "('".implode("','", $myOrderIds)."')";
                                                                                    
                                                                                                                $query  ="SELECT * from glassBuy_prescription where order_id in $myOrderIds or userId='$session_userId';";
                                                                                                                $od = getAll($con, $query);
                                                                                                                if(count($od)==0){
                                                                                                                    ?>
                                                                                                                <tr>
                                                                                                                    <td colspan="7" style="text-align: center !important;">
                                                                                                                        <p class="no-pres-text">You have no saved prescriptions.</p>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <?}else{
                                                                                                                    foreach($od as $row){
                                                                                                                    if($row['prescription']!=""){?>
                                                                                                                    <tr>
                                                                                                                        <td><?echo $row['prescription']?></td>
                                                                                                                        <td class="" onclick="select_prescription('<?echo $row['id']?>')"><a class="button pres-btn pres-btn-<?echo $row['id']?>" >Select</a></td>
                                                                                                                    </tr>
                                                                                                                
                                                                                                                <?}}}?>
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
                                                                <p class="component_section_title">
                                                                    <label class="select_label"> Available options: </label>
                                                                </p>
                                                               </div>
                                                        </div>



                                                        
                                                    </div>
                                                    
                                                    <!--stage review-->
                                                    <div class="cart cart_group composite_form paged ">
                                                        <div style="display:none;" id="composite_summary_394" class="composite_summary columns-4" data-summary_columns="4">
                                                            <ul class="summary_elements cp_clearfix" style="list-style: none;">
                                                                <li class="summary_element summary_element_1584107434 first" data-item_id="1584107434">
                                                                    <div class="summary_element_wrapper_outer">
                                                                        <div class="summary_element_wrapper configured" style="height: auto;">
                                                                            <div class="summary_element_wrapper_inner cp_clearfix">
                                                                                <div class="summary_element_title summary_element_data">
                                                                                    <h3 class="title summary_element_content"><span class="step_index">1</span> <span class="step_title">Vision</span></h3>
                                                                                </div>
                                                        
                                                                                <div class="summary_element_image summary_element_data">
                                                                                    <img class="summary_element_content" alt="No Prescription" src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/no-presc-ico.png" srcset="" sizes="(max-width: 44px) 100vw, 44px" />
                                                                                </div>
                                                        
                                                                                <div class="summary_element_selection summary_element_data">
                                                                                    <span class="summary_element_content"><span class="content_product_title summary_prescription">No Prescription</span></span>
                                                                                </div>
                                                        
                                                                                <div class="summary_element_price summary_element_data">
                                                                                    <span class="price summary_element_content">
                                                                                        <!--<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>0.00</span>-->
                                                                                    </span>
                                                                                </div>
                                                        
                                                                                <div class="summary_element_button summary_element_data">
                                                                                    <a href="#vision" rel="nofollow" class="button summary_element_select" aria-label="Edit Vision"  onclick="viewStage(2)">Edit</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                               <!-- <li class="summary_element summary_element_1584107436" data-item_id="1584107436">
                                                                    <div class="summary_element_wrapper_outer">
                                                                        <div class="summary_element_wrapper configured" style="height: auto;">
                                                                            <div class="summary_element_wrapper_inner cp_clearfix">
                                                                                <div class="summary_element_title summary_element_data">
                                                                                    <h3 class="title summary_element_content"><span class="step_index">2</span> <span class="step_title">Lens Type</span></h3>
                                                                                </div>
                                                        
                                                                                <div class="summary_element_image summary_element_data">
                                                                                    <img class="summary_element_content" alt="Clear" src="https://directvisioneyewear.ca/wp-content/uploads/2020/05/clear-ico.png" srcset="" sizes="(max-width: 36px) 100vw, 36px" />
                                                                                </div>
                                                        
                                                                                <div class="summary_element_selection summary_element_data">
                                                                                    <span class="summary_element_content"><span class="content_product_title">Clear</span></span>
                                                                                </div>
                                                        
                                                                                <div class="summary_element_price summary_element_data">
                                                                                    <span class="price summary_element_content">
                                                                                        <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>0.00</span>
                                                                                    </span>
                                                                                </div>
                                                        
                                                                                <div class="summary_element_button summary_element_data">
                                                                                    <a href="#lens-type" rel="nofollow" class="button summary_element_select" aria-label="Edit Lens Type">Edit</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>-->
                                                                <li class="summary_element summary_element_1584107439" data-item_id="1584107439">
                                                                    <div class="summary_element_wrapper_outer">
                                                                        <div class="summary_element_wrapper configured" style="height: auto;">
                                                                            <div class="summary_element_wrapper_inner cp_clearfix">
                                                                                <div class="summary_element_title summary_element_data">
                                                                                    <h3 class="title summary_element_content"><span class="step_index">3</span> <span class="step_title">Enhance</span></h3>
                                                                                </div>
                                                        
                                                                                <div class="summary_element_image summary_element_data">
                                                                                    <img
                                                                                        class="summary_element_content"
                                                                                        alt="Ultimate Anti Reflection"
                                                                                        src="https://directvisioneyewear.ca/wp-content/uploads/2020/08/5star.png"
                                                                                        srcset="https://directvisioneyewear.ca/wp-content/uploads/2020/08/5star.png 175w, https://directvisioneyewear.ca/wp-content/uploads/2020/08/5star-150x27.png 150w"
                                                                                        sizes="(max-width: 175px) 100vw, 175px"
                                                                                    />
                                                                                </div>
                                                        
                                                                                <div class="summary_element_selection summary_element_data">
                                                                                    <span class="summary_element_content"><span class="content_product_title summary_adons">Ultimate Anti Reflection</span></span>
                                                                                </div>
                                                        
                                                                                <div class="summary_element_price summary_element_data">
                                                                                    <span class="price summary_element_content">
                                                                                        <!--<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>25.00</span>-->
                                                                                    </span>
                                                                                </div>
                                                        
                                                                                <div class="summary_element_button summary_element_data">
                                                                                    <a href="#enhance" rel="nofollow" class="button summary_element_select" aria-label="Edit Enhance"  onclick="viewStage(4)">Edit</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
    </ul>
    <div class="composite_wrap" style="">
                                                    		<div class="composite_price" style="display: block;"><p class="price-label">PRESCRIPTION LENSES SUBTOTAL</p><p class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span><span class="Prescription_lenses_cost">0</span></span></p></div>
                                                        	
                                                        	</div>
                                                        </div>
                                                        
                                                        
                                                        

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="review-sidebar" class="fl-col fl-node-5e6b937ad7336 fl-col-small" data-node="5e6b937ad7336">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-html fl-node-5e6b9576a0852" data-node="5e6b9576a0852">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-html">
                                                        
                                                            <h3>Summary</h3>
                                                            <div class="product-image">
                                                                <img src="./uploads/<?echo $img?>" />
                                                            </div>
                                                            <div class="title-price-area">
                                                                <div class="product-title-frame">
                                                                    <?echo $glassDeets['title']?> <br />
                                                                    <span><?echo $glassDeets['available_sizes']?></span><br />
                                                                    <span><?echo $glassDeets['description']?></span><br />
                                                                </div>
                                                                <div class="product-price-frame">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <bdi><span class="woocommerce-Price-currencySymbol">&#36;</span><?echo $glassDeets['price']?></bdi>
                                                                    </span>
                                                                </div>
                                                                <input type="hidden" name="attribute_pa_size" id="pa_size" value="<?echo $glassDeets['available_sizes']?>" /><input type="hidden" name="attribute_pa_colour" id="pa_colour" value="<?echo $glassDeets['description']?>" />
                                                                <input type="hidden" name="add-to-cart" value="21464" />
                                                                <input type="hidden" name="product_id" id="product_id" value="21464" />
                                                                <input type="hidden" name="variation_id" id="variation_id" value="21465" />
                                                                <input type="hidden" name="frame_product_url" id="frame_product_url" value="./product.php?id=<?echo $glassDeets['glass_id']?>" />
                                                                <input type="hidden" id="quantity_5da9955a5ab80" class="qty" name="quantity" value="1" />
                                                                <button type="submit" class="single_add_to_cart_button button alt disabled wc-variation-selection-needed" style="display: none;">Add to cart</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-html fl-node-5e6b95cb09cc6" data-node="5e6b95cb09cc6">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-html">
                                                        <div id="pres-totals-wrapper">
                                                            <div class="title">Prescription Lenses</div>
                                                            <div class="price">$<span class="Prescription_lenses_cost">0</span></div>
                                                        </div>
                                                        <!--<span class="toggler">Details</span>-->
                                                        
                                                        <p class="summary_prescription">
                                                            
                                                        </p>
                                                        <p class="summary_adons">
                                                            
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-widget fl-node-5e6b96003ff7d" data-node="5e6b96003ff7d">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-widget">
                                                        <div class="widget woocommerce widget_composite_summary ">
                                                            <div class="widget_composite_summary_content widget_composite_summary_content_394" data-container_id="394">
                                                                <div class="widget_composite_summary_elements composite_summary" data-summary_columns="1">
                                                                    <ul class="summary_elements cp_clearfix" style="list-style: none;">
                                                                        <li class="summary_element summary_element_1584107434 last" data-item_id="1584107434">
                                                                            <div class="summary_element_wrapper_outer">
                                                                                <div class="summary_element_wrapper disabled">
                                                                                    <div class="summary_element_wrapper_inner cp_clearfix"></div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="summary_element summary_element_1584107435 last" data-item_id="1584107435">
                                                                            <div class="summary_element_wrapper_outer">
                                                                                <div class="summary_element_wrapper disabled">
                                                                                    <div class="summary_element_wrapper_inner cp_clearfix"></div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="summary_element summary_element_1584107436 last" data-item_id="1584107436">
                                                                            <div class="summary_element_wrapper_outer">
                                                                                <div class="summary_element_wrapper disabled">
                                                                                    <div class="summary_element_wrapper_inner cp_clearfix"></div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="summary_element summary_element_1584107438 last" data-item_id="1584107438">
                                                                            <div class="summary_element_wrapper_outer">
                                                                                <div class="summary_element_wrapper disabled">
                                                                                    <div class="summary_element_wrapper_inner cp_clearfix"></div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="summary_element summary_element_1584107439 last" data-item_id="1584107439">
                                                                            <div class="summary_element_wrapper_outer">
                                                                                <div class="summary_element_wrapper disabled">
                                                                                    <div class="summary_element_wrapper_inner cp_clearfix"></div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="widget_composite_summary_price">
                                                                    <div class="composite_price"></div>
                                                                </div>
                                                                <div class="widget_composite_summary_error">
                                                                    <div class="composite_message" style="display: none;"><ul class="msg woocommerce-info"></ul></div>
                                                                </div>
                                                                <div class="widget_composite_summary_availability">
                                                                    <div class="composite_availability"></div>
                                                                </div>
                                                                <div class="widget_composite_summary_button">
                                                                    <div class="composite_button">
                                                                        <div class="quantity">
                                                                            <label class="screen-reader-text" for="quantity_60acc5157167b">Prescription Lenses quantity</label>
                                                                            <input
                                                                                type="number"
                                                                                id="quantity_60acc5157167b"
                                                                                class="input-text qty text"
                                                                                step="1"
                                                                                min="1"
                                                                                max=""
                                                                                name="quantity"
                                                                                value="1"
                                                                                title="Qty"
                                                                                size="4"
                                                                                placeholder=""
                                                                                inputmode="numeric"
                                                                            />
                                                                        </div>
                                                                        <button
                                                                            type="button"
																			id="check_button"
                                                                            class="single_add_to_cart_button composite_add_to_cart_button button alt"
                                                                            onclick='sendToCart()'
                                                                        >
                                                                            Add To Cart
                                                                        </button>
                                                                        <script>
                                                                            var brand_slug = "";
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fl-row fl-row-fixed-width fl-row-bg-none fl-node-5e7b192f39a99" data-node="5e7b192f39a99">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                <div class="fl-col-group fl-node-5e7b192f3d7a4" data-node="5e7b192f3d7a4">
                                    <div class="fl-col fl-node-5e7b192f3d8d3" data-node="5e7b192f3d8d3">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-html fl-node-5e7b192f395a6" data-node="5e7b192f395a6">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-html">
                                                        <style>
                                                            #my-fitmix-container {
                                                                width: 100%;
                                                                height: 100%;
                                                                margin: 0 auto;
                                                            }
                                                            #product-addons-total{
                                                                display:none !important;
                                                            }
                                                        </style>
                                                        <!-- load FitMix script, must be done only once in HEAD -->
                                                        <script src="https://static.fittingbox.com/api/v1/fitmix.js" type="text/javascript"></script>
<!--
                                                        <div id="wrapper">
                                                            <div class="pd-wrapper">
                                                                <div class="pd-top-bar">
                                                                    <div class="pd-container">
                                                                        <span class="title">Measure My PD</span>
                                                                        <a href="#" class="pd-close">Close</a>
                                                                    </div>
                                                                </div>
                                                                <div class="step1-wrapper">
                                                                    <div class="pd-container">
                                                                        <div class="step-top">
                                                                            <h4>Take a photo, we will work out your Pupillary Distance (PD)</h4>
                                                                            <p>You need a webcam enabled device and a standard bank card</p>
                                                                        </div>
                                                                        <div class="img-area">
                                                                            <div class="img-holder">
                                                                                <img src="https://directvisioneyewear.ca/wp-content/themes/bb-theme-child/assets/images/step1-img1.jpg" alt="" />
                                                                            </div>
                                                                            <div class="img-holder">
                                                                                <img src="https://directvisioneyewear.ca/wp-content/themes/bb-theme-child/assets/images/step1-img2.jpg" alt="" />
                                                                            </div>
                                                                        </div>
                                                                        <a href="#" class="btn btn-sec m-pd">Measure My PD</a>
                                                                        <p>Your photo will be securely stored and processed by our professional team to work out your Pupillary distance (PD).</p>
                                                                        <p><strong>Once the PD measurement is obtained, your photo will be permanently erased.</strong></p>
                                                                    </div>
                                                                </div>
                                                                <div class="pd-area">
                                                                    <div class="pd-top-area">
                                                                        <div class="pd-container">
                                                                            <div class="timer">
                                                                                <div class="counter">3</div>
                                                                                <p>Look straight at the camera</p>
                                                                            </div>
                                                                            <div class="txt-block">
                                                                                <a href="#" class="btn take-shot">Take Photo</a>
                                                                                <p>Position yourself and the card within the guides. If you wear glasses, take them off</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pd-bottom-area">
                                                                        <div class="pd-container">
                                                                            <div class="txt-block">
                                                                                <div class="btn-area">
                                                                                    <a href="#" class="btn retake">Retake</a>
                                                                                    <a href="#" class="btn btn-sec use-photo">Use Photo</a>
                                                                                </div>
                                                                                <p>Check your photo. When ready click “USE PHOTO” to submit to our professional team for analysis</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="camera-area">
                                                                        <div class="pd-container">
                                                                            <div class="capture-img">
                                                                                <div class="img-holder"></div>
                                                                            </div>
                                                                            <div id="my_camera">
                                                                                <div class="render-camera">
                                                                                    <div id="my-fitmix-container"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="no-camera">
                                                                                <img src="https://directvisioneyewear.ca/wp-content/uploads/2020/04/error-w.png" alt="" />
                                                                                <h3>Unable to detect camera</h3>
                                                                                <p>Allow access to your webcam and check that it is not already in use.</p>
                                                                                <button class="try-again">Try Again</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->
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
            
           <!-- 
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet" >

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <style>
                .modal-dialog {
    max-width: 500px;
    margin: 1.75rem auto;
    top: 100px;
}

.fade.show {
    opacity: 1;
}
.fade {
    opacity: 0;
    -webkit-transition: opacity 0.15s linear;
    -o-transition: opacity 0.15s linear;
    transition: opacity 0.15s linear;
    transition-property: opacity;
    transition-duration: 0.15s;
    transition-timing-function: linear;
    transition-delay: initial;
}

            </style>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<style>
    /* CSS comes here */
    #video {
        border: 1px solid black;
        width: 320px;
        height: 240px;
    }

    #photo {
        border: 1px solid black;
        width: 320px;
        height: 240px;
    }

    #canvas {
        display: none;
    }

    .camera {
        /*width: 340px;*/
        /*display: inline-block;*/
    }

    .output {
        width: 340px;
        display: inline-block;
    }

    #startbutton {
        display: block;
        position: relative;
        margin-left: auto;
        margin-right: auto;
        /*bottom: 346px;*/
        padding: 5px;
        background-color: #6a67ce;
        border: 1px solid rgba(255, 255, 255, 0.7);
        font-size: 14px;
        color: rgba(255, 255, 255, 1.0);
        cursor: pointer;
        
    }

    .contentarea {
        font-size: 16px;
        font-family: Arial;
        text-align: center;
    }
    .modal {
    vertical-align: middle;
    position: relative;
    z-index: 2;
    max-width: 500px;
    box-sizing: border-box;
    /*width: 42%;*/
    }
    
    video{
        max-width: 400px;width:100%;
        height: 300px;
    }
    </style>
    
    
<div id="modal_instructions_pd" class="modal">
    <h3 style="text-align: center;">What is PD?</h3>
        <img src="./images/whatispd.png" style="width: 100%;">
    
    <!--<p style="text-align: center;
margin-top: 10px;">
        <strong>PD or Pupillary distance</strong>, is the 
distance between the center of each 
pupil and the bridge of your nose 
measured in millimeters.<br>
This measurement is critical to 
making prescription glasses.

    </p>-->
    
    <p style="text-align: center;
margin-top: 10px;">
        PD or Pupillary distance, is the distance between the center of each pupil and the bridge of your nose measured in millimeters.
<br>
This measurement is critical to making prescription glasses.

    </p>
</div>
<div id="modal_take_photo" class="modal">
        <h4 id="time"></h4>
        <div id="imnotready">
            <h3 style="text-align: center;">Follow the steps below:</h3>
            <img style="margin: 1px auto;
    display: flex;" src="./images/WhatsApp-Video-2021-09-11-at-143.gif">
    <img style="margin: 1px auto;
    display: flex;" src="./images/WhatsApp Image 2021-09-24 at 2.27.13 AM.jpeg">
    
    
            <p >1. Take off your glasses. Make sure the 
    image is well-lit.<br>
    2. Adjust your screen or phone so it is 
    at the same height as your face, 
    approximately 15inches away. <br>
    3. Look at the camera not the screen.<br>
    4. Place any card with a magnetic strip 
    under your nose, facing the camera.</p>
            
            
            <button  type="button" onclick="imready()" style="margin: 1px auto;
display: block;">I am ready</button>
            
        </div>
        
        
        <div id="imready" style="display:none;">
            <h3 style="text-align: center;">Look at the camera</h3>
            <p id="pictureTaken" style="display:none">Picture taken and uploaded. You may close the popup.</p>
            <style>
                 video {
      -webkit-transform: scaleX(-1);
      transform: scaleX(-1);
    }
             </style>
       <!-- <img src="https://directvision.optiserver.co.uk/wp-content/themes/bb-theme-child/assets/images/camera-overlay.png" style="display: block;position: fixed;margin-left: inherit;margin-right: auto;border: 1px solid rgba(255, 255, 255, 0.7);font-size: 14px;color: rgba(255, 255, 255, 1.0);cursor: pointer;width: 400px;height: 300px;z-index: 1;">  
         
         
         <div class="camera">
             <style>
                 video {
      -webkit-transform: scaleX(-1);
      transform: scaleX(-1);
    }
             </style>
                <video id="video" style="max-width: 400px;width:100%;
    height: 300px;">Video stream not available.</video>
            </div>
          -->
          
            <img id="image_pd_video" src="./js/camera-overlay.png" style="display: block;position: fixed;margin-left: inherit;margin-right: auto;border: 1px solid rgba(255, 255, 255, 0.7);font-size: 14px;color: rgba(255, 255, 255, 1.0);cursor: pointer;width: 400px;height: 300px;z-index: 1;top: 285px;">


            <div><button id="startbutton" type="button" onclick="takepicture_timer()">Take photo</button></div>
            <div  id="video-div"> </div>
  
            <canvas id="canvas"></canvas>
  
            <div class="output" style="display:none; width:100%;">
                <img id="photo" alt="The screen capture will appear in this box.">
            </div>
        
        </div>
        
        
    <a href="#" rel="modal:close">Close</a>
</div>

<!-- Link to open the modal -->



<!-- .fl-page-content -->
<?php require("./includes/footer.php");?>
</div>
<!-- .fl-page -->
<?php require("./includes/comman/select_lenses/footerjs.php");?>
<!-- WooCommerce JavaScript -->
</body>

<input name="vision" class="vision" hidden>
<input name="lensType" class="lensType" hidden>

</form>
</html>
<script>
$(".composite_button").hide()
pdPicUploaded = "";
    vision = "";
    lensType = "";

    function setSummary(element, value){
        console.log("setSummary", element, value)
        jQuery("."+element).html(value)
        
        if(element=="summary_prescription"){
            vision = value;
            jQuery(".vision").val(vision)
        }else if(element=="summary_adons"){
            lensType = value
            jQuery(".lensType").val(lensType)
            if(value=="Ultimate Anti Reflection"){
                jQuery(".Prescription_lenses_cost").text(25)
            }else{
                jQuery(".Prescription_lenses_cost").text(0)
            }
        }
        
        
        
        
    }
    currentStage = 1;
    function viewStage(stageNo){
        console.log("stageNo", stageNo)
        if(currentStage==3 && stageNo==4){
            if(jQuery("#addon-1584107435-first-name-8").val()=="" || jQuery("#addon-1584107435-last-name-9").val()=="" || jQuery("#addon-1584107435-date-of-prescription-12").val()=="" || jQuery("#addon-1584107435-save-your-prescription-for-future-11").val()=="" || pdPicUploaded=="" ){
                jQuery(".requireFields").show() 
                console.log("not all")
                return;
            }else{
                jQuery(".requireFields").hide() 
            }
        }

        //1
        jQuery("#component_options_1584107434").hide();
        
        //2
        jQuery("#component_options_1584107435component_options_1584107435").hide();
        //3
        jQuery("#component_1584107435").hide();
        jQuery("#component_1584107435_inner_saved").hide();
        

        //4
        jQuery("#component_1584107405_inner").hide();

        //5
        jQuery("#component_1584107435_inner").hide();

        //6
        jQuery("#component_1584107436").hide();

        //7
        jQuery("#component_1584107439_inner").hide();

		jQuery("#component_option_thumbnail_container_390").hide();
		jQuery("#component_option_thumbnail_container_396").hide();
		
		jQuery("#component_1584107434_inner > .component_description_wrapper > .component_description > p").hide();
		jQuery("#component_options_1584107435component_options_1584107435").hide();
		
		//remove class
		jQuery(".pagination_element_1584107434").removeClass("pagination_element_current")
		jQuery(".pagination_element_1584107436").removeClass("pagination_element_current")
		jQuery(".pagination_element_1584107439").removeClass("pagination_element_current")
		jQuery(".pagination_element_review").removeClass("pagination_element_current")
		
		jQuery("#composite_summary_394").hide();
		
		
		
		if(stageNo=="back"){
		    
		    if(currentStage>1){
                currentStage=currentStage-1;
		    }else{
		        window.location="./product.php?id=<?echo $_GET['product_id']?>"
		    }
            viewStage(currentStage);
            return 1;
        }else{
            currentStage = stageNo;
        }
        
        
        if(stageNo==1){
            jQuery("#component_options_1584107434").show();
            jQuery("#component_1584107435").show();
            
            jQuery(".pagination_element_1584107434").addClass("pagination_element_current")
            
        }else if(stageNo==2){
            jQuery("#component_options_1584107435component_options_1584107435").show();
            jQuery(".pagination_element_1584107436").addClass("pagination_element_current")
            
            //headiing text change
            jQuery("#component_1584107434_inner > .component_description_wrapper > .component_description > p").text("How will you provide your prescription?");
        }else if(stageNo==3){
            jQuery("#component_1584107435").show();
            jQuery("#component_1584107435_inner").show();
            jQuery(".pagination_element_1584107436").addClass("pagination_element_current")
            
        }else if(stageNo==4){
            // jQuery("#component_1584107436").show();
            jQuery(".pagination_element_1584107439").addClass("pagination_element_current")
            jQuery("#component_1584107439_inner").show();
            
        }else if(stageNo==5){
            jQuery("#composite_summary_394").show();
            jQuery(".pagination_element_review").addClass("pagination_element_current")
            $(".composite_button").show()
            // jQuery("#component_1584107436").show();
            // jQuery("#component_1584107439_inner").show();
        }else if(stageNo==7){
            jQuery("#component_1584107435_inner_saved").show();
            $(".composite_button").show()
            // jQuery("#component_1584107436").show();
            // jQuery("#component_1584107439_inner").show();
        }
        
        
        
        // else if(stageNo==5){
        //     jQuery("#component_1584107439_inner").show();
        // }
    }
    jQuery(document).ready(function(){
		
		viewStage(1);
		// //Enter prescription
		
		
		// //stage 1 click
		jQuery("#component_options_1584107434").click(function(){
            // viewStage(2);
        });

        //stage 2 click
        jQuery("#component_options_1584107435component_options_1584107435").click(function(){
            
            // viewStage(3);
            //stage 3 form
            
        });

	});

        function sendToCart(){
            // window.location="./cart.php?v="+vision+"&l="+lensType;
            jQuery("form").submit();
        }
        
        
        function select_prescription(presId){
            
            jQuery("input[name=selected_prescription]").val(presId);
            jQuery(".pres-btn").text("Select");
            jQuery(".pres-btn-"+presId).text("Selected");
            viewStage(4);
            
            
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
      <script>
   
        
        
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                if(timer>0 && timer<100){
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);
            
                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;
            
                    display.textContent = minutes + ":" + seconds;
            
                    if (--timer < 0) {
                       
                    }
                }else if(timer<=0){
                    console.log("timer", timer);
                    display.textContent  ="";
                    takepicture();
                    timer = 1000;
                }else if(timer==1000){
                    timer = 1000;
                    display.textContent  ="";
                }
            }, 1000);
        }


        var width = 320; // We will scale the photo width to this
        var height = 0; // This will be computed based on the input stream

        var streaming = false;

        var video = null;
        var canvas = null;
        var photo = null;
        var startbutton = null;
        
        const container = document.getElementById("video-div");

        async function startVideo() {
        
          
           const track = await Twilio.Video.createLocalVideoTrack();
          container.append(track.attach());
          video = document.getElementsByTagName("video")[0];
          
          requestAnimationFrame(step);
          
        }
        
        var canvas = document.getElementById('canvas');
        var ctx = canvas.getContext('2d');

        video = "";
        function step() {
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height)
            requestAnimationFrame(step)
        }


        function startup() {
           
            photo = document.getElementById('photo');
            startbutton = document.getElementById('startbutton');
            
            startVideo(); 
            
            startbutton.addEventListener('click', function(ev) {
                takepicture_timer();
                ev.preventDefault();
            }, false);

            clearphoto();
        }


        function clearphoto() {
            var context = canvas.getContext('2d');
            context.fillStyle = "#AAA";
            context.fillRect(0, 0, canvas.width, canvas.height);

            var data = canvas.toDataURL('image/png');
            photo.setAttribute('src', data);
        }


        function takepicture_timer(){
            var fiveMinutes = 3,
            display = document.querySelector('#time');
            startTimer(fiveMinutes, display);
            
        }
        
    
    
        function takepicture() {
            var context = canvas.getContext('2d');
            width = 320;
            height = width / (4 / 3);
            if (width && height) {
                canvas.width = width;
                canvas.height = height;
                context.drawImage(video, 0, 0, width, height);

                var data = canvas.toDataURL('image/png');
                img = document.getElementById('output_pd');
                img.src=data;
                img.classList.remove('hide');
                
                photo.setAttribute('src', data);
                jQuery("#pictureTaken").show();
                
                
                var formData = new FormData();

                // JavaScript file-like object
                var blob = new Blob([canvas.toDataURL('image/png')], { type: "image/png"});
                console.log("blob", data)
                formData.append("webmasterfile", blob);
                
                var request = new XMLHttpRequest();
                request.open("POST", "");
                request.send(formData);
                pdPicUploaded = "uploaded;";

            } else {
                clearphoto();
            }
        }

        // window.addEventListener('load', startup, false);
        
        function imready(){
            $("#imready").show();
            $("#imnotready").hide();
            startup();
        }
    
        
    </script>
