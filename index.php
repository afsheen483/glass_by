<?php include_once("global.php");
function logout() {
    global $con, $session_userId;
    
    $cart = (json_encode($_SESSION['product_id'], true));
    
    // var_dump($cart);
    $stmt = $con->prepare('update glassBuy_users set cart=? where id=?');
    $stmt->bind_param("ss", $cart, $session_userId);
    if(!$stmt->execute()){echo "err";}
    
    // var_dump($con);
    // $email_query = "update glassBuy_users set cart='$cart' where id='$session_userId' ";
    // echo $email_query;
    // $result      = $con->query($email_query);
        
    session_destroy();
    
    // unset($_SESSION['password']);
    // unset($_SESSION['name']);
    // unset($_SESSION['userId']);
    // unset($_SESSION['email']);
    
    header("location: ./");
            
        
}
if (isset($_GET['logout'])) {
 logout();
 $logged=0;
}


 

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <?php require("./includes/comman/home/head.php");?>
  <style>
      .owl-carousel .owl-item img {
    display: block;
    width: 100%;
    max-height: 300px;
}

.fl-node-5ea95b397adbc > .fl-col-content {
    background-image: url('<?php showGlobal("WhatsApp Image 2021-09-16 at 10.58.10 PM.jpeg", "image")?>');
   
}

