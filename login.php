<?PHP
	include("top.php");
	if($loggedIn=="false"){
?>
	<form action="includes/accountManager.php" method="POST">
	<label for="username">Username:</label><input type="text" name="username" id ="username" /><br/>
	<label for="password">Password:</label><input type="password" name="password" id ="password" /><br/>
	<input type="hidden" name="login" value="true" />
	<input type="submit" name="login" value="Login" />
	</form>
	<p>Don't have an account? <a href="register.php">Register!</a></p>
<?PHP
	}else{
?>
	<p>You are already logged in, please <a href="includes/killSession.php">logout</a> before you can see this page.</p>
<?PHP
	}
	include("bottom.php");
?>



















