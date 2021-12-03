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

if(isset($_GET['e'])){
    $glassId = $_GET['e'];
    /*get Clients*/
    $getGlasses_sql = "SELECT * FROM `glassBuy_glasses` WHERE `glass_id`='$glassId'";
    $getGlasses = getRow($con,$getGlasses_sql);
    /*end of get Clients*/

    $getGlassPic_sql = "SELECT * FROM `glassBuy_glass_picture` WHERE `glass_id` = '$glassId'";
    $getGlassPictures = getAll($con,$getGlassPic_sql);
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
                                                                    <div class="woocommerce"></div>
                                                                    <?php include('./includes/sidebar.php'); ?>

                                                                                <div class="woocommerce-MyAccount-content">
                                                                                    <div class="woocommerce-notices-wrapper"></div>
                                                                                
                                                                                    <div class="u-column2 col-2" style="display: block;">
                                                                                        <?php if(isset($getGlasses)){ ?>
                                                                                        <h2><strong>Edit</strong> a Glass</h2>
                                                                                        <?php }else{ ?>
                                                                                        <h2><strong>Create</strong> a Glass</h2>
                                                                                        <?php }?>
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
                                                                                
                                                                                        <form method="post" action="./includes/models/glass.php" enctype="multipart/form-data">
                                                                                            <div class="form-wrap">
                                                                                                
                                                                                                <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                                                                                    <label for="type">Collection<span class="required">*</span></label>
                                                                                                    <select class="input-text" name="productCategory" id="type">
                                                                                                        <?php
                                                                                                        $types = ['Glasses','Accessories'];
                                                                                                        foreach($types as $type){
                                                                                                        ?>
                                                                                                        <option
                                                                                                        <?php echo (isset($getGlasses) && ($getGlasses['productCategory'] == $type)) ? 'selected' : '' ?>
                                                                                                        ><?php echo $type; ?></option>
                                                                                                        <?php }?>
                                                                                                    </select>
                                                                                                </p>
                                                                                                <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                                                                                    <label for="type">Related To<span class="required">*</span></label>
                                                                                                    <select class="input-text" name="relatedTo" id="type">
                                                                                                        <option value=""></option>
                                                                                                        <?php
                                                                                                        $simglassses = getAll($con,"SELECT * FROM `glassBuy_glasses` ");
                                                                                                        foreach($simglassses as $type){
                                                                                                        ?>
                                                                                                        <option
                                                                                                        <?php echo (isset($getGlasses) && ($getGlasses['relatedTo'] == $type['glass_id'])) ? 'selected' : '' ?>
                                                                                                        ><?php echo $type['title']; ?></option>
                                                                                                        <?php }?>
                                                                                                    </select>
                                                                                                </p>
                                                                                                
                                                                                                
                                                                                                <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                                                                                    <label for="title">Title <span class="required">*</span></label>
                                                                                                    <input type="text" class="input-text" name="title" id="title" value="<?php echo isset($getGlasses) ? $getGlasses['title'] : '' ?>" >
                                                                                                </p>
                                                                                                
                                                                                                
                                                                                                <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                                                                                    <label for="price">Price <span class="required">*</span></label>
                                                                                                    <input type="text" class="input-text" name="price" id="price" value="<?php echo isset($getGlasses) ? $getGlasses['price'] : '' ?>">
                                                                                                </p>
                                                                                                
                                                                                                <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                                                                                    <label for="title">Ribbon Text</label>
                                                                                                    <input type="text" class="input-text" name="ribboon_text" id="title" value="<?php echo isset($getGlasses) ? $getGlasses['ribboon_text'] : '' ?>" >
                                                                                                </p>
                                                                                                
                                                                                                
                                                                                                <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                                                                                    <label for="price">Ribbon Color </label>
                                                                                                    <input type="color" class="input-text" name="ribboon_color" id="price" value="<?php echo isset($getGlasses) ? $getGlasses['ribboon_color'] : '' ?>">
                                                                                                </p>
                                                                                                
                                                                                                
                                                                                                
                                                                                                <?foreach($glass_atts as $i=>$col){?>
                                                                                                    <p class="woocommerce-form-row woocommerce-form-row--<?if(fmod($i, 2)==0){?>first<?}else{?>last<?}?> form-row form-row-<?if(fmod($i, 2)==0){?>first<?}else{?>last<?}?>">
                                                                                                        <label for="additional_info"><?echo ucfirst($col)?><span class="required">*</span></label>
                                                                                                        <?if(stristr($col, "color") || stristr($col, "colour")){?>
                                                                                                        <select type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="<?echo $col?>" id="available_sizes" value="<?php echo isset($getGlasses) ? $getGlasses[$col] : '' ?>">
                                                                                                            <?foreach($g_colors as $color){?>
                                                                                                            <option <?if($getGlasses[$col]==$color){echo "selected";}?> ><?echo $color?></option>
                                                                                                            <?}?>
                                                                                                        </select>
                                                                                                        <?}else if($col=="shape"){?>
                                                                                                            <select type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="<?echo $col?>" id="available_sizes" value="<?php echo isset($getGlasses) ? $getGlasses[$col] : '' ?>">
                                                                                                            <?
                                                                                                            $temp_table = array("Square", "Round", "Plane" );
                                                                                                            foreach($temp_table as $rt){?>
                                                                                                                <option <?if($getGlasses[$col]==$rt){echo "selected";}?> ><?echo $rt?></option>
                                                                                                            <?}?>
                                                                                                            </select>
                                                                                                            
                                                                                                        <?}else if($col=="material"){?>
                                                                                                            <select type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="<?echo $col?>" id="available_sizes" value="<?php echo isset($getGlasses) ? $getGlasses[$col] : '' ?>">
                                                                                                            <?
                                                                                                            $temp_table = array("Metal", "Plastic", "Fiber" );
                                                                                                            foreach($temp_table as $rt){?>
                                                                                                                <option <?if($getGlasses[$col]==$rt){echo "selected";}?> ><?echo $rt?></option>
                                                                                                            <?}?>
                                                                                                            </select>
                                                                                                            
                                                                                                        <?}else if($col=="gender"){?>
                                                                                                            <select type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="<?echo $col?>" id="available_sizes" value="<?php echo isset($getGlasses) ? $getGlasses[$col] : '' ?>">
                                                                                                            <?
                                                                                                            $temp_table = array("men", "women", "unisex" );
                                                                                                            foreach($temp_table as $rt){?>
                                                                                                                <option <?if($getGlasses[$col]==$rt){echo "selected";}?> ><?echo $rt?></option>
                                                                                                            <?}?>
                                                                                                            </select>
                                                                                                            
                                                                                                        <?}else{?>
                                                                                                        
                                                                                                        
                                                                                                          <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="<?echo $col?>" id="available_sizes" value="<?php echo isset($getGlasses) ? $getGlasses[$col] : '' ?>">
                                                                                                            <?if(stristr($col, "gender") ){?>
                                                                                                                <label>men/women/unisex</label>
                                                                                                            <?}?>
                                                                                                            <?if(stristr($col, "type") ){?>
                                                                                                            <label>glasses/sunglasses</label>
                                                                                                            <?}?>
                                                                                                        <?}?>
                                                                                                    </p>
                                                                                                    <?
                                                                                                    if(fmod($i, 2)!=0){?>
                                                                                                    <div class="clear"></div>
                                                                                                    <?}?>
                                                                                                <?}?>
                                                                                                
                                                                                                <div class="clear"></div>
                                                                                
                                                                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                                                                    <label for="reg_email">Available Size&nbsp;<span class="required">*</span></label>
                                                                                                    <input type="available_sizes" class="woocommerce-Input woocommerce-Input--text input-text" name="available_sizes" id="available_sizes" value="<?php echo isset($getGlasses) ? $getGlasses['available_sizes'] : '' ?>">
                                                                                                </p>
                                                                                
                                                                                                
                                                                                
                                                                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                                                                    <label for="pictures">Products Pictures&nbsp;<span class="required">*</span></label>
                                                                                                    <input type="file" class="input-text" name="pictures[]" id="pictures" multiple accept=".png,.jpg,.jpeg">
                                                                                                </p>
                                                                                            </div>
                                                                                
                                                                                            Pictures:
                                                                                            <?php foreach($getGlassPictures as $pi => $pic){ 
                                                                                                $picId = $pic['glass_picture_id'];
                                                                                                ?>
                                                                                                <br>
                                                                                                <a href="./uploads/<?php echo $pic['name']; ?>" target="_blank">
                                                                                                    <img src="./uploads/<?php echo $pic['name']; ?>" width="60px" height="auto" style="margin-bottom: 10px;">
                                                                                                </a>
                                                                                                <a href="./includes/models/glass.php?_picture=<?php echo $glassId; ?>&_d=<?php echo $picId ?>">Remove Picture</a>
                                                                                            <?php }?>
                                                                                
                                                                                            <p class="woocommerce-FormRow form-row form-button">
                                                                                                <?php if(isset($getGlasses)){ ?>
                                                                                                    <input type="hidden" name="glass_id" value="<?php echo $glassId; ?>">
                                                                                                    <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="EDIT_GLASSES" value="true">
                                                                                                        Edit Product
                                                                                                    </button>
                                                                                                <?php }else{ ?>
                                                                                                    <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="CREATE_GLASS" value="true">
                                                                                                        Create Product
                                                                                                    </button>
                                                                                                <?php }?>
                                                                                                
                                                                                            </p>
                                                                                
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

</body>
</html>
