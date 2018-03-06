<?php 
	require_once 'actions/db_connect.php'; 
	

	$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);

	$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>

    <title>PHP CRUD</title>

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
<div class="manageUser">
    <a href="crud/create.php"><button type="button">Add Table</button></a>
    <table border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>Table</th>
                <th>capacity</th>
                <th>Option</th>
                <th>reverved</th>
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
	                        <td>".$row['reservation']."</td>
	                    </tr>";
	                }
	            } else {
	                echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
	            }
            ?>
        </tbody>
		<!-- the inactive -->
		<thead>
            <tr>
                <th>Table</th>
                <th>capacity</th>
                <th>Option</th>
                <th>reverved</th>
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
	                        <td>".$row['reservation']."</td>
	                    </tr>";
	                }
	            } else {
	                echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
	            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>