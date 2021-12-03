<?php 
include_once("global.php");

$l_glassId = $_GET['id'];

if(!isset($_GET['id'])){
    header("./shop.php");
}
else{
    $id = $_GET['id'];
    $glassId = $_GET['id'];
     $sql ="SELECT * FROM glassBuy_glass_picture WHERE glass_id='$id'";
      $img_data = $con->query($sql);
      if($img_data->num_rows > 0){
          $rowd = $img_data->fetch_assoc();
          $img = $rowd['name'];
      }
      else{
        $img = "https://dummyimage.com/600x400/000/fff.jpg";
      }
    // $_SESSION['product_id'] = $id;
    
     $sql ="SELECT * FROM glassBuy_glasses where glass_id='$id'";
    $result = $con->query($sql);
    while($row = $result->fetch_assoc()) {
        $glassDeets = $row;
    }
    
    
    $sql ="update glassBuy_glasses set clicks=clicks+1 where glass_id='$id'";
    $result = $con->query($sql);

}


if(isset($_POST['rate']) && isset($_POST['review'])){
    $rating = $_POST['rate'];
    $review = mb_htmlentities($_POST['review']);
    $glassIdInp = mb_htmlentities($_POST['glassIdInp']);
    
    if(isset($_FILES["profile_pic"])){
        $profile_pic = storeFile($_FILES['profile_pic']); 
    }
    
    $rand = generateRandomString();
    $time = time();
    $sql ="insert into glassBuy_glass_reviews set id='$rand', review='$review', rating='$rating', 
    glassId='$glassIdInp', userId='$session_userId', timeAdded='$time', profile_pic='$profile_pic' ";
    $result = $con->query($sql);
    ?><script type="text/javascript">window.location="?id=<?php echo $glassIdInp;?>&success=1"</script><?php
}

/*get all review*/
$review_sql = "SELECT review.*, review.id as reviewId, user.* FROM `glassBuy_glass_reviews` AS review JOIN `glassBuy_users` AS user ON review.userId = user.id WHERE review.glassId = '$l_glassId'";
$getReviews = getAll($con,$review_sql);
// echo $review_sql;
// echo json_encode($getReviews);
// exit();
$sumOfRating = 0;
$totalRating = 0;
$avg = 0;
$isUserPostReview = false;
if(!is_null($getReviews) && count($getReviews) > 0){
    $sumOfRating = array_sum(array_column($getReviews,'rating'));
    $totalRating = count($getReviews);
    $avg = (int)((($sumOfRating*5)/($totalRating*5))/2);
    if(isset($session_userId)){
        $isUserPostReview = in_array($session_userId,array_column($getReviews,'userId'));
    }
}
/*end of get all review*/

/*start::delete review*/
if(isset($_POST['DELETE_REVIEW'])){
    if($_POST['review_id'] && $_POST['glassId']){
        $pk_value = $_POST['review_id'];
        $glassId = $_POST['glassId'];
        $deleteRecord = delete($con,"glassBuy_glass_reviews","id",$pk_value);
        if($deleteRecord){
            header("Location: ./product.php?id=$glassId");
            exit();
        }else{
            header("Location: ./product.php?id=$glassId");
            exit();
        }
    }else{
        header("Location: ./product.php?id=$glassId");
        exit();
    }
}
/*end::delete review*/
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <?php include_once('./includes/comman/product/head.php'); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//projects.anomoz.com/ke/gpxCollaborate/assets/js/rating.js"></script>
        <style>
* {box-sizing: border-box}
.mySlides1, .mySlides2 {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a grey background color */
.prev:hover, .next:hover {
  background-color: #f1f1f1;
  color: black;
}

.ratingBox{
    border: 1px solid;
    padding: 4px 16px;
    margin-bottom: 8px;
}


#st-1 .st-btn{
    background-color: black !important;
}

.owl-item .owl-stage{display: flex;}
.owl-item {
    display: flex;
    flex: 1 0 auto;
    height: 100%;
}
.owl-item {
    position: relative;
    overflow: hidden;
    /* margin-bottom: 80px; *//*This is optional*/
    display: flex;
    flex-direction: column;
    align-items: stretch;
}


