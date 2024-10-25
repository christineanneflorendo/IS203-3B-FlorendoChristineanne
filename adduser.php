<?php require 'function.php'; ?>
<html>
<head></head>
<body>
<form action="adduser.php" method="post" enctype="multipart/form-data">
    Name
    <input type="text" name="name" required> <br>
    Image
    <input type="file" name="file" required> <br>
    <button type="submit" name="submit" value="add">Add</button>
</form> <br>
<a href="index2.php">Index Page</a>
</body>
</html>