.fl-node-5ea95bc623cba > .fl-col-content {
    background-image: url('<?php showGlobal("men-tile-min.jpg", "image")?>');
   
}
.fl-node-5ea969591d883 > .fl-row-content-wrap {
    background-image: url('<?php showGlobal("eyewear-collection-min.jpg", "image")?>');
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
       <article class="fl-post post-2 page type-page status-publish hentry" id="fl-post-2" itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
        <div class="fl-post-content clearfix" itemprop="text">
         <div class="fl-builder-content fl-builder-content-2 fl-builder-content-primary fl-builder-global-templates-locked" data-post-id="2">
          <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5ea94afd142a4" data-node="5ea94afd142a4">
           <div class="fl-row-content-wrap">
            <div class="fl-row-content fl-row-fixed-width fl-node-content">
             <div class="fl-col-group fl-node-5ea94afd15398" data-node="5ea94afd15398">
              <div class="fl-col fl-node-5ea94afd154ac" data-node="5ea94afd154ac">
               <div class="fl-col-content fl-node-content">
                <div class="fl-module fl-module-beaver-builder-module fl-node-5ea94afd14147" data-node="5ea94afd14147">
                 <div class="fl-module-content fl-node-content">
                  <div class="n2-section-smartslider fitvidsignore  n2_clear" role="region" aria-label="Slider">
                   <style>div#n2-ss-2{width:1440px;}div#n2-ss-2 .n2-ss-slider-1{position:relative;}div#n2-ss-2 .n2-ss-slider-background-video-container{position:absolute;left:0;top:0;width:100%;height:100%;overflow:hidden;}div#n2-ss-2 .n2-ss-slider-2{position:relative;overflow:hidden;padding:0px 0px 0px 0px;height:551px;border:0px solid RGBA(62,62,62,1);border-radius:0px;background-clip:padding-box;background-repeat:repeat;background-position:50% 50%;background-size:cover;background-attachment:scroll;z-index:1;}div#n2-ss-2.n2-ss-mobileLandscape .n2-ss-slider-2,div#n2-ss-2.n2-ss-mobilePortrait .n2-ss-slider-2{background-attachment:scroll;}div#n2-ss-2 .n2-ss-slider-3{position:relative;width:100%;height:100%;overflow:hidden;outline:1px solid rgba(0,0,0,0);z-index:10;}div#n2-ss-2 .n2-ss-slide-backgrounds,div#n2-ss-2 .n2-ss-slider-3 > .n-particles-js-canvas-el,div#n2-ss-2 .n2-ss-slider-3 > .n2-ss-divider{position:absolute;left:0;top:0;width:100%;height:100%;}div#n2-ss-2 .n2-ss-slide-backgrounds{z-index:10;}div#n2-ss-2 .n2-ss-slider-3 > .n-particles-js-canvas-el{z-index:12;}div#n2-ss-2 .n2-ss-slide-backgrounds > *{overflow:hidden;}div#n2-ss-2 .n2-ss-slide{position:absolute;top:0;left:0;width:100%;height:100%;z-index:20;display:block;-webkit-backface-visibility:hidden;}div#n2-ss-2 .n2-ss-layers-container{position:relative;width:1440px;height:551px;}div#n2-ss-2 .n2-ss-parallax-clip > .n2-ss-layers-container{position:absolute;right:0;}div#n2-ss-2 .n2-ss-slide{perspective:1500px;}div#n2-ss-2[data-ie] .n2-ss-slide{perspective:none;transform:perspective(1500px);}div#n2-ss-2 .n2-ss-slide-active{z-index:21;}div#n2-ss-2 .n2-ss-button-container,div#n2-ss-2 .n2-ss-button-container a{display:inline-block;}div#n2-ss-2 .n2-ss-button-container.n2-ss-fullwidth,div#n2-ss-2 .n2-ss-button-container.n2-ss-fullwidth a{display:block;}div#n2-ss-2 .n2-ss-button-container.n2-ss-nowrap{white-space:nowrap;}div#n2-ss-2 .n2-ss-button-container a div{display:inline;font-size:inherit;text-decoration:inherit;color:inherit;line-height:inherit;font-family:inherit;font-weight:inherit;}div#n2-ss-2 .n2-ss-button-container a > div{display:inline-flex;align-items:center;vertical-align:top;}div#n2-ss-2 .n2-ss-button-container span{font-size:100%;vertical-align:baseline;}div#n2-ss-2 .n2-ss-button-container a[data-iconplacement="left"] span{margin-right:0.3em;}div#n2-ss-2 .n2-ss-button-container a[data-iconplacement="right"] span{margin-left:0.3em;}div#n2-ss-2 .n2-font-cd36025141ef3de82df272ac0d93bf6a-hover{font-family: 'Public Sans','Arial';color: #000000;font-size:262.5%;text-shadow: none;line-height: 1.3095;font-weight: normal;font-style: normal;text-decoration: none;text-align: left;letter-spacing: 3px;word-spacing: normal;text-transform: uppercase;font-weight: 900;}div#n2-ss-2 .n2-font-482a487b593c92771aedb04d7919a1b8-link a{font-family: 'Public Sans','Arial';color: #4a4a4a;font-size:87.5%;text-shadow: none;line-height: 1.286;font-weight: normal;font-style: normal;text-decoration: none;text-align: center;letter-spacing: 0.7px;word-spacing: normal;text-transform: uppercase;font-weight: 600;}div#n2-ss-2 .n2-font-482a487b593c92771aedb04d7919a1b8-link a:HOVER, div#n2-ss-2 .n2-font-482a487b593c92771aedb04d7919a1b8-link a:ACTIVE, div#n2-ss-2 .n2-font-482a487b593c92771aedb04d7919a1b8-link a:FOCUS{color: #ab8e47;}div#n2-ss-2 .n2-style-4c17c89b4b47cd44effc467b23d4550e-heading{background: RGBA(255,255,255,0);opacity:1;padding:15px 26px 14px 26px ;box-shadow: none;border-width: 1px;border-style: solid;border-color: #4a4a4a; border-color: RGBA(74,74,74,1);border-radius:50px;}div#n2-ss-2 .n2-style-4c17c89b4b47cd44effc467b23d4550e-heading:Hover, div#n2-ss-2 .n2-style-4c17c89b4b47cd44effc467b23d4550e-heading:ACTIVE, div#n2-ss-2 .n2-style-4c17c89b4b47cd44effc467b23d4550e-heading:FOCUS{background: RGBA(0,0,0,0);border-width: 1px;border-style: solid;border-color: #ab8e47; border-color: RGBA(171,142,71,1);}div#n2-ss-2 .n-uc-1a50832f05797-inner{transition:all .3s;transition-property:border,background-image,background-color,border-radius,box-shadow;background:RGBA(255,255,255,0.8);}div#n2-ss-2 .n2-font-06301a52a3fdf2647d361ad35797d4fd-hover{font-family: 'Public Sans','Arial';color: #282828;font-size:100%;text-shadow: none;line-height: 1.3095;font-weight: normal;font-style: normal;text-decoration: none;text-align: center;letter-spacing: 3px;word-spacing: normal;text-transform: uppercase;font-weight: 900;}div#n2-ss-2 .n2-font-68eb0d48076a01dc64cc8144c1124a91-link a{font-family: 'Public Sans','Arial';color: #4a4a4a;font-size:75%;text-shadow: none;line-height: 1.286;font-weight: normal;font-style: normal;text-decoration: none;text-align: center;letter-spacing: 0.7px;word-spacing: normal;text-transform: uppercase;font-weight: 600;}div#n2-ss-2 .n2-font-68eb0d48076a01dc64cc8144c1124a91-link a:HOVER, div#n2-ss-2 .n2-font-68eb0d48076a01dc64cc8144c1124a91-link a:ACTIVE, div#n2-ss-2 .n2-font-68eb0d48076a01dc64cc8144c1124a91-link a:FOCUS{color: #ab8e47;}div#n2-ss-2 .n2-style-123876a1d72b4c5bce0600ea7605ba7f-heading{background: RGBA(255,255,255,0);opacity:1;padding:10px 26px 10px 26px ;box-shadow: none;border-width: 1px;border-style: solid;border-color: #4a4a4a; border-color: RGBA(74,74,74,1);border-radius:50px;}div#n2-ss-2 .n2-style-123876a1d72b4c5bce0600ea7605ba7f-heading:Hover, div#n2-ss-2 .n2-style-123876a1d72b4c5bce0600ea7605ba7f-heading:ACTIVE, div#n2-ss-2 .n2-style-123876a1d72b4c5bce0600ea7605ba7f-heading:FOCUS{background: RGBA(0,0,0,0);border-width: 1px;border-style: solid;border-color: #ab8e47; border-color: RGBA(171,142,71,1);}</style>
                   <div id="n2-ss-2-align" class="n2-ss-align">
                    <div class="n2-padding">
                     <div id="n2-ss-2" data-creator="Smart Slider 3" class="n2-ss-slider n2-ow n2-has-hover n2notransition  n2-ss-load-fade " style="font-size: 1rem;" data-fontsize="16">
                      <div class="n2-ss-slider-1 n2_ss__touch_element n2-ow" style="">
                       <div class="n2-ss-slider-2 n2-ow" style="">
                        <div class="n2-ss-slider-3 n2-ow" style="">
                         <div class="n2-ss-slide-backgrounds"></div>
                         <div data-first="1" data-slide-duration="0" data-id="4" style="" class=" n2-ss-slide n2-ss-canvas n2-ow  n2-ss-slide-4">
                          <div class="n2-ss-slide-background n2-ow" data-mode="fill">
                           <div data-hash="ceb05e44262a9100f642529bf06fdd29" data-desktop="<?php showGlobal("slider.jpg", "image")?>" class="n2-ss-slide-background-image" data-blur="0" data-alt="" data-title="" style="background-position: 80% 50%"></div>
                       </div>
<div class="n2-ss-layers-container n2-ow">
    <div class="n2-ss-layer n2-ow" style="padding: 0px 0px 0px 0px;" data-desktopportraitpadding="0|*|0|*|0|*|0" data-sstype="slide" data-csstextalign="center" data-pm="default">
        <div
            class="n2-ss-layer n2-ow n-uc-18fe1611bdd71"
            style="overflow: visible;"
            data-csstextalign="inherit"
            data-has-maxwidth="0"
            data-desktopportraitmaxwidth="0"
            data-cssselfalign="inherit"
            data-desktopportraitselfalign="inherit"
            data-pm="default"
            data-desktopportraitverticalalign="center"
            data-desktopportraitpadding="0|*|0|*|0|*|0|*|px+"
            data-tabletportraitpadding="0|*|10|*|0|*|10|*|px+"
            data-mobileportraitpadding="340|*|0|*|0|*|0|*|px+"
            data-desktopportraitinneralign="inherit"
            data-sstype="content"
            data-hasbackground="0"
            data-rotation="0"
            data-desktopportrait="1"
            data-desktoplandscape="1"
            data-tabletportrait="1"
            data-tabletlandscape="1"
            data-mobileportrait="1"
            data-mobilelandscape="1"
            data-adaptivefont="1"
            data-desktopportraitfontsize="100"
            data-plugin="rendered"
        >
            <div class="n2-ss-section-main-content n2-ss-layer-content n2-ow n-uc-18fe1611bdd71-inner" style="padding: 0em 0em 0em 0em;" data-verticalalign="center">
                <div
                    class="n2-ss-layer n2-ow n-uc-198bcfecde4fd"
                    style="margin: 0em 0em 0em 0em; max-width: 1072px; overflow: visible;"
                    data-frontend-fullwidth="1"
                    data-pm="normal"
                    data-desktopportraitmargin="0|*|0|*|0|*|0|*|px+"
                    data-desktopportraitheight="0"
                    data-has-maxwidth="1"
                    data-desktopportraitmaxwidth="1072"
                    data-cssselfalign="inherit"
                    data-desktopportraitselfalign="inherit"
                    data-csstextalign="inherit"
                    data-desktopportraitpadding="0|*|0|*|0|*|0|*|px+"
                    data-desktopportraitgutter="0"
                    data-desktopportraitwrapafter="0"
                    data-mobileportraitwrapafter="1"
                    data-mobilelandscapewrapafter="1"
                    data-desktopportraitinneralign="inherit"
                    data-sstype="row"
                    data-rotation="0"
                    data-desktopportrait="1"
                    data-desktoplandscape="1"
                    data-tabletportrait="1"
                    data-tabletlandscape="1"
                    data-mobileportrait="0"
                    data-mobilelandscape="1"
                    data-adaptivefont="0"
                    data-desktopportraitfontsize="100"
                    data-plugin="rendered"
                >
                    <div class="n2-ss-layer-row n-uc-198bcfecde4fd-inner" style="padding: 0em 0em 0em 0em;">
                        <div class="n2-ss-layer-row-inner">
                            <div
                                class="n2-ss-layer n2-ow n-uc-12cedf3e9a92d"
                                style="width: 50%; margin-right: 0px; margin-top: 0px; overflow: visible;"
                                data-csstextalign="inherit"
                                data-has-maxwidth="0"
                                data-desktopportraitmaxwidth="0"
                                data-pm="default"
                                data-desktopportraitverticalalign="flex-start"
                                data-desktopportraitpadding="0|*|0|*|0|*|0|*|px+"
                                data-desktopportraitinneralign="inherit"
                                data-desktopportraitorder="0"
                                data-colwidthpercent="50"
                                data-sstype="col"
                                data-rotation="0"
                                data-desktopportrait="1"
                                data-desktoplandscape="1"
                                data-tabletportrait="1"
                                data-tabletlandscape="1"
                                data-mobileportrait="1"
                                data-mobilelandscape="1"
                                data-adaptivefont="0"
                                data-desktopportraitfontsize="100"
                                data-plugin="rendered"
                            >
                                <div class="n2-ss-layer-col n2-ss-layer-content n-uc-12cedf3e9a92d-inner" style="padding: 0em 0em 0em 0em;" data-verticalalign="flex-start">
                                    <div
                                        class="n2-ss-layer n2-ow"
                                        style="margin: 0em 0em 1.5em 0em; overflow: visible;"
                                        data-pm="normal"
                                        data-desktopportraitmargin="0|*|0|*|24|*|0|*|px+"
                                        data-tabletportraitmargin="0|*|0|*|16|*|0|*|px+"
                                        data-desktopportraitheight="0"
                                        data-has-maxwidth="0"
                                        data-desktopportraitmaxwidth="0"
                                        data-cssselfalign="inherit"
                                        data-desktopportraitselfalign="inherit"
                                        data-sstype="layer"
                                        data-rotation="0"
                                        data-desktopportrait="1"
                                        data-desktoplandscape="1"
                                        data-tabletportrait="1"
                                        data-tabletlandscape="1"
                                        data-mobileportrait="1"
                                        data-mobilelandscape="1"
                                        data-adaptivefont="0"
                                        data-desktopportraitfontsize="100"
                                        data-tabletportraitfontsize="70"
                                        data-plugin="rendered"
                                    >
                                        <h1 id="n2-ss-2item1" class="n2-font-cd36025141ef3de82df272ac0d93bf6a-hover n2-ss-item-content n2-ow" style="display: block;"><?php showGlobal("Buying should be easy")?></h1>
                                    </div>
                                    <div
                                        class="n2-ss-layer n2-ow"
                                        style="margin: 0em 0em 0em 0em; overflow: visible;"
                                        data-pm="normal"
                                        data-desktopportraitmargin="0|*|0|*|0|*|0|*|px+"
                                        data-desktopportraitheight="0"
                                        data-has-maxwidth="0"
                                        data-desktopportraitmaxwidth="0"
                                        data-cssselfalign="left"
                                        data-desktopportraitselfalign="left"
                                        data-sstype="layer"
                                        data-rotation="0"
                                        data-desktopportrait="1"
                                        data-desktoplandscape="1"
                                        data-tabletportrait="1"
                                        data-tabletlandscape="1"
                                        data-mobileportrait="1"
                                        data-mobilelandscape="1"
                                        data-adaptivefont="0"
                                        data-desktopportraitfontsize="100"
                                        data-plugin="rendered"
                                    >
                                        <div class="n2-ss-button-container n2-ss-item-content n2-ow n2-font-482a487b593c92771aedb04d7919a1b8-link n2-ss-nowrap">
                                            <a class="n2-style-4c17c89b4b47cd44effc467b23d4550e-heading n2-ow" href="shop.php">
                                                <div>
                                                    <div>See Collection</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="n2-ss-layer n2-ow n-uc-1d2a30ce35f9f"
                                style="width: 50%; margin-right: 0px; margin-top: 0px; overflow: visible;"
                                data-csstextalign="inherit"
                                data-has-maxwidth="0"
                                data-desktopportraitmaxwidth="0"
                                data-pm="default"
                                data-desktopportraitverticalalign="flex-start"
                                data-desktopportraitpadding="0|*|0|*|0|*|0|*|px+"
                                data-desktopportraitinneralign="inherit"
                                data-desktopportraitorder="0"
                                data-colwidthpercent="50"
                                data-sstype="col"
                                data-rotation="0"
                                data-desktopportrait="1"
                                data-desktoplandscape="1"
                                data-tabletportrait="1"
                                data-tabletlandscape="1"
                                data-mobileportrait="1"
                                data-mobilelandscape="1"
                                data-adaptivefont="0"
                                data-desktopportraitfontsize="100"
                                data-plugin="rendered"
                            >
                                <div class="n2-ss-layer-col n2-ss-layer-content n-uc-1d2a30ce35f9f-inner" style="padding: 0em 0em 0em 0em;" data-verticalalign="flex-start"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="n2-ss-layer n2-ow n-uc-1a50832f05797"
                    style="margin: 0em 0em 0em 0em; max-width: 1072px; overflow: visible;"
                    data-frontend-fullwidth="1"
                    data-pm="normal"
                    data-desktopportraitmargin="0|*|0|*|0|*|0|*|px+"
                    data-desktopportraitheight="0"
                    data-has-maxwidth="1"
                    data-desktopportraitmaxwidth="1072"
                    data-cssselfalign="inherit"
                    data-desktopportraitselfalign="inherit"
                    data-csstextalign="inherit"
                    data-desktopportraitpadding="0|*|0|*|0|*|0|*|px+"
                    data-mobileportraitpadding="10|*|10|*|10|*|10|*|px+"
                    data-desktopportraitgutter="0"
                    data-desktopportraitwrapafter="0"
                    data-mobileportraitwrapafter="1"
                    data-mobilelandscapewrapafter="1"
                    data-desktopportraitinneralign="inherit"
                    data-sstype="row"
                    data-rotation="0"
                    data-desktopportrait="0"
                    data-desktoplandscape="1"
                    data-tabletportrait="0"
                    data-tabletlandscape="1"
                    data-mobileportrait="1"
                    data-mobilelandscape="1"
                    data-adaptivefont="0"
                    data-desktopportraitfontsize="100"
                    data-plugin="rendered"
                >
                    <div class="n2-ss-layer-row n-uc-1a50832f05797-inner" style="padding: 0em 0em 0em 0em;">
                        <div class="n2-ss-layer-row-inner">
                            <div
                                class="n2-ss-layer n2-ow n-uc-16ec07849bf5e"
                                style="width: 100%; margin-right: 0px; margin-top: 0px; overflow: visible;"
                                data-csstextalign="inherit"
                                data-has-maxwidth="0"
                                data-desktopportraitmaxwidth="0"
                                data-pm="default"
                                data-desktopportraitverticalalign="flex-start"
                                data-desktopportraitpadding="0|*|0|*|0|*|0|*|px+"
                                data-desktopportraitinneralign="inherit"
                                data-desktopportraitorder="0"
                                data-colwidthpercent="100"
                                data-sstype="col"
                                data-rotation="0"
                                data-desktopportrait="1"
                                data-desktoplandscape="1"
                                data-tabletportrait="1"
                                data-tabletlandscape="1"
                                data-mobileportrait="1"
                                data-mobilelandscape="1"
                                data-adaptivefont="0"
                                data-desktopportraitfontsize="100"
                                data-plugin="rendered"
                            >
                                <div class="n2-ss-layer-col n2-ss-layer-content n-uc-16ec07849bf5e-inner" style="padding: 0em 0em 0em 0em;" data-verticalalign="flex-start">
                                    <div
                                        class="n2-ss-layer n2-ow"
                                        style="margin: 0em 0em 0em 0em; overflow: visible;"
                                        data-pm="normal"
                                        data-desktopportraitmargin="0|*|0|*|0|*|0|*|px+"
                                        data-mobileportraitmargin="0|*|0|*|10|*|0|*|px+"
                                        data-desktopportraitheight="0"
                                        data-has-maxwidth="0"
                                        data-desktopportraitmaxwidth="0"
                                        data-cssselfalign="inherit"
                                        data-desktopportraitselfalign="inherit"
                                        data-sstype="layer"
                                        data-rotation="0"
                                        data-desktopportrait="1"
                                        data-desktoplandscape="1"
                                        data-tabletportrait="1"
                                        data-tabletlandscape="1"
                                        data-mobileportrait="1"
                                        data-mobilelandscape="1"
                                        data-adaptivefont="0"
                                        data-desktopportraitfontsize="100"
                                        data-plugin="rendered"
                                    >
                                        <h1 id="n2-ss-2item3" class="n2-font-06301a52a3fdf2647d361ad35797d4fd-hover n2-ss-item-content n2-ow" style="display: block;">
                                            Buying Quality Glasses <br />
                                            Should be easy
                                        </h1>
                                    </div>
                                    <div
                                        class="n2-ss-layer n2-ow"
                                        style="margin: 0em 0em 0em 0em; overflow: visible;"
                                        data-pm="normal"
                                        data-desktopportraitmargin="0|*|0|*|0|*|0|*|px+"
                                        data-desktopportraitheight="0"
                                        data-has-maxwidth="0"
                                        data-desktopportraitmaxwidth="0"
                                        data-cssselfalign="left"
                                        data-desktopportraitselfalign="left"
                                        data-mobileportraitselfalign="center"
                                        data-sstype="layer"
                                        data-rotation="0"
                                        data-desktopportrait="1"
                                        data-desktoplandscape="1"
                                        data-tabletportrait="1"
                                        data-tabletlandscape="1"
                                        data-mobileportrait="1"
                                        data-mobilelandscape="1"
                                        data-adaptivefont="0"
                                        data-desktopportraitfontsize="100"
                                        data-plugin="rendered"
                                    >
                                        <div class="n2-ss-button-container n2-ss-item-content n2-ow n2-font-68eb0d48076a01dc64cc8144c1124a91-link n2-ss-nowrap">
                                            <a class="n2-style-123876a1d72b4c5bce0600ea7605ba7f-heading n2-ow" href="shop.php">
                                                <div>
                                                    <div>See Collection</div>
                                                </div>
                                            </a>
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
<div id="n2-ss-2-spinner" style="display: none;">
  <div>
   <div class="n2-ss-spinner-simple-white-container">
    <div class="n2-ss-spinner-simple-white"></div>
</div>
</div>
</div>
</div>
</div>
<div class="n2_clear"></div>
<div id="n2-ss-2-placeholder" style="min-height:0px;position: relative;z-index:2;background-color:RGBA(0,0,0,0); background-color:RGBA(255,255,255,0);"><img style="width: 100%; max-width:10000px; display: block;opacity:0;margin:0px;" class="n2-ow" src="images/data:image-svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDQwIiBoZWlnaHQ9IjU1MSIgPjwvc3ZnPg==" alt="Slider"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5ea951e963c1d" data-node="5ea951e963c1d">
   <div class="fl-row-content-wrap">
       
    <div class="fl-row-content fl-row-fixed-width fl-node-content">
                    <img src="./uploads/WhatsApp Image 2021-09-17 at 10.49.11 AM.jpeg" style="width:100%;margin-bottom:20px;">

     <div class="fl-col-group fl-node-5ea951e965686 fl-col-group-equal-height fl-col-group-align-center" data-node="5ea951e965686">
      <div class="fl-col fl-node-5ea951e9657a3 fl-col-small feature-col" data-node="5ea951e9657a3">
       <div class="fl-col-content fl-node-content">
        <div class="fl-module fl-module-pp-heading fl-node-5ea95246b61b8" data-node="5ea95246b61b8">

         <div class="fl-module-content fl-node-content">
          <div class="pp-heading-content">
           <div class="pp-heading  pp-center">
            <h3 class="heading-title">
             <span class="title-text pp-primary-title"><?php showGlobal("30 - Day Money Back")?></span>
         </h3>
     </div>
     <div class="pp-sub-heading">
        <p><?php showGlobal("We have a 30-day, no hassle return or exchange policy for our eyewear and accessories.")?></p>
    </div>
</div>
</div>
</div>
</div>
</div>
<div class="fl-col fl-node-5ea954ceeb23c fl-col-small feature-col" data-node="5ea954ceeb23c">
   <div class="fl-col-content fl-node-content">
    <div class="fl-module fl-module-pp-heading fl-node-5ea954ceeb301" data-node="5ea954ceeb301">
     <div class="fl-module-content fl-node-content">
      <div class="pp-heading-content">
       <div class="pp-heading  pp-center">
        <h3 class="heading-title">
         <span class="title-text pp-primary-title"><?php showGlobal("Free Shipping")?></span>
     </h3>
 </div>
 <div class="pp-sub-heading">
    <p><?php showGlobal("All orders over $99.00 qualify for free shipping, which is one less thing for you to worry about.")?></p>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="fl-col fl-node-5ea9563c20336 fl-col-small feature-col" data-node="5ea9563c20336">
   <div class="fl-col-content fl-node-content">
    <div class="fl-module fl-module-pp-heading fl-node-5ea9563c20411" data-node="5ea9563c20411">
     <div class="fl-module-content fl-node-content">
      <div class="pp-heading-content">
       <div class="pp-heading  pp-center">
        <h3 class="heading-title">
         <span class="title-text pp-primary-title"><?php showGlobal("Superior Lenses")?></span>
     </h3>
 </div>
 <div class="pp-sub-heading">
    <p><?php showGlobal("We know that as an eyeglass wearer you expect nothing but the best in terms of lens quality.")?></p>
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
<div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5ea95b39776f4 optical-cta" data-node="5ea95b39776f4">
   <div class="fl-row-content-wrap">
    <div class="fl-row-content fl-row-fixed-width fl-node-content">
     <div class="fl-col-group fl-node-5ea95b397ac72 fl-col-group-equal-height fl-col-group-align-bottom fl-col-group-custom-width" data-node="5ea95b397ac72">
      <div class="fl-col fl-node-5ea95b397adbc fl-col-small" data-node="5ea95b397adbc">
       <div class="fl-col-content fl-node-content">
        <div class="fl-module fl-module-pp-smart-button fl-node-5ea95e732ea7b" data-node="5ea95e732ea7b">
         <div class="fl-module-content fl-node-content">
          <div class="pp-button-wrap pp-button-width-custom">
           <a href="./shop.php" target="_self" class="pp-button" role="button" aria-label="Shop Now">
               <span class="pp-button-text">Shop Now</span>
           </a>
       </div>
   </div>
</div>
</div>
</div>
<div class="fl-col fl-node-5ea95bc623cba fl-col-small" data-node="5ea95bc623cba">
   <div class="fl-col-content fl-node-content">
    <div class="fl-module fl-module-pp-smart-button fl-node-5ea95be573e37" data-node="5ea95be573e37">
     <div class="fl-module-content fl-node-content">
      <div class="pp-button-wrap pp-button-width-custom">
       <a href="./shop.php" target="_self" class="pp-button" role="button" aria-label="Shop Now">
           <span class="pp-button-text">Shop Now</span>
       </a>
   </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5ea9602e28c29" data-node="5ea9602e28c29">
   <div class="fl-row-content-wrap">
    <div class="fl-row-content fl-row-fixed-width fl-node-content">
     <div class="fl-col-group fl-node-5ea9602e2d4cf" data-node="5ea9602e2d4cf">
      <div class="fl-col fl-node-5ea9602e2d609" data-node="5ea9602e2d609">
       <div class="fl-col-content fl-node-content">
        <div class="fl-module fl-module-pp-heading fl-node-5ea9603b72939" data-node="5ea9603b72939">
         <div class="fl-module-content fl-node-content">
          <div class="pp-heading-content">
           <div class="pp-heading-separator icon_only pp-center">
            <span class="separator-image">
                <img class="heading-icon-image" src="images/04-ico-heading.png" alt="Featured Collection">
            </span>
        </div>
        <div class="pp-heading  pp-center">
            <h3 class="heading-title">
             <span class="title-text pp-primary-title"><?php showGlobal("Featured Collection")?></span>
         </h3>
     </div>
 </div>
</div>
</div>
<div class="fl-module fl-module-pp-heading fl-node-5ea9625758435" data-node="5ea9625758435">
 <div class="fl-module-content fl-node-content">
  <div class="pp-heading-content">
   <div class="pp-heading  pp-center">
    <h2 class="heading-title">
     <span class="title-text pp-primary-title"></span>
 </h2>
</div>
<div class="pp-sub-heading">
    <p><?php showGlobal("Our Brooklyn Heights collection features modern eyewear that looks great on everyone")?></p>
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
<div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5ea9710b3e52d" data-node="5ea9710b3e52d">
   <div class="fl-row-content-wrap">
    <div class="fl-row-content fl-row-fixed-width fl-node-content">
     <div class="fl-col-group fl-node-5ea9710b4cd3f" data-node="5ea9710b4cd3f">
      <div class="fl-col fl-node-5ea9710b4cedf" data-node="5ea9710b4cedf">
       <div class="fl-col-content fl-node-content">
        <div class="fl-module fl-module-pp-content-grid fl-node-5ea9710b3d464 glasses-slider" data-node="5ea9710b3d464">
         <div class="fl-module-content fl-node-content">
          <div class="pp-posts-wrapper">
           <div class="pp-content-posts">
            <div class="pp-content-post-carousel pp-masonry-active clearfix" itemscope="itemscope" itemtype="https://schema.org/Collection">
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
                     <div class="pp-content-post pp-content-carousel-post pp-grid-custom post-<?php echo $id; ?> product type-product status-publish has-post-thumbnail product_cat-collection product_cat-glasses product_cat-men-glasses product_cat-pz-optical-glasses product_cat-women-glasses pa_brand-pz-optical pa_collection-glasses pa_colour-brown-light-brown pa_gender-men pa_gender-women pa_material-plastic pa_primary-colour-brown pa_shape-cat-eye pa_size-54-17-140 pa_supplier-direct-vision pa_virtual-try-on-yes first instock sold-individually taxable shipping-taxable purchasable product-type-variable" itemscope data-id="<?php echo $id; ?>">
               <meta itemscope itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" itemid="https://directvisioneyewear.ca/product/mayflower-brown-light-brown/" content="Mayflower">
               <meta itemprop="datePublished" content="2020-09-01">
               <meta itemprop="dateModified" content="2020-11-08">
               <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                <meta itemprop="name" content="Direct Vision">
            </div>
            <div itemscope itemprop="author" itemtype="https://schema.org/Person">
                <meta itemprop="url" content="https://directvisioneyewear.ca/author/tlustvup/">
                <meta itemprop="name" content="tlustvup">
            </div>
            <div itemscope itemprop="image" itemtype="https://schema.org/ImageObject">
                <meta itemprop="url" content="https://atttpgdeen.cloudimg.io/cdn/n/n/_v1Product_/direct_vision/PZOPTICAL_PZ1492-O-C6-54-17-140-Front.jpg">
                <meta itemprop="width" content="2500">
                <meta itemprop="height" content="1400">
            </div>
            <div itemprop="interactionStatistic" itemscope itemtype="https://schema.org/InteractionCounter">
                <meta itemprop="interactionType" content="https://schema.org/CommentAction">
                <meta itemprop="userInteractionCount" content="0">
            </div>
            <div class="prod-img">
                <a href="./product.php?id=<?php echo $id; ?>" title="Mayflower"><img width="750" height="1400" src="uploads/<?php echo $img; ?>" class=" wp-post-image" alt="" loading="lazy" itemprop="image"></a>
            </div>
            <h3 class="prod-title"><a href="./product.php?id=<?php echo $id; ?>" title="Mayflower"><?php echo $row['title']; ?></a></h3>
            <span class="prod-price">
               <span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $row['price']; ?></bdi></span></span>
           </span>
           <span class="extras"><?php echo $row['additional_info']; ?></span>
       </div>

                   <?php
                  }  //while 
              }
              else{
                // NO DATA FOUND
              }
            ?>

              
       
       
   

