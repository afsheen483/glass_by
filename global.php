<?php
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 100);
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 100);
ini_set('session.save_path', '/tmp');

session_start();

// Report runtime errors
error_reporting(E_ERROR );
error_reporting(1);

//maybe you want to precise the save path as well
include_once("./database.php");
$logged=0;
// print_r($_SESSION);
if (isset($_SESSION['email']) && isset($_SESSION['password']))
{
        $session_password = $_SESSION['password'];
        $session_username = $_SESSION['name'];
        // $session_userId = $_SESSION['userId'];
        $session_email =  $_SESSION['email'];
        
        $query = "SELECT *  FROM glassBuy_users WHERE email='$session_email' AND password='$session_password'";

        $result = $con->query($query);
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()) 
            {
                $logged=1;
                $session_userId = $row['id'];
                $session_name = $row['name'];
                $session_email = $row['email'];
                $session_phone = $row['phone'];
                $session_address = $row['address'];
                $session_about = $row['about'];
                $session_data = $row;
                $session_role = $row['role'];
                
            }
            
        }
}

if(isset($_SESSION['usernumber'])){
    $usernumber = $_SESSION['usernumber'];
    $sq     = "SELECT * from glassBuy_users where usernumber = '$usernumber'  ";
        $result = $con->query($sq);
        $num    = mysqli_num_rows($result);
        
        if ($num == 1) {
        	$logged = 1;
    	    	while ($row = $result->fetch_assoc()) {
    	    		$_SESSION['id'] = $row['id'];
    	    		$session_name = $row['name'];
    	            $session_email = $row['email'];;
    	            $session_userId = $row['id'];
    	            $session_role = $row['role'];
    	            $session_phone = $row['phone'];
                    $session_address = $row['address'];
                    $session_about = $row['about'];
                    $session_data = $row;
    	    }
        }
}






function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function mb_htmlentities($string, $hex = true, $encoding = 'UTF-8') {
    global $con;
    return mysqli_real_escape_string($con, $string);
}
      
      
function sendEmailNotification($subject, $message, $email){
    
   
    $to = $email; 
    $from = 'dev.email.sender1@anomoz.com'; 
    $fromName = 'Glass Buy'; 
     

    $email_body = $message;
    $htmlContent = $email_body; 
    
        
    // Set content-type header for sending HTML email 
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
     
    // Additional headers 
    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

    // Send email 
    if(mail($to, $subject, $htmlContent, $headers)){ 
        //  echo "Email sent to: ".$email;
        // echo "Email sent";
    }else{ 
       echo 'Email sending failed.'; 
    }
       
}

    
function uploadFile($file){
	$randomName = generateRandomString();
	$target_dir = "./uploads/";
	$fileName_db = $randomName.basename($file["name"]);
	$target_file = $target_dir . $fileName_db;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
	if($file["tmp_name"]!="") {
		$uploadOk = 1;
        // Check if file already exists
		if (file_exists($target_file)) {
            //echo "Sorry, file already exists.";
			$filename=basename( $file["name"]);
			$uploadOk = 1;
		}
            // Check file size
		if ($file["size"] > 5000000000000) {
			$uploadOk = 0;
			return "Sorry, your file is too large.";
		}
        
        // Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			return "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($file["tmp_name"], $target_file)) {
                //echo "The file ". basename( $file["name"]). " has been uploaded.";
				$filename=basename( $file["name"]);
				$uploadOk = 1;
				return $fileName_db;
			} else {
				return "Sorry, there was an error uploading your file.";
			}
		}
	}
}

function uploadMultipleFile($file,$k,$target_dir = "./uploads/"){
    $randomName = generateRandomString();
    $fileName_db = $randomName.basename($file["name"][$k]);
    $target_file = $target_dir . $fileName_db;

    //The temp file path is obtained
    $tmpFilePath = $file['tmp_name'][$k];
   //A file path needs to be present
    if ($tmpFilePath != ""){
      //File is uploaded to temp dir
      if(move_uploaded_file($tmpFilePath, $target_file)) {
        return $fileName_db;
      }
      return "default.png";
    }
}

