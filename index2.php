<?php require 'function.php'; ?>
<html>
<head>
    <title>User List</title>
</head>
<body>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Image</td>
            <td>Action</td>
        </tr>
        <?php
        // Fetch users from the database
        $users = mysqli_query($conn, "SELECT * FROM crud");
        $i = 1;
        ?>
        <?php while ($user = mysqli_fetch_assoc($users)): ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo htmlspecialchars($user["name"]); ?></td>
                <td>
                    <img src="uploads/<?php echo htmlspecialchars($user["filename"]); ?>" width="200" alt="User Image">
                </td>
                <td>
                    <a href="edituser.php?id=<?php echo $user['id']; ?>">Edit</a>
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button type="submit" name="submit" value="delete">DELETE</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="adduser.php">Add User</a>
</body>
</html>
