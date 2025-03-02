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

// PREPARE AND EXECUTE QUERY USING PDO PREPARED STATEMENTS
$phone = $_POST['phone'];
$stmt = $conn->prepare("SELECT * FROM reservation WHERE phone = :phone");
$stmt->bindParam(':phone', $phone);
$stmt->execute();

//CHECK IF RECORDS WERE RETURNED
if($stmt->rowCount() > 0){

    //CREATE A TABLE TO DISPLAY RECORD
    echo 'Selected record as the following: <br><br>';
    echo '<p><table cellpadding=10 cellspacing=0 border=1 align="center">';
    echo '<tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Room Type</th>
            <th>Guests</th>
            <th>Requests</th>
            <th>Booking Date</th>
        </tr>';

    //OUT DATA OF EACH ROW
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>'.$row["id"].'</td>';
        echo '<td>'.$row["full_name"].'</td>';
        echo '<td>'.$row["email"].'</td>';
        echo '<td>'.$row["phone"].'</td>';
        echo '<td>'.$row["location"].'</td>';
        echo '<td>'.$row["checkin"].'</td>';
        echo '<td>'.$row["checkout"].'</td>';
        echo '<td>'.$row["room_type"].'</td>';
        echo '<td>'.$row["guests"].'</td>';
        echo '<td>'.$row["requests"].'</td>';
        echo '<td>'.$row["booking_date"].'</td>';
        echo "<td><a href='updateRecord.php?pid=$row[phone]'>UPDATE</a></td>";
        echo '</tr>';
    }
    echo '</table></p>';
} else {
    //ADMIN TYPE WRONG PHONE NUMBER, THIS CAN DISPLAY EXCEPTION "No Record Found"
    echo '<p style="color: red;">No Record Found</p>';
}
//BACK TO SEARCH RECORD
echo '<p><a href="searchRecord.php">Back to Search Record</a></p>';

?>
