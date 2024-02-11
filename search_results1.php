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
        if (isset($_GET['authorQuery']) && !empty($_GET['authorQuery'])) {
            $authorQuery = $_GET['authorQuery'];

            // Create a database connection (assuming you have a config.php)
            include('config.php');
            
            // Perform a database search
            if ($authorQuery) {
                $authorQuery = mysqli_real_escape_string($conn, $authorQuery); // Sanitize the input
                $sql = "SELECT Author,COUNT(*) AS TotalBooks FROM Ebook GROUP BY Author";
                $result = $conn->query($sql);

                // Display the search results
                if ($result->num_rows > 0) {
                    echo "<h2>Search Results:</h2>";
                    echo "<table>";
                    echo "<tr><th>Author</th><th>TotalBooks</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Author'] . "</td>";
                        echo "<td>" . $row['TotalBooks'] . "</td>";
                        // echo "<td>" . $row['Author'] . "</td>";
                        // echo "<td>" . $row['ISBN'] . "</td>";
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
