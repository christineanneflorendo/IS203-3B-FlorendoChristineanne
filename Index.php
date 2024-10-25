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
            padding: 30px;
            margin-top: 85px; /* Space for top bar */
            background-color: #ffffff;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            transition: transform 0.3s;
        }

        .container:hover {
            transform: translateY(-2px);
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

        /* Form styling */
        h3 {
            color: #333;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #555;
        }

        input.form-control {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            transition: border-color 0.3s;
        }

        input.form-control:focus {
            border-color: #74ebd5;
            box-shadow: 0 0 5px rgba(116, 235, 213, 0.5);
        }

        .btn-primary {
            background-color: #74ebd5;
            border: none;
            color: white;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 16px;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background-color: #2A5298;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .top-bar-links li {
                margin: 0 5px;
            }
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
            <li><a href="record.php"><span class="glyphicon glyphicon-bell"></span> Record</a></li> 
            <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </header>

    <!-- Main Content -->
    <div class="container">
        <center><h1>USER RECORD</h1></center>
        <br>

        <!-- User Creation Form -->
        <form action="Create.php" method="post" class="form-horizontal">
            <h3>Create User</h3>
            <div class="form-group">
                <label for="Fname" class="col-sm-2 control-label">Firstname</label>
                <div class="col-sm-10">
                    <input type="text" name="Fname" class="form-control" placeholder="Enter your Firstname" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Mname" class="col-sm-2 control-label">Middlename</label>
                <div class="col-sm-10">
                    <input type="text" name="Mname" class="form-control" placeholder="Enter your Middlename" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Lname" class="col-sm-2 control-label">Lastname</label>
                <div class="col-sm-10">
                    <input type="text" name="Lname" class="form-control" placeholder="Enter your Lastname" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" name="create" value="CREATE" class="btn btn-primary">
                </div>
            </div>
        </form>

        <!-- User Records Table -->
        <!-- Add your user records table here -->

    </div>
</body>
</html>