function showGlobal($title, $type="text"){
    global $con;
    $globalsAdded = array();
    $stmt = $con->prepare("SELECT * FROM glassBuy_globals");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) 
        {
            $globalsAdded[$row['title']] = $row['value'];
        }
    }
    
    if(($globalsAdded[$title]!="")){
        $val =  $globalsAdded[$title];
        if($type=="image"){
            echo "./uploads/$val";
        }else{
            echo $val;
        }
        
    }else{
        if($type=="image"){
            echo "./uploads/$title";
        }else{
            echo $title;
        }
        $id = generateRandomString();
        $title = mb_htmlentities($title);
        $stmt = $con->prepare("insert into glassBuy_globals set id='$id', title='$title', value='$title', type='$type' ");
        $stmt->execute();
        $globalsAdded[$title] = $title;
        
    }
    
    
}

function storeFile($file){
	$randomName = generateRandomString();
	$target_dir = "./uploads/";
	$fileName_db = "aud_".$randomName.basename($file["name"]);
	$target_file = $target_dir . "aud_".$randomName.basename($file["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
	if($file["tmp_name"]!="") {
		$uploadOk = 1;
        // Check if file already exists
		if (file_exists($target_file)) {
            //echo "Sorry, file already exists.";
			$filename=basename( $file["name"]);
			$uploadOk = 1;
		}
            // Check file size
		if ($file["size"] > 5000000000000) {
			$uploadOk = 0;
			return "";
		}
        
        // Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			return "";
        // if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($file["tmp_name"], $target_file)) {
                //echo "The file ". basename( $file["name"]). " has been uploaded.";
				$filename=basename( $file["name"]);
				$uploadOk = 1;
				return $fileName_db;
			} else {
				return "";
			}
		}
	}
	return "";
}

$glass_atts = array("manufacturer","collection","originalCode","model","ifAddOnRev","eyeA","temple","upc","sku","retailPrice","stock","width","ed","rim","feature","nosePad", "shape", "material", "brand", "gender",  "minimum_pos_pd", "minimum_neg_pd","color1","color2"
);

$glass_atts_public = array("eyeA","temple","color1","color2","width","ed","rim","feature","nosePad"
,  "shape", "material", "brand", "gender", "minimum_pos_pd", "minimum_neg_pd",  "pdStart",
);
      
$g_colors = array("amber","ash","asphalt","auburn","avocado","aquamarine","azure","beige","bisque","black","blue","bone","bordeaux","brass","bronze","brown","burgundy","camel","caramel","canary","celeste","cerulean","champagne","charcoal","chartreuse","chestnut","chocolate","citron","claret","coal","cobalt","coffee","coral","corn","cream","crimson","cyan","denim","desert","ebony","ecru","emerald","feldspar","fuchsia","gold","gray","green","heather","indigo","ivory","jet","khaki","lime","magenta","maroon","mint","navy","olive","orange","pink","plum","purple","red","rust","salmon","sienna","silver","snow","steel","tan","teal","tomato","violet","white","yellow");
$g_project_name = "Glass Buy"          ;

$g_orderStatus = array("NOT STARTED", "IN PROGRESS", "COMPLETE", "DELIVERED", "REMAKE");

include_once("./includes/core/dbmodel.php");
include_once("./includes/core/session.php");

$g_project_url = "https://projects.anomoz.com/ke/glassBuy1/";


$params = array(
	"testmode"   => "on",
	"private_live_key" => "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",
	"public_live_key"  => "pk_live_51J5p48SIAvQPuCPXh1puOPAIvFTwfRNf3tEZqpgJE4I4l8PKQT8WdoHn0yaH04j95zHqhT2Mnz2f0NeBzr1htoQX00dLvc9mRQ",
	"private_test_key" => "sk_test_51Gz0OOHQjkfG1DwOmJD0AsqrZDQ6vG6oMb28V0WEjlTsuZQSFS5kqb5rr60BIeOgeqobp7XAK7IsOh4gVsrEyKl700IoFt2lJZ",
	"public_test_key"  => "pk_test_51Gz0OOHQjkfG1DwO9latQvA69lF4SGM6jl1DiHgWI5gkzHvI4XqlMDHDw3kQxHPZEJIZlGxxOBufbdfAPAOjVM1500HcxE0VZ2"
);


$g_countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Palestine", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

?>