<?php
// Include config.php for database connection
//include('config.php');
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'LibraryManagementSystem';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$LibrarianID = $_POST['LibrarianID'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if LibrarianID already exists
$existingLibrarian = "SELECT * FROM Librarian WHERE LibrarianID = '$LibrarianID'";
$result = $conn->query($existingLibrarian);

if ($result->num_rows > 0) {
    echo "LibrarianID already exists. Please choose a different LibrarianID.<a href='Registration.html'>Click here to Register again</a>";
} else {
    // Insert user into the database
    $sqlLibrarian = "INSERT INTO Librarian VALUES ('$LibrarianID','$name', '$email', '$password')";
    $sqlAuthentication = "INSERT INTO Authentication VALUES ('$LibrarianID','$password')";

    if ($conn->query($sqlLibrarian) === TRUE && $conn->query($sqlAuthentication) === TRUE) {
        echo "Registration successful! <a href='Registration.html'>Click here to Login</a>";
    } else {
        echo "Error: " . $sqlLibrarian . "<br>" . $conn->error;
    }
}

$conn->close();
?>
