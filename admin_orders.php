<?php 
include_once("global.php");

if($logged==0){
?><script>window.location="./"</script><?php 
}

if($session_role == 'admin'){
    if(isset($_GET['order_id'])&&($_GET['status'])){
        $id = mb_htmlentities($_GET['order_id']);
        $status = $_GET['status'];
        $sql            = "update glassBuy_order set status='$status' where id='$id'";
            if (!mysqli_query($con, $sql)) {
                echo "account notcreated";
            }
    }
    
    
}

if(isset($_GET['c'])){
    $c = $_GET['c'];
    $id = mb_htmlentities($_GET['id']);

	   if(md5($id)==($c)){
	   
        $_SESSION['product_id']  = array();     
        $sql="update glassBuy_order set isPaid='1', status='PAID'  where id='$id'";
        if(!mysqli_query($con,$sql))
        {
            echo "err2";
             
        }else{
            
            if($_SESSION['email_temp']!="" && $_SESSION['password_temp']!=""){
                $_SESSION['email'] = $_SESSION['email_temp'] ;
                $_SESSION['password'] = $_SESSION['password_temp'] ;
            }
             
             
             
            header("Location: ./view_order.php?id=".$id."&thankyou=1");
        }
	   }
        
}





/*get Clients a*/
// $getGlasses_sql = "SELECT * FROM `glassBuy_glasses` ORDER BY `created_at` DESC";
// $getGlasses = getAll($con,$getGlasses_sql);
/*end of get Clients*/
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    
<?php  
if(!isset($_GET['print'])){
require("./includes/head.php");
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
    <?php  if(!isset($_GET['print'])){ ?>
<h2 class="heading-title">
    <span class="title-text pp-primary-title">My Account</span>
</h2>
<?php  }?>
</div>
</div>
</div>
</div>
<div class="fl-module fl-module-rich-text fl-node-5ec37624db6e7" data-node="5ec37624db6e7">
<div class="fl-module-content fl-node-content">
<div class="fl-rich-text">
<div>
<div class="woocommerce">
    <?php  if(!isset($_GET['print'])){
include('./includes/sidebar.php');} ?>

            <div class="woocommerce-MyAccount-content">
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
                
                <?php  if(isset($_GET['prescription'])){?>
                <style>
                    #DataTables_Table_0_wrapper{
                        overflow:auto !important;
                    }
                </style>
                

                <table class="table">
                    <thead>
                        <tr>
                            <?php  
                            $presRows = array();
                            $od = getAll($con, "SELECT * from glassBuy_prescription limit 1;");
                            foreach($od as $row){
                                // $presRows[$row['order_id']] = $row;
                                foreach($row as $r => $val){
                                    if(!in_array($r, array("quantity", "product_id", "order_id", "id"))){
                                        $presRows[] = $r;
                                        ?>
                                         <th><?php  echo $r?></th>
                                        <?php  
                                    }
                                }
                            }
                            ?>
                        </tr>
                        <tbody>
                            <?php  
                            $order_id = $_GET['prescription'];
                            $od = getAll($con, "SELECT * from glassBuy_prescription where order_id='$order_id';");
                            foreach($od as $row){
                                ?><tr><?php  
                                foreach($presRows as $pr){
                                    ?>
                                    <td>
                                        <?php  if($pr!="file_name"){?>
                                        <?php  echo $row[$pr]?>
                                        <?php  }else{?>
                                        <a href="./uploads/<?php  echo $row[$pr]?>" target="_blank">View file</a>
                                        <?php  }?>
                                    
                                    </td>
                                    <?php  
                                }
                                ?></tr><?php  
                            }?>
                        </tbody>
                    </thead>
                    
                </table>
                <?php  }?>
                <h2>Orders</h2>
                
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                        <select class="form-control" name="order_status">
                            <option value="All">All</option>
                                        <?php  foreach($g_orderStatus as $col){
                                            if ($_GET['order_status'] == $col) {?>
                                             <option value="<?php  echo $col?>" selected><?php  echo $col?></option>
                                             <?php
                                               
                                            }else{?>
                                                 <option value="<?php  echo $col?>"><?php  echo $col?></option>

                                        <?php } }?>
                        </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                                <button names="src" type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>OrderId</th>
                            <th>Glasses</th>
                            <th>User</th>
                            <th>Address</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                        $orderDetails = array();
                        $od = getAll($con, "SELECT * from glassBuy_order_details;");
                        foreach($od as $row){
                            $orderDetails[$row['order_id']] = $row;
                        }
                        
                        /*$checkoutDetails = array();
                        $od = getAll($con, "SELECT * from glassBuy_order_details;");
                        foreach($od as $row){
                            $checkoutDetails[$row['order_id']] = $row;
                        }*/
                         if(isset($_GET['print'])){
                            $print = $_GET['print'];
                            $orders = getAll($con, "SELECT *, o.id order_id from glassBuy_order o left outer join glassBuy_glasses g on g.glass_id=o.product_id where o.id='$print'");
                        }
                        else if($session_role=="admin"){
                            $orders = getAll($con, "SELECT *, o.id order_id from glassBuy_order o left outer join glassBuy_glasses g on g.glass_id=o.product_id where isPaid='1';");
                        }
                        else{
                            $orders = getAll($con, "SELECT *, o.id order_id from glassBuy_order o left outer join glassBuy_glasses g on g.glass_id=o.product_id where o.user_id='$session_userId' and isPaid='1';");
                        }
                        if (isset($_GET['order_status'])) {
                            $order_status = $_GET['order_status'];
                            $query = "SELECT * FROM glassbuy_order o JOIN glassbuy_order_details d ON d.order_id = o.id JOIN glassbuy_prescription p ON p.order_id = o.id JOIN glassbuy_glasses g ON g.glass_id = o.product_id WHERE o.status = '$order_status' Group By o.id ORDER BY o.id DESC";

                            if ($order_status == 'All') {
                                $query = "SELECT * FROM glassbuy_order o JOIN glassbuy_order_details d ON d.order_id = o.id JOIN glassbuy_prescription p ON p.order_id = o.id JOIN glassbuy_glasses g ON g.glass_id = o.product_id Group By o.id ORDER BY o.id DESC";

                            }
                        }else{
                            $query = "SELECT * FROM glassbuy_order o JOIN glassbuy_order_details d ON d.order_id = o.id JOIN glassbuy_prescription p ON p.order_id = o.id JOIN glassbuy_glasses g ON g.glass_id = o.product_id Group By o.id ORDER BY o.id DESC";
 
                        }
                        $fire = mysqli_query($con,$query);
                        //$row = mysqli_fetch_assoc($fire);
                        while( $row = mysqli_fetch_assoc($fire)){
                        //foreach($orders as $row){
                        ?>
                        <tr>
                            <td>#<?php  echo $row['order_id']?></td>
                            <td>
                                <div>
                                    <p><b>Glass Id</b> : #<?php  echo $row['product_id']?></p>
                                    <p><b>Colour</b> : <?php  echo $row['colour']?></p>
                                    <p><b>Type </b> : <?php  echo $row['productCategory']?></p>
                                    <p><b>Material </b> : <?php  echo $row['material']?></p>
                                </div>
                            </td>
                            <td>
                                <span><?php  echo $orderDetails[$row['order_id']]['fname']?> <?php  echo $orderDetails[$row['order_id']]['lname']?></span>
                            </td>
                            <td>
                                <?php  echo $orderDetails[$row['order_id']]['address']?>
                            </td>
                            <td><?php  echo $orderDetails[$row['order_id']]['order_date']?></td>
                            <td>
                                
                            <select class="form-control" name="status" style='display:none' onchange="receive_unreceive_order(this.value,<?php  echo $row['order_id']?>)" id="select_lens_status_<?php  echo $row['order_id']?>" data-labStatus="<?php  echo $row['order_id']?>">
                                        <?php  foreach($g_orderStatus as $col){?>
                                        <option><?php  echo $col?></option>
                                        <?php  }?>
                                    </select>
                            
                                    <h5><span data-id="<?php  echo $row['order_id']?>" class="badge badge-success edit_able" id="lable_lens_status_<?php  echo $row['order_id']?>" onclick="lens_status_toggle(<?php  echo $row['order_id']?>)" style="cursor: pointer;"><?php  echo $row['status']?></span></h5>

                            
                            
                        </td>
                            <td>
                                <?php  if(!isset($_GET['print'])){?>
                                <?php  if($session_role=="admin"){?>
                                <!-- <form action="" method="get">
                                    <input name="order_id" value="<?php  echo $row['order_id']?>" id="<?php  echo $row['order_id']?>" class="order_id" hidden>
                                    <select class="form-control" name="status" id>
                                        <?php  foreach($g_orderStatus as $col){?>
                                        <option><?php  echo $col?></option>
                                        <?php  }?>
                                    </select>
                                    <button type="submit">Change Status</button>
                                </form> -->
                                
                                <?php  }?>
                                <form action="./view_order.php" method="get">
                                    <input name="pId" value="<?php  echo $row['order_id']?>" hidden >
                                    <button type="submit">View Order Details</button>
                                </form>
                                <!-- <?php
                                //  if ($row['productCategory'] == 'Accessories') {
                                  ?>
                                         <form action="./order_details_frame_accessories.php" method="get">
                                    <input name="id" value="<?php  //echo $row['order_id']?>" hidden >
                                    <button type="submit">Frame + Accessory</button>
                                </form>
                                  <?php

                                } 
                                
                               // if ($row['productCategory'] == 'Accessories' || $row['productCategory'] == 'Glasses') {
                                ?>
                               
                                
                                <form action="./order_sunglasses_accessory.php" method="get">
                                    <input name="id" value="<?php // echo $row['order_id']?>" hidden >
                                    <button type="submit">Sunglasses + Accessory</button>
                                </form>

                                <?php
                                //}
                            
                                ?>
                                <?php
                                 //if ($row['productCategory'] == 'Accessories') {
                                  ?>
                                <form action="./order_details_accessory.php" method="get">
                                    <input name="id" value="<?php // echo $row['order_id']?>" hidden >
                                    <button type="submit">Accessories Only</button>
                                </form>
                                <?php // }
                               // if ($row['productCategory'] == 'Accessories' || $row['productCategory'] == 'Glasses') {
                                    
                                
                                ?>
                                <form action="./order_glasses_accessories.php" method="get">
                                    <input name="id" value="<?php  //echo $row['order_id']?>" hidden >
                                    <button type="submit">Glasses + Accessories</button>
                                </form>
                                <?php
                              //  }
                            
                                ?> -->
                                
                                <!--<button>-->
                                <!--    <a target="_blank"  href="?print=<?php  //echo $row['order_id']?>" style="color:white;">Print</a>-->
                                <!--</button>-->
                               
                            </td>
                        </tr>
                        <?php  }?>
                    </tbody>
                </table>
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
  
    
    


    function lens_status_toggle(id){
    $("#select_lens_status_"+id).show();
    $("#lable_lens_status_"+id).hide();
   }
   function receive_unreceive_order(order_status, id) {
                $("#lable_lens_status_"+id).text($("#select_lens_status_"+id).find(":selected").text());
         
                $("#select_lens_status_"+id).hide();
                $("#lable_lens_status_"+id).show();
       
                    console.log(id)
                    console.log(order_status)
                    var url = "orders_status_update.php";
                    
                    $.ajax({
                        url: url,
                        type: "POST",
                        cache: false,
                        data: {
                            order_status: order_status,
                            id:id
                        },
                        success: function(response) {
                            console.log("success");
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log("update request failure");
                            //errorFunction(); 
                        }
                    });
            }                 
</script>
</body>
</html>
