<?php 
require 'function.php'; 

// Get the user ID from the URL, ensuring it's an integer to prevent SQL injection
$id = (int)$_GET["id"]; 

// Fetch user details from the database
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
$user = mysqli_fetch_assoc($result);

// Check if user exists
if (!$user) {
    die("User not found.");
}
?>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    Name
    <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required> <br>
    Image
    <input type="file" name="file"> <br> <!-- Changed to optional upload -->
    <button type="submit" name="submit" value="edit">Edit</button>
</form>
<br>
<a href="index2.php">Index Page</a>
</body>
</html>
