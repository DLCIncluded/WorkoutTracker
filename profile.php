<?PHP
include("top.php");

if($loggedIn == "true"){
	$query = "SELECT * FROM users WHERE username='$username'";
	$result=$connection->query($query);
	$row=$result->fetch_assoc();
	$squat1rm = $row['squat1rm'];
	$dead1rm = $row['dead1rm'];
	$bench1rm = $row['bench1rm'];

?>





<?PHP
}
else{
	?>
	<p>You need to be logged in to view this page, either <a href="register.php">register</a> or <a href="login.php">login</a>.</p>
<?PHP
}
include("bottom.php");
?>