</div>
<div class="owl-nav pp-carousel-nav"></div>
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
<div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5ea96381e9937" data-node="5ea96381e9937">
   <div class="fl-row-content-wrap">
    <div class="fl-row-content fl-row-fixed-width fl-node-content">
     <div class="fl-col-group fl-node-5ea96381f1823 fl-col-group-custom-width" data-node="5ea96381f1823">
      <div class="fl-col fl-node-5ea96381f1a7d fl-col-small" data-node="5ea96381f1a7d">
       <div class="fl-col-content fl-node-content">
        <div class="fl-module fl-module-pp-image fl-node-5ea9639d289b8" data-node="5ea9639d289b8">
         <div class="fl-module-content fl-node-content">
          <div class="pp-photo-container">
           <div class="pp-photo pp-photo-align-center pp-photo-align-responsive-default" itemscope itemtype="http://schema.org/ImageObject">
            <div class="pp-photo-content ">
             <div class="pp-photo-content-inner">
              <img loading="lazy" width="418" height="252" class="pp-photo-img wp-image-199 size-full" src="images/04-img-lenses1.jpg" alt="img-lenses1" itemprop="image" srcset="<?php showGlobal("img-lenses1.jpg", "image")?>" sizes="(max-width: 418px) 100vw, 418px">
              <div class="pp-overlay-bg"></div>
          </div>
      </div>
  </div>
