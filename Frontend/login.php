<html>
<head>
    <meta charset="utf-8">
    <title>Login Page</title>
	<style>
	<?php include 'main.css'; ?>
    .center{	
      width: 400px;	
    }
	.center h1{	
      border-bottom: 1px #E6E6FA;	
    }
	.txt_field input{	
      padding 0 5px;	
    }
	
	</style>
	</head> 
<body>
<?php
session_start();
include 'functions.php';
?>

    <div class="center">
        <h1>Welcome to Emiratimail</h1>
        <form method="post" action= "login.php">

                <div class="txt_field">
                <input type="text" name="LoginInfo" id="LoginInfo" required>
                <label>Username or Email</label>
                </div>
				
                <div class="txt_field">
                <input type="password" name="Password" id="Password" required>
                <label>Password</label>
                </div>
          	<input type="submit" value="Submit" name="login">
        </form>
        <h1><a href="register.php">Register</a></h1>
    </div>
</body>
</html>
