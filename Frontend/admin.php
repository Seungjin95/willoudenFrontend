<?php
  session_start();
  include 'functions.php';
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }
  
  if(isset($_SESSION['user'])){
      $user = $_SESSION['user'];
  }
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Admin Landing Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      body{
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background: linear-gradient(120deg, #9370DB,#E6E6FA);
        height: 100vh;
        overflow: hidden;
      }

      .sidebar {
        height: 100%;
        width: 170px;
        left: 0;
        top: 0;
        padding-top: 10px;
        background-color: #9370DB;
        position:fixed;
      }

      .sidebar a {
        padding: 8px;
        font-size: 18px;
        display: block;
        color: #f2f2f2;
        text-decoration: none;
      }

      .body-text {
        margin-left: 150px;
        font-size: 15px;
      }

      #navlist {
            background-color: #9370DB;
            position: absolute;
            width: 100%;

        }
            
        #navlist a {
            float:right;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 22px;
        }
        
        .navlist-right{
            float:right;
        }
    
        #navlist a:hover {
            background-color: #ddd;
            color: black;
        }
            
        .search input[type=text]{
            width:500px;
            height:45px;
            border-radius:25px;
            border: none;
        }
            
        .search{
            margin:14px;
            margin-left:200px;
        }
            
        .search button{
            background-color: #9370DB;
            color: #f2f2f2;
            padding: 5px 10px;
            margin-right: 16px;
            font-size: 18px;
            border: none;
            cursor: pointer;
        }

        /*send email box */
        .open-button {
          background-color: #9370DB;
          color: white;
          padding: 16px 20px;
          border: none;
          cursor: pointer;
          opacity: 0.8;
          position: fixed;
          bottom: 23px;
          right: 28px;
          width: 280px;
        }
		
        /*send profile box */
        .open-button2 {
          background-color: #9370DB;
          color: white;
          padding: 16px 20px;
          border: none;
          cursor: pointer;
          opacity: 0.8;
          position: fixed;
          bottom: 90px;
          right: 28px;
          width: 280px;
        }

        .open-button3 {
          background-color: #9370DB;
          color: white;
          padding: 16px 20px;
          border: none;
          cursor: pointer;
          opacity: 0.8;
          position: fixed;
          bottom: 1390px;
          right: 28px;
          width: 100%;
        }
		
        .form-popup {
          display: none;
          position: fixed;
          bottom: 0;
          right: 15px;
          border: 3px solid #f1f1f1;
          z-index: 9;
        }
		
		    .profile-popup {
          display: none;
          position: fixed;
          bottom: height-50%;
          right:35%;
		      align-items: center;
		      justify-content: center;
          border: 3px solid #f1f1f1;
        }

        .dashboard {
          display: none;
          position: fixed;
          right:35%;
          top: 10%;
		      align-items: center;
		      justify-content: center;
          border: 3px solid #f1f1f1;
        }

        .form-container {
          max-width: 500px;
          padding: 10px;
          background-color: #E6E6FA;
        }

        .form-container1 {
          max-width: 1000px;
          padding: 10px;
          background-color: #E6E6FA;
        }

        /* Full-width input fields */
        .form-container input[type=text] {
          width: 100%;
          padding: 15px;
          margin: 5px 0 22px 0;
          border: none;
          background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus{
          background-color: #ddd;
          outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
          background-color: #04AA6D;
          color: white;
          padding: 16px 20px;
          border: none;
          cursor: pointer;
          width: 50%;
          margin-bottom:10px;
          opacity: 0.8;
        }
		
		    .form-container .btn2 {
          background-color: #9370DB;
          color: white;
          padding: 16px 20px;
          border: none;
          cursor: pointer;
          width: 30%;
          margin-bottom:10px;
          opacity: 0.8;
		      border-radius: 50%;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
          background-color: #9370DB;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, .open-button:hover {
          opacity: 1;
        }
		
		textarea {
		  background-color: #f1f1f1;
      width: 100%;
		  height: 150px;
		  padding: 12px 20px;
		  font-size: 16px;
		  resize: none;
		  outline: none;
		  border: none;
		}
		
		textarea:focus {
		  background-color: #ddd;
		}

    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }

  </style>
</head>
<body>

<!--Top nav bar --> 
<div id="navlist">
        <a href='logout.php'>Logout</a>
		<a href="javascript:openForm2()">"<?php echo strtoupper($user['First Name'][0]); echo " "; echo strtoupper($user['Last Name'][0]);?>"</a>
        <div class="search">
            <form action="#">
                <input type="text"
                    placeholder=" Search"
                    name="search">
                <button>
                    <i class="fa fa-search"
                        style="font-size: 18px;">
                    </i>
                </button>
            </form>
        </div>
    </div>

