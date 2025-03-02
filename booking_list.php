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
} catch (PDOException $e) { //CHECK CONNECTION
    die("Connection failed: " .$e->getMessage());
}

//RETRIEVE ALL BOOKINGS
$sql = "SELECT * FROM reservation ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Booking List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }

    </style>
</head>
<body>
    <h2>Customer Booking List</h2>
    <p><a href="adminMenu.php">Back to Main Menu</a></p>
    <table>
        <tr> <!--CUSTOMERS LIST-->
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
        </tr>
        <?php foreach ($bookings as $booking): ?>
        <tr> <!--ADMIN SEE CUSTOMERS LIST-->
            <td><?php echo htmlspecialchars($booking['id']); ?></td>
            <td><?php echo htmlspecialchars($booking['full_name']); ?></td>
            <td><?php echo htmlspecialchars($booking['email']); ?></td>
            <td><?php echo htmlspecialchars($booking['phone']); ?></td>
            <td><?php echo htmlspecialchars($booking['location']); ?></td>
            <td><?php echo htmlspecialchars($booking['checkin']); ?></td>
            <td><?php echo htmlspecialchars($booking['checkout']); ?></td>
            <td><?php echo htmlspecialchars($booking['room_type']); ?></td>
            <td><?php echo htmlspecialchars($booking['guests']); ?></td>
            <td><?php echo htmlspecialchars($booking['requests']); ?></td>
            <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>