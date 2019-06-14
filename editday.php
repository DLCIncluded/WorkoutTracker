<?PHP
include_once("top.php");

//check if logged in
//pull info to grab current workouts

	if($loggedIn=="true"){
		
		$sql = "SELECT * FROM users WHERE username='$username'";
		$result=$connection->query($sql);
		if($result->num_rows == 1){
			
			//if we find the user lets pull his workout id
			$row = $result->fetch_assoc();
			$workoutid = $row['workoutid'];
			$squat1rm = $row['squat1rm'];
			$dead1rm = $row['dead1rm'];
			$bench1rm = $row['bench1rm'];
		}
		
		if(isset($_GET['day'])){
			$day = $_GET['day'];
			
			switch($day){
				case 'monday': 
					$day = 1;
					break;
				case 'tuesday': 
					$day = 2;
					break;
				case 'wednesday': 
					$day = 3;
					break;
				case 'thursday': 
					$day = 4;
					break;
				case 'friday': 
					$day = 5;
					break;
				case 'saturday': 
					$day = 6;
					break;
				case 'sunday': 
					$day = 7;
					break;
				default:
					$day = 1;
					break;				
			}
			
			$newWorkoutForm = '
					<table>
					<form action="includes/accountManager.php" method="POST">
					<tr>
					<td>Name:</td>
					<td><input type="text" name="name" placeholder="Workout ie: Bench Press"/></td>
					</tr>
					
					<tr>
					<td>Sets:</td>
					<td><input type="text" name="sets" placeholder="Sets"/></td>
					</tr>
					
					<tr>
					<td>X Reps:</td>
					<td><input type="text" name="reps" placeholder="Reps"/></td>
					</tr>
					
					<tr>
					<td>@ Weight:</td>
					<td><input type="text" name="weight" id="weight" placeholder="Weight"/></td>
					</tr>
					
					<tr>
					<td></td><td><a href="#" id="openBox">Calc. % 1RM</a></td>
					</tr>
					
					<input type="hidden" name="username" value="'.$username.'" />
					<input type="hidden" name="workoutid" value="'.$workoutid.'" />
					<input type="hidden" name="day" value="'.$day.'" />
					<input type="hidden" name="newworkout" value="newworkout" />
					<tr>
					<td><br><button name="submit" class="savebtn">'.$saveIcon.'</button></td>
					<td><br><a href="editworkout.php">'.$cancelIcon.'</a></td>
					</tr>
				</form>';
			//echo $day." - ".$username." - ".$workoutid." - ";
			//lets pull any workouts for the day we're editing
			
			if(isset($_GET['delete']) && $_GET['delete']=="true"){
				echo "Are you sure you wish to delete that workout?";
				echo "<form action='includes/accountManager.php' method='POST'>";
				echo "<input type='hidden' name='deleteworkout' value='deleteworkout'/>";
				echo "<input type='hidden' name='username' value='$username'/>";
				echo "<input type='hidden' name='workoutid' value='$workoutid'/>";
				echo "<input type='hidden' name='day' value='$day'/>";
				echo "<input type='hidden' name='id' value='".$_GET['id']."'/>";
				echo "<br><button type='submit' name='deleteworkout' class='confirm' value=''>$confirmIcon</button>";
				echo " <a href='editday.php?day=".$_GET['day']."' class='cancel'>$cancelIcon</a>";
				echo "</form>";
			}
			elseif(isset($_GET['new']) && $_GET['new']=="true"){
				//if we click the "new" link:
				echo $newWorkoutForm;
			}else{
				echo "<form action='includes/accountManager.php' method='POST'>";
				$query = "SELECT * FROM workoutdays WHERE username='$username' AND day='$day' AND workoutid='$workoutid'";
				$result = $connection->query($query);
				
				$row=$result->fetch_assoc();
				echo "Day Name: <input type='text' name='dayname' value='".htmlspecialchars($row['name'])."'/><br><br>";
				
				//echo "<a href='editday.php?day=".$_GET['day']."&new=true'><img src='https://img.icons8.com/color/24/000000/add.png'></a> ";
				echo "<div class='centered'><a href='editday.php?day=".$_GET['day']."&new=true'>$newIcon</a>";
				echo "<a href='editworkout.php'>$cancelIcon</a></div>";
				
				$query = "SELECT * FROM workouts WHERE username='$username' AND day='$day' AND workoutid='$workoutid'";
				$result = $connection->query($query);
				if($result->num_rows > 0){
					$i=0;
					
					while($row=$result->fetch_assoc()){
						echo "<table>";
						echo "<tr>";
						echo "<td>Name:</td> <td><input type='text' name='workout[".$i."][name]' value='".htmlspecialchars($row['name'])."'/></td> </tr>";
						echo "<tr><td>Sets:</td> <td><input type='text' name='workout[".$i."][sets]' value='".htmlspecialchars($row['sets'])."'/></td> </tr>";
						echo "<tr><td>Reps:</td> <td><input type='text' name='workout[".$i."][reps]' value='".htmlspecialchars($row['reps'])."'/></td> </tr>";
						echo "<tr><td>Weight:</td> <td><input type='text' name='workout[".$i."][weight]' value='".htmlspecialchars($row['weight'])."'/></tr>";
						echo "<tr><td><a href='editday.php?day=".$_GET['day']."&delete=true&id=".$row['id']."'>$trashIcon</a></td> <tr>";
						echo "<input type='hidden' name='workout[".$i."][id]' value='".htmlspecialchars($row['id'])."'/>";
						echo "</table>";
						echo "<br>";
						$i++;
						
					}
					
					echo "<input type='hidden' name='updateworkouts' value='updateworkouts'/>";
					echo "<input type='hidden' name='username' value='$username'/>";
					echo "<input type='hidden' name='workoutid' value='$workoutid'/>";
					echo "<input type='hidden' name='day' value='$day'/>";
					echo "<input type='submit' name='updateworkouts' value='Save'/>";
					echo "</form>";
					echo "<br>";
					
					echo "<div class='centered'><a href='editday.php?day=".$_GET['day']."&new=true'>$newIcon</a>";
					echo "<a href='editworkout.php'>$cancelIcon</a></div>";
					//echo $newWorkoutForm;
				}else{
					echo "We are unable to find any workouts for this day, please create one!<br>";
					
					echo $newWorkoutForm;
				}
			}
?>
	
<?PHP
		}else{
			echo "Please go back, something broke...";
		}	
	}else{
?>
	<p>You need to be logged in to view this page, either <a href="register.php">register</a> or <a href="login.php">login</a>.</p>
<?PHP
	}
