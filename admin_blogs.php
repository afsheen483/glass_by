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


if(isset($_POST['value']) || isset($_FILES["logo"])){
    $value = mb_htmlentities(($_POST['value']));
   
    if(isset($_FILES["logo"])){
        $value = storeFile($_FILES['logo']); 
    }
    
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql="update glassBuy_globals set value='$value' where id='$id'";
    }
    if(!mysqli_query($con,$sql))
    {
        echo "err";
        
    }else{
        ?>
    <script type="text/javascript">
            window.location = "?";
        </script>
    <?php 
        
		
    }
    
}


?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<?php require("./includes/head.php");?>
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
                    <!--<a href="./admin_glass_form.php" class="btn-link">Add Glass</a>-->
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
                
                
                <form action="" method="post" enctype="multipart/form-data">
                        <div class="app-main__inner row">
                            <div id="feed" class="col-lg-12">
                              
                              <div class="alert alert-info">Hello <?echo $session_name?>!</div>
                              
                            

                            </div>
                            
                        </div>
                        
                        <div class="card p-2 m-2">
                        
                        <?if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $stmt = $con->prepare("SELECT * FROM glassBuy_globals where id='$id'");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while($row = $result->fetch_assoc()) 
                            {
                                $value=$row['value'];
                                $type = $row['type'];
                            }
                        ?>
                        <?if($type=="text"){?>
                        <textarea name="value" class="form-control"><?echo $value?></textarea>
                        <?}else{?>
                        <input class="form-control" name="logo" type="file">
                        <?}?>
                        <button type="submit" class="btn btn-primary m-2">Submit</button>
                        <?}?>
                        <table class="table ">
                            <tr>
                                <td>Title</td>
                                <td>Value</td>
                                <td>Edit</td>
                            </tr>
                            
                            <?$stmt = $con->prepare("SELECT * FROM glassBuy_globals");
                            $stmt->execute();
                            $result = $stmt->get_result();
                                while($row = $result->fetch_assoc()) 
                                {?>
                                <tr>
                                    <td><?echo $row['title'];?></td>
                                    <td><?if($row['type']=="text"){echo $row['value'];}else{
                                    ?>
                                    <img src="./uploads/<?echo $row['value']?>" style="height:100px;">
                                    <?
                                    }?></td>
                                    <Td><a href="?id=<?echo $row['id']?>" class="btn btn-warning ">Edit</a></Td>
                                </tr>
                            <?}?>
                            
                        </table>
                        </div>
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
        $("table").dataTable();
        $("form.deleteGlass").on('submit',function(e){
            return confirm("Do you want to delete this record?");
        })
    });
</script>
</body>
</html>
