<?php
// DATABASE CONNECTION
$host = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_reservations";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// HANDLE REQUESTS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['search'])) {
        // SEARCH RECORD BY PHONE
        $phone = $_POST['phone'];
        $stmt = $conn->prepare("SELECT * FROM reservation WHERE phone = :phone");
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $record = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo '<p style="color: red;">No Record Found</p>';
        }
    } elseif (isset($_POST['update'])) {
        // UPDATE RECORD
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $location = $_POST['location'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        $room_type = $_POST['room_type'];
        $guests = $_POST['guests'];
        $requests = $_POST['requests'];

        $stmt = $conn->prepare("UPDATE reservation SET 
            full_name = :full_name,
            email = :email,
            phone = :phone,
            location = :location,
            checkin = :checkin,
            checkout = :checkout,
            room_type = :room_type,
            guests = :guests,
            requests = :requests
            WHERE id = :id");

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':checkin', $checkin);
        $stmt->bindParam(':checkout', $checkout);
        $stmt->bindParam(':room_type', $room_type);
        $stmt->bindParam(':guests', $guests);
        $stmt->bindParam(':requests', $requests);

        if ($stmt->execute()) {
            echo '<p style="color: green;">Record updated successfully!</p>';
        } else {
            echo '<p style="color: red;">Failed to update the record.</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
</head>
<body>
    <h1>Update Record</h1>

    <!-- SEARCH FORM -->
    <form method="POST" action="">
        <label for="phone">Enter Phone Number to Search:</label>
        <input type="text" name="phone" id="phone" required>
        <button type="submit" name="search">Search</button>
    </form>

    <?php if (isset($record)): ?>
        <!-- UPDATE FORM -->
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $record['id']; ?>">

            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" id="full_name" value="<?php echo $record['full_name']; ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $record['email']; ?>" required><br>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" value="<?php echo $record['phone']; ?>" required><br>

            <label for="location">Location:</label>
            <input type="text" name="location" id="location" value="<?php echo $record['location']; ?>" required><br>

            <label for="checkin">Check-in:</label>
            <input type="date" name="checkin" id="checkin" value="<?php echo $record['checkin']; ?>" required><br>

            <label for="checkout">Check-out:</label>
            <input type="date" name="checkout" id="checkout" value="<?php echo $record['checkout']; ?>" required><br>

            <label for="room_type">Room Type:</label>
            <input type="text" name="room_type" id="room_type" value="<?php echo $record['room_type']; ?>" required><br>

            <label for="guests">Guests:</label>
            <input type="number" name="guests" id="guests" value="<?php echo $record['guests']; ?>" required><br>

            <label for="requests">Special Requests:</label>
            <input type="text" name="requests" id="requests" value="<?php echo $record['requests']; ?>"><br>

            <button type="submit" name="update">Update</button>
        </form>
    <?php endif; ?>

    <p><a href="adminMenu.php">Back to Main Menu</a></p>

</body>
</html>
