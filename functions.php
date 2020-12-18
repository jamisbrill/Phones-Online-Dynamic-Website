<?php 


session_start();

// connect to database
$db = mysqli_connect('192.168.1.133', 'Sam', 'pass', 'db');

// variable declaration
$Name = "";
$email    = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTER USER


// return user array from their id
function getUserById($ID){
	global $db;
	$query = "SELECT * FROM Log WHERE ID=" . $ID;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

function isLoggedIn()
{
	if (isset($_SESSION['Name'])) {
		return true;
	}else{
		return false;
	}
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['Name']);
	header("location: login.php");
}


// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $Name, $errors;

	// grap form values
	try {
	$Name = e($_POST['Name']);
	$ID = e($_POST['ID']);
}
catch (exception $e) {
echo "Failed to parse";
    echo $e->getMessage();

}


	// make sure form is filled properly
	if (empty($Name)) {
		array_push($errors, "Name is required");
	}
	if (empty($ID)) {
		array_push($errors, "ID is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		//$ID = md5($ID);
		
		echo 'You-Entered:';
		echo $Name;
		echo $ID;
		
		$query = "SELECT * FROM Log WHERE Name='$Name' AND ID='$ID' ";
		
		
		$results = mysqli_query($db, $query);

					if (mysqli_num_rows($results) == 1) { // user found
				$logged_in_user = mysqli_fetch_assoc($results);
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: index.php');
				




					}
			
			
			
			
			
		}
		
		else {
			array_push($errors, "Wrong Name/ID combination");
		}


$_SESSION['NAME'] = $Name;   //pass name to yhr show users page


					
	}



			





	




