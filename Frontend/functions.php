<?php 
session_start();
$db = mysqli_connect('fra1.hostarmada.net', 'motherla', '', 'motherla_EmiratiMail');
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$username = "";
$email    = "";
$errors   = array(); 

if (isset($_POST['register'])) {

	global $db, $errors, $username, $email;

	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password  =  e($_POST['password']);

	if (count($errors) == 0) {
		$password = md5($password);

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
            $_SESSION["loggedin"] =true;
			header('location: admin.php');
		}else{
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
			mysqli_query($db, $query);

			$logged = mysqli_insert_id($db);

			$_SESSION['user'] = getId($logged); 
            $_SESSION["loggedin"] =true;
			header('location: employee.php');				
		}
	}
}

function getId($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);
	$user = mysqli_fetch_assoc($result);
	return $user;
}

function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

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


if (isset($_POST['login'])) {

	global $db, $username, $errors;

	$username = e($_POST['username']);
	$password = e($_POST['password']);
    $email = e($_POST['email']);

	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND email='$email' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { 
			$logged = mysqli_fetch_assoc($results);
			if ($logged['user_type'] == 'admin') {

				$_SESSION['user'] = $logged;
                $_SESSION["loggedin"] = true;
				header('location: admin.php');		  
			}
            else{
				$_SESSION['user'] = $logged;
                $_SESSION["loggedin"] = true;
				header('location: employee.php');
			}
		}else {
			array_push($errors, "Invalid username/password");
		}
	}
}