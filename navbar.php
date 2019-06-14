<div class="navbar">
<a href="index.php" class="navbarRight"><?PHP echo $homeIcon; ?></a>
<a href="editworkout.php" class="navbarRight"><?PHP echo $editIcon; ?></a>

<?PHP
	if($loggedIn == "true"){
?>
<a href="profile.php" class="navbarRight"><?PHP echo $profileIcon; ?></a>
<a href="logout.php" class="navbarRight"><?PHP echo $logoutIcon; ?></a>
<?PHP
	}else{
?>
<a href="login.php" class="navbarRight"><?PHP echo $loginIcon; ?></a>
<?PHP
	}
?>
</div>