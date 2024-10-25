<!DOCTYPE html>
<html>
<head>
    <title>Print Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Optional: You can add styles to the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        /* Print styling: Hide the print button when printing */
        @media print {
            #printButton {
                display: none;
            }
        }
    </style>
</head>
<body>

<?php
// Step 1: Connect to the database
$servername = "localhost"; // or your server address
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "db5"; // your database name
$port = 3307;

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Write a query to fetch the data
$sql = "SELECT ID, Username, Email FROM register";
$result = $conn->query($sql);

// Step 3: Display data in an HTML table
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
            </tr>";

    // Loop through each row of the result and display it
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["ID"] . "</td>
                <td>" . $row["Username"] . "</td>
                <td>" . $row["Email"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No results found";
}

// Close the database connection
$conn->close();
?>
<br><br>
 <div class="d-flex justify-content-center">
<!-- Step 4: Add the Print button -->
<button id="printButton" class="btn btn-primary" onclick="window.print()">Print</button>
 </div>
</body>
</html>
