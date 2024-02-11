<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <style>
        body {
            background-image: url('Pic1.jpeg'); /* Add your background image */
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            color: red;
        }

        table {
            background-color: #f2f2f2;
            border-collapse: collapse;
            width: 80%; /* Adjust width as needed */
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Ensure the query parameter is set and not empty
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $query = $_GET['query'];

            // Create a database connection (assuming you have a config.php)
            include('config.php');

            // Perform a database search
            if ($query === 'EBook') {
                $query = mysqli_real_escape_string($conn, $query); // Sanitize the input
                $sql = "SELECT BookID, BookName, Author, ISBN  FROM Ebook";
                $result = $conn->query($sql);

                // Display the search results
                if ($result->num_rows > 0) {
                    echo "<h2>Search Results:</h2>";
                    echo "<table>";
                    echo "<tr><th>BookID</th><th>BookName</th><th>Author</th><th>ISBN</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['BookID'] . "</td>";
                        echo "<td>" . $row['BookName'] . "</td>";
                        echo "<td>" . $row['Author'] . "</td>";
                        echo "<td>" . $row['ISBN'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No results found.";
                }
            } else {
                $query = mysqli_real_escape_string($conn, $query); // Sanitize the input
                $sql = "SELECT BookID, BookName, Author, ISBN FROM PBook";
                $result = $conn->query($sql);

                // Display the search results
                if ($result->num_rows > 0) {
                    echo "<h2>Search Results:</h2>";
                    echo "<table>";
                    echo "<tr><th>BookID</th><th>BookName</th><th>Author</th><th>ISBN</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['BookID'] . "</td>";
                        echo "<td>" . $row['BookName'] . "</td>";
                        echo "<td>" . $row['Author'] . "</td>";
                        echo "<td>" . $row['ISBN'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No results found.";
                }
            }

            // Close the database connection
            $conn->close();
        } else {
            echo "Invalid search query.";
        }
    }
    ?>
</body>
</html>