<!--sidebar --> 
<div class="sidebar">
  <a href="employee.php"><img src="EmiratiMail.com-logo1d7.jpg" alt="Home" style="width:150px;height:70px;"></a>
  <a href="javascript:openForm2()"><?php echo $user['Username'] ?></a>
  <a href="javascript:openForm3()">Dashboard</a>
  <a href="javascript:openForm()">New Mail</a>
  <a href="#inbox">Inbox</a>
  <a href="#filtered">Filtered Mail</a>
  <a href="#spam">Spam</a>
  <a href="#sent">Sent</a>

<!--send email popup box -->  
<button class="open-button" onclick="openForm()">Send Email</button>

<div class="form-popup" id="myForm">
  <form method='post' action="admin.php" class="form-container">
  	<img src="EmiratiMail.com-logo1d.jpg" alt="Home" style="width:500px;height:70px;"></a>
    <h1>Send Email</h1>

    <label for="email"><b>To:</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="subject"><b>Subject</b></label>
    <input type="text" placeholder="Subject" name="subject" required>

    <label for="message"><b>Message</b></label>
    <textarea rows="4" cols="65" type="text" placeholder="Enter message" name="message" required></textarea>

    <button type="submit" class="btn" name="send">Send</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<!--Profile popup box -->  

<div class="profile-popup" id="profilePopup">
<form action="" class="form-container">
    <img src="EmiratiMail.com-logo1d.jpg" style="width:500px;height:70px;"></a>
	<button type="button" class="btn2"><h1><?php echo strtoupper($user['First Name'][0]); echo " "; echo strtoupper($user['Last Name'][0]);?></h1></button>
	<h3> Employee ID: <?php echo $user['EmployeeID'] ?></h3>
	<h3> Employee Name: "<?php echo strtoupper($user['First Name']); echo " "; echo strtoupper($user['Last Name']);  ?>"</h3>
	<h3> Employee Email: <?php echo $user['Email'] ?></h3>
	<button type="button" class="btn cancel" onclick="closeForm2()">Close</button>
</form>
</div>

<div class="dashboard" id="dashboard">
<form method="post" action="admin.php" class="form-container1">
    <h1>Dashboard</h1>   
    <?php
    echo "<table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Employee ID</th>
        <th>Email</th>
        <th>Password</th>
        <th>Select</th>
      </tr>";

     $query= "SELECT * FROM  EmployeeInfo"; 
     $result = mysqli_query($db,$query);
 
     if ($result->num_rows > 0) {
         while ($row = $result -> fetch_assoc()) { 
         echo "<tr>";
         echo "<td>".$row["FirstName"]. "</td>";      
         echo "<td>".$row["LastName"]. "</td>";
         echo "<td>".$row["Username"]."</td>";
         echo "<td>".$row["EmployeeID"]. "</td>";      
         echo "<td>".$row["Email"]. "</td>";
         echo "<td>".$row["Password"]."</td>";
         echo "<td><input type='checkbox' name ='checkbox[]' value='".$row['EmployeeID']."'></td>";
         echo "</tr>";
         }
         echo "</table>";
         echo "<br><br>";
     }  
   ?>
   <h3>Add/Update</h3>
	    <div class="txt_field">
	      <input type="text" name="id" id="id">
	      <label>ID</label>
	    </div>
			<div class="txt_field">
	      <input type="text" name="FName" id="FName">
	      <label>First name</label>
	    </div>
			<div class="txt_field">
	      <input type="text" name="LName" id="LName">
	      <label>Last name</label>
	    </div>
			<div class="txt_field">
	      <input type="text" name="Username" id="Username">
	      <label>Username</label>
	      </div>
	      <div class="txt_field">
	      <input type="text" name="Email" id="Email">
	      <label>Email</label>
	    </div>   
	    <div class="txt_field">
	      <input type="password" name="Password" id="Password" onkeyup='check();'>
	      <label>Password</label>
	    </div>
			<div class="txt_field">
	      <input type="password" name="confirm_Password" id="confirm_Password" onkeyup='check();'>
	      <label>Re-enter password.</label>
	    </div>
      <br>

    <input type="submit" value ="Delete" name="delete">
    <input type="submit" value="Add" name="register">
    <input type="submit" value="Update" name="update">
	  <button type="button" class="btn cancel" onclick="closeForm3()">Close</button>
</form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

function openForm2() {
  document.getElementById("profilePopup").style.display = "block";
}

function closeForm2() {
  document.getElementById("profilePopup").style.display = "none";
}
function openForm3() {
  document.getElementById("dashboard").style.display = "block";
}

function closeForm3() {
  document.getElementById("dashboard").style.display = "none";
}
</script>

</div>
</body>
</html>
