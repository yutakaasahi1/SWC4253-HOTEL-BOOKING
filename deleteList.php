<html>
    <head>
        <title>Delete Record Booking Hotel</title>
    </head>
<!--ENTER PHONE DELETE LIST-->
    <body>
        <form action="deleteRecord.php" method="post">

        <h2>Delete Booking List</h2>
        Phone Number: <input type="text" name="phone" size="30">
<!--USE PHONE NUMBER BECAUSE PHONE NUMBER IS UNIQUE NUMBER-->
        <input type="submit" name="submit">

        <p><a href="adminMenu.php">Back to Main Menu</a></p>

        </form>
    </body>
</html>