.owl-carousel .owl-item img {
    object-fit: cover;
width: 100%;
height: 200px;
}
</style>
    </head>
    <body
        class="product-template-default single single-product postid-<?echo $glassDeets['glass_id']?> theme-bb-theme woocommerce woocommerce-page woocommerce-no-js fl-theme-builder-header fl-theme-builder-footer fl-theme-builder-singular woo-variation-swatches wvs-theme-bb-theme-child wvs-theme-child-bb-theme wvs-style-squared wvs-attr-behavior-blur wvs-tooltip wvs-css fl-framework-base fl-preset-default fl-full-width fl-scroll-to-top fl-search-active woo-3 woo-products-per-page-16"
        itemscope="itemscope"
        itemtype="https://schema.org/WebPage"
    >
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJ5Q9NM" height="0" width="0" style="display: none; visibility: hidden;"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <a aria-label="Skip to content" class="fl-screen-reader-text" href="#fl-main-content">Skip to content</a>
        <div class="fl-page">
            <?php include('./includes/header.php'); ?>
            
           

            <div id="fl-main-content" class="fl-page-content" itemprop="mainContentOfPage" role="main">
                <div class="woocommerce-notices-wrapper"></div>
                <div class="fl-builder-content fl-builder-content-563 fl-builder-global-templates-locked product" data-post-id="563">
                    <div class="fl-row fl-row-fixed-width fl-row-bg-none fl-node-5ec4cbbd09b72" data-node="5ec4cbbd09b72">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                <div class="fl-col-group fl-node-5ec4cbbd09aac" data-node="5ec4cbbd09aac">
                                    <div class="fl-col fl-node-5ec4cbbd09af0" data-node="5ec4cbbd09af0">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-pp-modal-box fl-node-5ec4cbbd09b31" data-node="5ec4cbbd09b31">
                                                <div class="fl-module-content fl-node-content">
                                                    <div id="modal-5ec4cbbd09b31" class="pp-modal-wrap">
                                                        <div class="pp-modal-container">
                                                            <div class="pp-modal-overlay"></div>
                                                            <div class="pp-modal layout-standard">
                                                                <div class="pp-modal-body">
                                                                    <div class="pp-modal-close box-top-right no-modal-header">
                                                                        <div class="bar-wrap">
                                                                            <span class="bar-1"></span>
                                                                            <span class="bar-2"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pp-modal-content">
                                                                        <div class="pp-modal-content-inner">
                                                                            <link
                                                                                rel="stylesheet"
                                                                                id="fl-builder-google-fonts-c54c80ae66ba468cdea28d986e76bb28-css"
                                                                                href="//fonts.googleapis.com/css?family=Public+Sans%3A400&amp;ver=5.5.5"
                                                                                media="all"
                                                                            />
                                                                            <link rel="stylesheet" id="fl-builder-layout-19445-css" href="css/cache-19445-layout-partial.css" media="all" />
                                                                            <div
                                                                                class="fl-builder-content fl-builder-content-19445 fl-builder-template fl-builder-row-template fl-builder-global-templates-locked product"
                                                                                data-post-id="19445"
                                                                            >
                                                                                <div id="size-guide" class="fl-row fl-row-fixed-width fl-row-bg-color fl-node-5e7cc79f749a3 fl-row-custom-height fl-row-align-top" data-node="5e7cc79f749a3">
                                                                                    <div class="fl-row-content-wrap">
                                                                                        <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                                                                            <div class="fl-col-group fl-node-5e7cc79f74996" data-node="5e7cc79f74996">
                                                                                                <div class="fl-col fl-node-5e7cc79f7499b fl-col-small" data-node="5e7cc79f7499b">
                                                                                                    <div class="fl-col-content fl-node-content">
                                                                                                        <?if(true){?>
                                                                                                        <div class="fl-module fl-module-pp-heading fl-node-5e7cc79f7499e" data-node="5e7cc79f7499e">
                                                                                                            <div class="fl-module-content fl-node-content">
                                                                                                                <div class="pp-heading-content">
                                                                                                                    <div class="pp-heading pp-left">
                                                                                                                        <h2 class="heading-title">
                                                                                                                            <span class="title-text pp-primary-title">Frame Size Guide</span>
                                                                                                                        </h2>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="fl-module fl-module-pp-image fl-node-5e7cc79f749a0" data-node="5e7cc79f749a0">
                                                                                                            <div class="fl-module-content fl-node-content">
                                                                                                                <div class="pp-photo-container">
                                                                                                                    <div
                                                                                                                        class="pp-photo pp-photo-align-left pp-photo-align-responsive-default"
                                                                                                                        itemscope
                                                                                                                        itemtype="http://schema.org/ImageObject"
                                                                                                                    >
                                                                                                                        <div class="pp-photo-content">
                                                                                                                            <div class="pp-photo-content-inner">
                                                                                                                                <img
                                                                                                                                    loading="lazy"
                                                                                                                                    width="368"
                                                                                                                                    height="90"
                                                                                                                                    class="pp-photo-img wp-image-20605 size-full"
                                                                                                                                    src="images/03-size-guid-text.jpg"
                                                                                                                                    alt="size-guid-text"
                                                                                                                                    itemprop="image"
                                                                                                                                    srcset="
                                                                                                                                        https://directvisioneyewear.ca/wp-content/uploads/2020/03/size-guid-text.jpg        368w,
                                                                                                                                        https://directvisioneyewear.ca/wp-content/uploads/2020/03/size-guid-text-300x73.jpg 300w,
                                                                                                                                        https://directvisioneyewear.ca/wp-content/uploads/2020/03/size-guid-text-150x37.jpg 150w
                                                                                                                                    "
                                                                                                                                    sizes="(max-width: 368px) 100vw, 368px"
                                                                                                                                />
                                                                                                                                <div class="pp-overlay-bg"></div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="fl-module fl-module-rich-text fl-node-5e7cc79f749a1" data-node="5e7cc79f749a1">
                                                                                                            <div class="fl-module-content fl-node-content">
                                                                                                                <div class="fl-rich-text">
                                                                                                                    <p><strong>Frame measurements are listed in mm (millimeters)</strong></p>
                                                                                                                    <p>
                                                                                                                        If you wear glasses and have a pair already, check the inner side<br />
                                                                                                                        of the temples (arms), you may find the size information stamped.
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <?}?>
                                                                                                        
                                                                                                        
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="fl-col fl-node-5e7cc79f7499d fl-col-small" data-node="5e7cc79f7499d">
                                                                                                    <div class="fl-col-content fl-node-content">
                                                                                                        <div class="fl-module fl-module-pp-image fl-node-5e7cc79f749a2" data-node="5e7cc79f749a2">
                                                                                                            <div class="fl-module-content fl-node-content">
                                                                                                                <div class="pp-photo-container">
                                                                                                                    <div
                                                                                                                        class="pp-photo pp-photo-align-right pp-photo-align-responsive-center"
                                                                                                                        itemscope
                                                                                                                        itemtype="http://schema.org/ImageObject"
                                                                                                                    >
                                                                                                                        <div class="pp-photo-content">
                                                                                                                            <div class="pp-photo-content-inner">
                                                                                                                                <img
                                                                                                                                    loading="lazy"
                                                                                                                                    width="422"
                                                                                                                                    height="281"
                                                                                                                                    class="pp-photo-img wp-image-20606 size-full"
                                                                                                                                    src="images/03-size-guide-1.jpg"
                                                                                                                                    alt="size-guide"
                                                                                                                                    itemprop="image"
                                                                                                                                    srcset="
                                                                                                                                        https://directvisioneyewear.ca/wp-content/uploads/2020/03/size-guide-1.jpg         422w,
                                                                                                                                        https://directvisioneyewear.ca/wp-content/uploads/2020/03/size-guide-1-300x200.jpg 300w,
                                                                                                                                        https://directvisioneyewear.ca/wp-content/uploads/2020/03/size-guide-1-150x100.jpg 150w
                                                                                                                                    "
                                                                                                                                    sizes="(max-width: 422px) 100vw, 422px"
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5eba5dc3df401" data-node="5eba5dc3df401">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                <div class="fl-col-group fl-node-5eba5dc3e1e35" data-node="5eba5dc3e1e35">
                                    <div class="fl-col fl-node-5eba5dc3e1f80" data-node="5eba5dc3e1f80">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-separator fl-node-5eba5d8d2a6bd" data-node="5eba5d8d2a6bd">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-separator"></div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-fl-woo-breadcrumb fl-node-5eba5de7135f1" data-node="5eba5de7135f1">
                                                <div class="fl-module-content fl-node-content">
                                                    <nav class="woocommerce-breadcrumb"><a href="directvisioneyewear.html">Home</a>&nbsp;/&nbsp;<a href="glasses.html">Glasses</a>&nbsp;/&nbsp;<?echo $glassDeets['title']?></nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5eb93cbf66ccd" data-node="5eb93cbf66ccd">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                <div class="fl-col-group fl-node-5eb93cbf67c4a fl-col-group-custom-width" data-node="5eb93cbf67c4a">
                                    <div class="fl-col fl-node-5eb93cbf67d65" data-node="5eb93cbf67d65">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-fl-woo-product-images fl-node-5eb9405bd1f86 pro-main-img" data-node="5eb9405bd1f86">
                                            
                                            <!-- sandeep -->
                                                <div class="fl-module-content fl-node-content">
                                                    <div
                                                        class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images"
                                                        data-columns="4"
                                                        style="opacity: 0; transition: opacity 0.25s ease-in-out;"
                                                    >
                                                        <figure class="woocommerce-product-gallery__wrapper">
                                                            
                                                             <div class="slideshow-container">
                                                            <?$sql ="SELECT * FROM glassBuy_glass_picture WHERE glass_id='$id'";
                                                              $img_data = $con->query($sql);
                                                              if($img_data->num_rows > 0){
                                                                  while($row = $img_data->fetch_assoc()) {?>
                                                              <div class="mySlides1">
                                                                <img src="uploads/<?php echo $row['name']; ?>" style="width:100%">
                                                              </div>
                                                              <?}}?>
                                                                
                                                              <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
                                                              <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
                                                            </div>


                                                          <!--  <div
                                                                data-thumb="uploads/<?php echo $img; ?>"
                                                                data-thumb-alt=""
                                                                class="woocommerce-product-gallery__image"
                                                            >
                                                                <a href="uploads/<?php echo $img; ?>">
                                                                    <img
                                                                        width="1640"
                                                                        height="1400"
                                                                        src="uploads/<?php echo $img; ?>"
                                                                        class="wp-post-image"
                                                                        alt=""
                                                                        title="<?php echo $img; ?>"
                                                                        data-caption=""
                                                                        data-src="uploads/<?php echo $img; ?>"
                                                                        data-large_image="uploads/<?php echo $img; ?>"
                                                                        data-large_image_width="2500"
                                                                        data-large_image_height="1400"
                                                                    />
                                                                </a>
                                                            </div>-->
                                                            
                                                            
                                                            
                                                            
                                                            <!--<div
                                                                data-thumb="uploads/<?php echo $img; ?>"
                                                                data-thumb-alt=""
                                                                class="woocommerce-product-gallery__image"
                                                            >
                                                                <a href="uploads/<?php echo $img; ?>">
                                                                    <img
                                                                        width="1640"
                                                                        height="918"
                                                                        src="uploads/<?php echo $img; ?>"
                                                                        class=""
                                                                        alt=""
                                                                        title="<?php echo $img; ?>"
                                                                        data-caption=""
                                                                        data-src="uploads/<?php echo $img; ?>"
                                                                        data-large_image="uploads/<?php echo $img; ?>"
                                                                        data-large_image_width="2500"
                                                                        data-large_image_height="1400"
                                                                        srcset="
                                                                            uploads/<?php echo $img; ?>  1640w,
                                                                            uploads/<?php echo $img; ?>    750w,
                                                                            uploads/<?php echo $img; ?>   300w,
                                                                            uploads/<?php echo $img; ?>  1024w,
                                                                            uploads/<?php echo $img; ?>    150w,
                                                                            uploads/<?php echo $img; ?>  768w,
                                                                            uploads/<?php echo $img; ?> 1536w,
                                                                            uploads/<?php echo $img; ?>2048w
                                                                        "
                                                                        sizes="(max-width: 1640px) 100vw, 1640px"
                                                                    />
                                                                </a>
                                                            </div>-->
                                                        </figure>
                                                    </div>
                                                </div>
                                            </div>
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=613aff08f7277c0019b0d64b&product=inline-share-buttons" async="async"></script>

<!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons" style="margin-top:20px;"></div><!-- ShareThis END --> 


<!--<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>-->

<link rel="stylesheet" type="text/css" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css"/>
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
<div class="owl-carousel owl-theme">
    <?foreach($getReviews as $review){?>
    <div class="item">
        <img src="./uploads/<?echo $review['profile_pic']?>" >
    </div>
    <?}?>
</div>	        

