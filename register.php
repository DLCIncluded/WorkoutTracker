<?PHP
	include("top.php");
	if($loggedIn=="false"){
?>
	<form action="includes/accountManager.php" method="POST">
	<p>Please enter the following</p>
	<label for="username">Username:</label><input type="text" name="username" id ="username" /><br/>
	<label for="email">Email:</label><input type="text" name="email" id ="email" /><br/>
	<label for="password">Password:</label><input type="password" name="password" id ="password" /><br/>	
	<label for="password2">Repeat:</label><input type="password" name="password2" id ="password2" /><br/>	
	<input type="hidden" name="register" value="true" />
	<input type="submit" name="save" value="Save" />
	</form>
	<p>Already have an account? <a href="login.php">Login!</a></p>
<?PHP
	}else{
?>
	<p>You are already logged in, please <a href="logout.php">logout</a> before you can see this page.</p>
<?PHP
	}
	include("bottom.php");
?>



















