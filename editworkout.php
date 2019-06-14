<?PHP
	include("top.php");

//check if logged in
//pull info to grab current workouts

if($loggedIn == "true"){
	$sql = "SELECT * FROM users WHERE username='$username'";
	$result=$connection->query($sql);
	if($result->num_rows == 1){
		
		//if we find the user lets pull his workout id
		$row = $result->fetch_assoc();
		$workoutid = $row['workoutid'];
		//echo $workoutid.$username;
		//Lets check the workoutdays table and grab the info there
		$query = "SELECT * FROM workoutdays WHERE workoutid='$workoutid'";
		$result = $connection->query($query);
		if($result->num_rows > 0){
			// if we find days setup, pull them and
			//put them into an array named $days
			
			for ($days = array (); $row = $result->fetch_assoc(); $days[] = $row);
			//echo "<pre>";
			//print_r($days);
			//echo "</pre>";
			
			
			//ignore for now
			$mondayname = $days[0]['name'];
			$tuesdayname = $days[1]['name'];
			$wednesdayname = $days[2]['name'];
			$thursdayname = $days[3]['name'];
			$fridayname = $days[4]['name'];
			$saturdayname = $days[5]['name'];
			$sundayname = $days[6]['name'];
			
			$mondayactive = $days[0]['active'];
			$tuesdayactive = $days[1]['active'];
			$wednesdayactive = $days[2]['active'];
			$thursdayactive = $days[3]['active'];
			$fridayactive = $days[4]['active'];
			$saturdayactive = $days[5]['active'];
			$sundayactive = $days[6]['active'];
			
			
		}
		
		
	}
}

?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/styles.css">
</head>

