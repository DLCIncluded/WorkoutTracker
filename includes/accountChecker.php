<?PHP
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['username'])){
	$_SESSION['loggedIn'] = "true";
	$username = $_SESSION['username'];
	$loggedIn = "true";
}else{
	$_SESSION['loggedIn'] = "false";
	$loggedIn = "false";
}
?>