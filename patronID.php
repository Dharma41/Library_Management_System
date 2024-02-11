<!DOCTYPE html>
<html>
<head>
    <title>Patron Information</title>
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

        /* Add styles to center the table */
        .center-table {
            margin: 0 auto; /* Horizontally center the table */
            text-align: left; /* Reset text alignment inside the table */
        }
    </style>
</head>
<body>
    <h2>Patron Information</h2>

    <?php
    // Include your database connection (modify this according to your setup)
    include('config.php');
    if (isset($_GET['query']) && !empty($_GET['query'])) {
        $query = $_GET['query'];
        echo $query;
        // Inner Join statement is used here
        $sql = "SELECT Name,TransactionID FROM Patron INNER JOIN Transaction ON Patron.PatronID=Transaction.PatronID";
        $result = $conn->query($sql);
    }
    if (isset($_GET['query1']) && !empty($_GET['query1'])) {
        $query = $_GET['query1'];
        echo $query1;
        // Nested Query
        $sql = "SELECT PatronID, Name
        FROM Patron
        WHERE PatronID IN (
            SELECT PatronID
            FROM Transaction
            GROUP BY PatronID
            HAVING COUNT(*) > 3
        )";
        $result2= $conn->query($sql);
    }
    if (isset($_GET['query2']) && !empty($_GET['query2'])) {
        $query = $_GET['query2'];
        echo $query1;
        // ALL/ANY Query
        $sql =   "SELECT PatronID, Name
        FROM Patrons
        WHERE PatronID IN (
            SELECT PatronID
            FROM BorrowedBooks
            GROUP BY PatronID
            HAVING COUNT(*) > ALL (
                SELECT COUNT(*)
                FROM BorrowedBooks
                GROUP BY PatronID
            )
        )";
        $result3= $conn->query($sql);
    }
  
    if (isset($_GET['query3']) && !empty($_GET['query3'])) {
        $query = $_GET['query3'];
        echo $query1;
        // Correlated Query 
        $sql =   "SELECT PatronID, Name
        FROM Patron p
        WHERE EXISTS (
            SELECT 1
            FROM Transaction b
            WHERE b.PatronID = p.PatronID
            AND b.BorrowedBooks>=5
        )";
        $result4 = $conn->query($sql);
    }

    // Retrieve the Patron ID and the number of books borrowed
    // $sql = "SELECT PatronID,Name, COUNT(BorrowedBooks) as BorrowedBooks FROM Patron GROUP BY PatronID";
    // $result = $conn->query($sql);

    // Display the results
    
    if ($result->num_rows > 0) {
        echo '<div class="center-table">'; // Open a div for centering
        echo "<table border='1'>
                <tr>
                    <th>Name</th>
                    <th>TransactionID</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['Name'] . "</td>
                    <td>" . $row['TransactionID'] . "</td>
                </tr>";
        }
        echo "</table>";
        echo '</div>'; // Close the div
    } else {
        echo "No patron information available.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
