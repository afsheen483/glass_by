<?php 
include_once("global.php");

if(isset($_POST['coupon'])){
    $coupon = mb_htmlentities($_POST['coupon']);
    $pro ="SELECT * FROM glassBuy_coupons WHERE coupon='$coupon' and status='active'";
    $product_data = $con->query($pro);
    if($product_data->num_rows > 0){
        $couponDeets = $product_data->fetch_assoc();;
        $_SESSION['coupon_used'] = mb_htmlentities($coupon);
        $_SESSION['coupon_discount'] = $couponDeets['discount'];
        $m = "Coupon activated successfully";
        
        $pro ="update glassBuy_coupons set timesUsed=timesUsed+1 WHERE coupon='$coupon'";
        $con->query($pro);
        
    }else{
        $m = "Coupon Code is not valid.";
    }
    
}

error_reporting(E_ERROR);
ini_set('display_errors', '1');

$subbtotal = 0;
$Prescription_Lenses_cost_total =0;  
foreach($_SESSION['product_id'] as $pidinfo){
    
    
    $Prescription_Lenses_cost = 0;
    if($pidinfo['lensType']=="Ultimate Anti Reflection"){
        $Prescription_Lenses_cost = 25;
    }
    $Prescription_Lenses_cost_total+=$Prescription_Lenses_cost;
      
      
      
    $pid = mb_htmlentities($pidinfo['id']);

	$sql ="SELECT * FROM glassBuy_glass_picture WHERE glass_id='$pid'";
          $img_data = $con->query($sql);
          if($img_data->num_rows > 0){
              $rows = $img_data->fetch_assoc();
              $img = $rows['name'];
          }
	
	$pro ="SELECT * FROM glassBuy_glasses WHERE glass_id='$pid'";
        $product_data = $con->query($pro);
        if($product_data->num_rows > 0){
           $rowd = $product_data->fetch_assoc();
           $p_name = $rowd['title'];
           $p_price = $rowd['price'];
		   $desc = $rowd['additional_info'];
		   $subbtotal+=($p_price+$Prescription_Lenses_cost);
        }
}
                                                                                
                                                                                

$sessionId = session_id();

$assTotal = 0;
$myaccessories = array();
$rows = getAll($con, "select * from glassBuy_order_accessories a inner join glassBuy_glasses g on g.glass_id=a.accessoryId where sessionId='$sessionId' and quantity>0");
foreach($rows as $row){
    $myaccessories[$row['accessoryId']] = array($row['title'], $row['price'], $row['quantity']);
    $assTotal+=$row['price']* $row['quantity'];
}


