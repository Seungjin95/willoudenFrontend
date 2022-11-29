<?php
include "Connect.php";
   
$FName = "";
$LName = "";
$Username = "";
$email    = "";
$errors   = array(); 


//register function
if (isset($_POST['register'])) {

	global $db, $errors, $Username, $email, $FName, $LName;
	$FName = e($_POST['FName']);
	$LName = e($_POST['LName']);
	$Username = e($_POST['Username']);
	$Email = e($_POST['Email']);
	$Password = e($_POST['Password']);
	$ID = e($_POST['id']);

	if (count($errors) == 0) {
		$Password = md5($Password);
// 										<!--- need to send the following items to database: Admin	Username	Email	Password	First Name	Last Name --->
		$query = "SELECT * FROM EmployeeInfoTest WHERE EmployeeID=" . $ID;
			$result = mysqli_query($db, $query);
			$user = mysqli_fetch_assoc($result);
			if($user['Domain1'] == '1'){	
			if (isset($_POST['Admin'])) {
				$Admin = e($_POST['Admin']);
				$query = "INSERT INTO `EmployeeInfo` (`EmployeeID`, `Admin`, `Username`, `Email`, `Password`, `FirstName`, `LastName`) VALUES ('$ID', '$Admin', '$Username', '$Email', '$Password', '$FName', '$LName');";
						 
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";
	            $_SESSION["loggedin"] =true;
				header('location: admin.php');
			}else{
			$query = "INSERT INTO `EmployeeInfo` (`EmployeeID`, `Admin`, `Username`, `Email`, `Password`, `FirstName`, `LastName`) VALUES ('$ID', '0', '$Username', '$Email', '$Password', '$FName', '$LName');";
			mysqli_query($db, $query);

			$logged = mysqli_insert_id($db);

			$_SESSION['user'] = getId($logged); 
            $_SESSION["loggedin"] = true;
			header('location: employee.php');
			}
			}else{
				
				echo "<script>
				alert('You are not supposed to be in this domain.');
				window.location.href='register.php';
				</script>"; 
			}
	}
}

//get employee id function
function getId($id){
	global $db;
	$query = "SELECT * FROM EmployeeInfo WHERE EmployeeID=" . $id;
	$result = mysqli_query($db, $query);
	$user = mysqli_fetch_assoc($result);
	return $user;
}

function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

//display error function
function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

//delete user function
if (isset($_POST['delete'])) 
{
	global $db, $EmployeeID;
	$query= "SELECT * FROM  EmployeeInfo"; 
	$EmployeeID = e($_POST['EmployeeID']);
	$check = $_POST['checkbox'];
	$extract = implode(',',$check);
	$query= "DELETE FROM EmployeeInfo WHERE EmployeeID IN($extract)"; 
	$run = mysqli_query($db, $query);


}

//update function
if (isset($_POST['update'])){

	global $db, $EmployeeID, $FName, $LName, $Email, $Username, $Password;
	$query= "SELECT * FROM  EmployeeInfo"; 
	$ID = e($_POST['id']);
	$FName = e($_POST['FName']);
	$LName = e($_POST['LName']);
	$Username = e($_POST['Username']);
	$Email = e($_POST['Email']);
	$Password = e($_POST['Password']);

	$check = $_POST['checkbox'];
	$extract = implode(',',$check);
	$query= "UPDATE EmployeeInfo SET EmployeeID = '$ID', FirstName = '$FName',  Email = '$Email', Password = '$Password', Username = '$Username' WHERE EmployeeID IN($extract)"; 
	$run = mysqli_query($db, $query);
}

//login function
if (isset($_POST['login'])) {

	global $db, $errors;

	$Password = e($_POST['Password']);
	$LoginInfo = e($_POST['LoginInfo']);
	

	if (count($errors) == 0) {
		$Password = md5($Password);

		$query = "SELECT * FROM EmployeeInfo WHERE Username='$LoginInfo' OR Email='$LoginInfo' AND Password='$Password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { 
			$logged = mysqli_fetch_assoc($results);
			if ($logged['Admin'] == '1') {

				$_SESSION['user'] = $logged;
                $_SESSION["loggedin"] = true;
				header('location: admin.php');		  
			}
            else{
				$_SESSION['user'] = $logged;
                $_SESSION["loggedin"] = true;
				header('location: employee.php#inbox');
			}
		}else {
			array_push($errors, "Invalid username/password");
		}
	}
}



/*
if (isset($_POST['send'])) {
	
	global $email, $message, $subject;

    require 'PHPMailerAutoload.php';

    $mail = new PHPMailer;

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'fra1.hostarmada.net';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;
    $mail->Port       = '465';                               // Enable SMTP authentication
    $mail->Username = 'emiratitest@motherlandmade.net';                 // SMTP username
    $mail->Password = '8ZTb[8oKs1W0r+';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

    $mail->From = 'sender';
    $mail->FromName = $email;
    $mail->addAddress($email);     // Add a recipient
    $mail->addReplyTo('');
    $mail->addCC('');
    $mail->addBCC('');

    $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
    $mail->addAttachment('');         // Add attachments
    $mail->addAttachment('');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = $message;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}
