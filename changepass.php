<?php
session_start();
require('./database.php');

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['change_password'])) {
    $username = $_SESSION['username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password != $confirm_password) {
        echo '<script>alert("New password and confirm password do not match!");</script>';
    } else {
        // Retrieve the user's hashed password from the database
        $query = "SELECT password FROM registration WHERE username = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $current_hashed_password);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // Verify the old password using password_verify
        if (!password_verify($old_password, $current_hashed_password)) {
            echo '<script>alert("Old password is incorrect!");</script>';
        } else {
            // Hash the new password before updating it
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $update_query = "UPDATE registration SET password = ? WHERE username = ?";
            $stmt = mysqli_prepare($connection, $update_query);
            mysqli_stmt_bind_param($stmt, "ss", $new_hashed_password, $username);

            if (mysqli_stmt_execute($stmt)) {
                echo '<script>alert("Password changed successfully!");</script>';
            } else {
                echo '<script>alert("Error updating password: ' . mysqli_error($connection) . '");</script>';
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background: #F0F4FF;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            font-size: 14px;
            color: #666;
            margin-bottom: 6px;
            display: block;
        }
        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.3s;
        }
        input:focus {
            border-color: #74ebd5;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #74ebd5; /* Updated button color */
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            transition: background 0.3s;
        }
        button:hover {
            background: #ACB6E5; /* Updated hover color */
        }
        .back-button {
            background: #6c757d; /* Grey background for the back button */
        }
        .back-button:hover {
            background: #5a6268; /* Darker grey on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🔒 Change Password</h2>
        <form action="changepass.php" method="post">
            <label for="old_password">Old Password</label>
            <input type="password" id="old_password" name="old_password" placeholder="Enter old password" required>

            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>

            <label for="confirm_password">Confirm New Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required>

            <button type="submit" name="change_password">Update Password</button>
        </form>
        
        <form action="index.php" method="get" style="margin-top: 15px;">
            <button type="submit" class="back-button">BACK</button>
        </form>
    </div>
</body>
</html>
