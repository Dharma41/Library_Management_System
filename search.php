<!DOCTYPE html>
<html>
<head>
    <title>Book Search</title>
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
    <h2>Search for Books</h2>
    <form method="GET" action="search_results.php">
        <label for="query">Search for books:</label>
        <select name="query">
            <option value="EBook">EBook</option>
            <option value="PBook">PBook</option>
        </select>
        <input type="submit" value="Search">
    </form>
    <form method="GET" action="search_results1.php">
        <label for="authorQuery">Group By Author:</label>
        <input type="text" name="authorQuery" required>
        <input type="submit" value="Search">
    </form>
</body>
</html>




<!-- <!DOCTYPE html>
<html>
<head>
    <title>Book Search</title>
</head>
<body>
    <h2>Search for Books</h2>
    <form method="GET" action="search_results.php">
    <label for="search_type">Search for books:</label>
        <select name="search_type">
            <option value="EBook">EBook</option>
            <option value="PBook">PBook</option>
        </select>
        <label for="query">Search for books:</label>
        <input type="text" name="query" required> 
         <input type="submit" value="Search">
    </form>
</body>
</html> -->
