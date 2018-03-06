<?php 
	ob_start();
	session_start();
	require_once 'actions/db_connect.php'; 
	

	$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);

	$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>

    <title>PHP CRUD</title>

	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Great+Vibes" rel="stylesheet">

    <style type="text/css">
        .manageUser {
            width: 50%;
            margin: auto;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }
    </style>

</head>
<body>
	<header id="header" class="">
		<div class="row">
			<div class="col-md-5">
				<h1>Welcome to Source Code, <?php echo $userRow['userName']; ?>!</h1>
			</div>
			<div class="col-md-7">
				<button class="btn" id="sign-out">
					<a href="logout.php?logout">Sign Out</a>
				</button>
			</div>
		</div>
			
			
	</header><!-- /header -->
	
				
<div class="manageUser">
    
    <h3>Free:</h3>
    <table border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>Table</th>
                <th>capacity</th>
                <th>Option</th>
                <!-- <th>reverved</th> -->
            </tr>
        </thead>
        <tbody>
			<?php

	            $sql = "SELECT * FROM tables WHERE reservation = 0";
	            $result = $conn->query($sql);

	            if($result->num_rows > 0) {
	                while($row = $result->fetch_assoc()) {
	                    echo "<tr>
	                        <td>".$row['id']."</td>
	                        <td>".$row['capacity']."</td>
	                        <td>
	                            <a href='update.php?id=".$row['id']."'><button type='button'>Edit</button></a>
	                            <a href='delete.php?id=".$row['id']."'><button type='button'>Delete</button></a>
	                        </td>
	                        
	                    </tr>";
	                }
	            } else {
	                echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
	            }
            ?>
        </tbody>
    </table>
    <h3>Taken:</h3>
    <table border="1" cellspacing="0" cellpadding="0">
		<!-- the inactive -->
		<thead>
            <tr>
                <th>Table</th>
                <th>capacity</th>
                <th>Option</th>
                <!-- <th>reverved</th> -->
            </tr>
        </thead>
        <tbody>
			<?php

	            $sql = "SELECT * FROM tables WHERE reservation = 1";
	            $result = $conn->query($sql);

	            if($result->num_rows > 0) {
	                while($row = $result->fetch_assoc()) {
	                    echo "<tr>
	                        <td>".$row['id']."</td>
	                        <td>".$row['capacity']."</td>
	                        <td>
	                            <a href='update.php?id=".$row['id']."'><button type='button'>Edit</button></a>
	                            <a href='delete.php?id=".$row['id']."'><button type='button'>Delete</button></a>
	                        </td>
	                        
	                    </tr>";
	                }
	            } else {
	                echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
	            }
            ?>
        </tbody>
    </table>
    <a href="create.php"><button type="button" class="btn" id="aT">Add Table</button></a>
</div>

</body>
</html>