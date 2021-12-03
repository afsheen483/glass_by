<?php 
include_once("global.php");
/*
if($logged==0){
?><script>window.location="./"</script><?php 
}
*/
/*get Clients a*/
// $getGlasses_sql = "SELECT * FROM `glassBuy_glasses` ORDER BY `created_at` DESC";
// $getGlasses = getAll($con,$getGlasses_sql);
/*end of get Clients*/

$orderId = $_GET['pId'];
$prescriptionDeets = getAll($con, "SELECT * from glassBuy_prescription where order_id='$orderId';")[0];
$orderDeets = getAll($con, "SELECT *, o.id order_id from glassBuy_order o inner join glassBuy_glasses g on g.glass_id=o.product_id where o.id='$orderId' ")[0];
$productId = $orderDeets['product_id'];
//echo($orderId);
//die();
$orderDetailsDeets = getAll($con, "SELECT * from glassBuy_order_details where order_id='$orderId'")[0];
//$productDeets = getAll($con, "SELECT * from glassBuy_glasses where glass_id='$productId'")[0];
$productDeets = getAll($con, "SELECT g.*,p.name from glassBuy_glasses g JOIN glassbuy_glass_picture p ON p.glass_id = g.glass_id where g.glass_id='$productId'")[0];
 //var_dump($productDeets);


//dd($frame_row);

//die();





$myaccessories = array();
$rows = getAll($con, "select * from glassBuy_order_accessories a inner join glassBuy_glasses g on g.glass_id=a.accessoryId where orderId='$orderId'");
foreach($rows as $row){
    $myaccessories[$row['accessoryId']] = array($row['title'], $row['price']);
}

if(isset($_GET['print']) && !isset($_GET['norecurs'])){
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."&norecurs=1&filehash=".$filehash;


    $key = "c7nTivtay4QGoyGG";
    $url = "https://v2.convertapi.com/convert/web/to/pdf?Secret=$key&Url=".urlencode($actual_link)."&StoreFile=true&ViewportWidth=1200&Background=false&PageOrientation=landscape";
    // echo $url;
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $return = curl_exec($ch);
    $return = json_decode($return, true);
    if($return['Code']!=""){
        $code= ($return['Code']);
    }

    $content = $return['Files'][0]['Url'];
            
            
    if(!isset($_GET['norecurs'])){
        	    

        	    ?>
                <script>window.open('<?php echo $content?>', '_blank'); </script>
                <?php 
            
        	}
            
}