$discount = round(($_SESSION['coupon_discount']/100) * ($subbtotal+$assTotal), 2);
           
        
$tax = round(($subbtotal * 0.04712), 2)  ;

       
             

  if(isset($_POST['woocommerce_checkout_place_order'])){
    //   
    //   var_dump($_POST);
      
     include_once("database.php");
     require_once('vendor/autoload.php');

     
     $order_comments = mb_htmlentities($_POST['order_comments']);
    // echo "here0";
     
     //create
     if(!isset($_SESSION['email']) && $_POST['billing_email']!=""){
         
        //   echo "here1";
          
         $password = mb_htmlentities( md5(md5(sha1( $_POST['password'])).'Anomoz'));
        $name = mb_htmlentities($_POST['billing_first_name'])." ".mb_htmlentities($_POST['billing_last_name']);
         $email = mb_htmlentities($_POST['billing_email']);
         $userId = generateRandomString(20);
        $timeAdded = time();
        
        //search if email of this user there.
        $rows_accounts = getAll($con, "select * from glassBuy_users where email='$email'");
        if(count($rows_accounts)>0){
             $_SESSION['userId'] = $rows_accounts[0]['id'];
             $_SESSION['email_temp'] = $rows_accounts[0]['email'];;
            $_SESSION['password_temp'] = $rows_accounts[0]['password'];;
        }else{
            
            $sql="insert into glassBuy_users (`id`, `name`, `email`, `password`, `address`, `phone`, `timeAdded`) values 
            ('$userId', '$name','$email', '$password', '$address', '$phone', '$timeAdded')";
            if(!mysqli_query($con,$sql))
            {
                echo "err1";
                $dupErr = "yes";
                echo "duplicate email";
                // echo $sql;
            }
            else{
                 $_SESSION['email_temp'] = $email;
                 $_SESSION['password_temp'] = $password;
                //  $_SESSION['name'] = $name;
                 $_SESSION['userId'] = $userId;
            }
        }
    }
    
    // echo "here2";
            
      $total = round(($tax+ $subbtotal + 9 + $assTotal) - $discount, 2);
     if(isset($_SESSION['email']) || isset($_SESSION['email_temp'])){
        
        // echo "here3";
        $uid=$_SESSION['userId'];
        $name=$_SESSION['name'];
        $email=$_SESSION['email'];
        // $pid=$_SESSION['product_id'];

        //billing
        $b_fname = mb_htmlentities($_POST['billing_first_name']);
        $b_lname = mb_htmlentities($_POST['billing_last_name']);
        $address = mb_htmlentities($_POST['billing_address_1'].' '.$_POST['billing_address_2']);
        $b_city = mb_htmlentities($_POST['billing_city']);
        $b_state = mb_htmlentities($_POST['billing_state']);
        $b_postcode = mb_htmlentities($_POST['billing_postcode']);
        $b_country = mb_htmlentities($_POST['billing_country']);
        $b_phone = mb_htmlentities($_POST['billing_phone']);
        $b_email = mb_htmlentities($_POST['billing_email']);
        $pass = mb_htmlentities(md5($_POST['account_password']));
        $shipping = mb_htmlentities($_POST['shipping_country']);

        //PRESCRIPTION
        //$lens_type_details = $_SESSION['prescript_data1']['lens_type_details'];
        //dd($lens_type_details);
        $r_sph = $_SESSION['prescript_data1']['addon-1584107435-1-sph-0'];
        $r_cyl = $_SESSION['prescript_data1']['addon-1584107435-1-cyl-1'];
        $r_axis = $_SESSION['prescript_data1']['addon-1584107435-1-axis-2'];
        $r_add = $_SESSION['prescript_data1']['addon-1584107435-1-add-3'];
        if ($r_cyl > 0) { 
            $r_convert_sph = $r_sph + $r_cyl;
            $r_convert_cyl = "-".$r_cyl;
          }
          if ($r_axis > 90) {
            $r_convert_axis = $r_axis - 90;
         }elseif($r_axis < 90){
           $r_convert_axis = $r_axis + 90;
         }
        $l_sph = $_SESSION['prescript_data1']['addon-1584107435-2-sph-0'];
        $l_cyl = $_SESSION['prescript_data1']['addon-1584107435-2-cyl-1'];
        $l_axis = $_SESSION['prescript_data1']['addon-1584107435-2-axis-2'];
        $l_add = $_SESSION['prescript_data1']['addon-1584107435-2-add-3'];
        $pdimage = $_SESSION['prescript_data1']['pdimage'];
        if ($l_cyl > 0) { 
            $l_convert_sph = $l_sph + $l_cyl;
            $l_convert_cyl = "-".$l_cyl;
          }
          if ($l_axis > 90) {
            $l_convert_axis = $l_axis - 90;
         }elseif($r_axis < 90){
           $l_convert_axis = $l_axis + 90;
         }
        $quantity1 = $_SESSION['prescript_data1']['component_1584107435_bundle_quantity_1'];

        $pd = $_SESSION['prescript_data1']['addon-1584107435-pd-2'];
        // $my_pd = $_SESSION['prescript_data1']['addon-1584107435-measure-my-pd-5'];

        $prescript = $_SESSION['prescript_data1']['addon-1584107435-save-your-prescription-for-future-11'];
        $lens_type = $_SESSION['lens_type'];

        if(empty($_SESSION['prescript_data2']['addon-1584107435-first-name-12'])){
          $pre_fname = $_SESSION['prescript_data1']['addon-1584107435-first-name-8'];
        }
        else{
          $pre_fname = $_SESSION['prescript_data2']['addon-1584107435-first-name-12'];
        }

        if(empty($_SESSION['prescript_data2']['addon-1584107435-last-name-13'])){
          $pre_lname = $_SESSION['prescript_data1']['addon-1584107435-last-name-9'];
        }
        else{
           $pre_lname = $_SESSION['prescript_data2']['addon-1584107435-last-name-13'];
        }

        if(empty($_SESSION['file2']['addon-1584107435-upload-your-prescription-1']['name'])){
          $pre_file = $_SESSION['file1']['addon-1584107435-upload-your-prescription-14']['name'];
        }
        else{
         $pre_file = $_SESSION['file2']['addon-1584107435-upload-your-prescription-1']['name'];
        }
        
        $order_sql = "INSERT INTO glassBuy_order(user_id,name,email,product_id, order_comments) VALUES('$uid','$name','$email','$pid', '$order_comments')";
        if($con->query($order_sql) === TRUE){
            $last_id = $con->insert_id;
        }

        //add accessrotiurs
        $order_details = "update glassBuy_order_accessories set orderId='$last_id' where sessionId='$sessionId' and orderId=''";
        $con->query($order_details);
        
        foreach($_SESSION['product_id'] as $pidinfo){
            
            $pid = $pidinfo['id'];
            $lensType = $pidinfo['lensType'];
            $vision = $pidinfo['vision'];
            

            $order_details = "INSERT INTO glassBuy_order_details(order_id,product_id,product_name,product_price,fname,lname,address,city,province,postal_code,phone,email,country,shipping_country,create_password, vision, lensType, total) 
             VALUES($last_id,'$pid','$p_name','$p_price','$b_fname','$b_lname','$address','$b_city','$b_state','$b_postcode','$b_phone','$b_email','$b_country','shipping','$pass', '$vision', '$lensType', '$total')";
             
            //  echo $order_details;
            $con->query($order_details);
        
        }

        // var_dump($_SESSION['prescript_data1']);
        //check if previous prescrpition
        if($_SESSION['prescript_data1']['selected_prescription']==""){
             $time = time();
             $prescription = "INSERT INTO glassBuy_prescription(product_id,order_id,r_sph,r_cyl,r_axis,r_add,l_sph,l_cyl,l_axis,l_add,lens_type,quantity,pd,fname,lname,prescription,file_name, userId, timeAdded, pdimage) VALUES('$pid',$last_id,'$r_convert_sph','$r_convert_cyl','$r_convert_axis','$r_add','$l_convert_sph','$l_convert_cyl','$l_convert_axis','$l_add','$lens_type','$quantity','$pd','$pre_fname','$pre_lname','$prescript','$pre_file', '$session_userId', '$time', '$pdimage')";
             $con->query($prescription);
            //  echo "empty: ".$prescription;
        }else{
            $selected_prescription = $_SESSION['prescript_data1']['selected_prescription'];
            //get prescription
            $sql ="SELECT * FROM glassBuy_prescription WHERE id='$selected_prescription'";
              $pres_data = $con->query($sql);
              if($pres_data->num_rows > 0){
                  $row_pres = $pres_data->fetch_assoc();
                  $r_sph = $row_pres['r_sph'];
                  $r_cyl = $row_pres['r_cyl'];

                  if ($r_cyl > 0) { 
                    $r_convert_sph = $r_sph + $r_cyl;
                    $r_convert_cyl = "-".$r_cyl;
                  }
                  $r_axis = $row_pres['r_axis'];
                  if ($r_axis > 90) {
                     $r_convert_axis = $r_axis - 90;
                  }elseif($r_axis < 90){
                    $r_convert_axis = $r_axis + 90;
                  }
                  $r_add = $row_pres['r_add'];
                  $l_sph = $row_pres['l_sph'];
                  $l_cyl = $row_pres['l_cyl'];

                  if ($l_cyl > 0) { 
                    $l_convert_sph = $l_sph + $l_cyl;
                    $l_convert_cyl = "-".$l_cyl;
                  }
                  $l_axis = $row_pres['l_axis'];
                  if ($l_axis > 90) {
                    $l_convert_axis = $l_axis - 90;
                 }elseif($r_axis < 90){
                   $l_convert_axis = $l_axis + 90;
                 }
                  $l_add = $row_pres['l_add'];
                  $lens_type = $row_pres['lens_type'];
                  $quantity = $row_pres['quantity'];
                  $pd = $row_pres['pd'];
                  $my_pd = $row_pres['my_pd'];
                  $fname = $row_pres['fname'];
                  $lname = $row_pres['lname'];
                  $prescript = $row_pres['prescription'];
                  $file_name = $row_pres['file_name'];
                  $pdimage = $row_pres['pdimage'];
                  
                  $time = time();
                  
              }
                                                                                  
            
            $prescription = "INSERT INTO glassBuy_prescription(product_id,order_id,r_sph,r_cyl,r_axis,r_add,l_sph,l_cyl,l_axis,l_add
            ,lens_type,quantity,pd,fname,lname,prescription,file_name, userId, timeAdded, pdimage) VALUES ('$pid',$last_id,
            '$r_convert_sph','$r_convert_cyl','$r_convert_axis','$r_add','$l_convert_sph','$l_convert_cyl','$l_convert_axis','$l_add','$lens_type','$quantity',
            '$pd','$fname','$lname','$prescript','$file_name', '$session_userId', '$time', '$pdimage')";
            $con->query($prescription);
            
            // echo "selected $selected_prescription: ".$prescription;
            
        }

     
       if($total>0){
        //   exit();
           
        //   echo "here4";

            if($total<100000){
            $stripe = new \Stripe\StripeClient([
            "api_key" => $params['private_test_key'], 
            "stripe_version" => "2020-08-27"
            ]
            );
            
             $success_url  = $g_project_url.'view_order.php?pId='.($last_id)."thankyou=thankyou";
            //  echo $success_url;
            //  exit();
            $session = $stripe->checkout->sessions->create([
              'payment_method_types' => ['card'],
              'line_items' => [[
                'price_data' => [
                  'product' => "prod_IfkGNQQX9TKWK9",
                  'unit_amount' => $total*100,
                  'currency' => 'usd',
                ],
                'quantity' => 1,
              ]],
              'mode' => 'payment',
              'success_url' => $success_url,
              'cancel_url' => $g_project_url,
            ]);
        
        
        ?>
         <script src="https://js.stripe.com/v3/"></script>
        <script>
             var stripe = Stripe('pk_test_51Gz0OOHQjkfG1DwO9latQvA69lF4SGM6jl1DiHgWI5gkzHvI4XqlMDHDw3kQxHPZEJIZlGxxOBufbdfAPAOjVM1500HcxE0VZ2');
             stripe.redirectToCheckout({
            // Make the id field from the Checkout Session creation API response
            // available to this file, so you can provide it as argument here
            // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
            sessionId: '<?php  echo $session['id']?>'
          }).then(function (result) {
            // If `redirectToCheckout` fails due to a browser or network
            // error, display the localized error message to your customer
            // using `result.error.message`.
          });
        </script>
        <?php  
        echo "Redirecting...";
        exit();
            
        }else{
            header("Location:?m=Checkout amount is huge ");
        }
        
        
            
        }else{
            header("Location:?m=Amount must me greater than 0");
        }

       
       
         
     }
  }

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <?php require("./includes/comman/checkout/head.php");?>
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
                <article class="fl-post post-315 page type-page status-publish hentry" id="fl-post-315" itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
                    <div class="fl-post-content clearfix" itemprop="text">
                        <div class="fl-builder-content fl-builder-content-315 fl-builder-content-primary fl-builder-global-templates-locked" data-post-id="315">
                            <div class="fl-row fl-row-fixed-width fl-row-bg-none fl-node-5ec39c6e4f297" data-node="5ec39c6e4f297">
                                <div class="fl-row-content-wrap">
                                    <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                        <div class="fl-col-group fl-node-5ec39c6e50d20" data-node="5ec39c6e50d20">
                                            <div class="fl-col fl-node-5ec39c6e50e30" data-node="5ec39c6e50e30">
                                                <div class="fl-col-content fl-node-content">
                                                    <div class="fl-module fl-module-pp-heading fl-node-5ec39c6e4f01c" data-node="5ec39c6e4f01c">
                                                        <div class="fl-module-content fl-node-content">
                                                            <div class="pp-heading-content">
                                                                <div class="pp-heading pp-left">
                                                                    <h2 class="heading-title">
                                                                        <span class="title-text pp-primary-title">Checkout</span>
                                                                    </h2>
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
                            <div class="fl-row fl-row-fixed-width fl-row-bg-none fl-node-5ebe7b2f99f8f" data-node="5ebe7b2f99f8f">
                                <div class="fl-row-content-wrap">
                                    <div class="fl-row-content fl-row-fixed-width fl-node-content">
                                        <div class="fl-col-group fl-node-5ebe7b2f99eca" data-node="5ebe7b2f99eca">
                                            <div class="fl-col fl-node-5ebe7b2f99f0e" data-node="5ebe7b2f99f0e">
                                                <div class="fl-col-content fl-node-content">
                                                    <div class="fl-module fl-module-rich-text fl-node-5ebe7b2f99f4f" data-node="5ebe7b2f99f4f">
                                                        <div class="fl-module-content fl-node-content">
                                                            <div class="fl-rich-text">
                                                                <div>
                                                                    <div class="woocommerce">
                                                                        <div class="woocommerce-notices-wrapper"></div>
                                                                        <!--<div class="woocommerce-form-login-toggle">
                                                                            <div class="woocommerce-info">Returning customer? <a href="#" class="showlogin">Click here to login</a></div>
                                                                        </div>-->
                                                                        <div class="woocommerce-notices-wrapper"></div>
                                                                        
                                                                        <form
                                                                            name="checkout"
                                                                            method="post"
                                                                            class="checkout woocommerce-checkout"
                                                                            action=""
                                                                            enctype="multipart/form-data"
                                                                        >
                                                                            <a href="./cart.php">< Back</a>
                                                                            
                                                                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
                                                                            <?php  if($_GET['m']!=""){?>
                                                                            <div class="alert alert-danger" role="alert">
                                                                                                <div class="alert-text">
                                                                                                <?php  echo  $_GET['m']?>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                            
                                                                            <?php  }?>
                                                                        
                                                                        
                                                                            <div class="col2-set" id="customer_details">
                                                                                
                                                                                <div class="col-1">
                                                                                    <div class="woocommerce-shipping-fields">
                                                                                        <h3 class="shipping-heading">
                                                                                            Billing Details
                                                                                        </h3>

                                                                                        

                                                                                        <div class="shipping_address"  >
                                                                                            <div class="woocommerce-shipping-fields__field-wrapper">
                                                                                                <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10">
                                                                                                <label for="billing_first_name" class="">First name&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="text" class="input-text" name="billing_first_name" id="billing_first_name" placeholder="" value="" autocomplete="given-name" />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p class="form-row form-row-last validate-required" id="billing_last_name_field" data-priority="20">
                                                                                                <label for="billing_last_name" class="">Last name&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="text" class="input-text" name="billing_last_name" id="billing_last_name" placeholder="" value="" autocomplete="family-name" />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p class="form-row address-field validate-required form-row-wide" id="billing_address_1_field" data-priority="25">
                                                                                                <label for="billing_address_1" class="">Address Line 1&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="input-text"
                                                                                                        name="billing_address_1"
                                                                                                        id="billing_address_1"
                                                                                                        placeholder="House number and street name"
                                                                                                        value=""
                                                                                                        autocomplete="address-line1"
                                                                                                        data-placeholder="House number and street name"
                                                                                                    />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p class="form-row address-field form-row-wide" id="billing_address_2_field" data-priority="26">
                                                                                                <label for="billing_address_2" class="">Address Line 2&nbsp;<span class="optional">(optional)</span></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="input-text"
                                                                                                        name="billing_address_2"
                                                                                                        id="billing_address_2"
                                                                                                        placeholder="Apartment, suite, unit, etc. (optional)"
                                                                                                        value=""
                                                                                                        autocomplete="address-line2"
                                                                                                        data-placeholder="Apartment, suite, unit, etc. (optional)"
                                                                                                    />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p
                                                                                                class="form-row address-field validate-required form-row-wide"
                                                                                                id="billing_city_field"
                                                                                                data-priority="70"
                                                                                                data-o_class="form-row form-row-wide address-field validate-required"
                                                                                            >
                                                                                                <label for="billing_city" class="">City&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="text" class="input-text" name="billing_city" id="billing_city" placeholder="" value="" autocomplete="address-level2" />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p
                                                                                                class="form-row address-field validate-required validate-state form-row-wide"
                                                                                                id="billing_state_field"
                                                                                                data-priority="90"
                                                                                                data-o_class="form-row form-row-wide address-field validate-required validate-state"
                                                                                            >
                                                                                                <label for="billing_state" class="">State&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="text" class="input-text" name="billing_state" id="billing_city" placeholder="" value="" autocomplete="address-level2" />
                                                                                                   
                                                                                                </span>
                                                                                            </p>
                                                                                            <p
                                                                                                class="form-row address-field validate-required validate-postcode form-row-wide"
                                                                                                id="billing_postcode_field"
                                                                                                data-priority="94"
                                                                                                data-o_class="form-row form-row-wide address-field validate-required validate-postcode"
                                                                                            >
                                                                                                <label for="billing_postcode" class="">Postal code&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="text" class="input-text" name="billing_postcode" id="billing_postcode" placeholder="" value="" autocomplete="postal-code" />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p class="form-row form-row-wide address-field update_totals_on_change validate-required" id="billing_country_field" data-priority="95">
                                                                                                <label for="billing_country" class="">Country / Region&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <!--<strong>Canada</strong>
                                                                                                    <input
                                                                                                        type="hidden"
                                                                                                        name="billing_country"
                                                                                                        id="billing_country"
                                                                                                        value="CA"
                                                                                                        autocomplete="country"
                                                                                                        class="country_to_state"
                                                                                                        readonly="readonly"
                                                                                                    />-->
                                                                                                    <select type="text" class="input-text" name="billing_postcode" id="billing_postcode" placeholder="" value="" autocomplete="postal-code" >
                                                                                                        <?php  foreach($g_countries as $country){?>
                                                                                                        <option <?php  if($country=="United States"){echo "selected";}?>><?php  echo $country?></option>
                                                                                                        <?php  }?>
                                                                                                    </select>

                                                                                                </span>
                                                                                               
                                                                                            </p>
                                                                                            <p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field" data-priority="100">
                                                                                                <label for="billing_phone" class="">Phone&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="tel" class="input-text" name="billing_phone" id="billing_phone" placeholder="" value="" autocomplete="tel" />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p class="form-row form-row-wide validate-required validate-email" id="billing_email_field" data-priority="110">
                                                                                                <label for="billing_email" class="">Email address&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="email" class="input-text" name="billing_email" id="billing_email" placeholder="" value="<?php echo $session_email?>" autocomplete="email username" />
                                                                                                </span>
                                                                                            </p>
                                                                                                
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="woocommerce-additional-fields">
                                                                                        <div class="woocommerce-additional-fields__field-wrapper">
                                                                                            <p class="form-row notes" id="order_comments_field" data-priority="">
                                                                                                <label for="order_comments" class="">Order notes&nbsp;<span class="optional">(optional)</span></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <textarea
                                                                                                        name="order_comments"
                                                                                                        class="input-text"
                                                                                                        id="order_comments"
                                                                                                        placeholder="Notes about your order, e.g. special notes for delivery."
                                                                                                        rows="2"
                                                                                                        cols="5"
                                                                                                    ></textarea>
                                                                                                </span>
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                
                                                                                <div class="col-2">
                                                                                    <div class="woocommerce-billing-fields">
                                                                                        <h3>Shipping details</h3>
                                                                                        
                                                                                        <h3 id="ship-to-different-address">
                                                                                            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                                                                                <input
                                                                                                    id="ship-to-different-address-checkbox"
                                                                                                    class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                                                                                                    type="checkbox"
                                                                                                    name="ship_to_different_address"
                                                                                                    value="1"
                                                                                                />
                                                                                                <span>My Shipping Address is same as Billing Address</span>
                                                                                            </label>
                                                                                        </h3>
                                                                                        

                                                                                        <div class="woocommerce-billing-fields__field-wrapper" >
                                                                                            <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10">
                                                                                                <label for="billing_first_name" class="">First name&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="text" class="input-text" name="c_billing_first_name" id="billing_first_name" placeholder="" value="" autocomplete="given-name" />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p class="form-row form-row-last validate-required" id="billing_last_name_field" data-priority="20">
                                                                                                <label for="billing_last_name" class="">Last name&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="text" class="input-text" name="c_billing_last_name" id="billing_last_name" placeholder="" value="" autocomplete="family-name" />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p class="form-row address-field validate-required form-row-wide" id="billing_address_1_field" data-priority="25">
                                                                                                <label for="billing_address_1" class="">Address Line 1&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="input-text"
                                                                                                        name="c_billing_address_1"
                                                                                                        id="billing_address_1"
                                                                                                        placeholder="House number and street name"
                                                                                                        value=""
                                                                                                        autocomplete="address-line1"
                                                                                                        data-placeholder="House number and street name"
                                                                                                    />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p class="form-row address-field form-row-wide" id="billing_address_2_field" data-priority="26">
                                                                                                <label for="billing_address_2" class="">Address Line 2&nbsp;<span class="optional">(optional)</span></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="input-text"
                                                                                                        name="c_billing_address_2"
                                                                                                        id="billing_address_2"
                                                                                                        placeholder="Apartment, suite, unit, etc. (optional)"
                                                                                                        value=""
                                                                                                        autocomplete="address-line2"
                                                                                                        data-placeholder="Apartment, suite, unit, etc. (optional)"
                                                                                                    />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p
                                                                                                class="form-row address-field validate-required form-row-wide"
                                                                                                id="billing_city_field"
                                                                                                data-priority="70"
                                                                                                data-o_class="form-row form-row-wide address-field validate-required"
                                                                                            >
                                                                                                <label for="billing_city" class="">City&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="text" class="input-text" name="c_billing_city" id="billing_city" placeholder="" value="" autocomplete="address-level2" />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p
                                                                                                class="form-row address-field validate-required validate-state form-row-wide"
                                                                                                id="billing_state_field"
                                                                                                data-priority="90"
                                                                                                data-o_class="form-row form-row-wide address-field validate-required validate-state"
                                                                                            >
                                                                                                <label for="billing_state" class="">State&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="text" class="input-text" name="c_billing_state" id="billing_city" placeholder="" value="" autocomplete="address-level2" />
                                                                                                   
                                                                                                </span>
                                                                                            </p>
                                                                                            <p
                                                                                                class="form-row address-field validate-required validate-postcode form-row-wide"
                                                                                                id="billing_postcode_field"
                                                                                                data-priority="94"
                                                                                                data-o_class="form-row form-row-wide address-field validate-required validate-postcode"
                                                                                            >
                                                                                                <label for="billing_postcode" class="">Postal code&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="text" class="input-text" name="c_billing_postcode" id="billing_postcode" placeholder="" value="" autocomplete="postal-code" />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p class="form-row form-row-wide address-field update_totals_on_change validate-required" id="billing_country_field" data-priority="95">
                                                                                                <label for="billing_country" class="">Country / Region&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <!--<strong>Canada</strong>
                                                                                                    <input
                                                                                                        type="hidden"
                                                                                                        name="c_billing_country"
                                                                                                        id="billing_country"
                                                                                                        value="CA"
                                                                                                        autocomplete="country"
                                                                                                        class="country_to_state"
                                                                                                        readonly="readonly"
                                                                                                    />-->
                                                                                                    <select type="text" class="input-text" name="c_billing_postcode" id="billing_postcode" placeholder="" value="" autocomplete="postal-code" >
                                                                                                        <?php  foreach($g_countries as $country){?>
                                                                                                        <option <?php  if($country=="United States"){echo "selected";}?>><?php  echo $country?></option>
                                                                                                        <?php  }?>
                                                                                                    </select>

                                                                                                </span>
                                                                                               
                                                                                            </p>
                                                                                            <p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field" data-priority="100">
                                                                                                <label for="billing_phone" class="">Phone&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="tel" class="input-text" name="c_billing_phone" id="billing_phone" placeholder="" value="" autocomplete="tel" />
                                                                                                </span>
                                                                                            </p>
                                                                                            <p class="form-row form-row-wide validate-required validate-email" id="billing_email_field" data-priority="110">
                                                                                                <label for="billing_email" class="">Email address&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <input type="email" class="input-text" name="c_billing_email1" id="billing_email" placeholder="" value="<?php echo $session_email?>" autocomplete="email username" />
                                                                                                </span>
                                                                                            </p>
                                                                                            <div class="woocommerce-additional-fields">
                                                                                            <div class="woocommerce-additional-fields__field-wrapper">
                                                                                                <p class="form-row notes" id="order_comments_field" data-priority="">
                                                                                                    <label for="order_comments" class="">Order notes&nbsp;<span class="optional">(optional)</span></label>
                                                                                                    <span class="woocommerce-input-wrapper">
                                                                                                        <textarea
                                                                                                            name="c_order_comments"
                                                                                                            class="input-text"
                                                                                                            id="order_comments"
                                                                                                            placeholder="Notes about your order, e.g. special notes for delivery."
                                                                                                            rows="2"
                                                                                                            cols="5"
                                                                                                        ></textarea>
                                                                                                    </span>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                                                
                                                                                    <?php  if($logged==0){?>
                                                                                   <div class="woocommerce-account-fields">
                                                                                        <div class="create-account">
                                                                                            <p class="form-row validate-required" id="account_password_field" data-priority="">
                                                                                                <label for="account_password" class="">Create account password&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                <span class="woocommerce-input-wrapper password-input">
                                                                                                    <input type="password" class="input-text" name="password" id="account_password" placeholder="Password" value="" />
                                                                                                    <span class="show-password-input"></span>
                                                                                                </span>
                                                                                            </p>
                                                                                            <div class="clear"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php  }?>
                                                                                    
                                                                                    
                                                                                  <!--  
                                                                                    <div class="woocommerce-additional-fields">
                                                                                        <div class="woocommerce-additional-fields__field-wrapper">
                                                                                            <p class="form-row notes" id="order_comments_field" data-priority="">
                                                                                                <label for="order_comments" class="">Order notes&nbsp;<span class="optional">(optional)</span></label>
                                                                                                <span class="woocommerce-input-wrapper">
                                                                                                    <textarea
                                                                                                        name="order_comments"
                                                                                                        class="input-text"
                                                                                                        id="order_comments"
                                                                                                        placeholder="Notes about your order, e.g. special notes for delivery."
                                                                                                        rows="2"
                                                                                                        style="width: 485px;"
                                                                                                        cols="5"
                                                                                                    ></textarea>
                                                                                                </span>
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    -->
                                                                                </div>
                                                                                
                                                                                <!--<h3 id="ship-to-different-address">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
				<input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" type="checkbox" name="ship_to_different_address" value="1"> <span>“MY SHIPPING ADDRESS IS SAME AS BILLING ADDRESS”</span>
			</label>
		</h3>-->

                                                                                
                                                                            </div>
                                                                            
                                                                            