</div>
</div>
</div>
<div class="fl-module fl-module-pp-heading fl-node-5ea9643a51d65" data-node="5ea9643a51d65">
 <div class="fl-module-content fl-node-content">
  <div class="pp-heading-content">
   <div class="pp-heading  pp-center">
    <h3 class="heading-title">
     <span class="title-text pp-primary-title"><?php showGlobal("Free Superior Lenses")?></span>
 </h3>
</div>
<div class="pp-sub-heading">
    <p><?php showGlobal("All frames include our specialized lenses with Anti-Reflective and Scratch Resistant coating. We truly believe you will fall in love with the clarity of our lenses.")?></p>
</div>
</div>
</div>
</div>
<div class="fl-module fl-module-pp-smart-button fl-node-5ea965332a69a" data-node="5ea965332a69a">
 <div class="fl-module-content fl-node-content">
  <div class="pp-button-wrap pp-button-width-auto">
   <a href="how-we-do-it.html" target="_self" class="pp-button" role="button" aria-label="Read More">
       <span class="pp-button-text">Read More</span>
   </a>
</div>
</div>
</div>
</div>
</div>
<div class="fl-col fl-node-5ea968008680d fl-col-small" data-node="5ea968008680d">
   <div class="fl-col-content fl-node-content">
    <div class="fl-module fl-module-pp-image fl-node-5ea9680086950" data-node="5ea9680086950">
     <div class="fl-module-content fl-node-content">
      <div class="pp-photo-container">
       <div class="pp-photo pp-photo-align-center pp-photo-align-responsive-default" itemscope itemtype="http://schema.org/ImageObject">
        <div class="pp-photo-content ">
         <div class="pp-photo-content-inner">
          <img loading="lazy" width="417" height="252" class="pp-photo-img wp-image-200 size-full" src="images/04-img-lenses2.jpg" alt="img-lenses2" itemprop="image" srcset="<?php showGlobal("img-lenses2.jpg", "image")?>" sizes="(max-width: 417px) 100vw, 417px">
          <div class="pp-overlay-bg"></div>
      </div>
  </div>
