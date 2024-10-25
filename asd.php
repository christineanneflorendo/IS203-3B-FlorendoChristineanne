<?php
require('./Read.php'); // Ensure Read.php includes necessary database connection and query
session_start();

// Check if the user is logged in by verifying if session variables exist
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit;
}

// Fetch the logged-in user's information from the session
$user_id = $_SESSION['user_id'];    // Assuming user_id is stored in session
$username = $_SESSION['username'];   // Assuming username is stored in session
$email = $_SESSION['email'];         // Assuming email is stored in session
$program = $_SESSION['program'];     // Assuming program is stored in session
$user_role = $_SESSION['user_role']; // Assuming user_role is stored in session

// Redirect based on user role
if ($user_role === 'admin') {
    header('Location: admin_index.php');
    exit;
} else {
    header('Location: user_index.php');
    exit;
}

// Assume $sqlAccounts is already defined and fetched in Read.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css" />
    <style>
      /* Importing Google font - Poppins */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

body {
  min-height: 100vh;
  background: #F0F4FF;
}

.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 85px;
  display: flex;
  overflow-x: hidden;
  flex-direction: column;
  background: #161a2d;
  padding: 25px 20px;
  transition: all 0.4s ease;
}

.sidebar:hover {
  width: 260px;
}

.sidebar .sidebar-header {
  display: flex;
  align-items: center;
}

.sidebar .sidebar-header img {
  width: 42px;
  border-radius: 50%;
}

.sidebar .sidebar-header h2 {
  color: #fff;
  font-size: 1.25rem;
  font-weight: 600;
  white-space: nowrap;
  margin-left: 23px;
}

.sidebar-links h4 {
  color: #fff;
  font-weight: 500;
  white-space: nowrap;
  margin: 10px 0;
  position: relative;
}

.sidebar-links h4 span {
  opacity: 0;
}

.sidebar:hover .sidebar-links h4 span {
  opacity: 1;
}

.sidebar-links .menu-separator {
  position: absolute;
  left: 0;
  top: 50%;
  width: 100%;
  height: 1px;
  transform: scaleX(1);
  transform: translateY(-50%);
  background: #4f52ba;
  transform-origin: right;
  transition-delay: 0.2s;
}

.sidebar:hover .sidebar-links .menu-separator {
  transition-delay: 0s;
  transform: scaleX(0);
}

.sidebar-links {
  list-style: none;
  margin-top: 20px;
  height: 80%;
  overflow-y: auto;
  scrollbar-width: none;
}

.sidebar-links::-webkit-scrollbar {
  display: none;
}

.sidebar-links li a {
  display: flex;
  align-items: center;
  gap: 0 20px;
  color: #fff;
  font-weight: 500;
  white-space: nowrap;
  padding: 15px 10px;
  text-decoration: none;
  transition: 0.2s ease;
}

.sidebar-links li a:hover {
  color: #161a2d;
  background: #fff;
  border-radius: 4px;
}

.user-account {
  margin-top: auto;
  padding: 12px 10px;
  margin-left: -10px;
}

.user-profile {
  display: flex;
  align-items: center;
  color: #161a2d;
}

.user-profile img {
  width: 42px;
  border-radius: 50%;
  border: 2px solid #fff;
}

.user-profile h3 {
  font-size: 1rem;
  font-weight: 600;
}

.user-profile span {
  font-size: 0.775rem;
  font-weight: 600;
}

.user-detail {
  margin-left: 23px;
  white-space: nowrap;
}

.sidebar:hover .user-account {
  background: #ADD8E6;
  border-radius: 4px;
}

body {
  padding: 25px;
  background-color: white;
  color: black;
  font-size: 25px;
}

.dark-mode {
  background-color: black;
  color: white;
}

.qr-code {
    width: 60px; /* Adjust QR code size */
    height: 60px;
    transition: transform 0.3s ease; /* Smooth transition for scaling */
}

.qr-code:hover {
    transform: scale(1.5); /* Scale the QR code on hover */
}

body {
    background-color: #f8f9fa; /* Light background color */
    color: #343a40; /* Dark text color */
}

h1 {
    margin-top: 20px;
    color: #007bff; /* Bootstrap primary color */
}

.container {
    margin-top: 30px;
    padding: 20px;
    border-radius: 10px;
    background-color: #ffffff; /* White background for the form */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

.table {
    margin-top: 20px;
}

.table th {
    background-color: #007bff; /* Blue header */
    color: white;
}

.table td {
    background-color: #f1f1f1; /* Light gray rows */
}

.btn {
    margin: 5px;
}

.action-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.qr-code {
    width: 100px; /* Adjust QR code size */
    height: 90px; 
}

button {
    background-color: #007BFF; /* Blue background */
    color: white; /* White text */
    border: none; /* Remove borders */
    padding: 10px 20px; /* Add some padding */
    font-size: 16px; /* Increase font size */
    cursor: pointer; /* Pointer cursor on hover */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s ease; /* Smooth hover effect */
}

button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

    </style>

</head>
<body>
<div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>Your email: <?php echo htmlspecialchars($email); ?></p>
        <p>Your program: <?php echo htmlspecialchars($program); ?></p>
        <!-- Add more user-specific content here -->
    <center><h1>Welcome to SRC Management</h1></center>

    <div class="container">
    
        <form action="Create.php" method="post">
            <h3>STUDENT OF SANTA RITA COLLEGE</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="Fname" placeholder="Enter your Firstname" required />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Mname" placeholder="Enter your Middlename" required />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Lname" placeholder="Enter your Lastname" required />
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="Age" placeholder="Enter your Age" required />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Address" placeholder="Enter your Address" required />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Course" placeholder="Enter your Course" required />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Year" placeholder="Enter your Year" required />
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    
    <h1>Accounts List</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Address</th>
                <th>Course</th>
                <th>Year</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sqlAccounts as $account): ?>
                <tr>
                    <td><?php echo htmlspecialchars($account['Fname']); ?></td>
                    <td><?php echo htmlspecialchars($account['Mname']); ?></td>
                    <td><?php echo htmlspecialchars($account['Lname']); ?></td>
                    <td><?php echo htmlspecialchars($account['Age']); ?></td>
                    <td><?php echo htmlspecialchars($account['Address']); ?></td>
                    <td><?php echo htmlspecialchars($account['Course']); ?></td>
                    <td><?php echo htmlspecialchars($account['Year']); ?></td>
                    <td>
                        <a href="Edit.php?id=<?php echo $account['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="Delete.php?id=<?php echo $account['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
