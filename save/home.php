<?php  
	ob_start();
	session_start();

	require_once 'crud/actions/db_connect.php';


	$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);

	$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Big Library</title>

	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Great+Vibes" rel="stylesheet">
</head>
<body>

	<header id="header" class="">
		<h1>Welcome to Source Code, <?php echo $userRow['userName']; ?>!</h1>


	</header><!-- /header -->
	<nav class="navbar navbar-dark bg-primary">
		<ul class="nav nav-pills">
			<li>
				<button class="btn">
					<a href="logout.php?logout">Sign Out</a>
				</button>
			</li>  	    
	  	</ul>
	</nav>
		

	<div class="container">
		<div class="table-responsive">
			
			<?php  require_once 'crud/home.php'; ?>

		</div>
	</div>
</body>
</html>

<?php ob_end_flush(); ?>