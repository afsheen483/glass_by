<header
class="fl-builder-content fl-builder-content-19 fl-builder-global-templates-locked"
data-post-id="19"
data-type="header"
data-sticky="0"
data-sticky-breakpoint="medium"
data-shrink="0"
data-overlay="0"
data-overlay-bg="transparent"
data-shrink-image-height="50px"
itemscope="itemscope"
itemtype="http://schema.org/WPHeader"
>
<style>
	li {
 display: block;
 transition-duration: 0.5s;
}

li:hover {
  cursor: pointer;
}

ul li ul {
  visibility: hidden;
  opacity: 0;
  position: absolute;
  transition: all 0.5s ease;
  margin-top: 1rem;
  left: 0;
  display: none;
}

ul li:hover > ul,
ul li ul:hover {

  visibility: visible;
  opacity: 1;
  display: block;
}

ul li ul li {
  clear: both;
  width: 100%;
}
</style>


 <?php 
                                                 $query = "SELECT    *
                                                 FROM      glassbuy_coupons
                                                 WHERE `status` = 'Active'
                                                 ";
                                                 $fire = mysqli_query($con,$query);
                                                 $row = mysqli_fetch_assoc($fire);
                                                 ?>
<div class="fl-row fl-row-full-width fl-row-bg-color fl-node-5ea7ee5eeffd0 fl-visible-desktop-medium" data-node="5ea7ee5eeffd0">
    <div class="fl-row-content-wrap">
        <div class="fl-row-content fl-row-fixed-width fl-node-content">
            <div class="fl-col-group fl-node-5ea7ee5ef1018 fl-col-group-equal-height fl-col-group-align-center" data-node="5ea7ee5ef1018">
                <div class="fl-col fl-node-5ea7ee5ef113a" data-node="5ea7ee5ef113a">
                    <div class="fl-col-content fl-node-content">
                        <div class="fl-module fl-module-pp-heading fl-node-5ea7eed5ea61b" data-node="5ea7eed5ea61b">
                            <div class="fl-module-content fl-node-content">
                                <div class="pp-heading-content">
                                    <div class="pp-heading pp-left">
                                        <h2 class="heading-title">
                                            <span class="title-text pp-primary-title"></span>
                                        </h2>
                                    </div>
                                    <div class="pp-sub-heading">
                                        <p><?php 
                                        showGlobal($row['description'])
                                        ?>
                                        <!-- <a style="color: <?php echo $row['color']; ?>;" href="<?php echo $row['link'] ?>"><span style="font-weight: 400;"><?php showGlobal($row['text'])?></span></a> -->
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fl-col fl-node-5ea7ee5ef117e fl-col-small" data-node="5ea7ee5ef117e">
                    <div class="fl-col-content fl-node-content">
                        <div class="fl-module fl-module-pp-heading fl-node-5ea7f17a61b96" data-node="5ea7f17a61b96">
                            <div class="fl-module-content fl-node-content">
                                <div class="pp-heading-content">
                                    <div class="pp-heading pp-right">
                                        <h2 class="heading-title">
                                            <span class="title-text pp-primary-title"></span>
                                        </h2>
                                    </div>
                                    <div class="pp-sub-heading">
                                       
                                        <p>
                                       
                                                    <a style="color: <?php echo $row['color']; ?>;" href="<?php echo $row['link'] ?>"><span style="font-weight: 400;"><?php echo $row['text']?></span></a>
                                                
                                          
                                            <a style="color: #e1e1e1;margin-left:10px" href="contact-us.php">Need Help? <span style="font-weight: 400;">Contact us here</span></a>
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
<div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5ea7f3dbe5b14 fl-visible-desktop-medium" data-node="5ea7f3dbe5b14">
    <div class="fl-row-content-wrap">
        <div class="fl-row-content fl-row-fixed-width fl-node-content">
            <div class="fl-col-group fl-node-5ea7f3dbe7d73 fl-col-group-custom-width" data-node="5ea7f3dbe7d73">
                <div class="fl-col fl-node-5ea7f3dbe7e80 fl-col-small" data-node="5ea7f3dbe7e80">
                    <div class="fl-col-content fl-node-content">
                        <div class="fl-module fl-module-widget fl-node-5ea7f465b460b" data-node="5ea7f465b460b">
                            <div class="fl-module-content fl-node-content">
                                <div class="fl-widget">
                                    <div class="widget woocommerce widget_product_search">
                                        <form role="search" method="get" class="woocommerce-product-search" action="./shop.php">
                                            <label class="screen-reader-text" for="woocommerce-product-search-field-0">Search for:</label>
                                            <input type="search" id="woocommerce-product-search-field-0" class="search-field" placeholder="SEARCH" value="" name="s" />
                                            <button type="submit" value="Search">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fl-col fl-node-5ea7f3dbe7ebf fl-col-small" data-node="5ea7f3dbe7ebf">
                    <div class="fl-col-content fl-node-content">
                        <div class="fl-module fl-module-pp-image fl-node-5ea7f4055b2c8" data-node="5ea7f4055b2c8">
                            <div class="fl-module-content fl-node-content">
                                <div class="pp-photo-container">
                                    <div class="pp-photo pp-photo-align-center pp-photo-align-responsive-default" itemscope itemtype="http://schema.org/ImageObject">
                                        <div class="pp-photo-content">
                                            <div class="pp-photo-content-inner">
                                                <a href="./"  itemprop="url">
                                                    <img
                                                        loading="lazy"
                                                        width="514"
                                                        height="59"
                                                        class="pp-photo-img wp-image-21516 size-full"
                                                        src="images/04-logo-1.png"
                                                        alt="logo"
                                                        itemprop="image"
                                                        srcset="
                                                            https://directvisioneyewear.ca/wp-content/uploads/2020/04/logo-1.png        514w,
                                                            https://directvisioneyewear.ca/wp-content/uploads/2020/04/logo-1-300x34.png 300w,
                                                            https://directvisioneyewear.ca/wp-content/uploads/2020/04/logo-1-150x17.png 150w
                                                        "
                                                        sizes="(max-width: 514px) 100vw, 514px"
                                                    />
                                                    <div class="pp-overlay-bg"></div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="fl-col fl-node-5ea7f3dbe7efd fl-col-small text-right" data-node="5ea7f3dbe7efd">
                    <div class="fl-col-content fl-node-content">
                        <div class="fl-module fl-module-pp-smart-button fl-node-5ebceead842f8 inline-items" data-node="5ebceead842f8">
                            <div class="fl-module-content fl-node-content">
                                <div class="pp-button-wrap pp-button-width-auto">
                                    
                                    <?php if($logged==0){?>
                                        <a type="button"  data-toggle="modal" data-target="#myModal"  class="pp-button" role="button" aria-label="Login">
                                            <span class="pp-button-text">Signin</span>
                                        </a>
                                    <?php }else{?>
                                        <a href="./account.php"  class="pp-button" role="button" aria-label="Account">
                                            <span class="pp-button-text">Account</span>
                                        </a>
                                        <a href="./?logout=1"  class="pp-button" role="button" aria-label="Account">
                                            <span class="pp-button-text">Logout</span>
                                        </a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <div class="fl-module fl-module-rich-text fl-node-5ea80935ab5f3 inline-items" data-node="5ea80935ab5f3">
                            <div class="fl-module-content fl-node-content">
                                <div class="fl-rich-text">
                                    <div class="cart-link">
                                        <a href="cart.php">Cart</a>
                                        <div class="fl-cart-count">
                                            <a class="js-cart" href="./cart.php" title="View your shopping cart">
                                                <i class=""></i>
                                                <span class="cart-menu-items">
                                                    
                                                    <?php
                                                    echo count($_SESSION['product_id']);
                                                    // unset($_SESSION['product_id']);
                                                    // session_destroy();
                                                    ?>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fl-module fl-module-rich-text fl-node-5ea80935ab5f3 inline-items" data-node="5ea80935ab5f3">
                            <div class="fl-module-content fl-node-content">
                                <div class="fl-rich-text">
                                    <div class="cart-link">
                                        <a href="./customer_favourite.php">Favourite</a><i class="fa fa-heart" style="margin-left: 8px;color:red"></i>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="fl-module fl-module-rich-text fl-node-5ea80935ab5f3 inline-items" data-node="5ea80935ab5f3">
                            <div class="fl-module-content fl-node-content">
                                <div class="fl-rich-text">
                                    <div class="cart-link">
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom dropdown">
<a href="./account_settings.php"></a>
<a href="#">Account Settings</a>
      <ul class="dropdown">
	  <li><a href="./personal_info.php" >Personal Info</a></li>
    <li><a href="./change_password.php">Password Change</a></li>
    <li><a href="./address_management.php">Address Management</a></li>
      </ul>
  
    </li>                                        
                                    </div>
                                </div>
                            </div>
                        </div> -->
          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5ea803ddf02f0 fl-visible-desktop-medium" data-node="5ea803ddf02f0">
    <div class="fl-row-content-wrap">
        <div class="fl-row-content fl-row-fixed-width fl-node-content">
            <div class="fl-col-group fl-node-5ea803ddf35cf" data-node="5ea803ddf35cf">
                <div class="fl-col fl-node-5ea803ddf36f3" data-node="5ea803ddf36f3">
                    <div class="fl-col-content fl-node-content">
                        <div class="fl-module fl-module-pp-advanced-menu fl-node-5ea80427c2c7f" data-node="5ea80427c2c7f">
                            <div class="fl-module-content fl-node-content">
                                <div class="pp-advanced-menu pp-advanced-menu-accordion-collapse pp-menu-default">
                                    <div class="pp-advanced-menu-mobile-toggle hamburger">
                                        <div class="pp-hamburger">
                                            <div class="pp-hamburger-box"><div class="pp-hamburger-inner"></div></div>
                                        </div>
                                    </div>
                                    <div class="pp-clear"></div>

                                    <ul id="menu-main-menu" class="menu pp-advanced-menu-horizontal pp-toggle-arrows">
                                        <li id="menu-item-38" class="menu-item menu-item-type-custom menu-item-object-custom">
                                            <a href="./shop.php?_collection=glasses" tabindex="0" role="link"><span class="menu-item-text">EYEGLASSES</span></a>
                                        </li>
                                        <li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom">
                                            <a href="./shop.php?_collection=sunglasses.php" tabindex="0" role="link"><span class="menu-item-text">Sunglasses</span></a>
                                        </li>
                                        <li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom">
                                            <a href="./shop.php?_collection=Accessories" tabindex="0" role="link"><span class="menu-item-text">Accessories</span></a>
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
<div class="fl-row fl-row-full-width fl-row-bg-color fl-node-5ea922351f8e8 fl-visible-mobile" data-node="5ea922351f8e8">
    <div class="fl-row-content-wrap">
        <div class="fl-row-content fl-row-fixed-width fl-node-content">
            <div class="fl-col-group fl-node-5ea922351fa53 fl-col-group-equal-height fl-col-group-align-center" data-node="5ea922351fa53">
                <div class="fl-col fl-node-5ea922351fa97" data-node="5ea922351fa97">
                    <div class="fl-col-content fl-node-content">
                        <div class="fl-module fl-module-pp-heading fl-node-5ea922351fad8" data-node="5ea922351fad8">
                            <div class="fl-module-content fl-node-content">
                                <div class="pp-heading-content">
                                    <div class="pp-heading pp-center">
                                        <h2 class="heading-title">
                                            <span class="title-text pp-primary-title"></span>
                                        </h2>
                                    </div>
                                    <div class="pp-sub-heading">
                                        <p>Free Shipping &amp; Returns +&nbsp;30 Day Money-back Guarantee</p>
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
<div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5ea922dd47a47 fl-visible-mobile" data-node="5ea922dd47a47">
    <div class="fl-row-content-wrap">
        <div class="fl-row-content fl-row-fixed-width fl-node-content">
            <div class="fl-col-group fl-node-5ea922dd4eeb4 fl-col-group-custom-width" data-node="5ea922dd4eeb4">
                <div class="fl-col fl-node-5ea922dd4eff7" data-node="5ea922dd4eff7">
                    <div class="fl-col-content fl-node-content">
                        <div class="fl-module fl-module-widget fl-node-5ea923474915c" data-node="5ea923474915c">
                            <div class="fl-module-content fl-node-content">
                                <div class="fl-widget">
                                    <div class="widget woocommerce widget_product_search">
                                        <form role="search" method="get" class="woocommerce-product-search" action="./">
                                            <label class="screen-reader-text" for="woocommerce-product-search-field-1">Search for:</label>
                                            <input type="search" id="woocommerce-product-search-field-1" class="search-field" placeholder="SEARCH" value="" name="s" />
                                            <button type="submit" value="Search">Search</button>
                                            <input type="hidden" name="post_type" value="product" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fl-col fl-node-5ea922dd4f03c fl-col-small text-right" data-node="5ea922dd4f03c">
                    <div class="fl-col-content fl-node-content">
                        <div class="fl-module fl-module-icon fl-node-5ea92b61a65a5 inline-items" data-node="5ea92b61a65a5">
                            <div class="fl-module-content fl-node-content">
                                <div class="fl-icon-wrap">
                                    <span class="fl-icon">
                                        <a href="./signin.php" >
                                            <i class="fas fa-user" aria-hidden="true"></i>
                                        </a>
                                    </span>
                                    <div id="fl-icon-text-5ea92b61a65a5" class="fl-icon-text fl-icon-text-empty">
                                        <a href="./signin.php"  class="fl-icon-text-link fl-icon-text-wrap"> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fl-module fl-module-rich-text fl-node-5ea923dd83a4e inline-items" data-node="5ea923dd83a4e">
                            <div class="fl-module-content fl-node-content">
                                <div class="fl-rich-text">
                                    <div class="cart-link">
                                        <a href="cart.php"><i class="fas fa-shopping-basket"></i></a>
                                        <div class="fl-cart-count">
                                            <a class="js-cart" href="cart.php" title="View your shopping cart">
                                                <i class=""></i>
                                                <span class="cart-menu-items">0</span>
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
<div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5ea92ec952d54 fl-visible-mobile" data-node="5ea92ec952d54">
    <div class="fl-row-content-wrap">
        <div class="fl-row-content fl-row-fixed-width fl-node-content">
            <div class="fl-col-group fl-node-5ea92ec95b7fc fl-col-group-equal-height fl-col-group-align-center fl-col-group-custom-width" data-node="5ea92ec95b7fc">
                <div class="fl-col fl-node-5ea92ec95b95e fl-col-small" data-node="5ea92ec95b95e">
                    <div class="fl-col-content fl-node-content">
                        <div class="fl-module fl-module-pp-advanced-menu fl-node-5ea92ef26c357" data-node="5ea92ef26c357">
                            <div class="fl-module-content fl-node-content">
                                <div class="pp-advanced-menu pp-advanced-menu-accordion-collapse pp-menu-default">
                                    <div class="pp-clear"></div>

                                    <ul id="menu-main-menu-1" class="menu pp-advanced-menu-horizontal pp-toggle-arrows">
                                        <li id="menu-item-38" class="menu-item menu-item-type-custom menu-item-object-custom">
                                            <a href="./about-us.php" tabindex="0" role="link"><span class="menu-item-text">About us</span></a>
                                        </li>
                                        <li id="menu-item-38" class="menu-item menu-item-type-custom menu-item-object-custom">
                                            <a href="./?_collection=glasses.php" tabindex="0" role="link"><span class="menu-item-text">EYEGLASSES</span></a>
                                        </li>
                                        <li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom">
                                            <a href="./?_collection=sunglasses.php" tabindex="0" role="link"><span class="menu-item-text">Sunglasses</span></a>
                                        </li>
                                       
                                    </ul>
                                </div>
                                <div class="pp-advanced-menu-mobile-toggle hamburger">
                                    <div class="pp-hamburger">
                                        <div class="pp-hamburger-box"><div class="pp-hamburger-inner"></div></div>
                                    </div>
                                </div>
                                <div class="pp-advanced-menu pp-advanced-menu-accordion-collapse off-canvas">
                                    <div class="pp-clear"></div>
                                    <div class="pp-off-canvas-menu pp-menu-left">
                                        <div class="pp-menu-close-btn">&times;</div>

                                        <ul id="menu-main-menu-2" class="menu pp-advanced-menu-horizontal pp-toggle-arrows">
                                            <li id="menu-item-38" class="menu-item menu-item-type-custom menu-item-object-custom">
                                                <a href="./about-us.php" tabindex="0" role="link"><span class="menu-item-text">About us</span></a>
                                            </li>
                                            <li id="menu-item-38" class="menu-item menu-item-type-custom menu-item-object-custom">
                                                <a href="./?_collection=glasses.php" tabindex="0" role="link"><span class="menu-item-text">EYEGLASSES</span></a>
                                            </li>
                                            <li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom">
                                                <a href="./?_collection=sunglasses.php" tabindex="0" role="link"><span class="menu-item-text">Sunglasses</span></a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fl-col fl-node-5ea92ec95b9a6 fl-col-small" data-node="5ea92ec95b9a6">
                    <div class="fl-col-content fl-node-content">
                        <div class="fl-module fl-module-pp-image fl-node-5ea92ed9d0d82" data-node="5ea92ed9d0d82">
                            <div class="fl-module-content fl-node-content">
                                <div class="pp-photo-container">
                                    <div class="pp-photo pp-photo-align-center pp-photo-align-responsive-center" itemscope itemtype="http://schema.org/ImageObject">
                                        <div class="pp-photo-content">
                                            <div class="pp-photo-content-inner">
                                                <a href="./"  itemprop="url">
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
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fl-col fl-node-5ea92ec95b9ea fl-col-small" data-node="5ea92ec95b9ea">
                    <div class="fl-col-content fl-node-content">
                        <div class="fl-module fl-module-icon fl-node-5ea92f43ac2aa" data-node="5ea92f43ac2aa">
                            <div class="fl-module-content fl-node-content">
                                <div class="fl-icon-wrap">
                                    <span class="fl-icon">
                                        <a href="tel:1-000-000-000" >
                                            <i class="fi-telephone" aria-hidden="true"></i>
                                        </a>
                                    </span>
                                    <div id="fl-icon-text-5ea92f43ac2aa" class="fl-icon-text fl-icon-text-empty">
                                        <a href="tel:1-000-000-000"  class="fl-icon-text-link fl-icon-text-wrap"> </a>
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
</header>
<?php 
include_once("global.php");

if (isset($_POST['usernumber'])) {

    $allow        = 1;
    $new_username = $_POST['username'];
    $new_email    = $_POST["email"];
    $new_password = $_POST["password"];
    $new_ip       = $_SERVER['REMOTE_ADDR'];
    
    $email_query = "SELECT email FROM glassBuy_users Where email='$new_email'";
    $result      = $con->query($email_query);
    if ($result->num_rows > 0) {
        $allow = 0;
        //already user
        if (isset($_POST['pic'])) {
            $new_usernumber = $_POST['usernumber'];
            
            $email_query = "SELECT * FROM glassBuy_users Where email='$new_email' AND usernumber = '$new_usernumber'";
            $result      = $con->query($email_query);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $_SESSION['usernumber'] = $row['usernumber'];
                    $_SESSION['email']      = $row['email'];
                    $_SESSION['password']      = $row['password'];
                    
                    if($row['cart']==""){
                        $_SESSION['product_id'] = array();
                    }else{
                        $_SESSION['product_id'] = json_decode($row['cart'], true);
                    }



                    $session_usernumber = $_SESSION['usernumber'];
                    $session_username   = $_SESSION['username'];
                    $session_email      = $_SESSION['email'];
                    $session_pic        = $_SESSION['pic'];
                    $session_swkey        = $_SESSION['swkey'];
                    

?><script type="text/javascript"> 
        window.location = "./account.php"; </script>
    <?php 
                    
                }
            }
        }
          
    }else{
        $m = "No such account Exist";
    }
    
    
    if ($allow == 1) {
       
            $new_usernumber = $_POST['usernumber'];
            $new_username = $_POST['username'];
            $new_pic = $_POST['pic'];
            
            $sql            = "INSERT INTO glassBuy_users(id,name, email, password,usernumber, role, timeAdded) VALUES ('$new_usernumber','$new_username', '$new_email', '', '$new_usernumber', 'candidate', '$timeAdded')";
            if (!mysqli_query($con, $sql)) {
                echo "account notcreated";
                $m = "Account failed to create";
            } else {
                $_SESSION['usernumber'] = $new_usernumber;
                $_SESSION['username']   = $new_username;
                $_SESSION['email']      = $new_email;
                $_SESSION['pic']        = $_POST['pic'];
                
                $session_usernumber = $_SESSION['usernumber'];
                $session_username   = $_SESSION['username'];
                $session_pic        = $_SESSION['pic'];
                $session_email      = $_SESSION['email'];
                
                
?><script type="text/javascript"> window.location = "./account.php"; </script>
    <?php 
            }
        
        
    }
}



