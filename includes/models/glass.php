<?php
require_once("../../database.php");
require_once("../../global.php");
include_once("../core/dbmodel.php");
include_once("../core/session.php");

$pk = "glass_id"; // tables primary key is
$tableName = 'glassBuy_glasses'; // database tablename

// $loginUserId = $_SESSION['userId'];

if(true){
	/**
	* insert form data of orders form
	**/
	
// 	alter table glassBuy_glasses drop bridgeDBL;
// alter table glassBuy_glasses drop collection;
// alter table glassBuy_glasses drop type;


// alter table glassBuy_glasses add minimum_pos_pd  VARCHAR (256) DEFAULT '';
// alter table glassBuy_glasses add minimum_neg_pd  VARCHAR (256) DEFAULT '';



	if(isset($_POST['CREATE_GLASS'])){
		// dd($_POST);
		if(isset($_POST['title']) && isset($_POST['shape']) && isset($_POST['material']) && isset($_POST['brand']) && isset($_POST['price'])  && isset($_POST['gender'])){
		    $createRecord = false;
		    
			$data = [
				'glass_id' => getRandomString(),
				'title' => $_POST['title'],
				'colour' => $_POST['colour'],
				'shape' => $_POST['shape'],
				'material' => $_POST['material'],
				'brand' => $_POST['brand'],
				'gender' => $_POST['gender'],
				
				'additional_info' => $_POST['additional_info'],
				'available_sizes' => $_POST['available_sizes'],
				'price' => $_POST['price'],
				'relatedTo' => $_POST['relatedTo'],
				
				'manufacturer' => $_POST['manufacturer'],
                'minimum_neg_pd' => $_POST['minimum_neg_pd'],
                'originalCode' => $_POST['originalCode'],
                'model' => $_POST['model'],
                'ifAddOnRev' => $_POST['ifAddOnRev'],
                
                'eyeA' => $_POST['eyeA'],
                'minimum_pos_pd' => $_POST['minimum_pos_pd'],
                'temple' => $_POST['temple'],
                'upc' => $_POST['upc'],
                'sku' => $_POST['sku'],
                'retailPrice' => $_POST['retailPrice'],
                'stock' => $_POST['stock'],
                'color1' => $_POST['color1'],
                'color2' => $_POST['color2'],
                'width' => $_POST['width'],
                'ed' => $_POST['ed'],
                'rim' => $_POST['rim'],
                'feature' => $_POST['feature'],
                'nosePad' => $_POST['nosePad'],
                'minimumPosPd' => $_POST['minimumPosPd'],
                'lensType' => $_POST['lensType'],
                'productCategory' => $_POST['productCategory'],
                
                'ribboon_color' => $_POST['ribboon_color'],
                'ribboon_text' => $_POST['ribboon_text'],

                

			];

			if($_FILES['pictures']){
				foreach ($_FILES['pictures']['tmp_name'] as $k => $pic) {
					$picData = [
						'glass_picture_id' => getRandomString(),
						'glass_id' => $data['glass_id'],
						'name' => uploadMultipleFile($_FILES['pictures'],$k,"../../uploads/")
					];
					save($con,'glassBuy_glass_picture',$picData);
				}
			}

			$createRecord = save($con,$tableName,$data);
			if($createRecord){
				setFlash("error","Glass created Successfully.","alert-success");
				header("Location: ../../admin_glasses.php");
				exit();
			}else{
				setFlash("error","Something went wrong, Please try again.","alert-danger");
				header("Location: ../../admin_glass_form.php");
				exit();
			}
		}else{
			setFlash("error","Please choose all field correctly.","alert-danger");
			header("Location: ../../admin_glass_form.php");
			exit();
		}
	}


	/**
	* Delete glass from table
	**/
	if(isset($_POST['DELETE_GLASS'])){
		if($_POST['glass_id']){
			$pk_value = $_POST['glass_id'];
			$deleteRecord = delete($con,$tableName,$pk,$pk_value);
			if($deleteRecord){
				setFlash("error","Glass removed.","alert-success");
				header("Location: ../../admin_glasses.php");
				exit();
			}else{
				setFlash("error","Something went wrong, Please try again.","alert-danger");
				header("Location: ../../admin_glasses.php");
				exit();
			}
		}else{
			setFlash("error","Something went wrong.","alert-danger");
			header("Location: ../../admin_glasses.php");
			exit();
		}
	}

	/**
	* Delete picture from table
	**/
	if(isset($_GET['_picture'])){
		if($_GET['_picture'] && $_GET['_d']){
			$glassId = $_GET['_picture'];//basically it's glass id
			$gpk_value = $_GET['_d'];
			$deleteRecord = delete($con,'glassBuy_glass_picture','glass_picture_id',$gpk_value);
			if($deleteRecord){
				setFlash("error","Picture removed.","alert-success");
				header("Location: ../../admin_glass_form.php?e=$glassId");
				exit();
			}else{
				setFlash("error","Something went wrong, Please try again.","alert-danger");
				header("Location: ../../admin_glass_form.php?e=$glassId");
				exit();
			}
		}else{
			setFlash("error","Something went wrong.","alert-danger");
			header("Location: ../../admin_glass_form.php?e=$glassId");
			exit();
		}
	}

	/**
	* update form data of edit glass form
	**/
	if(isset($_POST['EDIT_GLASSES'])){
		if(isset($_POST['title'])){

            
			$glass_id = $_POST['glass_id'];
			$updateRecord = false;
            
            // var_dump($_POST);
			$eData = [
				'title' => $_POST['title'],
				'colour' => $_POST['colour'],
				'shape' => $_POST['shape'],
				'material' => $_POST['material'],
				'brand' => $_POST['brand'],
				'gender' => $_POST['gender'],
				
				'additional_info' => $_POST['additional_info'],
				'available_sizes' => $_POST['available_sizes'],
				'price' => $_POST['price'],
				'relatedTo' => $_POST['relatedTo'],
				
				'manufacturer' => $_POST['manufacturer'],
                'minimum_neg_pd' => $_POST['minimum_neg_pd'],
                'originalCode' => $_POST['originalCode'],
                'model' => $_POST['model'],
                'ifAddOnRev' => $_POST['ifAddOnRev'],
                
                'eyeA' => $_POST['eyeA'],
                'minimum_pos_pd' => $_POST['minimum_pos_pd'],
                'temple' => $_POST['temple'],
                'upc' => $_POST['upc'],
                'sku' => $_POST['sku'],
                'retailPrice' => $_POST['retailPrice'],
                'stock' => $_POST['stock'],
                'color1' => $_POST['color1'],
                'color2' => $_POST['color2'],
                'width' => $_POST['width'],
                'ed' => $_POST['ed'],
                'rim' => $_POST['rim'],
                'feature' => $_POST['feature'],
                'nosePad' => $_POST['nosePad'],
                'minimumPosPd' => $_POST['minimumPosPd'],
                'lensType' => $_POST['lensType'],
                'productCategory' => $_POST['productCategory'],
                
                'ribboon_color' => $_POST['ribboon_color'],
                'ribboon_text' => $_POST['ribboon_text'],
                 
                
			];

			if($_FILES['pictures']){
				foreach ($_FILES['pictures']['tmp_name'] as $k => $pic) {
					$picData = [
						'glass_picture_id' => getRandomString(),
						'glass_id' => $glass_id,
						'name' => uploadMultipleFile($_FILES['pictures'],$k,"../../uploads/")
					];
					$save = save($con,'glassBuy_glass_picture',$picData);
				}
			}

			/*update furnitureShopMake_orders table status as new*/
			$whereGlassId = "`glass_id`='".$glass_id."'";
			$updateRecord = update($con,$tableName,$eData,$whereGlassId);
			/*end update furnitureShopMake_orders table status as new*/

            // echo $updateRecord;
            // exit();
            
            // echo "test".$_POST['gender'];
            
			if($updateRecord || $save){
				setFlash("error","Data was updated successfully.","alert-success");
				header("Location: ../../admin_glasses.php");
				exit();
			}else{
				setFlash("error","Something went wrong, Please try again.","alert-danger");
				header("Location: ../../admin_glass_form.php?e=$glass_id");
				exit();
			}
		}else{
			setFlash("error","Please insert all field correctly.","alert-danger");
			header("Location: ../../admin_glass_form.php?e=$glass_id");
			exit();
		}
	}
}else{
	//if user is not authenticated auth middlware
	setFlash("error","You are not authenticated.","alert-warning");
	header("Location: ../../index.php");
	exit();
}
?>