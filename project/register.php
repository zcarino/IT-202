<html>
<head>
    <title>Bakery Home </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="main.css">



  </head>
	<head>
		<title>Bakery - Register</title>
		<script>
			function findFormsOnLoad(){
				let myForm = document.forms.regform;
				let mySameForm = document.getElementById("myForm");
				console.log("Form by name", myForm);
				console.log("Form by id", mySameForm);
			}
			function verifyPasswords(form){
				let pe = document.getElementById("password_error");
				if(form.password.value.length == 0 || form.confirm.value.length == 0){
					//alert("You must enter both a password and confirmation password");
					pe.innerText = "You must enter both a password and a confirm password";
					return false;
				}
				if(form.password.value != form.confirm.value){
					//alert("Uhh you made a typo");
					pe.innerText = "Passwords don't match, please try again.";
					return false;
				}
				pe.innerText = "";
				return true;
			}
      function doValidations(form){
				let isValid = true;
				if(!verifyEmail(form)){
					isValid = false;
				}
				if(!verifyPasswords(form)){
					isValid = false;
				}
				return isValid;
			}
      function verifyEmail(form){
				let ee = document.getElementById("email_error");
				if(form.email.value.trim().length  == 0){
					ee.innerText = "Please enter an email address";
					return false;
				}
				else{
					ee.innerText = "";
					return true;
				}
			}
      
		</script>
	</head>
	<nav>
      <div class="Name">
        <h4><a href="https://web.njit.edu/~zjc6/IT-202/project/home.php">Bakery</h4>
      </div>
      <ul class="nav-links">
      <?php if(isset($_SESSION['user_id'])){?>
        <li><a href='logout.php' >Logout</a></li>
      <?php }else{ ?>
        <li><a href='login.php' >Login</a></li>
      <?php } ?>

        <li><a href='profile.php'>Profile</a></li>
        <li><a href='cart.php'>Cart</a></li>
      </ul>
    </nav>
	<div class="content-wrapper">
      <div class="container-text">
        <div class="centered">Register</div>
        <section class="index-banner2">
      </div>
		
		<body onload="findFormsOnLoad();">
			<form name="regform" id="myForm" method="POST"
					onsubmit="return verifyPasswords(this)">
     	<div>
				<label for="email">Email: </label>
				<input type="email" id="email" name="email" placeholder="Enter Email"/>
      	<span id="email_error"></span>
     	</div>
     	<div>
				<label for="pass">Password: </label>
				<input type="password" id="pass" name="password" placeholder="Enter password"/>
     	</div>
     	<div>
				<label for="conf">Confirm Password: </label><br>
				<input type="password" id="conf" name="confirm"/>
				<span id="password_error"></span>
      	</div>
      	<div>
      	<div>
				<div>&nbsp;</div>
				<input type="submit" value="Register"/>
				</div>
			</form>
		</div>
	</div>
   
	</body>
</html>

<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(	   isset($_POST['email']) 
	&& isset($_POST['password'])
	&& isset($_POST['confirm'])
	){
	$pass = $_POST['password'];
	$conf = $_POST['confirm'];
	if($pass != $conf){
		//echo "All good, 'registering user'";
		
		$msg = "Passwords don't match, what's going on there?";
	}
	else{
		$msg = "All good, user registered, whoohoo";
		//let's hash it
		$pass = password_hash($pass, PASSWORD_BCRYPT);
		echo "<br>$pass<br>";
		//it's hashed
		require("config.php");
		$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
		try {
			$db = new PDO($connection_string, $dbuser, $dbpass);
			$stmt = $db->prepare("INSERT INTO `UserReg`
							(email, password) VALUES
							(:email, :password)");
			$email = $_POST['email'];
			$params = array(":email"=> $email, 
						":password"=> $pass);
			$stmt->execute($params);
			header("location: login.php");
		}
		catch(Exception $e){
			echo $e->getMessage();
			exit();
		}
	}
	
}
?>
