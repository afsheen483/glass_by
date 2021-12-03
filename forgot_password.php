<?php 
include_once("global.php");


if(isset($_POST['email'])){
    $email = $_POST['email'];
    
    $token = generateRandomString();
    $sql="update glassBuy_users set passwordResetId='$token' where email='$email'";
    if(!mysqli_query($con,$sql))
    {
        echo "err";
    }
    
    $passwordLink  = "$g_project_url/password_reset.php?token=".$token;
    
    $email_body = "Reset your password here: $passwordLink";
    sendEmailNotification("Direct Vision - Forget Password", $email_body, $email);
    
   
    //send email
    ?>
        <script type="text/javascript">
            window.location = "?email-sent=1";
        </script>
    <?
            
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
                                                                <div class="fl-module fl-module-rich-text fl-node-5ec37624db6e7" data-node="5ec37624db6e7">
                                                                    <div class="fl-module-content fl-node-content">
                                                                        <div class="fl-rich-text">
                                                                            <div>
                                                                                <div class="woocommerce">
                                                                                    <div class="woocommerce-notices-wrapper"></div>

                                                                                    <div class="u-columns col2-set" id="customer_login">
                                                                                        <div class="u-column1 col-1">
                                                                                            <h2><strong>Reset Password</strong></h2>
                                                                                            

                                                                                             <?if(isset($_GET['email-sent'])){?>
                                                                                             <div class="woocommerce-message" role="alert">
                                                                    		<p>Email Sent. Kindly check your spam box as well.</p>
                                                                    		</div>
                                                                                                
                                                                                                <?}?>
                    
                                                                        
                                                                        

                                                                                            <form class="woocommerce-form woocommerce-form-login login" method="post" novalidate>
                                                                                                <div class="form-wrap">
                                                                                                    <input name="login" hidden value="signup">
                                                                                                    <input name="username" hidden value="signup">
                                                                                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                                                                        <label for="username">Email Address&nbsp;<span class="required">*</span></label>
                                                                                                        <input
                                                                                                            type="email"
                                                                                                            class="woocommerce-Input woocommerce-Input--text input-text"
                                                                                                            name="email"
                                                                                                            id="username"
                                                                                                            autocomplete="username"
                                                                                                            value=""
                                                                                                        />
                                                                                                    </p>
                                                                                                   
                                                                                                    <p class="woocommerce-LostPassword lost_password">
                                                                                                        <!--<a href="lost-password.php">Forgot password?</a>-->
                                                                                                    </p>
                                                                                                </div>
                                                                                                
                                                                                                <p class="form-row form-button">
                                                                                                   <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="Send Email">Send Email</button>
                                                                                                   
                                                                                                
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
        <?php // require("./includes/footerjs.php");?>
         
     
<script src="https://apis.google.com/js/api:client.js"></script>
  
        
    </body>
</html>
