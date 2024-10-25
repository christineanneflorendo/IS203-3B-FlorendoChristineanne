<?php
session_start(); // Start the session
require('./Read.php'); // Ensure Read.php includes necessary database connection and query

// Ensure that the session variable 'username' is set before accessing it
if (!isset($_SESSION['username'])) {
    echo '<script>alert("You must log in first!"); window.location.href = "/gomez/login.php";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* General styling */
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #F3F6FC;
        }
        .container {
            flex-grow: 1;
            padding: 25px;
            margin-top: 85px; /* Space for top bar */
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 1200px; /* Set a maximum width for the container */
            margin-left: auto; /* Center the container */
            margin-right: auto; /* Center the container */
        }

        /* Top bar with gradient design */
        .top-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(90deg, #1E3C72, #2A5298);
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        /* Top bar header styles */
        .top-bar .top-bar-header {
            display: flex;
            align-items: center;
        }

        .top-bar-header img {
            width: 42px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .top-bar-header h2 {
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        /* Top bar links */
        .top-bar-links {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .top-bar-links li {
            margin: 0 10px;
        }

        .top-bar-links li a {
            color: white;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            text-decoration: none;
            font-weight: 500;
            font-size: 18px;
            transition: background 0.3s, color 0.4s ease;
        }

        .top-bar-links li a:hover {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        .top-bar-links span {
            margin-right: 8px;
            font-size: 20px;
        }

        /* Welcome message */
        .top-bar .welcome-message {
            color: white;
            font-weight: 500;
            font-size: 18px;
        }

        /* Print button styling */
        #printButton {
            margin-top: 20px; /* Add some space above the button */
            padding: 10px 20px; /* Increase button size */
            font-size: 16px; /* Increase font size */
        }
    </style>
</head>
<body>

    <!-- Top bar -->
    <header class="top-bar">
        <div class="top-bar-header">
            <img src="ccslogo-removebg-preview.png" alt="logo">
            <h2>HOME</h2>
        </div>
        <div class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</div>
        <ul class="top-bar-links">
            <li><a href="sms.php"><span class="glyphicon glyphicon-envelope"></span> SMS</a></li>
            <li><a href="Email.php"><span class="glyphicon glyphicon-send"></span> Email</a></li>
            <li><a href="admind.php"><span class="glyphicon glyphicon-stats"></span> ADMIN </a></li>
            <li><a href="upload.php"><span class="glyphicon glyphicon-list"></span> Upload</a></li>
            <li><a href="changepass.php"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-bell"></span> Notifications</a></li>
            <li><a href="index.php"><span class="glyphicon glyphicon-log-out"></span> HOME</a></li>
        </ul>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- User Records Table -->
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr class="info">
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($results = mysqli_fetch_array($sqlAccounts)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($results['id']); ?></td>
                        <td><?php echo htmlspecialchars($results['Firstname']); ?></td>
                        <td><?php echo htmlspecialchars($results['Middlename']); ?></td>
                        <td><?php echo htmlspecialchars($results['Lastname']); ?></td>
                        <td>
                            <form action="edit.php" method="post" style="display:inline;">
                                <input type="submit" name="edit" value="EDIT" class="btn btn-info btn-xs">
                                <input type="hidden" name="editID" value="<?php echo htmlspecialchars($results['id']); ?>">
                                <input type="hidden" name="editF" value="<?php echo htmlspecialchars($results['Firstname']); ?>">
                                <input type="hidden" name="editM" value="<?php echo htmlspecialchars($results['Middlename']); ?>">
                                <input type="hidden" name="editL" value="<?php echo htmlspecialchars($results['Lastname']); ?>">
                            </form>
                            <form action="Delete.php" method="post" style="display:inline;">
                                <input type="submit" name="delete" value="DELETE" class="btn btn-danger btn-xs">
                                <input type="hidden" name="deleteID" value="<?php echo htmlspecialchars($results['id']); ?>">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button id="printButton" class="btn btn-primary" style="float: right;" onclick="window.print()">Print</button>
    </div>
</body>
</html>
