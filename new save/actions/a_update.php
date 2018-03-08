<?php

require_once 'db_connect.php';

	if($_POST) {
	    $capacity = $_POST['capacity'];
	    $reservation = $_POST['reservation'];

	    $id = $_POST['id'];

	    $sql = "UPDATE tables SET capacity = '$capacity', reservation = '$reservation' WHERE id = {$id}";

	    if($conn->query($sql) === TRUE) {
	        echo "<p>Succcessfully Updated</p>";
	        echo "<a href='../update.php?id=".$id."'><button type='button'>Back</button></a>";
	        echo "<a href='../home.php'><button type='button'>Home</button></a>";
	    } else {
	        echo "Erorr while updating record : ". $conn->error;
	    }

	    $conn->close();

	}

?>