</div>
</div>
</div>
</div>
<div class="fl-module fl-module-pp-heading fl-node-5ea9680086992" data-node="5ea9680086992">
 <div class="fl-module-content fl-node-content">
  <div class="pp-heading-content">
   <div class="pp-heading  pp-center">
    <h3 class="heading-title">
     <span class="title-text pp-primary-title"><?php showGlobal("Light Adaptive Protection")?></span>
 </h3>
</div>
<div class="pp-sub-heading">
    <p><?php showGlobal("Upgrade your lenses to Transitions and you will experience a new level of comfort with your glasses, both indoors and outdoors.")?></p>
</div>
</div>
</div>
</div>
<div class="fl-module fl-module-pp-smart-button fl-node-5ea96800869cd" data-node="5ea96800869cd">
 <div class="fl-module-content fl-node-content">
  <div class="pp-button-wrap pp-button-width-auto">
   <a href="how-we-do-it.html" target="_self" class="pp-button" role="button" aria-label="Read More">
       <span class="pp-button-text">Read More</span>
   </a>
</div>
</div>
</div>
</div>
</div>
<div class="fl-col fl-node-5ea9686c355b2 fl-col-small" data-node="5ea9686c355b2">
   <div class="fl-col-content fl-node-content">
    <div class="fl-module fl-module-pp-image fl-node-5ea9686c356cd" data-node="5ea9686c356cd">
     <div class="fl-module-content fl-node-content">
      <div class="pp-photo-container">
       <div class="pp-photo pp-photo-align-center pp-photo-align-responsive-default" itemscope itemtype="http://schema.org/ImageObject">
        <div class="pp-photo-content ">
         <div class="pp-photo-content-inner">
          <img loading="lazy" width="417" height="252" class="pp-photo-img wp-image-201 size-full" src="images/04-img-lenses3.jpg" alt="img-lenses3" itemprop="image" srcset="<?php showGlobal("img-lenses3.jpg", "image")?>" sizes="(max-width: 417px) 100vw, 417px">
          <div class="pp-overlay-bg"></div>
      </div>
  </div>
