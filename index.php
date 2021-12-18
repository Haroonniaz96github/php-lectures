<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['submit'])){
//store form data into variables
$name = $_POST['name'];

//insert data into database
$sql = "INSERT INTO Users (name)
VALUES ('$name')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

//Fetch Data from database

$sql = "SELECT id, name FROM Users";
$result = $conn->query($sql);


//Delete Record

echo($_GET['ddd']);
$id=$_GET['ddd'];
// sql to delete a record
$sql = "DELETE FROM Users WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

mysqli_close($conn);
?>
<html>
<head>

</head>
<body>
<form action="index.php" method="post">
    <input type="text" name="name">
    <button name="submit" type="submit">Submit</button>
</form>
<table>
    <thead>
    <tr>
        <td>id</td>
        <td>name</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo  $row["id"] ?></td>
        <td><?php echo  $row["name"] ?></td>
        <td><a href="index.php?ddd=<?php echo $row["id"]; ?>">Delete</a>
        </td>
    </tr>
    <?php }
    } else {
    echo "0 results";
    }
    ?>
    </tbody>
</table>
</body>
</html>
