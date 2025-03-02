<html>
<head>
    <title>Delete Record Booking Hotel</title>
</head>
<body>

<?php
//DATABASE CONNECTION
$host = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_reservations";

//CREATE CONNECTION
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) { //CHECK CONNECTION
    die("Database connection failed: " . $e->getMessage());
}

//GET INPUT VALUE
$dbname = $_POST ['phone'];

//SQL TO DELETE RECORD
$sql = "DELETE FROM reservation WHERE phone=$dbname";

//ECHO SUCCEST OR NOT
if($conn->query($sql)===TRUE){
    echo "Error Deleted Record";
}
else {
    echo "Record Deleting Success";
}

//CLOSE CONNECTION

echo '<p><a href="adminMenu.php">Back to Main Menu</a></p>';


?>

</body>
</html>