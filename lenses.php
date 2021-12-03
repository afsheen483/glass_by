<?php 
include_once("global.php");

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