<script>
                            $('.owl-carousel').owlCarousel({
                            loop:true,
                            nav:true,
                            
                        })
                        </script>
		        
		        


                                            <div class="fl-module fl-module-html fl-node-5f48da58a6df9" data-node="5f48da58a6df9">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-html">
                                                        <script src="js/v1-fitmix.js" type="text/javascript"></script>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br><br><br><br><br>
                                            <?if($glassDeets['productCategory']!="Accessories"){?>
                                            <div class="fl-module fl-module-html fl-node-5f479c2b9edbd text-center btn-vto" data-node="5f479c2b9edbd">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-html">
                                                        <a href="#trynow" class="try-on" data-try_on="566954">TRY - ON</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?}?>
                                        </div>
                                    </div>
                                    <div class="fl-col fl-node-5eb93cbf67da3 fl-col-small detail-sidebar" data-node="5eb93cbf67da3">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-pp-heading fl-node-5eb93d1714d68" data-node="5eb93d1714d68">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-heading-content">
                                                        <div class="pp-heading pp-left">
                                                            <h1 class="heading-title">
                                                                <span class="title-text pp-primary-title"><?echo $glassDeets['title']?></span>
                                                            </h1>
                                                        </div>
                                                        <div class="pp-sub-heading">
                                                            <p><?echo $glassDeets['colour']?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-separator fl-node-5f47aec1228a4" data-node="5f47aec1228a4">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-separator"></div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-pp-heading fl-node-5eb93e54781a6" data-node="5eb93e54781a6">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-heading-content">
                                                        <div class="pp-heading pp-left">
                                                            <h3 class="heading-title">
                                                                <span class="title-text pp-primary-title">
                                                                    <p class="price">
                                                                        <span class="woocommerce-Price-amount amount">
                                                                            <bdi><span class="woocommerce-Price-currencySymbol">$</span><?echo $glassDeets['price']?></bdi>
                                                                        </span>
                                                                    </p>
                                                                    <!--<p><?echo $glassDeets['description']?></p>-->
                                                                </span>
                                                                
                                                            </h3>
                                                        </div>
                                                        <div class="pp-sub-heading">
                                                            <p><?echo $glassDeets['additional_info']?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-separator fl-node-5f47ae75b815a" data-node="5f47ae75b815a">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-separator"></div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-pp-heading fl-node-5eba698b56ab6 var-label" data-node="5eba698b56ab6">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-heading-content">
                                                        <div class="pp-heading pp-left">
                                                            <h4 class="heading-title">
                                                                
                                                                <span class="title-text pp-primary-title">Available Sizes
                                                                <?if($glassDeets['productCategory']!="Accessories"){?>
                                                                <a href="#size-guide" style="float: right; text-transform: none; font-weight: 400;" class="modal">Guide</a>
                                                                <?}?>
                                                                </span>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-woocommerce-product-glasses-cart-button fl-node-5eb93f03a7683" data-node="5eb93f03a7683">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-woocommerce-product-glasses-cart-button-module fl-icon-wrap">
                                                        <div class="fl-woocommerce-product-glasses-cart-button">
                                                            <form
                                                                class="variations_form cart"
                                                                action="https://directvisioneyewear.ca/product/<?echo $glassDeets['title']?>-tortoise/"
                                                                method="post"
                                                                enctype="multipart/form-data"
                                                                data-product_id="<?echo $glassDeets['glass_id']?>"
                                                            >
                                                                                                                                <!--removed-->

                                                                <table class="variations" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="label"><label for="pa_size">Size</label></td>
                                                                            <td class="value">
                                                                                <select
                                                                                    id="pa_size"
                                                                                    class="hide woo-variation-raw-select woo-variation-raw-type-button"
                                                                                    style="display: none;"
                                                                                    name="attribute_pa_size"
                                                                                    data-attribute_name="attribute_pa_size"
                                                                                    data-show_option_none="yes"
                                                                                >
                                                                                    <option value="">Choose an option</option>
                                                                                    <option value="<?echo $glassDeets['available_sizes']?>"><?echo $glassDeets['available_sizes']?></option>
                                                                                </select>
                                                                                <ul class="variable-items-wrapper button-variable-wrapper" data-attribute_name="attribute_pa_size">
                                                                                    <li
                                                                                        data-wvstooltip="<?echo $glassDeets['available_sizes']?>"
                                                                                        class="variable-item button-variable-item button-variable-item-<?echo $glassDeets['available_sizes']?>"
                                                                                        title="<?echo $glassDeets['available_sizes']?>"
                                                                                        data-value="<?echo $glassDeets['available_sizes']?>"
                                                                                        role="button"
                                                                                        tabindex="0"
                                                                                    >
                                                                                        <span class="variable-item-span variable-item-span-button"><?echo $glassDeets['available_sizes']?></span>
                                                                                    </li>
                                                                                </ul>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="label"><label for="pa_colour">Colour</label></td>
                                                                            <td class="value">
                                                                                <select
                                                                                    id="pa_colour"
                                                                                    class="hide woo-variation-raw-select woo-variation-raw-type-button"
                                                                                    style="display: none;"
                                                                                    name="attribute_pa_colour"
                                                                                    data-attribute_name="attribute_pa_colour"
                                                                                    data-show_option_none="yes"
                                                                                >
                                                                                    <option value="">Choose an option</option>
                                                                                    <option value="tortoise">Tortoise</option>
                                                                                </select>
                                                                                <ul class="variable-items-wrapper button-variable-wrapper" data-attribute_name="attribute_pa_colour">
                                                                                    <li
                                                                                        data-wvstooltip="Tortoise"
                                                                                        class="variable-item button-variable-item button-variable-item-tortoise"
                                                                                        title="Tortoise"
                                                                                        data-value="tortoise"
                                                                                        role="button"
                                                                                        tabindex="0"
                                                                                    >
                                                                                        <span class="variable-item-span variable-item-span-button">Tortoise</span>
                                                                                    </li>
                                                                                </ul>
                                                                                <a class="reset_variations" href="#">Clear</a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                                <div class="single_variation_wrap">
                                                                    <div class="woocommerce-variation single_variation"></div>
                                                                    <div class="woocommerce-variation-add-to-cart variations_button">
                                                                        <div class="quantity hidden">
                                                                            <input type="hidden" id="quantity_60a8f45502c86" class="qty" name="quantity" value="1" />
                                                                        </div>

                                                                        <button class="button-alt view-rx" id="sp-addprescription-lenses" onclick="return false;">ADD LENSES</button>
                                                                        <button class="button-alt bordered" id="sp-addframe-only">FRAME ONLY</button>

                                                                        <!--                    <button type="submit" class="single_add_to_cart_button button alt">Add to cart</button>-->

                                                                        <input type="hidden" name="add-to-cart" value="<?echo $glassDeets['glass_id']?>" />
                                                                        <input type="hidden" name="product_id" value="<?echo $glassDeets['glass_id']?>" />
                                                                        <input type="hidden" name="variation_id" class="variation_id" value="0" />
                                                                    </div>
                                                                </div>
                                                            </form>

                                                            <form
                                                                class="variations_form cart"
                                                                style="display: none;"
                                                                action="https://directvisioneyewear.ca/product/<?echo $glassDeets['title']?>-black/"
                                                                method="post"
                                                                enctype="multipart/form-data"
                                                                data-product_id="21470"
                                                                data-product_variations='[{"attributes":{"attribute_pa_size":"<?echo $glassDeets['available_sizes']?>","attribute_pa_colour":"black"},"availability_html":"","backorders_allowed":false,"dimensions":{"length":"","width":"","height":""},"dimensions_html":"N\/A","display_price":<?echo $glassDeets['price']?>,"display_regular_price":<?echo $glassDeets['price']?>,"image":{"title":"EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front","caption":"","url":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/09\/EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front.jpg","alt":"","src":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/09\/EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front-1640x918.jpg","srcset":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/09\/EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front-1640x918.jpg 1640w, https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/09\/EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front-750x420.jpg 750w, https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/09\/EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front-300x168.jpg 300w, https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/09\/EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front-1024x573.jpg 1024w, https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/09\/EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front-150x84.jpg 150w, https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/09\/EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front-768x430.jpg 768w, https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/09\/EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front-1536x860.jpg 1536w, https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/09\/EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front-2048x1147.jpg 2048w","sizes":"(max-width: 1640px) 100vw, 1640px","full_src":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/09\/EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front.jpg","full_src_w":2500,"full_src_h":1400,"gallery_thumbnail_src":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/09\/EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front-1024x573.jpg","gallery_thumbnail_src_w":1024,"gallery_thumbnail_src_h":573,"thumb_src":"https:\/\/directvisioneyewear.ca\/wp-content\/uploads\/2020\/09\/EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front-750x420.jpg","thumb_src_w":750,"thumb_src_h":420,"src_w":1640,"src_h":918},"image_id":21473,"is_downloadable":false,"is_in_stock":true,"is_purchasable":true,"is_sold_individually":"yes","is_virtual":false,"max_qty":1,"min_qty":1,"price_html":"","sku":"wpid_151","variation_description":"","variation_id":21471,"variation_is_active":true,"variation_is_visible":true,"weight":"","weight_html":"N\/A"}]'
                                                            >
                                                                <table class="variations" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="label"><label for="pa_size">Size</label></td>
                                                                            <td class="value">
                                                                                <select
                                                                                    id="pa_size"
                                                                                    class="hide woo-variation-raw-select woo-variation-raw-type-button"
                                                                                    style="display: none;"
                                                                                    name="attribute_pa_size"
                                                                                    data-attribute_name="attribute_pa_size"
                                                                                    data-show_option_none="yes"
                                                                                >
                                                                                    <option value="">Choose an option</option>
                                                                                    <option value="<?echo $glassDeets['available_sizes']?>"><?echo $glassDeets['available_sizes']?></option>
                                                                                </select>
                                                                                <ul class="variable-items-wrapper button-variable-wrapper" data-attribute_name="attribute_pa_size">
                                                                                    <li
                                                                                        data-wvstooltip="<?echo $glassDeets['available_sizes']?>"
                                                                                        class="variable-item button-variable-item button-variable-item-<?echo $glassDeets['available_sizes']?>"
                                                                                        title="<?echo $glassDeets['available_sizes']?>"
                                                                                        data-value="<?echo $glassDeets['available_sizes']?>"
                                                                                        role="button"
                                                                                        tabindex="0"
                                                                                    >
                                                                                        <span class="variable-item-span variable-item-span-button"><?echo $glassDeets['available_sizes']?></span>
                                                                                    </li>
                                                                                </ul>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="label"><label for="pa_colour">Colour</label></td>
                                                                            <td class="value">
                                                                                <select
                                                                                    id="pa_colour"
                                                                                    class="hide woo-variation-raw-select woo-variation-raw-type-button"
                                                                                    style="display: none;"
                                                                                    name="attribute_pa_colour"
                                                                                    data-attribute_name="attribute_pa_colour"
                                                                                    data-show_option_none="yes"
                                                                                >
                                                                                    <option value="">Choose an option</option>
                                                                                    <option value="black">Black</option>
                                                                                </select>
                                                                                <ul class="variable-items-wrapper button-variable-wrapper" data-attribute_name="attribute_pa_colour">
                                                                                    <li
                                                                                        data-wvstooltip="Black"
                                                                                        class="variable-item button-variable-item button-variable-item-black"
                                                                                        title="Black"
                                                                                        data-value="black"
                                                                                        role="button"
                                                                                        tabindex="0"
                                                                                    >
                                                                                        <span class="variable-item-span variable-item-span-button">Black</span>
                                                                                    </li>
                                                                                </ul>
                                                                                <a class="reset_variations" href="#">Clear</a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                                <div class="single_variation_wrap">
                                                                    <div class="woocommerce-variation single_variation"></div>
                                                                    <div class="woocommerce-variation-add-to-cart variations_button">
                                                                        <div class="quantity hidden">
                                                                            <input type="hidden" id="quantity_60a8f45509e73" class="qty" name="quantity" value="1" />
                                                                        </div>

                                                                        <button class="button-alt view-rx" id="sp-addprescription-lenses" onclick="return false;">ADD LENSES</button>
                                                                        <button class="button-alt bordered" id="sp-addframe-only">FRAME ONLY</button>

                                                                        <!--                    <button type="submit" class="single_add_to_cart_button button alt">Add to cart</button>-->

                                                                        <input type="hidden" name="add-to-cart" value="21470" />
                                                                        <input type="hidden" name="product_id" value="21470" />
                                                                        <input type="hidden" name="variation_id" class="variation_id" value="0" />
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-html fl-node-5ebbc93742fbf cart-buttons" data-node="5ebbc93742fbf">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-html">
                                                        <div class="fl-frame-form">
                                                            <div class="frame-validation"></div>
                                                            <form action="./select_lenses.php" method="get" class="frame_button">
                                                                <input type="hidden" name="product_id" id="product_id" value="<?echo $glassDeets['glass_id']?>" />
                                                                <input type="hidden" name="variation_id" id="variation_id" value="0" />
                                                                <div class="pp-button-wrap pp-button-width-full">
                                                                    <button type="submit" name="frame-btn" value="frame-only" id="frame_btn" class="pp-button pp-button-text" >
                                                                        <?if($glassDeets['productCategory']!="Accessories"){?>
                                                                        Frame Only
                                                                        <?}else{?>
                                                                        Add to Cart
                                                                        <?}?></button>
                                                                    <?if($glassDeets['productCategory']!="Accessories"){?>
                                                                    <button type="submit" name="frame-btn"  id="frame_btn" class="pp-button pp-button-text" >Select Lenses</button>
                                                                    <?}?>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-pp-infolist fl-node-5f47a1282ac56 delivery-list" data-node="5f47a1282ac56">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-infolist-wrap">
                                                        <div class="pp-infolist layout-1">
                                                            <ul class="pp-list-items">
                                                                <li class="pp-list-item pp-list-item-0">
                                                                    <div class="pp-icon-wrapper animated none">
                                                                        <div class="pp-infolist-icon">
                                                                            <div class="pp-infolist-icon-inner">
                                                                                <img src="images/05-icon-shipping.png" alt="icon-shipping" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pp-heading-wrapper">
                                                                        <div class="pp-infolist-title">
                                                                            <p class="pp-infolist-title-text">Free Shipping over $99</p>
                                                                        </div>
                                                                        
                                                                        
                                                                        
                                                                        <div class="pp-infolist-description"></div>
                                                                    </div>

                                                                    <div class="pp-list-connector"></div>
                                                                </li>
                                                                <li class="pp-list-item pp-list-item-1">
                                                                    <div class="pp-icon-wrapper animated none">
                                                                        <div class="pp-infolist-icon">
                                                                            <div class="pp-infolist-icon-inner">
                                                                                <img src="images/05-icon-moneyback.png" alt="icon-moneyback" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pp-heading-wrapper">
                                                                        <div class="pp-infolist-title">
                                                                            <p class="pp-infolist-title-text">30-Day Money Back</p>
                                                                        </div>
                                                                        <div class="pp-infolist-description"></div>
                                                                    </div>

                                                                    <div class="pp-list-connector"></div>
                                                                </li>
                                                                <li class="pp-list-item pp-list-item-2">
                                                                    <div class="pp-icon-wrapper animated none">
                                                                        <div class="pp-infolist-icon">
                                                                            <div class="pp-infolist-icon-inner">
                                                                                <img src="images/05-icon-glasses-lens.png" alt="icon-glasses-lens" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pp-heading-wrapper">
                                                                        <div class="pp-infolist-title">
                                                                            <p class="pp-infolist-title-text">
                                                                                
                                                                                Glass is Limited
                                                                        <?$randNo = rand(30,80);
                                                                        $randNo1 = rand(5, 20);?>
                                                                        . <?echo $randNo?> - <?echo $randNo + $randNo1?> people reviewing ,looking at this pair
                                                                        
                                                                        
                                                                            </p>
                                                                        </div>
                                                                        <div class="pp-infolist-description"></div>
                                                                    </div>

                                                                    <div class="pp-list-connector"></div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-html fl-node-5eb940199ecfc" data-node="5eb940199ecfc">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-html">
                                                        <div class="fl-clear"></div>
                                                        <div class="gls-colors"><ul></ul></div>
                                                        <script type="text/javascript">
                                                            var alt_color_json_<?echo $glassDeets['glass_id']?> = [];
                                                            var alt_color_sun_json_<?echo $glassDeets['glass_id']?> = [];
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
                    <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5f47b9f18311d" data-node="5f47b9f18311d">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                <div class="fl-col-group fl-node-5f47b9f18e660" data-node="5f47b9f18e660">
                                    <div class="fl-col fl-node-5f47b9f18e7c4" data-node="5f47b9f18e7c4">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-separator fl-node-5f47b9f180aad" data-node="5f47b9f180aad">
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
                    <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5f47a48e0379f" data-node="5f47a48e0379f">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                
                                <?$sql ="SELECT * FROM glassBuy_glasses where relatedTo='$id'";
                                $result = $con->query($sql);
                                while($row = $result->fetch_assoc()) {
                                    $glassDeetsSec = $row;
                                    $glass_idsec = $row['glass_id'];
                                }
                                
                                $sql ="SELECT * FROM glassBuy_glass_picture WHERE glass_id='$glass_idsec'";
                                  $img_data = $con->query($sql);
                                  if($img_data->num_rows > 0){
                                      $rowd = $img_data->fetch_assoc();
                                      $imgSec = $rowd['name'];
                                  }
                                 
                                if(true){
                                ?>
                                <div class="fl-col-group fl-node-5f47a48e11c97 fl-col-group-custom-width" data-node="5f47a48e11c97">
                                   <div class="fl-col fl-node-5f47a48e11f04" data-node="5f47a48e11f04">
                                       <?if($glassDeetsSec['title']!=""){?>
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-pp-heading fl-node-5f47a8efa3e1b" data-node="5f47a8efa3e1b">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-heading-content">
                                                        <div class="pp-heading pp-left">
                                                            <h3 class="heading-title">
                                                                <span class="title-text pp-primary-title"></span>
                                                            </h3>
                                                        </div>
                                                        <div class="pp-sub-heading">
                                                            <p>Alternative Colors</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-html fl-node-5f47a48df3cb0" data-node="5f47a48df3cb0">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-html">
                                                        <script src="js/1.6.0-slick.min.js"></script>
                                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" crossorigin="anonymous" />
                                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" crossorigin="anonymous" />
                                                        <div class="alt-colors">
                                                            <ul>
                                                                <li>
                                                                    <div class="fl-woocommerce-product-alt-colours-image">
                                                                        <a href="./product.php?id=<?echo $glassDeetsSec['glass_id']?>" alt="<?echo $glassDeetsSec['title']?>">
                                                                            <div class="alt-wrapper" itemscope="" itemtype="https://schema.org/ImageObject">
                                                                                <div class="fl-photo-content fl-photo-img-jpg">
                                                                                    <img
                                                                                        loading="lazy"
                                                                                        class="fl-photo-img size-full"
                                                                                        src="./uploads/<?echo $imgSec?>"
                                                                                        alt=""
                                                                                        itemprop="image"
                                                                                        data-no-lazy="1"
                                                                                        height="327"
                                                                                        width="800"
                                                                                        title=""
                                                                                    />
                                                                                </div>
                                                                                <div class="product-title">
                                                                                    <span class="product-title" style="display: none;"><?echo $glassDeetsSec['title']?></span><span class="color" style="display: inline-block;"><?echo $glassDeetsSec['title']?></span>
                                                                                    <span class="product-price">
                                                                                        <span class="woocommerce-Price-amount amount">
                                                                                            <bdi><span class="woocommerce-Price-currencySymbol">$</span><?echo $glassDeetsSec['price']?></bdi>
                                                                                        </span>
                                                                                    </span>
                                                                                </div>
                                                                                <a href="javascript:void(0);" data-fb-code="566953" class="fb-code">Try</a>
                                                                                <a href="./product.php?id=<?echo $glassDeetsSec['glass_id']?>" class="product-link">Frame Only</a>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </li>

                                                                <li class="active">
                                                                    <div class="fl-woocommerce-product-alt-colours-image">
                                                                        <a href="./product.php?id=<?echo $glassDeetsSec['glass_id']?>" alt="<?echo $glassDeetsSec['title']?>">
                                                                            <div class="alt-wrapper" itemscope="" itemtype="https://schema.org/ImageObject">
                                                                                <div class="fl-photo-content fl-photo-img-jpg">
                                                                                    <img
                                                                                        loading="lazy"
                                                                                        class="fl-photo-img size-full"
                                                                                        src="./uploads/<?echo $imgSec?>"
                                                                                        alt=""
                                                                                        itemprop="image"
                                                                                        data-no-lazy="1"
                                                                                        height="327"
                                                                                        width="800"
                                                                                        title=""
                                                                                    />
                                                                                </div>
                                                                                <div class="product-title">
                                                                                    <span class="product-title" style="display: none;"><?echo $glassDeetsSec['title']?></span><span class="color" style="display: inline-block;">Tortoise</span>
                                                                                    <span class="product-price">
                                                                                        <span class="woocommerce-Price-amount amount">
                                                                                            <bdi><span class="woocommerce-Price-currencySymbol">$</span><?echo $glassDeetsSec['price']?></bdi>
                                                                                        </span>
                                                                                    </span>
                                                                                </div>
                                                                                <a href="javascript:void(0);" data-fb-code="566954" class="fb-code">Try</a>
                                                                                <a href="./product.php?id=<?echo $glassDeetsSec['glass_id']?>" class="product-link">Frame Only</a>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?}?>
                                    </div>
                                    
                                    
                                    
                                    <?if(false){?>
                                    <div class="fl-col fl-node-5f47a804a723a fl-col-small" data-node="5f47a804a723a">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-pp-heading fl-node-5f47a823c8b5e" data-node="5f47a823c8b5e">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-heading-content">
                                                        <div class="pp-heading pp-left">
                                                            <h2 class="heading-title">
                                                                <span class="title-text pp-primary-title"></span>
                                                            </h2>
                                                        </div>
                                                        <div class="pp-sub-heading">
                                                            <p>Additional information</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-html fl-node-5f47a804a7121 product-information" data-node="5f47a804a7121">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-html">
                                                        <table>
                                                            <tbody>
                                                                <!--<tr>
<td>Brand:</td>
<td>Eight To Eighty
</td>
</tr>-->
                                                                <tr>
                                                                    <td>Model:</td>
                                                                    <td><?echo $glassDeets['title']?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Name:</td>
                                                                    <td><?echo $glassDeets['title']?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Color:</td>
                                                                    <td><?echo $glassDeets['colour']?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Color Code:</td>
                                                                    <td><?echo $glassDeets['colorCode']?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Material:</td>
                                                                    <td><?echo $glassDeets['material']?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gender:</td>
                                                                    <td><?echo $glassDeets['gender']?></td>
                                                                </tr>
                                                                
                                                                
                                                                
                                                               <!-- <?foreach($glass_atts_public as $col){
                                                                if($glassDeets[$col]!=""){?>
                                                                    <tr>
                                                                        <td><?echo ucfirst($col)?>:</td>
                                                                        <td><?echo $glassDeets[$col]?></td>
                                                                    </tr>
                                                                <?}}?>-->
                                                               
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?}?>
                                </div>
                                <?}?>
                                
                                <hr>
                    <h4>Reviews</h4>
                    
                    <?php
                    $avgRate = 0;
                    $showNReviews = $_GET['showNReviews'];
                    if($showNReviews==""){
                        $showNReviews = 3;
                    }
                    
                $showNReviews_i= 0 ;
                foreach($getReviews as $review){
                  $avgRate += $review['rating'];
                  if($showNReviews_i<=$showNReviews){
                ?>
                <div class="list-group-item list-group-item-action">
                     <div class="ratingBox">
                    <div class="row">
                        <div class="col-md-2">
                            <h5 class="mb-1">By <?php echo ucfirst(explode(" ", $review['name'])[0]); ?></h5>
                                <small><?php echo date("d M",$review['timeAdded']); ?></small>
                        </div>
                        <div class="col-md-10">
                            
                           
                              <div class="d-flex w-100 justify-content-between">
                                  
                                
                              </div>
                              <div class="ratelist" data-rating-stars="5" data-rating-value="<?php echo $review['rating']; ?>" data-rating-readonly="true"></div>
                              <strong class="d-block mb-2"><?php echo $review['review']; ?></strong>
                              <!-- auth check for remove comment -->
                              <?php
                              // if(isset($session_userId) && ($review['userId'] == $_SESSION['userId']) || (isset($session_userId) && in_array($session_role,['admin']))){
                              if(isset($session_userId) && ($review['userId'] == $_SESSION['userId']) || (isset($session_userId) && in_array($session_role,['admin']))){
                              ?>
                              <div class="float-right">
                                <form method="post" action="" onsubmit="return confirm('Do you want to remove Review?');">
                                  <input type="hidden" name="review_id" value="<?php echo $review['reviewId']; ?>">
                                  <input type="hidden" name="DELETE_REVIEW" value="true">
                                  <input type="hidden" name="glassId" value="<?php echo $l_glassId;?>">
                                  <input type="submit" class="btn btn-sm btn-outline-danger" value="REMOVE">
                                </form>
                              </div>
                              <?php } ?>
                              <!-- end auth check for remove comment -->
                              <a href="./uploads/<?echo $review['profile_pic']?>" target="_blank">
                              <img src="./uploads/<?echo $review['profile_pic']?>" style="width:180px;">
                              </a>
            
            
                            
                            
                
                        </div>
                    </div>
                    </div>
                
                </div>
                <?php 
                      
                      $showNReviews_i+=1;
                  }}
                ?>
                
                <a class="btn " href="?id=<?echo $_GET['id']?>&showNReviews=<?echo $showNReviews+3?>">Show More</a>
                    
                    
                    <?php if(isset($session_userId) && !$isUserPostReview){ ?>
                    <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-wrap">
                        
                        <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-first">
                            <label for="type">Rating<span class="required">*</span></label>
                            <div class="form-group">
                                
                              <input type="hidden" name="rate">
                              <input type="hidden" name="glassIdInp" value="<?php echo $l_glassId;?>">
                              <label>Rate</label>
                              <div class="starrating" style="font-size: 2em;"></div>
                            </div>
                    
                    
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                            <label for="type">Profile Pic<span class="required">*</span></label>
                            <input class="input-text" name="profile_pic"  id="type" type="file" required>
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                            <label for="type">Review<span class="required">*</span></label>
                            <textarea class="input-text" name="review"  id="type" type="number" min="0" max="100" required></textarea>
                        </p>
                        
                        
                        
                        <script type="text/javascript">
                          $(document).ready(function(){
                            $('.starrating').rating({
                              stars: 5,
                              click:function (e) {
                                  var selector = e.event.currentTarget;
                                  $(selector).parents(".form-group").find('input[name=rate]').val(e.stars);
                                }
                            });
                          });
                        </script>
    
                        
                        
                        <p>
                            <button class="btn-link" type="submit">Submit</button>
                        </p>
                        
                        
                        
                        </div>
                    </form>
                    
                    <?php }?>
                            </div>
                            
                            
                        </div>
                    </div>
                    
                    
                    
                   
                    <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5f47bf137b155" data-node="5f47bf137b155">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                <div class="fl-col-group fl-node-5f47bf137b21c" data-node="5f47bf137b21c">
                                    <div class="fl-col fl-node-5f47bf137b261" data-node="5f47bf137b261">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-separator fl-node-5f47bf137b2a5 fl-visible-desktop-medium" data-node="5f47bf137b2a5">
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
                    <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5f47abcd6d83e" data-node="5f47abcd6d83e">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                <div class="fl-col-group fl-node-5f47abcd7821b" data-node="5f47abcd7821b">
                                    <div class="fl-col fl-node-5f47abcd7838a" data-node="5f47abcd7838a">
                                        <div class="fl-col-content fl-node-content">
                                            
                                            <div id="size-guide" class="fl-module fl-module-pp-advanced-tabs fl-node-5f47abcd6af26 size-guid-tabs" data-node="5f47abcd6af26">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-tabs pp-tabs-horizontal pp-tabs-vertical-left pp-tabs-default pp-clearfix" role="tablist">
                                                        <div class="pp-tabs-labels pp-clearfix">
                                                            <div
                                                                id="pp-tab-5f47abcd6af26-1"
                                                                class="pp-tabs-label pp-tab-active pp-tab-icon-left"
                                                                data-index="0"
                                                                role="tab"
                                                                tabindex="-1"
                                                                aria-selected="true"
                                                                aria-controls="pp-tab-5f47abcd6af26-1-content"
                                                            >
                                                                <div class="pp-tab-label-inner">
                                                                    <div class="pp-tab-label-wrap">
                                                                        <span class="pp-tab-title">Size Guide</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                id="pp-tab-5f47abcd6af26-2"
                                                                class="pp-tabs-label pp-tab-icon-left"
                                                                data-index="1"
                                                                role="tab"
                                                                tabindex="-1"
                                                                aria-selected="false"
                                                                aria-controls="pp-tab-5f47abcd6af26-2-content"
                                                            >
                                                                <div class="pp-tab-label-inner">
                                                                    <div class="pp-tab-label-wrap">
                                                                        <span class="pp-tab-title">Shipping &amp; Returns</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pp-tabs-panels pp-clearfix">
                                                            <div class="pp-tabs-panel" id="size-guide-0">
                                                                <div class="pp-tabs-label pp-tabs-panel-label pp-tab-active pp-tab-icon-left" data-index="0" role="tab">
                                                                    <div class="pp-tab-label-inner">
                                                                        <div class="pp-tab-label-flex">
                                                                            <div class="pp-tab-label-wrap">
                                                                                <span class="pp-tab-title">Size Guide</span>
                                                                            </div>
                                                                        </div>

                                                                        <i class="pp-toggle-icon pp-tab-open fa fa-plus"></i>

                                                                        <i class="pp-toggle-icon pp-tab-close fa fa-minus"></i>
                                                                    </div>
                                                                </div>
                                                                <div id="pp-tab-5f47abcd6af26-1-content" class="pp-tabs-panel-content pp-clearfix pp-tab-active" data-index="0" role="tabpanel" aria-labelledby="pp-tab-5f47abcd6af26-1">
                                                                    <div class="fl-builder-content fl-builder-content-19445 fl-builder-template fl-builder-row-template fl-builder-global-templates-locked product" data-post-id="19445">
                                                                        <div id="size-guide" class="fl-row fl-row-fixed-width fl-row-bg-color fl-node-5e7cc79f749a3 fl-row-custom-height fl-row-align-top" data-node="5e7cc79f749a3">
                                                                            <div class="fl-row-content-wrap">
                                                                                <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                                                                    <div class="fl-col-group fl-node-5e7cc79f74996" data-node="5e7cc79f74996">
                                                                                        <?if(false){?>
                                                                                        <div class="fl-col fl-node-5e7cc79f7499b fl-col-small" data-node="5e7cc79f7499b">
                                                                                            
                                                                                            <div class="fl-col-content fl-node-content">
                                                                                                <div class="fl-module fl-module-pp-heading fl-node-5e7cc79f7499e" data-node="5e7cc79f7499e">
                                                                                                    <div class="fl-module-content fl-node-content">
                                                                                                        <div class="pp-heading-content">
                                                                                                            <div class="pp-heading pp-left">
                                                                                                                <h2 class="heading-title">
                                                                                                                    <span class="title-text pp-primary-title">Frame Size Guide</span>
                                                                                                                </h2>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="fl-module fl-module-pp-image fl-node-5e7cc79f749a0" data-node="5e7cc79f749a0">
                                                                                                    <div class="fl-module-content fl-node-content">
                                                                                                        <div class="pp-photo-container">
                                                                                                            <div class="pp-photo pp-photo-align-left pp-photo-align-responsive-default" itemscope itemtype="http://schema.org/ImageObject">
                                                                                                                <div class="pp-photo-content">
                                                                                                                    <div class="pp-photo-content-inner">
                                                                                                                        <img
                                                                                                                            loading="lazy"
                                                                                                                            width="368"
                                                                                                                            height="90"
                                                                                                                            class="pp-photo-img wp-image-20605 size-full"
                                                                                                                            src="images/03-size-guid-text.jpg"
                                                                                                                            alt="size-guid-text"
                                                                                                                            itemprop="image"
                                                                                                                            srcset="
                                                                                                                                https://directvisioneyewear.ca/wp-content/uploads/2020/03/size-guid-text.jpg        368w,
                                                                                                                                https://directvisioneyewear.ca/wp-content/uploads/2020/03/size-guid-text-300x73.jpg 300w,
                                                                                                                                https://directvisioneyewear.ca/wp-content/uploads/2020/03/size-guid-text-150x37.jpg 150w
                                                                                                                            "
                                                                                                                            sizes="(max-width: 368px) 100vw, 368px"
                                                                                                                        />
                                                                                                                        <div class="pp-overlay-bg"></div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="fl-module fl-module-rich-text fl-node-5e7cc79f749a1" data-node="5e7cc79f749a1">
                                                                                                    <div class="fl-module-content fl-node-content">
                                                                                                        <div class="fl-rich-text">
                                                                                                            <p><strong>Frame measurements are listed in mm (millimeters)</strong></p>
                                                                                                            <p>
                                                                                                                If you wear glasses and have a pair already, check the inner side<br />
                                                                                                                of the temples (arms), you may find the size information stamped.
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                            
                                                                                        </div>
                                                                                        <div class="fl-col fl-node-5e7cc79f7499d fl-col-small" data-node="5e7cc79f7499d">
                                                                                            <div class="fl-col-content fl-node-content">
                                                                                                <div class="fl-module fl-module-pp-image fl-node-5e7cc79f749a2" data-node="5e7cc79f749a2">
                                                                                                    <div class="fl-module-content fl-node-content">
                                                                                                        <div class="pp-photo-container">
                                                                                                            <div class="pp-photo pp-photo-align-right pp-photo-align-responsive-center" itemscope itemtype="http://schema.org/ImageObject">
                                                                                                                <div class="pp-photo-content">
                                                                                                                    <div class="pp-photo-content-inner">
                                                                                                                        <img
                                                                                                                            loading="lazy"
                                                                                                                            width="422"
                                                                                                                            height="281"
                                                                                                                            class="pp-photo-img wp-image-20606 size-full"
                                                                                                                            src="images/03-size-guide-1.jpg"
                                                                                                                            alt="size-guide"
                                                                                                                            itemprop="image"
                                                                                                                            srcset="
                                                                                                                                https://directvisioneyewear.ca/wp-content/uploads/2020/03/size-guide-1.jpg         422w,
                                                                                                                                https://directvisioneyewear.ca/wp-content/uploads/2020/03/size-guide-1-300x200.jpg 300w,
                                                                                                                                https://directvisioneyewear.ca/wp-content/uploads/2020/03/size-guide-1-150x100.jpg 150w
                                                                                                                            "
                                                                                                                            sizes="(max-width: 422px) 100vw, 422px"
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
                                                                                        <?}?>
                                                                                        <img src="./images/size.png.jpg">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pp-tabs-panel" id="size-guide-1">
                                                                <div class="pp-tabs-label pp-tabs-panel-label pp-tab-icon-left" data-index="1" role="tab">
                                                                    <div class="pp-tab-label-inner">
                                                                        <div class="pp-tab-label-flex">
                                                                            <div class="pp-tab-label-wrap">
                                                                                <span class="pp-tab-title">Shipping &amp; Returns</span>
                                                                            </div>
                                                                        </div>

                                                                        <i class="pp-toggle-icon pp-tab-open fa fa-plus"></i>

                                                                        <i class="pp-toggle-icon pp-tab-close fa fa-minus"></i>
                                                                    </div>
                                                                </div>
                                                                <div id="pp-tab-5f47abcd6af26-2-content" class="pp-tabs-panel-content pp-clearfix" data-index="1" role="tabpanel" aria-labelledby="pp-tab-5f47abcd6af26-2">
                                                                    <div itemprop="text">
                                                                        <h3>Delivery</h3>
                                                                        <p>
                                                                            Direct Vision will deliver the Product to the address provided by the Customer in a commercially viable manner as quickly and efficiently as reasonably possible. In
                                                                            some instances, an order may be delayed. Delays may include a lack of Product in stock, product requiring special handling or prescription information needing to be
                                                                            verified. Delays may also be due to issue with a third-party shipping company. Direct Vision holds no responsibility to delays under any circumstance. Once Product
                                                                            is in stock they should be shipped within 1-2 business days and will arrive within the time estimate provided for your chosen shipping method. If you are
                                                                            dissatisfied with the delivery time, your sole remedy and recourse is to return the Product in accordance with our return policy.
                                                                        </p>
                                                                        <h3>Returns and Exchanges</h3>
                                                                        <p>
                                                                            Direct Vision offers a 14 day return policy on all eyewear. To make a return simply contact us within 14 days for your request to be processed. Please ship the
                                                                            product back to us as soon a possible to receive your refund. Glasses or sunglasses must be returned in their original and unworn conditions. Returns of glasses or
                                                                            sunglasses made after 14 days are subject to a restocking fee. Direct Vision has the right to deny returns or exchanges, in very rare circumstances, based on the
                                                                            nature of your prior transactions. Direct Vision is not responsible for refunding the cost of shipping but may cover this cost at the company&rsquo;s discretion.
                                                                        </p>
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
                    
                    
                  <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5ebbb1900125d" data-node="5ebbb1900125d">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                <div class="fl-col-group fl-node-5ebbb19008658" data-node="5ebbb19008658">
                                    <div class="fl-col fl-node-5ebbb190087a3" data-node="5ebbb190087a3">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-pp-heading fl-node-5ebbb3c517d70" data-node="5ebbb3c517d70">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-heading-content">
                                                        <div class="pp-heading pp-center">
                                                            <h2 class="heading-title">
                                                                <span class="title-text pp-primary-title">You Might Also Like</span>
                                                            </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-module fl-module-pp-content-grid fl-node-5ebbb1900095d facetwp-template facetwp-bb-module" data-node="5ebbb1900095d">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-posts-wrapper">
                                                        <div class="pp-content-posts">
                                                            <div class="pp-content-post-carousel pp-masonry-active pp-paged-scroll-to clearfix" itemscope="itemscope" itemtype="https://schema.org/Collection">
                                                                <div class="pp-content-posts-inner owl-carousel owl-theme">

                                                                    <?php 
                                                                     $sql ="SELECT * FROM glassBuy_glasses";
                                                                    $result = $con->query($sql);
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
                                                                        class="pp-content-post pp-content-carousel-post pp-grid-custom post-21452 product type-product status-publish has-post-thumbnail product_cat-collection product_cat-glasses product_cat-men-glasses product_cat-pz-optical-glasses product_cat-women-glasses pa_brand-pz-optical pa_collection-glasses pa_colour-black pa_gender-men pa_gender-women pa_material-plastic pa_primary-colour-black pa_shape-cat-eye pa_size-55-16-145 pa_supplier-direct-vision pa_virtual-try-on-yes first instock sold-individually taxable shipping-taxable purchasable product-type-variable"
                                                                        itemscope
                                                                        itemtype="https://schema.org/CreativeWork"
                                                                        data-id="21452"
                                                                    >
                                                                        <meta itemscope itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" itemid="https://directvisioneyewear.ca/product/sandy-black/" content="Sandy" />
                                                                        <meta itemprop="datePublished" content="2020-09-01" /><meta itemprop="dateModified" content="2020-11-08" />
                                                                        <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization"><meta itemprop="name" content="Direct Vision" /></div>
                                                                        <div itemscope itemprop="author" itemtype="https://schema.org/Person">
                                                                            <meta itemprop="url" content="https://directvisioneyewear.ca/author/tlustvup/" /><meta itemprop="name" content="tlustvup" />
                                                                        </div>
                                                                        <div itemscope itemprop="image" itemtype="https://schema.org/ImageObject">
                                                                            <meta itemprop="url" content="uploads/<?php echo $img; ?>" />
                                                                            <meta itemprop="width" content="2500" /><meta itemprop="height" content="1400" />
                                                                        </div>
                                                                        <div itemprop="interactionStatistic" itemscope itemtype="https://schema.org/InteractionCounter">
                                                                            <meta itemprop="interactionType" content="https://schema.org/CommentAction" /><meta itemprop="userInteractionCount" content="0" />
                                                                        </div>
                                                                        <div class="prod-img">
                                                                            <a href="./product.php?id=<?echo $row['glass_id']?>" title="Sandy">
                                                                                <img
                                                                                    width="1024"
                                                                                    height="1024"
                                                                                    src="uploads/<?php echo $img; ?>"
                                                                                    class="wp-post-image"
                                                                                    alt=""
                                                                                    loading="lazy"
                                                                                    itemprop="image"
                                                                                />
                                                                            </a>
                                                                        </div>

                                                                        <h3 class="prod-title"><a href="./product.php?id=<?echo $row['glass_id']?>" title="Sandy"><?echo $row['title']?></a></h3>
                                                                        <span class="prod-price">
                                                                            <p class="price">
                                                                                <span class="woocommerce-Price-amount amount">
                                                                                    <bdi><span class="woocommerce-Price-currencySymbol">$</span><?echo $row['price']?></bdi>
                                                                                </span>
                                                                            </p>
                                                                        </span>
                                                                    </div>
                                                                    <?}}?>
                                                                   
                                                                </div>
                                                            </div>

                                                            <div class="fl-clear"></div>
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
                    
                    
                    
                    
                    <div class="fl-row fl-row-fixed-width fl-row-bg-color fl-node-5ebbaf986203b fl-row-custom-height fl-row-align-center listing-banner" data-node="5ebbaf986203b">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                <div class="fl-col-group fl-node-5ebbaf9861e87 fl-col-group-equal-height fl-col-group-align-center" data-node="5ebbaf9861e87">
                                    <div class="fl-col fl-node-5ebbaf9861eca fl-col-small feature-col" data-node="5ebbaf9861eca">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-pp-heading fl-node-5ebbaf9861f8c" data-node="5ebbaf9861f8c">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-heading-content">
                                                        <div class="pp-heading pp-center">
                                                            <h2 class="heading-title">
                                                                <span class="title-text pp-primary-title">30 - Day Money Back</span>
                                                            </h2>
                                                        </div>
                                                        <div class="pp-sub-heading">
                                                            <p>We have a 30-day, no hassle return or exchange policy for our eyewear and accessories.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fl-col fl-node-5ebbaf9861f10 fl-col-small feature-col" data-node="5ebbaf9861f10">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-pp-heading fl-node-5ebbaf9861fc6" data-node="5ebbaf9861fc6">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-heading-content">
                                                        <div class="pp-heading pp-center">
                                                            <h2 class="heading-title">
                                                                <span class="title-text pp-primary-title">Free Shipping</span>
                                                            </h2>
                                                        </div>
                                                        <div class="pp-sub-heading">
                                                            <p>All orders over $99.00 qualify for free shipping, which is one less thing for you to worry about.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fl-col fl-node-5ebbaf9861f51 fl-col-small feature-col" data-node="5ebbaf9861f51">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-pp-heading fl-node-5ebbaf9862000" data-node="5ebbaf9862000">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-heading-content">
                                                        <div class="pp-heading pp-center">
                                                            <h2 class="heading-title">
                                                                <span class="title-text pp-primary-title">Superior Lenses</span>
                                                            </h2>
                                                        </div>
                                                        <div class="pp-sub-heading">
                                                            <p>We know that as an eyeglass wearer you expect nothing but the best in terms of lens quality.</p>
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
                    <div id="fit-mix-top" class="fl-row fl-row-full-width fl-row-bg-color fl-node-5f48e214442b8 hide-fitmix" data-node="5f48e214442b8">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                <div class="fl-col-group fl-node-5f48e21451d88 fl-col-group-custom-width" data-node="5f48e21451d88">
                                    <div class="fl-col fl-node-5f48e21451f0b fl-col-small" data-node="5f48e21451f0b">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-pp-image fl-node-5f48e31543ea5" data-node="5f48e31543ea5">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-photo-container">
                                                        <div class="pp-photo pp-photo-align-left pp-photo-align-responsive-default" itemscope itemtype="http://schema.org/ImageObject">
                                                            <div class="pp-photo-content">
                                                                <div class="pp-photo-content-inner">
                                                                    <img
                                                                        loading="lazy"
                                                                        width="257"
                                                                        height="30"
                                                                        class="pp-photo-img wp-image-19540 size-full"
                                                                        src="images/04-logo-new.png"
                                                                        alt="logo-new"
                                                                        itemprop="image"
                                                                        srcset="https://directvisioneyewear.ca/wp-content/uploads/2020/04/logo-new.png 257w, https://directvisioneyewear.ca/wp-content/uploads/2020/04/logo-new-150x18.png 150w"
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
                                    <div class="fl-col fl-node-5f48e21451f54 fl-col-small" data-node="5f48e21451f54">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-pp-image fl-node-5f48e356a35c0 close-fit-mix" data-node="5f48e356a35c0">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="pp-photo-container">
                                                        <div class="pp-photo pp-photo-align-right pp-photo-align-responsive-default" itemscope itemtype="http://schema.org/ImageObject">
                                                            <div class="pp-photo-content">
                                                                <div class="pp-photo-content-inner">
                                                                    <img loading="lazy" width="21" height="21" class="pp-photo-img wp-image-20642 size-full" src="images/05-cancel.png" alt="cancel" itemprop="image" />
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
                    <div id="fit-mix" class="fl-row fl-row-full-width fl-row-bg-color fl-node-5f48dd0e0b51c hide-fitmix" data-node="5f48dd0e0b51c">
                        <div class="fl-row-content-wrap">
                            <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                <div class="fl-col-group fl-node-5f48dd0e17a16 fl-col-group-custom-width" data-node="5f48dd0e17a16">
                                    <div class="fl-col fl-node-5f48dd0e17b82 fitmix-cam-col" data-node="5f48dd0e17b82">
                                        <div class="fl-col-content fl-node-content">
                                            <div class="fl-module fl-module-html fl-node-5f48dd0e08c5c" data-node="5f48dd0e08c5c">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-html">
                                                        <style>
                                                            #my-fitmix-container {
                                                                width: 100%;
                                                                height: 100%;
                                                            }
                                                            #my-fitmix-container iframe {
                                                                border-radius: 3px 0 0 3px;
                                                            }
                                                            
                                                        </style>

                                                        <div id="my-fitmix-container"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fl-col fl-node-5f4ca97546359 fl-col-small fit-mix-height-col fit-pro-col fitmix-prod-col" data-node="5f4ca97546359">
                                        <div class="fl-col-content fl-node-content">
                                            <div id="fitmix-prod" class="fl-module fl-module-html fl-node-5f4ca97546225 fitmix-prod-grid" data-node="5f4ca97546225">
                                                <div class="fl-module-content fl-node-content">
                                                    <div class="fl-html">
                                                        <!--<div id="vto-popup">-->
                                                        <!--    <h3>Try Products</h3>-->

                                                        <!--</div>-->

                                                        <ul>
                                                            <li>
                                                                <div class="fl-woocommerce-product-alt-colours-image">
                                                                    <a href="<?echo $glassDeets['title']?>" alt="<?echo $glassDeets['title']?>">
                                                                        <div class="alt-wrapper" itemscope="" itemtype="https://schema.org/ImageObject">
                                                                            <div class="fl-photo-content fl-photo-img-jpg">
                                                                                <img
                                                                                    loading="lazy"
                                                                                    class="fl-photo-img size-full"
                                                                                    src="images/direct_vision-EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-BLACK-<?echo $glassDeets['available_sizes']?>-Front.jpg"
                                                                                    alt=""
                                                                                    itemprop="image"
                                                                                    data-no-lazy="1"
                                                                                    height="327"
                                                                                    width="800"
                                                                                    title=""
                                                                                />
                                                                            </div>
                                                                            <div class="product-title">
                                                                                <span class="product-title" style="display: none;"><?echo $glassDeets['title']?></span><span class="color" style="display: inline-block;">Black</span>
                                                                                <span class="product-price">
                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?echo $glassDeets['price']?></bdi>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                            <a href="javascript:void(0);" data-fb-code="566953" class="fb-code">Try</a>
                                                                            <a href="<?echo $glassDeets['title']?>" class="product-link">Frame Only</a>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </li>

                                                            <li class="active">
                                                                <div class="fl-woocommerce-product-alt-colours-image">
                                                                    <a href="<?echo $glassDeets['title']?>-tortoise.html" alt="<?echo $glassDeets['title']?>">
                                                                        <div class="alt-wrapper" itemscope="" itemtype="https://schema.org/ImageObject">
                                                                            <div class="fl-photo-content fl-photo-img-jpg">
                                                                                <img
                                                                                    loading="lazy"
                                                                                    class="fl-photo-img size-full"
                                                                                    src="images/direct_vision-EIGHTTOEIGHTY_<?echo $glassDeets['title']?>-O-TORTOISE-<?echo $glassDeets['available_sizes']?>-Front.jpg"
                                                                                    alt=""
                                                                                    itemprop="image"
                                                                                    data-no-lazy="1"
                                                                                    height="327"
                                                                                    width="800"
                                                                                    title=""
                                                                                />
                                                                            </div>
                                                                            <div class="product-title">
                                                                                <span class="product-title" style="display: none;"><?echo $glassDeets['title']?></span><span class="color" style="display: inline-block;">Tortoise</span>
                                                                                <span class="product-price">
                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?echo $glassDeets['price']?></bdi>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                            <a href="javascript:void(0);" data-fb-code="566954" class="fb-code">Try</a>
                                                                            <a href="<?echo $glassDeets['title']?>-tortoise.html" class="product-link">Frame Only</a>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </li>
                                                        </ul>
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
            <!-- .fl-page-content -->
            <?php include_once('./includes/footer.php'); ?>
        </div>
        <!-- .fl-page -->

<script>
var slideIndex = [1];
var slideId = ["mySlides1"]
showSlides(1, 0);
// showSlides(1, 1);

function plusSlides(n, no) {
  showSlides(slideIndex[no] += n, no);
}

function showSlides(n, no) {
  var i;
  var x = document.getElementsByClassName(slideId[no]);
  if (n > x.length) {slideIndex[no] = 1}    
  if (n < 1) {slideIndex[no] = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex[no]-1].style.display = "block";  
}
</script>



        <?php include_once('./includes/comman/product/footerjs.php'); ?>
        
        
    </body>
</html>
