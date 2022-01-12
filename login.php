<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>

<?php
$emailErr ="";
$passwordErr = "";
$confirmPasswordErr = "";
?>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form method="post" action="<?php $_SERVER['PHP_SELF'];?>" class="register-form" role="form">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="email" name="register-email" placeholder="Email" id="register-email" required>
					<span class="error-email error"></span>
					<input type="password" name="register-pswd" placeholder="Password" id="register-pswd" required>
					<span class="error-pass error"></span>
					<input type="password" name="confirm-pswd" placeholder="Confirm Password" id="confirm-pswd" required>
					<span class="error-confirm error"></span>
					<button type="submit" disabled id="register-btn">Sign up</button>
				</form>
				<p class="go-to-home"><a href="index.html">Go to Home</a></p>
			</div>

			<div class="login">
				<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="login-email" placeholder="Email" required>
					<input type="password" name="login-pswd" placeholder="Password" required>
					<button type="submit">Login</button>
				</form>
				<p class="go-to-home-black"><a href="index.html">Go to Home</a></p>
			</div>
	</div>

	<?php 
	// class User {
	// 	public $email;
	// 	public $password;
	  
	// 	function __construct($email,$password) {
	// 	  $this->email = $email;
	// 	  $this->password = $password;
	// 	}
	// }
	$users_array = [];
	$flag = false;
	$regex = "/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
	if(isset($_POST["register-email"])){
		if(!preg_match($regex,$_POST["register-email"])){
			$emailErr = 'email is wrong';
			// echo '<script>alert("email is wrong")</script>';
		} 
		if(strlen($_POST["register-pswd"]) < 5 ){
			$passwordErr = "Password must be 5 characters or more";
			// echo '<script>alert("password is too short")</script>';
		} if($_POST["register-pswd"] !== $_POST["confirm-pswd"]){
			$confirmPasswordErr = "Passwords dont match";
			// echo '<script>alert("passwords dont match")</script>';
		}
		if(preg_match($regex,$_POST["register-email"]) && strlen($_POST["register-pswd"]) >= 5 && $_POST["register-pswd"] === $_POST["confirm-pswd"]){
			if(isset($_SESSION["users"])){
				foreach($_SESSION["users"] as $val){
					if($val["email"] ===  $_POST["register-email"]){
						$flag = true;
						echo '<script>alert("Already registered")</script>';
					}
				}
				if(!$flag){
					$new_user = ["email" => $_POST["register-email"], "password" => $_POST["register-pswd"]];
					// foreach($_SESSION["users"] as $val){
					// 	array_push($users_array,$val);
					// }
					// $users_array = [...$_SESSION["users"]];
					// array_push($users_array,$new_user,...$_SESSION["users"]);
					// array_push($_SESSION["users"],$new_user);
					$_SESSION["users"][] = $new_user;
					// $_SESSION["users"] = $users_array;
					var_dump($_SESSION["users"]);
					echo '<script>alert("Thank you for registering")</script>';
				}
			} else {
				$new_user = ["email" => $_POST["register-email"], "password" => $_POST["register-pswd"]];
				array_push($users_array,$new_user);
				$_SESSION["users"] = $users_array;
				echo '<script>alert("Thank you for registering")</script>';
			}
		}

		
		// $new_user = new User($_POST["register-email"],$_POST["register-pswd"]);
		// print_r($_SESSION["users"]);
	} 

	$login_flag = false;
	if(isset($_POST["login-email"])){
		if(isset($_SESSION["users"])){
			foreach($_SESSION["users"] as $val){
				if($val["email"] ===  $_POST["login-email"]){
					$_SESSION["current-user"] = $val["email"];
					$login_flag = true;
					// echo $_SESSION["current-user"];
					header("location:welcome.php");
				}
			}
		}
		if(!$login_flag){
			echo '<script>alert("No user found, please register")</script>';
		}
	}
	?>

	
	<script>
		let registerBtn = document.getElementById("register-btn");

let registerEmail = document.getElementById("register-email");
let registerPassword = document.getElementById("register-pswd");
let confirmPassword = document.getElementById("confirm-pswd");
let emailError = document.querySelector(".error-email");
let passError = document.querySelector(".error-pass");
let confirmError = document.querySelector(".error-confirm");
let emailReg = false;
let passReg = false;
let confirmReg = false;


registerEmail.addEventListener("keyup", function(e){
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(e.target.value)){
		emailReg = true;
		emailError.innerHTML = "";
    } else {
		emailReg = false;
		emailError.innerHTML = "Your email is wrong"
    }

	if(emailReg && passReg && confirmReg){
		registerBtn.disabled = false;
	} else {
		registerBtn.disabled = true;
	}
})

registerPassword.addEventListener("keyup", function(e){
	if(e.target.value.length < 5){
		passReg = false;
		passError.innerHTML = "Password is too short";
	}else {
		passReg = true;
		passError.innerHTML = "";
	}
	if(emailReg && passReg && confirmReg){
		registerBtn.disabled = false;
	} else {
		registerBtn.disabled = true;
	}
})
confirmPassword.addEventListener("keyup", function(e){
	if(e.target.value === registerPassword.value){
		confirmReg = true;
		confirmError.innerHTML = "";
	} else {
		confirmReg = false;
		confirmError.innerHTML = "Passwords dont match";
	}
	if(emailReg && passReg && confirmReg){
		registerBtn.disabled = false;
	} else {
		registerBtn.disabled = true;
	}
})



	</script>
</body>
</html>