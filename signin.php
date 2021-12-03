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



if(isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['signup'])){
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
            $errMsg = "Incorrect password.";
            $m = "Invalid Credentials";
        }else{
            $m = "Invalid Credentials";
        }

    }

}

if($logged==1){
    ?><script type="text/javascript"> 
        window.location = "./account.php"; </script>
    <?php 
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
                                                                                            <h2><strong>Sign in</strong></h2>
                                                                                            
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
                                                                                                    <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="Log in">Sign in</button>
                                                                                                    
                                                                                                    <div id="gSignInWrapper" style="width:100%;margin-top:20px;" class="">
                                                                                                        <div id="customBtn" class="" style="background: #206dfb !important;">
                                                                                                            <button type="button" class="label woocommerce-button button woocommerce-form-login__submit">Signin with Google</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                
                                                                                                </p>
                                                                                            </form>

                                                                                            <div class="form-footer">
                                                                                                <span class="title"><strong>Not a</strong> customer?</span>
                                                                                                <a href="#" class="link reg-link">Create an account</a>
                                                                                            </div>
                                                                                            <Br><Br><Br>
                                                                                            <div class="form-footer">
                                                                                                <!--<span class="title">Forgot Password?</span>-->
                                                                                                <a href="./forgot_password.php" class="link ">Forgot Password?</a>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="u-column2 col-2">
                                                                                            <h2><strong>Create</strong> an account</h2>

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

                                                                                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                                                                        <label for="reg_email">Email address&nbsp;<span class="required">*</span></label>
                                                                                                        <input
                                                                                                            type="email"
                                                                                                            class="woocommerce-Input woocommerce-Input--text input-text"
                                                                                                            name="email"
                                                                                                            id="reg_email"
                                                                                                            autocomplete="email"
                                                                                                            value=""
                                                                                                        />
                                                                                                    </p>

                                                                                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                                                                        <label for="reg_password">Password&nbsp;<span class="required">*</span></label>
                                                                                                        <input
                                                                                                            type="password"
                                                                                                            class="woocommerce-Input woocommerce-Input--text input-text"
                                                                                                            name="password"
                                                                                                            id="reg_password"
                                                                                                            autocomplete="new-password"
                                                                                                        />
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
                                                                                                        Create Account
                                                                                                    </button>
                                                                                                </p>
                                                                                                
                                                                                                <div id="gSignInWrapper" style="width:100%;margin-top:20px;" class="">
                                                                                                        <div id="customBtn1" class="" style="">
                                                                                                            <button type="button" class="label woocommerce-button button woocommerce-form-login__submit">Signin with Google</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    
                                                                                                <div class="woocommerce-privacy-policy-text">
                                                                                                    <p>
                                                                                                        By creating this account, you agree to the <a href="terms-conditions.php">Terms of Use</a>,<br />
                                                                                                        <a href="privacy-policy.php" class="woocommerce-privacy-policy-link" target="_blank">privacy policy</a>, and Notice of Privacy
                                                                                                        Practices.
                                                                                                    </p>
                                                                                                </div>
                                                                                            </form>

                                                                                            <div class="form-footer">
                                                                                                <span class="title"><strong>Already</strong> a customer?</span>
                                                                                                <a href="#" class="link login-link">Sign in here</a>
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
         
     
<script src="https://apis.google.com/js/api:client.js"></script>
  <script>
  
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      auth2 = gapi.auth2.init({
        client_id: '140850185426-ord0lcee7nqb0cf44s65ijunde5840mp.apps.googleusercontent.com',
      });
      attachSignin(document.getElementById('customBtn'));
    });
    
    gapi.load('auth2', function(){
      auth2 = gapi.auth2.init({
        client_id: '140850185426-ord0lcee7nqb0cf44s65ijunde5840mp.apps.googleusercontent.com',
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
  
        
    </body>
</html>
