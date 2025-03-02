<?php
// DATABASE CONNECTION
$host = 'localhost';
$dbname = 'hotel_reservations';
$username = 'root';
$password = '';

//CREATE CONNECTION
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

//CHECK IF FORM DATA IS SUBMITTED
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $fullName = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $location = htmlspecialchars($_POST['location']);
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $roomType = htmlspecialchars($_POST['room']);
    $guests = intval($_POST['guests']);
    $requests = htmlspecialchars($_POST['requests']);
    $bookingDate = date("d-m-Y H:i:s"); // ASSUME CURRENT DATE TODAY AND TIME

    //INSERT DATA INTO DATABASE phpMyAdmin
    $sql = "INSERT INTO reservation (full_name, email, phone, location, checkin, checkout, room_type, guests, requests, booking_date)
            VALUES (:name, :email, :phone, :location, :checkin, :checkout, :room, :guests, :requests, :booking_date)";
    
    $stmt = $conn->prepare($sql);

    // BIND PARAMETERS
    $stmt->bindParam(':name', $fullName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':checkin', $checkin);
    $stmt->bindParam(':checkout', $checkout);
    $stmt->bindParam(':room', $roomType);
    $stmt->bindParam(':guests', $guests);
    $stmt->bindParam(':requests', $requests);
    $stmt->bindParam(':booking_date', $bookingDate);

    // EXECUTE STATEMENT
    if (!$stmt->execute()) {
        die("Error: Could not complete reservation.");
    }
} else {
    die("Invalid access.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        table {
            width: 50%;
            margin: auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #d9dddc;
            color: black;
            text-align: left;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;

        }
    </style>
</head>
<body>

<h2>Booking Confirmation</h2>
<p>Thank you booking with Royale Laurent</p>
<p style="color:red;">"Please Screenshot/Print Before Leaving This Page"</p>
<p>Here are your details:</p>

    <!--TABLE DETAILS INFORMATION USERS LIKE NAME, EMAIL, AND ETC. -->
<table>
    <tr><th>Full Name</th><td><?php echo $fullName; ?></td></tr>
    <tr><th>Email</th><td><?php echo $email; ?></td></tr>
    <tr><th>Phone</th><td><?php echo $phone; ?></td></tr>
    <tr><th>Location</th><td><?php echo $location; ?></td></tr>
    <tr><th>Check-in</th><td><?php echo $checkin; ?></td></tr>
    <tr><th>Check-out</th><td><?php echo $checkout; ?></td></tr>
    <tr><th>Room Type</th><td><?php echo $roomType; ?></td></tr>
    <tr><th>Guests</th><td><?php echo $guests; ?></td></tr>
    <tr><th>Special Requests</th><td><?php echo $requests; ?></td></tr>
    <tr><th>Booking Date</th><td><?php echo $bookingDate; ?></td></tr>
</table>

    <!--THIS FOR USERS CAN PRINT DETAILS TABLE-->
<button onclick="window.print()">Print Confirmation</button>

</body>
</html>