</div>
</div>
</div>
</div>
<div class="fl-module fl-module-pp-heading fl-node-5ea9686c3570f" data-node="5ea9686c3570f">
 <div class="fl-module-content fl-node-content">
  <div class="pp-heading-content">
   <div class="pp-heading  pp-center">
    <h3 class="heading-title">
     <span class="title-text pp-primary-title"><?php showGlobal("Prescription Sunglasses")?></span>
 </h3>
</div>
<div class="pp-sub-heading">
    <p><?php showGlobal("Like one of our frames but would rather see yourself rocking it as a pair of shades instead? We offer lens tinting on almost any frame, so you can show off to your friends just how cool your Direct Vision glasses can be.")?></p>
</div>
</div>
</div>
</div>
<div class="fl-module fl-module-pp-smart-button fl-node-5ea9686c3574f" data-node="5ea9686c3574f">
 <div class="fl-module-content fl-node-content">
  <div class="pp-button-wrap pp-button-width-auto">
   <a href="how-we-do-it.html" target="_self" class="pp-button" role="button" aria-label="Read More">
       <span class="pp-button-text">Read More</span>
   </a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="fl-row fl-row-fixed-width fl-row-bg-photo fl-node-5ea969591d883 fl-row-custom-height fl-row-align-center col-banner" data-node="5ea969591d883">
   <div class="fl-row-content-wrap">
    <div class="fl-row-content fl-row-fixed-width fl-node-content">
     <div class="fl-col-group fl-node-5ea969592754c fl-col-group-custom-width" data-node="5ea969592754c">
      <div class="fl-col fl-node-5ea96959276a3 fl-col-small" data-node="5ea96959276a3">
       <div class="fl-col-content fl-node-content"></div>
   </div>
   <div class="fl-col fl-node-5ea96959276e2" data-node="5ea96959276e2">
       <div class="fl-col-content fl-node-content">
        <div class="fl-module fl-module-pp-heading fl-node-5ea96a05ae645" data-node="5ea96a05ae645">
         <div class="fl-module-content fl-node-content">
          <div class="pp-heading-content">
           <div class="pp-heading  pp-right">
            <h2 class="heading-title">
             <span class="title-text pp-primary-title"><?php showGlobal("Exclusive <br> Eyewear Collection")?></span>
         </h2>
     </div>
 </div>