if(isset($_POST['register'])){
    $errMsg="none";
    $accountCreated = "";
    
    $email = (mb_htmlentities($_POST['email']));
    $name = (mb_htmlentities($_POST['first_name']. " ".$_POST['last_name']));
  
    $phone = (mb_htmlentities($_POST['phone']));
 
    
    $password = mb_htmlentities( md5(md5(sha1( $_POST['password'])).'Anomoz'));
    
    $query_selectedPost= "select * from glassBuy_users where email= '$email' and password='$password'"; 
    $result_selectedPost = $con->query($query_selectedPost); 
    if ($result_selectedPost->num_rows > 0)
    { 
        //successfull login
        while($row = $result_selectedPost->fetch_assoc()) 
        { 
            $logged=1;
            $_SESSION['email'] = $email;
            $_SESSION['userId'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $row['password'];
            ?>
            <script type="text/javascript">
            if (window.location.search.indexOf('fallBack') > -1) {
                var url_string = window.location.href; //window.location.href
                var url = new URL(url_string);
                var c = url.searchParams.get("fallBack");
                window.location = c;
                //window.location = "./home.php?askldnasd";
            }else{
                window.location = "./account.php";
            }
            
                
            </script>
            <?php 
        }
    }
    else{
        // is email being used
        $query_selectedPost= "select * from glassBuy_users where email= '$email'"; 
        $result_selectedPost = $con->query($query_selectedPost); 
        if ($result_selectedPost->num_rows > 0)
        { 
            //problem diagnosed: email correct, incorrect pass
            $dupErr = "yes";
            $errMsg = "Incorrect password.";
            $m = "Invalid Credentials";
        }else{
            //emaail not taken. create new account
            
            $dateTime = time();
            $referredBy = "";
            
            
            $userId = generateRandomString(20);
            $timeAdded = time();
            $sql="insert into glassBuy_users (`id`, `name`, `email`, `password`, `address`, `phone`, `timeAdded`) values 
            ('$userId', '$name','$email', '$password', '$address', '$phone', '$timeAdded')";
            if(!mysqli_query($con,$sql))
            {
                echo "err1";
                $dupErr = "yes";
                $m = "Account already exists.";
            }
            else{
                
                 $_SESSION['email'] = $email;
                 $_SESSION['name'] = $name;
                 $_SESSION['password'] = $password;
                 $_SESSION['userId'] = $userId;
            
                ?>
            <script type="text/javascript">
                window.location = "./account.php";
            </script>
            <?php 
            
            
            }
        }
    }
}


if(isset($_POST['email'])&&isset($_POST['password']) &&isset($_POST['login'])){
 
    $errMsg="none";
    $email = (($_POST['email']));
    $email = (($_POST['email']));
    $password = ( md5(md5(sha1( $_POST['password'])).'Anomoz'));
    
    $query_selectedPost= "select * from glassBuy_users where email= '$email' and password='$password'"; 
    $result_selectedPost = $con->query($query_selectedPost); 
    if ($result_selectedPost->num_rows > 0)
    { 
        //successfull login
        while($row = $result_selectedPost->fetch_assoc()) 
        { 
            $logged=1;
            $_SESSION['email'] = $email;
            $_SESSION['userId'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['password'] = $row['password'];
            
            if($row['cart']==""){
                $_SESSION['product_id'] = array();
            }else{
                $_SESSION['product_id'] = json_decode($row['cart'], true);
            }
                    
            if ($session_role == 'admin') {
               
                 
            ?>
            
            <script type="text/javascript">
            if (window.location.search.indexOf('fallBack') > -1) {
                var url_string = window.location.href; //window.location.href
                var url = new URL(url_string);
                var c = url.searchParams.get("fallBack");
                window.location = c;
                window.location = "./home.php?askldnasd";
            }else{
                window.location = "./account.php";
            }
            
                
            </script>
            <?php 
             }  
        }
    }
    else{
        // is email being used
        $query_selectedPost= "select * from glassBuy_users where email= '$email'"; 
        $result_selectedPost = $con->query($query_selectedPost); 
        if ($result_selectedPost->num_rows > 0)
        { 
            $errMsg = "Incorrect password.";
            $m = "Invalid Credentials";
        }else{
            $m = "Invalid Credentials";
        }

    }

}

if($logged==1){?>
 <script>
        //  location.reload();
        //Check if the current URL contains '#'
      if(document.URL.indexOf("#")==-1)
      {
      // Set the URL to whatever it was plus "#".
      url = document.URL+"#";
      location = "#";
  
      //Reload the page
      location.reload(true);
  
      }
      </script>
  
    
    <?php
    if ($session_role == 'user') {
    
       if(isset($_SESSION['url'])) {
   $url = $_SESSION['url']; 
   
header("Location: https://localhost/glassBuy/$url");

    }// holds url for last page visited.
else {
  
   $url = "account.php"; // default page for 

header("Location: https://localhost/glassBuy/$url");

}
    }
    ?><script type="text/javascript"> 
       // window.location = "./account.php"; </script>
    <?php 
}

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <head>
        
    </head>
    
      <!-- Modal content-->
      <div class="modal-content">
      <?php require("head.php");?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h1 class="modal-title" style="font-weight: 500;">Sign in</h1>
          <h2 class="modal-title-reg" style="display:none;font-weight: 500;font-size:20px"><strong>Create</strong> an account</h2>
        </div>
        <div class="modal-body">

<div class="row">

                            <div class="woocommerce">
                                <div class="woocommerce-notices-wrapper"></div>

                                <div class="u-columns col2-set" id="customer_login">
                                    <div class="u-column1 col-1" id="log">
                                        
                                        
                                         <?if($m!=""){?>
                    <div class="woocommerce-message" role="alert">
                		<?echo $m?>
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
                                                    <input hidden name="redirurl" value="<? echo $_SERVER['HTTP_REFERER']; ?>" />

                                                </p>
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                    <label for="password">Password&nbsp;<span class="required">*</span></label>
                                                    <input
                                                        class="woocommerce-Input woocommerce-Input--text input-text"
                                                        type="password"
                                                        name="password"
                                                        id="password"
                                                        autocomplete="current-password"
                                                    />
                                                </p>

                                                <p class="woocommerce-LostPassword lost_password">
                                                    <!--<a href="lost-password.php">Forgot password?</a>-->
                                                </p>
                                            </div>
                                            <p class="form-row form-button">
                                                <!-- <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span>Remember me</span>
</label> -->
                                                <input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="48d322a003" />
                                                <input type="hidden" name="_wp_http_referer" value="/my-account/" />
                                                <button type="submit" class="woocommerce-button button woocommerce-form-login__submit btn-block btn-lg" name="login" value="Log in">Sign in</button>
                                                
                                                <div id="gSignInWrapper" style="width:100%;margin-top:25px;" class="">
                                                    <div id="customBtn" class="" style="background: #206dfb !important;">
                                                        <button type="button" class="label woocommerce-button button woocommerce-form-login__submit btn" style="margin-top:-15px;margin-left: 3px;">Signin with Googles</button>
                                                    </div>
                                                </div>
                                            
                                            </p>
                                        </form>

                                        <div class="form-footer">
                                            <span class="title" style="font-size: 30px;line-height: 44px;color: #333333;font-weight: 300;display: block;margin: 0 0 8px;letter-spacing: -0.5px;margin-left:25%"><strong>Not a</strong> customer?</span>
                                            <a href="#" class="link reg-link" id="cl" style="font-size: 18px;line-height: 22px;font-weight: 700;text-decoration: underline; margin-left:30%">Create an account</a>
                                        </div>
                                        <hr>
                                        <div class="form-footer">
                                            <!--<span class="title">Forgot Password?</span>-->
                                            <a href="./forgot_password.php" class="link " style="font-size: 18px;line-height: 22px;font-weight: 700;text-decoration: underline; margin-left:30%">Forgot Password?</a>   
                                        </div>
                                    </div>
                                </div>
                            
                            <!-- create form -->


                <div class="u-column2 col-2" id="reg" style="display: none;" >
                            

                            <form method="post" class="woocommerce-form woocommerce-form-register register" novalidate style="margin-top:-10%">
                                <div class="container form-wrap">
                                    <div class="row">
                                         <input name="signup" hidden value="signup">
                                         <div class="col-md-6 col-lg-6 col-sm-6 col-xm-6 col-xl-6">
                                                <label for="first_name">First name <span class="required">*</span></label>
                                                <input type="text" class="input-text" name="first_name" id="first_name" value="" />

                                         </div>
                                         <div class="col-md-6 col-lg-6 col-sm-6 col-xm-6 col-xl-6">
                                            <label for="last_name">Last name <span class="required">*</span></label>
                                            <input type="text" class="input-text" name="last_name" id="last_name" value="" />
                                         </div>

                                    </div>
                                    <div class="clear"></div>
                                    <div class="row">
                                         <div class="col-md-12 col-lg-12 col-sm-12 col-xm-12 col-xl-12">
                                         <label for="reg_email">Email address&nbsp;<span class="required">*</span></label>
                                        <input
                                            type="email"
                                            class="woocommerce-Input woocommerce-Input--text input-text"
                                            name="email"
                                            id="reg_email"
                                            autocomplete="email"
                                            value=""
                                        />
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                         <div class="col-md-12 col-lg-12 col-sm-12 col-xm-12 col-xl-12">
                                         <label for="reg_password">Password&nbsp;<span class="required">*</span></label>
                                        <input
                                            type="password"
                                            class="woocommerce-Input woocommerce-Input--text input-text"
                                            name="password"
                                            id="reg_password"
                                            autocomplete="new-password"
                                        />
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                         <div class="col-md-12 col-lg-12 col-sm-12 col-xm-12 col-xl-12">
                                         <input type="hidden" id="woocommerce-register-nonce" name="woocommerce-register-nonce" value="0a48504050" />
                                                <input type="hidden" name="_wp_http_referer" value="/my-account/" />
                                                <button
                                                    type="submit"
                                                    class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit btn-block btn-lg"
                                                    name="register"
                                                    value="Create Account" style="margin-top:5%"
                                                >
                                                    Create Account
                                                </button>
                                         </div>
                                        
                                    </div>
                                    <div id="gSignInWrapper" style="width:100%;margin-top:20px;" class="">
                                        <div id="customBtn1" class="" style="">
                                            <button type="button" class="label woocommerce-button button woocommerce-form-login__submit">Signin with Google</button>
                                        </div>
                                    </div>
                                        
                                <div class="woocommerce-privacy-policy-text" style="margin-top:20px;margin-left:10%;font-size:13px;">
                                    <p>
                                        By creating this account, you agree to the <a href="terms-conditions.php">Terms of Use</a>,<br />
                                        <a href="privacy-policy.php" class="woocommerce-privacy-policy-link" target="_blank">privacy policy</a>, and Notice of Privacy
                                        Practices.
                                    </p>
                                </div>
                                <hr>
                                 <div class="form-footer" style="margin-left:18%">
                                <span class="title"><strong>Already</strong> a customer?</span>
                                <a href="#" class="link login-link si">Sign in here</a>
                            </div>
                                </div>
                            </form>

                           
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>


     
<script src="https://apis.google.com/js/api:client.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>


  <script>


  $("#cl").click(function(){
    $("#reg").show();
    $("#log").hide();
    $(".modal-title").hide();
    $(".modal-title-reg").show();
  });
  $(".si").click(function(){
    $("#reg").hide();
    $("#log").show();
    $(".modal-title").show();
    $(".modal-title-reg").hide();
  });

  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      auth2 = gapi.auth2.init({
        // client_id: '68565884830-lb0slv6toaj5jouscjs3l1hdaglgqpk5.apps.googleusercontent.com',
        // client_secret : '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',
        client_id: '1022847971557-k2mluch3pu44ifdjkh6qp0t0b4piar14.apps.googleusercontent.com',
        client_secret : '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',
      });
      attachSignin(document.getElementById('customBtn'));
    });
    
    gapi.load('auth2', function(){
      auth2 = gapi.auth2.init({
        client_id: '1022847971557-9hilsingj1jb55sam2f2mlbdfqqh91cr.apps.googleusercontent.com',
                client_secret : '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',

      });
      attachSignin(document.getElementById('customBtn1'));
    });
  };

  function attachSignin(element) {
    auth2.attachClickHandler(element, {},
        function(googleUser) {
          var name= googleUser.getBasicProfile().getName();
        var id = googleUser.getBasicProfile().getId();
         var email = googleUser.getBasicProfile().getEmail();
              var pic = googleUser.getBasicProfile().getImageUrl();
              if(id!='')
              {
                  document.getElementById("google_data").elements[0].value = id;
                  document.getElementById("google_data").elements[1].value = name;
                  document.getElementById("google_data").elements[2].value = email;
                  document.getElementById("google_data").elements[3].value = pic;
                  document.getElementById('google_data').submit();
              }
        }, function(error) {
        });
  }
  </script>


<form id="google_data" action="signin.php" method="post" style="display:none;">
            <input type="text" hidden name="usernumber" value="">
            <input type="text" hidden name="username" value="">
            <input type="email" hidden name="email" value="">
            <input type="text" hidden name="pic" value="">
            <button type="submit" hidden></button>
            </form>
      <script>startApp();</script>
  
        
