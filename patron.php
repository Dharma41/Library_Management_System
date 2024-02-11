<!DOCTYPE html>
<html>
<head>
    <title>patron</title>
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
    <h2>Search for Patron</h2>
    <form method="GET" action="patronID.php">
        <label for="query">Enter PatronID:</label>
        <input type="text" name="query" required> 
        <input type="submit" value="Search">
    </form>
</body>
</html>