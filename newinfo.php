<?PHP
	include("top.php");
	if($loggedIn=="true"){
?>
	<form action="includes/accountManager.php" method="POST">
	<p>Please enter your One Rep Max / Personal Record (1RM) for each of the following:</p>
	<label for="squat1rm">Squat:</label><input type="text" name="squat1rm" id ="squat1rm" /><br/>
	<label for="dead1rm">Deadlift:</label><input type="text" name="dead1rm" id ="dead1rm" /><br/>
	<label for="bench1rm">Bench Press:</label><input type="text" name="bench1rm" id ="bench1rm" /><br/>
		
	<br/>
	<p>Please choose the days you want to work, and name them. Any day you do not wish to workout, leave unchecked.(this can all be edited later if needed)</p>
	
	<input type="checkbox" name="monday" value="1"/>Monday
		<input type="text" name="mondayname" class="hiddeninput" id="monday" Value="Rest Day" placeholder="Name(ex. bodyparts worked)"/><br class="hiddeninput"/>
	<input type="checkbox" name="tuesday" value="2"/>Tuesday
		<input type="text" name="tuesdayname" class="hiddeninput" id="tuesday" Value="Rest Day" placeholder="Name(ex. bodyparts worked)"/><br class="hiddeninput"/>
	<input type="checkbox" name="wednesday" value="3"/>Wednesday
		<input type="text" name="wednesdayname" class="hiddeninput" id="wednesday" Value="Rest Day" placeholder="Name(ex. bodyparts worked)"/><br class="hiddeninput"/>
	<input type="checkbox" name="thursday" value="4"/>Thursday
		<input type="text" name="thursdayname" class="hiddeninput" id="thursday" Value="Rest Day" placeholder="Name(ex. bodyparts worked)"/><br class="hiddeninput"/>
	<input type="checkbox" name="friday" value="5"/>Friday
		<input type="text" name="fridayname" class="hiddeninput" id="friday" Value="Rest Day" placeholder="Name(ex. bodyparts worked)"/><br class="hiddeninput"/>
	<input type="checkbox" name="saturday" value="6"/>Saturday
		<input type="text" name="saturdayname" class="hiddeninput" id="saturday" Value="Rest Day" placeholder="Name(ex. bodyparts worked)"/><br class="hiddeninput"/>
	<input type="checkbox" name="sunday" value="7"/>Sunday
		<input type="text" name="sundayname" class="hiddeninput" id="sunday" Value="Rest Day" placeholder="Name(ex. bodyparts worked)"/><br class="hiddeninput"/>
	

	<input type="hidden" name="newinfo" value="true" />
	<input type="submit" name="save" value="Save" />
	</form>
<?PHP
	}else{
?>
	<p>You need to be logged in to view this page, either <a href="register.php">register</a> or <a href="login.php">login</a>.</p>
<?PHP
	}
	include("bottom.php");
?>

