<style>
    #fl-main-content form.woocommerce-checkout .form-row {
    padding: 0 !important;
    margin: 0 0 20px !important;
    width: 100%;
    }
</style>
<div class="woocommerce-terms-and-conditions-wrapper">
            			<p class="form-row validate-required">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                    <input required type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms" id="terms">
					<span class="woocommerce-terms-and-conditions-checkbox-text">BY MAKING THIS PURCHASE 
I ACKNOWLEDGE TO HAVE 
REVIEWED AND ACCEPTED 
ALL THE TERMS AND 
CONDITIONS LISTED <a href="./terms-conditions.php">HERE</a> 
AS PART OF THIS 
PURCHASE*</span>
				</label>
				<input type="hidden" name="terms-field" value="1">
			</p>
	</div>
                                                                            
<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Pay Now" data-value="Pay Now">
                                                                            <div id="order_review1" class="woocommerce-checkout-review-order1">
                                                                                <div id="payment" class="woocommerce-checkout-payment">
                                                                                    <h3>Payment</h3>
                                                                                    <ul class="wc_payment_methods payment_methods methods">
                                                                                        <li class="wc_payment_method payment_method_moneris">
                                                                                            <input
                                                                                                id="payment_method_moneris"
                                                                                                type="radio"
                                                                                                class="input-radio"
                                                                                                name="payment_method"
                                                                                                value="moneris"
                                                                                                checked="checked"
                                                                                                data-order_button_text="Pay Now"
                                                                                                style="display: none;"
                                                                                            />

                                                                                            <label for="payment_method_moneris">
                                                                                                Credit Card
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce-gateway-moneris/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/images/card-visa.svg"
                                                                                                    alt="visa"
                                                                                                    class="sv-wc-payment-gateway-icon wc-moneris-payment-gateway-icon"
                                                                                                    style="width: 40px; height: 25px;"
                                                                                                    width="40"
                                                                                                    height="25"
                                                                                                />
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce-gateway-moneris/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/images/card-mastercard.svg"
                                                                                                    alt="mastercard"
                                                                                                    class="sv-wc-payment-gateway-icon wc-moneris-payment-gateway-icon"
                                                                                                    style="width: 40px; height: 25px;"
                                                                                                    width="40"
                                                                                                    height="25"
                                                                                                />
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce-gateway-moneris/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/images/card-amex.svg"
                                                                                                    alt="amex"
                                                                                                    class="sv-wc-payment-gateway-icon wc-moneris-payment-gateway-icon"
                                                                                                    style="width: 40px; height: 25px;"
                                                                                                    width="40"
                                                                                                    height="25"
                                                                                                />
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce-gateway-moneris/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/images/card-discover.svg"
                                                                                                    alt="discover"
                                                                                                    class="sv-wc-payment-gateway-icon wc-moneris-payment-gateway-icon"
                                                                                                    style="width: 40px; height: 25px;"
                                                                                                    width="40"
                                                                                                    height="25"
                                                                                                />
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce-gateway-moneris/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/images/card-dinersclub.svg"
                                                                                                    alt="dinersclub"
                                                                                                    class="sv-wc-payment-gateway-icon wc-moneris-payment-gateway-icon"
                                                                                                    style="width: 40px; height: 25px;"
                                                                                                    width="40"
                                                                                                    height="25"
                                                                                                />
                                                                                                <img
                                                                                                    src="https://directvisioneyewear.ca/wp-content/plugins/woocommerce-gateway-moneris/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/images/card-jcb.svg"
                                                                                                    alt="jcb"
                                                                                                    class="sv-wc-payment-gateway-icon wc-moneris-payment-gateway-icon"
                                                                                                    style="width: 40px; height: 25px;"
                                                                                                    width="40"
                                                                                                    height="25"
                                                                                                />
                                                                                            </label>
                                                                                            <div class="payment_box payment_method_moneris">
                                                                                                <p>Pay securely using your credit card.</p>
                                                                                                <fieldset id="wc-moneris-credit-card-form" aria-label="Payment Info">
                                                                                                    <legend style="display: none;">Payment Info</legend>
                                                                                                    <div class="wc-moneris-new-payment-method-form js-wc-moneris-new-payment-method-form">
                                                                                                        <p
                                                                                                            class="form-row form-row-wide validate-required woocommerce-invalid woocommerce-invalid-required-field"
                                                                                                            id="wc-moneris-account-number_field"
                                                                                                            data-priority=""
                                                                                                        >
                                                                                                            <label for="wc-moneris-account-number" class="">Card Number&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                            <span class="woocommerce-input-wrapper">
                                                                                                                <input
                                                                                                                    type="tel"
                                                                                                                    class="input-text js-sv-wc-payment-gateway-credit-card-form-input js-sv-wc-payment-gateway-credit-card-form-account-number"
                                                                                                                    name="wc-moneris-account-number"
                                                                                                                    id="wc-moneris-account-number"
                                                                                                                    placeholder="•••• •••• •••• ••••"
                                                                                                                    value=""
                                                                                                                    autocomplete="cc-number"
                                                                                                                    autocorrect="no"
                                                                                                                    autocapitalize="no"
                                                                                                                    spellcheck="no"
                                                                                                                    maxlength="20"
                                                                                                                />
                                                                                                            </span>
                                                                                                        </p>
                                                                                                        <p
                                                                                                            class="form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field"
                                                                                                            id="wc-moneris-expiry_field"
                                                                                                            data-priority=""
                                                                                                        >
                                                                                                            <label for="wc-moneris-expiry" class="">Expiration (MM/YY)&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                            <span class="woocommerce-input-wrapper">
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    class="input-text js-sv-wc-payment-gateway-credit-card-form-input js-sv-wc-payment-gateway-credit-card-form-expiry"
                                                                                                                    name="wc-moneris-expiry"
                                                                                                                    id="wc-moneris-expiry"
                                                                                                                    placeholder="MM / YY"
                                                                                                                    value=""
                                                                                                                    autocomplete="cc-exp"
                                                                                                                    autocorrect="no"
                                                                                                                    autocapitalize="no"
                                                                                                                    spellcheck="no"
                                                                                                                />
                                                                                                            </span>
                                                                                                        </p>
                                                                                                        <p
                                                                                                            class="form-row form-row-last validate-required woocommerce-invalid woocommerce-invalid-required-field"
                                                                                                            id="wc-moneris-csc_field"
                                                                                                            data-priority=""
                                                                                                        >
                                                                                                            <label for="wc-moneris-csc" class="">Card Security Code&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                                                                            <span class="woocommerce-input-wrapper">
                                                                                                                <input
                                                                                                                    type="tel"
                                                                                                                    class="input-text js-sv-wc-payment-gateway-credit-card-form-input js-sv-wc-payment-gateway-credit-card-form-csc"
                                                                                                                    name="wc-moneris-csc"
                                                                                                                    id="wc-moneris-csc"
                                                                                                                    placeholder="CSC"
                                                                                                                    value=""
                                                                                                                    autocomplete="off"
                                                                                                                    autocorrect="no"
                                                                                                                    autocapitalize="no"
                                                                                                                    spellcheck="no"
                                                                                                                    maxlength="4"
                                                                                                                />
                                                                                                            </span>
                                                                                                        </p>
                                                                                                        <div class="clear"></div>
                                                                                                        <p class="form-row woocommerce-validated">
                                                                                                            <input
                                                                                                                name="wc-moneris-tokenize-payment-method"
                                                                                                                id="wc-moneris-tokenize-payment-method"
                                                                                                                class="js-sv-wc-tokenize-payment method js-wc-moneris-tokenize-payment-method"
                                                                                                                type="checkbox"
                                                                                                                value="true"
                                                                                                                style="width: auto;"
                                                                                                            />
                                                                                                            <label for="wc-moneris-tokenize-payment-method" style="display: inline;">Securely Save to Account</label>
                                                                                                        </p>
                                                                                                        <div class="clear"></div>
                                                                                                    </div>
                                                                                                    <!-- ./new-payment-method-form-div -->
                                                                                                </fieldset>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                    <div class="form-row place-order">
                                                                                        <noscript>
                                                                                            Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your
                                                                                            order. You may be charged more than the amount stated above if you fail to do so. <br />
                                                                                            <button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals">Update totals</button>
                                                                                        </noscript>

                                                                                        <div class="woocommerce-terms-and-conditions-wrapper">
                                                                                            <p class="form-row validate-required">
                                                                                                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                                                                                    <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms" id="terms" />
                                                                                                    <span class="woocommerce-terms-and-conditions-checkbox-text">
                                                                                                        By clicking ‘Pay Now’, you're agreeing to our
                                                                                                        <a href="./terms-conditions/" class="woocommerce-terms-and-conditions-link" target="_blank">
                                                                                                            terms and conditions
                                                                                                        </a>
                                                                                                    </span>
                                                                                                    &nbsp;<span class="required">*</span>
                                                                                                </label>
                                                                                                <input type="hidden" name="terms-field" value="1" />
                                                                                            </p>
                                                                                            <div class="woocommerce-privacy-policy-text">
                                                                                                <p>
                                                                                                    Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in
                                                                                                    our <a href="./privacy-policy/" class="woocommerce-privacy-policy-link" target="_blank">privacy policy</a>.
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="woocommerce-terms-and-conditions" style="display: none; max-height: 200px; overflow: auto;">
                                                                                                <h2>Application of this Agreement</h2>
                                                                                                <p>THE FOLLOWING DESCRIBES THE TERMS AND CONDITIONS APPLICABLE TO THE USE OF THE DIRECT VISION SITE AND RECEIPT OF RELATED SERVICES.</p>
                                                                                                <p>
                                                                                                    The terms and conditions of this agreement (the “Agreement”) will govern the relationship between Direct Vision and its affiliates and the
                                                                                                    individual or company or other entity (the “Customer”) who uses the associated website and in connection with all related services
                                                                                                    (collectively, the “Direct Vision Site”).
                                                                                                </p>
                                                                                                <p>
                                                                                                    BY ACCESSING OR USING ANY OF THE DIRECT VISION SITE YOU ARE AGREEING TO BE BOUND BY THE TERMS OF THIS AGREEMENT. IF YOU DO NOT AGREE WITH
                                                                                                    THE TERMS SET OUT IN THIS AGREEMENT YOU MAY NOT ACCESS OR USE ANY OF DIRECT VISION SITE.
                                                                                                </p>
                                                                                                <p>
                                                                                                    This Agreement and the rights and obligations of the parties involved, including all non-contractual obligations arising under or in
                                                                                                    connection with this Agreement, shall be governed by and construed in accordance with the laws of the Province of British Columbia, Canada,
                                                                                                    without regard to choice or conflicts of law rules. In the event of a dispute, claim or controversy arising out of or relating to this
                                                                                                    Agreement, you irrevocably consent to submit to the exclusive jurisdiction of the courts of the Province of British Columbia for any claim,
                                                                                                    proceeding or action under the Terms of Service, except for any claim, proceeding or action by Direct Vision or its affiliates for equitable
                                                                                                    relief.
                                                                                                </p>
                                                                                                <h2>Customer’s licence to the direct vision site</h2>
                                                                                                <p>
                                                                                                    Direct Vision hereby grants, and the Customer hereby accepts, subject to the Terms and Conditions of this Agreement, a non-assignable and
                                                                                                    non-exclusive license to access the Direct Vision website. The Customer shall not permit any other party to access or use the Direct Vision
                                                                                                    site using the Customer’s user ID or password. The Customer will be completely responsible for any use of their user ID or passwords by any
                                                                                                    party other than themselves. The Customer agrees to keep all user IDs and passwords secret and safe. Direct Vision may monitor the
                                                                                                    Customer’s use of the Direct Vision site to ensure compliance with this Agreement. No copy of any software or any source code will be made
                                                                                                    available or delivered to the Customer.
                                                                                                </p>
                                                                                                <h2>Accurate Information</h2>
                                                                                                <p>
                                                                                                    In order to purchase any Product, some personal information may be required from the Customer in order to complete the transaction and
                                                                                                    ensure that the order has been fulfilled correctly. The Customer agrees to (a) provide true, accurate, current and complete information as
                                                                                                    requested and (b) promptly update this information as required to keep it true, accurate, current and complete.
                                                                                                </p>
                                                                                                <h2>Valid Prescription</h2>
                                                                                                <p>
                                                                                                    For certain Products, you must provide a valid prescription. You hereby agree not to order any Product that requires a valid prescription
                                                                                                    unless you have a valid prescription, provided by an Optometric/Medical professional. You hereby ensure and warrant to Direct Vision, by
                                                                                                    placing your order, that any information provided to Direct Vision matches a valid prescription given by an appropriate licensed healthcare
                                                                                                    professional. Furthermore, Direct Vision is hereby authorized to contact your professional eye care provider to confirm the veracity of
                                                                                                    information provided by you and to inquire about any other information that may otherwise be of relevance.
                                                                                                </p>
                                                                                                <h2>Product Descriptions</h2>
                                                                                                <p>
                                                                                                    Direct Vision has made every possible effort to provide the Customer with accurate depictions of the Products’ colour, physical dimensions,
                                                                                                    shape and make. However, Direct Vision does not guarantee that the colours, product descriptions and images of the Products on the Direct
                                                                                                    Vision are accurate, complete, current or error-free. If you purchase a Product and the Product does not match the colours, product
                                                                                                    descriptions and images on the Direct Vision Site, your sole remedy and recourse is to return the Product in accordance with our return
                                                                                                    policy.
                                                                                                </p>
                                                                                                <h2>Fees and Payment</h2>
                                                                                                <p>
                                                                                                    If you order any Product from the Direct Vision site, you agree to pay for the same, including all taxes, in accordance with the terms of
                                                                                                    payment set out at the time of purchase.
                                                                                                </p>
                                                                                                <h2>Prohibitions</h2>
                                                                                                <p>Customer shall not, in respect of the Direct Vision site:</p>
                                                                                                <ul>
                                                                                                    <li>
                                                                                                        Deposit or process any Customer Data which infringes or potentially infringes any third party intellectual property or proprietary
                                                                                                        rights including without limitation, copyright, patent, trademark or trade secret, right of publicity or privacy;
                                                                                                    </li>
                                                                                                    <li>Deposit or process any Customer Data in violation of any applicable laws;</li>
                                                                                                    <li>
                                                                                                        Deposit or process any Customer Data which is harmful or potentially harmful including, without limitation, that which places the
                                                                                                        integrity or security of any computer system at risk or which is or contains a virus, Trojan horse, worm, time bomb or other harmful or
                                                                                                        invasive computer program or file;
                                                                                                    </li>
                                                                                                    <li>
                                                                                                        Undertake any activity which creates liability or damage or potentially creates liability or damage to Direct Vision, any Supplier or
                                                                                                        any other user or creates damage or potentially creates damage to the Direct Vision site or the computer systems or data of Direct
                                                                                                        Vision, any Supplier or any other user; or
                                                                                                    </li>
                                                                                                    <li>Undertake any activity which creates undue burden or interferes with the Direct Vision site or its use by other users.</li>
                                                                                                </ul>
                                                                                                <p>
                                                                                                    The Customer shall not attempt to circumvent any security measure implemented in the Direct Vision site or attempt to gain access to any
                                                                                                    portion of the Direct Vision site other than that which is needed to access and use the Direct Vision site for the express purpose of
                                                                                                    browsing or purchasing glasses.
                                                                                                </p>
                                                                                                <p>
                                                                                                    In the event any activity of Direct Vision arises in connection with any activities of the Customer which is in breach of this section, then
                                                                                                    the Customer will pay Direct Vision its fees for the time spent by Direct Vision personnel on such activities on a time, expense and
                                                                                                    materials at the standard rates provided by Direct Vision for the same.
                                                                                                </p>
                                                                                                <h2>Support and Maintenance</h2>
                                                                                                <p>
                                                                                                    Direct Vision shall provide email support with respect to the use of and access to the Direct Vision site during the hours of 9 a.m. to 4:30
                                                                                                    p.m. EST Monday to Friday, excluding statutory holidays observed by Direct Vision at the company’s discretion. Direct Vision may change the
                                                                                                    hours and days of support without notice or reason.
                                                                                                </p>
                                                                                                <p>Direct Vision reserves the right to limit this support in the event the Customer is misusing or straining support services.</p>
                                                                                                <p>
                                                                                                    Direct Vision may, in its sole discretion, correct defects and errors in the Direct Vision site. The Customer acknowledges and agrees that
                                                                                                    the Customer’s sole remedy and recourse in connection with any defect or error in the Direct Vision site or any failure to correct the same
                                                                                                    is for the Customer to cease all use of the Direct Vision website.
                                                                                                </p>
                                                                                                <p>Direct Vision may occasionally update the Direct Vision site, which will render the site unusable for a short period of time.</p>
                                                                                                <h2>Security</h2>
                                                                                                <p>
                                                                                                    Direct Vision will protect the Site and Customer Data against unauthorized access within reason, through use of industry standard security
                                                                                                    technology. However, the Customer acknowledges and agrees that applications and systems which are made available over the Internet are
                                                                                                    inherently insecure Direct Vision and its Suppliers shall have no obligation or liability to the Customer for any breach of security
                                                                                                    measures.
                                                                                                </p>
                                                                                                <h2>Data</h2>
                                                                                                <p>
                                                                                                    Customer hereby authorizes Direct Vision to conduct all activities required under this Agreement including storing, reproducing and
                                                                                                    processing the Customer Data and the use, disclosure and transmission of the same pursuant to and in connection with the Direct Vision Site
                                                                                                    and such other tasks, duties or activities reasonably necessary to carry out the intent of this Agreement.
                                                                                                </p>
                                                                                                <h2>Personal Information</h2>
                                                                                                <p>
                                                                                                    Direct Vision may use your information in order to customize the Site to the needs of the Customer and enhance the overall experience of our
                                                                                                    applications for other Customers. Direct Vision may release personal information if required by law or in the good-faith belief that such
                                                                                                    action is necessary or appropriate.
                                                                                                </p>
                                                                                                <h2>Links to third party sites</h2>
                                                                                                <p>
                                                                                                    This Website may contain hyperlinks to websites operated and owned by parties other than Direct Vision Such hyperlinks are provided solely
                                                                                                    for your reference only and Direct Vision makes no representations or warranties with respect to such sites or the contents contained
                                                                                                    therein. Any hyperlinks to third party websites do not imply any endorsement of the material contained therein or any association to the
                                                                                                    respective operators and owners of same.
                                                                                                </p>
                                                                                                <h2>Product Warranty</h2>
                                                                                                <p>
                                                                                                    Direct Vision provides the highest quality products available and therefore warranties against manufacturers defects for a period of 365
                                                                                                    days from the time of delivery. In the event of a problem please contact our customer service department obtain a return label to facilitate
                                                                                                    a refund or exchange.
                                                                                                </p>
                                                                                                <h2>Warranty disclaimer, limitation of liability and liability disclaimer</h2>
                                                                                                <p>
                                                                                                    Direct Vision does not represent or warrant that all defects and errors in the Direct Vision Site, the Services can or will be corrected.
                                                                                                    Direct Vision and its Suppliers shall have no liability or obligation to Customer or any third party in the event of any defect or error or
                                                                                                    any omission in the Direct Vision Site or the Services.
                                                                                                </p>
                                                                                                <p>
                                                                                                    THE DIRECT VISION SITE AND SERVICES ARE PROVIDED STRICTLY ON AN “AS IS” AND “AS AVAILABLE” BASIS. EXCEPT AS OTHERWISE EXPLICITLY SET OUT
                                                                                                    HEREIN, DIRECT VISION DISCLAIMS ANY AND ALL WARRANTIES AND CONDITIONS CONCERNING THE DIRECT VISION SITE , ALL PRODUCTS AND THE SERVICES,
                                                                                                    INCLUDING ANY AND ALL WARRANTIES AND CONDITIONS OF DESIGN, MERCHANTABILITY AND FITNESS FOR ANY PARTICULAR PURPOSE, PERFORMANCE AND ANY AND
                                                                                                    ALL WARRANTIES AND CONDITIONS THAT MIGHT OTHERWISE ARISE DURING THE COURSE OF DEALING, CUSTOM OR TRADE USAGE AND THOSE WHICH MAY BE IMPLIED
                                                                                                    BY STATUTE.
                                                                                                </p>
                                                                                                <p>
                                                                                                    UNDER NO CIRCUMSTANCES SHALL DIRECT VISION OR ANY OF ITS SUPPLIERS BE LIABLE FOR ANY INCIDENTAL, SPECIAL, INDIRECT OR CONSEQUENTIAL DAMAGES
                                                                                                    OR LOSS OF PROFITS, INTERRUPTION OF BUSINESS OR RELATED EXPENSES INCURRED OR SUFFERED BY CUSTOMER WHICH MAY ARISE IN CONNECTION WITH THE USE
                                                                                                    OR INABILITY TO USE THE SITE, ANY PRODUCT OR SERVICES, OR ANY DEFECT OR ERROR IN THE SITE, ANY PRODUCT OR SERVICES, WHETHER OR NOT DIRECT
                                                                                                    VISION OR ANY OF ITS SUPPLIERS WAS TOLD OF OR KNEW OF OR OUGHT TO HAVE REASONABLY KNOWN OF THE POSSIBILITY OF SUCH LOSS, DAMAGE OR INJURY
                                                                                                    AND INCLUDING BUT NOT LIMITED TO THOSE RESULTING FROM DEFECTS IN THE SITE, ANY PRODUCT OR SERVICES OR LOSS OR INACCURACY OF DATA OF ANY KIND
                                                                                                    OR INCORRECT RESULTS PRODUCED BY THE SITE, ANY PRODUCT OR SERVICES. BECAUSE SOME STATES AND PROVINCES DO NOT ALLOW THE EXCLUSION OR
                                                                                                    LIMITATION OF LIABILITY FOR CONSEQUENTIAL OR INCIDENTAL DAMAGES, IN SUCH STATES AND PROVINCES LIABILITY IS LIMITED TO THE FULLEST EXTENT
                                                                                                    PERMITTED BY LAW.
                                                                                                </p>
                                                                                                <p>
                                                                                                    DIRECT VISION AND ITS SUPPLIERS’ COLLECTIVE LIABILITY UNDER THIS AGREEMENT AND IN CONNECTION WITH THE USE OF THE SITE, ANY PRODUCT OR THE
                                                                                                    SERVICES, OR ANY DEFECT OR ERROR IN THE SITE, ANY PRODUCT OR SERVICES, UNDER ANY AND ALL CIRCUMSTANCES, ARISING IN ANY MANNER WHATSOEVER,
                                                                                                    SHALL BE LIMITED TO THE AMOUNTS ACTUALLY PAID BY CUSTOMER TO DIRECT VISION FOR PRODUCTS ORDERED IN THE 365 DAY PERIOD IMMEDIATELY PRECEDING
                                                                                                    THE FINAL ACT OR EVENT WHICH GAVE RISE TO ANY SUCH LIABILITY. ALL SUCH LIABILITIES SHALL, IN AGGREGATE, BE SUBJECT TO THE DESCRIBED
                                                                                                    LIMITATION. THIS LIMITATION SHALL APPLY TO ALL CAUSES OF ACTION IN THE AGGREGATE, INCLUDING WITHOUT LIMITATION, TO BREACH OF CONTRACT,
                                                                                                    BREACH OF WARRANTY, NEGLIGENCE, STRICT LIABILITY, MISREPRESENTATIONS AND OTHER TORTS, NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF
                                                                                                    ANY REMEDY.
                                                                                                </p>
                                                                                                <h2>General</h2>
                                                                                                <p>
                                                                                                    <u>Survival.</u> The rights and obligations under Security, Data, Personal Information, Your Submissions, Title, Warranty Disclaimer,
                                                                                                    Limitation of Liability and Liability Disclaimer, Basis of Bargain, Survival and Attornment shall survive the termination of this Agreement
                                                                                                    for whatever reason. Termination does not relieve any party of any liability accruing at the date of termination including, without
                                                                                                    limitation, any fees due.
                                                                                                </p>
                                                                                                <p>
                                                                                                    <u>Suppliers.</u> All Suppliers shall be entitled to all remedies, disclaimers of warranty, disclaimers of liability, limitations of
                                                                                                    liability and other provisions herein which indicate as being in favour of Suppliers, including without limitation, under the Warranty
                                                                                                    Disclaimer, Limitation of Liability and Liability. Customer agrees that all Suppliers shall be, as applicable: (i) entitled to raise any
                                                                                                    such disclaimers of warranty, disclaimers of liability and limitations of liability in defence of any claim by Customer; and (ii) entitled
                                                                                                    to any such remedy. Customer agrees that each Supplier shall be a third party beneficiary under this Agreement for the sole purposes of the
                                                                                                    foregoing and that Suppliers would not be suppliers in connection with the Direct Vision and/or the Services if they were not entitled to
                                                                                                    the benefits of the foregoing.
                                                                                                </p>
                                                                                                <p><u>Waiver.</u> A party’s failure or delay in exercising any right under this Agreement will not operate as a waiver of that right.</p>
                                                                                                <p>
                                                                                                    <u>Headings.</u> All captions and headings in this Agreement are for purposes of convenience only and shall not affect the construction or
                                                                                                    interpretation of any of its provisions.
                                                                                                </p>
                                                                                                <p>
                                                                                                    Entire Agreement. This Agreement sets forth the entire agreement and understanding between the parties and supersede and cancel all previous
                                                                                                    negotiations, agreements, commitments and writings in respect of the subject-matter hereof and there are no understandings, representations,
                                                                                                    conditions made or assumed by the parties, other than those expressly contained in this Agreement.
                                                                                                </p>
                                                                                                <p>
                                                                                                    <u>Severability.</u> If any term, covenant or condition of this Agreement or the application thereof to any party or circumstance shall be
                                                                                                    invalid or unenforceable to any extent the remainder of this Agreement and the application of such term, covenant or condition to a party or
                                                                                                    circumstance other than those to which it is held invalid or unenforceable shall not be affected thereby and each remaining term, covenant
                                                                                                    or condition of this Agreement shall be valid and shall be enforceable to the fullest extent permitted by law.
                                                                                                </p>
                                                                                                <p>
                                                                                                    <u>Governing Law.</u> This Agreement will be governed by and interpreted and enforced in accordance with the laws of the Province of British
                                                                                                    Columbia and the federal laws of Canada applicable therein.
                                                                                                </p>
                                                                                                <p>
                                                                                                    <u>Attornment.</u> The parties do hereby agree to submit and attorn to the exclusive jurisdiction of the Courts of British Columbia for all
                                                                                                    matters arising out of or relating to this Agreement. Notwithstanding the foregoing, any party may apply to any court of competent
                                                                                                    jurisdiction for any equitable relief by way of restraining order, injunction, decree, specific performance, mandatory injunction or
                                                                                                    otherwise where damages could not adequately be compensated by monetary award and where the Courts of British Columbia would not have
                                                                                                    adequate jurisdiction to grant an effective equitable remedy.
                                                                                                </p>
                                                                                                <p>
                                                                                                    <u>Rights and Remedies.</u> The rights and remedies of a party hereunder are cumulative and no exercise or enforcement by a party of any
                                                                                                    right or remedy hereunder shall preclude the exercise or enforcement by the party of any other right or remedy hereunder or which the party
                                                                                                    is otherwise entitled by law or equity.
                                                                                                </p>
                                                                                                <h2>Definitions</h2>
                                                                                                <p>In this Agreement, the following terms shall have the indicated meaning:</p>
                                                                                                <p><strong>“Customer Data”</strong> means any data or information which Customer creates on or provides to the Direct Vision Site.</p>
                                                                                                <p><strong>“Personal Information”</strong> means any information about any identifiable individual including.</p>
                                                                                                <p>
                                                                                                    <strong>“Product”</strong> means any product that is made available from the Direct Vision Site, including contact lenses, glasses and
                                                                                                    related products.
                                                                                                </p>
                                                                                                <p>
                                                                                                    <strong>“Service”</strong> means any service provided for the benefit of Customer in connection with this Agreement or in connection with
                                                                                                    the Direct Vision Site including, without limitation, the maintenance and support services, the delivery of any Product purchased and
                                                                                                    “Service” also includes the functionality of and the computer processing provided by the Direct Vision Site.
                                                                                                </p>
                                                                                                <p><strong>“Site”</strong> refers to the website for Direct Vision.</p>
                                                                                                <p>
                                                                                                    <strong>“Supplier”</strong> means any licensor, supplier or service provider that: (i) provides any services in connection with the Direct
                                                                                                    Vision Site or any Services, or (ii) developed or licenses any part of the Direct Vision Site.
                                                                                                </p>
                                                                                                <p></p>
                                                                                            </div>
                                                                                        </div>

                                                                                        

                                                                                        <input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="0a1cbe44c2" />
                                                                                        <input type="hidden" name="_wp_http_referer" value="/?wc-ajax=update_order_review" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        
    																		<style type="text/css">
    																		 #order_review1{
    																		   display:none;
    																		 }
    																		 #fl-main-content form.woocommerce-checkout .form-row {
                                                                                    padding: 0 11px 0 0 !important;
                                                                                    float: left;
                                                                                }
    																		</style>
    																		</form>
                                                                            <div id="order_review" class="woocommerce-checkout-review-order">
                                                                                <div class="checkout-items">
                                                                                    <h3 id="order_review_heading">Order Summary</h3>
    
                                                                                    <table class="shop_table woocommerce-checkout-review-order-table">
                                                                                        <tbody>
                                                                                            
                                                                                            <?php  
                                                                                            foreach($_SESSION['product_id'] as $pidinfo){
                                                                                                
                                                                                                $pid = $pidinfo['id'];

                                                                        	$sql ="SELECT * FROM glassBuy_glass_picture WHERE glass_id='$pid'";
                                                                                  $img_data = $con->query($sql);
                                                                                  if($img_data->num_rows > 0){
                                                                                      $rows = $img_data->fetch_assoc();
                                                                                      $img = $rows['name'];
                                                                                  }
                                                                        	
                                                                        	$pro ="SELECT * FROM glassBuy_glasses WHERE glass_id='$pid'";
                                                                                $product_data = $con->query($pro);
                                                                                if($product_data->num_rows > 0){
                                                                                   $rowd = $product_data->fetch_assoc();
                                                                                   $p_name = $rowd['title'];
                                                                                   $p_price = $rowd['price'];
                                                                        		   $desc = $rowd['additional_info'];
                                                                                }?>
                                                                                            <tr class="cart_item">
                                                                                                <td class="product-name"><?php  echo $p_name?><strong class="product-quantity">×&nbsp;1</strong></td>
                                                                                                <td class="product-total">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php  echo $p_price?></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <?php  }?>
                                                                                            <style>
                                                                                                .woocommerce #order_review .woocommerce-checkout-review-order-table tbody tr:last-child td {
                                                                                                    width: 50%;
                                                                                                    float: left;
                                                                                                }
                                                                                            </style>
                                                                                            <?php  if($Prescription_Lenses_cost_total!=0){?>
                                                                                            <tr class="cart_item">
                                                                                                <td class="product-name">Prescription Lenses&nbsp; <strong class="product-quantity">×&nbsp;1</strong></td>
                                                                                                <td class="product-total">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php  echo $Prescription_Lenses_cost_total?>.00</bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <?php  }?>
                                                                                            
                                                                                            <!--<tr class="cart_item component_container_table_item">
                                                                                                <td class="product-name">&nbsp; <strong class="product-quantity">×&nbsp;1</strong></td>
                                                                                                <td class="product-total">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span>.00</bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            -->
                                                                                        </tbody>
                                                                                        <tfoot>
                                                                                            
                                                                                            <?php  
                                                                                            // var_dump($myaccessories);
                                                                                            
                                                                                            foreach($myaccessories as $ass){?>
                                                                                            <tr class="cart-subtotal">
                                                                                                <th><?php  echo $ass[0]?> x <?php  echo $ass[2]?></th>
                                                                                                <td>
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php  echo $ass[1] * $ass[2]?></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <?php  }?>
                                                                                            
                                                                                            <tr class="cart-subtotal">
                                                                                                <th>Subtotal</th>
                                                                                                <td>
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php  echo $subbtotal?></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            
    
                                                                                            <tr class="woocommerce-shipping-totals shipping">
                                                                                                <th>
                                                                                                    Shipping<br />
                                                                                                </th>
                                                                                                <td data-title="Shipping">$<span class="woocommerce-Price-amount amount">9</span></td>
                                                                                            </tr>
                                                                                            <tr class="woocommerce-shipping-totals shipping">
                                                                                                <th>
                                                                                                    Discount<br />
                                                                                                </th>
                                                                                                <td data-title="Shipping">$<span class="woocommerce-Price-amount amount"><?php  echo $discount?></span></td>
                                                                                            </tr>
                                                                                            
                                                                                            
    
                                                                                            <tr class="tax-total">
                                                                                                <th>Tax</th>
                                                                                                <td>
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php  echo $tax;?></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
    
                                                                                            <tr class="order-total">
                                                                                                <th>Order Total</th>
                                                                                                <td>
                                                                                                    <strong>
                                                                                                        <input name="total" value="<?php  echo round(($tax+ $subbtotal + 9+$assTotal) - $discount, 2)?>" hidden>
                                                                                                        <span class="woocommerce-Price-amount amount">
                                                                                                            <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php  echo round(($tax+ $subbtotal + 9+$assTotal) - $discount, 2)?></bdi>
                                                                                                        </span>
                                                                                                    </strong>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tfoot>
                                                                                    </table>
                                                                                </div>
                                                                                <form action="" method="post">
                                                                                 <div class="coupon">
                                                                                    <label for="coupon_code">Have a coupon code?</label>
                                                                                    <div class="coupon-fields" style="display: none;">
                                                                                        <input type="text" name="coupon" class="input-text" id="coupon_code" value="" placeholder="Enter code here">
                                                                                        <button type="submit" class="button" name="apply" value="Apply">Apply</button>
                                                                                    </div>
                                                                                </div>
                                                                                </form>
                                                                                <?php  if($m!=""){?>
                                                                        <div class="woocommerce-message" role="alert">
                                                                    		<?php  echo $m?>
                                                                    		</div>
                                                                        <?php  }?>
                                                                        
    
                                                                                <!--<div class="extra-info">
            <ul class="nonlist">
                <li>
                    <img src="./wp-content/uploads/2020/05/icon-phone.png" alt="Phone Icon">
                    <div class="txt">
                        <strong class="title">Need Help?</strong>
                        <span class="value">Call us at <strong><a style="color:inherit;" href="mailto:855-486-7846">855-486-7846</a></strong></span>
                    </div>
                </li>
                <li>
                    <img src="./wp-content/uploads/2020/05/icon-van.png" alt="Box Icon">
                    <div class="txt">
                        <strong class="title">Free <span>Shipping & Returns</span></strong>
                        <span class="value">Easy return, we will provide returns label</span>
                    </div>
                </li>
                <li>
                    <img src="./wp-content/uploads/2020/05/icon-money.png" alt="Money Icon">
                    <div class="txt">
                        <strong class="title">30 Day <span>Money Back Guaranteed</span></strong>
                        <span class="value">We'll make it right or your money back</span>
                    </div>
                </li>
            </ul>
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
<?php require("./includes/comman/checkout/footerjs.php");?>
<!-- WooCommerce JavaScript -->
</body>
</html>

