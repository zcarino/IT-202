<html>
<head>
<head>
    <title>Bakery-Login </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="main.css">



  </head>
	




  </head>
	<body>
	<div class="content-wrapper">
		<form name="loginform" id="myForm" method="POST">
			<label for="email">Email: </label>
			<input type="email" id="email" name="email" placeholder="Enter Email"/>
			<label for="pass">Password: </label>
			<input type="password" id="pass" name="password" placeholder="Enter password"/>
			<input type="submit" value="Login"/>
			<h1>Don't have an account?<h1>
			<a href="register.php">Create an account</a>
		</form>
</div>
	</body>
</html>
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
	$pass = $_POST['password'];
	$email = $_POST['email'];
	
	require("config.php");
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	try {
		$db = new PDO($connection_string, $dbuser, $dbpass);
		$stmt = $db->prepare("SELECT user_id, email, password, user_admin from `UserReg` where email = :email LIMIT 1");
		
        $params = array(":email"=> $email);
        $stmt->execute($params);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
		if($result){
			$userpassword = $result['password'];
			if(password_verify($pass, $userpassword)){
				$id = $result['user_id'];
				$roles = $result['user_admin'];
				echo "You logged in with id of " . $id;
				$user = array(
					"user_id" => $id,
					"email"=>$result['email'],
					"user_admin"=> $roles);
				$_SESSION['user'] = $user;
				//echo "Session: <pre>" . var_export($_SESSION, true) . "</pre>";
				session_start();
				$_SESSION["loggedin"] = true;
				$_SESSION["user_id"] = $id;
				$_SESSION["email"] = $email;
				$_SESSION["user_admin"] = $roles;
				header("location: home.php");
				
			}
			else{
				echo "Failed to login, invalid password";
			}
		}
		else{
			echo "Invalid email";
		}
	}
	catch(Exception $e){
		echo $e->getMessage();
		exit();
	}
}
?> 

