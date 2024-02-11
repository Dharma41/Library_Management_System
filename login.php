<?php
// Include config.php for database connection
include('config.php');

session_start();


    $LibrarianID=$_POST['LibrarianID'];
    $password = $_POST['password'];

    // Verify user's credentials (you should validate the password)
    $sql = "SELECT * FROM Authentication WHERE LibrarianID = '$LibrarianID' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['loggedin'] = true;
        header("Location: dashboard.php");
    } else {
        echo "Invalid login credentials";
    }

?>
<!-- Create the login form -->