<body>
<div class="wrap">
<?PHP
	include("navbar.php");
	if($loggedIn=="true"){
?>
	<div id='wrapday'>
	<form action='includes/accountManager.php' method='POST'>
	<ul>
	<li>Monday - <?PHP echo $mondayname; ?></li>
	
	<?PHP
	$query = "SELECT * FROM workouts WHERE username='$username' AND day='1' AND workoutid='$workoutid'";
	$result = $connection->query($query);
	if($result->num_rows > 0){
		while($row=$result->fetch_assoc()){
			echo "<li>";
			echo "<span style='font-weight:bold'>".htmlspecialchars($row['name'])."</span><br>";
			echo " Sets: ".htmlspecialchars($row['sets']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " @ Weight: ".htmlspecialchars($row['weight']);
			echo "</li>";
		}
	} 
	else{
		echo "<li>No workouts for this day.</li>";
	}
	?>
	<a href="editday.php?day=monday" class="indent">
		<?PHP echo $editIcon; ?>
	</a>
	</ul>
	</div>
	
	<div id='wrapday'>
	<form action='includes/accountManager.php' method='POST'>
	<ul>
	<li>Tuesday - <?PHP echo $tuesdayname; ?></li>
	
	<?PHP
	$query = "SELECT * FROM workouts WHERE username='$username' AND day='2' AND workoutid='$workoutid'";
	$result = $connection->query($query);
	if($result->num_rows > 0){
		while($row=$result->fetch_assoc()){
			echo "<li>";
			echo "<span style='font-weight:bold'>".htmlspecialchars($row['name'])."</span><br>";
			echo " Sets: ".htmlspecialchars($row['sets']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " @ Weight: ".htmlspecialchars($row['weight']);
			echo "</li>\n";
		}
	} 
	else{
		echo "<li>No workouts for this day.</li>";
	}
	?>
	<a href="editday.php?day=tuesday" class="indent">
		<?PHP echo $editIcon; ?>
	</a>
	</ul>
	</div>
	
	<div id='wrapday'>
	<form action='includes/accountManager.php' method='POST'>
	<ul>
	<li>Wednesday - <?PHP echo $wednesdayname; ?></li>
	<?PHP
	$query = "SELECT * FROM workouts WHERE username='$username' AND day='3' AND workoutid='$workoutid'";
	$result = $connection->query($query);
	if($result->num_rows > 0){
		while($row=$result->fetch_assoc()){
			echo "<li>";
			echo "<span style='font-weight:bold'>".htmlspecialchars($row['name'])."</span><br>";
			echo " Sets: ".htmlspecialchars($row['sets']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " @ Weight: ".htmlspecialchars($row['weight']);
			echo "</li>";
		}
	} 
	else{
		echo "<li>No workouts for this day.</li>";
	}
	?>
	<a href="editday.php?day=wednesday" class="indent">
		<?PHP echo $editIcon; ?>
	</a>
	</ul>
	</div>
	
	<div id='wrapday'>
	<form action='includes/accountManager.php' method='POST'>
	<ul>
	<li>Thursday - <?PHP echo $thursdayname; ?></li>
	<?PHP
	$query = "SELECT * FROM workouts WHERE username='$username' AND day='4' AND workoutid='$workoutid'";
	$result = $connection->query($query);
	if($result->num_rows > 0){
		while($row=$result->fetch_assoc()){
			echo "<li>";
			echo "<span style='font-weight:bold'>".htmlspecialchars($row['name'])."</span><br>";
			echo " Sets: ".htmlspecialchars($row['sets']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " @ Weight: ".htmlspecialchars($row['weight']);
			echo "</li>";
		}
	} 
	else{
		echo "<li>No workouts for this day.</li>";
	}
	?>
	<a href="editday.php?day=thursday" class="indent">
		<?PHP echo $editIcon; ?>
	</a>
	</ul>
	</div>
	
	<div id='wrapday'>
	<form action='includes/accountManager.php' method='POST'>
	<ul>
	<li>Friday - <?PHP echo $fridayname; ?></li>
	<?PHP
	$query = "SELECT * FROM workouts WHERE username='$username' AND day='5' AND workoutid='$workoutid'";
	$result = $connection->query($query);
	if($result->num_rows > 0){
		while($row=$result->fetch_assoc()){
			echo "<li>";
			echo "<span style='font-weight:bold'>".htmlspecialchars($row['name'])."</span><br>";
			echo " Sets: ".htmlspecialchars($row['sets']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " @ Weight: ".htmlspecialchars($row['weight']);
			echo "</li>";
		}
	} 
	else{
		echo "<li>No workouts for this day.</li>";
	}
	?>
	<a href="editday.php?day=friday" class="indent">
		<?PHP echo $editIcon; ?>
	</a>
	</ul>
	</div>
	
	<div id='wrapday'>
	<form action='includes/accountManager.php' method='POST'>
	<ul>
	<li>Saturday - <?PHP echo $saturdayname; ?></li>
	<?PHP
	$query = "SELECT * FROM workouts WHERE username='$username' AND day='6' AND workoutid='$workoutid'";
	$result = $connection->query($query);
	if($result->num_rows > 0){
		while($row=$result->fetch_assoc()){
			echo "<li>";
			echo "<span style='font-weight:bold'>".htmlspecialchars($row['name'])."</span><br>";
			echo " Sets: ".htmlspecialchars($row['sets']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " @ Weight: ".htmlspecialchars($row['weight']);
			echo "</li>";
		}
	} 
	else{
		echo "<li>No workouts for this day.</li>";
	}
	?>
	<a href="editday.php?day=saturday" class="indent">
		<?PHP echo $editIcon; ?>
	</a>
	</ul>
	</div>
	
	<div id='wrapday'>
	<form action='includes/accountManager.php' method='POST'>
	<ul>
	<li>Sunday - <?PHP echo $sundayname; ?></li>
	<?PHP
	$query = "SELECT * FROM workouts WHERE username='$username' AND day='7' AND workoutid='$workoutid'";
	$result = $connection->query($query);
	if($result->num_rows > 0){
		while($row=$result->fetch_assoc()){
			echo "<li>";
			echo "<span style='font-weight:bold'>".htmlspecialchars($row['name'])."</span><br>";
			echo " Sets: ".htmlspecialchars($row['sets']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " X Reps: ".htmlspecialchars($row['reps']);
			echo " @ Weight: ".htmlspecialchars($row['weight']);
			echo "</li>";
		}
	} 
	else{
		echo "<li>No workouts for this day.</li>";
	}
	?>
	<a href="editday.php?day=sunday" class="indent">
		<?PHP echo $editIcon; ?>
	</a>
	<ul>
	</div>
<?PHP
	}else{
?>
	<p>You need to be logged in to view this page, either <a href="register.php">register</a> or <a href="login.php">login</a>.</p>
<?PHP
	}
	include("bottom.php");
?>


