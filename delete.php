<?php

require_once 'actions/db_connect.php';

if($_GET['id']) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tables WHERE id = {$id}";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();

    $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Table</title>
</head>
<body>

	<h3>Do you really want to delete this table?</h3>

	<form action="actions/a_delete.php" method="post">
	    <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
	    <button type="submit">Yes, delete it!</button>
	    <a href="home.php"><button type="button">No, go back!</button></a>
	</form>

</body>
</html>

<?php
}
?>