</div>
</div>
<div class="fl-module fl-module-pp-smart-button fl-node-5ea96c748164a" data-node="5ea96c748164a">
 <div class="fl-module-content fl-node-content">
  <div class="pp-button-wrap pp-button-width-custom">
   <a href="shop.php" target="_self" class="pp-button" role="button" aria-label="Shop Collection">
       <span class="pp-button-text">Shop Collection</span>
   </a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5ea96da1b89fe" data-node="5ea96da1b89fe">
   <div class="fl-row-content-wrap">
    <div class="fl-row-content fl-row-fixed-width fl-node-content">
     <div class="fl-col-group fl-node-5ea96da1b8b27" data-node="5ea96da1b8b27">
      <div class="fl-col fl-node-5ea96da1b8b69" data-node="5ea96da1b8b69">
       <div class="fl-col-content fl-node-content">
        <div class="fl-module fl-module-pp-heading fl-node-5ea96da1b8baa" data-node="5ea96da1b8baa">
         <div class="fl-module-content fl-node-content">
          <div class="pp-heading-content">
           <div class="pp-heading-separator icon_only pp-center">
            <span class="separator-image">
                <img class="heading-icon-image" src="images/04-ico-heading.png" alt="Mission Statement">
            </span>
        </div>
        <div class="pp-heading  pp-center">
            <h3 class="heading-title">
             <span class="title-text pp-primary-title">Mission Statement</span>
         </h3>
     </div>
 </div>
</div>
</div>
<div class="fl-module fl-module-pp-heading fl-node-5ea96e110ead4" data-node="5ea96e110ead4">
 <div class="fl-module-content fl-node-content">
  <div class="pp-heading-content">
   <div class="pp-heading  pp-center">
    <h4 class="heading-title">
     <span class="title-text pp-primary-title"><?php showGlobal("Quality Vision Should Never Be Out of Your Price Range")?></span>
 </h4>
</div>
</div>
</div>
</div>
<div class="fl-module fl-module-pp-heading fl-node-5ea96da1b8be4" data-node="5ea96da1b8be4">
 <div class="fl-module-content fl-node-content">
  <div class="pp-heading-content">
   <div class="pp-heading  pp-center">
    <h2 class="heading-title">
     <span class="title-text pp-primary-title"></span>
 </h2>
</div>
<div class="pp-sub-heading">
    <p><?php showGlobal("At Direct Vision, we provide you with great glasses at affordable prices. We pride ourselves on quality frames and lenses <br>that are well-made, fashion-forward and original. We want you to express your unique personality <br>through your eyewear, so you can both see and be seen.")?></p>
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
<?php require("./includes/comman/home/footerjs.php");?>
<!-- WooCommerce JavaScript -->
</body>
</html>