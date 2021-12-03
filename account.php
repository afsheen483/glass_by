<?php include_once("global.php");

if($logged==0){
    ?><script>window.location="./"</script><?php 
}



?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php require("./includes/head.php");?>
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
                                                                                        <p>Hello <strong><?php echo $session_name?></strong> (<a href="./?logout=1">Log out</a>)</p>
            <!--
                                                                                        <p>
                                                                                            From your account dashboard you can view your <a href="./orders/">recent orders</a>, manage your
                                                                                            <a href="./edit-address/">shipping and billing addresses</a>.
                                                                                        </p>
                                                                                    -->
                                                                                    <?php if($session_role=="admin"){?>
                                                                                        <p>Hello Admin! This is your admin portal from where will be able to do alot of things in the upcoming sprints.</p>
                                                                                    <?php }else{?>
                                                                                        <p>Hello Customer! This is your customer panel from where will be able to do alot of things in the upcoming sprints.</p>
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
        <?php require("./includes/footer.php");?>
    </div>
    <!-- .fl-page -->
    <?php require("./includes/footerjs.php");?>

</body>
</html>
