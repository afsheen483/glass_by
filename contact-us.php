<?php 
include_once("global.php");

if(isset($_POST['message'])){
  $id = generateRandomString();
  $userId= $session_userId;
  $firstname = mb_htmlentities(($_POST['firstname']));
  $lastname = mb_htmlentities(($_POST['lastname']));
  $email = mb_htmlentities(($_POST['email']));
  $phone = mb_htmlentities(($_POST['phone']));
  $message = mb_htmlentities(($_POST['message']));
  
  $m = "Name: $firstname $lastname <Br>
Email: $email<br> 
Phone: $phone<br> 
Message: $message<br> 

  ";
  sendEmailNotification("New Message", $m, "snahmed1998@gmail.com");
  header("Location: ?email-sent=1");

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
                                                                                            <h2><strong>
Need Help?
</strong></h2>
<p>

We are here to answer your questions and help you choose the perfect frames.<br> Fill out the form below and our team will get in touch with you shortly
</p>

<form method="post" class="woocommerce-form woocommerce-form-register register" novalidate>
                                                                                                <div class="form-wrap">
                                                                                                    <input name="signup" hidden value="signup">
                                                                                                    <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                                                                                        <label for="first_name">First name <span class="required">*</span></label>
                                                                                                        <input type="text" class="input-text" name="first_name" id="first_name" value="" />
                                                                                                    </p>
                                                                                                    <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                                                                                        <label for="last_name">Last name <span class="required">*</span></label>
                                                                                                        <input type="text" class="input-text" name="last_name" id="last_name" value="" />
                                                                                                    </p>
                                                                                                    <div class="clear"></div>

                                                                                                   
                                                                                                    <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                                                                                        <label for="first_name">Email address <span class="required">*</span></label>
                                                                                                        <input type="email" class="input-text" name="email" id="email" value="" />
                                                                                                        <input type="password" class="input-text" name="password" id="password" value="password" hidden style="display:none;" />
                                                                                                    </p>
                                                                                                    <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                                                                                        <label for="last_name">Phone <span class="required">*</span></label>
                                                                                                        <input type="text" class="input-text" name="phone" id="last_name" value="" />
                                                                                                    </p>
                                                                                                    <div class="clear"></div>


                                                                                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                                                                        <label for="reg_password">Message&nbsp;<span class="required">*</span></label>
                                                                                                        <textarea
                                                                                                            style="height:200px !important;"
                                                                                                            type="text"
                                                                                                            class="woocommerce-Input woocommerce-Input--text input-text"
                                                                                                            name="message"
                                                                                                            id="reg_password"
                                                                                                            autocomplete="new-password"
                                                                                                        ></textarea>
                                                                                                    </p>
                                                                                                </div>
                                                                                                <p class="woocommerce-FormRow form-row form-button">
                                                                                                    <input type="hidden" id="woocommerce-register-nonce" name="woocommerce-register-nonce" value="0a48504050" />
                                                                                                    <input type="hidden" name="_wp_http_referer" value="/my-account/" />
                                                                                                    <button
                                                                                                        type="submit"
                                                                                                        class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit"
                                                                                                        name="register"
                                                                                                        value="Create Account"
                                                                                                    >
                                                                                                        Submit
                                                                                                    </button>
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
        <?php require("./includes/footerjs.php");?>
         

    </body>
</html>
