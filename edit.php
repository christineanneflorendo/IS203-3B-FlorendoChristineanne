<?php
require('./Database.php');

// Fetch user data for editing if the form is submitted
if (isset($_POST['edit'])) {
    $editID = $_POST['editID'];
    $editF = $_POST['editF'];
    $editM = $_POST['editM'];
    $editL = $_POST['editL'];


}

// Update user information
if (isset($_POST['update'])) {
    $updateID = $_POST['updateID'];
    $updateF = $_POST['updateF'];
    $updateM = $_POST['updateM'];
    $updateL = $_POST['updateL'];

$queryupdate = "UPDATE form SET Fname ='$updateF', Mname = '$updateM', Lname = '$updateL' WHERE id = $updateID";
$sqlupdate = mysqli_query($connection,$queryupdate);

echo '<script>alert("Successfully edited")</script>';

    echo '<script>window.location.href = "/gomez/Index.php"</script>';

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

    <center><h1>EDIT INFORMATION</h1></center>
    <br>

    <div class="container">
        <form action="edit.php" method="post">
            <h3>Edit User Info</h3>
            <input type="hidden" name="updateID" value="<?php echo htmlspecialchars($editID); ?>" /> <!-- Hidden field for user ID -->
            <input type="text" name="updateF" placeholder="Enter your Firstname" value="<?php echo htmlspecialchars($editF); ?>" required/>
            <br><br>
            <input type="text" name="updateM" placeholder="Enter your Middlename" value="<?php echo htmlspecialchars($editM); ?>" required/>
            <br><br>
            <input type="text" name="updateL" placeholder="Enter your Lastname" value="<?php echo htmlspecialchars($editL); ?>" required/>
            <br><br>
            <input type="submit" name="update" value="UPDATE" class="btn btn-primary btn-xs"/>
        </form>
    </div>

</body>
</html>
