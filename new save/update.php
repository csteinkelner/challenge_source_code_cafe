<?php
require_once 'actions/db_connect.php';


if($_GET['id']) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tables WHERE id = {$id}";
    $result = $conn->query($sql);

    $data = $result->fetch_assoc();

    $conn->close();

?>

<?php 
require_once 'parts/head.php';
?>

    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 50%;
        }

        table tr th {
            padding-top: 20px;
        }
    </style>
</head>
<body>

<fieldset>
    <legend>Update Tables</legend>

    <form action="actions/a_update.php" method="post">
        <table cellspacing="0" cellpadding="0">
            <tr>
                <th>Capacity</th>
                <td><input type="text" name="capacity" placeholder="capacity" value="<?php echo $data['capacity'] ?>" /></td>
            </tr>  
            <tr>
                <th>Reservation</th>
                <td><input type="text" name="reservation" placeholder="0 or 1" value="<?php echo $data['reservation'] ?>" /></td>
            </tr>
            <tr>
                <input type="hidden" name="id" value="<?php echo $data['id']?>" />
                <td><button type="submit">Save Changes</button></td>
                <td><a href="home.php"><button type="button">Back</button></a></td>
            </tr>
        </table>
    </form>
</fieldset>

</body>
</html>

<?php
}
?>

<!-- <input type="radio" name="reservation" class="checkbox_check" value="0" />

<?php 
// if (isset($_POST['reservation'])) {
    // echo "1"; 
// }else{
    // echo "0";
};
?> -->