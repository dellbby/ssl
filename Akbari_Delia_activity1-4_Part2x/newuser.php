<?php
include_once('includes/header.php');
//function begins
function captureUserRegistration(){

	//init variable as array to store each variable in associative array
	$newUser = [];

	//assign key firstName and value post['fname'] to storage array
	$newUser['First Name: '] = $_POST['fName'];

	//assign key lastName and value post['lname'] to storage array 
	$newUser['Last Name: '] = $_POST['lName'];

	//assign key username and value post['username'] to storage array
	$newUser['Username: '] = $_POST['username'];

	//assign key password and salted+hashed value post['password'] to storage array
	$newUser['Password: '] = sha1(md5('fs_ssl_2015'.$_POST['password']));

	$uploadDir = './images/';	
	$uploadFile = basename($_FILES['avatar']['name']);
	$uploadPath = $uploadDir . $uploadFile;
	$fileExtension = pathinfo($uploadFile)['extension'];

	//image to replace if no image is uploaded
	$fallbackImagePath = 'images/fallback.png';

	if($fileExtension == 'png' || $fileExtension == 'jpg' || $fileExtension == 'jpeg'){
		//move uploaded image using files['tmp_name'] to images directory
		if(move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadPath)){
			//assign key avatar and value of image path to storage array
			$newUser['Avatar'] = $uploadPath;
		}else{
			$newUser['Avatar'] = $fallbackImagePath;
		}
	}else{
		$newUser['Avatar'] = $fallbackImagePath;
	}

	// * returns storage array *
	return $newUser;
}
	
//call storage function assigning the return to variable
$newUserDetails = captureUserRegistration();

$userMarkup = '<div class="panel panel-default">';
$userMarkup .= '<div class="panel-heading"><h3>Thanks for Signing up</h3></div>';
$userMarkup .= '<div class="panel-body">';

//loop through each item in the array using associative key value to echo values submitted (image path into src attribute of img tag)
foreach($newUserDetails as $detail => $value){


	if($detail != 'Avatar'){
		$userMarkup .= "<strong>$detail</strong>";
		$userMarkup .= "<span>$value</span>";
		if($detail == 'Password'){
			$userMarkup .= '';
		}
	}else{
		$userMarkup .= '<strong>Avatar:<br> </strong>';
		$userMarkup .= '<img src="'.$value.'" class="img-responsive">';
		if($value == 'images/fallback.png'){
			$userMarkup .= '<p class="help-text"><small><b>Error, we did not recieve a image file. Please go back and upload again.</b></small></p>';
		}
	}
	$userMarkup .= "</div>";
}
$userMarkup .= '</div></div>'

?>
<section>
	<div class="container">
		<div class="row">

				<?php echo $userMarkup; ?>

		</div>
	</div>
</section>
<?php include_once('includes/footer.php');