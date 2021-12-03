<?php 
include_once("global.php");
include_once("./includes/core/dbmodel.php");
include_once("./includes/core/session.php");

if($logged==0){
?><script>window.location="./"</script><?php 
}



/*get Clients*/
// $getGlasses_sql = "SELECT * FROM `glassBuy_glasses` ORDER BY `created_at` DESC";
$getGlasses_sql = "SELECT * FROM `glassBuy_glasses` WHERE productCategory = 'Glasses' ORDER BY `created_at` DESC";
$getGlasses = getAll($con,$getGlasses_sql);


/*end of get Clients*/



//dd($row['email']);

// form
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $name = (mb_htmlentities($_POST['first_name']. " ".$_POST['last_name']));
        $phone = $_POST['phone'];   
        $query = "UPDATE `glassbuy_users` SET `email`='$email',`phone`='$phone',`name`='$name' WHERE `id`='$session_userId'";
        $fire = mysqli_query($con,$query) or die(mysqli_error($con));
        if ($fire) {
            setFlash("error","Personal Info Updated Successfully.","alert-success");
				header("Location:personal_info.php");
				exit();
			}else{
				setFlash("error","Something went wrong, Please try again.","alert-danger");
				header("Location:personal_info.php");
				exit();
			}
          
}
?>


<!DOCTYPE html>
<html lang="en-US">
<head>
<?php require("./includes/head.php");?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

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
                <div class="rightSideBox">
              
                    <!-- <a href="./admin_variations_view.php" class="btn-link">Glasses Variation</a> -->
                </div>
               
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
                <?php if($session_role=="admin"){?>
              
                <?php  }
                
                $query = "SELECT *  FROM glassBuy_users WHERE id='$session_userId'";
                $fire = mysqli_query($con,$query);
                $row = mysqli_fetch_assoc($fire);
                //dd($row['phone']);
                $name = explode(" ",$row['name']);
                ?>
               
                    <h1 style="text-align:center">Peronal Info</h1>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                  <table class="table">
                        <!-- <tr>
                            <td>Gender</td>
                            <td><input type="radio" name="gender" id="" value="mr">&nbsp;&nbsp;<label for="">MR</label>&nbsp;&nbsp;&nbsp;&nbsp;
                               <input type="radio" name="gender" id="" value="ms">&nbsp;&nbsp;<label for="">Ms</label>&nbsp;&nbsp;&nbsp;&nbsp;
                               <input type="radio" name="gender" id="" value="mx">&nbsp;&nbsp;<label for="">Mx</label></td>
                        </tr> -->
                        <tr>
                            <td>Firstname</td>
                            <td><input type="text" name="first_name" id="" value="<?php echo $name[0] ?>"></td>
                        </tr>
                        <tr>
                            <td>Lastname</td>
                            <td><input type="text" name="last_name" id="" value="<?php echo $name[1] ?>"></td>
                        </tr>
                        <tr>
                            <td>Email Address</td>
                            <td><input type="text" name="email" id="" value="<?php echo $row['email'] ?>"></td>
                        </tr>
                        <!-- <tr>
                            <td>Telephone</td>
                            <td><input type="text" name="phone" id="" value="<?php echo $row['phone'] ?>"></td>
                        </tr> -->
                        <tr>
                            <td rowspan="4"><button type="submit" class="btn btn-primary" name="submit">Update</button></td>
                        </tr>
                  </table>
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

<script type="text/javascript">
    $(document).ready(function(e){
        $(".table").dataTable();
        $("form.deleteGlass").on('submit',function(e){
            return confirm("Do you want to delete this record?");
        })
    });
</script>
</body>
</html>
