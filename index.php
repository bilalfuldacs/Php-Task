<!DOCTYPE html>
<html>
<head>
	<title>Example Form</title>
	<link rel="stylesheet" href="./Styles/login_style.css">
	<style>
	
	</style>
</head>
<body>
	

	<form action="includes/login.php" method="post">
		
		<div class="logo-container">
			<img class="logo" src="images/logo.svg" alt="Logo">
		</div>
<?php
session_start();
if(isset($_GET['error']))
if($_GET['error']=='empty')
{  echo '<div class="error-box"><h2>Fill All Fields</h2></div>';
   }
else if($_GET['error']=='invalid')
{ echo '<div class="error-box"><h2>Wrong LogIn Data</h2></div>';
  ;}


// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Redirect to the home page
    header('Location: ./Includes/News.php');
    exit;}

?>
		<div class="input-container">
			<input type="text" id="username" placeholder="UserName" name="username" placeholder="Username">
			<br><br>
			<input type="password" id="password" placeholder="password" name="password" placeholder="password">
<br>	<br>
<input type="submit" name="login_submit" value="Log In" style="background-color: navy; color: white; padding: 10px 20px; border-radius: 5px; border: none;">

        </div>
	</form>
</body>
</html>