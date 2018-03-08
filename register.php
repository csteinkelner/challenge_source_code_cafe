<?php

	ob_start();

	session_start(); // start a new session or continues the previous

	if( isset($_SESSION['user'])!="" ){
		header("Location: home.php"); // redirects to home.php
	}

	//to insurt the dbconnect.php
 	include_once 'actions/db_connect.php';

 	$error = false;
 	$email = "";
 	$name = "";
 	$nameError ="";
	$emailError = "";
	$passError = "";
	// $conn = "";
	


 	if ( isset($_POST['btn-signup']) ) {

		  // sanitize user input to prevent sql injection
		$name = trim($_POST['name']);
		$name = strip_tags($name);		//schutz for fremdangriffen (code/sql)
		$name = htmlspecialchars($name);

		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);

		// basic name validation

		if (empty($name)) {
			$error = true;
			$nameError = "Please enter your full name.";
		} else if (strlen($name) < 3) {
		   	$error = true;
		   	$nameError = "Name must have atleat 3 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
		}

		//basic email validation

		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		} else {
		// check whether the email exist or not
		   $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
		   $result = mysqli_query($conn, $query);
		   $count = mysqli_num_rows($result);
		   if($count!=0){
				$error = true;
				$emailError = "Provided Email is already in use.";
		   	}

		}

		// password validation

		if (empty($pass)){
			$error = true;
		   	$passError = "Please enter password.";
		} else if(strlen($pass) < 6) {
		   	$error = true;
		   	$passError = "Password must have atleast 6 characters.";
		}
		
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);

		// if there's no error, continue to signup
		if( !$error ) {
		   	$query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
		   	$res = mysqli_query($conn, $query);

			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
				unset($name);
				unset($email);
				unset($pass);
		   	} else {
		    	$errTyp = "danger";
		    	$errMSG = "Something went wrong, try again later...";
		   	}
		}
 	}

?>

<?php 
require_once 'parts/head.php';
?>
  <style type="text/css">
  	body{
  		background-image: url('background.jpg')
  	}
  	#box{
      background-color: rgba(255,255,255,0.6);
      padding: 10%;
    }
  </style>
</head>
<body>
<?php require_once 'parts/header_for_back.php'; ?>
 	<div class="container">
    	<div class="row">
			<div class="col-lg-4 col-md-4 col-4"></div>

			<div class="col-lg-5 col-md-5 col-5 offset-lg-5 offset-md-5 col-offset-5" id="box">
			    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
			        <h2>Sign Up.</h2>
					
					<a href="index.php">Sign in Here...</a>
			        <hr />

			        <?php
						if ( isset($errMSG) ) {
					?>

					        <div class="alert">
					 			<?php echo $errMSG; ?>
							</div>

					<?php

			   			}
					?>

					<input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50"/>

					<span class="text-danger"><?php echo $nameError; ?></span>

					<input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40"/>

					<span class="text-danger"><?php echo $emailError; ?></span>

					<input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />

					<span class="text-danger"><?php echo $passError; ?></span>

					<hr />

					<button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
           
				</div>
			</div>
		</div>
    </form>

</body>
</html>
<?php ob_end_flush(); ?>