if (isset($_POST['order_submit'])) {
    $lens_type = $_POST['lens_type'];
    $vision = $_POST['vision'];
    $uv_protection = $_POST['uv_protection'];
    $id = $_GET['id'];
    $query = "UPDATE `glassbuy_order_details` SET `vision`='$vision',`lensType`='$lens_type',`uv_protection`='$uv_protection' WHERE `order_id` = '$id'";
    $fire = mysqli_query($con,$query);
    if ($fire) {
        setFlash("error","Updated Successfully.","alert-success");
        header('Location: http://localhost/glassBuy/view_order.php?id='.$id);

        exit;
        }else{
            setFlash("error","Something went wrong, Please try again.","alert-danger");
            header('Location: http://localhost/glassBuy/view_order.php?id='.$id);

            exit;
        }
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    
    <style type="text/css" media="print">
  @page { size: landscape; }
</style>
<?php 
if(!isset($_GET['print'])){
}
require("./includes/head.php");

?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
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
<?php if(!isset($_GET['print'])){require("./includes/header.php");}?>
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
    
</div>
</div>
</div>
</div>
<div class="fl-module fl-module-rich-text fl-node-5ec37624db6e7" data-node="5ec37624db6e7">
<div class="fl-module-content fl-node-content">
<div class="fl-rich-text">
<div>
<div class="woocommerce">


            <div class="woocommerce-MyAccount-content" style="width: 100%;
padding-left: 0px;
margin: 0;">
                <div class="woocommerce-notices-wrapper"></div>
                
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
                
                <?php if(isset($_GET['thankyou'])){?>
                <h3 class="heading-title" style="    text-align: center;
    font-size: 20px;">
                    <span class="title-text pp-primary-title">Thank you for placing your order with us. Your order details are as follows.</span>
                </h3>
                  
                    <?php
                      $order_id = $_GET['id'];
                      $order_data = "SELECT g.*,d.fname,d.lname,d.address,d.postal_code,d.total FROM glassbuy_order_details d JOIN glassbuy_glasses g ON g.glass_id = d.product_id WHERE `order_id` = '$order_id'";
                      $order_fire = mysqli_query($con,$order_data);
                      
                 include_once('class/class.phpmailer.php');

                 require_once('class/class.smtp.php');
                
            //     $name = "Afsheen";
            //     $email = "Afsheenakhtar483@gmail.com";
            //     $subject = "Order Placement";
            //     $msg = "Hi! your order has been confirmend";
                
              $mail = new PHPMailer();
            //     $mail->IsSMTP();
            //    // $mail->CharSet = 'UTF-8';
                
            //     $mail->Host       = "smtp.gmail.com"; // SMTP server example
            //     //$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
            //     $mail->SMTPAuth   = true;                  // enable SMTP authentication
            //     $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
            //     $mail->Username   = "Eazisols"; // SMTP account username example
            //     $mail->Password   = "Developer@123";        // SMTP account password example
                
            //     $mail->From = "restock06@gmail.com";
            //     $mail->FromName = $name;
                
            //     $mail->AddAddress('afsheenakhtar483@gmail.com', 'Information'); 
            //     //$mail->AddReplyTo($email, 'Wale');
                
            //     $mail->IsHTML(true);
                
            //     $mail->Subject = $subject;
                
            //     $mail->Body    =  $msg;
            //     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
            //     if(!$mail->Send()) {
            //     echo 'Message could not be sent.';
            //     echo 'Mailer Error: ' . $mail->ErrorInfo;
            //     echo "<br>";
            //     }
          //  $mail->SMTPDebug  = 1; 
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'restock06@gmail.com'; // SMTP username
            $mail->Password = 'Developer@123'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to
            $mail->setFrom('restock06@gmail.com', 'epgpathshahla');
            $mail->addReplyTo('restock06@gmail.com', 'epgpathshala');
            $mail->addAddress('afsheenakhtar483@gmail.com'); // Add a recipient
            $mail->From = 'restock06@gmail.com';
            $mail->isHTML(true); // Set email format to HTML
           // $bodyContent = '<div class="container"><div class="row"><div class="col-4"><h3>OLA EYEWEAR </h3>';
            $bodyContent = '<div class="row" style="margin-left:5%;margin-right:5%">
            <div class="col-xs-12">
                <div class="invoice-title">
                   <h4 class="pull-right" style="font-size: 28px">Order Num # '.$orderId.'</h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-8">
                        <address>
                        <strong>'.$orderDetailsDeets['fname']." ".$orderDetailsDeets['lname'].'</strong><br>
                            '.$orderDetailsDeets['phone'].'<br>
                            '.$orderDetailsDeets['city'].'<br>
                            '.$orderDetailsDeets['province'].'<br>
                            
                            '.$orderDetailsDeets['postal_code'].'<br>
                        </address>
                    </div>
                    <div class="col-xs-4" style="float:right;margin-top:-5%">
                        <address>
                            <strong>Billed To:</strong><br>
                            OLA EYEWEAR<br>
                            XXX ROAD XXX STATE<br>
                            TEL: 808-XXX XXX <br>
                            INFO@OLAGLASSES.COM<br>

                            </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Invoice Date:</strong><br>
                             '.date("F j, Y").'
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                      
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row" style="margin-left:5%;margin-right:5%"> 
            <div class="col-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Item summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed" style="border-top: 2px solid;border-bottom: none;" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <thead style="border-bottom: none;">
                                    <tr style="border-top: 2px solid;border-bottom: none;">
                                        <td style="font-size: 14px;"><strong>Model</strong></td>
                                        <td style="font-size: 14px;"><strong>Size</strong></td>
                                        <td style="font-size: 14px;"><strong>Color</strong></td>
                                        <td style="font-size: 14px;"><strong>Quantity</strong></td>
                                        <td style="font-size: 14px;"><strong>Amount</strong></td>
                                        <td style="font-size: 14px;"><strong>Total</strong></td>
                                        <td style="font-size: 14px;"><strong>Description</strong></td>
                                        <td style="font-size: 14px;"><strong>Type</strong></td>
                                      
                                    </tr>
                                </thead>
                                <tbody style="border-top: 2px solid;">';
                             
                                 while($row = mysqli_fetch_assoc($order_fire)){
                                 
                                
                                    
                                        $bodyContent.='<tr class="td" style="border-top: 2px solid;border-bottom: none;">';
                                        $bodyContent.='<td style="font-size: 14px;">'.$row['model'].'</td>';
                                        $bodyContent.='<td class="text-center p" style="font-size: 14px;">'.$row['available_sizes'].'</td>';
                                        $bodyContent.='<td class="text-center p" style="font-size: 14px;">'.$row['colour'].'</td>';
                                        $bodyContent.='<td class="text-center p" style="font-size: 14px;">1</td>';
                                        $bodyContent.='<td class="text-center p" style="font-size: 14px;">$'.$row['price'].'</td>';
                                        $bodyContent.='<td class="text-center p" style="font-size: 14px;">$'.$row['price'].'</td>';
                                        $bodyContent.='<td class="text-center p" style="font-size: 14px;">'.$row['title'].'</td>';
                                        $bodyContent.='<td class="text-right tp" style="font-size: 14px;">'.$row['productCategory'].'</td>
                                    </tr>';
                                 }
                                     
                                  
                                  
                                    
                                $bodyContent.='</tbody>
                            </table>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        
    </div>';
            // $bodyContent .= '<h3>XXX ROAD XXX STATE </h3>';
            // $bodyContent .= '<h3>TEL: 808-XXX XXX </h3>';
            // $bodyContent .= '<h3>INFO@OLAGLASSES.COM </h3></div>';
            // $bodyContent .= '<div class="col-6" style="float:right"><h3>'.$orderDetailsDeets['fname']." ".$orderDetailsDeets['lname'].'</h3>';
            // $bodyContent .= '<h3>'.$orderDetailsDeets['city']." ".$orderDetailsDeets['province']." ".$orderDetailsDeets['postalcode']." ".$orderDetailsDeets['country'].' </h3>';
            // $bodyContent .= '<h3>'.$orderDetailsDeets['email'].' </h3>';
            // $bodyContent .= '<h3>'.$orderDetailsDeets['phone'].' </h3>';
            // $bodyContent .= '<h3>Order Num # '.$orderId.'</h3></div></div></div>';
            // $bodyContent .= '<br>';
            // $bodyContent .= '<div class="row"><div class="col-12"><table border="1" class="table"><tr><th>Model</th><th>Size</th><th>Color</th><th>Quantitys</th><th>Amount</th><th>Total Amount</th><th>Description</th></tr></table></div></div>';
           
            $mail->Subject = 'OLA EYEWEAR';
            $mail->Body = $bodyContent;
            if(!$mail->send()) {
             echo 'Message could not be sent.';
             echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
            // echo 'Message has been sent';
            }
                    ?>
                <?php }?>
                <h2 class="heading-title" style="    text-align: center;
    font-size: 30px;">

                    <?php
                   
                    //  if(isset($_GET['pId'])){
                        ?>
                            <!-- <span class="title-text pp-primary-title">Thanks For Ordering</span> -->

                        <?php
                   // } ?>
                    <span class="title-text pp-primary-title">ORDER ID # <?php echo $orderId?></span>
                </h2>
                
                <?php if(!isset($_GET['print'])){?>
                
                 <a target="_blank" class="button" href="?id=<?php echo $_GET['id']?>&print=<?php echo $_GET['id']?>" style="color:white;">Print</a>
                 
                 
                 <?php }?>
                <div class="row">
                    <div class='col-sm-3'>
                        <h3>Customer Details</h3>
                        <p><b>Firstname: </b><?php echo $orderDetailsDeets['fname']?></p>
                        <p><b>Lastname: </b><?php echo $orderDetailsDeets['lname']?></p>
                        <p><b>DOB: </b></p>
                        <p><b>Shipping Address: </b><?php echo $orderDetailsDeets['city']?> <?php echo $orderDetailsDeets['province']?> <?php echo $orderDetailsDeets['postalcode']?> <?php echo $orderDetailsDeets['country']?></p>
                        <p><b>Email ID: </b><?php echo $orderDetailsDeets['email']?></p>
                        <p><b>Phone Number: </b><?php echo $orderDetailsDeets['phone']?></p>
                        
                        <!-- <h3>Order Details</h3>
                        <p><b>Frame Title: </b>
                        <?php
                        //  echo $orderDetailsDeets['product_name']
                         ?>
                    </p>
                        <p><b>Frame Color: </b><?php 
                        // echo $productDeets['colour']
                        ?></p>
                        <small>
                        <p><span>Lens Type: </span><?php 
                        // echo $orderDetailsDeets['lensType']
                        ?></p>
                        <p><span>Lens Enhancement: </span><?php 
                        // echo $orderDetailsDeets['vision']
                        ?></p> -->
                        
                        
                        <!-- <p>Comments:<br> -->
                        
                        <?php 
                        // echo $orderDeets['order_comments']
                        ?>
                        </p>
                        <hr>
                        <?php foreach($myaccessories as $row){?>
                        <p><span><?php 
                        // echo $row[0]
                        ?> </span><?php 
                            // echo $row[1]
                            ?></p>
                        <?php }
                        
                        $frame_query = "SELECT gp.name,o.user_id,o.name as username,o.email,o.product_id,o.status,o.isPaid,o.total,o.vision,o.lensType,o.order_comments,d.order_id,d.product_name,d.product_price,d.fname,d.lname,d.address,d.city,d.province,d.postal_code,d.phone,d.email,d.country,d.shipping_country,d.vision,p.file_name,d.lensType,d.lensType,d.uv_protection,d.total AS d_total,p.*,g.title,g.colour,g.shape,g.material,g.brand,g.gender,g.available_sizes,g.price,g.cost,g.manufacturer,g.productCategory FROM glassbuy_order o JOIN glassbuy_order_details d ON d.order_id = o.id JOIN glassbuy_prescription p ON p.order_id = o.id JOIN glassbuy_glasses g ON g.glass_id = d.product_id JOIN glassbuy_glass_picture gp ON gp.glass_id = g.glass_id WHERE o.id = '".$orderId."' Group By o.id";
                        $fire_frame = mysqli_query($con,$frame_query);
                        $frame_row = mysqli_fetch_assoc($fire_frame);


                        $frame_only = "SELECT gp.name,o.user_id,o.name as username,o.email,o.product_id,o.status,o.isPaid,o.total,o.vision,o.lensType,o.order_comments,d.order_id,d.product_name,d.product_price,d.fname,d.lname,d.address,d.city,d.province,d.postal_code,d.phone,d.email,d.country,d.shipping_country,d.vision,d.lensType,d.lensType,d.uv_protection,d.total AS d_total,g.title,g.colour,g.shape,g.material,g.brand,g.gender,g.available_sizes,g.price,g.cost,g.manufacturer,g.productCategory FROM glassbuy_order o JOIN glassbuy_order_details d ON d.order_id = o.id  JOIN glassbuy_glasses g ON g.glass_id = o.product_id JOIN glassbuy_glass_picture gp ON gp.glass_id = g.glass_id WHERE o.id = '".$orderId."' Group By o.id";
                        $fire_only = mysqli_query($con,$frame_only);
                        $frame_only_row = mysqli_fetch_assoc($fire_only);
                        // dd($frame_only_row);
                        // die();

                        
                        //die();
                        ?>
                        </small>
                       
                    </div>
               
                    
                    <div class='col-sm-5'>
                        <!-- <h3>Prescription Entered</h3> -->
                        <?php   
                            $multiple_products = "SELECT gp.name,o.user_id,o.name as username,o.email,d.product_id,g.title,o.status,o.isPaid,o.total,o.order_comments,d.order_id,d.product_price,d.fname,d.lname,d.address,d.city,d.province,d.postal_code,d.phone,d.email,d.country,d.shipping_country,d.vision,p.file_name,d.lensType,d.uv_protection,d.total AS d_total,p.r_sph,p.r_cyl,p.r_axis,p.r_add,p.l_sph,p.l_cyl,p.l_axis,p.l_add,p.lens_type,p.quantity,p.pd,p.fname,g.title,g.colour,g.shape,g.material,g.brand,g.gender,g.available_sizes,g.price,g.cost,g.manufacturer,g.productCategory FROM glassbuy_order o JOIN glassbuy_order_details d ON d.order_id = o.id JOIN glassbuy_prescription p ON p.order_id = o.id JOIN glassbuy_glasses g ON g.glass_id = d.product_id JOIN glassbuy_glass_picture gp ON gp.glass_id = g.glass_id WHERE o.id = '".$orderId."' GROUP BY d.product_id";
                            $multi_fire = mysqli_query($con,$multiple_products);
                            $i = 1;
                                while($row = mysqli_fetch_assoc($multi_fire)){
                        ?>
                        <h3>Glasses Order</h3>
                        <h3><?php  echo "#".$i; ?></h3>
                        <?php if($frame_row['productCategory'] != 'Accessories' ){ ?>
                        <table class="table" border="1">
                            <tr>
                                <th>Frame Title</th>
                                <td><?php echo $row['title']?></td>
                            </tr>
                            <tr>
                                <th>Frame Color</th>
                                <td><?php echo $row['colour']?></td>
                            </tr>
                            <tr>
                                <th>Frame Image</th>
                                <td><img src="<?php echo "uploads/".$row['name']?>" alt="image" width="50px" height="50px"></td>
                            </tr>
                            
                        </table>
                <?php  //if ($frame_row['r_sph'] != '' && $frame_row['r_cyl'] != '' && $frame_row['r_axis'] != '' && $frame_row['r_add'] != '' &&  $frame_row['l_sph'] != '' && $frame_row['l_cyl'] != '' && $frame_row['l_axis'] =! '' && $frame_row['l_add'] != '') {
                    if($frame_only_row != NULL){
                    
              ?>

                    <form action="<?php $_SERVER['PHP_SELF']  ?>" method="post">
                        <table class="table" border="1">
                            <tr>
                                <th>Lens Type</th>
                                <td><?php echo $row['vision']; ?></td>
                                <!-- <td><input type="radio" name="lens_type" id="" value="single">&nbsp;&nbsp;<label for="">Single</label>&nbsp;&nbsp;&nbsp;<input type="radio" name="lens_type" id="" value="distance">&nbsp;&nbsp;<label for="">Distance</label><br><input type="radio" name="lens_type" id="" value="no prescription">&nbsp;&nbsp;<label for="">No Prescription</label></td> -->
                            </tr>
                            <tr>
                                <th>Lens Enhancement</th>
                                <td>
                                    <?php
                                        if ($row['lensType'] == 'Acuity Anti Reflection') {
                                            echo "Basic";
                                        }else{
                                            echo "Advance";
                                        }
                                    ?>
                                </td>
                                <!-- <td><input type="radio" name="vision" id="" value="Basic">&nbsp;&nbsp;<label for="">Basic</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="vision" id="" value="advanced">&nbsp;&nbsp;<label for="">Advanced</label></td> -->
                            </tr>
                            <tr>
                                <th>UV Protection</th>
                                <td>
                                    <?php
                                      echo  $row['uv_protection'];
                                    ?>
                                </td>
                                <!-- <td><input type="radio" name="uv_protection" id="" value="yes">&nbsp;&nbsp;<label for="">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="uv_protection" id="" value="no">&nbsp;&nbsp;<label for="">No</label></td> -->
                            </tr>
                            
                        </table>
                    
                        
                        <h3><?php echo $prescriptionDeets['prescription']?></h3>
                        <table class="table" border = "1">
                            <tr>
                                <th></th>
                                <th>SPH</th>
                                <th>CYL</th>
                                <th>AXIS</th>
                                <th>Add</th>
                                <th>PD</th>
                                <th>PD Photo</th>
                            </tr>
                            
                            <tr>
                                <th>Right Eye</th>
                                <td><?php echo $row['r_sph']?></td>
                                <td><?php echo $row['r_cyl']?></td>
                                <td><?php echo $row['r_axis']?></td>
                                <td><?php echo $row['r_add']?></td>
                                <td rowspan="2"><?php echo $row['pd']?></td>
                                <td> 
                                <?php if($row['file_name']!=""){?>
                                    <a  href="./uploads/<?php echo $row['file_name']?>" target="_blank"><img src="./uploads/<?php echo $row['file_name']?>" style="width:100%;"></a>
                                        <br>
                                    <!-- <a download href="./uploads/<?php //echo $row['file_name']?>">Download</a> -->
                                    <?php }?>
                                 </td>
                            </tr>
                            <tr>
                                <th>Left Eye</th>
                                <td><?php echo $row['l_sph']?></td>
                                <td><?php echo $row['l_cyl']?></td>
                                <td><?php echo $row['l_axis']?></td>
                                <td><?php echo $row['l_add']?></td>
                                <td><?php if($row['pdimage']!=""){?>
                            <a  href="./uploads/<?php echo $row['pdimage']?>" target="_blank"><img src="./uploads/<?php echo $row['pdimage']?>" style="width:100%;"></a>
                            <br>
                            <!-- <a download href="./uploads/<?php //echo $row['pdimage']?>">Download</a> -->
                            <?php }?></td>
                            </tr>
                        </table>
                        <?php
                    }
                 } ?>
                  
                            <table class="table" border = "1">
                                    <tr>
                                        <th>Accessory Name</th>
                                        <th>Accessory Title</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $row['product_name'] ?></td>
                                        <td><?php echo $row['title'] ?></td>
                                    </tr>
                            </table>
                            <?php 
                                if ($frame_row['r_sph'] != '' && $frame_row['r_cyl'] != '' && $frame_row['r_axis'] != '' && $frame_row['r_add'] != '' &&  $frame_row['l_sph'] != '' && $frame_row['l_cyl'] != '' && $frame_row['l_axis'] =! '' && $frame_row['l_add'] != '') {
                                   ?>
                                <input type="submit" value="Save" name="order_submit">

                            
                                        <?php
                                    }

?>

                        </form>
                        
                        <!-- <p><b>PD: </b><?php 
                        // echo $prescriptionDeets['pd']
                        ?></p> -->
                        <!-- <p><b>PD Photo: </b> -->
                        <?php 
                        // if($prescriptionDeets['file_name']!="")
                        //{
                            ?>
                            <!-- <img src="./uploads/<?php 
                                // echo $prescriptionDeets['file_name']
                                ?>" style="width:100%;"> -->
                            <br>
                            <!-- <a download href="./uploads/<?php 
                            // echo $prescriptionDeets['file_name']
                            ?>">Download</a>
                            <?php
                         //}
                         ?> -->
                        </p>
                        <!-- <p><b>PD Measurement Photo: </b> -->
                        <?php
                        //  if($prescriptionDeets['pdimage']!=""){
                             ?>
                            <!-- <img src="./uploads/<?php 
                            // echo $prescriptionDeets['pdimage']
                            ?>" style="width:100%;"> -->
                            <br>
                            <!-- <a download href="./uploads/<?php 
                            // echo $prescriptionDeets['pdimage']
                            ?>">Download</a> -->
                            <?php 
                        //}
                        $i++;
                           
                            }
                        ?>
                       
                        </p>
                 
                        
                        
                    </div>
                    
                    <div class="col-sm-4">
                        
                        <div id="order_review" class="woocommerce-checkout-review-order">
                                                                                <div class="checkout-items">
                                                                                    <h3 id="order_review_heading">Order Summary</h3>
    
                                                                                    <table class="shop_table woocommerce-checkout-review-order-table">
                                                                                        <tbody>
                                                                                            <tr class="cart_item">
                                                                                                <td class="product-name"><?php echo $orderDetailsDeets['product_name']?><strong class="product-quantity">×&nbsp;1</strong></td>
                                                                                                <td class="product-total">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $productDeets['price']?></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <style>
                                                                                                .woocommerce #order_review .woocommerce-checkout-review-order-table tbody tr:last-child td {
                                                                                                    width: 50%;
                                                                                                    float: left;
                                                                                                }
                                                                                            </style>
                                                                                            <tr class="cart_item">
                                                                                                <!-- <td class="product-name">Prescription Lenses&nbsp; <strong class="product-quantity">×&nbsp;1</strong></td> -->
                                                                                                <?php
                                                                                                $count = 1;
                                                                                                $multiple_products = "SELECT gp.name,o.user_id,o.name as username,o.email,d.product_id,g.title,o.status,o.isPaid,o.total,o.vision,o.lensType,o.order_comments,d.order_id,d.product_price,d.fname,d.lname,d.address,d.city,d.province,d.postal_code,d.phone,d.email,d.country,d.shipping_country,d.vision,p.file_name,d.lensType,d.lensType,d.uv_protection,d.total AS d_total,p.r_sph,p.r_cyl,p.r_axis,p.r_add,p.l_sph,p.l_cyl,p.l_axis,p.l_add,p.lens_type,p.quantity,p.pd,p.fname,g.title,g.colour,g.shape,g.material,g.brand,g.gender,g.available_sizes,g.price,g.cost,g.manufacturer,g.productCategory FROM glassbuy_order o JOIN glassbuy_order_details d ON d.order_id = o.id JOIN glassbuy_prescription p ON p.order_id = o.id JOIN glassbuy_glasses g ON g.glass_id = d.product_id JOIN glassbuy_glass_picture gp ON gp.glass_id = g.glass_id WHERE o.id = '".$orderId."' GROUP BY d.product_id";
                                                                                                $multi_fire = mysqli_query($con,$multiple_products);
                                                                                                 while($sum_row = mysqli_fetch_assoc($multi_fire)) {
                                                                                                     //dd($sum_row);
                                                                                                     //die();?>
                                                                                                <td class="product-name">
                                                                                                    Glass Order: <?php echo $count?>
                                                                                                <?php if ($sum_row['productCategory'] != 'Accessories') { ?>
                                                                                                    Frame
                                                                                                <br>
                                                                                            Lenses
                                                                                            <?php }?>
                                                                                        <br>
                                                                                        <?php if ($sum_row['r_sph'] == '' && $sum_row['r_cyl'] == '' && $sum_row['r_axis'] == '' && $sum_row['r_add'] == '' &&  $sum_row['l_sph'] == '' && $sum_row['l_cyl'] == '' && $sum_row['l_axis'] == '' && $sum_row['l_add'] == '') {
                                                                                           echo "Accessory";}?>

                                                                                           <?php
                                                                                                    if ($sum_row['productCategory'] == 'Accessories') {
                                                                                                        echo "Accessory";
                                                                                                    }
                                                                                           ?>
                                                                                    </td>
                                                                                                <td class="product-total">
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <br>
                                                                                                    <?php if ($sum_row['productCategory'] != 'Accessories') { ?>
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span>
                                                                                                        
                                                                                                        <?php echo $sum_row['product_price'];?>
                                                                                                    <br>
                                                                                                    $<?php echo $sum_row['product_price'];
                                                                                                    }
                                                                                                    ?>
                                                                                                    <br>
                                                                                                    <?php if ($sum_row['r_sph'] == '' && $sum_row['r_cyl'] == '' && $sum_row['r_axis'] == '' && $sum_row['r_add'] == '' &&  $sum_row['l_sph'] == '' && $sum_row['l_cyl'] == '' && $sum_row['l_axis'] == '' && $sum_row['l_add'] == '') {
                                                                                                    
                                                                                                    echo "$".$sum_row['product_price'];
                                                                                                    }
                                                                                                    ?>
                                                                                                    <?php
                                                                                                    
                                                                                                    if ($sum_row['productCategory'] == 'Accessories') {
                                                                                                        echo  "$".$sum_row['product_price'];
                                                                                                    }
                                                                                                    $count++;
                                                                                                }
                                                                                           ?></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            
                                                                                        </tbody>
                                                                                        <tfoot>
                                                                                            <tr class="cart-subtotal">
                                                                                                <th>Subtotal</th>
                                                                                                <td>
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $frame_row['price']?></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            
                                                                                            <?php $discount = round(($_SESSION['coupon_discount']/100) * $frame_row['price'], 2);
                                                                                            $tax = round(($frame_row['price'] * 0.04712), 2)  ;?>
    
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
                                                                                                <td data-title="Shipping">$<span class="woocommerce-Price-amount amount"><?php echo $discount?></span></td>
                                                                                            </tr>
                                                                                            
                                                                                            
    
                                                                                            <tr class="tax-total">
                                                                                                <th>Tax</th>
                                                                                                <td>
                                                                                                    <span class="woocommerce-Price-amount amount">
                                                                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $tax;?></bdi>
                                                                                                    </span>
                                                                                                </td>
                                                                                            </tr>
    
                                                                                            <tr class="order-total">
                                                                                                <th>Order Total</th>
                                                                                                <td>
                                                                                                    <strong>
                                                                                                        <input name="total" value="<?php echo round(($tax+ $frame_row['price'] + 9) - $discount, 2)?>" hidden>
                                                                                                        <span class="woocommerce-Price-amount amount">
                                                                                                            <bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo round(($tax+ $frame_row['price'] + 9) - $discount, 2)?></bdi>
                                                                                                        </span>
                                                                                                    </strong>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tfoot>
                                                                                    </table>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        
                    </div>
                </div>
                
                <?php if(!isset($_GET['print'])){?>
                <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=613aff08f7277c0019b0d64b&product=inline-share-buttons" async="async"></script>

<!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons" style="margin-top:20px;"></div><!-- ShareThis END --> 


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
<?php if(!isset($_GET['print'])){ require("./includes/footer.php");}?>
</div>
<!-- .fl-page -->
<?php require("./includes/footerjs.php");?>

<script type="text/javascript">
    $(document).ready(function(e){
        $("table").dataTable(
            {
           buttons: [{
                extend: 'csv',
                exportOptions: {
                    columns: [0,1,2,3,4]
                }
            }]
        });
        $("form.deleteGlass").on('submit',function(e){
            return confirm("do you want to delete this record?");
        })
    });
    
    <?php if(isset($_GET['print'])){?>
    // print();
    
    
    
    <?php }?>
</script>
</body>
</html>