?>
<div id="modal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close"><?PHP echo $cancelIcon; ?></span>
	<p>Please select a % for Only the excersize you are creating. This will approximate the % for you, rounding to nearest 0.5.</p>
    Squat 1RM = <?PHP echo $squat1rm; ?> 
	<select name="squat1rmperc" id="squat1rmperc">
		<option value=1>Select</option>
		<option value=0>0%</option>
		<option value=5>5%</option>
		<option value=10>10%</option>
		<option value=15>15%</option>
		<option value=20>20%</option>
		<option value=25>25%</option>
		<option value=30>30%</option>
		<option value=35>35%</option>
		<option value=40>40%</option>
		<option value=45>45%</option>
		<option value=50>50%</option>
		<option value=55>55%</option>
		<option value=60>60%</option>
		<option value=65>65%</option>
		<option value=70>70%</option>
		<option value=75>75%</option>
		<option value=80>80%</option>
		<option value=85>85%</option>
		<option value=90>90%</option>
		<option value=95>95%</option>
		<option value=100>100%</option>
	</select>
	<br>
    Deadlift 1RM = <?PHP echo $dead1rm; ?> 
	<select name="dead1rmperc" id="dead1rmperc">
		<option value=1>Select</option>
		<option value=0>0%</option>
		<option value=5>5%</option>
		<option value=10>10%</option>
		<option value=15>15%</option>
		<option value=20>20%</option>
		<option value=25>25%</option>
		<option value=30>30%</option>
		<option value=35>35%</option>
		<option value=40>40%</option>
		<option value=45>45%</option>
		<option value=50>50%</option>
		<option value=55>55%</option>
		<option value=60>60%</option>
		<option value=65>65%</option>
		<option value=70>70%</option>
		<option value=75>75%</option>
		<option value=80>80%</option>
		<option value=85>85%</option>
		<option value=90>90%</option>
		<option value=95>95%</option>
		<option value=100>100%</option>
	</select>
	<br>
    Bench 1RM = <?PHP echo $bench1rm; ?> 
	<select name="bench1rmperc" id="bench1rmperc">
		<option value=1>Select</option>
		<option value=0>0%</option>
		<option value=5>5%</option>
		<option value=10>10%</option>
		<option value=15>15%</option>
		<option value=20>20%</option>
		<option value=25>25%</option>
		<option value=30>30%</option>
		<option value=35>35%</option>
		<option value=40>40%</option>
		<option value=45>45%</option>
		<option value=50>50%</option>
		<option value=55>55%</option>
		<option value=60>60%</option>
		<option value=65>65%</option>
		<option value=70>70%</option>
		<option value=75>75%</option>
		<option value=80>80%</option>
		<option value=85>85%</option>
		<option value=90>90%</option>
		<option value=95>95%</option>
		<option value=100>100%</option>
	</select>
	<br>
	<input type="button" id="set1rm" value="Save 1RM"/>
  </div>

</div>


<script>
// Get the modal
var modal = document.getElementById("modal");

// Get the button that opens the modal
var btn = document.getElementById("openBox");

//get button that calculates %1RM
var set1rm = document.getElementById("set1rm");


//get the weight text box
var weight = document.getElementById("weight");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 

set1rm.onclick = function() {
	//get % for each
	var squat1rmperc = document.getElementById("squat1rmperc").value;
	var dead1rmperc = document.getElementById("dead1rmperc").value;
	var bench1rmperc = document.getElementById("bench1rmperc").value;
	console.log(squat1rmperc);
	console.log(dead1rmperc);
	console.log(bench1rmperc);
	var calcperc;
	if (squat1rmperc != 1){
		calcperc = squat1rmperc/100 * <?PHP echo $squat1rm; ?>;
		weight.value = Math.ceil(calcperc*2)/2;
		modal.style.display = "none";
	}
	if (dead1rmperc != 1){
		calcperc = dead1rmperc/100 * <?PHP echo $dead1rm; ?>;
		weight.value = Math.ceil(calcperc*2)/2;
		modal.style.display = "none";
	}
	if (bench1rmperc != 1){
		calcperc = bench1rmperc/100 * <?PHP echo $bench1rm; ?>;
		weight.value = Math.ceil(calcperc*2)/2;
		modal.style.display = "none";
	}
}
</script>
<?PHP
include("bottom.php");
?>
