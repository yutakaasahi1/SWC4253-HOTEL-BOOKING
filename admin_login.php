<?php
session_start();
$host = 'localhost';
$dbname = 'hotel_reservations';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Query to find admin user
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = :username");
    $stmt->bindParam(':username', $input_username);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password
    if ($admin && password_verify($input_password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>Login Page</title>
    <style>
    
    .button {
            background-color: #333;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        
        .button:hover {
            background-color: #04AA6D;
            color: white;
        }


    </style>
</head>
<body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        body {
            text-align: center;
        }

        .button {
            background-color: #333;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        
        .button:hover {
            background-color: #04AA6D;
            color: white;
        }

        h3 {
            text-align: left;
        }

    </style>
</head>
<body> 
    <form method="POST" action="adminMenu.php">
    <table width="332" align="center">
            <tr>
                <td colspan="3" align="center"><h2>Admin Royale Laurent Login</h2></td>
            </tr>
            <tr>
                <td width="68"><label for="username">Username:</label></td> <!--Admin enter username-->
                <td width="8"><input type="text" name="username" required><br></td>
            </tr>
			
            <tr>
                <td><label for="password">Password:</label></td> <!--Admin enter password-->
                <td><input type="password" name="password" required><br></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><button type="submit" class="button">Login</button></td> <!--Admin must tap to login-->
            </tr>

            <h3><a href="ContactHotel.html">Back</a></h3>

    </table>
    </form>

</body>
</html>