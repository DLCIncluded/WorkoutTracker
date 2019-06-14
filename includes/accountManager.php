<?PHP
ini_set('display_errors', '1');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("dbConn.php");
include_once("accountChecker.php"); // this way we can get the session username



	if(isset($_POST['register'])){
		//echo "register";
		if($_POST['username'] != ''){
			
			if($_POST['password'] != ''){
				
				if($_POST['password2'] != ''){
					
					if($_POST['email'] != ''){
						
						//If we get this far we should be good to process 
						$username = $_POST['username'];
						$email = $_POST['email'];
						$password = $_POST['password'];
						$password2 = $_POST['password2'];
						$query="SELECT * FROM users WHERE username='$username'";
						
						if($password == $password2){
							//make sure passwords match
							
							//Lets get encrypting!
							$salt = md5($username); //Create Salt for password crypt
							$password = crypt($password, '$2a$07$'.$salt.'$'); //Encrypt password using blowfish + salt just created
							
							$result=$connection->query($query);
							
							if($result->num_rows == 0){
								//create a random workout ID for now
								$workoutID = rand(0,10000000);
								// Does not already exist lets create it
								$sql = "INSERT INTO users (username,email,password,squat1rm,dead1rm,bench1rm,workoutid) VALUES ('$username', '$email', '$password', 0,0,0,'$workoutID')";
								if($connection->query($sql)){
									echo "successfully created account";
									//account created lets log them in to make life easier
									$_SESSION['username'] = $username;
									$_SESSION['email'] = $email;									
									
									header("location: https://david-cary.com/workout/newinfo.php");
								}else{
									echo $connection->error;
								}
							}else{
								echo "username already taken";
							}
							
						}else{
							echo "passwords do not match.";
						}
					}else {
					echo "Missing email";
					}
				}else {
					echo "Missing password";
				}
			}else {
				echo "Missing password";
			}
		} else {
			echo "Missing Username";
		}
		
		
		
	}
	
	if(isset($_POST['login'])){
		if($_POST['username'] != ''){
			
				$username = $_POST['username'];
				$password = $_POST['password'];
				$query="SELECT * FROM users WHERE username='$username'";
				
				$result=$connection->query($query);
				
				if($result->num_rows == 1){
					echo "found user $username -";
					$row=$result->fetch_assoc();
					
					$passwordHash = $row['password'];
					if(crypt($password, $passwordHash) == $passwordHash) { //generate new crypt using the hash in db as the salt to create a hash to check against the db... yea confusing but its how it works...
						//set session vars so we can use them elsewhere
						$_SESSION['username'] = $row['username'];
						$_SESSION['email'] = $row['email'];
						echo "logged in";
						header("location: https://david-cary.com/workout/");
					}else {
						
						echo "Invalid password";
						//header("location: ".$site."info.php?msg=pass");
					}
				}else {
				echo "User not found";
			}
			
		} else {
			echo "Missing Username";
		}
		
		
		
	}
	
	if(isset($_POST['newinfo'])){
		
		//get info from form for 1RM info
		$squat1rm = $_POST['squat1rm'];
		$dead1rm = $_POST['dead1rm'];
		$bench1rm = $_POST['bench1rm'];
		
		//checkboxes values - basically yes or no if they are working out that day(if not sent by form set to 0)
		if(isset($_POST['monday'])){
			$monday = 1;
		}else{
			$monday = 0;
		}
		if(isset($_POST['tuesday'])){
			$tuesday = 1;
		}else{
			$tuesday = 0;
		}
		if(isset($_POST['wednesday'])){
			$wednesday = 1;
		}else{
			$wednesday = 0;
		}
		if(isset($_POST['thursday'])){
			$thursday = 1;
		}else{
			$thursday = 0;
		}
		if(isset($_POST['friday'])){
			$friday = 1;
		}else{
			$friday = 0;
		}
		if(isset($_POST['saturday'])){
			$saturday = 1;
		}else{
			$saturday = 0;
		}
		if(isset($_POST['sunday'])){
			$sunday = 1;
		}else{
			$sunday = 0;
		}
		//echo $monday ." - ". $tuesday ." - ". $wednesday ." - ". $thursday ." - ". $friday ." - ". $saturday ." - ". $sunday;
		
		//names of the days they pick, or rest days by default
		$mondayname = $_POST['mondayname'];
		$tuesdayname = $_POST['tuesdayname'];
		$wednesdayname = $_POST['wednesdayname'];
		$thursdayname = $_POST['thursdayname'];
		$fridayname = $_POST['fridayname'];
		$saturdayname = $_POST['saturdayname'];
		$sundayname = $_POST['sundayname'];
			
		// first lets get the user from the users db:
		$query = "SELECT * FROM users WHERE username='$username'";
		$result=$connection->query($query);
		

		if($result->num_rows == 1){
			//start pulling the info 
			$row = $result->fetch_assoc();
			$workoutID = $row['workoutid'];
			
			//save their 1RMs
			$query = "UPDATE users SET squat1rm='$squat1rm', dead1rm='$dead1rm', bench1rm='$bench1rm' WHERE username='$username'";
			if($connection->query($query)){
				echo "successfully updated 1RMs<br>";
			}else{
				echo $connection->error;
			}
			
			//create queries to put into the workout days for the user
			$query = "INSERT INTO workoutdays (day,active,name,username,workoutid) VALUES (1, '$monday', '$mondayname', '$username','$workoutID')";
			if($connection->query($query)){
				echo "successfully created monday<br>";
			}else{
				echo $connection->error;
			}
			
			$query = "INSERT INTO workoutdays (day,active,name,username,workoutid) VALUES (2, '$tuesday', '$tuesdayname', '$username','$workoutID')";
			if($connection->query($query)){
				echo "successfully created tuesday<br>";
			}else{
				echo $connection->error;
			}
			
			$query = "INSERT INTO workoutdays (day,active,name,username,workoutid) VALUES (3, '$wednesday', '$wednesdayname', '$username','$workoutID')";
			if($connection->query($query)){
				echo "successfully created wednesday<br>";
			}else{
				echo $connection->error;
			}
			
			$query = "INSERT INTO workoutdays (day,active,name,username,workoutid) VALUES (4, '$thursday', '$thursdayname', '$username','$workoutID')";
			if($connection->query($query)){
				echo "successfully created thursday<br>";
			}else{
				echo $connection->error;
			}
			
			$query = "INSERT INTO workoutdays (day,active,name,username,workoutid) VALUES (5, '$friday', '$fridayname', '$username','$workoutID')";
			if($connection->query($query)){
				echo "successfully created friday<br>";
			}else{
				echo $connection->error;
			}
			
			$query = "INSERT INTO workoutdays (day,active,name,username,workoutid) VALUES (6, '$saturday', '$saturdayname', '$username','$workoutID')";
			if($connection->query($query)){
				echo "successfully created saturday<br>";
			}else{
				echo $connection->error;
			}
			
			$query = "INSERT INTO workoutdays (day,active,name,username,workoutid) VALUES (7, '$sunday', '$sundayname', '$username','$workoutID')";
			if($connection->query($query)){
				echo "successfully created sunday<br>";
			}else{
				echo $connection->error;
			}
			header("location: https://david-cary.com/workout/editworkout.php");
			
		}
		
		
	}
	
	
	
	if(isset($_POST['updateworkouts'])){
		//updating workout to the db 
		
		//we pull an array from the form 
		
		foreach ($_POST['workout'] as $workoutRow) {
			echo "<pre>";
			print_r($workoutRow);
			echo "</pre>";
			$id = $workoutRow['id'];
			$name = $workoutRow['name'];
			//$reps = $workoutRow['reps'];
			$sets = $workoutRow['sets'];
			$weight = $workoutRow['weight'];
			$reps = $workoutRow['reps'];
			$day = $_POST['day'];
			$username = $_POST['username'];
			$workoutid = $_POST['workoutid'];
			$dayname = $_POST['dayname'];
			
			$query = "UPDATE workouts SET name='$name', sets='$sets', reps='$reps', weight='$weight' WHERE username='$username' AND workoutid='$workoutid' AND id='$id'";
			if($connection->query($query)){
				
				$query = "UPDATE workoutdays SET name='$dayname' WHERE username='$username' AND workoutid='$workoutid' AND day='$day'";
				if($connection->query($query)){
					echo "successfully updated workout $name<br>";
					header("location: https://david-cary.com/workout/editworkout.php");
				}else{
					echo $connection->error;
				}
			}else{
				echo $connection->error;
			}
		}
		

	}
	
	if(isset($_POST['newworkout'])){
		//adding new workout to the db 
		$name = $_POST['name'];
		$reps = $_POST['reps'];
		$sets = $_POST['sets'];
		if($_POST['weight'] != ''){
			$weight = $_POST['weight'];
		}else{
			$weight = 0;
		}
		
		$day = $_POST['day'];
		$username = $_POST['username'];
		$workoutid = $_POST['workoutid'];
		
		$query = "INSERT INTO workouts (name,reps,sets,weight,day,feel,workoutid,username) VALUES ('$name', '$reps', '$sets', '$weight','$day',1,'$workoutid','$username')";
		if($connection->query($query)){
			echo "successfully created $name<br>";
			header("location: https://david-cary.com/workout/editworkout.php");
		}else{
			echo $connection->error;
		}
	}
	
	if(isset($_POST['deleteworkout'])){
		//delete the workout from the db 
		$username = $_POST['username'];
		$workoutid = $_POST['workoutid'];
		$id = $_POST['id'];
		
		$query = "DELETE FROM workouts WHERE username='$username' AND workoutid='$workoutid' AND id='$id'";
		if($connection->query($query)){
			echo "successfully deleted workout<br>";
			header("location: https://david-cary.com/workout/editworkout.php");
		}else{
			echo $connection->error;
		}
	}
	
?>
