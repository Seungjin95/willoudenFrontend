<html>
<head>
    <meta charset="utf-8">
    <title>Registration Page</title>
	<style>
	<?php include 'main.css'; ?>
    </style>
	<script>
	 var check = function() {
      if (document.getElementById('Password').value ==
          document.getElementById('confirm_Password').value) {
          document.getElementById('message').style.color = 'green';
          document.getElementById('message').innerHTML = 'matching';
		  document.getElementById('sumbit').enabled = true
      } else {
      		document.getElementById('message').style.color = 'red';
          document.getElementById('message').innerHTML = 'not matching';
		  ocument.getElementById('submit').enabled = false
      }
  }
	</script>
</head> 
<body>
<?php
session_start();
include 'functions.php';
?>
	    <div class="center">
	        <h1>Create a new account</h1>
			<!--- need to ask for the following items: Admin	Username	Email	Password	First Name	Last Name --->
	        <form method="post" action= "register.php">
	                <div class="txt_field">
	                <input type="text" name="id" id="id" required>
	                <label>Please enter your ID.</label>
	                </div>
					<div class="txt_field">
	                <input type="text" name="FName" id="FName" required>
	                <label>Please enter your first name.</label>
	                </div>
					<div class="txt_field">
	                <input type="text" name="LName" id="LName" required>
	                <label>Please enter your last name.</label>
	                </div>
					<div class="txt_field">
	                <input type="text" name="Username" id="Username" required>
	                <label>Please choose your username.</label>
	                </div>
	                <div class="txt_field">
	                <input type="text" name="Email" id="Email" required>
	                <label>Please enter a valid email.</label>
	                </div>
				    
	                <div class="txt_field">
	                <input type="password" name="Password" id="Password" onkeyup='check();' required>
	                <label>Enter a new password.</label>
	                </div>
					<div class="txt_field">
	                <input type="password" name="confirm_Password" id="confirm_Password" onkeyup='check();' required>
	                <label>Re-enter your new password.</label>
	                </div>
					<span id='message'></span>
					</br>
	          	<input type="submit" value="Submit" name="register">
				
	        </form>
		<span id='message'></span>
        <h1><a href="login.php">Sign in</a></h1>

    </div>
</body>
</html>