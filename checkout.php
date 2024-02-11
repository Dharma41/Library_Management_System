<?php
session_start(); // Start the session

// Ensure the user is logged in (uncomment this if necessary)
// if (!isset($_SESSION['loggedin'])) {
//     header("Location: login.php");
//     exit();
// }

// Create a database connection (assuming you have a config.php)
include('config.php');

// Fetch the list of available books from the database
// Here I am using the view availablebooks

$sqlBooks = "(SELECT BookID, BookName FROM availablebooks WHERE CheckedOut = 0)
        UNION
        (SELECT BookID, BookName FROM PBook WHERE CheckedOut = 0)"; // Modify the condition as needed
$resultBooks = $conn->query($sqlBooks);

// Define an associative array to store book data (ID => Name)
$books = array();

if ($resultBooks->num_rows > 0) {
    while ($row = $resultBooks->fetch_assoc()) {
        $books[$row['BookID']] = $row['BookName'];
    }
}

// Fetch Patron data from the Patron table for dropdown
$sqlPatrons = "SELECT PatronID, Name FROM Patron";
$resultPatrons = $conn->query($sqlPatrons);

// Define an associative array to store patron data (ID => Name)
$patrons = array();

if ($resultPatrons->num_rows > 0) {
    while ($row = $resultPatrons->fetch_assoc()) {
        $patrons[$row['PatronID']] = $row['Name'];
    }
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['book_id'], $_POST['duedate'], $_POST['patron_id'])) {
        $bookID = $_POST['book_id'];
        $dueDate = $_POST['duedate'];
        $patronID = $_POST['patron_id'];

        $bookID = mysqli_real_escape_string($conn, $bookID); // Sanitize the input
        $dueDate = mysqli_real_escape_string($conn, $dueDate);
        $patronID = mysqli_real_escape_string($conn, $patronID);

        // Implement the book checkout logic and Transaction table insertion
        $sql = "UPDATE Ebook SET CheckedOut = 1 WHERE BookID = '$bookID'";
        // $BorrowedBooks = "SELECT BorrowedBooks FROM Transaction where PatronID = '$patronID'";
        // $resultPatrons = $conn->query($sqlPatrons);
        $sql2 = "INSERT INTO Transaction (BookID, DueDate, PatronID) VALUES ('$bookID', '$dueDate', '$patronID')";
        // $sql3 = "UPDATE Transaction SET BorrowedBooks = BorrowedBooks + 1 WHERE PatronID = '$patronID'";


        if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
            echo "Book successfully checked out and transaction recorded!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid data submitted.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Checkout</title>
    <style>
        body {
            background-image: url('Pic2.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            text-align: center; /* Center-align content */
            color: white; /* Set text color to white */
        }

        h2 {
            color: red;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label, select, input[type="date"], input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h2>Book Checkout</h2>
    <form method="POST" action="checkout.php">
        <label for="book_id">Select a book to check out:</label>
        <select name="book_id">
            <?php
            foreach ($books as $id => $name) {
                echo "<option value='$id'>$id - $name</option>";
            }
            ?>
        </select>

        <label for="duedate">Due Date:</label>
        <input type="date" name="duedate" required>

        <label for="patron_id">Patron ID:</label>
        <select name="patron_id">
            <?php
            foreach ($patrons as $patronID => $Name) {
                echo "<option value='$patronID'>$patronID - $Name</option>";
            }
            ?>
        </select>

        <input type="submit" value="Check Out">
    </form>
</body>
</html>
