
<html>
<head>
    <title>Main Menu for Admin</title>
    <style>
        body {
            text-align: center;
        }

        .button {
            background-color: #959595;
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

        .button1:hover {
            background-color: red;
            color: white;
        }



    </style>
</head>
<body>

    <p>Welcome to</p>
    <h2>Main Menu Admin for Royale Laurent</h2>

    <form action="booking_list.php" method="post"> <!--User go see customers list-->
        <p><input type="submit" value="View Record" name="cmdView" class="button"></p>
    </form>

    <form action="searchRecord.php" method="post"> <!--User go to search record of customer-->
        <p><input type="submit" value="Search Record" name="cmdSearch" class="button"></p>
    </form>

    <form action="updateRecord.php" method="post"> <!--User go to search record of customer-->
        <p><input type="submit" value="Update Record" name="cmdUpdate" class="button"></p>
    </form>

    <form action="deleteList.php" method="post"> <!--User go to delete record of customer-->
        <p><input type="submit" value="Delete Record" name="cmdDelete" class="button"></p>
    </form>

    <form action="admin_login.php" method="post"> <!--User logout from page to go back login -->
        <p><input type="submit" value="Log Out" name="cmdlogout" class="button button1"></p>
    </form>
    
</body>

</html>
