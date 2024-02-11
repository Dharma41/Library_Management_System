<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        body {
            background-image: url('Pic2.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            text-align: center; /* Center-align content */
            color: white; /* Set text color to white */
        }

        h1, h2 {
            color: red;
        }

        ul {
            list-style: none; /* Remove list bullets */
            padding: 0;
        }

        li {
            margin: 10px 0;
        }

        a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Welcome to Your Dashboard</h1>
    <!-- Display the user's name here if you have it -->
    <!-- <p>Hello, <?php echo $userName; ?>!</p> -->

    <h2>Library Management System Features:</h2>
    <ul>
        <li><a href="patron.php">Search for Patron</a></li>
        <li><a href="search.php">Search for Books</a></li>
        <li><a href="checkout.php">Checkout a Book</a></li>
        <li><a href="my_books.php">My Checked Out Books</a></li>
        <!-- <li><a href="account.php">My Account</a></li> -->
    </ul>

    <h2>Notifications:</h2>
    <p>You have no new notifications.</p>

    <h2>Announcements:</h2>
    <p>There are no new announcements at the moment.</p>

    <h2>Quick Links:</h2>
    <ul>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
