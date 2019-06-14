<?PHP
	include("top.php");
	

	if(isset($_GET['loggedout']) && $_GET['loggedout']=="true"){
		echo "Successfully Logged out!<br><br>";
	}

	
	if($loggedIn == "true"){
		//pull from DB
		$day = date('N');
		
		$query = "SELECT * FROM users WHERE username='$username'";
		$result = $connection->query($query);
		$row = $result->fetch_assoc();
		$workoutid = $row['workoutid'];
		$squat1rm = $row['squat1rm'];
		$dead1rm = $row['dead1rm'];
		$bench1rm = $row['bench1rm'];
		
		$query = "SELECT * FROM workoutdays WHERE username='$username' AND day='$day' AND workoutid='$workoutid'";
		$result = $connection->query($query);
		$row = $result->fetch_assoc();
		if($result->num_rows > 0){
			$dayname = $row['name'];
			$query = "SELECT * FROM workouts WHERE username='$username' AND day='$day' AND workoutid='$workoutid'";
			$result = $connection->query($query);
			
			if($result->num_rows > 0){
				
				echo "<ul>";
				echo "<li>".htmlspecialchars($dayname)."</li>";
				
				while($row=$result->fetch_assoc()){
					echo "<li><span style='font-weight:bold;'>";
					echo htmlspecialchars($row['name']);
					echo "</span><br>Sets: ".htmlspecialchars($row['sets']);
					echo " X Reps: ".htmlspecialchars($row['reps']);
					echo " @ Weight: ".htmlspecialchars($row['weight']);
					echo "</li>";
				}
				echo "</ul>";
			}			
			else {
				echo "No Workouts today!";
			}
		}
		else {
			echo "No Workout created for today!";
		}
		echo '<p><a href="editworkout.php" class="bottom">Edit Workout</a></p>';
		
		
	}
	else{
		echo "Please <a href='login.php'>login</a> or <a href='register.php'>Register</a> view this content.";
	}
?>

<!--
<ul id="day1">
	<li>Chest Shoulder Tricep 1 - Chest focus</li>
	<li>Flat Bench 4 x 4-6 75% 1RM (~205)</li>
	<li>Dumbell Fly 3 x 10</li>
	<li>Incline DumbellPress 3 x 10</li>
	<li>Pec Deck 3 x 12</li>
	<li>DB Side Raise 3 x 10 </li>
	<li>Arnie Press 3 x 12</li>
	<li>Shrugs 4 x 10-12</li>
	<li>Cable Tricep Pulldown 3 x 12-15</li>
	<li>Cable French Press 3 x 10-15</li>
	<li>Skull Crushers 3 x 12</li>
	<li>Dips</li>
</ul>

<ul id="day2">
	<li>Back Bicep 1 - Back focus</li>
	<li>Pullup 3 sets AMRAP</li>
	<li>Lat Pulldown 3 x 12</li>
	<li>Machine Rows 3 x 10</li>
	<li>Machine Pulldown 3 x 12</li>
	<li>Behind-back Barbell Shrugs 3 x 12</li>
	<li>Reverse Cable Fly 3 x 10</li>
	<li>Cable face pull 3 x 12-15</li>
	<li>Barbell Curl 3 x 8-10</li>
	<li>Dumbell Curl 3 x 10-12</li>
	<li>EZ Bar Curl 3 x 12-15</li>
	<li>Dumbell Hammer Curl 3 x 10-12</li>
</ul>

<ul id="day3">
	<li>Legs 1 - Quad focus</li>
	<li>Squats 4 x 4-6 @ 70% 1RM (~255) </li>
	<li>Hack Squats 3 x 12</li>
	<li>Leg Press 3 x 12</li>
	<li>Leg Extensions 3 x 15 </li>
	<li>Hip Adduction 3 x 12</li>
	<li>Hip Abduction 3 x 12</li>
	<li>Calf Raises 3 x 15 </li>
</ul>

<ul id="day4">
	<li>Chest Shoulder Tricep 2 - Shoulder focus</li>
	<li>DB Side Raise 3 x 10</li>
	<li>Military Press 3 x 8</li>
	<li>Arnie Press 3 x 10</li>
	<li>Shrugs 4 x 10-12</li>
	<li>Flat Bench 4 x 15 @ 50% 1RM (~135)</li>
	<li>Incline DumbellPress 3 x 12</li>
	<li>Pec Deck 3 x 10</li>
	<li>Cable Tricep Pulldown 3 x 12-15</li>
	<li>Cable French Press 3 x 10-15</li>
	<li>Skull Crushers 3 x 12 </li>
	<li>Dips</li>
</ul>

<ul id="day5">
	<li>Back Bicep 2 - Bicep focus</li>
	<li>Barbell Curl 3 x 8-10</li>
	<li>Dumbell Curl 3 x 10-12</li>
	<li>EZ Bar Curl 3 x 12-15 </li>
	<li>Dumbell Hammer Curl 3 x 10-12</li>
	<li>Pullup 3 sets AMRAP</li>
	<li>Lat Pulldown 3 x 12</li>
	<li>Machine Rows 3 x 10</li>
	<li>Machine Pulldown 3 x 12</li>
	<li>Behind-back Barbell Shrugs 3 x 12</li>
	<li>Cable face pull 3 x 12-15</li>
</ul>

<ul id="day6">
	<li>Legs 2 - Hams focus</li>
	<li>Squats 3 x 10 @ 50% 1RM (~185)</li>
	<li>Lunges 3 x 10 each leg</li>
	<li>Leg Curl 3 x 15</li>
	<li>Deadlift 2x8</li>
	<li>Stiff leg Deadlift 2x 8</li>
	<li>Hip Adduction 3 x 12</li>
	<li>Hip Abduction 3 x 12</li>
	<li>Calf Raises 3 x 15</li>
</ul>
-->

<script>
function myFunction() {
	var d = new Date();
	var n = d.getDay();
	switch(n){
		case 2:
			document.getElementById("day1").style.display = "block";
			break;
		case 3:
			document.getElementById("day2").style.display = "block";
			break;
		case 4:
			document.getElementById("day3").style.display = "block";
			break;
		case 5:
			document.getElementById("day4").style.display = "block";
			break;
		case 6:
			document.getElementById("day5").style.display = "block";
			break;	
		case 7:
			document.getElementById("day6").style.display = "block";
			break;	
	}
}
</script>
<?PHP
include("bottom.php");
?>